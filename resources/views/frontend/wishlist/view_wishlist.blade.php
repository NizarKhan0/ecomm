@extends('frontend.master_dashboard')
@section('main')


    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="mr-5 fi-rs-home"></i>Home</a>
                <span></span> Wishlist
            </div>
        </div>
    </div>
    <div class="container mb-30 mt-50">
        <div class="row">
            <div class="m-auto col-xl-10 col-lg-12">
                <div class="mb-50">
                    <h1 class="mb-10 heading-2">Your Wishlist</h1>
                    <h6 class="text-body">There are products in this list</h6>
                </div>
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist">
                        <thead>
                            <tr class="main-heading">
                                <th class="custome-checkbox start pl-30">

                                </th>
                                <th scope="col" colspan="2">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Stock Status</th>

                                <th scope="col" class="end">Remove</th>
                            </tr>
                        </thead>
                        <tbody id="wishlist">




                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
