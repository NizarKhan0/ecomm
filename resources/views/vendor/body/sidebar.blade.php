@php
    $id = Auth::user()->id;
    $vendorId = App\Models\User::find($id);
    $status = $vendorId->status;
@endphp

<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Vendor</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('vendor.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>


        @if ($status === 'active')
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Product Manage</div>
                </a>
                <ul>
                    <li> <a href="{{ route('vendor.all.product') }}"><i class="bx bx-right-arrow-alt"></i>All
                            Product</a>
                    </li>
                    <li> <a href="{{ route('vendor.add.product') }}"><i class="bx bx-right-arrow-alt"></i>Add
                            Product</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title"> Order Manage </div>
                </a>
                <ul>
                    <li> <a href="{{ route('vendor.order') }}"><i class="bx bx-right-arrow-alt"></i>Vendor Order</a>
                    </li>
                    <li> <a href="{{ route('vendor.return.order') }}"><i class="bx bx-right-arrow-alt"></i>Return
                            Order</a>
                    </li>

                    <li> <a href="{{ route('vendor.complete.return.order') }}"><i
                                class="bx bx-right-arrow-alt"></i>Complete Return Order</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title"> Review Manage </div>
                </a>
                <ul>
                    <li> <a href="{{ route('vendor.all.review') }}"><i class="bx bx-right-arrow-alt"></i>All Review</a>
                    </li>



                </ul>
            </li>
        @else
        @endif

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
            <ul>
                <li> <a href="errors-404-error.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>404
                        Error</a>
                </li>
                <li> <a href="errors-500-error.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>500
                        Error</a>
                </li>
                <li> <a href="errors-coming-soon.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Coming
                        Soon</a>
                </li>
                <li> <a href="error-blank-page.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Blank Page</a>
                </li>
            </ul>
        </li>
    </ul>
    <!--end navigation-->
</div>
