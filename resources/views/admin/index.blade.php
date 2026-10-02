@extends('layouts.admin')
@section('content')
<div class="dashboard-page">
    @if (session('success'))
    <div class="dashboard-flash">{{ session('success') }}</div>
    @endif
    <div class="dashboard-stats">
        <article class="dashboard-stat earning-stat">
            <span class="stat-icon">
                <i class="bi bi-bar-chart-line">
                </i>
            </span>
            <div>
                <p>Earnings</p>
                <strong> {{ number_format($completedPayments, 2) }}</strong>
            </div>
        </article>
        <article class="dashboard-stat">
            <div>
                <p>Subscriptions</p>
                <strong>{{ number_format($subscriptions) }}</strong>
                <small>{{ $programmeCount }} programmes</small>
            </div>
        </article>
        <article class="dashboard-stat">
            <div>
                <p>Students</p>
                <strong>{{ number_format($students) }}</strong>
            </div>
        </article>
        <article class="dashboard-stat">
            <div>
                <p>Mentors</p>
                <strong>{{ number_format($mentors) }}</strong>
            </div>
        </article>
    </div>
    <div class="dashboard-charts">
        <section class="dashboard-card revenue-card">
            <h4>Monthly Revenue Overview</h4>
            <strong class="revenue-total"> {{ number_format($completedPayments, 2) }}</strong>
            <div class="revenue-bars">
                @foreach ($monthlyRevenue as $month)
                <div class="revenue-bar-item">
                    <div class="bar-track">
                        <span style="height: {{ $month['value'] ? max(8, ($month['value'] / $maxMonthlyRevenue) * 100) : 3 }}%">
                        </span>
                    </div>
                    <small>{{ $month['label'] }}</small>
                </div>
                @endforeach
            </div>
            <p class="chart-note">Completed payment revenue for the last 6 months.</p>
        </section>
        <section class="dashboard-card enrollment-card">
            <div class="chart-head">
                <h4>New Enrolled Students</h4>
                <form class="dashboard-period-form" method="GET">
                    <select name="enrollment_period" onchange="this.form.submit()" aria-label="Enrollment period">
                        <option value="this_month" {{ $enrollmentPeriod === 'this_month' ? 'selected' : '' }}>This Month</option>
                        <option value="last_month" {{ $enrollmentPeriod === 'last_month' ? 'selected' : '' }}>Last Month</option>
                        <option value="last_6_months" {{ $enrollmentPeriod === 'last_6_months' ? 'selected' : '' }}>Last 6 Months</option>
                    </select>
                </form>
            </div>
            <div class="line-chart">
                <div class="line-grid">
                </div>
                <svg viewBox="0 0 600 210" preserveAspectRatio="none" aria-label="Student enrollment chart">
                    <polyline points="0,174 75,174 150,174 225,174 300,174 375,174 450,174 525,174 600,174" />
                </svg>
                <div class="line-empty">{{ $newStudentsThisMonth }} new student{{ $newStudentsThisMonth === 1 ? '' : 's' }} in {{ strtolower($enrollmentPeriodLabel) }}</div>
            </div>
        </section>
    </div>
    <div class="transaction-heading">
        <h3 class="transaction-title">Transaction History</h3>
    </div>
    <section class="dashboard-card transaction-card">
        <table class="table mb-0 transaction-table">
            <thead>
                <tr>
                    <th>DATE &amp; TIME</th>
                    <th>USER NAME</th>
                    <th>PROGRAMME TITLE</th>
                    <th>PRICE</th>
                    <th>METHOD</th>
                    <th>STATUS</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentPayments as $payment)
                <tr>
                    <td>{{ $payment->paid_at->format('d M, h:i A') }}</td>
                    <td>
                        <div class="user-info">
                            <img src="https://i.pravatar.cc/40?u={{ urlencode($payment->user->email) }}" alt="">
                            <div>
                                <strong>{{ $payment->user->name }}</strong>
                                <small>{{ $payment->user->email }}</small>
                            </div>
                        </div>
                    </td>
                    <td>{{ $payment->programme?->title ?? '---' }}</td>
                    <td>
                        <strong>{{ number_format($payment->amount, 2) }}</strong>
                    </td>
                    <td>{{ $payment->method }}</td>
                    <td>
                        <span class="status {{ strtolower($payment->status) }}">{{ $payment->status }}</span>
                    </td>
                    <td class="actions">
                        <details class="mastermind-actions">
                            <summary aria-label="Transaction actions"><i class="bi bi-three-dots-vertical"></i></summary>
                            <div>
                                <button type="button" class="dashboard-edit-payment"
                                    data-update-url="{{ route('payments.update', $payment) }}"
                                    data-paid-at="{{ $payment->paid_at->format('Y-m-d') }}"
                                    data-user-id="{{ $payment->user_id }}"
                                    data-programme-id="{{ $payment->programme_id }}"
                                    data-amount="{{ $payment->amount }}"
                                    data-method="{{ $payment->method }}"
                                    data-status="{{ $payment->status }}">Edit</button>
                                <form action="{{ route('payments.destroy', $payment) }}" method="POST" onsubmit="return confirm('Delete this transaction?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="delete-group" type="submit">Delete</button>
                                </form>
                            </div>
                        </details>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="empty-transactions">No transactions yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="table-footer">
            <span>{{ $recentPayments->isEmpty() ? 'No transactions yet' : 'Latest '.$recentPayments->count().' transactions' }}</span>
            <div class="pagination-label">
                <strong>1</strong> of 1 pages
            </div>
        </div>
    </section>
