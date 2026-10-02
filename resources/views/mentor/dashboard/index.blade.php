@extends('layouts.mentor')
@section('title', 'Mentor Dashboard')
@section('content')
    <section class="lms-card"><h1>Welcome, {{ $user->name }}</h1><p>Your mentor workspace is ready for students, programmes, and follow-up tools.</p></section>
@endsection
