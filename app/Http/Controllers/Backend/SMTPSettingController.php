<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\SMTPSetting;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class SMTPSettingController extends Controller
{
    private $pagerecords;

    private $prefix = 'backend.';

    private $folder = 'settings.smtp.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = SMTPSetting::latest('id')->paginate($this->pagerecords)->withQueryString();

        return view($this->prefix.$this->folder.'index', compact('rows'));
    }

    public function createoredit(Request $request, $uuid = null)
    {
        $smtpSetting = null;

        if ($uuid) {
            try {
                $smtpSetting = SMTPSetting::where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('SMTPSetting createoredit lookup failed: '.$e->getMessage(), ['exception' => $e]);

                return redirect()->route('admin.settings.smtp.index')->with('error', 'Unable to load the requested SMTP setting.');
            }
        }

        return view($this->prefix.$this->folder.'createoredit', compact('smtpSetting'));
    }

    public function saveorupdate(Request $request, $uuid = null)
    {
        $smtpSetting = $uuid ? SMTPSetting::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('smtp_settings', 'name')->ignore($smtpSetting?->id)],
            'driver' => 'required|string|max:50',
            'host' => 'required|string|max:255',
            'port' => 'required|integer|min:1|max:65535',
            'encryption' => 'nullable|string|max:20',
            'username' => 'nullable|string|max:255',
            'password' => 'nullable|string|max:255',
            'from_email' => 'required|email|max:255',
            'from_name' => 'required|string|max:255',
            'is_default' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        // Blank password keeps stored one
        if (empty($data['password'])) {
            unset($data['password']);
        }

        $data['is_default'] = $request->boolean('is_default');
        $data['is_active'] = $request->boolean('is_active');

        try {
            if ($smtpSetting) {
                $smtpSetting->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated SMTP setting '.$smtpSetting->name;
            } else {
                $data['created_by'] = Auth::guard('admin')->id();
                $smtpSetting = SMTPSetting::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created SMTP setting '.$smtpSetting->name;
            }

            ActivityLog::log($action, config('constants.MODULES.smtpsetting'), [
                'subject_type' => SMTPSetting::class,
                'subject_id' => $smtpSetting->id,
                'description' => $description,
            ]);

            return redirect()->route('admin.settings.smtp.index')->with('success', 'SMTP setting saved successfully.');
        } catch (\Throwable $e) {
            Log::error('SMTPSetting saveorupdate failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $request, $uuid)
    {
        try {
            $smtpSetting = SMTPSetting::where('uuid', $uuid)->firstOrFail();
            $smtpSetting->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.smtpsetting'), [
                'subject_type' => SMTPSetting::class,
                'subject_id' => $smtpSetting->id,
                'description' => 'Deleted SMTP setting '.$smtpSetting->name,
            ]);

            return back()->with('success', 'SMTP setting deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('SMTPSetting destroy failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, $uuid)
    {
        try {
            $smtpSetting = SMTPSetting::where('uuid', $uuid)->firstOrFail();
            $smtpSetting->is_active = ! $smtpSetting->is_active;
            $smtpSetting->save();

            ActivityLog::log(
                $smtpSetting->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.smtpsetting'),
                [
                    'subject_type' => SMTPSetting::class,
                    'subject_id' => $smtpSetting->id,
                    'description' => ($smtpSetting->is_active ? 'Activated' : 'Deactivated').' SMTP setting '.$smtpSetting->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $smtpSetting->is_active]);
            }

            return back()->with('success', 'SMTP setting status updated.');
        } catch (\Throwable $e) {
            Log::error('SMTPSetting togglestatus failed: '.$e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
