@extends('layouts.app')
@section('title', 'Search Products')
@section('content')

    <div class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h4>Search </h4>
                    <div class="underline mb-4"></div>
                </div>

                @forelse ($searchProducts as $productItem)
                    <div class="col-md-10">
                    <div class="product-card">
                        <div class="row">
                            <div class="col-md-3">
                             <div class="product-card-img">
                                <label for="stock bg-danger">New</label>
                                @if ($productItem->productImages->count() > 0)
                                    <a
                                        href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                          <img src="{{ asset($productItem->productImages[0]->image) }}" alt="{{ $productItem->name }}"
                                       width="300" height="300">

                                    </a>
                                @else
                                    <label class="stock bg-success">Out Stock</label>
                                @endif

                            </div>
                            </div>
                            <div class="col-md-9">

                            <div class="product-card-body">
                                <p class="product-brand">{{ $productItem->brand }}</p>
                                <h5 class="product-name">
                                    <a
                                        href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                        {{ $productItem->name }}
                                    </a>
                                </h5>
                                <div>
                                    <span class="selling-price">$ {{ $productItem->selling_price }}</span>
                                    <span class="original-price">$
                                        {{ $productItem->original_price }}</span>
                                </div>
                                <p style="height: 45px; overflow: hidden">
                             <b>Description:</b>{{ $productItem->description }}
                                </p>
                                <a  class="btn btn-outline-primary "href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">View</a>
                            </div>
                            </div>
                     </div>   </div>
                    </div>
                    <div class="col-md-3">
                        <div class="product-card">

                        </div>
                    </div>
                @empty
                    <div class=" col-md-12 p-2">
                        <h4>Sem Produtos</h4>
                    </div>
                @endforelse
                <div>
                {{ $searchProducts->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
