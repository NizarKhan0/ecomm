@php
    $route = Route::current()->getName();
@endphp

<div class="col-md-3">
    <div class="dashboard-menu">
        <ul class="nav flex-column" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ $route == 'dashboard' ? 'active' : '' }} " href="{{ route('dashboard') }}"><i
                        class="mr-10 fi-rs-settings-sliders"></i>Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $route == 'user.order.page' ? 'active' : '' }}"
                    href="{{ route('user.order.page') }}"><i class="mr-10 fi-rs-shopping-bag"></i>Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $route == 'return.order.page' ? 'active' : '' }}"
                    href="{{ route('return.order.page') }}"><i class="mr-10 fi-rs-shopping-bag"></i>Return Orders</a>
            </li>
            <a class="nav-link {{ $route == 'user.track.order' ? 'active' : '' }}"
                href="{{ route('user.track.order') }}"><i class="mr-10 fi-rs-shopping-cart-check"></i>Track Your
                Order</a>
            <li class="nav-item">
                <a class="nav-link" href="#address"><i class="mr-10 fi-rs-marker"></i>My Address</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $route == 'user.account.page' ? 'active' : '' }}"
                    href="{{ route('user.account.page') }}"><i class="mr-10 fi-rs-user"></i>Account details</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $route == 'user.change.password' ? 'active' : '' }}"
                    href="{{ route('user.change.password') }}"><i class="mr-10 fi-rs-user"></i>Change Password</a>
            </li>


            <li class="nav-item" style="background:#ddd;">
                <a class="nav-link" href="{{ route('user.logout') }}"><i class="mr-10 fi-rs-sign-out"></i>Logout</a>
            </li>
        </ul>
    </div>
</div>
