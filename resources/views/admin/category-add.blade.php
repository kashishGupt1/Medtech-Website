@extends("admin.layouts.layout")

@section("title", "Admin Dashboard | Medtech")

@section('content')
@php
    $isEdit = isset($category);
@endphp
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.category-list') }}">Category List</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"> {{ $isEdit ? 'Edit Category' : 'Add Category' }}</li>
                    </ol>
                </nav>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-header py-3">
                    <h5 class="mb-0">{{ $isEdit ? 'Edit' : 'Add New' }} Category</h5>
                </div>
                <div class="card-body p-4">
                    <form class="ajax-form" id="addCategoryForm" enctype="multipart/form-data" 
                    action="{{ $isEdit ? route('admin.category.update', $category->id) : route('admin.category.store') }}" method="POST">
                         @csrf       
                                  
                        <div id="responseMsg"></div>
                        <div class="row g-3">
                            <div class="form-group col-md-4">
                                <label>Category Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="category_name" value="{{ old('category_name', $category->category_name ?? '') }}"
                                    placeholder="Enter category name">
                                <span class="text-danger error-text category_name_error"></span>
                            </div>
                            
                                <div class="form-group col-md-4">
                                    <label>Slug Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="slug"
                                        value="{{ old('slug', $category->slug ?? '') }}" placeholder="Enter slug name">
                                    <span class="text-danger error-text slug_error"></span>
                                </div>
                           
                            <div class="form-group col-md-4">
                                <label>Short Description <span class="text-danger">*</span></label>
                                <textarea class="ckeditor" class="form-control" name="short_description" 
                                    placeholder="Enter short description">{{ old('short_description', $category->short_description ?? '') }}</textarea>
                                <span class="text-danger error-text short_description_error"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Category Image <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="category_image" accept="application/image/png,image/jpeg,image/jpg,image/webp">
                                @if (isset($category) && $category->category_image)
                                    <img src="{{ asset('storage/' . $category->category_image) }}" width="80">
                                @endif 
                                <span class="text-danger error-text category_image_error"></span>
                            </div>
                        </div>
                        <h5 class="card-title mt-3">Breadcrumbs Information</h5>
                        <hr>
                        <div class="row g-3">
                            <div class="form-group col-md-4">
                                <label>Breadcrumbs Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="breadcrumb_name" value="{{ old('breadcrumb_name', $category->breadcrumb_name ?? '') }}"
                                    placeholder="Enter breadcrumb name">
                                <span class="text-danger error-text breadcrumb_name_error"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Breadcrumbs Description</label>
                                <textarea class="ckeditor" class="form-control" name="breadcrumb_description" 
                                    placeholder="Enter breadcrumb description">{{ old('breadcrumb_description', $category->breadcrumb_description ?? '') }}</textarea>
                                <!--<span class="text-danger error-text breadcrumb_description_error"></span>-->
                            </div>
                            <div class="form-group col-md-4">
                                <label>Breadcrumbs Image </label>
                                <input type="file" class="form-control" name="breadcrumb_image" accept="application/image/png,image/jpeg,image/jpg,image/webp">
                                @if (isset($category) && $category->breadcrumb_image)
                                    <img src="{{ asset('storage/' . $category->breadcrumb_image) }}" width="80">
                                @endif 
                                <span class="text-danger error-text breadcrumb_image_error"></span>
                            </div>
                        </div>


                        <h5 class="card-title mt-3">Meta Information</h5>
                        <hr>

                        <div class="row g-3">
                            <div class="form-group col-md-4">
                                <label>Meta Keyword</label>
                                <input type="text" class="form-control" name="meta_keyword" value="{{ old('meta_keyword', $category->meta_keyword ?? '') }}"
                                    placeholder="Enter meta keyword">
                                <!--<span class="text-danger error-text meta_keyword_error"></span>-->
                            </div>

                            <div class="form-group col-md-4">
                                <label>Meta Title</label>
                                <input type="text" class="form-control" name="meta_title"  value="{{ old('meta_title', $category->meta_title ?? '') }}"
                                    placeholder="Enter meta title">
                                <!--<span class="text-danger error-text meta_title_error"></span>-->
                            </div>

                            <div class="form-group col-md-4">
                                <label>Meta Description</label>
                                <textarea class="ckeditor" class="form-control" name="meta_description" value=""
                                    placeholder="Enter meta description">{{ old('meta_description', $category->meta_description ?? '') }}</textarea>
                                <!--<span class="text-danger error-text meta_description_error"></span>-->
                            </div>
                            @if($isEdit)
                            <div class="form-group col-md-4">
                                <label>Category Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-select">
                                    <option value="Active" {{ (old('status', $category->status ?? '') == 'Active') ? 'selected' : '' }}>Active</option>
                                    <option value="Inactive" {{ (old('status', $category->status ?? '') == 'Inactive') ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <!--<span class="text-danger error-text status_error"></span>-->
                            </div>
                            @endif


                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-2" id="submitBtn">
                                    <span id="submitText">{{$isEdit ? 'Update' : 'Submit'}}</span>
                                    <span id="submitLoader" class="spinner-border spinner-border-sm d-none"
                                        role="status"></span>
                                </button>
                                @if(!$isEdit)
                                <button type="reset" class="btn btn-light" id="cancelBtn">Cancel</button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js"></script>
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
    $(document).ready(function () {
        $('input[name="category_name"]').on('input', function () {
        let categoryName = $(this).val();
        let slug = categoryName
            .toLowerCase()                
            .replace(/[^a-z0-9\s-]/g, '') 
            .trim()                       
            .replace(/\s+/g, '-');        

        $('input[name="slug"]').val(slug);
    });
        // CKEditorHelper.init();
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "2000"
        };
        $('#addCategoryForm').on('submit', function (e) {
            e.preventDefault();
            let form = $(this);
            let formData = new FormData(this);
            $('.error-text').text('');

            $('#submitBtn').prop('disabled', true);
            $('#submitLoader').removeClass('d-none');
            $('#submitText').text('Submitting...');

            $.ajax({
                type: "POST",
                url: form.attr('action'),
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#submitText').text('Submit');
                    $('#submitLoader').addClass('d-none');
                    $('#submitBtn').prop('disabled', false);

                    if (response.success) {
                        toastr.success(response.success);
                        setTimeout(() => {
                            window.location.href = "{{ route('admin.category-list') }}";
                        }, 2000);
                    }
                },
                error: function (xhr) {
                    $('#submitText').text('Submit');
                    $('#submitLoader').addClass('d-none');
                    $('#submitBtn').prop('disabled', false);

                    if (xhr.status === 422) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $(`.${key}_error`).text(value[0]);
                        });
                        // toastr.warning("Please fix the validation errors.");
                    } else {
                        toastr.error("Something went wrong. Please try again.");
                    }
                }
            });
        });

            $('#cancelBtn').on('click', function (e) {
        e.preventDefault();
        $('#addCategoryForm')[0].reset();
        $('.error-text').text('');
        $('#responseMsg').html('');
    });
    });
</script>



@endsection