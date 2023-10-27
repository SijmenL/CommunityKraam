@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center p-4">
            <h1>Edit account</h1>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('account-administration') }}">Account Administration</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit account</li>
                </ol>
            </nav>

            @if(Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('account-administration.store', $user) }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" id="name" type="text" name="name" placeholder="Enter the first name"
                           value="{{ $user->name }}">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input class="form-control" id="last_name" type="text" name="last_name" placeholder="Enter the last name"
                           value="{{ $user->last_name }}">
                    @error('last_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="username">User Name</label>
                    <input class="form-control" id="username" type="text" name="username" placeholder="Enter the username"
                           value="{{ $user->username }}">
                    @error('username')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" id="email" type="text" name="email" placeholder="Enter the email"
                           value="{{ $user->email }}">
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">New password</label>
                    <input class="form-control" id="password" type="text" name="password" value=" ">
                    <small>This field is not required, leaving it blank doesn't update the password.</small>
                </div>
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role">
                        <option value="admin" {{ $user->role === 'administrator' ? 'selected' : '' }}>Administrator</option>
                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                    </select>

                    @error('role')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-primary mt-4" type="submit">Update</button>

            </form>
@endsection
