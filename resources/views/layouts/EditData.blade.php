@extends('layouts.auth-master')
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1o8tXtHSJq8j4Io" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit User</h1>

        <form action="{{ route('users.update', $user->id) }}" method="POST" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user->name) }}" required autocomplete="off">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $user->email) }}" required autocomplete="off">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" name="password" id="password" autocomplete="off">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password:</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" autocomplete="off">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>

        <a href="{{ route('ManageUsers') }}" class="btn btn-secondary mt-3">Back to Users</a>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-QFegUPIbMgDuoO/VnIL6fEOytbBsEbPzseQcoHlp3y7lFIUR/gYzrwQ1tfsOJXzE" crossorigin="anonymous"></script>
</body>
</html>
