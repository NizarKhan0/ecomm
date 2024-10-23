@extends('frontend.master_dashboard')

@section('main')

@section('title')
Vendor Details Page
@endsection

    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="mr-5 fi-rs-home"></i>Home</a>
                <span></span> Vendor Details Page
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="text-center archive-header-2 pt-80 pb-50">
            <h1 class="display-2 mb-50">{{ $vendor->name }}</h1>

        </div>
        <div class="flex-row-reverse row">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We found <strong class="text-brand">{{ count($vproduct) }}</strong> items for you!</p>
                    </div>
                    <div class="sort-by-product-area">
                        <div class="mr-10 sort-by-cover">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps"></i>Show:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">50</a></li>
                                    <li><a href="#">100</a></li>
                                    <li><a href="#">150</a></li>
                                    <li><a href="#">200</a></li>
                                    <li><a href="#">All</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sort-by-cover">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">Featured</a></li>
                                    <li><a href="#">Price: Low to High</a></li>
                                    <li><a href="#">Price: High to Low</a></li>
                                    <li><a href="#">Release Date</a></li>
                                    <li><a href="#">Avg. Rating</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                @if ($vproduct->isEmpty())
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-warning" role="alert">
                                No products available.
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row product-grid">
                        @foreach ($vproduct as $product)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30">
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
                                                <span class="hot">{{ round($discount) }} %</span>
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
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="ml-5 font-small text-muted"> (4.0)</span>
                                        </div>
                                        <div>
                                            @if ($product->vendor_id == null)
                                                <span class="font-small text-muted">By <a
                                                        href="vendor-details-1.html">Owner</a></span>
                                            @else
                                                <span class="font-small text-muted">By <a
                                                        href="vendor-details-1.html">{{ $product->vendor->name }}</a></span>
                                            @endif
                                        </div>
                                        <div class="product-card-bottom">
                                            @if ($product->discount_price == null)
                                                <div class="product-price">
                                                    <span>${{ $product->selling_price }}</span>
                                                </div>
                                            @else
                                                <div class="product-price">
                                                    <span>${{ $product->discount_price }}</span>
                                                    <span class="old-price">${{ $product->selling_price }}</span>
                                                </div>
                                            @endif
                                            <div class="add-cart">
                                                <a class="add" href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"><i
                                                        class="mr-5 fi-rs-shopping-cart"></i>Details </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif



                <!--product grid-->
                <div class="mt-20 mb-20 pagination-area">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-start">
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">6</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!--End Deals-->
            </div>
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <div class="border-0 sidebar-widget widget-store-info mb-30 bg-3">
                    <div class="vendor-logo mb-30">
                        <img src="{{ !empty($vendor->photo) ? url('upload/vendor_images/' . $vendor->photo) : url('upload/default.jpg') }}"
                            alt="" />
                    </div>
                    <div class="vendor-info">
                        <div class="product-category">
                            <span class="text-muted">Since {{ $vendor->vendor_join }}</span>
                        </div>
                        <h4 class="mb-5"><a href="vendor-details-1.html" class="text-heading">{{ $vendor->name }}</a>
                        </h4>
                        <div class="product-rate-cover mb-15">
                            <div class="product-rate d-inline-block">
                                <div class="product-rating" style="width: 90%"></div>
                            </div>
                            <span class="ml-5 font-small text-muted"> (4.0)</span>
                        </div>
                        <div class="vendor-des mb-30">
                            <p class="font-sm text-heading">{{ $vendor->vendor_short_info }}</p>
                        </div>
                        <div class="mb-20 follow-social">
                            <h6 class="mb-15">Follow Us</h6>
                            <ul class="social-network">
                                <li class="hover-up">
                                    <a href="#">
                                        <img src="{{ asset('frontend/assets/imgs/theme/icons/social-tw.svg') }}"
                                            alt="" />
                                    </a>
                                </li>
                                <li class="hover-up">
                                    <a href="#">
                                        <img src="{{ asset('frontend/assets/imgs/theme/icons/social-fb.svg') }}"
                                            alt="" />
                                    </a>
                                </li>
                                <li class="hover-up">
                                    <a href="#">
                                        <img src="{{ asset('frontend/assets/imgs/theme/icons/social-insta.svg') }}"
                                            alt="" />
                                    </a>
                                </li>
                                <li class="hover-up">
                                    <a href="#">
                                        <img src="{{ asset('frontend/assets/imgs/theme/icons/social-pin.svg') }}"
                                            alt="" />
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="vendor-info">
                            <ul class="mb-20 font-sm">
                                <li><img class="mr-5" src="assets/imgs/theme/icons/icon-location.svg"
                                        alt="" /><strong>Address: </strong> <span>{{ $vendor->address }}</span>
                                </li>
                                <li><img class="mr-5" src="assets/imgs/theme/icons/icon-contact.svg"
                                        alt="" /><strong>Call Us:</strong><span>({{ $vendor->phone }})</span></li>
                            </ul>
                            <a href="vendor-details-1.html" class="btn btn-xs">Contact Seller <i
                                    class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
