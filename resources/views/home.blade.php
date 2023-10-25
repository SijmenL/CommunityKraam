@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center p-4">
            @if(Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
                @if(Session::has('succes'))
                    <div class="alert alert-success" role="alert">
                        {{ session('succes') }}
                    </div>
                @endif

            <h1>Welcome, {{ auth()->user()->username }}</h1>
            <p>You have 0 lists, {{ $product_count }} products and 0 favourites!</p>
            <h2>Your Lists</h2>
            <h2>Your Products</h2>
            <div class="flex-wrap d-flex justify-content-center flex-row justify-content-center" style="gap: 15px;">
                @foreach ($own_products as $own_product)
                    <div class="card" style="width: 18rem;">
                        <div class="" style="height: 200px; overflow: hidden">
                            <img class="card-img-top" style="object-fit: contain"
                                 src="{{ asset('product_images/' . $own_product['image'])}}"
                                 alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h2 class="card-title d-flex align-items-center gap-2">
                                {{ $own_product->title }}
                                    @if ($own_product->price == 0)
                                    <span class="badge bg-info" style="font-size: small">Free</span>
                                    @else
                                    <span class="badge bg-secondary" style="font-size: small">{{ $own_product->valuta . $own_product->price }}</span>
                                    @endif
                            </h2>
                            <p class="card-text">{{ $own_product->description }}</p>
                            <a href="{{ route('product.show', ['id' => $own_product->id]) }}" class="btn btn-success">View
                                product</a>
                            <a href="{{ route('product.edit', ['id' => $own_product->id]) }}"
                               class="btn btn-outline-warning">Edit</a>
                            <a class="delete-button btn btn-outline-danger" data-id="{{ $own_product->id }}">Delete</a>

                        </div>
                    </div>
                @endforeach
            </div>
            <div class="p-1 d-flex justify-content-center">
                <a class="btn btn-primary mt-5" href="{{ route('products.list') }}">View All Products</a>
            </div>
        </div>
    </div>
@endsection
