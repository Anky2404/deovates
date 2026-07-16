<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Page;
use App\Models\PageContent;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PageContentController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'pages.contents.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = PageContent::with(['page', 'form'])
            ->latest('id')
            ->paginate($this->pagerecords)
            ->withQueryString();

        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    public function createoredit(Request $request, $uuid = null)
    {
        $pageContent = null;

        if ($uuid) {
            try {
                $pageContent = PageContent::where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('PageContent createoredit lookup failed: ' . $e->getMessage(), ['exception' => $e]);
                return redirect()->route('admin.pages.contents.index')->with('error', 'Unable to load the requested content.');
            }
        }

        $pages = Page::with('forms.fields')->orderBy('name')->get();

        return view($this->prefix . $this->folder . 'createoredit', compact('pageContent', 'pages'));
    }

    public function saveorupdate(Request $request, $uuid = null)
    {
        $pageContent = $uuid ? PageContent::where('uuid', $uuid)->firstOrFail() : null;

        $validated = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'form_id' => 'required|exists:forms,id',
            'content' => 'nullable|array',
        ]);

        $userId = auth('admin')->id();

        $data = [
            'page_id' => $validated['page_id'],
            'form_id' => $validated['form_id'],
            'content' => $validated['content'] ?? [],
            'is_active' => true,
            'updated_by' => $userId,
        ];

        try {
            if ($pageContent) {
                $pageContent->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated page content #' . $pageContent->id;
            } else {
                $data['created_by'] = $userId;
                $data['display_order'] = (PageContent::where('page_id', $validated['page_id'])->max('display_order') ?? 0) + 1;
                $pageContent = PageContent::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created page content #' . $pageContent->id;
            }

            ActivityLog::log($action, config('constants.MODULES.pagecontent'), [
                'subject_type' => PageContent::class,
                'subject_id' => $pageContent->id,
                'new_values' => $pageContent->getChanges(),
                'description' => $description,
            ]);

            return redirect()->route('admin.pages.contents.index')->with('success', 'Page content saved successfully.');
        } catch (\Throwable $e) {
            Log::error('PageContent saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $request, $uuid)
    {
        try {
            $pageContent = PageContent::where('uuid', $uuid)->firstOrFail();
            $pageContent->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.pagecontent'), [
                'subject_type' => PageContent::class,
                'subject_id' => $pageContent->id,
                'description' => 'Deleted page content #' . $pageContent->id,
            ]);

            return back()->with('success', 'Page content deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('PageContent destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, $uuid)
    {
        try {
            $pageContent = PageContent::where('uuid', $uuid)->firstOrFail();
            $pageContent->is_active = ! $pageContent->is_active;
            $pageContent->save();

            ActivityLog::log(
                $pageContent->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.pagecontent'),
                [
                    'subject_type' => PageContent::class,
                    'subject_id' => $pageContent->id,
                    'description' => ($pageContent->is_active ? 'Activated' : 'Deactivated') . ' page content #' . $pageContent->id,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $pageContent->is_active]);
            }

            return back()->with('success', 'Page content status updated.');
        } catch (\Throwable $e) {
            Log::error('PageContent togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
