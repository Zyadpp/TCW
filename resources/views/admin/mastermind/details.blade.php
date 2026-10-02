@extends('layouts.admin')
@section('content')
    <div class="mastermind-page">
        <div class="mastermind-title-row">
        <h1>Master mind</h1>
        </div>
        <div class="mastermind-workspace">
            <aside class="mastermind-groups-panel">
                <div class="mastermind-groups-heading">
                Groups <span>{{ $groups->total() }}</span>
                </div>
                <div class="mastermind-group-list">
                    @forelse ($groups as $group)
                        <a href="{{ route('mastermind.details', $group) }}"
                        class="mastermind-group-item {{ $selectedGroup?->is($group) ? 'is-selected' : '' }}">
                        <div class="mastermind-group-top">
                        <strong>{{ $group->name }}</strong>
                        <time>{{ $group->created_at->diffForHumans() }}</time>
                        </div>
                        <p>{{ $group->instructor_name }} <i>
                        </i> Coach</p>
                        <span class="mastermind-group-description">
                            A focused space for members to learn, share progress, and grow together.
                        </span>
                        <div class="mastermind-member-stack">
                            @foreach ($group->members->take(4) as $member)
                                <img src="https://i.pravatar.cc/48?u={{ urlencode($member->email) }}" alt="{{ $member->name }}">
                            @endforeach
                            @if ($group->members->count() > 4)
                            <b>+{{ $group->members->count() - 4 }}</b>
                            @endif
                        </div>
                    </a>
                @empty
                <div class="mastermind-no-groups">No groups yet.</div>
                @endforelse
            </div>
        </aside>
        <section class="mastermind-chat-panel">
            @if ($selectedGroup)
                <header class="mastermind-chat-header">
                    <div>
                    <h2>{{ $selectedGroup->name }}</h2>
                        <p>
                        <span>{{ $selectedGroup->instructor_name }}</span>
                            <i>
                        </i> Coach</p>
                    </div>
                    <button type="button" class="mastermind-search-button" aria-label="Search group messages">
                        <i class="bi bi-search">
                        </i>
                    </button>
                </header>
                <div class="mastermind-messages">
                    @forelse ($messages as $message)
                        <div class="mastermind-message">
                            <img src="https://i.pravatar.cc/80?u={{ urlencode($message->sender_name) }}" alt="{{ $message->sender_name }}">
                            <div>
                            <p>{{ $message->body }}</p>
                            <time>{{ $message->created_at->format('g:i A') }}</time>
                            </div>
                        </div>
                    @empty
                    <p class="mastermind-no-messages">No messages in this group yet.</p>
                    @endforelse
                </div>
                <footer class="mastermind-message-footer">
            <span class="mastermind-read-only">Only <strong>admins</strong> can send messages</span>
                    @if (session('admin_logged_in'))
                        <form action="{{ route('mastermind.messages.store', $selectedGroup) }}" method="POST" class="mastermind-message-form">
                            @csrf
                            <input name="body" maxlength="2000" required placeholder="Write a message...">
                            <button type="submit">
                                <i class="bi bi-send">
                                </i>
                            </button>
                        </form>
                    @endif
                </footer>
            @else
            <div class="mastermind-chat-empty">Select a group to view its details.</div>
            @endif
        </section>
    </div>
</div>
@endsection
