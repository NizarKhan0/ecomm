@extends('admin.admin_dashboard')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Add New Product</h5>
                <hr />
                <form method="POST" enctype="multipart/form-data" action="{{ route('store.product') }}">
                    @csrf
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="inputProductName" class="form-label">Product Name</label>
                                        <input type="text" name="product_name"
                                            class="form-control @error('product_name') is-invalid @enderror"
                                            id="inputProductTitle" placeholder="Enter product title"
                                            value="{{ old('product_name') }}">
                                        @error('product_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductTags" class="form-label">Product Tags</label>
                                        <input type="text" name="product_tags"
                                            class="form-control visually-hidden @error('product_tags') is-invalid @enderror"
                                            data-role="tagsinput"
                                            value="{{ old('product_tags', 'new product, top product') }}">
                                        @error('product_tags')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductSize" class="form-label">Product Size</label>
                                        <input type="text" name="product_size"
                                            class="form-control visually-hidden @error('product_size') is-invalid @enderror"
                                            data-role="tagsinput" value="{{ old('product_size', 'Small, Medium, Large') }}">
                                        @error('product_size')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductColor" class="form-label">Product Color</label>
                                        <input type="text" name="product_color"
                                            class="form-control visually-hidden @error('product_color') is-invalid @enderror"
                                            data-role="tagsinput" value="{{ old('product_color', 'Red, Blue, Black') }}">
                                        @error('product_color')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Short Description</label>
                                        <textarea class="form-control @error('short_descp') is-invalid @enderror" id="inputProductDescription"
                                            name="short_descp" rows="3">{{ old('short_descp') }}</textarea>
                                        @error('short_descp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Long Description</label>
                                        <textarea class="form-control @error('long_descp') is-invalid @enderror" id="inputProductDescription"
                                            name="long_descp" rows="3">{{ old('long_descp') }}</textarea>
                                        @error('long_descp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- <label for="inputProductDescription" class="form-label">Long Description</label>
                                    <div class="mb-3" id="editor">
                                        <textarea name="long_descp" rows="3" class="form-control @error('long_descp') is-invalid @enderror">{{ old('long_descp') }}</textarea>
                                        @error('long_descp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                    <div class="mb-3">
                                        <label for="formFileMultiple" class="form-label">Main Thumbnail</label>
                                        <input name="product_thumbnail"
                                            class="form-control @error('product_thumbnail') is-invalid @enderror"
                                            type="file" id="formFile" onChange="mainThamUrl(this)">
                                        <img src="" id="mainThmb" />
                                        @error('product_thumbnail')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="formFileMultiple" class="form-label">Multiple Image</label>
                                        <input name="multi_img[]"
                                            class="form-control @error('multi_img') is-invalid @enderror" type="file"
                                            id="multiImg" multiple>
                                        <div class="row" id="preview_img"></div>
                                        @error('multi_img')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="inputPrice" class="form-label">Product Price</label>
                                            <input type="text" name="selling_price"
                                                class="form-control @error('selling_price') is-invalid @enderror"
                                                id="inputPrice" placeholder="00.00" value="{{ old('selling_price') }}">
                                            @error('selling_price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCompareatprice" class="form-label">Discount Price</label>
                                            <input type="text" name="discount_price"
                                                class="form-control @error('discount_price') is-invalid @enderror"
                                                id="inputCompareatprice" placeholder="00.00"
                                                value="{{ old('discount_price') }}">
                                            @error('discount_price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCostPerPrice" class="form-label">Product Code</label>
                                            <input type="text" name="product_code"
                                                class="form-control @error('product_code') is-invalid @enderror"
                                                id="inputCostPerPrice" placeholder="" value="{{ old('product_code') }}">
                                            @error('product_code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputStarPoints" class="form-label">Product Quantity</label>
                                            <input type="text" name="product_qty"
                                                class="form-control @error('product_qty') is-invalid @enderror"
                                                id="inputStarPoints" placeholder="" value="{{ old('product_qty') }}">
                                            @error('product_qty')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="inputProductType" class="form-label">Product Brand</label>
                                            <select name="brand_id"
                                                class="form-select @error('brand_id') is-invalid @enderror"
                                                id="inputProductType">
                                                <option></option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}"
                                                        {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                                        {{ $brand->brand_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('brand_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="inputProductType" class="form-label">Product Category</label>
                                            <select name="category_id"
                                                class="form-select @error('category_id') is-invalid @enderror"
                                                id="inputProductType">
                                                <option></option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="inputProductType" class="form-label">Product SubCategory</label>
                                            <select name="subcategory_id"
                                                class="form-select @error('subcategory_id') is-invalid @enderror"
                                                id="inputProductType">
                                                <option></option>
                                            </select>
                                            @error('subcategory_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="inputVendor" class="form-label">Select Vendor</label>
                                            <select name="vendor_id"
                                                class="form-select @error('vendor_id') is-invalid @enderror"
                                                id="inputVendor">
                                                <option></option>
                                                @foreach ($activeVendor as $vendor)
                                                    <option value="{{ $vendor->id }}"
                                                        {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>
                                                        {{ $vendor->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('vendor_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="hot_deals" type="checkbox"
                                                            value="1" id="flexCheckDefault"
                                                            {{ old('hot_deals') ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexCheckDefault">Hot
                                                            Deals</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="featured" type="checkbox"
                                                            value="1" id="flexCheckDefault"
                                                            {{ old('featured') ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="flexCheckDefault">Featured</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="special_offer"
                                                            type="checkbox" value="1" id="flexCheckDefault"
                                                            {{ old('special_offer') ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexCheckDefault">Special
                                                            Offers</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="special_deals"
                                                            type="checkbox" value="1" id="flexCheckDefault"
                                                            {{ old('special_deals') ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexCheckDefault">Special
                                                            Deals</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-12">
                                            <label for="inputProductTags" class="form-label">Product Tags</label>
                                            <input type="text" name="product_tags"
                                                class="form-control @error('product_tags') is-invalid @enderror"
                                                id="inputProductTags" placeholder="Enter Product Tags"
                                                value="{{ old('product_tags') }}">
                                            @error('product_tags')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <input type="submit" class="btn btn-primary" value="Save Product">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end row-->
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script type="text/javascript">
        function mainThamUrl(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThmb').attr('src', e.target.result).width(80).height(80);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).width(100)
                                        .height(80); //create image element
                                    $('#preview_img').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/subcategory/ajax') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            // Clear the subcategory dropdown
                            $('select[name="subcategory_id"]').html('');
                            // Populate the subcategory dropdown
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .subcategory_name + '</option>'
                                );
                            });
                        },
                        error: function() {
                            alert('An error occurred while fetching subcategories.');
                        }
                    });
                } else {
                    alert('Please select a category.');
                }
            });
        });
    </script>
@endsection
