@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center p-4">
            <div class="card">
                <img class="card-img-top p-5" src="{{ asset('product_images/' . $product['image'])}}"
                     alt="Card image cap">
                <div class="card-body">
                    <h2 class="card-title">{{ $product->title }}</h2>
                    <p class="card-text">{{ $product->subtitle }} | {{ $product->tag_id}}</p>
                    <p class="card-text">{{ $product->price }}</p>
                    <p class="card-text">{{ $product->description }}</p>
                    <p class="card-text">Product owned by {{ $product->product_owner }}</p>

                    <a class="btn btn-secondary">Add to list</a>
                </div>
            </div>
        </div>
    </div>
@endsection
