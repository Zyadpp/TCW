@extends('layouts.admin')

@push('page-styles')
    <style>
        .settings-layout-page .support-card { min-height: 1075px; padding: 29px 24px; overflow: hidden; border-radius: 20px; background: #fff; box-shadow: 0 12px 34px rgba(37,29,14,.045); }
        .support-card h2 { margin: 0; color: #292929; font-size: 17px; font-weight: 600; }
        .support-filters { display: flex; gap: 8px; margin: 20px 0 22px; }
        .support-filter { padding: 7px 13px; border: 1px solid #d9d9d9; border-radius: 18px; background: #fff; color: #b3b3b3; font-size: 10px; line-height: 1; cursor: pointer; }
        .support-filter.active { border-color: #f2e8d8; background: #f2e8d8; color: #bb8b45; }
        .support-table-wrap { overflow-x: auto; }
        .support-table { width: 100%; min-width: 720px; border-collapse: collapse; }
        .support-table th { padding: 0 0 22px; color: #393939; font-size: 7px; font-weight: 500; text-align: left; white-space: nowrap; }
        .support-table td { height: 58px; padding: 0; color: #303030; font-size: 10px; vertical-align: middle; white-space: nowrap; }
        .support-table th:nth-child(1), .support-table td:nth-child(1) { width: 14%; }
        .support-table th:nth-child(2), .support-table td:nth-child(2) { width: 18%; }
        .support-table th:nth-child(3), .support-table td:nth-child(3) { width: 22%; }
        .support-table th:nth-child(4), .support-table td:nth-child(4) { width: 13%; }
        .support-table th:nth-child(5), .support-table td:nth-child(5) { width: 13%; }
        .support-table th:nth-child(6), .support-table td:nth-child(6) { width: 14%; }
        .support-person { display: flex; align-items: center; gap: 9px; }
        .support-person img { width: 24px; height: 24px; border-radius: 50%; object-fit: cover; }
        .support-person strong, .support-person small { display: block; }
        .support-person strong { color: #292929; font-size: 12px; font-weight: 600; }
        .support-person small { margin-top: 2px; color: #616161; font-size: 9px; }
        .support-status { display: inline-block; min-width: 61px; padding: 5px 10px; border-radius: 14px; background: #dcebe5; color: #43866e; font-size: 8px; text-align: center; }
        .support-status.pending { background: #f7ead6; color: #c69447; }
        .support-actions { border: 0; background: transparent; color: #363636; font-size: 17px; cursor: pointer; }
        .support-empty { display: none; padding: 35px 0; color: #999; font-size: 12px; text-align: center; }
        @media (min-width: 801px) and (max-height: 1100px) {
            .settings-layout-page .support-card { min-height: 0; height: calc(100vh - 80px); padding: 18px 16px; }
            .support-card h2 { font-size: 14px; }
            .support-filters { margin: 13px 0 16px; }
            .support-filter { padding: 6px 11px; font-size: 9px; }
            .support-table th { padding-bottom: 15px; font-size: 6px; }
            .support-table td { height: 47px; font-size: 9px; }
            .support-person img { width: 21px; height: 21px; }
            .support-person strong { font-size: 10px; }
            .support-person small, .support-status { font-size: 7px; }
        }
        @media (max-width: 800px) { .settings-layout-page .support-card { min-height: 0; padding: 20px 16px; } }
    </style>
@endpush

@section('content')
    <section class="settings-page support-page">
        <h1>Setting</h1>
        <div class="settings-layout">
            @include('admin.settings.partials.sidebar')
            <main class="support-card">
                <h2>Support &amp; Complaints</h2>
                <div class="support-filters" aria-label="Complaint status filters">
                    <button class="support-filter active" type="button" data-filter="all">All</button>
                    <button class="support-filter" type="button" data-filter="resolved">Resolved</button>
                    <button class="support-filter" type="button" data-filter="pending">Pending</button>
                </div>
                <div class="support-table-wrap">
                    <table class="support-table">
                        <thead><tr><th>CREATION DATE</th><th>COMPLAINT TITLE</th><th>ADDED BY</th><th>COMPLAINT TYPE</th><th>FILE UPLOADS</th><th>STATUS</th><th>ACTIONS</th></tr></thead>
                        <tbody>
                            @forelse ($tickets as $ticket)
                                <tr data-status="{{ strtolower($ticket->status) }}">
                                    <td>{{ $ticket->created_at->format('n/j/Y') }}</td><td>{{ $ticket->title }}</td>
                                    <td><div class="support-person"><img src="https://i.pravatar.cc/80?img=12" alt=""><span><strong>{{ $ticket->user?->name ?? 'Deleted user' }}</strong><small>{{ $ticket->user?->email ?? 'â€”' }}</small></span></div></td>
                                    <td>{{ $ticket->type }}</td><td>{{ $ticket->attachment ? 'File attached' : '-' }}</td>
                                    <td><span class="support-status {{ strtolower($ticket->status) }}">{{ $ticket->status }}</span></td>
                                    <td><form action="{{ route('settings.support.update', $ticket) }}" method="POST">@csrf @method('PUT')<select name="status" onchange="this.form.submit()"><option {{ $ticket->status === 'Pending' ? 'selected' : '' }}>Pending</option><option {{ $ticket->status === 'Resolved' ? 'selected' : '' }}>Resolved</option></select></form></td>
                                </tr>
                            @empty <tr><td colspan="7">No support tickets yet.</td></tr> @endforelse
                        </tbody>
                    </table>
                </div>
                <p class="support-empty" id="support-empty">No complaints match this status.</p>
            </main>
        </div>
    </section>
    <script>
        (() => {
            const filters = document.querySelectorAll('.support-filter');
            const rows = document.querySelectorAll('.support-table tbody tr');
            const empty = document.getElementById('support-empty');
            filters.forEach((filter) => filter.addEventListener('click', () => {
                filters.forEach((item) => item.classList.remove('active'));
                filter.classList.add('active');
                let shown = 0;
                rows.forEach((row) => { const visible = filter.dataset.filter === 'all' || row.dataset.status === filter.dataset.filter; row.hidden = !visible; if (visible) shown++; });
                empty.style.display = shown ? 'none' : 'block';
            }));
        })();
    </script>
@endsection
