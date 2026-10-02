@extends('layouts.admin')
@section('content')
<div class="inbox-page">
    <h1>Messages</h1>
    <div class="inbox-layout">
        <aside class="conversation-list">
            <div class="members-title">Members</div>
            <div class="member-avatars">
                @forelse ($users->take(4) as $member)
                <img src="https://i.pravatar.cc/56?u={{ urlencode($member->email) }}" alt="{{ $member->name }}">
                @empty
                <span class="no-members">No members yet</span>
                @endforelse
            </div>
            <div class="messages-label">Messages <span>{{ $users->count() }}</span>
            </div>
            <div class="conversation-items">
                @forelse ($users as $user)
                @php($latestMessage = $user->inboxMessages->first())
                <a class="conversation-item {{ $selectedUser?->id === $user->id ? 'active' : '' }}" href="{{ route('inbox.index', ['user' => $user->id]) }}">
                    <img src="https://i.pravatar.cc/56?u={{ urlencode($user->email) }}" alt="{{ $user->name }}">
                    <div class="conversation-summary">
                        <strong>{{ $user->name }}</strong>
                        <small>{{ $user->email }}</small>
                        <p>{{ $latestMessage?->body ?? 'No messages yet.' }}</p>
                    </div>
                    <time>{{ $latestMessage ? $latestMessage->created_at->diffForHumans() : '' }}</time>
                </a>
                @empty
                <p class="inbox-empty">No members found.</p>
                @endforelse
            </div>
        </aside>
        <section class="chat-panel">
            @if ($selectedUser)
            <div class="chat-header">
                <div>
                    <img src="https://i.pravatar.cc/56?u={{ urlencode($selectedUser->email) }}" alt="{{ $selectedUser->name }}">
                    <span>{{ $selectedUser->name }}</span>
                </div>
                <a class="call-button" href="mailto:{{ $selectedUser->email }}">
                    <i class="bi bi-telephone-fill">
                    </i> Contact</a>
            </div>
            <div class="chat-messages">
                @forelse ($messages as $message)
                <div class="chat-message {{ $message->sent_by_admin ? 'outgoing' : 'incoming' }}">
                    @unless ($message->sent_by_admin)<img src="https://i.pravatar.cc/40?u={{ urlencode($selectedUser->email) }}" alt="">
                    @endunless
                    <div>
                        <p>{{ $message->body }}</p>
                                <time>{{ $message->created_at->format('h:i A') }}</time>
                                @if ($message->sent_by_admin)<details><summary>Actions</summary><form action="{{ route('inbox.messages.update', [$selectedUser, $message]) }}" method="POST">@csrf @method('PUT')<input name="body" value="{{ $message->body }}" required><button>Save</button></form><form action="{{ route('inbox.messages.destroy', [$selectedUser, $message]) }}" method="POST" onsubmit="return confirm('Delete this message?')">@csrf @method('DELETE')<button>Delete</button></form></details>@endif
                    </div>
                </div>
                @empty
                <p class="chat-empty">No messages with {{ $selectedUser->name }} yet. Send the first message below.</p>
                @endforelse
            </div>
            <form class="message-composer" action="{{ route('inbox.messages.store', $selectedUser) }}" method="POST">
                @csrf
                <input name="body" value="{{ old('body') }}" placeholder="Type a message" aria-label="Message" required>
                <i class="bi bi-emoji-smile" aria-hidden="true"></i>
                <i class="bi bi-paperclip" aria-hidden="true"></i>
                <button type="submit">Send now</button>
            </form>
            @else
            <div class="chat-no-selection">Select a member to view the conversation.</div>
            @endif
        </section>
    </div>
</div>
@endsection
