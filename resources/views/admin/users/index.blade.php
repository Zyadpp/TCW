@extends('layouts.admin')
@section('content')
    <div class="users-page">
        <div class="page-header">
            <div class="title-row">
            <h3>Users</h3>
                <button type="button" class="new-user-btn-page" id="openDrawer">
                    <i class="bi bi-plus">
                    </i>
                    New User
                </button>
            </div>
            <div class="tabs">
                <a href="{{ route('users.index', ['role'=>'Student']) }}"
                    class="tab {{ request('role','Student') == 'Student' ? 'active' : '' }}">
                    Students
                </a>
                <a href="{{ route('users.index', ['role'=>'Mentor']) }}"
                    class="tab {{ request('role') == 'Mentor' ? 'active' : '' }}">
                    Mentors
                </a>
            </div>
        </div>
        <div class="table-card">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                    <th>JOIN DATE</th>
                    <th>USER NAME</th>
                    <th>COURSE TITLE</th>
                    <th>PLAN</th>
                    <th>SUBSCRIPTION DATE</th>
                    <th>RENEWAL DATE</th>
                    <th>STATUS</th>
                    <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $i => $user)
                        <tr>
                            <td>
                                {{ \Carbon\Carbon::parse($user->join_date ?? $user->created_at)->format('n/j/Y') }}
                            </td>
                            <td>
                                <div class="user-info">
                                    <img src="https://i.pravatar.cc/40?img={{$i+10}}">
                                    <div>
                                        <strong>
                                            {{ $user->name }}
                                        </strong>
                                        <small>
                                            {{ $user->email }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $user->course_title ?? '---' }}
                            </td>
                            <td>
                                {{ $user->plan ?? '---' }}
                            </td>
                            <td>
                                {{ $user->subscription_date ?? '---' }}
                            </td>
                            <td>
                                {{ $user->renewal_date ?? '---' }}
                            </td>
                            <td>
                                <span class="status {{ strtolower($user->status ?? 'Active') === 'inactive' ? 'inactive' : '' }}">
                                    {{ $user->status ?? 'Active' }}
                                </span>
                            </td>
                            <td>
                                <details class="mastermind-actions">
                                    <summary><i class="bi bi-three-dots-vertical"></i></summary>
                                    <div>
                                        <button type="button" class="edit-user"
                                                data-id="{{ $user->id }}"
                                                data-name="{{ $user->name }}"
                                                data-email="{{ $user->email }}"
                                                data-join-date="{{ $user->join_date ? \Carbon\Carbon::parse($user->join_date)->format('Y-m-d') : '' }}"
                                                data-role="{{ $user->role }}"
                                                data-course-title="{{ $user->course_title }}"
                                                data-subscription-date="{{ $user->subscription_date ? \Carbon\Carbon::parse($user->subscription_date)->format('Y-m-d') : '' }}"
                                                data-plan="{{ $user->plan }}"
                                                data-renewal-date="{{ $user->renewal_date ? \Carbon\Carbon::parse($user->renewal_date)->format('Y-m-d') : '' }}"
                                                data-status="{{ $user->status }}">
                                            Edit
                                        </button>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this user?')">
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
                            <td colspan="8" class="text-center text-muted py-4">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="table-footer">
            <span>
                {{ $users->total() ? $users->firstItem().'-'.$users->lastItem().' of '.$users->total().' items' : 'No users found.' }}
            </span>
            <div class="pagination-label">
                <strong>{{ $users->currentPage() }}</strong> of {{ $users->lastPage() }} pages
                @if ($users->onFirstPage())
                    <button type="button" aria-label="Previous page" disabled>
                        <i class="bi bi-chevron-left"></i>
                    </button>
                @else
                    <a href="{{ $users->previousPageUrl() }}" aria-label="Previous page">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                @endif

                @if ($users->hasMorePages())
                    <a href="{{ $users->nextPageUrl() }}" aria-label="Next page">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                @else
                    <button type="button" aria-label="Next page" disabled>
                        <i class="bi bi-chevron-right"></i>
                    </button>
                @endif
            </div>
        </div>
    </div>
    <div id="drawerOverlay" class="drawer-overlay">
    </div>
    <div id="userDrawer" class="user-drawer" aria-hidden="true">
        <div class="drawer-header">
        <h3>New User</h3>
        <button type="button" id="closeDrawer" aria-label="Close new user form">&times;</button>
        </div>
        <form class="new-user-form" action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="form-field">
            <label for="join_date">Join Date</label>
                <input id="join_date" type="date" name="join_date" value="{{ now()->format('Y-m-d') }}">
            </div>
            <div class="form-field">
            <label for="name">User name</label>
                <input id="name" type="text" name="name" placeholder="Ahmed Ali" required>
            </div>
            <div class="form-field">
            <label for="email">Email address</label>
                <input id="email" type="email" name="email" placeholder="Ahmed@gmail.com" required>
            </div>
            <div class="form-field">
            <label for="role">The role</label>
                <select id="role" name="role">
                    <option value="Student">
                        Student
                    </option>
                    <option value="Mentor">
                        Mentor
                    </option>
                </select>
            </div>
            <div class="form-field">
            <label for="course_title">Programme title</label>
                <select id="course_title" name="course_title" {{ $programmes->isEmpty() ? 'disabled' : '' }}>
                    @forelse ($programmes as $programme)
                    <option value="{{ $programme->title }}">{{ $programme->title }}</option>
                    @empty
                    <option>No programmes available</option>
                    @endforelse
                </select>
                @if ($programmes->isEmpty())
                <small class="field-help">Add a programme first to select it here.</small>
                @endif
            </div>
            <div class="form-field">
            <label for="subscription_date">Subscription Date</label>
                <input id="subscription_date" type="date" name="subscription_date" value="{{ now()->format('Y-m-d') }}">
            </div>
            <div class="form-field">
            <label for="plan">Plan</label>
                <select id="plan" name="plan">
                    <option value="Free">
                        Free
                    </option>
                    <option value="Premium">
                        Premium
                    </option>
                </select>
            </div>
            <div class="form-field">
            <label for="renewal_date">Renewal Date</label>
                <input id="renewal_date" type="date" name="renewal_date">
            </div>
            <div class="form-field">
            <label for="status">User status</label>
                <select id="status" name="status">
                    <option value="Active">
                        Active
                    </option>
                    <option value="Inactive">
                        Inactive
                    </option>
                </select>
            </div>
            <div class="drawer-buttons">
                <button type="button" id="cancelDrawer">
                    Cancel
                </button>
                <button type="submit">
                    Save
                </button>
            </div>
        </form>
    </div>

    <div id="editUserDrawer" class="user-drawer" aria-hidden="true">
        <div class="drawer-header">
            <h3>Edit User</h3>
            <button type="button" data-close-user-drawer aria-label="Close edit user form">&times;</button>
        </div>
        <form id="editUserForm" class="new-user-form" method="POST">
            @csrf
            @method('PUT')
            <div class="form-field"><label for="edit_join_date">Join Date</label><input id="edit_join_date" type="date" name="join_date"></div>
            <div class="form-field"><label for="edit_name">User name</label><input id="edit_name" type="text" name="name" required></div>
            <div class="form-field"><label for="edit_email">Email address</label><input id="edit_email" type="email" name="email" required></div>
            <div class="form-field">
                <label for="edit_role">The role</label>
                <select id="edit_role" name="role"><option value="Student">Student</option><option value="Mentor">Mentor</option></select>
            </div>
            <div class="form-field">
                <label for="edit_course_title">Programme title</label>
                <select id="edit_course_title" name="course_title" {{ $programmes->isEmpty() ? 'disabled' : '' }}>
                    @forelse ($programmes as $programme)
                        <option value="{{ $programme->title }}">{{ $programme->title }}</option>
                    @empty
                        <option>No programmes available</option>
                    @endforelse
                </select>
            </div>
            <div class="form-field"><label for="edit_subscription_date">Subscription Date</label><input id="edit_subscription_date" type="date" name="subscription_date"></div>
            <div class="form-field">
                <label for="edit_plan">Plan</label>
                <select id="edit_plan" name="plan"><option value="Free">Free</option><option value="Premium">Premium</option></select>
            </div>
            <div class="form-field"><label for="edit_renewal_date">Renewal Date</label><input id="edit_renewal_date" type="date" name="renewal_date"></div>
            <div class="form-field">
                <label for="edit_status">User status</label>
                <select id="edit_status" name="status"><option value="Active">Active</option><option value="Inactive">Inactive</option></select>
            </div>
            <div class="drawer-buttons">
                <button type="button" data-close-user-drawer>Cancel</button>
                <button type="submit">Save changes</button>
            </div>
        </form>
    </div>
    <script>
        const drawer = document.getElementById('userDrawer');
        const editUserDrawer = document.getElementById('editUserDrawer');
        const userDrawers = [drawer, editUserDrawer];
        const drawerOverlay = document.getElementById('drawerOverlay');

        const openUserDrawer = (drawerToOpen) => {
            drawerToOpen.classList.add('active');
            drawerToOpen.setAttribute('aria-hidden', 'false');
            drawerOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        };

        document.getElementById('openDrawer')
        .addEventListener('click', function(){
        openUserDrawer(drawer);
        });
        function closeDrawer(){
        userDrawers.forEach((userDrawer) => {
        userDrawer.classList.remove('active');
        userDrawer.setAttribute('aria-hidden', 'true');
        });
        drawerOverlay.classList.remove('active');
        document.body.style.overflow='auto';
        }
        document.getElementById('closeDrawer')
        .addEventListener('click',closeDrawer);
        document.getElementById('cancelDrawer')
        .addEventListener('click',closeDrawer);
        document.getElementById('drawerOverlay')
        .addEventListener('click',closeDrawer);

        document.querySelectorAll('[data-close-user-drawer]').forEach((button) => button.addEventListener('click', closeDrawer));
        document.querySelectorAll('.edit-user').forEach((button) => button.addEventListener('click', () => {
        document.getElementById('editUserForm').action = `{{ url('/users') }}/${button.dataset.id}`;
        document.getElementById('edit_join_date').value = button.dataset.joinDate;
        document.getElementById('edit_name').value = button.dataset.name;
        document.getElementById('edit_email').value = button.dataset.email;
        document.getElementById('edit_role').value = button.dataset.role;
        document.getElementById('edit_course_title').value = button.dataset.courseTitle;
        document.getElementById('edit_subscription_date').value = button.dataset.subscriptionDate;
        document.getElementById('edit_plan').value = button.dataset.plan || 'Free';
        document.getElementById('edit_renewal_date').value = button.dataset.renewalDate;
        document.getElementById('edit_status').value = button.dataset.status || 'Active';
        openUserDrawer(editUserDrawer);
        }));
    </script>
@endsection
