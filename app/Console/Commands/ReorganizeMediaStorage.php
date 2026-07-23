<?php

namespace App\Console\Commands;

use App\Models\Author;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\CaseStudy;
use App\Models\CaseStudyCategory;
use App\Models\Industry;
use App\Models\Media;
use App\Models\Partner;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\Service;
use App\Models\ServiceChallenge;
use App\Models\ServiceFeature;
use App\Models\Technology;
use App\Models\TechnologyCategory;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * One-off backfill: move every existing upload from the old flat
 * "{directory}/{filename}" layout into the new "{directory}/{uuid}/{filename}"
 * convention, and update the DB path column(s) to match. Safe to re-run —
 * anything already living under its own uuid folder is skipped.
 */
class ReorganizeMediaStorage extends Command
{
    protected $signature = 'media:reorganize {--apply : Actually move files and update the database. Without this flag, only previews what would happen.}';

    protected $description = 'Move existing uploads into the storage/{folder}/{uuid}/{filename} convention';

    protected string $disk = 'public';

    protected int $moved = 0;

    protected int $skipped = 0;

    protected int $errors = 0;

    public function handle(): int
    {
        $apply = (bool) $this->option('apply');

        $this->info($apply ? 'Running for real — files will be moved and the database updated.' : 'Dry run — nothing will be changed. Pass --apply to actually do it.');
        $this->newLine();

        // [Model class, [column => directory], primary key column used to find the model]
        $singleImageConfigs = [
            [Author::class, ['profile_image' => 'authors', 'cover_image' => 'authors']],
            [Blog::class, ['featured_image' => 'blogs', 'og_image' => 'blogs']],
            [BlogCategory::class, ['image' => 'blog-categories']],
            [CaseStudy::class, ['featured_image' => 'case-studies', 'banner_image' => 'case-studies']],
            [CaseStudyCategory::class, ['image' => 'case-study-categories']],
            [Industry::class, ['image' => 'industries']],
            [Partner::class, ['logo' => 'partners']],
            [Portfolio::class, ['featured_image' => 'portfolios', 'banner_image' => 'portfolios']],
            [PortfolioCategory::class, ['image' => 'portfolio-categories']],
            [Service::class, ['featured_image' => 'services', 'banner_image' => 'services']],
            [Technology::class, ['image' => 'technologies']],
            [TechnologyCategory::class, ['image' => 'technology-categories']],
            [Testimonial::class, ['photo' => 'testimonials']],
            [User::class, ['avatar' => 'users']],
        ];

        foreach ($singleImageConfigs as [$modelClass, $columns]) {
            foreach ($columns as $column => $directory) {
                $this->reorganizeColumn($modelClass, $column, $directory, $apply);
            }
        }

        // Service sub-resources: nested under the parent service's uuid.
        $this->reorganizeServiceChild(ServiceFeature::class, 'features', $apply);
        $this->reorganizeServiceChild(ServiceChallenge::class, 'challenges', $apply);

        // Media library (standalone rows — own uuid, no owning model).
        $this->reorganizeColumn(Media::class, 'path', 'media-library', $apply, onlyWhereNull: 'model_type');

        // Polymorphic galleries: Media rows attached to Blog/CaseStudy/Portfolio/Service.
        $galleryDirectories = [
            Blog::class => 'blogs',
            CaseStudy::class => 'case-studies',
            Portfolio::class => 'portfolios',
            Service::class => 'services',
        ];

        foreach ($galleryDirectories as $ownerClass => $directory) {
            $this->reorganizeGallery($ownerClass, $directory, $apply);
        }

        $this->newLine();
        $this->info("Moved: {$this->moved}  Skipped (already migrated or empty): {$this->skipped}  Errors: {$this->errors}");

        return $this->errors > 0 ? self::FAILURE : self::SUCCESS;
    }

    protected function reorganizeColumn(string $modelClass, string $column, string $directory, bool $apply, ?string $onlyWhereNull = null): void
    {
        $query = $modelClass::query()->whereNotNull($column)->where($column, '!=', '');

        if ($onlyWhereNull) {
            $query->whereNull($onlyWhereNull);
        }

        $query->orderBy('id')->chunkById(100, function ($rows) use ($column, $directory, $apply, $modelClass) {
            foreach ($rows as $row) {
                $this->moveOne($modelClass, $row->id, $column, $row->{$column}, $directory, $row->uuid, $apply);
            }
        });
    }

