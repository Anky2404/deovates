<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\BlogCategory;
use App\Services\MediaUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogCategoryController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'blogs.categories.';

    public function __construct(private MediaUploader $mediaUploader)
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = BlogCategory::latest('id')->paginate($this->pagerecords)->withQueryString();
        $reorderRows = BlogCategory::orderBy('display_order')->orderBy('id')->get();

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
                    BlogCategory::where('uuid', $uuid)->update(['display_order' => $position + 1]);
                }
            });

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.blogcategory'), [
                'description' => 'Reordered blog categories',
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('BlogCategory reorder failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    public function createoredit(Request $request, ?string $uuid = null)
    {
        $category = $uuid ? BlogCategory::where('uuid', $uuid)->firstOrFail() : null;

        return view($this->prefix . $this->folder . 'createoredit', compact('category'));
    }

    public function saveorupdate(Request $request, ?string $uuid = null)
    {
        $category = $uuid ? BlogCategory::where('uuid', $uuid)->firstOrFail() : null;

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('blog_categories', 'slug')->ignore($category?->id)],
            'icon' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        try {
            DB::beginTransaction();

            $category = $category ?? new BlogCategory();
            $isNew = ! $category->exists;

            $newUuid = null;

            if ($isNew) {
                $newUuid = (string) Str::uuid();
            }

            $uuidForUpload = $category->uuid ?? $newUuid;

            $category->fill([
                'name' => $validated['name'],
                'slug' => $validated['slug'] ?? null,
                'icon' => $validated['icon'] ?? null,
                'description' => $validated['description'] ?? null,
                'meta_title' => $validated['meta_title'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
                'is_active' => $request->boolean('is_active', true),
            ]);

            if ($isNew) {
                $category->uuid = $newUuid;
            }

            if ($request->hasFile('image')) {
                $category->image = $this->mediaUploader->uploadSingle(
                    $request->file('image'),
                    'blog-categories',
                    $category->image ?: null,
                    [],
                    null,
                    $uuidForUpload
                );
            }

            $category->save();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($isNew ? 'create' : 'update')),
                config('constants.MODULES.blogcategory'),
                [
                    'subject_type' => BlogCategory::class,
                    'subject_id' => $category->id,
                    'new_values' => $category->getChanges(),
                    'description' => ($isNew ? 'Created' : 'Updated') . " blog category \"{$category->name}\".",
                ]
            );

            DB::commit();

            return redirect()->route('admin.blogs.categories.index')->with('success', 'Blog category saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('BlogCategory saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $request, string $uuid)
    {
        try {
            DB::beginTransaction();

            $category = BlogCategory::where('uuid', $uuid)->firstOrFail();
            $category->delete();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.delete'),
                config('constants.MODULES.blogcategory'),
                [
                    'subject_type' => BlogCategory::class,
                    'subject_id' => $category->id,
                    'description' => "Deleted blog category \"{$category->name}\".",
                ]
            );

            DB::commit();

            return back()->with('success', 'Blog category deleted successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('BlogCategory destroy failed: ' . $e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, string $uuid)
    {
        try {
            DB::beginTransaction();

            $category = BlogCategory::where('uuid', $uuid)->firstOrFail();
            $category->is_active = ! $category->is_active;
            $category->save();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($category->is_active ? 'activate' : 'deactivate')),
                config('constants.MODULES.blogcategory'),
                [
                    'subject_type' => BlogCategory::class,
                    'subject_id' => $category->id,
                    'description' => 'Blog category status toggled to ' . ($category->is_active ? 'active' : 'inactive') . '.',
                ]
            );

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $category->is_active]);
            }

            return back()->with('success', 'Blog category status updated.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('BlogCategory togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
