@extends('frontend.master_dashboard')
@section('main')

 <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="mr-5 fi-rs-home"></i>Home</a>
                     <span></span> Compare
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="m-auto col-xl-10 col-lg-12">
                    <h1 class="mb-10 heading-2">Products Compare</h1>
                    <h6 class="mb-40 text-body">There are products to compare</h6>
                    <div class="table-responsive">
                        <table class="table text-center table-compare">

                            <tbody id="compare">


                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

@endsection
