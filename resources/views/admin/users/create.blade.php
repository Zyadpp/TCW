@extends('layouts.admin')
@section('content')
    <div class="form-card">
    <h2>New User</h2>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
        <label>User name</label>
            <input type="text" name="name"
            placeholder="Ahmed Ali">
        <label>Email address</label>
            <input type="email" name="email"
            placeholder="Ahmed@gmail.com">
        <label>The role</label>
            <select name="role">
            <option value="student">Student</option>
            <option value="mentor">Mentor</option>
            </select>
        <label>Status</label>
            <select name="status">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
            </select>
            <div class="form-buttons">
                <button type="button">
                    Cancel
                </button>
                <button type="submit">
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection
