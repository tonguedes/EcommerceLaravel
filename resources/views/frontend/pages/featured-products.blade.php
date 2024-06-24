@extends('layouts.app')
@section('title', 'New-Arrival')
@section('content')


    <div class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Produtos em Destaque</h4>
                    <div class="underline mb-4"></div>
                </div>

                @forelse ($featuredProducts  as $productItem)
                    <div class="col-md-3">
                        <div class="product-card">
                            <div class="product-card-img">
                                <label for="stock bg-danger">New</label>
                                @if ($productItem->quantity > 0)
                                    <a
                                        href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                        <label class="stock bg-success">In Stock</label>
                                    </a>
                                @else
                                    <label class="stock bg-success">Out Stock</label>
                                @endif
                                <img src="{{ asset($productItem->productImages[0]->image) }}" alt="{{ $productItem->name }}"
                                    width="300" height="300">
                            </div>
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
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class=" col-md-12 p-2">
                            <h4>Sem  Destaque de Produtos</h4>
                        </div>
                @endforelse

                <div class="text-center">
                    <a href="{{ url('collections') }}" class="btn btn-warning px-3">Ver mais</a>
                </div>


            </div>
        </div>
    </div>
@endsection
