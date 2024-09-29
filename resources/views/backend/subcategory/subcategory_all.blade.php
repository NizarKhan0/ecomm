@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
            <div class="breadcrumb-title pe-3">All SubCategory</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="p-0 mb-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All SubCategory
                            <span class="badge rounded-pill bg-danger">{{ count($subcategories) }}</span>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.subcategory') }}" class="btn btn-primary">Add SubCategory</a>
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
                                <th>Category Name</th>
                                <th>SubCategory Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subcategories as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->category_id == null || $item->category == null ? 'No Subcategory' : $item->category->category_name }}
                                    </td>

                                    {{-- <td>{{ $item['category']['category_name'] }}</td> --}}
                                    {{-- <td>{{ $item->category->category_name }}</td> --}}
                                    {{-- <td>{{ $item->category_id == null ? 'No Category' : $item->category->category_name }}</td> --}}
                                    <td>{{ $item->subcategory_name }}</td>
                                    <td>
                                        <a href="{{ route('edit.subcategory', $item->id) }}" class="btn btn-info">Edit</a>
                                        {{-- <a href="{{ route('delete.subcategory', $item->id) }}" class="btn btn-danger"
                                            id="delete">Delete</a> --}}
                                        <form id="delete-form-{{ $item->id }}" style="display: inline-block"
                                            action="{{ route('delete.subcategory', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger"
                                                onclick="confirmDelete({{ $item->id }})">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Category Name</th>
                                <th>SubCategory Name</th>
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
