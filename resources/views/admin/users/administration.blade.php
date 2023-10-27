@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center p-4">
            <h1>Account Administration</h1>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Account Administration</li>
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

            <table class="table table-striped">
                <thead class="thead-dark table-bordered table-hover">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Options</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($users as $user)
                    <tr id="{{ $user->id }}">
                        <th>{{ $user->id }}</th>
                        <th>{{ $user->name }}</th>
                        <th>{{ $user->last_name }}</th>
                        <th>{{ $user->username }}</th>
                        <th>{{ $user->email }}</th>
                        <th class="d-flex flex-row flex-wrap gap-2">
                            <a href="{{ route('account-administration.edit', ['id' => $user->id]) }}"
                               class="btn btn-outline-warning">Edit</a>
                            <a class="delete-button btn btn-outline-danger"
                               data-id="{{ $user->id }}"
                               data-link="{{ route('account-administration.delete', $user->id) }}">Delete</a>
                            <form method="POST" action="{{ route('account-administration.update.active') }}"
                                  class="d-flex align-items-center gap-2">
                                @csrf
                                <label for="active-{{ $user->id }}">Active</label>
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <label class="switch">
                                    <input onchange="this.form.submit()" id="active-{{ $user->id }}"
                                           type="checkbox"
                                           name="active" {{ $user->active ? 'checked' : '' }}>
                                    <span class="slider round"></span>

                                </label>
                            </form>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
