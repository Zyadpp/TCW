@extends('layouts.admin')

@section('content')
    <main class="tcw-media-page">
        <header class="tcw-media-heading">
            <h1>TCW Media <span>{{ $media->count() }} items</span></h1>
            <div class="tcw-media-heading-actions">
                
                <label class="tcw-select-toggle">
                    <input type="checkbox">
                    <span>Select</span>
                </label>
            </div>
        </header>
        @if (session('success'))<p class="settings-alert">{{ session('success') }}</p>@endif
        <section class="tcw-media-grid" aria-label="TCW Media library">
            @foreach ($media as $item)
 <article class="tcw-media-card">
 <div class="tcw-media-preview">
                        <video controls preload="metadata" src="{{ asset('storage/'.$item->video_path) }}"></video>
                        <span class="tcw-media-views">
                            <i class="bi bi-play-fill"></i> {{ $item->views }}
                        </span>
                    </div>

                    <div class="tcw-media-author">
                        <img src="https://i.pravatar.cc/80?img=47" alt="Noor Ali">
                        <div>
                            <strong>{{ $item->original_name }}</strong>
                            <small>{{ $item->created_at->format('d M, h:i A') }}</small>
                        </div>
                    </div>

                    <div class="tcw-media-actions">
                        <form action="{{ route('media.update', $item) }}" method="POST">@csrf @method('PUT')<input type="hidden" name="description" value="{{ $item->description }}"><input type="hidden" name="visibility" value="{{ $item->visibility }}"><input type="hidden" name="status" value="Published"><button class="publish-button"><i class="bi bi-check-lg"></i> Publish</button></form>
                        <form action="{{ route('media.update', $item) }}" method="POST">@csrf @method('PUT')<input type="hidden" name="description" value="{{ $item->description }}"><input type="hidden" name="visibility" value="{{ $item->visibility }}"><input type="hidden" name="status" value="Rejected"><button class="reject-button"><i class="bi bi-x-lg"></i> Reject</button></form>
                        <form action="{{ route('media.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this reel?')">@csrf @method('DELETE')<button type="submit">Delete</button></form>
                    </div>
                </article>
            @endforeach
        </section>
        {{ $media->links() }}
    </main>
@endsection
