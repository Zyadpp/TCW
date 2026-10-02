<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Learning Dashboard')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}?v={{ filemtime(public_path('css/user.css')) }}">
    @if (request()->routeIs('user.events.*'))<link rel="stylesheet" href="{{ asset('css/user-events.css') }}?v={{ filemtime(public_path('css/user-events.css')) }}">@endif
    @if (request()->routeIs('user.events.live') || request()->routeIs('user.lessons.*'))<link rel="stylesheet" href="{{ asset('css/user-learning.css') }}?v={{ filemtime(public_path('css/user-learning.css')) }}">@endif
</head>
<body>
    <div class="lms-shell">
        <aside class="lms-sidebar">
            <img class="lms-logo" src="{{ asset('images/logo.png') }}" alt="The Certain Way">
            <p class="lms-nav-label">Overview</p>
            <nav class="lms-nav">
                <a class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}"><i class="bi bi-pie-chart"></i>Dashboard</a>
                <a class="{{ request()->routeIs('user.events.*') ? 'active' : '' }}" href="{{ route('user.events.index') }}"><i class="bi bi-calendar3"></i>Events</a><a href="#"><i class="bi bi-inbox"></i>Inbox</a>
                <a href="#"><i class="bi bi-book"></i>Programmes</a><a href="#"><i class="bi bi-clipboard-check"></i>Task</a>
                <a href="#"><i class="bi bi-cash-stack"></i>Payments</a><a href="#"><i class="bi bi-diagram-3"></i>Master mind</a>
                <a href="#"><i class="bi bi-collection-play"></i>TCW media</a>
            </nav>
            <p class="lms-nav-label lms-setting-label">Setting</p>
            <nav class="lms-nav"><a href="#"><i class="bi bi-gear"></i>Setting</a></nav>
            <form action="{{ route('logout') }}" method="POST">@csrf<button class="lms-logout" type="submit"><i class="bi bi-box-arrow-right"></i>Log out</button></form>
        </aside>
        <main class="lms-main">@yield('content')</main>
    </div>
</body>
</html>
