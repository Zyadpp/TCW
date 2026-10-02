@extends('layouts.user')

@section('title', $lesson->title)

@section('content')
<div class="learning-page">
    <section class="learning-primary lesson-primary">
        <header class="lesson-breadcrumb">
            <span><i class="bi bi-calendar3"></i> {{ optional($lesson->module->programme->start_date)->format('l, j M Y') ?? 'Monday, 4 Mar 2025' }}</span>
            <span><i class="bi bi-person-fill"></i> {{ $lesson->module->programme->instructor_name }}</span>
            <button type="button" aria-label="Share lesson"><i class="bi bi-share"></i></button>
        </header>
        <section class="video-stage lesson-video" aria-label="Lesson video">
            <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=1400&q=85" alt="{{ $lesson->title }}">
            <div class="video-overlay"></div>
            <div class="video-timeline"><span>1:42</span><div><i></i></div><span>2:20</span></div>
            <div class="video-player-controls"><i class="bi bi-play-circle-fill"></i><i class="bi bi-arrow-counterclockwise"></i><i class="bi bi-arrow-clockwise"></i><i class="bi bi-volume-up"></i><span></span><i class="bi bi-gear"></i><i class="bi bi-fullscreen"></i></div>
        </section>
        <section class="lesson-description">
            <em>{{ $lesson->module->title }}</em>
            <h1>{{ $lesson->title }}</h1>
            <p>{{ $lesson->description ?: 'This lesson covers practical techniques and tools to help you build a productive learning routine.' }}</p>
            <article class="lesson-task"><header><span>Write your 6 steps actions</span><b>1 Day Left</b></header><p>Let’s return to design thinking. Over time designers have built up their approaches to solve problems.</p><button type="button">View Details</button></article>
        </section>
    </section>
    <aside class="learning-side lesson-side">
        <section class="lesson-questions"><h2>Live Questions (Q&amp;A)</h2>@foreach(['What are the best techniques to overcome procrastination?','How can I create a daily routine that maximizes productivity?','What tools do you recommend for effective time management?'] as $question)<p>{{ $loop->iteration }}- {{ $question }}</p>@endforeach</section>
        @include('user.partials.poll')
    </aside>
</div>
@endsection
