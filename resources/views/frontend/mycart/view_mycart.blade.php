@extends('frontend.master_dashboard')
@section('main')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="mr-5 fi-rs-home"></i>Home</a>
                <span></span> Cart
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="mb-40 col-lg-8">
                <h1 class="mb-10 heading-2">Your Cart</h1>
                <div class="d-flex justify-content-between">
                    <h6 class="text-body">There are products in your cart</h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist">
                        <thead>
                            <tr class="main-heading">
                                <th class="custome-checkbox start pl-30">

                                </th>
                                <th scope="col" colspan="2">Product</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Colour</th>
                                <th scope="col">Size</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col" class="end">Remove</th>
                            </tr>
                        </thead>

                        <tbody id="cartPage">


                        </tbody>

                    </table>
                </div>


                <div class="row mt-50">

                    <div class="col-lg-5">

                        @if (Session::has('coupon'))
                        @else
                            <div class="p-40" id="couponField">
                                <h4 class="mb-10">Apply Coupon</h4>
                                <p class="mb-30"><span class="font-lg text-muted">Using A Promo Code?</p>
                                <form action="#">
                                    <div class="d-flex justify-content-between">

                                        <input class="font-medium mr-15 coupon" id="coupon_name"
                                            placeholder="Enter Your Coupon">

                                        <a type="submit" onclick="applyCoupon()" class="btn btn-success"><i
                                                class="mr-10 fi-rs-label"></i>Apply</a>
                                    </div>
                                </form>
                            </div>
                        @endif

                    </div>

                    <div class="col-lg-7">
                        <div class="divider-2 mb-30"></div>

                        <div class="border p-md-4 cart-totals ml-30">
                            <div class="table-responsive">
                                <table class="table no-border">

                                    <tbody id="couponCalField">


                                    </tbody>

                                </table>
                            </div>
                            <a href="#" class="mb-20 btn w-100">Proceed To CheckOut<i
                                    class="fi-rs-sign-out ml-15"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection
