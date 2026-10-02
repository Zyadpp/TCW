@extends('layouts.admin')
@section('content')
    <div class="programmes-page">
        <div class="page-header">
            <div class="title-row">
            <h3>Programmes</h3>
                <button type="button" class="new-user-btn-page" id="openProgrammeDrawer">
                    <i class="bi bi-plus">
                    </i>
                    New programme
                </button>
            </div>
            <div class="programme-filters">
                @foreach (['All', 'Active', 'Ongoing', 'Paused'] as $filter)
                    <a href="{{ route('programmes.index', $filter === 'All' ? [] : ['status' => $filter]) }}"
                        class="programme-filter {{ request('status', 'All') === $filter ? 'active' : '' }}">
                        {{ $filter }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="table-card">
            <table class="table align-middle mb-0 programme-table">
                <thead>
                    <tr>
                    <th>CREATION DATE</th>
                    <th>PROGRAMME TITLE</th>
                    <th>INSTRUCTOR NAME &amp; START DATE</th>
                    <th>END DATE</th>
                    <th>MAX SEATS</th>
                    <th>AVAILABLE SEATS</th>
                    <th>STATUS</th>
                    <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($programmes as $programme)
                        <tr>
                        <td>{{ $programme->created_at->format('n/j/Y') }}</td>
                        <td>{{ $programme->title }}</td>
                            <td>
                                <div class="instructor">
                                    <img src="https://i.pravatar.cc/40?u={{ urlencode($programme->instructor_name) }}" alt="">
                                    <div>
                                    <strong>{{ $programme->instructor_name }}</strong>
                                    <small>{{ $programme->start_date->format('n/j/Y') }}</small>
                                    </div>
                                </div>
                            </td>
                        <td>{{ $programme->end_date?->format('n/j/Y') ?? '---' }}</td>
                        <td>{{ $programme->max_seats }}</td>
                        <td>{{ $programme->available_seats }}</td>
                            <td>
                            <span class="status {{ strtolower($programme->status) }}">{{ $programme->status }}</span>
                            </td>
                            <td class="actions">
                                <details class="mastermind-actions">
                                    <summary><i class="bi bi-three-dots-vertical"></i></summary>
                                    <div>
                                        <button type="button" class="edit-programme"
                                                data-id="{{ $programme->id }}"
                                                data-title="{{ $programme->title }}"
                                                data-instructor="{{ $programme->instructor_name }}"
                                                data-start-date="{{ $programme->start_date->format('Y-m-d') }}"
                                                data-end-date="{{ $programme->end_date?->format('Y-m-d') }}"
                                                data-status="{{ $programme->status }}"
                                                data-max-seats="{{ $programme->max_seats }}">
                                            Edit
                                        </button>
                                        <form action="{{ route('programmes.destroy', $programme) }}" method="POST" onsubmit="return confirm('Delete this programme?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-group">Delete</button>
                                        </form>
                                    </div>
                                </details>
                            </td>
                        </tr>
                    @empty
                        <tr>
                        <td colspan="8" class="text-center text-muted py-4">No programmes added yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="table-footer">
            <span>
                {{ $programmes->total() ? $programmes->firstItem().'-'.$programmes->lastItem().' of '.$programmes->total().' items' : 'No programmes yet' }}
            </span>
            <div class="pagination-label">
                <strong>{{ $programmes->currentPage() }}</strong> of {{ $programmes->lastPage() }} pages
                @if ($programmes->onFirstPage())
                    <button type="button" aria-label="Previous page" disabled><i class="bi bi-chevron-left"></i></button>
                @else
                    <a href="{{ $programmes->previousPageUrl() }}" aria-label="Previous page"><i class="bi bi-chevron-left"></i></a>
                @endif
                @if ($programmes->hasMorePages())
                    <a href="{{ $programmes->nextPageUrl() }}" aria-label="Next page"><i class="bi bi-chevron-right"></i></a>
                @else
                    <button type="button" aria-label="Next page" disabled><i class="bi bi-chevron-right"></i></button>
                @endif
            </div>
        </div>
    </div>
    <div id="programmeDrawerOverlay" class="drawer-overlay">
    </div>
    <div id="programmeDrawer" class="user-drawer programme-drawer" aria-hidden="true">
        <div class="drawer-header">
        <h3>New Programme</h3>
        <button type="button" id="closeProgrammeDrawer" aria-label="Close new programme form">&times;</button>
        </div>
        <form class="new-user-form" action="{{ route('programmes.store') }}" method="POST">
            @csrf
            <div class="form-field">
            <label for="creation_date">Creation Date</label>
                <input id="creation_date" type="date" name="creation_date" value="{{ now()->format('Y-m-d') }}" required>
            </div>
            <div class="form-field">
            <label for="title">Programme title</label>
                <input id="title" type="text" name="title" placeholder="Understanding Concept of React" required>
            </div>
            <div class="form-field">
            <label for="instructor_name">Instructor</label>
                <input id="instructor_name" type="text" name="instructor_name" placeholder="Amir Ali" required>
            </div>
            <div class="form-field">
            <label for="start_date">Start Date</label>
                <input id="start_date" type="date" name="start_date" value="{{ now()->format('Y-m-d') }}" required>
            </div>
            <div class="form-field">
            <label for="programme_status">Programme status</label>
                <select id="programme_status" name="status">
                <option value="Active">Active</option>
                <option value="Ongoing">Ongoing</option>
                <option value="Paused">Paused</option>
                </select>
            </div>
            <div class="form-field">
            <label for="max_seats">Max Seats</label>
                <input id="max_seats" type="number" name="max_seats" min="1" placeholder="25" required>
            </div>
            <div class="drawer-buttons">
            <button type="button" id="cancelProgrammeDrawer">Cancel</button>
            <button type="submit">Add content</button>
            </div>
        </form>
    </div>

    <div id="editProgrammeDrawer" class="user-drawer programme-drawer" aria-hidden="true">
        <div class="drawer-header">
            <h3>Edit Programme</h3>
            <button type="button" data-close-programme-drawer aria-label="Close edit programme form">&times;</button>
        </div>
        <form id="editProgrammeForm" class="new-user-form" method="POST">
            @csrf
            @method('PUT')
            <div class="form-field">
                <label for="edit_programme_title">Programme title</label>
                <input id="edit_programme_title" type="text" name="title" required>
            </div>
            <div class="form-field">
                <label for="edit_instructor_name">Instructor</label>
                <input id="edit_instructor_name" type="text" name="instructor_name" required>
            </div>
            <div class="form-field">
                <label for="edit_start_date">Start Date</label>
                <input id="edit_start_date" type="date" name="start_date" required>
            </div>
            <div class="form-field">
                <label for="edit_end_date">End Date</label>
                <input id="edit_end_date" type="date" name="end_date">
            </div>
            <div class="form-field">
                <label for="edit_programme_status">Programme status</label>
                <select id="edit_programme_status" name="status">
                    <option value="Active">Active</option>
                    <option value="Ongoing">Ongoing</option>
                    <option value="Paused">Paused</option>
                </select>
            </div>
            <div class="form-field">
                <label for="edit_max_seats">Max Seats</label>
                <input id="edit_max_seats" type="number" name="max_seats" min="1" required>
            </div>
            <div class="drawer-buttons">
                <button type="button" data-close-programme-drawer>Cancel</button>
                <button type="submit">Save changes</button>
            </div>
        </form>
    </div>
    <script>
        const programmeDrawer = document.getElementById('programmeDrawer');
        const editProgrammeDrawer = document.getElementById('editProgrammeDrawer');
        const programmeOverlay = document.getElementById('programmeDrawerOverlay');
        const programmeDrawers = [programmeDrawer, editProgrammeDrawer];

        const closeProgrammeDrawer = () => {
            programmeDrawers.forEach((drawer) => {
                drawer.classList.remove('active');
                drawer.setAttribute('aria-hidden', 'true');
            });
            programmeOverlay.classList.remove('active');
            document.body.style.overflow = 'auto';
        };

        const openProgrammeDrawer = (drawer) => {
            drawer.classList.add('active');
            drawer.setAttribute('aria-hidden', 'false');
            programmeOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        };

        document.getElementById('openProgrammeDrawer').addEventListener('click', () => {
            openProgrammeDrawer(programmeDrawer);
        });
        document.getElementById('closeProgrammeDrawer').addEventListener('click', closeProgrammeDrawer);
        document.getElementById('cancelProgrammeDrawer').addEventListener('click', closeProgrammeDrawer);
        document.querySelectorAll('[data-close-programme-drawer]').forEach((button) => button.addEventListener('click', closeProgrammeDrawer));
        programmeOverlay.addEventListener('click', closeProgrammeDrawer);

        document.querySelectorAll('.edit-programme').forEach((button) => button.addEventListener('click', () => {
            document.getElementById('editProgrammeForm').action = `{{ url('/programmes') }}/${button.dataset.id}`;
            document.getElementById('edit_programme_title').value = button.dataset.title;
            document.getElementById('edit_instructor_name').value = button.dataset.instructor;
            document.getElementById('edit_start_date').value = button.dataset.startDate;
            document.getElementById('edit_end_date').value = button.dataset.endDate;
            document.getElementById('edit_programme_status').value = button.dataset.status;
            document.getElementById('edit_max_seats').value = button.dataset.maxSeats;
            openProgrammeDrawer(editProgrammeDrawer);
        }));
    </script>
@endsection
