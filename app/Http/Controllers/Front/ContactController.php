<?php

namespace App\Http\Controllers\Front;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    private $prefix = 'front.';
    private $folder = 'contact.';

    public function index()
    {
        $data = Helper::readJSONData($this->folder . 'json');

        return view($this->prefix . $this->folder . 'index', compact('data'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'message' => ['required', 'string'],
        ]);

        try {
            $enquiry = Enquiry::create([
                'uuid' => (string) Str::uuid(),
                'type' => 'contact',
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'message' => $data['message'],
                'source' => 'website',
                'status' => 'new',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.create'), config('constants.MODULES.enquiry'), [
                'subject_type' => Enquiry::class,
                'subject_id' => $enquiry->id,
                'is_system' => true,
                'description' => $enquiry->name . ' submitted a contact enquiry.',
            ]);

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Thanks! Your message has been noted.']);
            }

            return back()->with('success', 'Thanks! Your message has been noted.');
        } catch (\Throwable $e) {
            Log::error('Contact enquiry submit failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong. Please try again.'], 500);
            }

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
