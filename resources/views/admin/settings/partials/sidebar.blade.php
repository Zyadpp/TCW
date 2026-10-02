<aside class="settings-profile-card">
    <p>Created since {{ $settings->created_at->format('j M Y') }}</p>
    <div class="settings-logo-wrap">
        <img src="{{ asset('images/logo.png') }}" alt="{{ $settings->platform_name }} logo">
        <span aria-hidden="true"><i class="bi bi-camera-fill"></i></span>
    </div>
    <h2>{{ $settings->platform_name }}</h2>

    <nav class="settings-nav" aria-label="Settings sections">
        <a class="{{ request()->routeIs('settings.index') ? 'active' : '' }}" href="{{ route('settings.index') }}">
            <i class="bi bi-credit-card-2-front"></i>Tcw Data
        </a>
        <a class="{{ request()->routeIs('settings.notification') ? 'active' : '' }}" href="{{ route('settings.notification') }}">
            <i class="bi bi-bell"></i>Notification
        </a>
        <a href="#"><i class="bi bi-palette"></i>TCW Spaces</a>
        <a class="{{ request()->routeIs('settings.points') ? 'active' : '' }}" href="{{ route('settings.points') }}"><i class="bi bi-trophy"></i>Points &amp; Rewards</a>
        <a class="{{ request()->routeIs('settings.blogs') ? 'active' : '' }}" href="{{ route('settings.blogs') }}"><i class="bi bi-file-earmark-text"></i>Blogs</a>
        <a class="{{ request()->routeIs('settings.support') ? 'active' : '' }}" href="{{ route('settings.support') }}"><i class="bi bi-chat-square-text"></i>Support &amp; Complaints</a>
        <a class="{{ request()->routeIs('settings.comments') ? 'active' : '' }}" href="{{ route('settings.comments') }}"><i class="bi bi-chat-square-dots"></i>Comments Management</a>
        <a class="{{ request()->routeIs('settings.chatbot') ? 'active' : '' }}" href="{{ route('settings.chatbot') }}"><i class="bi bi-robot"></i>Chat Bot</a>
    </nav>
</aside>
