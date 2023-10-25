@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center p-4">
            <h1>All products</h1>

            <div class="d-flex align-items-center gap-2 mb-5">
                <label class="switch">
                    <input id="own-switch" type="checkbox" checked>
                    <span class="slider round"></span>
                </label>
                <label for="own-switch">View own products</label>
            </div>

            <div class="flex-wrap d-flex justify-content-center flex-row justify-content-center" style="gap: 15px;">
                @foreach ($products as $product)
                    @if ($product->product_owner === Auth::id())
                        <div class="card bg-dark-subtle owned-product" style="width: 18rem;">
                            <div class="" style="height: 200px; overflow: hidden">
                                <img class="card-img-top" style="object-fit: contain"
                                     src="{{ asset('product_images/' . $product['image'])}}"
                                     alt="Card image cap">
                            </div>
                            <div class="card-body">
                                <h2 class="card-title d-flex align-items-center gap-2">
                                    {{ $product->title }}
                                    @if ($product->price == 0)
                                        <span class="badge bg-info" style="font-size: small">Free</span>
                                    @else
                                        <span class="badge bg-secondary"
                                              style="font-size: small">{{ $product->valuta . $product->price }}</span>
                                    @endif
                                </h2>
                                <p class="card-text">{{ $product->description }}</p>
                                <div class="d-flex flex-row flex-wrap gap-1">
                                    <a class="btn btn-secondary">Add to list</a>
                                    <a href="{{ route('product.show', ['id' => $product->id]) }}"
                                       class="btn btn-outline-success">View
                                        product</a>
                                    <a href="{{ route('product.edit', ['id' => $product->id]) }}"
                                       class="btn btn-outline-warning">Edit</a>
                                    <a class="delete-button btn btn-outline-danger"
                                       data-id="{{ $product->id }}">Delete</a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card" style="width: 18rem;">
                            <div class="" style="height: 200px; overflow: hidden">
                                <img class="card-img-top" style="object-fit: contain"
                                     src="{{ asset('product_images/' . $product['image'])}}"
                                     alt="Card image cap">
                            </div>
                            <div class="card-body">
                                <h2 class="card-title d-flex align-items-center gap-2">
                                    {{ $product->title }}
                                    @if ($product->price == 0)
                                        <span class="badge bg-info" style="font-size: small">Free</span>
                                    @else
                                        <span class="badge bg-secondary"
                                              style="font-size: small">{{ $product->valuta . $product->price }}</span>
                                    @endif
                                </h2>
                                <p class="card-text">{{ $product->description }}</p>
                                <a class="btn btn-secondary">Add to list</a>
                                <a href="{{ route('product.show', ['id' => $product->id]) }}"
                                   class="btn btn-outline-success">View
                                    product</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

@endsection
