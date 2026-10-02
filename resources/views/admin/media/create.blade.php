@extends('layouts.admin')
@section('content')
    <main class="create-reel-page">
        <header class="create-reel-heading">
            <h1><i class="bi bi-file-earmark-play"></i> Create A Reel</h1>
            <button type="button" aria-label="Filter"><i class="bi bi-funnel"></i></button>
        </header>

        <p class="create-reel-notice">Create a Reel and earn 500 points! ًں¥³</p>

        <form class="create-reel-card" action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <section class="reel-details">
                <h2>Reel Details</h2>
                <textarea name="description" placeholder="Describe your Reel.."></textarea>

                <select name="visibility" aria-label="Who can see this reel"><option>Friends</option><option>Public</option><option>Private</option></select>

                <div class="reel-divider"></div>

                <h2>Who can see it</h2>
                <button type="button" class="reel-setting">
                    <span><i class="bi bi-people"></i> Friends</span>
                    <i class="bi bi-chevron-right"></i>
                </button>

                <div class="reel-divider"></div>
                <button type="button" class="reel-setting reel-mention">
                    <span><i class="bi bi-at"></i> <b>Mention</b></span>
                    <i class="bi bi-chevron-right"></i>
                </button>

                <div class="reel-form-actions">
                    <a href="{{ route('media.index') }}">Cancel</a>
                    <button type="submit">Post reel</button>
                </div>
            </section>
            <label class="reel-upload-zone">
                <input type="file" name="video" accept="video/mp4,video/webm,video/quicktime" required>
                <i class="bi bi-camera-video-fill"></i>
                <strong>Add the video here</strong>
                <span>Or drag and drop.</span>
            </label>
        </form>
    </main>
@endsection
