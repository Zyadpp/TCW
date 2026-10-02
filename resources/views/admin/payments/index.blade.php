@extends('layouts.admin')
@section('content')
    <div class="payments-page">
        <div class="payment-stats">
            <article class="payment-stat">
            <p>Completed payments</p>
            <strong>EGP {{ number_format($completedPayments, 2) }}</strong>
            </article>
            <article class="payment-stat">
            <p>Pending payments</p>
            <strong>EGP {{ number_format($pendingPayments, 2) }}</strong>
            </article>
            <article class="payment-stat">
            <p>Students</p>
            <strong>{{ number_format($students) }}</strong>
            </article>
            <article class="payment-stat">
            <p>Mentors</p>
            <strong>{{ number_format($mentors) }}</strong>
            </article>
        </div>
        <div class="page-header payment-header">
            <div class="title-row">
            <h3>Transaction History</h3>
                <button type="button" class="new-user-btn-page" id="openPaymentDrawer" {{ $users->isEmpty() ? 'disabled' : '' }}>
                    <i class="bi bi-plus">
                </i> New Transaction</button>
            </div>
            <div class="programme-filters">
            <a href="{{ route('payments.index', ['role' => 'Student']) }}" class="programme-filter {{ request('role') === 'Student' ? 'active' : '' }}">Students</a>
            <a href="{{ route('payments.index', ['role' => 'Mentor']) }}" class="programme-filter {{ request('role') === 'Mentor' ? 'active' : '' }}">Mentors</a>
            </div>
        </div>
        <div class="table-card payment-table-card">
            <table class="table align-middle mb-0 payment-table">
                <thead>
                    <tr>
                    <th>DATE &amp; TIME</th>
                    <th>USER NAME</th>
                    <th>PROGRAMME TITLE</th>
                    <th>EARNINGS</th>
                    <th>METHOD</th>
                    <th>STATUS</th>
                    <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($payments as $payment)
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
                                    <summary><i class="bi bi-three-dots-vertical"></i></summary>
                                    <div>
                                        <button type="button" class="edit-payment"
                                                data-id="{{ $payment->id }}"
                                                data-paid-at="{{ $payment->paid_at->format('Y-m-d') }}"
                                                data-user-id="{{ $payment->user_id }}"
                                                data-programme-id="{{ $payment->programme_id }}"
                                                data-amount="{{ $payment->amount }}"
                                                data-method="{{ $payment->method }}"
                                                data-status="{{ $payment->status }}">Edit</button>
                                        <form action="{{ route('payments.destroy', $payment) }}" method="POST" onsubmit="return confirm('Delete this transaction?')">
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
                        <td colspan="7" class="payment-empty">No transactions added yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="table-footer">
            <span>{{ $payments->total() ? $payments->firstItem().'-'.$payments->lastItem().' of '.$payments->total().' items' : 'No transactions yet' }}</span>
            <div class="pagination-label">
                <strong>{{ $payments->currentPage() }}</strong> of {{ $payments->lastPage() }} pages
                @if ($payments->onFirstPage())
                    <button type="button" aria-label="Previous page" disabled><i class="bi bi-chevron-left"></i></button>
                @else
                    <a href="{{ $payments->previousPageUrl() }}" aria-label="Previous page"><i class="bi bi-chevron-left"></i></a>
                @endif
                @if ($payments->hasMorePages())
                    <a href="{{ $payments->nextPageUrl() }}" aria-label="Next page"><i class="bi bi-chevron-right"></i></a>
                @else
                    <button type="button" aria-label="Next page" disabled><i class="bi bi-chevron-right"></i></button>
                @endif
            </div>
        </div>
    </div>
    <div id="paymentDrawerOverlay" class="drawer-overlay">
    </div>
    <div id="paymentDrawer" class="user-drawer payment-drawer" aria-hidden="true">
        <div class="drawer-header">
        <h3>New Transaction</h3>
        <button type="button" id="closePaymentDrawer" aria-label="Close new transaction form">&times;</button>
        </div>
        <form class="new-user-form" action="{{ route('payments.store') }}" method="POST">
            @csrf
            <div class="form-field">
            <label for="paid_at">Date</label>
                <input id="paid_at" type="date" name="paid_at" value="{{ now()->format('Y-m-d') }}" required>
            </div>
            <div class="form-field">
            <label for="payment_user">User name</label>
                <select id="payment_user" name="user_id" required>
                @foreach ($users as $user)<option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-field">
            <label for="payment_programme">Programme title</label>
                <select id="payment_programme" name="programme_id" {{ $programmes->isEmpty() ? 'disabled' : '' }}>
                @forelse ($programmes as $programme)<option value="{{ $programme->id }}">{{ $programme->title }}</option>
                @empty<option>No programmes available</option>
                    @endforelse
                </select>
            </div>
            <div class="form-field">
            <label for="payment_amount">Price</label>
                <input id="payment_amount" type="number" name="amount" min="0" step="0.01" placeholder="99" required>
            </div>
            <div class="form-field">
            <label for="payment_method">Method</label>
                <input id="payment_method" type="text" name="method" value="Credit Card" required>
            </div>
            <div class="form-field">
            <label for="payment_status">Status</label>
                <select id="payment_status" name="status">
                <option value="Paid">Paid</option>
                <option value="Pending">Pending</option>
                <option value="Canceled">Canceled</option>
                </select>
            </div>
            <div class="drawer-buttons">
            <button type="button" id="cancelPaymentDrawer">Cancel</button>
            <button type="submit">Save</button>
            </div>
        </form>
    </div>
    <div id="editPaymentDrawer" class="user-drawer payment-drawer" aria-hidden="true">
        <div class="drawer-header"><h3>Edit Transaction</h3><button type="button" data-close-payment>&times;</button></div>
        <form id="editPaymentForm" class="new-user-form" method="POST">
            @csrf
            @method('PUT')
            <div class="form-field"><label>Date</label><input id="editPaidAt" type="date" name="paid_at" required></div>
            <div class="form-field"><label>User name</label><select id="editPaymentUser" name="user_id" required>@foreach ($users as $user)<option value="{{ $user->id }}">{{ $user->name }}</option>@endforeach</select></div>
            <div class="form-field"><label>Programme title</label><select id="editPaymentProgramme" name="programme_id">@foreach ($programmes as $programme)<option value="{{ $programme->id }}">{{ $programme->title }}</option>@endforeach</select></div>
            <div class="form-field"><label>Price</label><input id="editPaymentAmount" type="number" name="amount" min="0" step="0.01" required></div>
            <div class="form-field"><label>Method</label><input id="editPaymentMethod" name="method" required></div>
            <div class="form-field"><label>Status</label><select id="editPaymentStatus" name="status"><option value="Paid">Paid</option><option value="Pending">Pending</option><option value="Canceled">Canceled</option></select></div>
            <div class="drawer-buttons"><button type="button" data-close-payment>Cancel</button><button type="submit">Save changes</button></div>
        </form>
    </div>
    <script>
        const paymentDrawer = document.getElementById('paymentDrawer');
        const editPaymentDrawer = document.getElementById('editPaymentDrawer');
        const paymentOverlay = document.getElementById('paymentDrawerOverlay');
        const paymentDrawers = [paymentDrawer, editPaymentDrawer];
        const closePaymentDrawer = () => { paymentDrawers.forEach((drawer) => { drawer.classList.remove('active'); drawer.setAttribute('aria-hidden', 'true'); }); paymentOverlay.classList.remove('active'); document.body.style.overflow = 'auto'; };
        const showPaymentDrawer = (drawer) => { drawer.classList.add('active'); drawer.setAttribute('aria-hidden', 'false'); paymentOverlay.classList.add('active'); document.body.style.overflow = 'hidden'; };
        const openPaymentDrawer = document.getElementById('openPaymentDrawer');
        if (openPaymentDrawer) openPaymentDrawer.addEventListener('click', () => showPaymentDrawer(paymentDrawer));
        document.getElementById('closePaymentDrawer').addEventListener('click', closePaymentDrawer);
        document.getElementById('cancelPaymentDrawer').addEventListener('click', closePaymentDrawer);
        paymentOverlay.addEventListener('click', closePaymentDrawer);
        document.querySelectorAll('[data-close-payment]').forEach((button) => button.addEventListener('click', closePaymentDrawer));
        document.querySelectorAll('.edit-payment').forEach((button) => button.addEventListener('click', () => {
            document.getElementById('editPaymentForm').action = `{{ url('/payments') }}/${button.dataset.id}`;
            document.getElementById('editPaidAt').value = button.dataset.paidAt;
            document.getElementById('editPaymentUser').value = button.dataset.userId;
            document.getElementById('editPaymentProgramme').value = button.dataset.programmeId;
            document.getElementById('editPaymentAmount').value = button.dataset.amount;
            document.getElementById('editPaymentMethod').value = button.dataset.method;
            document.getElementById('editPaymentStatus').value = button.dataset.status;
            showPaymentDrawer(editPaymentDrawer);
        }));
    </script>
@endsection
