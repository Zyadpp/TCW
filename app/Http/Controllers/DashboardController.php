<?php

namespace App\Http\Controllers;

use App\Models\Programme;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $students = User::where('role', 'Student')->count();
        $mentors = User::where('role', 'Mentor')->count();
        $subscriptions = User::whereNotNull('subscription_date')->count();
        $programmeCount = Programme::count();
        $completedPayments = Payment::where('status', 'Paid')->sum('amount');
        $recentPayments = Payment::with(['user', 'programme'])->latest('paid_at')->take(3)->get();
        $users = User::orderBy('name')->get(['id', 'name', 'email']);
        $programmes = Programme::orderBy('title')->get(['id', 'title']);
        $enrollmentPeriod = $request->input('enrollment_period', 'this_month');
        $periods = [
            'this_month' => ['This Month', now()->startOfMonth(), now()->endOfMonth()],
            'last_month' => ['Last Month', now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()],
            'last_6_months' => ['Last 6 Months', now()->subMonths(5)->startOfMonth(), now()->endOfMonth()],
        ];
        [$enrollmentPeriodLabel, $enrollmentStart, $enrollmentEnd] = $periods[$enrollmentPeriod] ?? $periods['this_month'];

        $newStudentsThisMonth = User::where('role', 'Student')
            ->whereBetween('created_at', [$enrollmentStart, $enrollmentEnd])
            ->count();

        $monthlyRevenue = collect(range(5, 0))->map(function ($monthsAgo) {
            $date = Carbon::now()->subMonths($monthsAgo);

            return [
                'label' => $date->format('M'),
                'value' => Payment::where('status', 'Paid')
                    ->whereBetween('paid_at', [$date->copy()->startOfMonth(), $date->copy()->endOfMonth()])
                    ->sum('amount'),
            ];
        });
        $maxMonthlyRevenue = max(1, $monthlyRevenue->max('value'));

        return view('admin.index', compact(
            'students', 'mentors', 'subscriptions', 'programmeCount', 'completedPayments',
            'recentPayments', 'users', 'programmes', 'newStudentsThisMonth', 'enrollmentPeriod', 'enrollmentPeriodLabel', 'monthlyRevenue', 'maxMonthlyRevenue'
        ));
    }

}
