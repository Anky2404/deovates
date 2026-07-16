<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class BlogCommentController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'blogs.comments.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = Comment::with(['blog', 'user'])
            ->latest('id')
            ->paginate($this->pagerecords)
            ->withQueryString();

        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    public function details(Request $request, string $uuid)
    {
        $row = Comment::with(['blog', 'user', 'parent', 'replies'])->where('uuid', $uuid)->firstOrFail();

        return view($this->prefix . $this->folder . 'details', ['comment' => $row]);
    }

    public function createoredit(Request $request, ?string $uuid = null)
    {
        $comment = $uuid ? Comment::where('uuid', $uuid)->firstOrFail() : null;

        $blogs = Blog::orderBy('title')->get(['id', 'title']);
        $users = User::orderBy('name')->get(['id', 'name']);

        return view($this->prefix . $this->folder . 'createoredit', compact('comment', 'blogs', 'users'));
    }

    public function saveorupdate(Request $request, ?string $uuid = null)
    {
        $comment = $uuid ? Comment::where('uuid', $uuid)->firstOrFail() : null;

        $validated = $request->validate([
            'blog_id' => ['required', 'exists:blogs,id'],
            'parent_id' => [
                'nullable',
                'integer',
                'exists:comments,id',
                Rule::notIn([$comment?->id]),
            ],
            'user_id' => ['nullable', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'comment' => ['required', 'string'],
            'status' => ['required', 'in:pending,approved,rejected'],
            'likes' => ['nullable', 'integer', 'min:0'],
            'dislikes' => ['nullable', 'integer', 'min:0'],
        ]);

        try {
            DB::beginTransaction();

            $comment = $comment ?? new Comment();
            $isNew = ! $comment->exists;

            $comment->fill([
                'blog_id' => $validated['blog_id'],
                'parent_id' => $validated['parent_id'] ?? null,
                'user_id' => $validated['user_id'] ?? null,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'website' => $validated['website'] ?? null,
                'comment' => $validated['comment'],
                'status' => $validated['status'],
                'likes' => $validated['likes'] ?? ($comment->likes ?? 0),
                'dislikes' => $validated['dislikes'] ?? ($comment->dislikes ?? 0),
                'is_reported' => $request->boolean('is_reported'),
            ]);

            if ($isNew) {
                $comment->ip_address = $request->ip();
                $comment->user_agent = $request->userAgent();
            }

            // bypasses mass assignment
            $comment->is_active = $request->boolean('is_active', true);

            $comment->save();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($isNew ? 'create' : 'update')),
                config('constants.MODULES.comment'),
                [
                    'subject_type' => Comment::class,
                    'subject_id' => $comment->id,
                    'new_values' => $comment->getChanges(),
                    'description' => ($isNew ? 'Created' : 'Updated') . " comment by \"{$comment->name}\".",
                ]
            );

            DB::commit();

            return redirect()->route('admin.blogs.comments.index')->with('success', 'Comment saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Comment saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $request, string $uuid)
    {
        try {
            DB::beginTransaction();

            $comment = Comment::where('uuid', $uuid)->firstOrFail();
            $comment->delete();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.delete'),
                config('constants.MODULES.comment'),
                [
                    'subject_type' => Comment::class,
                    'subject_id' => $comment->id,
                    'description' => "Deleted comment by \"{$comment->name}\".",
                ]
            );

            DB::commit();

            return back()->with('success', 'Comment deleted successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Comment destroy failed: ' . $e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, string $uuid)
    {
        try {
            DB::beginTransaction();

            $comment = Comment::where('uuid', $uuid)->firstOrFail();
            $comment->is_active = ! $comment->is_active;
            $comment->save();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($comment->is_active ? 'activate' : 'deactivate')),
                config('constants.MODULES.comment'),
                [
                    'subject_type' => Comment::class,
                    'subject_id' => $comment->id,
                    'description' => 'Comment status toggled to ' . ($comment->is_active ? 'active' : 'inactive') . '.',
                ]
            );

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $comment->is_active]);
            }

            return back()->with('success', 'Comment status updated.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Comment togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
