@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center p-4">
            <h1>View List {{ $catalog->name }}</h1>
            <p>{{ $catalog->description }}</p>
                <div class="flex-wrap d-flex justify-content-center flex-row justify-content-center" style="gap: 15px;">
                @if (count($products) !== 0)
                    @foreach ($products as $product)
                        <div class="card " style="width: 18rem;">
                            <div class="" style="height: 200px; overflow: hidden">
                                <img class="card-img-top" style="object-fit: contain"
                                     src="{{ asset('product_images/' . $product['image'])}}"
                                     alt="Card image cap">
                            </div>
                            <div class="card-body">
                                <h2 class="card-title d-flex align-items-center gap-2">
                                    {{ $product->title }}
                                    @if ($product->price == 0)
                                        <span class="text-success"
                                              style="font-size: medium; font-weight: bold">Free</span>
                                    @else
                                        <span class="text-danger"
                                              style="font-size: medium; font-weight: bold">{{ $product->valuta . $product->price }}</span>
                                    @endif
                                </h2>
                                <p class="card-header-pills d-flex flex-row gap-1 overflow-scroll">
                                    @foreach ($product->tags as $tag)
                                        <span class="badge bg-dark-subtle">{{ $tag->name }}</span>
                                    @endforeach
                                </p>
                                <p class="card-text">{{ $product->description }}</p>
                                <form action="{{ route('remove.product.from.list', ['product' => $product, 'list' => $catalog]) }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <button class="btn btn-secondary" type="submit">Remove from List</button>
                                </form>
                                <a href="{{ route('product.show', ['id' => $product->id]) }}"
                                   class="btn btn-outline-success">View
                                    product</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-warning" role="alert">
                        This list contains no products, try adding some
                    </div>
                @endif
                </div>
        </div>
    </div>
@endsection
