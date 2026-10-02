@extends('layouts.user')

@section('title', $event->title)

@section('content')
<div class="learning-page">
    <section class="learning-primary">
        <header class="learning-header">
            <div>
                <h1>{{ $event->title }}</h1>
                @if($event->meeting_link)<a href="{{ $event->meeting_link }}" target="_blank" rel="noopener"><i class="bi bi-copy"></i> {{ $event->meeting_link }}</a>@endif
            </div>
            <button type="button" aria-label="Share event"><i class="bi bi-share"></i></button>
        </header>

        <section class="video-stage" aria-label="Live event video">
            <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=1400&q=85" alt="{{ $event->coach_name }} leading the event">
            <div class="video-overlay"></div>
            <div class="video-controls">
                <button type="button"><i class="bi bi-box-arrow-up"></i></button>
                <button type="button"><i class="bi bi-camera-video-fill"></i></button>
                <button class="hangup" type="button"><i class="bi bi-telephone-x-fill"></i></button>
                <button type="button"><i class="bi bi-mic-fill"></i></button>
                <button type="button"><i class="bi bi-fullscreen"></i></button>
            </div>
        </section>

        <section class="qa-card">
            <h2>Live Questions (Q&amp;A)</h2>
            @foreach([
                'What are the best techniques to overcome procrastination?',
                'How can I create a daily routine that maximizes productivity?',
                'What tools do you recommend for effective time management?',
            ] as $question)
                <label>{{ $loop->iteration }}- {{ $question }}<input type="text" placeholder="Type your answer..."></label>
            @endforeach
        </section>
    </section>

    <aside class="learning-side">
        <section class="messages-card">
            <h2>Messages</h2>
            <p class="message-tab">Messages</p>
            <div class="chat-message"><img src="https://i.pravatar.cc/48?u=casey" alt=""><div><b>Casey</b><p>Lorem ipsum dolor sit amet</p><small>10:42 AM</small></div></div>
            <div class="chat-message"><img src="https://i.pravatar.cc/48?u=john" alt=""><div><b>John</b><p>Lorem ipsum!</p><small>10:42 AM</small></div></div>
            <div class="chat-message mine"><div><b>You</b><p>Lorem ipsum dolor sit amet &nbsp; 👍</p><small>10:50 AM</small></div></div>
            <p class="typing">John is typing...</p>
            <form class="message-input" onsubmit="return false"><i class="bi bi-emoji-smile"></i><i class="bi bi-paperclip"></i><input placeholder="Type a message"><button aria-label="Send"><i class="bi bi-send-fill"></i></button></form>
        </section>

        @include('user.partials.poll')
    </aside>
</div>
@endsection
