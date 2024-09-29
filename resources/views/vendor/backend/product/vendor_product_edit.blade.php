@extends('vendor.vendor_dashboard')

@section('vendor')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">

        <div class="card">
            <div class="p-4 card-body">
                <h5 class="card-title">Edit Product</h5>
                <hr />
                <form method="POST" enctype="multipart/form-data" action="{{ route('vendor.update.product') }}">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" value="{{ $products->id }}">

                    <div class="mt-4 form-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="p-4 border rounded border-3">
                                    <div class="mb-3">
                                        <label for="inputProductName" class="form-label">Product Name</label>
                                        <input type="text" name="product_name"
                                            class="form-control @error('product_name') is-invalid @enderror"
                                            id="inputProductTitle" placeholder="Enter product title"
                                            value="{{ $products->product_name }}">
                                        @error('product_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductTags" class="form-label">Product Tags</label>
                                        <input type="text" name="product_tags"
                                            class="form-control visually-hidden @error('product_tags') is-invalid @enderror"
                                            data-role="tagsinput" value="{{ $products->product_tags }}">
                                        @error('product_tags')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductSize" class="form-label">Product Size</label>
                                        <input type="text" name="product_size"
                                            class="form-control visually-hidden @error('product_size') is-invalid @enderror"
                                            data-role="tagsinput" value="{{ $products->product_size }}">
                                        @error('product_size')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductColor" class="form-label">Product Color</label>
                                        <input type="text" name="product_color"
                                            class="form-control visually-hidden @error('product_color') is-invalid @enderror"
                                            data-role="tagsinput" value="{{ $products->product_color }}">
                                        @error('product_color')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Short Description</label>
                                        <textarea class="form-control @error('short_descp') is-invalid @enderror" id="inputProductDescription"
                                            name="short_descp" rows="3">{{ $products->short_descp }}</textarea>
                                        @error('short_descp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Long Description</label>
                                        <textarea class="form-control @error('long_descp') is-invalid @enderror" id="inputProductDescription" name="long_descp"
                                            rows="3">{!! $products->long_descp !!}</textarea>
                                        @error('long_descp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="p-4 border rounded border-3">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="inputPrice" class="form-label">Product Price</label>
                                            <input type="text" name="selling_price"
                                                class="form-control @error('selling_price') is-invalid @enderror"
                                                id="inputPrice" value="{{ $products->selling_price }}">
                                            @error('selling_price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCompareatprice" class="form-label">Discount Price</label>
                                            <input type="text" name="discount_price"
                                                class="form-control @error('discount_price') is-invalid @enderror"
                                                id="inputCompareatprice" value="{{ $products->discount_price }}">
                                            @error('discount_price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCostPerPrice" class="form-label">Product Code</label>
                                            <input type="text" name="product_code"
                                                class="form-control @error('product_code') is-invalid @enderror"
                                                id="inputCostPerPrice" value="{{ $products->product_code }}">
                                            @error('product_code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputStarPoints" class="form-label">Product Quantity</label>
                                            <input type="text" name="product_qty"
                                                class="form-control @error('product_qty') is-invalid @enderror"
                                                id="inputStarPoints" value="{{ $products->product_qty }}">
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
                                                        {{ old('brand_id', $products->brand_id) == $brand->id ? 'selected' : '' }}>
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
                                                        {{ old('category_id', $products->category_id) == $category->id ? 'selected' : '' }}>
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
                                                @foreach ($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}"
                                                        {{ old('subcategory_id', $products->subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                                                        {{ $subcategory->subcategory_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('subcategory_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="hot_deals" type="checkbox"
                                                            value="1" id="flexCheckDefault"
                                                            {{ $products->hot_deals == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexCheckDefault">Hot
                                                            Deals</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="featured" type="checkbox"
                                                            value="1" id="flexCheckDefault"
                                                            {{ $products->featured == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="flexCheckDefault">Featured</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="special_offer"
                                                            type="checkbox" value="1" id="flexCheckDefault"
                                                            {{ $products->special_offer == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexCheckDefault">Special
                                                            Offers</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="special_deals"
                                                            type="checkbox" value="1" id="flexCheckDefault"
                                                            {{ $products->special_deals == 1 ? 'checked' : '' }}>
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
                                                value="{{ old('product_tags', $products->product_tags) }}">
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


    <!-- Update Product Thumbnail -->
    <div class="page-content">
        <h6 class="mb-0 text-uppercase">Product Thumbnail</h6>
        <hr>
        <div class="card">
            <form action="{{ route('vendor.update.product.thumbnail') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <input type="hidden" name="id" value="{{ $products->id }}">
                <input type="hidden" name="old_img" value="{{ $products->product_thumbnail }}">

                <div class="card-body">
                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label">Update Main Thumbnail</label>
                        <input name="product_thumbnail"
                            class="form-control @error('product_thumbnail') is-invalid @enderror" type="file"
                            id="formFile">
                        @error('product_thumbnail')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label"></label>
                        <img src="{{ asset($products->product_thumbnail) }}" alt="image" class="rounded"
                            height="100px" width="100px">
                    </div>

                    <button type="submit" class="px-4 btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Update Multi Image -->
    <div class="page-content">
        <h6 class="mb-0 text-uppercase">Update Multi Image</h6>
        <hr>
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('vendor.update.product.multi.image') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    @if ($multiImgs && $multiImgs->count() > 0)
                        <table class="table mb-0 table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#Sl</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Change Image</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($multiImgs as $key => $img)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><img src="{{ asset($img->photo_name) }}" style="width:100px; height: 90px;">
                                        </td>
                                        <td><input type="file" class="form-group"
                                                name="multi_img[{{ $img->id }}]">
                                        </td>
                                        <td>
                                            <button type="submit" class="px-4 btn btn-primary">Update Image</button>
                                            <a href="{{ route('vendor.delete.product.multi.image', ['id' => $img->id]) }}"
                                                class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-danger">No Image Found</div>
                    @endif
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
                        url: "{{ url('/vendor/subcategory/ajax') }}/" + category_id,
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
