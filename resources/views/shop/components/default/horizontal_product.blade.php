<div class="col-md-4 mt-2">
    <div class="card product-block">
        <div class="card-body row p-0">
            <div class="col-sm-5">
                <img src="{{ asset($product->image) }}" class="product-image">
            </div>
            <div class="col-sm-7 p-3">
                <div class="product-desc">
                    @if($product->category_id)
                        <div class="product-category">
                            {{ $category->name }}
                        </div>
                    @endif
                    <div class="product-name">
                        {{ $product->name }}
                    </div>
                    <div class="product-price">{{ $product->formatPrice() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>