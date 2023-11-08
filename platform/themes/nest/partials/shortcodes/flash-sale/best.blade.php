<section class="section-padding pb-5 section-flash-sale-products">
    <div class="container">
        <div class="section-title">
            <h3>{!! BaseHelper::clean($shortcode->title) !!}</h3>
        </div>
        <div class="row">
            @if (is_plugin_active('ads') && $ads = AdsManager::getData()->where('key', $shortcode->ads)->first())
                <div class="col-xl-3 d-none d-xl-flex">
                    <div class="banner-img style-2" @if ($ads->image) style="background-image: url({{ RvMedia::getImageUrl($ads->image) }}) !important;" @endif>
                        <div class="banner-text">
                            <h2 class="mb-25">{{ $ads->name }}</h2>
                            @if ($buttonText = $ads->getMetaData('button_text', true))
                                <a href="{{ route('public.ads-click', $ads->key) }}" class="btn btn-xs">{{ $buttonText }} <i class="fi-rs-arrow-small-right"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            <div class="@if (! empty($ads)) col-xl-9 @endif col-md-12" data-wow-delay=".4s">
                <div class="tab-content" >
                    <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="tab-one-1">
                        <div class="carousel-4-columns-cover arrow-center position-relative">
                            <div class="slider-arrow slider-arrow-2 carousel-4-columns-arrow" id="carousel-4-columns-arrows"></div>
                            <div class="carousel-4-columns carousel-arrow-center" id="carousel-4-columns">
                                @foreach ($flashSalePopup->products as $product)
                                    <div class="product-cart-wrap">
                                        <div class="product-content-wrap">
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                @if ($product->isOutOfStock())
                                                    <span style="background-color: #000; font-size: 11px;">{{ __('Out Of Stock') }}</span>
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
                                            @php $category = $product->categories->sortByDesc('id')->first(); @endphp
                                            <div class="product-category">
                                                @if ($category)
                                                    <a href="{{ $category->url }}">{!! BaseHelper::clean($category->name) !!}</a>
                                                @endif
                                            </div>
                                            <h2 class="text-truncate"><a href="{{ $product->url }}" title="{{ $product->name }}">{{ $product->name }}</a></h2>

                                            {!! Theme::partial('rating-item', ['ratingCount' => $product->reviews_count, 'ratingAvg' => $product->reviews_avg]) !!}

                                            <div class="product-price mt-10">
                                                <span>{{ format_price($product->front_sale_price_with_taxes) }}</span>
                                                @if ($product->front_sale_price !== $product->price)
                                                    <span class="old-price">{{ format_price($product->price_with_taxes) }}</span>
                                                @endif
                                            </div>
                                            
                                            <div class="group-buttons">
                                                @if (EcommerceHelper::isCartEnabled())
                                                    <a aria-label="{{ __('Add To Cart') }}"
                                                        class="action-btn add-to-cart-button btn w-100 hover-up"
                                                        data-id="{{ $product->id }}"
                                                        data-url="{{ route('public.ajax.cart.store') }}"
                                                        href="#">
                                                        <i class="fi-rs-shopping-cart mr-5"></i>{{ __('Add') }}
                                                    </a>
                                                @endif
                                                @if (EcommerceHelper::isCartEnabled())
                                                    <a aria-label="{{ __('Wishlist') }}"
                                                        class="add-whishlist action-btn js-add-to-wishlist-button add btn w-100 hover-up"
                                                        data-id="{{ $product->id }}"
                                                        data-url="{{ route('public.wishlist.add', $product->id) }}"
                                                        href="#">
                                                        <i class="fi-rs-heart mr-5"></i>
                                                    </a>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
