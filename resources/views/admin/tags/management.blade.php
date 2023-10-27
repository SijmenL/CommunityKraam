@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center p-4">
            <h1>Tag management</h1>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tag Management</li>
                </ol>
            </nav>

            <a href="{{ route('tag-management.create') }}">+ Create a new tag</a>

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
                    <th scope="col">Description</th>
                    <th scope="col">Options</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($tags as $tag)
                    <tr id="{{ $tag->id }}">
                        <th>{{ $tag->id }}</th>
                        <th>{{ $tag->name }}</th>
                        <th>{{ $tag->description }}</th>
                        <th>
                            <a href="{{ route('tag-management.edit', ['id' => $tag->id]) }}"
                               class="btn btn-outline-warning">Edit</a>
                            <a class="delete-button btn btn-outline-danger"
                               data-id="{{ $tag->id }}" data-link="{{ route('tag-management.delete', $tag->id) }}">Delete</a>
                        </th>
                    </tr>
            @endforeach
                </tbody>
            </table>

         </div>
        </div>
@endsection
