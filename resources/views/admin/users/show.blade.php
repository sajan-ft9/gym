<!-- resources/views/users/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">User Details</h1>

        <div class="card">
            <div class="card-header">
                <h4>{{ $user->name }}'s Profile</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if($user->image_path)
                            <img src="{{ asset('storage/' . $user->image_path) }}" alt="Profile Image" class="img-fluid rounded-circle">
                        @else
                            <img src="https://via.placeholder.com/150" alt="Profile Image" class="img-fluid rounded-circle">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <p><strong>Name:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Role:</strong> {{ $user->role }}</p>
                        <p><strong>District:</strong> {{ $user->district }}</p>
                        <p><strong>Address:</strong> {{ $user->address }}</p>
                        <p><strong>Age:</strong> {{ $user->age }}</p>
                        <p><strong>Gender:</strong> {{ $user->gender }}</p>
                        <p><strong>Education:</strong> {{ $user->education }}</p>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('admin.users.index') }}" class="btn btn-primary mt-4">Back to Users List</a>
    </div>
@endsection
