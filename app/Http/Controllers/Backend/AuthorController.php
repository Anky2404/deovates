<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Author;
use App\Services\MediaUploader;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AuthorController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'authors.';

    public function __construct(private MediaUploader $mediaUploader)
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = Author::latest('id')->paginate($this->pagerecords)->withQueryString();
        $reorderRows = Author::orderBy('display_order')->orderBy('id')->get();
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
                    Author::where('uuid', $uuid)->update(['display_order' => $position + 1]);
                }
            });

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.author'), [
                'description' => 'Reordered authors',
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('Author reorder failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    public function createoredit(Request $request, $uuid = null)
    {
        $author = null;

        if ($uuid) {
            try {
                $author = Author::where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('Author createoredit lookup failed: ' . $e->getMessage(), ['exception' => $e]);
                return redirect()->route('admin.authors.index')->with('error', 'Unable to load the requested author.');
            }
        }

        return view($this->prefix . $this->folder . 'createoredit', compact('author'));
    }

    public function saveorupdate(Request $request, $uuid = null)
    {
        $author = $uuid ? Author::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('authors', 'slug')->ignore($author?->id)],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('authors', 'email')->ignore($author?->id)],
            'phone' => 'nullable|string|max:50',
            'designation' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'bio' => 'nullable|string',
            'social_links' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'total_blogs' => 'nullable|integer|min:0',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'profile_image' => 'nullable|image|max:4096',
            'cover_image' => 'nullable|image|max:4096',
        ]);

        // guards against bad JSON
        $decodedSocialLinks = json_decode($data['social_links'] ?? '', true);
        $data['social_links'] = is_array($decodedSocialLinks) ? $decodedSocialLinks : [];

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');
        $data['total_blogs'] = $data['total_blogs'] ?? 0;

        try {
            $newUuid = null;

            if (!$author) {
                $newUuid = (string) Str::uuid();
                $data['uuid'] = $newUuid;
            }

            $uuidForUpload = $author?->uuid ?? $newUuid;

            if ($request->hasFile('profile_image')) {
                $data['profile_image'] = $this->mediaUploader->uploadSingle(
                    $request->file('profile_image'),
                    'authors',
                    $author->profile_image ?? null,
                    [],
                    null,
                    $uuidForUpload
                );
            }

            if ($request->hasFile('cover_image')) {
                $data['cover_image'] = $this->mediaUploader->uploadSingle(
                    $request->file('cover_image'),
                    'authors',
                    $author->cover_image ?? null,
                    [],
                    null,
                    $uuidForUpload
                );
            }

            if ($author) {
                $author->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated author ' . $author->name;
            } else {
                $author = Author::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created author ' . $author->name;
            }

            ActivityLog::log($action, config('constants.MODULES.author'), [
                'subject_type' => Author::class,
                'subject_id' => $author->id,
                'new_values' => $author->getChanges(),
                'description' => $description,
            ]);

            return redirect()->route('admin.authors.index')->with('success', 'Author saved successfully.');
        } catch (\Throwable $e) {
            Log::error('Author saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $request, $uuid)
    {
        try {
            $author = Author::where('uuid', $uuid)->firstOrFail();
            $author->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.author'), [
                'subject_type' => Author::class,
                'subject_id' => $author->id,
                'description' => 'Deleted author ' . $author->name,
            ]);

            return back()->with('success', 'Author deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Author destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, $uuid)
    {
        try {
            $author = Author::where('uuid', $uuid)->firstOrFail();
            $author->is_active = ! $author->is_active;
            $author->save();

            ActivityLog::log(
                $author->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.author'),
                [
                    'subject_type' => Author::class,
                    'subject_id' => $author->id,
                    'description' => ($author->is_active ? 'Activated' : 'Deactivated') . ' author ' . $author->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $author->is_active]);
            }

            return back()->with('success', 'Author status updated.');
        } catch (\Throwable $e) {
            Log::error('Author togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglefeatured(Request $request, $uuid)
    {
        try {
            $author = Author::where('uuid', $uuid)->firstOrFail();
            $author->is_featured = ! $author->is_featured;
            $author->save();

            ActivityLog::log(
                $author->is_featured ? config('constants.ACTIVITY_ACTIONS.feature') : config('constants.ACTIVITY_ACTIONS.unfeature'),
                config('constants.MODULES.author'),
                [
                    'subject_type' => Author::class,
                    'subject_id' => $author->id,
                    'description' => ($author->is_featured ? 'Marked featured' : 'Unmarked featured') . ' author ' . $author->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $author->is_featured]);
            }

            return back()->with('success', 'Author featured status updated.');
        } catch (\Throwable $e) {
            Log::error('Author togglefeatured failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