    protected function reorganizeServiceChild(string $modelClass, string $subfolder, bool $apply): void
    {
        $modelClass::query()
            ->whereNotNull('image')
            ->where('image', '!=', '')
            ->with('service')
            ->orderBy('id')
            ->chunkById(100, function ($rows) use ($modelClass, $subfolder, $apply) {
                foreach ($rows as $row) {
                    if (! $row->service || empty($row->service->uuid)) {
                        $this->warn("  [skip] {$modelClass}#{$row->id} has no parent service uuid");
                        $this->skipped++;

                        continue;
                    }

                    $directory = 'services/'.$row->service->uuid.'/'.$subfolder;
                    $this->moveOne($modelClass, $row->id, 'image', $row->image, $directory, null, $apply, useDirectoryAsIs: true);
                }
            });
    }

    protected function reorganizeGallery(string $ownerClass, string $directory, bool $apply): void
    {
        Media::query()
            ->where('model_type', $ownerClass)
            ->whereNotNull('path')
            ->where('path', '!=', '')
            ->orderBy('id')
            ->chunkById(100, function ($rows) use ($ownerClass, $directory, $apply) {
                foreach ($rows as $media) {
                    $owner = $ownerClass::find($media->model_id);

                    if (! $owner || empty($owner->uuid)) {
                        $this->warn("  [skip] Media#{$media->id} owner {$ownerClass}#{$media->model_id} not found or has no uuid");
                        $this->skipped++;

                        continue;
                    }

                    $this->moveOne(Media::class, $media->id, 'path', $media->path, $directory, $owner->uuid, $apply);
                }
            });
    }

    /**
     * Move one file + update its owning row's path column, unless the path
     * already lives under a uuid folder (idempotent re-run safety) or the
     * source file is missing.
     */
    protected function moveOne(string $modelClass, int $id, string $column, string $oldPath, string $directory, ?string $uuid, bool $apply, bool $useDirectoryAsIs = false): void
    {
        $directory = trim($directory, '/');
        $targetDir = $useDirectoryAsIs ? $directory : ($uuid ? $directory.'/'.$uuid : $directory);

        if (Str::startsWith($oldPath, $targetDir.'/')) {
            $this->skipped++;

            return;
        }

        if (! Storage::disk($this->disk)->exists($oldPath)) {
            $this->warn("  [skip] {$modelClass}#{$id}.{$column}: source file missing: {$oldPath}");
            $this->skipped++;

            return;
        }

        $filename = pathinfo($oldPath, PATHINFO_BASENAME);
        $newPath = $targetDir.'/'.$filename;

        $this->line("  {$modelClass}#{$id}.{$column}: {$oldPath}  ->  {$newPath}");

        if (! $apply) {
            $this->moved++;

            return;
        }

        try {
            if (Storage::disk($this->disk)->exists($newPath)) {
                $this->warn("    target already exists, skipping move (leaving old file in place): {$newPath}");
                $this->errors++;

                return;
            }

            Storage::disk($this->disk)->move($oldPath, $newPath);

            // Bring along any generated size siblings (e.g. "name_thumb.jpg").
            $oldDir = pathinfo($oldPath, PATHINFO_DIRNAME);
            $baseName = pathinfo($oldPath, PATHINFO_FILENAME);

            foreach (Storage::disk($this->disk)->files($oldDir === '.' ? '' : $oldDir) as $file) {
                $fileBase = pathinfo($file, PATHINFO_FILENAME);

                if (Str::startsWith($fileBase, $baseName.'_')) {
                    $siblingNewPath = $targetDir.'/'.pathinfo($file, PATHINFO_BASENAME);
                    Storage::disk($this->disk)->move($file, $siblingNewPath);
                }
            }

            DB::table((new $modelClass)->getTable())->where('id', $id)->update([$column => $newPath]);

            $this->moved++;
        } catch (\Throwable $e) {
            $this->error("    failed: {$e->getMessage()}");
            $this->errors++;
        }
    }
}
