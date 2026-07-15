<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
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

        return view($this->prefix . $this->folder . 'index', compact('rows'));
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
            'gallery_items.*.path' => ['nullable', 'string'],
            'gallery_items.*.temp' => ['nullable', 'string'],
            'gallery_items.*.alt' => ['nullable', 'string', 'max:255'],
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

            $data['gallery'] = $this->resolveGallery($request, $portfolio);

            $isNew = ! $portfolio;

            if ($portfolio) {
                $portfolio->fill($data);
                $portfolio->save();
            } else {
                $portfolio = Portfolio::create($data);
            }

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

    /**
     * Build the new gallery array from the submitted "gallery_items" rows —
     * each row is either a kept existing image (["path" => ..., "alt" => ...])
     * or a freshly cropped one (["temp" => ..., "alt" => ...]) promoted here.
     * Any existing image whose row didn't survive to submission (removed on
     * the form) gets its file deleted from disk.
     */
    private function resolveGallery(Request $request, ?Portfolio $portfolio): array
    {
        $existingPaths = array_column($portfolio->gallery ?? [], 'path');
        $rows = (array) $request->input('gallery_items', []);

        $result = [];
        $keptPaths = [];

        foreach ($rows as $row) {
            $alt = $row['alt'] ?? null;

            if (!empty($row['temp'])) {
                $path = $this->mediaUploader->promoteTemp($row['temp'], 'portfolios', null, $alt);

                if ($path) {
                    $result[] = ['path' => $path, 'alt' => $alt];
                }

                continue;
            }

            if (!empty($row['path'])) {
                $result[] = ['path' => $row['path'], 'alt' => $alt];
                $keptPaths[] = $row['path'];
            }
        }

        foreach (array_diff($existingPaths, $keptPaths) as $removedPath) {
            $this->mediaUploader->deleteSingle($removedPath);
        }

        return $result;
    }

    /**
     * The "json-auto" meta_keywords textarea posts a JSON-encoded array;
     * decode defensively and fall back to an empty array on bad input.
     */
    private function parseJsonList(?string $value): array
    {
        if (empty($value)) {
            return [];
        }

        $decoded = json_decode($value, true);

        return is_array($decoded) ? array_values($decoded) : [];
    }
}
