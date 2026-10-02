<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $progress = $user->lessonProgress()
            ->with('lesson.module.programme')
            ->latest('updated_at')
            ->get();

        $continueWatching = $progress
            ->filter(fn ($item) => $item->progress_percent < 100 && $item->lesson?->module?->programme)
            ->take(3);

        $search = trim((string) $request->input('search'));

        $enrollments = $user->programmeEnrollments()
            ->with('programme.modules.lessons')
            ->where('status', 'Active')
            ->when($search !== '', fn ($query) => $query->whereHas('programme', fn ($programme) => $programme->where('title', 'like', "%{$search}%")))
            ->latest('enrolled_at')
            ->get()
            ->map(function ($enrollment) use ($progress) {
                $lessonIds = $enrollment->programme->modules->flatMap->lessons->pluck('id');
                $lessonCount = $lessonIds->count();
                $completedCount = $progress->whereIn('lesson_id', $lessonIds)
                    ->filter(fn ($item) => $item->progress_percent >= 100)
                    ->count();

                $enrollment->lesson_count = $lessonCount;
                $enrollment->completed_count = $completedCount;
                $enrollment->progress_percent = $lessonCount ? (int) round(($completedCount / $lessonCount) * 100) : 0;

                return $enrollment;
            });

        $mentor = $user->studentAssignments()->with('mentor')->latest('assigned_at')->first()?->mentor;
        $featuredEvent = Event::where('status', 'Upcoming')->orderBy('event_date')->orderBy('start_time')->first();
        $unreadMessages = $user->inboxMessages()->where('sent_by_admin', true)->whereNull('read_at')->count();

        return view('user.dashboard', compact('user', 'continueWatching', 'enrollments', 'mentor', 'featuredEvent', 'search', 'unreadMessages'));
    }
}
