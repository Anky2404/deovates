<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'name' => ['nullable', 'string', 'max:255'],
        ]);

        try {
            $subscriber = NewsletterSubscriber::withTrashed()->firstOrNew(['email' => $data['email']]);

            if ($subscriber->trashed()) {
                $subscriber->restore();
            }

            $wasNew = ! $subscriber->exists;

            $subscriber->fill([
                'uuid' => $subscriber->uuid ?? (string) Str::uuid(),
                'name' => $data['name'] ?? $subscriber->name,
                'is_active' => true,
                'subscribed_at' => $subscriber->subscribed_at ?? now(),
                'unsubscribed_at' => null,
                'source' => $subscriber->source ?? 'website',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ])->save();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.create'), config('constants.MODULES.newslettersubscriber'), [
                'subject_type' => NewsletterSubscriber::class,
                'subject_id' => $subscriber->id,
                'is_system' => true,
                'description' => ($wasNew ? 'New newsletter subscription: ' : 'Newsletter re-subscription: ') . $subscriber->email,
            ]);

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Thanks for subscribing to our newsletter!']);
            }

            return back()->with('success', 'Thanks for subscribing to our newsletter!');
        } catch (\Throwable $e) {
            Log::error('Newsletter subscribe failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong. Please try again.'], 500);
            }

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
