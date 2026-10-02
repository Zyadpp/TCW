<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Programme;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $role = $request->input('role', 'Student');

        $users = User::query()
            ->where('role', $role)
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        $programmes = Programme::orderBy('title')->get();

        return view('admin.users.index', compact('users', 'programmes'));
    }

///////////////////////////////////////////////////
    public function create()
    {
        return redirect()->route('users.index');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'join_date' => ['nullable', 'date'],
            'role' => ['required', 'in:Student,Mentor'],
            'course_title' => ['nullable', 'string', 'max:255'],
            'subscription_date' => ['nullable', 'date'],
            'plan' => ['nullable', 'in:Free,Premium'],
            'renewal_date' => ['nullable', 'date'],
            'status' => ['required', 'in:Active,Inactive'],
        ]);

        User::create([
            ...$validated,
            'password'          => bcrypt('12345678'),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User added successfully');
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'join_date' => ['nullable', 'date'],
            'role' => ['required', 'in:Student,Mentor'],
            'course_title' => ['nullable', 'string', 'max:255'],
            'subscription_date' => ['nullable', 'date'],
            'plan' => ['nullable', 'in:Free,Premium'],
            'renewal_date' => ['nullable', 'date'],
            'status' => ['required', 'in:Active,Inactive'],
        ]);

        $user->update($validated);

        return redirect()->route('users.index', ['role' => $user->role])
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }

}
