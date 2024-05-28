<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <h4>Meu carrinho</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Quantity</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>
                        @forelse ($cart as $cartItem)
                        @if ($cartItem->product)
                        <div class="cart-item">
                            <div class="row">
                                <div class="col-md-6 my-auto">
                                    <a href="{{ url('collections/'.$cartItem->product->category->slug.'/'.$cartItem->product->slug
                                    ) }}">
                                        <label class="product-name">
                                            @if($cartItem->product->ProductImages)
                                            <img src="{{ asset($cartItem->product->ProductImages[0]->image) }}" style="width: 50px; height: 50px"
                                            alt="">
                                            @endif
                                            {{ $cartItem->product->name }}
                                            {{-- @if ($cartItem->productColor->name)
                                            <span>with color:{{ $cartItem->productColor->color->name }}</span>
                                            @else
                                            <img src="" style="width: 50px; height: 50px"
                                            alt="">
                                            @endif --}}

                                        </label>
                                    </a>
                                </div>
                                <div class="col-md-2 my-auto">
                                    <label class="price">$ {{ $cartItem->product->selling_price }} </label>
                                </div>
                                <div class="col-md-2 col-7 my-auto">
                                    <div class="quantity">
                                        <div class="input-group">
                                            <span class="btn btn1"><i class="fa fa-minus"></i></span>
                                            <input type="text" value="1" class="input-quantity" />
                                            <span class="btn btn1"><i class="fa fa-plus"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-5 my-auto">
                                    <div class="remove">
                                        <a href="" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> Remove
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @empty
                            <div>sem produto no carrinho</div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
