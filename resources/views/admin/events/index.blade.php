@extends('layouts.admin')
@section('content')
<div class="events-page">
    <section class="event-hero">
        <div class="event-hero-content">
            <p>
                <i class="bi bi-calendar3">
                </i> {{ $featuredEvent ? $featuredEvent->event_date->format('l, j M Y') : 'Monday, 4 Mar 2025' }} <span>&bull;</span>
                <i class="bi bi-clock">
                </i> {{ $featuredEvent ? $featuredEvent->start_time->format('h:i') . ' - ' . $featuredEvent->end_time->format('h:i A') : '02:00 - 03:30 PM' }}
            </p>
            <h2>{{ $featuredEvent?->title ?? 'Join our live event to master time management and achieve peak productivity!' }}</h2>
            @if ($featuredEvent?->meeting_link)
            <a class="join-event-btn" href="{{ $featuredEvent->meeting_link }}" target="_blank" rel="noopener">
                <span>Join now</span>
                <i class="bi bi-play-circle-fill">
                </i>
            </a>
            @else
            <button type="button" class="join-event-btn" disabled title="A meeting link has not been added yet">
                <span>Join now</span>
                <i class="bi bi-play-circle-fill">
                </i>
            </button>
            @endif
        </div>
        <div class="hero-dots">
            <span class="active">
            </span>
            <span>
            </span>
            <span>
            </span>
            <span>
            </span>
        </div>
    </section>
    <div class="page-header events-header">
        <div class="title-row">
            <h3>Events</h3>
            <button type="button" class="new-user-btn-page" id="openEventDrawer">
                <i class="bi bi-plus">
                </i> New Event</button>
        </div>
        <div class="programme-filters">
            @foreach (['All', 'Finished', 'Upcoming', 'Canceled'] as $filter)
            <a href="{{ route('events.index', $filter === 'All' ? [] : ['status' => $filter]) }}" class="programme-filter {{ request('status', 'All') === $filter ? 'active' : '' }}">{{ $filter }}({{ $counts[$filter] }})</a>
            @endforeach
        </div>
    </div>
    <div class="events-grid">
        @forelse ($events as $event)
        <article class="event-card">
            <div class="event-card-top">
                <span class="event-status {{ strtolower($event->status) }}">{{ $event->status }}</span>
                <details class="mastermind-actions">
                    <summary><i class="bi bi-three-dots-vertical"></i></summary>
                    <div>
                        <button type="button" class="edit-event"
                            data-update-url="{{ route('events.update', $event) }}"
                            data-title="{{ $event->title }}"
                            data-description="{{ $event->description }}"
                            data-event-date="{{ $event->event_date->format('Y-m-d') }}"
                            data-start-time="{{ $event->start_time->format('H:i') }}"
                            data-end-time="{{ $event->end_time->format('H:i') }}"
                            data-platform="{{ $event->platform }}"
                            data-meeting-link="{{ $event->meeting_link }}"
                            data-coach-name="{{ $event->coach_name }}"
                            data-status="{{ $event->status }}">Edit</button>
                        <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('Delete this event?')">@csrf @method('DELETE')<button type="submit" class="delete-group">Delete</button></form>
                    </div>
                </details>
            </div>
            <div class="event-card-body">
                <div class="event-date">
                    <strong>{{ $event->event_date->format('d M') }}</strong>
                    <small>{{ $event->start_time->format('h:i') }}-{{ $event->end_time->format('h:i A') }}</small>
                    <em>
                        <i class="bi bi-camera-video-fill">
                        </i> {{ $event->platform }}</em>
                </div>
                <div class="event-details">
                    <h4>{{ $event->title }}</h4>
                    <p>{{ $event->description }}</p>
                    <div class="event-coach">
                        <img src="https://i.pravatar.cc/56?u={{ urlencode($event->coach_name) }}" alt="">
                        <span>
                            <strong>{{ $event->coach_name }}</strong>
                            <small>Coach</small>
                        </span>
                    </div>
                </div>
            </div>
        </article>
        @empty
        <p class="events-empty">No events added yet. Use &ldquo;New Event&rdquo; to add the first one.</p>
        @endforelse
    </div>
