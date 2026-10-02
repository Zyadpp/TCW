<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Mentor Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/mentor.css') }}?v={{ filemtime(public_path('css/mentor.css')) }}">
</head>
<body class="mentor-shell">
    <div class="lms-shell">
        <aside class="lms-sidebar"><strong>TCW Mentor</strong><nav><a class="{{ request()->routeIs('mentor.dashboard') ? 'active' : '' }}" href="{{ route('mentor.dashboard') }}">Dashboard</a></nav></aside>
        <main class="lms-main">@yield('content')</main>
    </div>
</body>
</html>
