<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Media;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Services\MediaUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class PortfolioController extends Controller
{
    use HandlesImageUploads;

    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'portfolios.';

    public function __construct(private MediaUploader $mediaUploader)
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = Portfolio::with('category')
            ->latest('id')
            ->paginate($this->pagerecords)
            ->withQueryString();
        $reorderRows = Portfolio::orderBy('display_order')->orderBy('id')->take(300)->get();

        return view($this->prefix . $this->folder . 'index', compact('rows', 'reorderRows'));
    }

    // Persist drag-drop reorder
    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'string',
        ]);

        try {
            DB::transaction(function () use ($request) {
                foreach ($request->input('order') as $position => $uuid) {
                    Portfolio::where('uuid', $uuid)->update(['display_order' => $position + 1]);
                }
            });

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.portfolio'), [
                'description' => 'Reordered portfolios',
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('Portfolio reorder failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    public function createoredit(?string $uuid = null)
    {
        $portfolio = null;

        if ($uuid) {
            $portfolio = Portfolio::where('uuid', $uuid)->firstOrFail();
        }

        $categories = PortfolioCategory::orderBy('name')->get();

        return view($this->prefix . $this->folder . 'createoredit', compact('portfolio', 'categories'));
    }

    public function saveorupdate(Request $request, ?string $uuid = null)
    {
        $portfolio = $uuid ? Portfolio::where('uuid', $uuid)->firstOrFail() : null;

        $validated = $request->validate([
            'portfolio_category_id' => ['required', 'exists:portfolio_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('portfolios', 'slug')->ignore($portfolio?->id)],
            'client_name' => ['nullable', 'string', 'max:255'],
            'project_url' => ['nullable', 'url', 'max:255'],
            'project_duration' => ['nullable', 'string', 'max:255'],
            'project_budget' => ['nullable', 'string', 'max:255'],
            'featured_image' => ['nullable', 'image', 'max:4096'],
            'featured_image_alt' => ['nullable', 'string', 'max:255'],
            'banner_image' => ['nullable', 'image', 'max:4096'],
            'banner_image_alt' => ['nullable', 'string', 'max:255'],
            'gallery_items' => ['nullable', 'array'],
            'gallery_items.*.id' => ['nullable', 'string'],
            'gallery_items.*.temp' => ['nullable', 'string'],
            'gallery_items.*.alt' => ['nullable', 'string', 'max:255'],
            'gallery_items.*.title' => ['nullable', 'string', 'max:255'],
            'video_url' => ['nullable', 'url', 'max:255'],
            'overview' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'challenges' => ['nullable', 'string'],
            'solutions' => ['nullable', 'string'],
            'results' => ['nullable', 'string'],
            'project_type' => ['nullable', 'string', 'max:255'],
            'industry' => ['nullable', 'string', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
            'canonical_url' => ['nullable', 'url', 'max:255'],
            'display_order' => ['nullable', 'integer'],
            'views' => ['nullable', 'integer'],
            'published_at' => ['nullable', 'date'],
        ]);

        try {
            DB::beginTransaction();

            $data = $validated;
            unset($data['featured_image'], $data['banner_image'], $data['gallery_items']);

            $data['is_active'] = $request->boolean('is_active');
            $data['is_featured'] = $request->boolean('is_featured');
            $data['published_at'] = $request->filled('published_at') ? $request->input('published_at') : null;
            $data['meta_keywords'] = $this->parseJsonList($request->input('meta_keywords'));

            $this->applyImage($request, $data, 'featured_image', 'portfolios', $portfolio);
            $this->applyImage($request, $data, 'banner_image', 'portfolios', $portfolio);

            $isNew = ! $portfolio;

            if ($portfolio) {
                $portfolio->fill($data);
                $portfolio->save();
            } else {
                $portfolio = Portfolio::create($data);
            }

            $this->syncGalleryMedia($request, $portfolio);

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($isNew ? 'create' : 'update')),
                config('constants.MODULES.portfolio'),
                [
                    'subject_type' => Portfolio::class,
                    'subject_id' => $portfolio->id,
                    'new_values' => $portfolio->getChanges(),
                    'description' => ($isNew ? 'Created' : 'Updated') . ' portfolio: ' . $portfolio->title,
                ]
            );

            DB::commit();

            return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Portfolio saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, string $uuid)
    {
        $portfolio = Portfolio::where('uuid', $uuid)->firstOrFail();

        try {
            $portfolio->is_active = ! $portfolio->is_active;
            $portfolio->save();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($portfolio->is_active ? 'activate' : 'deactivate')),
                config('constants.MODULES.portfolio'),
                [
                    'subject_type' => Portfolio::class,
                    'subject_id' => $portfolio->id,
                    'new_values' => ['is_active' => $portfolio->is_active],
                    'description' => 'Toggled status of portfolio: ' . $portfolio->title,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $portfolio->is_active]);
            }

            return back()->with('success', 'Status updated successfully.');
        } catch (\Throwable $e) {
            Log::error('Portfolio togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglefeatured(Request $request, string $uuid)
    {
        $portfolio = Portfolio::where('uuid', $uuid)->firstOrFail();

        try {
            $portfolio->is_featured = ! $portfolio->is_featured;
            $portfolio->save();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($portfolio->is_featured ? 'feature' : 'unfeature')),
                config('constants.MODULES.portfolio'),
                [
                    'subject_type' => Portfolio::class,
                    'subject_id' => $portfolio->id,
                    'new_values' => ['is_featured' => $portfolio->is_featured],
                    'description' => 'Toggled featured status of portfolio: ' . $portfolio->title,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $portfolio->is_featured]);
            }

            return back()->with('success', 'Status updated successfully.');
        } catch (\Throwable $e) {
            Log::error('Portfolio togglefeatured failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Only reorders items with existing media id
    public function galleryreorder(Request $request, string $uuid)
    {
        $request->validate([
            'order' => ['required', 'array'],
            'order.*' => ['string'],
        ]);

        try {
            $portfolio = Portfolio::where('uuid', $uuid)->firstOrFail();

            foreach ($request->input('order') as $position => $mediaUuid) {
                Media::where('uuid', $mediaUuid)
                    ->where('model_type', Portfolio::class)
                    ->where('model_id', $portfolio->id)
                    ->where('collection', 'gallery')
                    ->update(['display_order' => $position + 1]);
            }

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('Portfolio galleryreorder failed: ' . $e->getMessage(), ['exception' => $e]);

            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    public function destroy(string $uuid)
    {
        $portfolio = Portfolio::where('uuid', $uuid)->firstOrFail();

        try {
            $portfolio->delete();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.delete'),
                config('constants.MODULES.portfolio'),
                [
                    'subject_type' => Portfolio::class,
                    'subject_id' => $portfolio->id,
                    'description' => 'Deleted portfolio: ' . $portfolio->title,
                ]
            );

            return back()->with('success', 'Portfolio deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Portfolio destroy failed: ' . $e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Removed rows delete their media
    private function syncGalleryMedia(Request $request, Portfolio $portfolio): void
    {
        $existing = $portfolio->galleryMedia()->get()->keyBy('uuid');
        $rows = (array) $request->input('gallery_items', []);
        $keepUuids = [];
        $position = 0;

        foreach ($rows as $row) {
            $position++;
            $alt = $row['alt'] ?? null;
            $title = $row['title'] ?? null;

            if (!empty($row['id']) && $existing->has($row['id'])) {
                $media = $existing->get($row['id']);
                $media->update([
                    'alt_text' => $alt,
                    'caption' => $title,
                    'name' => $title ?: $media->name,
                    'display_order' => $position,
                ]);
                $keepUuids[] = $media->uuid;

                continue;
            }

            if (!empty($row['temp'])) {
                $media = $this->mediaUploader->promoteTempToMedia($row['temp'], $portfolio, 'gallery', 'portfolios', $alt, $title);

                if ($media) {
                    $media->update(['display_order' => $position]);
                    $keepUuids[] = $media->uuid;
                }
            }
        }

        $existing->whereNotIn('uuid', $keepUuids)->each(fn (Media $media) => $this->mediaUploader->deleteMedia($media));
    }

    // Decode safely, bad JSON must not crash save
    private function parseJsonList(?string $value): array
    {
        if (empty($value)) {
            return [];
        }

        $decoded = json_decode($value, true);

        return is_array($decoded) ? array_values($decoded) : [];
    }
}
