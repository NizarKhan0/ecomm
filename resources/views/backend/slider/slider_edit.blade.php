@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
            <div class="breadcrumb-title pe-3">Edit Slider</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="p-0 mb-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Slider</li>
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
                                <form action="{{ route('update.slider') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="id" value="{{ $slider->id }}">

                                    <div class="mb-3 row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Slider Title</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text"
                                                class="form-control @error('slider_title') is-invalid @enderror"
                                                name="slider_title" value="{{ old('slider_title', $slider->slider_title) }}" />
                                            @error('slider_title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Short Title</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text"
                                                class="form-control @error('short_title') is-invalid @enderror"
                                                name="short_title" value="{{ old('short_title', $slider->short_title) }}" />
                                            @error('short_title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Slider Image</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="file" name="slider_image"
                                                class="form-control @error('slider_image') is-invalid @enderror"
                                                id="image" />
                                            @error('slider_image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <input type="hidden" name="old_image" value="{{ $slider->slider_image }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"></h6>
                                        </div>
                                        <div class="col-9 text-secondary">
                                            <img src="{{ url($slider->slider_image) }}" alt="Slider Image" width="110"
                                                height="110" id="showImage">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="px-4 btn btn-primary" value="Save Changes" />
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection