@extends('layouts.user')
@section('title', 'Events')
@section('content')
<div class="user-events-page">
    <main class="user-events-main">
        <header class="user-events-topbar">
            <form class="user-events-search" method="GET"><i class="bi bi-search"></i><input name="search" value="{{ $search }}" placeholder="Search your course here..." aria-label="Search events"><button type="submit"><i class="bi bi-funnel"></i></button></form>
        </header>
        @if(session('success'))<p class="user-events-flash">{{ session('success') }}</p>@endif
        <section class="user-event-hero">
            <div>
                <p><i class="bi bi-calendar3"></i> {{ $featuredEvent ? $featuredEvent->event_date->format('l, j M Y') : 'No upcoming events' }} @if($featuredEvent) <span>&bull;</span> <i class="bi bi-clock"></i> {{ $featuredEvent->start_time->format('h:i') }}-{{ $featuredEvent->end_time->format('h:i A') }} @endif</p>
                <h1>{{ $featuredEvent?->title ?? 'Keep learning — new events will appear here.' }}</h1>@if($featuredEvent)<a href="{{ route('user.events.live', $featuredEvent) }}">Join now <i class="bi bi-play-circle-fill"></i></a>@endif
            </div>
            <div class="event-hero-dots"><b></b><i></i><i></i><i></i></div>
        </section>
        <section class="upcoming-panel">
            <h2>Upcoming Events</h2>@forelse($upcomingEvents as $event)<article class="user-event-row">
                <div class="event-date"><strong>{{ $event->event_date->format('d M') }}</strong><small>{{ $event->start_time->format('h:i') }}-{{ $event->end_time->format('h:i A') }}</small><em><i class="bi bi-camera-video"></i> {{ $event->platform }}</em></div>
                <div class="event-description">
                    <h3>{{ $event->title }}</h3>
                    <p>{{ $event->description }}</p><span><img src="https://i.pravatar.cc/40?u={{ urlencode($event->coach_name) }}" alt=""><b>{{ $event->coach_name }}</b><small>Coach</small></span>
                </div>
                <form action="{{ route('user.events.alert', $event) }}" method="POST">@csrf<button class="{{ $alertedEventIds->contains($event->id) ? 'alert-active' : '' }}" type="submit"><i class="bi bi-bell"></i> {{ $alertedEventIds->contains($event->id) ? 'Cancel Alert' : 'Get Alert' }}</button></form>
            </article>@empty <p class="events-none">No upcoming events{{ $search ? ' match your search' : '' }}.</p>@endforelse
        </section>
    </main>
    <aside class="user-events-side">
        <section class="mini-calendar">
            <header>
                <h2>{{ $calendarMonth->format('M Y') }}</h2><span><i class="bi bi-chevron-left"></i><i class="bi bi-chevron-right"></i></span>
            </header>
            <div class="calendar-weekdays"><span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span></div>
            <div class="calendar-days">
                @for($blank = 0; $blank < $calendarPadding; $blank++)
                    <span class="calendar-empty"></span>
                    @endfor
                    @foreach($calendarDays as $day)
                    @php($calendarDate = $calendarMonth->copy()->setDay($day))
                    <span class="{{ $upcomingEvents->contains(fn ($event) => $event->event_date->isSameDay($calendarDate)) ? 'has-event' : '' }}">{{ $day }}</span>
                    @endforeach
            </div>
        </section>
        <section class="past-events">
            <h2>Past Events</h2>@forelse($pastEvents as $event)<article>
                <h3>{{ $event->title }}</h3>
                <p>{{ $event->short_description }}</p><small><i class="bi bi-calendar3"></i> {{ $event->event_date->format('l, j M Y') }} &nbsp; <i class="bi bi-clock"></i> {{ $event->start_time->format('h:i') }}-{{ $event->end_time->format('h:i A') }}</small>
            </article>@empty <p class="events-none">No past events yet.</p>@endforelse
        </section>
    </aside>
</div>
@endsection
