@extends('layouts.admin')
@section('content')
    <div class="mastermind-page mastermind-index-page">
        <div class="page-header mastermind-header">
            <div class="title-row">
            <h3>Master Mind</h3>
                <button type="button" class="new-user-btn-page mastermind-add" id="openMastermindDrawer">
                    <i class="bi bi-plus">
                    </i> New Group
                </button>
            </div>
            <div class="programme-filters">
                @foreach (['All', 'Active', 'Closed'] as $filter)
                    <a href="{{ route('mastermind.index', $filter === 'All' ? [] : ['status' => $filter]) }}" class="programme-filter {{ request('status', 'All') === $filter ? 'active' : '' }}">
                        {{ $filter }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="table-card mastermind-table-card">
            <table class="table align-middle mb-0 mastermind-table">
                <thead>
                    <tr>
                    <th>CREATION DATE</th>
                    <th>GROUP NAME</th>
                    <th>INSTRUCTOR NAME</th>
                    <th>NUMBER OF MEMBERS</th>
                    <th>STATUS</th>
                    <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($groups as $group)
                        <tr>
                        <td>{{ $group->created_at->format('n/j/Y') }}</td>
                        <td>{{ $group->name }}</td>
                            <td>
                                <div class="instructor">
                                    <img src="https://i.pravatar.cc/40?u={{ urlencode($group->instructor_name) }}" alt="">
                                    <div>
                                    <strong>{{ $group->instructor_name }}</strong>
                                    <small>{{ strtolower(str_replace(' ', '', $group->instructor_name)) }}@gmail.com</small>
                                    </div>
                                </div>
                            </td>
                        <td>{{ $group->members_count }}</td>
                            <td>
                            <span class="status {{ strtolower($group->status) }}">{{ $group->status }}</span>
                            </td>
                            <td class="actions">
                                <details class="mastermind-actions">
                                    <summary>
                                        <i class="bi bi-three-dots-vertical">
                                        </i>
                                    </summary>
                                    <div>
                                    <button type="button" class="edit-group" data-id="{{ $group->id }}" data-name="{{ $group->name }}" data-coach="{{ $group->instructor_name }}" data-status="{{ $group->status }}">Edit</button>
                                    <button type="button" class="manage-members" data-id="{{ $group->id }}" data-members="{{ $group->members->pluck('id')->implode(',') }}">Manage members</button>
                                        <form action="{{ route('mastermind.destroy', $group) }}" method="POST" onsubmit="return confirm('Delete this group?')">
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
                        <td colspan="6" class="mastermind-empty">No Master Mind groups added yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="table-footer mastermind-footer">
        <span>{{ $groups->total() ? $groups->firstItem().'-'.$groups->lastItem().' of '.$groups->total().' items' : 'No groups yet' }}</span>
            <div class="pagination-label">
        <strong>{{ $groups->currentPage() }}</strong> of {{ $groups->lastPage() }} pages</div>
        </div>
    </div>
    <div id="mastermindDrawerOverlay" class="drawer-overlay">
    </div>
    <div id="mastermindDrawer" class="user-drawer mastermind-drawer" aria-hidden="true">
        <div class="drawer-header">
        <h3>New Group</h3>
        <button type="button" id="closeMastermindDrawer">&times;</button>
        </div>
        <form class="new-user-form mastermind-form" action="{{ route('mastermind.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label class="group-cover-upload" for="group_cover">
                <i class="bi bi-image">
                </i>
            <strong>Add group cover</strong>
            <span>Or drag and drop.</span>
                <input id="group_cover" type="file" name="cover_image" accept="image/*">
            </label>
            <div class="form-field">
            <label>Group title</label>
                <input name="name" value="{{ old('name') }}" required>
            </div>
            <div class="form-field">
            <label>Coach</label>
                <select name="instructor_name" required>
                    @foreach ($coaches as $coach)
                    <option value="{{ $coach->name }}">{{ $coach->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-field">
            <label>Date</label>
                <input type="date" name="creation_date" value="{{ old('creation_date', now()->format('Y-m-d')) }}" required>
            </div>
            <div class="form-field">
            <label>Task status</label>
                <select name="status">
                <option value="Active">Active</option>
                <option value="Closed">Closed</option>
                </select>
            </div>
            <input type="hidden" name="members_count" value="0">
            <div class="drawer-buttons">
            <button type="button" id="cancelMastermindDrawer">Cancel</button>
            <button type="submit">Save</button>
            </div>
        </form>
    </div>
    <div id="editGroupDrawer" class="user-drawer mastermind-drawer" aria-hidden="true">
        <div class="drawer-header">
        <h3>Edit Group</h3>
        <button type="button" data-close-drawer>&times;</button>
        </div>
        <form id="editGroupForm" class="new-user-form mastermind-form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-field">
            <label>Group title</label>
                <input id="editGroupName" name="name" required>
            </div>
            <div class="form-field">
            <label>Coach</label>
                <select id="editGroupCoach" name="instructor_name" required>
                    @foreach ($coaches as $coach)
                    <option value="{{ $coach->name }}">{{ $coach->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-field">
            <label>Status</label>
                <select id="editGroupStatus" name="status">
                <option value="Active">Active</option>
                <option value="Closed">Closed</option>
                </select>
            </div>
            <div class="form-field">
            <label>New cover image (optional)</label>
                <input type="file" name="cover_image" accept="image/*">
            </div>
            <div class="drawer-buttons">
            <button type="button" data-close-drawer>Cancel</button>
            <button type="submit">Save changes</button>
            </div>
        </form>
    </div>
    <div id="membersDrawer" class="user-drawer mastermind-drawer" aria-hidden="true">
        <div class="drawer-header">
        <h3>Manage Members</h3>
        <button type="button" data-close-drawer>&times;</button>
        </div>
        <form id="membersForm" class="new-user-form mastermind-form" method="POST">
            @csrf
            @method('PUT')
            <div class="mastermind-member-options">
                @forelse ($coaches as $member)
                    <label>
                        <input type="checkbox" name="members[]" value="{{ $member->id }}">
                    <span>{{ $member->name }}</span>
                    <small>{{ $member->email }}</small>
                    </label>
                @empty
                <p>No users found.</p>
                @endforelse
            </div>
            <div class="drawer-buttons">
            <button type="button" data-close-drawer>Cancel</button>
            <button type="submit">Save members</button>
            </div>
        </form>
    </div>
    <script>
        const mastermindOverlay = document.getElementById('mastermindDrawerOverlay');
        const drawers = document.querySelectorAll('.mastermind-drawer');
        const closeDrawers = () => {
        drawers.forEach((drawer) => drawer.classList.remove('active'));
        mastermindOverlay.classList.remove('active');
        document.body.style.overflow = 'auto';
        };
        const openDrawer = (drawer) => {
        drawer.classList.add('active');
        mastermindOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
        };
        document.getElementById('openMastermindDrawer').onclick = () => openDrawer(document.getElementById('mastermindDrawer'));
        document.getElementById('closeMastermindDrawer').onclick = closeDrawers;
        document.getElementById('cancelMastermindDrawer').onclick = closeDrawers;
        mastermindOverlay.onclick = closeDrawers;
        document.querySelectorAll('[data-close-drawer]').forEach((button) => button.onclick = closeDrawers);
        document.querySelectorAll('.edit-group').forEach((button) => button.onclick = () => {
        document.getElementById('editGroupForm').action = `{{ url('/mastermind') }}/${button.dataset.id}`;
        document.getElementById('editGroupName').value = button.dataset.name;
        document.getElementById('editGroupCoach').value = button.dataset.coach;
        document.getElementById('editGroupStatus').value = button.dataset.status;
        openDrawer(document.getElementById('editGroupDrawer'));
        });
        document.querySelectorAll('.manage-members').forEach((button) => button.onclick = () => {
        document.getElementById('membersForm').action = `{{ url('/mastermind') }}/${button.dataset.id}/members`;
        const ids = button.dataset.members ? button.dataset.members.split(',') : [];
        document.querySelectorAll('#membersForm input[type=checkbox]').forEach((input) => {
        input.checked = ids.includes(input.value);
        });
        openDrawer(document.getElementById('membersDrawer'));
        });
    </script>
@endsection
