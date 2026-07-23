<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\EmailTemplate;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class EmailTemplateController extends Controller
{
    private $pagerecords;

    private $prefix = 'backend.';

    private $folder = 'emails.templates.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = EmailTemplate::latest('id')->paginate($this->pagerecords)->withQueryString();

        return view($this->prefix.$this->folder.'index', compact('rows'));
    }

    public function details(Request $request, string $uuid)
    {
        $template = EmailTemplate::where('uuid', $uuid)->firstOrFail();

        if ($request->expectsJson()) {
            return response()->json([
                'id' => $template->id,
                'subject' => $template->subject,
                'body' => $template->body,
            ]);
        }

        return view($this->prefix.$this->folder.'details', compact('template'));
    }

    public function createoredit(?string $uuid = null)
    {
        $template = null;

        if ($uuid) {
            try {
                $template = EmailTemplate::where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('EmailTemplate createoredit lookup failed: '.$e->getMessage(), ['exception' => $e]);

                return redirect()->route('admin.emails.templates.index')->with('error', 'Unable to load the requested template.');
            }
        }

        return view($this->prefix.$this->folder.'createoredit', compact('template'));
    }

    public function saveorupdate(Request $request, ?string $uuid = null)
    {
        $template = $uuid ? EmailTemplate::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('email_templates', 'slug')->ignore($template?->id)],
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'variables' => ['nullable', 'string'],
            'type' => ['nullable', 'string', 'max:255'],
            'module' => ['nullable', 'string', 'max:255'],
            'language' => ['nullable', 'string', 'max:10'],
            'is_active' => ['nullable'],
            'is_default' => ['nullable'],
        ]);

        // The compose-time JS already normalizes this to a JSON array
        // string, but never trust the client — decode safely regardless.
        $decodedVariables = json_decode($data['variables'] ?? '', true);
        $data['variables'] = is_array($decodedVariables) ? $decodedVariables : [];

        $data['language'] = $data['language'] ?? 'en';
        $data['is_active'] = $request->boolean('is_active', true);
        $data['is_default'] = $request->boolean('is_default');

        try {
            if ($template) {
                $template->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated email template '.$template->name;
            } else {
                $template = EmailTemplate::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created email template '.$template->name;
            }

            ActivityLog::log($action, config('constants.MODULES.emailtemplate'), [
                'subject_type' => EmailTemplate::class,
                'subject_id' => $template->id,
                'new_values' => $template->getChanges(),
                'description' => $description,
            ]);

            return redirect()->route('admin.emails.templates.index')->with('success', 'Email template saved successfully.');
        } catch (\Throwable $e) {
            Log::error('EmailTemplate saveorupdate failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Stateless render used by the live "envelope" preview on the compose
    // and template-editor pages — takes whatever the admin has typed so far
    // (not yet saved) and returns the fully branded HTML for the iframe.
    public function preview(Request $request)
    {
        $validated = $request->validate([
            'subject' => ['nullable', 'string', 'max:255'],
            'body' => ['nullable', 'string'],
        ]);

        return response()
            ->view('emails.layout', [
                'subject' => $validated['subject'] ?? 'Your Subject Here',
                'body' => $validated['body'] ?? '<p>Nothing to preview yet.</p>',
            ])
            ->header('Content-Type', 'text/html');
    }

    public function destroy(Request $request, string $uuid)
    {
        try {
            $template = EmailTemplate::where('uuid', $uuid)->firstOrFail();
            $template->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.emailtemplate'), [
                'subject_type' => EmailTemplate::class,
                'subject_id' => $template->id,
                'description' => 'Deleted email template '.$template->name,
            ]);

            return back()->with('success', 'Email template deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('EmailTemplate destroy failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, string $uuid)
    {
        try {
            $template = EmailTemplate::where('uuid', $uuid)->firstOrFail();
            $template->is_active = ! $template->is_active;
            $template->save();

            ActivityLog::log(
                $template->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.emailtemplate'),
                [
                    'subject_type' => EmailTemplate::class,
                    'subject_id' => $template->id,
                    'description' => ($template->is_active ? 'Activated' : 'Deactivated').' email template '.$template->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $template->is_active]);
            }

            return back()->with('success', 'Template status updated.');
        } catch (\Throwable $e) {
            Log::error('EmailTemplate togglestatus failed: '.$e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
