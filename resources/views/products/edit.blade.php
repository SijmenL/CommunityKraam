@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center p-4">
        <h1>Edit product {{ $product->title }}</h1>

        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                Product successfully updated!
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                Something went wrong, please check the input fields and try again.
            </div>
        @endif
        @if(Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif


        <form method="POST" action="{{ route('product.edit.store', $product) }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" id="title" type="text" name="title" placeholder="Enter the title"
                       value="{{ $product->title }}">
                @error('title')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="subtitle">Subtitle</label>
                <input class="form-control" id="subtitle" type="text" name="subtitle"
                       placeholder="Optional subtitle or tagline" value="{{ $product->subtitle }}">
                @error('subtitle')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>

                <textarea class="form-control" id="description" type="text" name="description"
                          placeholder="Enter the description">{{ $product->description }}</textarea>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex flex-row align-items-center flex-wrap">
                <div class="form-group">
                    <label for="image">Image</label>
                    <input class="form-control" id="image" type="file" name="image" accept="image/*">
                    @error('image')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <img class="card-img-top m-3" style="max-width: 250px; border-radius: 15px;"
                     src="{{ asset('product_images/' . $product['image'])}}" alt="Card image cap">
            </div>
            <div class="form-group">
                <label for="tags">Tags</label>
                <div class="custom-select">
                <select id="select-tags" class="d-none" id="tags" name="tags[]" multiple>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" {{ in_array($tag->id, $selectedTags) ? 'selected' : '' }}>
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
                <input class="form-control" id="price" type="text" name="price" placeholder="Enter the price"
                       value="{{ $product->price }}">
                @error('price')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="valuta">Valuta</label>
                <select class="form-control" id="valuta" name="valuta">
                    @if($product->valuta == 'EUR')
                        <option value="€" selected="selected">EUR</option>
                    @else
                        <option value="€">EUR</option>
                    @endif
                    @if($product->valuta == 'USD')
                        <option value="$" selected="selected">USD</option>
                    @else
                        <option value="$">USD</option>
                    @endif
                    @if($product->valuta == 'CAD')
                        <option value="$" selected="selected">CAD</option>
                    @else
                        <option value="$">CAD</option>
                    @endif
                    @if($product->valuta == 'GBP')
                        <option value="£" selected="selected">GBP</option>
                    @else
                        <option value="£">GBP</option>
                    @endif
                </select>
                @error('valuta')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-primary mt-4" type="submit">Update</button>


        </form>
        </div>
    </div>
@endsection
