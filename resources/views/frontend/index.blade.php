@extends('layouts.app')
@section('title', 'Home Page')
@section('content')
    <div id="carouselExampleCaptions" class="carousel slide">

        <div class="carousel-inner">
            @foreach ($sliders as $key => $sliderItem)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    @if ($sliderItem->image)
                        <img src="{{ asset("$sliderItem->image") }}" class="d-block w-100" alt="...">
                    @endif
                    {{-- <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $sliderItem->title }}</h5>
                        <p>{{ $sliderItem->deacription }}</p>
                    </div> --}}
                    <div class="carousel-caption d-none d-md-block">
                        <div class="custom-carousel-content">
                            <h1>
                                {!! $sliderItem->title !!}
                            </h1>
                            <p>
                                {{ $sliderItem->description }}
                            </p>
                            <div>
                                <a href="{{ url('collections') }}" class="btn btn-slider">
                                    Get Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h4>Bem Vindo Ao Ecommerce</h4>
                    <div class="underline mx-auto"></div>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam explicabo quisquam pariatur,
                        maiores, dolorum, nostrum deserunt alias vero
                        sit dicta eligendi quae facilis laudantium debitis doloremque iure assumenda tenetur quaerat.
                        maiores, dolorum, nostrum deserunt alias vero
                        sit dicta eligendi quae facilis laudantium debitis doloremque iure assumenda tenetur quaerat.
                    </p>
                </div>
            </div>
        </div>

    </div>

    <div class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Trending Products

                    </h4>
                    <div class="underline mb-4"></div>
                </div>
                <div class="col-md-12 ">
                    @if ($trendingProducts)
                        <div class="col-md-12">
                            <div class="owl-carousel owl-theme   four-carousel">
                                @foreach ($trendingProducts as $productItem)
                                    <div class="item">
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
                                                <img src="{{ asset($productItem->productImages[0]->image) }}"
                                                    alt="{{ $productItem->name }}" width="300" height="300">
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
                                @endforeach

                            </div>
                        </div>
                    @else
                        <div class="col-md-12">
                            <div class="p-2">
                                <h4>Sem Produtos</h4>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

         <div class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Lançamentos
                     <a href="{{ url('new-arrivals') }}" class="btn btn-warning float-end">Veja Mais...</a>
                    </h4>
                    <div class="underline mb-4"></div>
                </div>
                <div class="col-md-12 ">
                    @if ($newArrivalProducts)
                        <div class="col-md-12">
                            <div class="owl-carousel owl-theme four-carousel">
                                @foreach ($newArrivalProducts as $productItem)
                                    <div class="item">
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
                                                <img src="{{ asset($productItem->productImages[0]->image) }}"
                                                    alt="{{ $productItem->name }}" width="300" height="300">
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
                                @endforeach

                            </div>
                        </div>
                    @else
                        <div class="col-md-12">
                            <div class="p-2">
                                <h4>Sem Produtos</h4>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

          <div class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Featured Products
                    <a href="{{ url('featured-products') }}" class="btn btn-warning float-end">Veja Mais...</a>
                    </h4>
                    <div class="underline mb-4"></div>
                </div>
                <div class="col-md-12 ">
                    @if ($featuredProducts)
                        <div class="col-md-12">
                            <div class="owl-carousel owl-theme four-carousel">
                                @foreach ($featuredProducts as $productItem)
                                    <div class="item">
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
                                                <img src="{{ asset($productItem->productImages[0]->image) }}"
                                                    alt="{{ $productItem->name }}" width="300" height="300">
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
                                @endforeach

                            </div>
                        </div>
                    @else
                        <div class="col-md-12">
                            <div class="p-2">
                                <h4>No Featured Products</h4>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection

    @section('script')

        <script>
            $('.four-carousel').owlCarousel({
                loop: true,
                margin: 15,
                dots:true,
                nav: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }
                }
            })
        </script>

    @endsection
