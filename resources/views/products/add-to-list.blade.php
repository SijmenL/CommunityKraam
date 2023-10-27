@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center p-4">
            <h1>Add {{ $product->title }} to a list</h1>

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
            <div class="d-flex flex-row gap-2">
                <div class="card w-25">
                    <img class="card-img-top p-5" src="{{ asset('product_images/' . $product['image'])}}"
                         alt="Card image cap">
                    <div class="card-body">
                        <h2 class="card-title">{{ $product->title }}</h2>
                        <p class="card-text">{{ $product->subtitle }} | {{ $product->tag_id}}</p>
                        <p class="card-header-pills d-flex flex-row gap-1 overflow-scroll">
                            @foreach ($product->tags as $tag)
                                <span class="badge bg-dark-subtle">{{ $tag->name }}</span>
                            @endforeach
                        </p>
                        <p class="card-text">{{ $product->valuta . '' . $product->price }}</p>

                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">Product owned by {{ $ownerUsername }}</p>
                    </div>
                </div>
                <div>
                </div>
                <div class="card w-50 p-5">
                    <form method="POST" action="{{ route('product.addtolist.store', $product) }}"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="catalog">List</label>
                            <input type="hidden" id="id" name="id" value="{{ $product->id }}">
                            <select class="form-control" id="catalog" name="catalog">
                                @forelse($lists as $list)
                                    <option value="{{ $list->id }}">{{ $list->name }}</option>
                                @empty
                                    <option value="" selected disabled>You have no lists.</option>
                                @endforelse
                            </select>
                        </div>

                        <button class="btn btn-primary mt-4" type="submit">Add to list</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
