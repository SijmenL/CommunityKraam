@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center p-4">
            <h1>All products</h1>

            <div class="mb-5">
                <div class="d-flex align-items-center gap-2 flex-wrap">

                    <form id="auto-submit" method="POST" action="{{ route('products.filter') }}">
                        @csrf
                        <div class="d-flex flex-row gap-2 align-items-center">
                        <label for="own_product">View own products</label>
                        <label class="switch">
                            @if($viewOwnProducts == 'true')
                                <input value="true" onchange="this.form.submit()" name="own_product" id="own_product"
                                       type="checkbox" checked>
                            @else
                                <input value="true" onchange="this.form.submit()" name="own_product" id="own_product"
                                       type="checkbox">
                            @endif
                            <span class="slider round"></span>
                        </label>

                        <div class="col-auto align-items-center">
                            <label class="d-none" for="search">Search</label>
                            <div class="input-group mb-2">
                                <input onchange="this.form.submit()" type="text" class="form-control" id="search"
                                       name="search" placeholder="Search" value="{{ $search }}">
                                <div class="input-group-prepend">
                                    <div style="border-radius: 0 5px 5px 0 !important;" class="input-group-text"><span
                                            class="material-symbols-outlined">search</span></div>
                                </div>

                            </div>
                        </div>
                    </div>
                        <label for="tags">Select Tags to Filter:</label>
                        <div class="custom-select d-flex flex-row flex-wrap" style="width: 100%; row-gap: 5px; column-gap: 5px;">
                            <div id="checkbox-container">
                                @foreach($tags as $tag)
                                    <input id="tag-{{ $tag->id }}" class="btn-check" onchange="this.form.submit()"
                                           type="checkbox" name="tags[]"
                                           value="{{ $tag->id }}" {{ in_array($tag->id, $selectedTags) ? 'checked' : '' }}>
                                    <label for="tag-{{ $tag->id }}"
                                           class="btn btn-outline-info">{{ $tag->name }}</label>
                                @endforeach
                            </div>
                        </div>
                    </form>
                </div>
                <div class="mt-3">
                    @if($totalProducts > 1)
                        <p>We found <b>{{ $totalProducts }}</b> products.</p>
                    @else
                        @if($totalProducts == 1)
                            <p>We found <b>{{ $totalProducts }}</b> product.</p>

                        @else
                            <p>We found <b>no products</b>, try refining your request.</p>

                        @endif
                    @endif
                </div>
            </div>
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
                                <a class="btn btn-secondary">Add to list</a>
                                <a href="{{ route('product.show', ['id' => $product->id]) }}"
                                   class="btn btn-outline-success">View
                                    product</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-warning" role="alert">
                        We have nothing to show here...
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
