<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Programme;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $payments = Payment::with(['user', 'programme'])
            ->when($request->filled('role'), function ($query) use ($request) {
                $query->whereHas('user', fn ($userQuery) => $userQuery->where('role', $request->role));
            })
            ->latest('paid_at')
            ->paginate(10)
            ->withQueryString();

        $completedPayments = Payment::where('status', 'Paid')->sum('amount');
        $pendingPayments = Payment::where('status', 'Pending')->sum('amount');
        $students = User::where('role', 'Student')->count();
        $mentors = User::where('role', 'Mentor')->count();
        $users = User::orderBy('name')->get();
        $programmes = Programme::orderBy('title')->get();

        return view('admin.payments.index', compact(
            'payments', 'completedPayments', 'pendingPayments', 'students', 'mentors', 'users', 'programmes'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'paid_at' => ['required', 'date'],
            'user_id' => ['required', 'exists:users,id'],
            'programme_id' => ['nullable', 'exists:programmes,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'method' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:Paid,Pending,Canceled'],
        ]);

        Payment::create($validated);

        return back()
            ->with('success', 'Transaction added successfully.');
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'paid_at' => ['required', 'date'],
            'user_id' => ['required', 'exists:users,id'],
            'programme_id' => ['nullable', 'exists:programmes,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'method' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:Paid,Pending,Canceled'],
        ]);

        $payment->update($validated);

        return back()
            ->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return back()
            ->with('success', 'Transaction deleted successfully.');
    }
}
