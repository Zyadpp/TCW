<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}?v={{ filemtime(public_path('css/dashboard.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}?v={{ filemtime(public_path('css/settings.css')) }}">
    @stack('page-styles')

</head>

<body class="{{ request()->routeIs('dashboard') ? 'dashboard-layout' : '' }} {{ request()->routeIs('settings.*') ? 'settings-layout-page' : '' }}">

<div class="wrapper">

    @include('layouts.sidebar')

    <div class="main-content">

        <!-- Header -->
        <div class="top-header">

            <div class="search-box">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="{{ request()->routeIs('mastermind.details') ? 'Search for a task or course..' : 'Search' }}">
            </div>

            @if (request()->routeIs('mastermind.details'))
                <button class="mastermind-filter-button" type="button" aria-label="Filter groups"><i class="bi bi-funnel"></i></button>
            @endif

           

        </div>

        <!-- Page -->
        <div class="content">

            @yield('content')

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
