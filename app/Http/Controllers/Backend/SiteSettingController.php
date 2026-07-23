<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SiteSettingController extends Controller
{
    private $pagerecords;

    private $prefix = 'backend.';

    private $folder = 'settings.sites.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $groups = SiteSetting::orderBy('group')->orderBy('key')->get()->groupBy('group');

        return view($this->prefix.$this->folder.'index', compact('groups'));
    }

    // Bulk save: one form, many settings
    public function saveorupdate(Request $request)
    {
        $settings = $request->input('settings', []);

        try {
            DB::transaction(function () use ($settings, $request) {
                foreach ($settings as $key => $value) {
                    $setting = SiteSetting::where('key', $key)->first();

                    if (! $setting) {
                        continue;
                    }

                    // Unchecked checkboxes are absent from payload
                    if ($setting->type === 'boolean') {
                        $value = $request->boolean("settings.$key");
                    }

                    $setting->update(['value' => $value]);
                }
            });

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.sitesetting'), [
                'description' => 'Updated site settings',
            ]);

            return redirect()->route('admin.settings.sites.index')->with('success', 'Site settings updated successfully.');
        } catch (\Throwable $e) {
            Log::error('SiteSetting saveorupdate failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
