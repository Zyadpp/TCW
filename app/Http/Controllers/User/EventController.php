<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->input('search'));
        $events = Event::query()
            ->when($search !== '', fn ($query) => $query->where(fn ($events) => $events->where('title', 'like', "%{$search}%")->orWhere('description', 'like', "%{$search}%")))
            ->orderBy('event_date')->orderBy('start_time')->get();

        // The User LMS page follows the status selected by the admin. This keeps
        // configured demo events visible even after their displayed date passes.
        $upcomingEvents = $events->filter(fn ($event) => $event->status === 'Upcoming');
        $pastEvents = $events->filter(fn ($event) => in_array($event->status, ['Finished', 'Canceled'], true));
        $pastEvents->each(fn ($event) => $event->short_description = Str::limit($event->description, 110));
        $featuredEvent = $upcomingEvents->first() ?? $events->first();
        $alertedEventIds = $request->user()->eventAlerts()->pluck('event_id');
        $calendarMonth = ($featuredEvent?->event_date ?? now())->copy()->startOfMonth();
        $calendarPadding = $calendarMonth->dayOfWeekIso - 1;
        $calendarDays = collect(range(1, $calendarMonth->daysInMonth));

        return view('user.events', compact(
            'search',
            'upcomingEvents',
            'pastEvents',
            'featuredEvent',
            'alertedEventIds',
            'calendarMonth',
            'calendarPadding',
            'calendarDays',
        ));
    }

    public function toggleAlert(Request $request, Event $event)
    {
        $alert = $request->user()->eventAlerts()->where('event_id', $event->id)->first();
        if ($alert) { $alert->delete(); return back()->with('success', 'Event alert cancelled.'); }
        $request->user()->eventAlerts()->create(['event_id' => $event->id]);
        return back()->with('success', 'Event alert enabled.');
    }
}
