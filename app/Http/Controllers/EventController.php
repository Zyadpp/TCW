<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::query()
            ->when($request->filled('status') && $request->status !== 'All', fn ($query) => $query->where('status', $request->status))
            ->orderBy('event_date')
            ->orderBy('start_time')
            ->get();

        $counts = [
            'All' => Event::count(),
            'Finished' => Event::where('status', 'Finished')->count(),
            'Upcoming' => Event::where('status', 'Upcoming')->count(),
            'Canceled' => Event::where('status', 'Canceled')->count(),
        ];

        $featuredEvent = Event::where('status', 'Upcoming')->orderBy('event_date')->orderBy('start_time')->first();

        return view('admin.events.index', compact('events', 'counts', 'featuredEvent'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'creation_date' => ['required', 'date'],
            'event_date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'platform' => ['required', 'string', 'max:100'],
            'meeting_link' => ['nullable', 'url', 'max:255'],
            'coach_name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:Finished,Upcoming,Canceled'],
        ]);

        $event = Event::create(collect($validated)->except('creation_date')->all());
        $event->created_at = $validated['creation_date'];
        $event->save();

        return redirect()->route('events.index')->with('success', 'Event added successfully.');
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'], 'description' => ['required', 'string', 'max:1000'],
            'event_date' => ['required', 'date'], 'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'], 'platform' => ['required', 'string', 'max:100'],
            'meeting_link' => ['nullable', 'url', 'max:255'], 'coach_name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:Finished,Upcoming,Canceled'],
        ]);
        $event->update($validated);
        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
