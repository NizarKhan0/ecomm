@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
            <div class="breadcrumb-title pe-3">All Product</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="p-0 mb-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Product
                            <span class="badge rounded-pill bg-danger">{{ count($products) }}</span>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.product') }}" class="btn btn-primary">Add Product</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Discount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><img src="{{ asset($item->product_thumbnail) }}" style="width: 80px; height: 70px;">
                                    </td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->selling_price }}</td>
                                    <td>{{ $item->product_qty }}</td>

                                    <td>
                                        @if ($item->discount_price == null)
                                            <span class="badge rounded-pill bg-danger">No Discount</span>
                                        @else
                                            @php
                                                $amount = $item->selling_price - $item->discount_price;
                                                $discount = ($amount / $item->selling_price) * 100;
                                            @endphp
                                            <span class="badge rounded-pill bg-primary">{{ round($discount) }}%</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($item->status === 1)
                                            <span class="badge rounded-pill bg-success">Active</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('edit.product', $item->id) }}" class="btn btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form id="delete-form-{{ $item->id }}" style="display: inline-block"
                                            action="{{ route('delete.product', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger"
                                                onclick="confirmDelete({{ $item->id }})">Delete</button>
                                        </form>

                                        <a href="{{ route('edit.product', $item->id) }}" class="btn btn-secondary">
                                            <i class="fas fa-info-circle"></i>
                                        </a>

                                        @if ($item->status === 1)
                                            <a href="{{ route('inactive.product', $item->id) }}" class="btn btn-primary">
                                                <i class="fas fa-thumbs-down"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('active.product', $item->id) }}" class="btn btn-success">
                                                <i class="fas fa-thumbs-up"></i>
                                            </a>
                                        @endif


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Discount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
@endsection