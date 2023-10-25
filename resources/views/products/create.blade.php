@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center p-4">
        <h1>Create a new product</h1>

        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                Product successfully added to our database!
            </div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger" role="alert">
            Something went wrong, please check the form and try again.
        </div>
        @endif
        @if(Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif



        <form method="POST" action="{{ route('product.create.store') }}" enctype="multipart/form-data">
            @csrf
            <h2>General information</h2>
            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" id="title" type="text" name="title" placeholder="Enter the title" value="{{ old('title') }}">
                @error('title')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="subtitle">Subtitle</label>
                <input class="form-control" id="subtitle" type="text" name="subtitle" placeholder="Optional subtitle or tagline" value="{{ old('subtitle') }}">
                @error('subtitle')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" type="text" name="description"
                          placeholder="Enter the description">{{ old('description') }}</textarea>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input class="form-control" id="image" type="file" name="image" accept="image/*">
                @error('image')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <h2 class="mt-4">Important details</h2>
            <div class="form-group">
                <label for="tags">Tags</label>
                <div class="custom-select">
                    <select id="select-tags" class="d-none" id="tags" name="tags[]" multiple>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex flex-wrap gap-1" id="button-container">
                </div>

                <small>Select one or multiple tags that match the product.</small>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input class="form-control" id="price" type="text" name="price" placeholder="Enter the price" value="{{ old('price') }}">
                @error('price')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="valuta">Valuta</label>
                <select class="form-control" id="valuta" name="valuta">
                    <option value="€">EUR</option>
                    <option value="$">USD</option>
                    <option value="$">CAD</option>
                    <option value="£">GBP</option>
                </select>
                @error('valuta')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <button class="btn btn-primary mt-4" type="submit">Submit</button>
        </form>
    </div>
    </div>
@endsection
