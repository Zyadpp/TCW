@extends('layouts.user')
@section('title', 'My Learning Dashboard')
@section('content')
<div class="student-dashboard">
    <main class="student-main">
        <header class="student-topbar">
            <form class="student-search" method="GET" action="{{ route('user.dashboard') }}"><i class="bi bi-search"></i><input type="search" name="search" value="{{ $search }}" placeholder="Search your Programme here..." aria-label="Search your programmes"><button type="submit" aria-label="Search"><i class="bi bi-funnel"></i></button></form>
        </header>
        <section class="student-event-hero">
            <div class="student-event-copy">
                <p><i class="bi bi-calendar3"></i> {{ $featuredEvent ? $featuredEvent->event_date->format('l, j M Y') : 'Monday, 4 Mar 2025' }} <span>•</span> <i class="bi bi-clock"></i> {{ $featuredEvent ? $featuredEvent->start_time->format('h:i') . '-' . $featuredEvent->end_time->format('h:i A') : '02:00-03:30 PM' }}</p>
                <h1>{{ $featuredEvent?->title ?? 'Join our live event to master time management and achieve peak productivity!' }}</h1>@if($featuredEvent)<a class="student-join" href="{{ route('user.events.live', $featuredEvent) }}">Join now <i class="bi bi-play-circle-fill"></i></a>@else<button class="student-join" type="button">Join now <i class="bi bi-play-circle-fill"></i></button>@endif
            </div>
            <div class="hero-pagination"><span class="active"></span><span></span><span></span><span></span></div>
        </section>
        <section class="student-section">
            <div class="student-section-heading">
                <h2>Continue Watching</h2>
                <div><button type="button"><i class="bi bi-chevron-left"></i></button><button class="dark" type="button"><i class="bi bi-chevron-right"></i></button></div>
            </div>
            <div class="watching-grid">@forelse($continueWatching as $item)@php($lesson = $item->lesson)<article class="lesson-card">
                    <div class="lesson-image"><img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=600&q=80" alt="{{ $lesson->title }}"><span><i class="bi bi-heart"></i></span></div>
                    <div class="lesson-card-body">
                        <div class="lesson-meta"><em>{{ $lesson->module->title }}</em><small><i class="bi bi-clock"></i> {{ $lesson->duration_seconds ? gmdate('G:i:s', $lesson->duration_seconds) : 'Self paced' }}</small></div>
                        <h3>{{ $lesson->title }}</h3>
                        <div class="lesson-progress"><span class="lesson-progress-value" data-progress="{{ $item->progress_percent }}"></span></div>
                        <div class="lesson-coach"><img src="https://i.pravatar.cc/40?u={{ urlencode($lesson->module->programme->instructor_name) }}" alt=""><span><strong>{{ $lesson->module->programme->instructor_name }}</strong><small>Coach</small></span></div>
                    </div>
                </article>@empty @foreach(['Lesson 6','Lesson 2','Inner Circle'] as $title)<article class="lesson-card">
                    <div class="lesson-image"><img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=600&q=80" alt=""><span><i class="bi bi-heart"></i></span></div>
                    <div class="lesson-card-body">
                        <div class="lesson-meta"><em>Start learning</em><small><i class="bi bi-clock"></i> 2 h : 30 m</small></div>
                        <h3>{{ $title }}</h3>
                        <div class="lesson-progress"><span></span></div>
                        <div class="lesson-coach"><img src="https://i.pravatar.cc/40?u=coach-{{ $loop->index }}" alt=""><span><strong>TCW Coach</strong><small>Coach</small></span></div>
                    </div>
                </article>@endforeach @endforelse</div>
        </section>
        <section class="student-section programme-section">
            <div class="student-section-heading">
                <h2>My Programme's</h2><a href="#">See All</a>
            </div>
            <div class="programme-list">
                <div class="programme-list-head"><span>PROGRAMME NAME</span><span>DETAILS</span><span>PROCESS</span><span>ACTIONS</span></div>@forelse($enrollments as $enrollment)<article class="student-programme-row">
                    <div class="programme-coach"><img src="https://i.pravatar.cc/40?u={{ urlencode($enrollment->programme->instructor_name) }}" alt=""><span><strong>{{ $enrollment->programme->instructor_name }}</strong><small>Coach</small></span></div>
                    <p>{{ $enrollment->completed_count }}/{{ $enrollment->lesson_count }} Watched</p>
                    <p>{{ $enrollment->programme->title }}</p><button type="button">SHOW LESSONS</button>
                </article>@empty <article class="student-programme-empty">{{ $search ? 'No programmes match your search.' : 'You are not enrolled in a programme yet.' }}</article>@endforelse
            </div>
        </section>
    </main>
    <aside class="student-profile-column">
        <section class="profile-card">
            <header>
                <h2>Your Profile</h2><span><i class="bi bi-calendar3"></i><i class="bi bi-three-dots-vertical"></i></span>
            </header><img class="profile-avatar" src="https://i.pravatar.cc/160?u={{ urlencode($user->email) }}" alt="{{ $user->name }}">
            <h3>Good Morning {{ strtok($user->name, ' ') }}</h3>
            <p>Continue Your Journey And Achieve<br>Your Target</p>
            <div class="profile-stats"><span><i class="bi bi-bell"></i><b>{{ $unreadMessages }}</b><small>Notification</small></span><span><i class="bi bi-bullseye"></i><b>0</b><small>Points</small></span><span><i class="bi bi-trophy"></i><b>0</b><small>Rewards</small></span></div>
            <div class="profile-chart">
                <div>23 h</div><svg viewBox="0 0 220 100" preserveAspectRatio="none">
                    <path d="M0 82 L15 55 L30 70 L45 58 L60 61 L75 39 L90 85 L105 90 L120 48 L135 62 L150 35 L165 45 L180 20 L195 55 L210 48 L220 56 L220 100 L0 100Z"></path>
                    <polyline points="0,82 15,55 30,70 45,58 60,61 75,39 90,85 105,90 120,48 135,62 150,35 165,45 180,20 195,55 210,48 220,56"></polyline>
                </svg><small>Mon　 Tue　 Wed　 Thu　 Fri　 Sat　 Sun</small>
            </div>
        </section>
        <section class="mentor-card">
            <header>
                <h2>Your Mentor</h2><button type="button"><i class="bi bi-plus"></i></button>
            </header>
            <div class="mentor-info"><img src="https://i.pravatar.cc/48?u={{ urlencode($mentor?->email ?? 'tcw-mentor') }}" alt=""><span><strong>{{ $mentor?->name ?? 'Mentor not assigned' }}</strong><small>Mentor</small></span>@if($mentor)<a href="mailto:{{ $mentor->email }}">Contact Now</a>@endif</div>
        </section>
    </aside>
</div>
<script>
    document.querySelectorAll('.lesson-progress-value').forEach((progress) => {
        progress.style.width = `${Math.min(100, Math.max(0, Number(progress.dataset.progress) || 0))}%`;
    });
</script>
@endsection
