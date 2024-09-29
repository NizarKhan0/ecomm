@extends('frontend.master_dashboard')

@section('main')
    @include('frontend.home.home_slider')
    <!--End hero slider-->

    @include('frontend.home.home_features_category')
    <!--End category slider-->

    @include('frontend.home.home_banner')
    <!--End banners-->

    @include('frontend.home.home_new_product')
    <!--Products Tabs-->

    @include('frontend.home.home_features_product')
    <!--End Best Sales-->


    <!-- Fashion Category -->
    <section class="product-tabs section-padding position-relative">
        <div class="container">
            <div class="section-title style-2 wow animate__animated animate__fadeIn">
                <h3>{{ $skip_category_0->category_name }} Category</h3>
            </div>
            <!--End nav-tabs-->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                    <div class="row product-grid-4">
                        @foreach ($skip_product_0 as $product)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                    data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a
                                                href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                                <img class="default-img" src="{{ asset($product->product_thumbnail) }}"
                                                    alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}"
                                                onclick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>

                                            <a aria-label="Compare" class="action-btn" id="{{ $product->id }}"
                                                onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>

                                            <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal" onclick="productView(this.id)"
                                                id="{{ $product->id }}"><i class="fi-rs-eye"></i></a>

                                        </div>
                                        @php
                                            $amount = $product->selling_price - $product->discount_price;
                                            $discount = ($amount / $product->selling_price) * 100;
                                        @endphp
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @if ($product->discount_price == null)
                                                <span class="new">New</span>
                                            @else
                                                <span class="hot">{{ round($discount) }}%</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">{{ $product->category->category_name }}</a>
                                        </div>
                                        <h2><a
                                                href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                        </h2>
                                        <div class="rating-result" title="90%">
                                            <span> </span>
                                        </div>
                                        <div class="product-price">
                                            <span>${{ number_format($product->discount_price ?? $product->selling_price, 2) }}</span>
                                            @if ($product->discount_price)
                                                <span
                                                    class="old-price">${{ number_format($product->selling_price, 2) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!--end product card-->
                    </div>
                    <!--End product-grid-4-->
                </div>
            </div>
            <!--End tab-content-->
        </div>
    </section>

    <!--End Fashion Category -->

    <!-- Mobile Category -->
    <section class="product-tabs section-padding position-relative">
        <div class="container">
            <div class="section-title style-2 wow animate__animated animate__fadeIn">
                <h3>{{ $skip_category_1->category_name }} Category</h3>
            </div>
            <!--End nav-tabs-->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                    <div class="row product-grid-4">
                        @foreach ($skip_product_1 as $product)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                    data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a
                                                href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                                <img class="default-img" src="{{ asset($product->product_thumbnail) }}"
                                                    alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}"
                                                onclick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>

                                            <a aria-label="Compare" class="action-btn" id="{{ $product->id }}"
                                                onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>

                                            <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal" onclick="productView(this.id)"
                                                id="{{ $product->id }}"><i class="fi-rs-eye"></i></a>

                                        </div>
                                        @php
                                            $amount = $product->selling_price - $product->discount_price;
                                            $discount = ($amount / $product->selling_price) * 100;
                                        @endphp
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @if ($product->discount_price == null)
                                                <span class="new">New</span>
                                            @else
                                                <span class="hot">{{ round($discount) }}%</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">{{ $product->category->category_name }}</a>
                                        </div>
                                        <h2><a
                                                href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                        </h2>
                                        <div class="rating-result" title="90%">
                                            <span> </span>
                                        </div>
                                        <div class="product-price">
                                            <span>${{ number_format($product->discount_price ?? $product->selling_price, 2) }}</span>
                                            @if ($product->discount_price)
                                                <span
                                                    class="old-price">${{ number_format($product->selling_price, 2) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!--end product card-->
                    </div>
                    <!--End product-grid-4-->
                </div>
            </div>
            <!--End tab-content-->
        </div>
    </section>

    <!--End Fashion Category -->

    <section class="section-padding mb-30">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp"
                    data-wow-delay="0">
                    <h4 class="section-title style-1 mb-30 animated"> Hot Deals </h4>
                    <div class="product-list-small animated">

                        @foreach ($hot_deals as $item)
                            <article class="row align-items-center hover-up">
                                <figure class="mb-0 col-md-4">
                                    <a href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">
                                        <img src="{{ asset($item->product_thumbnail) }}"
                                            alt="{{ $item->product_name }}" />
                                    </a>
                                </figure>
                                <div class="mb-0 col-md-8">
                                    <h6>
                                        <a
                                            href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">{{ $item->product_name }}</a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="ml-5 font-small text-muted"> (4.0)</span>
                                    </div>
                                    <div class="product-price">
                                        @if ($item->discount_price == null)
                                            <div class="product-price">
                                                <span>${{ number_format($item->selling_price, 2) }}</span>
                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span>${{ number_format($item->discount_price, 2) }}</span>
                                                <span
                                                    class="old-price">${{ number_format($item->selling_price, 2) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        @endforeach


                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp"
                    data-wow-delay=".1s">
                    <h4 class="section-title style-1 mb-30 animated"> Special Offer </h4>
                    <div class="product-list-small animated">
                        @foreach ($special_offer as $item)
                            <article class="row align-items-center hover-up">
                                <figure class="mb-0 col-md-4">
                                    <a href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">
                                        <img src="{{ asset($item->product_thumbnail) }}"
                                            alt="{{ $item->product_name }}" />
                                    </a>
                                </figure>
                                <div class="mb-0 col-md-8">
                                    <h6>
                                        <a
                                            href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">{{ $item->product_name }}</a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="ml-5 font-small text-muted"> (4.0)</span>
                                    </div>
                                    <div class="product-price">
                                        @if ($item->discount_price == null)
                                            <div class="product-price">
                                                <span>${{ number_format($item->selling_price, 2) }}</span>
                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span>${{ number_format($item->discount_price, 2) }}</span>
                                                <span
                                                    class="old-price">${{ number_format($item->selling_price, 2) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp"
                    data-wow-delay=".2s">
                    <h4 class="section-title style-1 mb-30 animated">Recently added</h4>
                    <div class="product-list-small animated">

                        @foreach ($new_products as $item)
                            <article class="row align-items-center hover-up">
                                <figure class="mb-0 col-md-4">
                                    <a href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">
                                        <img src="{{ asset($item->product_thumbnail) }}"
                                            alt="{{ $item->product_name }}" />
                                    </a>
                                </figure>
                                <div class="mb-0 col-md-8">
                                    <h6>
                                        <a
                                            href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">{{ $item->product_name }}</a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="ml-5 font-small text-muted"> (4.0)</span>
                                    </div>
                                    <div class="product-price">
                                        @if ($item->discount_price == null)
                                            <div class="product-price">
                                                <span>${{ number_format($item->selling_price, 2) }}</span>
                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span>${{ number_format($item->discount_price, 2) }}</span>
                                                <span
                                                    class="old-price">${{ number_format($item->selling_price, 2) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp"
                    data-wow-delay=".3s">
                    <h4 class="section-title style-1 mb-30 animated"> Special Deals </h4>
                    <div class="product-list-small animated">

                        @foreach ($special_deals as $item)
                            <article class="row align-items-center hover-up">
                                <figure class="mb-0 col-md-4">
                                    <a href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">
                                        <img src="{{ asset($item->product_thumbnail) }}"
                                            alt="{{ $item->product_name }}" />
                                    </a>
                                </figure>
                                <div class="mb-0 col-md-8">
                                    <h6>
                                        <a
                                            href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">{{ $item->product_name }}</a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="ml-5 font-small text-muted"> (4.0)</span>
                                    </div>
                                    <div class="product-price">
                                        @if ($item->discount_price == null)
                                            <div class="product-price">
                                                <span>${{ number_format($item->selling_price, 2) }}</span>
                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span>${{ number_format($item->discount_price, 2) }}</span>
                                                <span
                                                    class="old-price">${{ number_format($item->selling_price, 2) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End 4 columns-->


    <!--Vendor List -->
    @include('frontend.home.home_vendor_list')
    <!--End Vendor List -->
@endsection
