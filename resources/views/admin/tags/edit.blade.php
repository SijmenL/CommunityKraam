@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center p-4">
            <h1>Edit tag</h1>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('tag-management') }}">Tag Management</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit tag</li>
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

            <form method="POST" action="{{ route('tag-management.store', $tag) }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Title</label>
                    <input class="form-control" id="name" type="text" name="name" placeholder="Enter the name"
                           value="{{ $tag->name }}">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>

                    <textarea class="form-control" id="description" type="text" name="description"
                              placeholder="Enter the description">{{ $tag->description }}</textarea>
                    @error('description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-primary mt-4" type="submit">Update</button>

            </form>
@endsection
