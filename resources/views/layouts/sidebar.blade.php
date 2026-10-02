<div class="sidebar">

    <!-- Logo -->
    <div class="logo text-center mb-4">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
    </div>

    <!-- Overview -->
    <p class="menu-title">Overview</p>

    <ul class="menu">

        <li>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('events.index') }}" class="{{ request()->routeIs('events.*') ? 'active' : '' }}">
                <i class="bi bi-calendar-event"></i>
                Events
            </a>
        </li>

        <li>
            <a href="{{ route('inbox.index') }}" class="{{ request()->routeIs('inbox.*') ? 'active' : '' }}">
                <i class="bi bi-inbox"></i>
                Inbox
            </a>
        </li>

        <li>
            <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                Users
            </a>
        </li>

        <li>
            <a href="{{ route('programmes.index') }}" class="{{ request()->routeIs('programmes.*') ? 'active' : '' }}">
                <i class="bi bi-book"></i>
                Programmes
            </a>
        </li>

        <li>
            <a href="{{ route('tasks.index') }}" class="{{ request()->routeIs('tasks.*') ? 'active' : '' }}">
                <i class="bi bi-list-task"></i>
                Task
            </a>
        </li>

        <li>
            <a href="{{ route('payments.index') }}" class="{{ request()->routeIs('payments.*') ? 'active' : '' }}">
                <i class="bi bi-credit-card"></i>
                Payments
            </a>
        </li>

        <li>
            <a href="{{ route('mastermind.index') }}" class="{{ request()->routeIs('mastermind.index', 'mastermind.store') ? 'active' : '' }}">
                <i class="bi bi-mortarboard"></i>
                Master mind
            </a>
        </li>

        @if (request()->routeIs('mastermind.*'))
            <li class="mastermind-submenu-item">
                <a href="{{ route('mastermind.details') }}" class="{{ request()->routeIs('mastermind.details') ? 'active' : '' }}">
                    <i class="bi bi-book"></i>
                    Master mind
                </a>
            </li>
        @endif

        <li>
            <a href="{{ route('media.index') }}" class="{{ request()->routeIs('media.*') ? 'active' : '' }}">
                <i class="bi bi-camera-video"></i>
                TCW media
            </a>
        </li>

    </ul>

    <!-- Setting -->
    <p class="menu-title mt-4">Setting</p>

    <ul class="menu">

        <li>
            <a href="{{ route('settings.index') }}" class="{{ request()->routeIs('settings.*') ? 'active' : '' }}">
                <i class="bi bi-gear"></i>
                Setting
            </a>
        </li>

        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    Log out
                </button>
            </form>
        </li>

    </ul>

</div>