</div>
<div id="eventDrawerOverlay" class="drawer-overlay">
</div>
<div id="eventDrawer" class="user-drawer event-drawer" aria-hidden="true">
    <div class="drawer-header">
        <h3 id="eventDrawerTitle">New Event</h3>
        <button type="button" id="closeEventDrawer" aria-label="Close event form">&times;</button>
    </div>
    <form id="eventForm" class="new-user-form event-form" action="{{ route('events.store') }}" data-store-url="{{ route('events.store') }}" data-default-date="{{ date('Y-m-d') }}" data-has-errors="{{ $errors->any() ? 'true' : 'false' }}" method="POST">
        @csrf
        <input id="eventFormMethod" type="hidden" name="_method" value="POST">
        @if ($errors->any())
        <div class="event-form-errors">{{ $errors->first() }}</div>
        @endif
        <div class="form-field" id="creationDateField">
            <label for="creation_date">Creation Date</label>
            <input id="creation_date" type="date" name="creation_date" value="{{ old('creation_date', now()->format('Y-m-d')) }}" required>
        </div>
        <div class="form-field">
            <label for="event_title">Event title</label>
            <input id="event_title" name="title" value="{{ old('title') }}" placeholder="JSX and Rendering" required>
        </div>
        <div class="form-field">
            <label for="coach_name">Assigned to</label>
            <div class="assigned-field">
                <img src="https://i.pravatar.cc/40?u=coach" alt="">
                <input id="coach_name" name="coach_name" value="{{ old('coach_name') }}" placeholder="Amir Ali" required>
                <i class="bi bi-chevron-down">
                </i>
            </div>
        </div>
        <div class="form-field">
            <label for="event_date">Event Date</label>
            <input id="event_date" type="date" name="event_date" value="{{ old('event_date', now()->format('Y-m-d')) }}" required>
        </div>
        <div class="form-field">
            <label for="meeting_link">Meeting Link</label>
            <input id="meeting_link" type="url" name="meeting_link" value="{{ old('meeting_link') }}" placeholder="https://meet.google.com/xyz-abcd">
        </div>
        <div class="event-time-fields">
            <div class="form-field">
                <label for="start_time">From</label>
                <input id="start_time" type="time" name="start_time" value="{{ old('start_time') }}" required>
            </div>
            <div class="form-field">
                <label for="end_time">To</label>
                <input id="end_time" type="time" name="end_time" value="{{ old('end_time') }}" required>
            </div>
        </div>
        <div class="form-field">
            <label for="event_status">Programme status</label>
            <select id="event_status" name="status">
                <option value="Upcoming" @selected(old('status')==='Upcoming' )>Upcoming</option>
                <option value="Finished" @selected(old('status')==='Finished' )>Finished</option>
                <option value="Canceled" @selected(old('status')==='Canceled' )>Canceled</option>
            </select>
        </div>
        <input id="eventPlatform" type="hidden" name="platform" value="Zoom">
        <div class="form-field event-overview">
            <label for="event_description">Event Overview</label>
            <textarea id="event_description" name="description" placeholder="Lorem ipsum dolor sit amet consectetur. A in at tellus integer arcu facilisi mauris." required>{{ old('description') }}</textarea>
        </div>
        <div class="drawer-buttons">
            <button type="button" id="cancelEventDrawer">Cancel</button>
            <button id="eventFormSubmit" type="submit">Save</button>
        </div>
    </form>
</div>
<script>
    const eventDrawer = document.getElementById('eventDrawer');
    const eventOverlay = document.getElementById('eventDrawerOverlay');
    const eventForm = document.getElementById('eventForm');
    const eventFormMethod = document.getElementById('eventFormMethod');
    const eventDrawerTitle = document.getElementById('eventDrawerTitle');
    const eventFormSubmit = document.getElementById('eventFormSubmit');
    const creationDateField = document.getElementById('creationDateField');
    const defaultEventDate = eventForm.dataset.defaultDate;
    const closeEventDrawer = () => {
        eventDrawer.classList.remove('active');
        eventDrawer.setAttribute('aria-hidden', 'true');
        eventOverlay.classList.remove('active');
        document.body.style.overflow = 'auto';
    };
    const openEventDrawer = () => {
        eventDrawer.classList.add('active');
        eventDrawer.setAttribute('aria-hidden', 'false');
        eventOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    };
    document.getElementById('openEventDrawer').addEventListener('click', () => {
        eventForm.reset();
        eventForm.action = eventForm.dataset.storeUrl;
        eventFormMethod.value = 'POST';
        document.getElementById('creation_date').value = defaultEventDate;
        document.getElementById('event_date').value = defaultEventDate;
        creationDateField.style.display = '';
        eventDrawerTitle.textContent = 'New Event';
        eventFormSubmit.textContent = 'Save';
        openEventDrawer();
    });
    document.getElementById('closeEventDrawer').addEventListener('click', closeEventDrawer);
    document.getElementById('cancelEventDrawer').addEventListener('click', closeEventDrawer);
    eventOverlay.addEventListener('click', closeEventDrawer);
    document.querySelectorAll('.edit-event').forEach((button) => button.addEventListener('click', () => {
        const eventData = button.dataset;
        eventForm.action = eventData.updateUrl;
        eventFormMethod.value = 'PUT';
        document.getElementById('event_title').value = eventData.title;
        document.getElementById('event_description').value = eventData.description;
        document.getElementById('event_date').value = eventData.eventDate;
        document.getElementById('start_time').value = eventData.startTime;
        document.getElementById('end_time').value = eventData.endTime;
        document.getElementById('meeting_link').value = eventData.meetingLink;
        document.getElementById('coach_name').value = eventData.coachName;
        document.getElementById('eventPlatform').value = eventData.platform;
        document.getElementById('event_status').value = eventData.status;
        creationDateField.style.display = 'none';
        eventDrawerTitle.textContent = 'Edit Event';
        eventFormSubmit.textContent = 'Save changes';
        openEventDrawer();
    }));
    if (eventForm.dataset.hasErrors === 'true') {
        openEventDrawer();
    }
</script>
@endsection