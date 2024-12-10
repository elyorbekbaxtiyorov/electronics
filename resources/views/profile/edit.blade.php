@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Profile</h1>

    <!-- Update Profile Form -->
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>

    <!-- Delete Profile Form -->
    <form action="{{ route('profile.destroy') }}" method="POST" class="mt-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete Profile</button>
    </form>
</div>
@endsection
