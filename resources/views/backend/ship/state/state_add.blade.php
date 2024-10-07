@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
            <div class="breadcrumb-title pe-3">Add State</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="p-0 mb-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add State</li>
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
                                <form action="{{ route('store.state') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3 row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Division Name</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select name="division_id"
                                                class="form-control @error('division_id') is-invalid @enderror">
                                                <option value="">Select Division</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}"
                                                        {{ old('division_id') == $division->id ? 'selected' : '' }}>
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
                                        {{-- <div class="form-group col-sm-9 text-secondary">
                                            <select name="division_id" id="division" class="form-control @error('division_id') is-invalid @enderror">
                                                <option value="">Select Division</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}" {{ old('division_id') == $division->id ? 'selected' : '' }}>
                                                        {{ $division->division_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('division_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div> --}}
                                    </div>


                                    <div class="mb-3 row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Districts Name</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select name="districts_id"
                                                class="form-control @error('districts_id') is-invalid @enderror">
                                                <option value="">Select Districts</option>
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}"
                                                        {{ old('districts_id') == $district->id ? 'selected' : '' }}>
                                                        {{ $district->districts_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('districts_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- <div class="form-group col-sm-9 text-secondary">
                                            <select name="districts_id" id="districts" class="form-control @error('districts_id') is-invalid @enderror">
                                                <option value="">Select District</option>
                                            </select>
                                            @error('districts_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div> --}}
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">State Name</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="states_name" value="{{ old('states_name') }}"
                                                class="form-control @error('states_name') is-invalid @enderror" />
                                            @error('states_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="px-4 btn btn-primary" value="Add State" />
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


    {{-- cara 1 kalau nak guna AJAX --}}
    <script>
        $(document).ready(function() {
            $('select[name="division_id"]').on('change', function() {
                var division_id = $(this).val();
                if (division_id) {
                    $.ajax({
                        url: "{{ url('/district/ajax') }}/" + division_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            // Clear the district dropdown
                            $('select[name="districts_id"]').html('');
                            // Populate the district dropdown
                            $.each(data, function(key, value) {
                                $('select[name="districts_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .districts_name + '</option>'
                                );
                            });
                        },
                        error: function() {
                            alert('An error occurred while fetching districts.');
                        }
                    });
                } else {
                    alert('Please select a districts.');
                }
            });
        });
    </script>

    {{-- <!-- Store all the districts in a JavaScript object -->
    <script>
        $(document).ready(function() {
            var allDistricts = @json($districts); // Districts loaded from the server

            $('#division').on('change', function() {
                var division_id = $(this).val();
                var filteredDistricts = allDistricts.filter(function(district) {
                    return district.division_id ==
                    division_id; // Filter districts based on selected division
                });

                // Clear and repopulate the district dropdown
                $('#districts').html('<option value="">Select District</option>');
                $.each(filteredDistricts, function(index, district) {
                    $('#districts').append('<option value="' + district.id + '">' + district
                        .districts_name + '</option>');
                });
            });
        });
    </script> --}}
@endsection
