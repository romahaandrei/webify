@if ($product)
    <div class="product-cart-wrap mb-30">
        <div class="product-content-wrap">
            <div class="product-badges product-badges-position product-badges-mrg">
                @if ($product->isOutOfStock())
                    <span class="bg-dark" style="font-size: 11px;">{{ __('Out Of Stock') }}</span>
                @else
                    @if ($product->productLabels->count())
                        @foreach ($product->productLabels as $label)
                            <span @if ($label->color) style="background-color: {{ $label->color }}" @endif>{{ $label->name }}</span>
                        @endforeach
                    @else
                        @if ($product->front_sale_price !== $product->price)
                            <span class="hot">{{ get_sale_percentage($product->price, $product->front_sale_price) }}</span>
                        @endif
                    @endif
                @endif
            </div>
            <div class="product-category">
                @if ($category = $product->categories->sortByDesc('id')->first())
                    <a href="{{ $category->url }}">{!! BaseHelper::clean($category->name) !!}</a>
                @endif
            </div>
            <h2 class="text-truncate"><a href="{{ $product->url }}" title="{{ $product->name }}" title="{{ $product->name }}">{{ $product->name }}</a></h2>

            @if (EcommerceHelper::isReviewEnabled() && $product->reviews_count)
                <div class="product-rate-cover">
                    <div class="product-rate d-inline-block">
                        <div class="product-rating" style="width: {{ $product->reviews_avg * 20 }}%"></div>
                    </div>
                    <span class="font-small ml-5 text-muted">({{ $product->reviews_count }})</span>
                </div>
            @endif
            @if (is_plugin_active('marketplace') && $product->store->id)
                <div>
                    <span class="font-small text-muted">{{ __('Sold By') }} <a href="{{ $product->store->url }}">{!! BaseHelper::clean($product->store->name) !!}</a></span>
                </div>
            @endif

            <div class="product-card-bottom">
                {!! apply_filters('ecommerce_before_product_price_in_listing', null, $product) !!}

                <div class="product-price">
                    <span>{{ format_price($product->front_sale_price_with_taxes) }}</span>
                    @if ($product->front_sale_price !== $product->price)
                        <span class="old-price">{{ format_price($product->price_with_taxes) }}</span>
                    @endif
                </div>

                {!! apply_filters('ecommerce_after_product_price_in_listing', null, $product) !!}

                <div class="group-buttons">
                    @if (EcommerceHelper::isCartEnabled())
                        <div class="add-cart">
                            <a aria-label="{{ __('Add To Cart') }}"
                                class="action-btn add-to-cart-button add"
                                data-id="{{ $product->id }}"
                                data-url="{{ route('public.ajax.cart.store') }}"
                                href="#">
                                <i class="fi-rs-shopping-cart mr-5"></i> <span class="d-inline-block"></span>
                            </a>
                        </div>
                    @endif

                    @if (EcommerceHelper::isWishlistEnabled())
                        <div class="add-cart">
                            <a aria-label="{{ __('Wishlist') }}"
                                class="action-btn add js-add-to-wishlist-button"
                                data-id="{{ $product->id }}"
                                data-url="{{ route('public.wishlist.add', $product->id) }}"
                                href="#">
                                <i class="fi-rs-heart mr-5"></i> <span class="d-inline-block"></span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
