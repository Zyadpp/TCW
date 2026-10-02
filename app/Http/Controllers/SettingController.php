<?php

namespace App\Http\Controllers;

use App\Models\PlatformSetting;
use App\Models\Blog;
use App\Models\PointAction;
use App\Models\SupportTicket;
use App\Models\ContentComment;
use App\Models\ChatbotFile;
use App\Models\ChatbotQuestion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function index(): View
    {
        $settings = $this->settings();

        return view('admin.settings.index', compact('settings'));
    }

    public function notification(): View
    {
        $settings = $this->settings();

        return view('admin.settings.notification', compact('settings'));
    }

    public function updateNotifications(Request $request): RedirectResponse
    {
        $data = $request->validate(['notifications' => ['nullable', 'array'], 'notifications.*' => ['boolean']]);
        $this->settings()->update(['notification_preferences' => collect($data['notifications'] ?? [])->map(fn ($value) => (bool) $value)->all()]);
        return to_route('settings.notification')->with('success', 'Notification settings saved.');
    }

    public function points(): View
    {
        $settings = $this->settings();

        $pointActions = PointAction::where('type', 'points')->latest()->get();
        $rewardActions = PointAction::where('type', 'reward')->latest()->get();
        return view('admin.settings.points', compact('settings', 'pointActions', 'rewardActions'));
    }

    public function blogs(): View
    {
        $settings = $this->settings();

        $blogs = Blog::latest()->get();
        return view('admin.settings.blogs', compact('settings', 'blogs'));
    }

    public function support(): View
    {
        $settings = $this->settings();

        $tickets = SupportTicket::with('user')->latest()->get();
        return view('admin.settings.support', compact('settings', 'tickets'));
    }

    public function comments(): View
    {
        $settings = $this->settings();

        $comments = ContentComment::with('user')->latest()->get();
        return view('admin.settings.comments', compact('settings', 'comments'));
    }

    public function chatbot(): View
    {
        $settings = $this->settings();

        $questions = ChatbotQuestion::latest()->get();
        $files = ChatbotFile::latest()->get();
        return view('admin.settings.chatbot', compact('settings', 'questions', 'files'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'platform_name' => ['nullable', 'string', 'max:120'],
            'primary_phone' => ['nullable', 'string', 'max:40'],
            'secondary_phone' => ['nullable', 'string', 'max:40'],
            'email' => ['nullable', 'email', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'snapchat_url' => ['nullable', 'url', 'max:255'],
            'tiktok_url' => ['nullable', 'url', 'max:255'],
        ]);

        $settings = PlatformSetting::firstOrCreate([], [
            'platform_name' => 'Tcw Platform',
        ]);

        if (blank($validated['platform_name'] ?? null)) {
            unset($validated['platform_name']);
        }

        $settings->update($validated);

        return to_route('settings.index')->with('success', 'Settings saved successfully.');
    }

    private function settings(): PlatformSetting
    {
        return PlatformSetting::firstOrCreate([], [
            'platform_name' => 'Tcw Platform',
        ]);
    }
}
