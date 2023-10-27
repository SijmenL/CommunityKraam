@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center p-4">
            <h1>Admin dashboard</h1>
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
            <p>Welcome, {{ auth()->user()->username }}</p>


            <div class="d-flex flex-wrap flex-row gap-5">

                <a class="btn btn-outline-primary" href="{{ route('tag-management') }}">
                    <span class="material-symbols-outlined" style="font-size: 50px">sell</span>
                    <p>Tag Management</p>
                </a>
                <a class="btn btn-outline-primary" href="{{ route('account-administration') }}">
                    <span class="material-symbols-outlined" style="font-size: 50px">manage_accounts</span>
                    <p>Account Administration</p>
                </a>
            </div>
        </div>
    </div>
@endsection
