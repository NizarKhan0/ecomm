@extends('admin.admin_dashboard')
@section('admin')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
            <div class="breadcrumb-title pe-3">All State </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="p-0 mb-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All State</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.state') }}" class="btn btn-primary">Add State</a>
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
                                <th>Division Name </th>
                                <th>District Name</th>
                                <th>States Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($state as $key => $item)
                                <tr>
                                    <td> {{ $key + 1 }} </td>

                                    {{-- ini guna relation dari model --}}
                                    {{-- <td>{{ $item['division']['division_name'] }}</td> --}}
                                    <td> {{ $item->division->division_name }}</td>
                                    <td> {{ $item->district->districts_name }}</td>
                                    <td> {{ $item->states_name }}</td>
                                    <td>
                                        <a href="{{ route('edit.state', $item->id) }}" class="btn btn-info">Edit</a>

                                        <form id="delete-form-{{ $item->id }}" style="display: inline-block"
                                            action="{{ route('delete.state', $item->id) }}" method="POST">
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
                                <th>Division Name </th>
                                <th>District Name</th>
                                <th>State Name</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>


    </div>
@endsection
