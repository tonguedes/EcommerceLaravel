<div>
    <div class="row">
        <div class="col-md-3">

            <div class="card">
                <div class="card-header">
                    <h4>Marcas</h4>
                </div>
                <div class="card-body">
                    @foreach ($category->brands as $brandItem)
                        <label class="d-block">
                            <input type="checkbox" wire:model="brandInputs" wire:click="applyFilter"
                                value="{{ $brandItem->name }}" /> {{ $brandItem->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h4>Marcas</h4>
                </div>
                <div class="card-body">
                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInputs" wire:click="priceFilter" value="hight-to-low" /> Hight To Low
                    </label>

                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInputs" wire:click="priceFilter" value="low-to-hight" /> Low To Hight
                    </label>
                </div>
            </div>

        </div>
        <div class="col-md-9">

            <div class="row">
                @forelse ($products as $productItem)
                    <div class="col-md-4">
                        <div class="product-card">
                            <div class="product-card-img">
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
                                    <span class="original-price">$ {{ $productItem->original_price }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>Sem Produtos {{ $category->name }}</h4>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
