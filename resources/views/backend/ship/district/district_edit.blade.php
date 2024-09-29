@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
            <div class="breadcrumb-title pe-3">Edit District</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="p-0 mb-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit District</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('update.district') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="id" value="{{ $district->id }}">

                                    <div class="mb-3 row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Division Name</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select name="division_id"
                                                class="form-control @error('division_id') is-invalid @enderror">
                                                <option value="">Open this select menu</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}"
                                                        {{ $district->division_id == $division->id ? 'selected' : '' }}>
                                                        {{ $division->division_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('division_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">District Name</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="districts_name"
                                                value="{{ $district->districts_name }}"
                                                class="form-control @error('districts_name') is-invalid @enderror" />
                                            @error('districts_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="px-4 btn btn-primary" value="Edit District" />
                                        </div>
                                    </div>

                            </div>

                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
