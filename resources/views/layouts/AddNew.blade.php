@extends('layouts.auth-master')

@section('title', 'Create User')

@section('content')
    <!-- Menyertakan Bootstrap CSS -->
    <link href="{!! url('/css/bootstrap.min.css') !!}" rel="stylesheet">
    <h1>Create User</h1>

    <form action="{{ route('users.store') }}" method="POST" autocomplete="off">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" name="name" id="name" class="form-control" required autocomplete="off">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required autocomplete="off">
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" name="username" id="username" class="form-control" required autocomplete="off">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required autocomplete="new-password">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>

    <a href="{{ route('ManageUsers') }}" class="btn btn-secondary mt-3">Back to Users</a>

    <!-- Menyertakan Bootstrap JS -->
    <script src="{!! url('/js/bootstrap.bundle.min.js') !!}"></script>
@endsection
