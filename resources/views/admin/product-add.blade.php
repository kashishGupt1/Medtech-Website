@extends('admin.layouts.layout')

@section('title', 'Admin Dashboard | Medtech')

@section('content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.product.list') }}">Product List</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ isset($product) ? 'Edit Product' : 'Add New Product' }}</li>
                    </ol>
                </nav>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-header py-3">
                    <h5 class="mb-0"> {{ isset($product) ? 'Edit Product' : 'Add New Product' }}</h5>
                </div>
                <div class="card-body p-4">
                    <form id="productForm" enctype="multipart/form-data"
                        action="{{ isset($product) ? route('admin.product.update', $product->id) : route('admin.product.store') }}"
                        method="POST">
                        @csrf
                        @if (isset($product))
                            @method('PUT')
                        @endif

                        <div id="responseMsg"></div>
                        <div class="row g-3">
                            <div class="form-group col-md-4">
                                <label>Product Category <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-select">
                                    <option value="">Select product category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text category_id_error"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Product Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="product_name"
                                    value="{{ old('product_name', $product->product_name ?? '') }}" placeholder="Enter product name">
                                <span class="text-danger error-text product_name_error"></span>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label>Slug Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="slug"
                                    value="{{ old('slug', $product->slug ?? '') }}" placeholder="Enter slug name">
                                <span class="text-danger error-text slug_error"></span>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label>Product Size</label>
                                <input type="text" class="form-control" name="product_size"
                                    value="{{ old('product_size', $product->product_size ?? '') }}" placeholder="Enter product size">
                                <!--<span class="text-danger error-text product_size_error"></span>-->
                            </div>
                            <div class="form-group col-md-12">
                                <label>Product Description <span class="text-danger">*</span></label>
                                <textarea id="product_description" class="ckeditor" name="product_description" value="" placeholder="Enter product description">{{ old('product_description', $product->product_description ?? '') }}</textarea>

                                <span class="text-danger error-text product_description_error"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Product Main Image <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="product_main_image" accept="application/image/png,image/jpeg,image/jpg,image/webp">
                                <p class="mb-0"><span class="text-danger">Note*</span> Size: 400px * 265px</p>
                                 @if (isset($product) && $product->product_main_image)
                                    <img src="{{ asset('storage/' . $product->product_main_image) }}" width="80">
                                @endif 
                                <span class="text-danger error-text product_main_image_error"></span>
                            </div> 
                            @php
                                $selectedRelated = isset($product->related_products)
                                    ? json_decode($product->related_products, true)
                                    : [];
                            @endphp

                            <div class="form-group col-md-4">
                                <label for="multiple-select-custom-field">Related Products</label>
                                <select class="form-select select2" id="multiple-select-custom-field"
                                    name="related_products[]" multiple>
                                    @foreach ($allProducts as $prod)
                                        <option value="{{ $prod->id }}"
                                             {{ is_array($selectedRelated) && in_array($prod->id, $selectedRelated) ? 'selected' : '' }}>
                                            {{ $prod->product_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <!--<span class="text-danger error-text related_products_error"></span>-->
                            </div>
                            <div class="form-group col-md-4">
                                <label>Product heading 1</label>
                                <input type="text" class="form-control" name="product_heading_1"
                                    value="{{ old('product_heading_1', $product->product_heading_1 ?? '') }}" placeholder="Enter product heading 1">
                                <!--<span class="text-danger error-text product_heading_1_error"></span>-->
                            </div>
                            <div class="form-group col-md-4">
                                <label>Product Image 1</label>
                                <input type="file" class="form-control" name="product_image_1" accept="application/image/png,image/jpeg,image/jpg,image/webp">
                                @if (isset($product) && $product->product_image_1)
                                    <img src="{{ asset('storage/' . $product->product_image_1) }}" width="80">
                                @endif 
                                <!--<span class="text-danger error-text product_image_1_error"></span>-->
                            </div>
                            <div class="form-group col-md-4">
                                <label>Product heading 2</label>
                                <input type="text" class="form-control" name="product_heading_2"
                                    value="{{ old('product_heading_2', $product->product_heading_2 ?? '') }}" placeholder="Enter product heading 2">
                                <!--<span class="text-danger error-text product_heading_2_error"></span>-->
                            </div>
                            <div class="form-group col-md-4">
                                <label>Product Image 2</label>
                                <input type="file" class="form-control" name="product_image_2" accept="application/image/png,image/jpeg,image/jpg,image/webp">
                                @if (isset($product) && $product->product_image_2)
                                    <img src="{{ asset('storage/' . $product->product_image_2) }}" width="80">
                                @endif 
                                <!--<span class="text-danger error-text product_image_2_error"></span>-->
                            </div>
                            <div class="form-group col-md-4">
                                <label>Product heading 3</label>
                                <input type="text" class="form-control" name="product_heading_3"
                                    value="{{ old('product_heading_3', $product->product_heading_3 ?? '') }}" placeholder="Enter product heading 3">
                                <!--<span class="text-danger error-text product_heading_3_error"></span>-->
                            </div>
                            <div class="form-group col-md-4">
                                <label>Product Image 3</label>
                                <input type="file" class="form-control" name="product_image_3" accept="application/image/png,image/jpeg,image/jpg,image/webp">
                                @if (isset($product) && $product->product_image_3)
                                    <img src="{{ asset('storage/' . $product->product_image_3) }}" width="80">
                                @endif 
                                <!--<span class="text-danger error-text product_image_3_error"></span>-->
                            </div>
                        </div>
                        <h5 class="card-title mt-3">Breadcrumbs Information</h5>
                        <hr>
                        <div class="row g-3">
                            <div class="form-group col-md-4">
                                <label>Breadcrumbs Name <span class="text-danger">*</span></label>
                                <input type="text" name="breadcrumb_name" class="form-control"
                                    value="{{ old('breadcrumb_name', $product->breadcrumb_name ?? '') }}" placeholder="Enter product breadcrumbs name">
                                <span class="text-danger error-text breadcrumb_name_error"></span>
                            </div>
                        </div>

                        <h5 class="card-title mt-3">Product Features Information</h5>
                        <hr>
                        <div class="row g-3">
                            <div class="form-group col-md-12">
                                <button type="button" id="addFeatureBtn" class="btn btn-primary mb-2">Add More</button>
                            </div>
                        </div>
                        <div id="features-wrapper">
                            @php
                                $features = isset($product) ? json_decode($product->features, true) ?? [] : [''];
                            @endphp
                            @foreach ($features as $index => $feature)
                                <div class="row g-3 mb-4 feature-item">
                                    <div class="form-group col-md-4">
                                        <label>Features</label>
                                        <input type="text" name="features[]" value="{{ $feature }}"
                                            class="form-control" placeholder="Enter product features">
                                        <!--<span class="text-danger error-text features_0_error"></span>-->
                                    </div>
                                    <div class="form-group col-md-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger remove-feature">Remove</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!--<h5 class="card-title mt-3">Product Technical Specifications Information</h5>-->
                        <hr>
                        <div class="form-group col-md-12">
                            <label>Product Technical Specifications Information</label>
                            <textarea id="product_technical_specifications_information" class="ckeditor" name="product_technical_specifications_information" value="" placeholder="Enter Technical Specifications Information">{{ old('product_technical_specifications_information', $product->product_technical_specifications_information ?? '') }}</textarea>

                            <!--<span class="text-danger error-text product_description_error"></span>-->
                        </div>

                        <h5 class="card-title mt-3">Meta Information</h5>
                        <hr>

                        <div class="row g-3">
                            <div class="form-group col-md-4">
                                <label>Meta Keyword</label>
                                <input type="text" class="form-control" name="meta_keyword"
                                    value="{{ old('meta_keyword', $product->meta_keyword ?? '') }}"
                                    placeholder="Enter meta keyword">
                                <!--<span class="text-danger error-text meta_keyword_error"></span>-->
                            </div>

                            <div class="form-group col-md-4">
                                <label>Meta Title</label>
                                <input type="text" class="form-control" name="meta_title"
                                    value="{{ old('meta_title', $product->meta_title ?? '') }}"
                                    placeholder="Enter meta title">
                                <!--<span class="text-danger error-text meta_title_error"></span>-->
                            </div>

                            <div class="form-group col-md-4">
                                <label>Meta Description</label>
                                <textarea  id="meta_description" class="ckeditor" name="meta_description" placeholder="Enter meta description">{{ old('meta_description', $product->meta_description ?? '') }}</textarea>
                                <!--<span class="text-danger error-text meta_description_error"></span>-->
                            </div>
                            @if (isset($product))
                                <div class="form-group col-md-4">
                                    <label>Product Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-select">
                                        <option value="Active" {{ $product->status == 'Active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="Inactive" {{ $product->status == 'Inactive' ? 'selected' : '' }}>
                                            Inactive
                                        </option>
                                    </select>
                                    <span class="text-danger error-text status_error"></span>
                                </div>
                            @endif

                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-2" id="submitBtn">
                                    <span id="submitText">{{ isset($product) ? 'Update' : 'Submit' }}</span>
                                    <span id="submitLoader" class="spinner-border spinner-border-sm d-none"
                                        role="status"></span>
                                </button>
                                @if (!isset($product))
                                    <button type="reset" class="btn btn-light" id="cancelBtn">Cancel</button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->

    <script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js"></script>
    <script>
        $(document).ready(function() {
            let specIndex = 1;
            let featureIndex = 1;
            $('#addFeatureBtn').on('click', function() {
                $('#features-wrapper').append(`
                <div class="row g-3 mt-2 feature-item">
                    <div class="form-group col-md-4">
                        <input type="text" name="features[]" class="form-control" placeholder="Enter feature">
                        <span class="text-danger error-text features_${featureIndex}_error"></span>
                    </div>
                    <div class="form-group col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-feature">Remove</button>
                    </div>
                </div>
            `);
                featureIndex++;
            });


            $(document).on('click', '.remove-feature', function() {
                $(this).closest('.feature-item').remove();
            });


            $('#addSpecBtn').on('click', function() {
                $('#specs-wrapper').append(`
                <div class="row g-3 mt-2 spec-item">
                    <div class="form-group col-md-3">
                        <input type="text" name="specs[${specIndex}][gauge]" class="form-control" placeholder="Gauge">
                        <span class="text-danger error-text specs_${specIndex}_gauge_error"></span>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" name="specs[${specIndex}][size]" class="form-control" placeholder="Size">
                        <span class="text-danger error-text specs_${specIndex}_size_error"></span>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" name="specs[${specIndex}][flow_rate]" class="form-control" placeholder="Flow Rate">
                        <span class="text-danger error-text specs_${specIndex}_flow_rate_error"></span>
                    </div>
                    <div class="form-group col-md-2">
                        <input type="text" name="specs[${specIndex}][color_code]" class="form-control" placeholder="Color Code">
                        <span class="text-danger error-text specs_${specIndex}_color_code_error"></span>
                    </div>
                    <div class="form-group col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-spec">Remove</button>
                    </div>
                </div>
            `);
                specIndex++;
            });


            $(document).on('click', '.remove-spec', function() {
                $(this).closest('.spec-item').remove();
            });


            $('.feature-item:first .remove-feature').hide();
            $('.spec-item:first .remove-spec').hide();
        });
    </script>

      <script>
      document.addEventListener("DOMContentLoaded", function () {
        tinymce.init({
          selector: 'textarea.ckeditor',
          height: 300,
          plugins: 'print preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount help charmap quickbars emoticons',
          toolbar: 'undo redo | styleselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | link image media table | code fullscreen | table ',
          menubar: false,
          branding: false,
          toolbar_mode: 'sliding',
          content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
      });
        $(document).ready(function() {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "2000"
            };
            $('input[name="product_name"]').on('input', function () {
                let ProductName = $(this).val();
                let slug = ProductName
                    .toLowerCase()               
                    .replace(/[^a-z0-9\s-]/g, '') 
                    .trim()                      
                    .replace(/\s+/g, '-');        
        
                $('input[name="slug"]').val(slug);
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#productForm').submit(function(e) {
                e.preventDefault();
                $('#cancelBtn').on('click', function () {
                    $('#productForm')[0].reset();
                    $('.error-text').text('');
                    CKEditorHelper.clearAll();
                });
                $('#submitBtn').prop('disabled', true);
                $('#submitLoader').removeClass('d-none');
                $('#submitText').text('Submitting...');

                let formData = new FormData(this);
                $('.error-text').text('');


                let actionUrl = $(this).attr('action');


                const method = $(this).find('input[name="_method"]').val();
                if (method) {
                    formData.append('_method', method);
                }

                $.ajax({
                    url: actionUrl,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,

                    success: function(response) {
                   $('#submitText').text('Submit');
                    $('#submitLoader').addClass('d-none');
                    $('#submitBtn').prop('disabled', false);
                        if (response.status) {
                            toastr.success(response.message);
                            setTimeout(() => {
                                window.location.href =
                                    "{{ route('admin.product.list') }}";
                            }, 2000);
                        }
                    },

                    error: function(xhr) {
                    $('#submitText').text('Submit');
                    $('#submitLoader').addClass('d-none');
                    $('#submitBtn').prop('disabled', false);
                        let errors = xhr.responseJSON?.errors || {};
                        $.each(errors, function(key, value) {
                            key = key.replace(/\./g, '_');
                            $(`.${key}_error`).text(value[0]);
                        });
                    },

                    complete: function() {
                        $('#submitBtn').prop('disabled', false);
                        $('#submitLoader').addClass('d-none');
                        $('#submitText').removeClass('d-none');
                    }
                });
            });
        });
    </script>



@endsection
