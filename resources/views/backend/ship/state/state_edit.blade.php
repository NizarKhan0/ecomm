@extends('admin.admin_dashboard')

@section('admin')
<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Edit State</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit State</li>
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
                            <form action="{{ route('update.state') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="id" value="{{ $state->id }}">

                                <!-- Division Dropdown -->
                                <div class="mb-3 row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Division Name</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <select name="division_id" id="division"
                                            class="form-control @error('division_id') is-invalid @enderror">
                                            <option value="">Select Division</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}" {{ $state->division_id == $division->id ? 'selected' : '' }}>
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

                                <!-- District Dropdown -->
                                <div class="mb-3 row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">District Name</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <select name="districts_id" id="districts"
                                            class="form-control @error('districts_id') is-invalid @enderror">
                                            <option value="">Select District</option>
                                            <!-- District options will be populated dynamically -->
                                        </select>
                                        @error('districts_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- States Name -->
                                <div class="mb-3 row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">State Name</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="states_name" value="{{ $state->states_name }}"
                                            class="form-control @error('states_name') is-invalid @enderror" />
                                        @error('states_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="px-4 btn btn-primary" value="Edit State" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Store all the districts in a JavaScript object -->
    <script>
        $(document).ready(function() {
            var allDistricts = @json($districts); // Districts loaded from the server
            var selectedDistrict = '{{ $state->districts_id }}'; // Get the selected district

            // Populate the district dropdown based on the selected division
            function populateDistricts(division_id, selected_district) {
                var filteredDistricts = allDistricts.filter(function(district) {
                    return district.division_id == division_id; // Filter districts based on selected division
                });

                $('#districts').html('<option value="">Select District</option>'); // Clear dropdown
                $.each(filteredDistricts, function(index, district) {
                    $('#districts').append('<option value="' + district.id + '"' +
                        (district.id == selected_district ? ' selected' : '') + '>' +
                        district.districts_name + '</option>');
                });
            }

            // Trigger change event when division is selected
            $('#division').on('change', function() {
                var division_id = $(this).val();
                populateDistricts(division_id, null);
            });

            // Trigger on page load if editing
            var initialDivision = $('#division').val();
            if (initialDivision) {
                populateDistricts(initialDivision, selectedDistrict);
            }
        });
    </script>
@endsection
