<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Author;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use App\Services\MediaUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
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

        return view($this->prefix . $this->folder . 'index', compact('rows'));
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
            'featured_image' => ['nullable', 'image', 'max:2048'],
            'og_image' => ['nullable', 'image', 'max:2048'],
        ]);

        try {
            DB::beginTransaction();

            $blog = $blog ?? new Blog();
            $isNew = ! $blog->exists;

            $blog->fill([
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
            ]);

            if ($request->hasFile('featured_image')) {
                $blog->featured_image = $this->mediaUploader->uploadSingle(
                    $request->file('featured_image'),
                    'blogs',
                    $blog->featured_image ?: null
                );
            }

            if ($request->hasFile('og_image')) {
                $blog->og_image = $this->mediaUploader->uploadSingle(
                    $request->file('og_image'),
                    'blogs',
                    $blog->og_image ?: null
                );
            }

            $blog->save();

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