</div>
<div id="dashboardPaymentOverlay" class="drawer-overlay"></div>
<aside id="dashboardPaymentDrawer" class="user-drawer payment-drawer" aria-hidden="true">
    <div class="drawer-header">
        <h3 id="dashboardPaymentTitle">Edit payment</h3>
        <button type="button" data-close-dashboard-payment aria-label="Close">&times;</button>
    </div>
    <form id="dashboardPaymentForm" class="new-user-form" action="#" method="POST">
        @csrf
        <input id="dashboardPaymentMethod" type="hidden" name="_method" value="PUT">
        <div class="form-field">
            <label for="dashboardPaidAt">Date</label>
            <input id="dashboardPaidAt" type="date" name="paid_at" value="{{ now()->format('Y-m-d') }}" required>
        </div>
        <div class="form-field">
            <label for="dashboardPaymentUser">User</label>
            <select id="dashboardPaymentUser" name="user_id" required>
                @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-field">
            <label for="dashboardPaymentProgramme">Programme</label>
            <select id="dashboardPaymentProgramme" name="programme_id">
                <option value="">No programme</option>
                @foreach ($programmes as $programme)
                <option value="{{ $programme->id }}">{{ $programme->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-field">
            <label for="dashboardPaymentAmount">Amount</label>
            <input id="dashboardPaymentAmount" type="number" name="amount" min="0" step="0.01" required>
        </div>
        <div class="form-field">
            <label for="dashboardPaymentType">Method</label>
            <input id="dashboardPaymentType" type="text" name="method" value="Credit Card" required>
        </div>
        <div class="form-field">
            <label for="dashboardPaymentStatus">Status</label>
            <select id="dashboardPaymentStatus" name="status" required>
                <option value="Paid">Paid</option>
                <option value="Pending">Pending</option>
                <option value="Canceled">Canceled</option>
            </select>
        </div>
        <div class="drawer-buttons">
            <button type="button" data-close-dashboard-payment>Cancel</button>
            <button id="dashboardPaymentSubmit" type="submit">Save changes</button>
        </div>
    </form>
</aside>
<script>
    (() => {
        const drawer = document.getElementById('dashboardPaymentDrawer');
        const overlay = document.getElementById('dashboardPaymentOverlay');
        const form = document.getElementById('dashboardPaymentForm');
        const method = document.getElementById('dashboardPaymentMethod');
        const title = document.getElementById('dashboardPaymentTitle');
        const submit = document.getElementById('dashboardPaymentSubmit');
        const open = () => {
            drawer.classList.add('active');
            overlay.classList.add('active');
            drawer.setAttribute('aria-hidden', 'false');
        };
        const close = () => {
            drawer.classList.remove('active');
            overlay.classList.remove('active');
            drawer.setAttribute('aria-hidden', 'true');
        };
        document.querySelectorAll('[data-close-dashboard-payment]').forEach((button) => button.addEventListener('click', close));
        overlay.addEventListener('click', close);
        document.querySelectorAll('.dashboard-edit-payment').forEach((button) => button.addEventListener('click', () => {
            form.action = button.dataset.updateUrl;
            method.value = 'PUT';
            document.getElementById('dashboardPaidAt').value = button.dataset.paidAt;
            document.getElementById('dashboardPaymentUser').value = button.dataset.userId;
            document.getElementById('dashboardPaymentProgramme').value = button.dataset.programmeId || '';
            document.getElementById('dashboardPaymentAmount').value = button.dataset.amount;
            document.getElementById('dashboardPaymentType').value = button.dataset.method;
            document.getElementById('dashboardPaymentStatus').value = button.dataset.status;
            title.textContent = 'Edit payment';
            submit.textContent = 'Save changes';
            open();
        }));
    })();
</script>
@endsection