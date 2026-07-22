<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Author;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Media;
use App\Models\Tag;
use App\Services\MediaUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    use HandlesImageUploads;

    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'blogs.';

    public function __construct(private MediaUploader $mediaUploader)
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = Blog::with(['category', 'author'])
            ->latest('id')
            ->paginate($this->pagerecords)
            ->withQueryString();
        $reorderRows = Blog::orderBy('display_order')->orderBy('id')->take(300)->get();

        return view($this->prefix . $this->folder . 'index', compact('rows', 'reorderRows'));
    }

    // saves drag-drop order
    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'string',
        ]);

        try {
            DB::transaction(function () use ($request) {
                foreach ($request->input('order') as $position => $uuid) {
                    Blog::where('uuid', $uuid)->update(['display_order' => $position + 1]);
                }
            });

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.blog'), [
                'description' => 'Reordered blogs',
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('Blog reorder failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    public function createoredit(Request $request, ?string $uuid = null)
    {
        $blog = $uuid ? Blog::where('uuid', $uuid)->firstOrFail() : null;

        $categories = BlogCategory::active()->orderBy('name')->get();
        $authors = Author::active()->orderBy('name')->get();
        $tags = Tag::active()->orderBy('name')->get();

        return view($this->prefix . $this->folder . 'createoredit', compact('blog', 'categories', 'authors', 'tags'));
    }

    public function saveorupdate(Request $request, ?string $uuid = null)
    {
        $blog = $uuid ? Blog::where('uuid', $uuid)->firstOrFail() : null;

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('blogs', 'slug')->ignore($blog?->id)],
            'excerpt' => ['required', 'string'],
            'content' => ['required', 'string'],
            'category_id' => ['required', 'exists:blog_categories,id'],
            'author_id' => ['required', 'exists:authors,id'],
            'status' => ['required', 'in:draft,published,scheduled'],
            'published_at' => ['nullable', 'date'],
            'canonical_url' => ['nullable', 'url', 'max:500'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
            'views' => ['nullable', 'integer', 'min:0'],
            'reading_time' => ['nullable', 'integer', 'min:0'],
            'comment_count' => ['nullable', 'integer', 'min:0'],
            'featured_image' => ['nullable', 'mimes:' . config('constants.IMAGE_MIMES'), 'max:2048'],
            'featured_image_alt' => ['nullable', 'string', 'max:255'],
            'og_image' => ['nullable', 'mimes:' . config('constants.IMAGE_MIMES'), 'max:2048'],
            'og_image_alt' => ['nullable', 'string', 'max:255'],
            'gallery_items' => ['nullable', 'array'],
            'gallery_items.*.id' => ['nullable', 'string'],
            'gallery_items.*.temp' => ['nullable', 'string'],
            'gallery_items.*.alt' => ['nullable', 'string', 'max:255'],
            'gallery_items.*.title' => ['nullable', 'string', 'max:255'],
        ]);

        try {
            DB::beginTransaction();

            $blog = $blog ?? new Blog();
            $isNew = ! $blog->exists;

            $data = [
                'title' => $validated['title'],
                'slug' => $validated['slug'] ?? null,
                'excerpt' => $validated['excerpt'],
                'content' => $validated['content'],
                'category_id' => $validated['category_id'],
                'author_id' => $validated['author_id'],
                'status' => $validated['status'],
                'published_at' => $validated['published_at'] ?? null,
                'canonical_url' => $validated['canonical_url'] ?? null,
                'meta_title' => $validated['meta_title'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
                'meta_keywords' => $this->parseMetaKeywords($request->input('meta_keywords')),
                'views' => $validated['views'] ?? 0,
                'reading_time' => $validated['reading_time'] ?? 0,
                'comment_count' => $validated['comment_count'] ?? 0,
                'is_featured' => $request->boolean('is_featured'),
                'is_active' => $request->boolean('is_active', true),
                'featured_image_alt' => $validated['featured_image_alt'] ?? null,
                'og_image_alt' => $validated['og_image_alt'] ?? null,
            ];

            $newUuid = null;

            if ($isNew) {
                $newUuid = (string) Str::uuid();
                $data['uuid'] = $newUuid;
            }

            $this->applyImage($request, $data, 'featured_image', 'blogs', $blog, $newUuid);
            $this->applyImage($request, $data, 'og_image', 'blogs', $blog, $newUuid);

            $blog->fill($data);
            $blog->save();

            $this->syncGalleryMedia($request, $blog);

            $blog->tags()->sync($this->parseTagIds($request->input('tags', [])));

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($isNew ? 'create' : 'update')),
                config('constants.MODULES.blog'),
                [
                    'subject_type' => Blog::class,
                    'subject_id' => $blog->id,
                    'new_values' => $blog->getChanges(),
                    'description' => ($isNew ? 'Created' : 'Updated') . " blog \"{$blog->title}\".",
                ]
            );

            DB::commit();

            return redirect()->route('admin.blogs.index')->with('success', 'Blog saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Blog saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $request, string $uuid)
    {
        try {
            DB::beginTransaction();

            $blog = Blog::where('uuid', $uuid)->firstOrFail();
            $blog->delete();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.delete'),
                config('constants.MODULES.blog'),
                [
                    'subject_type' => Blog::class,
                    'subject_id' => $blog->id,
                    'description' => "Deleted blog \"{$blog->title}\".",
                ]
            );

            DB::commit();

            return back()->with('success', 'Blog deleted successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Blog destroy failed: ' . $e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, string $uuid)
    {
        try {
            DB::beginTransaction();

            $blog = Blog::where('uuid', $uuid)->firstOrFail();
            $blog->is_active = ! $blog->is_active;
            $blog->save();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($blog->is_active ? 'activate' : 'deactivate')),
                config('constants.MODULES.blog'),
                [
                    'subject_type' => Blog::class,
                    'subject_id' => $blog->id,
                    'description' => 'Blog status toggled to ' . ($blog->is_active ? 'active' : 'inactive') . '.',
                ]
            );

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $blog->is_active]);
            }

            return back()->with('success', 'Blog status updated.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Blog togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglefeatured(Request $request, string $uuid)
    {
        try {
            DB::beginTransaction();

            $blog = Blog::where('uuid', $uuid)->firstOrFail();
            $blog->is_featured = ! $blog->is_featured;
            $blog->save();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($blog->is_featured ? 'feature' : 'unfeature')),
                config('constants.MODULES.blog'),
                [
                    'subject_type' => Blog::class,
                    'subject_id' => $blog->id,
                    'description' => 'Blog featured status toggled to ' . ($blog->is_featured ? 'featured' : 'unfeatured') . '.',
                ]
            );

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $blog->is_featured]);
            }

            return back()->with('success', 'Blog featured status updated.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Blog togglefeatured failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // removed images get deleted, temp uploads promoted
    private function syncGalleryMedia(Request $request, Blog $blog): void
    {
        $existing = $blog->galleryMedia()->get()->keyBy('uuid');
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
                $media = $this->mediaUploader->promoteTempToMedia($row['temp'], $blog, 'gallery', 'blogs', $alt, $title);

                if ($media) {
                    $media->update(['display_order' => $position]);
                    $keepUuids[] = $media->uuid;
                }
            }
        }

        $existing->whereNotIn('uuid', $keepUuids)->each(fn (Media $media) => $this->mediaUploader->deleteMedia($media));
    }

    // edit mode only, skips unsaved temp items
    public function galleryreorder(Request $request, string $uuid)
    {
        $request->validate([
            'order' => ['required', 'array'],
            'order.*' => ['string'],
        ]);

        try {
            $blog = Blog::where('uuid', $uuid)->firstOrFail();

            foreach ($request->input('order') as $position => $mediaUuid) {
                Media::where('uuid', $mediaUuid)
                    ->where('model_type', Blog::class)
                    ->where('model_id', $blog->id)
                    ->where('collection', 'gallery')
                    ->update(['display_order' => $position + 1]);
            }

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('Blog galleryreorder failed: ' . $e->getMessage(), ['exception' => $e]);

            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    private function parseMetaKeywords(?string $raw): array
    {
        if (empty($raw)) {
            return [];
        }

        $decoded = json_decode($raw, true);

        if (is_array($decoded)) {
            return array_values(array_filter(array_map('trim', $decoded)));
        }

        return array_values(array_filter(array_map('trim', explode(',', $raw))));
    }

    private function parseTagIds($rawTags): array
    {
        return collect((array) $rawTags)
            ->flatMap(fn ($value) => is_array($value) ? $value : explode(',', (string) $value))
            ->map(fn ($value) => (int) trim((string) $value))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }
}
