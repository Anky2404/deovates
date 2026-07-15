<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Skill;
use App\Models\Technology;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class SkillController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'skills.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    // Index Function
    public function index(Request $request)
    {
        $rows = Skill::latest('id')->paginate($this->pagerecords)->withQueryString();
        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    // Create / Edit Function
    public function createoredit(Request $request, $uuid = null)
    {
        $skill = null;

        if ($uuid) {
            try {
                $skill = Skill::where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('Skill createoredit lookup failed: ' . $e->getMessage(), ['exception' => $e]);
                return redirect()->route('admin.skills.index')->with('error', 'Unable to load the requested skill.');
            }
        }

        $technologies = Technology::active()->orderBy('name')->get(['id', 'name']);

        return view($this->prefix . $this->folder . 'createoredit', compact('skill', 'technologies'));
    }

    // Save / Update Function
    public function saveorupdate(Request $request, $uuid = null)
    {
        $skill = $uuid ? Skill::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('skills', 'slug')->ignore($skill?->id)],
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'type' => 'nullable|string|max:255',
            'technology_id' => 'nullable|exists:technologies,id',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'display_order' => 'nullable|integer|min:0',
            'usage_count' => 'nullable|integer|min:0',
        ]);

        $data['technology_id'] = $data['technology_id'] ?? null;
        $data['display_order'] = $data['display_order'] ?? 0;
        $data['usage_count'] = $data['usage_count'] ?? 0;
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        try {
            if ($skill) {
                $skill->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated skill ' . $skill->name;
            } else {
                $skill = Skill::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created skill ' . $skill->name;
            }

            ActivityLog::log($action, config('constants.MODULES.skill'), [
                'subject_type' => Skill::class,
                'subject_id' => $skill->id,
                'new_values' => $skill->getChanges(),
                'description' => $description,
            ]);

            return redirect()->route('admin.skills.index')->with('success', 'Skill saved successfully.');
        } catch (\Throwable $e) {
            Log::error('Skill saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Destroy Function
    public function destroy(Request $request, $uuid)
    {
        try {
            $skill = Skill::where('uuid', $uuid)->firstOrFail();
            $skill->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.skill'), [
                'subject_type' => Skill::class,
                'subject_id' => $skill->id,
                'description' => 'Deleted skill ' . $skill->name,
            ]);

            return back()->with('success', 'Skill deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Skill destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Toggle Status Function
    public function togglestatus(Request $request, $uuid)
    {
        try {
            $skill = Skill::where('uuid', $uuid)->firstOrFail();
            $skill->is_active = ! $skill->is_active;
            $skill->save();

            ActivityLog::log(
                $skill->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.skill'),
                [
                    'subject_type' => Skill::class,
                    'subject_id' => $skill->id,
                    'description' => ($skill->is_active ? 'Activated' : 'Deactivated') . ' skill ' . $skill->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $skill->is_active]);
            }

            return back()->with('success', 'Skill status updated.');
        } catch (\Throwable $e) {
            Log::error('Skill togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Toggle Featured Function
    public function togglefeatured(Request $request, $uuid)
    {
        try {
            $skill = Skill::where('uuid', $uuid)->firstOrFail();
            $skill->is_featured = ! $skill->is_featured;
            $skill->save();

            ActivityLog::log(
                $skill->is_featured ? config('constants.ACTIVITY_ACTIONS.feature') : config('constants.ACTIVITY_ACTIONS.unfeature'),
                config('constants.MODULES.skill'),
                [
                    'subject_type' => Skill::class,
                    'subject_id' => $skill->id,
                    'description' => ($skill->is_featured ? 'Marked featured' : 'Unmarked featured') . ' skill ' . $skill->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $skill->is_featured]);
            }

            return back()->with('success', 'Skill featured status updated.');
        } catch (\Throwable $e) {
            Log::error('Skill togglefeatured failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
