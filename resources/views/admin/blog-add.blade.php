@extends('admin.layouts.layout')

@section('title', 'Admin Dashboard | Medtech')

@section('content')
    @php
        $isEdit = isset($blog);
    @endphp
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.blog.list') }}">Blog List</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $isEdit ? 'Edit' : 'Add New' }} Blog</li>
                    </ol>
                </nav>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-header py-3">
                    <h5 class="mb-0">{{ $isEdit ? 'Edit' : 'Add New' }} Blog</h5>
                </div>
                @php
                    $isEdit = $mode === 'edit';
                    $route = $isEdit ? route('admin.blog.update', $blog->id) : route('admin.blog.store');
                @endphp
                <div class="card-body p-4">
                    <form class="ajax-form" id="blogForm" enctype="multipart/form-data" action="{{ $route }}">
                        @csrf
                        <div class="row g-3">
                            <div class="form-group col-md-4">
                                <label>Blog Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="blog_name"
                                    value="{{ old('blog_name', $blog->blog_name ?? '') }}" placeholder="Enter blog title">
                                <span class="text-danger error-text blog_name_error"></span>
                            </div>
                            
                           <div class="form-group col-md-4">
                                <label>Blog Slug <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="slug"
                                    value="{{ old('slug', $blog->slug ?? '') }}" placeholder="Enter slug">
                                <span class="text-danger error-text slug_error"></span>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label>Blog Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="blog_date"
                                    value="{{ old('blog_date', $blog->blog_date ?? '') }}">
                                <span class="text-danger error-text blog_date_error"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Blog Location <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="blog_location"
                                    value="{{ old('blog_location', $blog->blog_location ?? '') }}"
                                    placeholder="Enter blog location">
                                <span class="text-danger error-text blog_location_error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Blog Description <span class="text-danger">*</span></label>
                                <textarea class="ckeditor" name="blog_description" placeholder="Enter blog description">{{ old('blog_description', $blog->blog_description ?? '') }}</textarea>
                                <span class="text-danger error-text blog_description_error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Blog Main Image <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="blog_main_image"
                                    accept="application/image/png,image/jpeg,image/jpg,image/webp">
                                @if (isset($blog) && $blog->blog_main_image)
                                    <img src="{{ asset('storage/' . $blog->blog_main_image) }}" width="80">
                                @endif     
                                <span class="text-danger error-text blog_main_image_error"></span>
                            </div>

                            <div id="imageRepeater" class="form-group col-md-12">
                                @php $existingImages = $blog->decoded_images ?? []; @endphp

                                @foreach ($existingImages as $index => $image)
                                    <div class="row g-2 align-items-end repeater-item" data-index="{{ $index }}">
                                        <div class="col-md-4">
                                            <label>Existing Blog Image {{ $index + 1 }}</label><br>
                                            <img src="{{ asset('storage/' . $image) }}" alt="Blog Image"
                                                class="img-thumbnail mb-2" width="150">
                                            <input type="file" name="blog_images_existing[{{ $index }}]"
                                                class="form-control mt-2" accept="image/*">
                                            <input type="hidden" name="existing_blog_images[]"
                                                value="{{ $image }}">
                                            <span
                                                class="text-danger error-text blog_images_{{ $index }}_error"></span>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger btn-remove">Remove</button>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Placeholder for adding new images -->
                                <div class="row g-2 align-items-end repeater-item"
                                    data-index="{{ count($existingImages) }}">
                                    <div class="col-md-4">
                                        <label>New Blog Image</label>
                                        <input type="file" name="blog_images[]" class="form-control" accept="image/*">
                                        <span
                                            class="text-danger error-text blog_images_{{ count($existingImages) }}_error"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn-remove d-none">Remove</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary" id="addMoreBtn">Add More</button>
                            </div>

                        </div>

                        <h5 class="card-title mt-3">Breadcrumbs Information</h5>
                        <hr>
                        <div class="row g-3">
                            <div class="form-group col-md-4">
                                <label>Breadcrumbs Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="breadcrumb_name"
                                    value="{{ old('breadcrumb_name', $blog->breadcrumb_name ?? '') }}"
                                    placeholder="Enter blog meta breadcrumbs name">
                                <span class="text-danger error-text breadcrumb_name_error"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Breadcrumbs Description</label>
                                <textarea class="ckeditor" name="breadcrumb_description" placeholder="Enter blogbreadcrumbs description">{{ old('breadcrumb_description', $blog->breadcrumb_description ?? '') }}</textarea>
                                <!--<span class="text-danger error-text breadcrumb_description_error"></span>-->
                            </div>
                            <div class="form-group col-md-4">
                                <label>Breadcrumbs Image</label>
                                <input type="file" class="form-control" name="breadcrumb_photo"
                                    accept="application/image/png,image/jpeg,image/jpg,image/webp">
                                @if (isset($blog) && $blog->breadcrumb_photo)
                                    <img src="{{ asset('storage/' . $blog->breadcrumb_photo) }}" width="80">
                                @endif    
                                <span class="text-danger error-text breadcrumb_photo_error"></span>
                            </div>
                        </div>

                        <h5 class="card-title mt-3">Meta Information</h5>
                        <hr>
                        <div class="row g-3">
                            <div class="form-group col-md-4">
                                <label>Meta Keyword</label>
                                <input type="text" class="form-control" name="meta_keyword"
                                    value="{{ old('meta_keyword', $blog->meta_keyword ?? '') }}"
                                    placeholder="Enter blog meta keyword">
                                <!--<span class="text-danger error-text meta_keyword_error"></span>-->
                            </div>
                            <div class="form-group col-md-4">
                                <label>Meta Title</label>
                                <input type="text" class="form-control" name="meta_title"
                                    value="{{ old('meta_title', $blog->meta_title ?? '') }}"
                                    placeholder="Enter blog meta title">
                                <!--<span class="text-danger error-text meta_title_error"></span>-->
                            </div>
                            <div class="form-group col-md-4">
                                <label>Meta Description</label>
                                <textarea class="ckeditor" name="meta_description" placeholder="Enter blog meta description">{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
                                <!--<span class="text-danger error-text meta_description_error"></span>-->
                            </div>
                            @if ($isEdit)
                                <div class="form-group col-md-4">
                                    <label>Blog Status</label>
                                    <select name="status" class="form-select">
                                        <option value="Active" {{ $blog->status == 'Active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="Inactive" {{ $blog->status == 'Inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                    <span class="text-danger error-text status_error"></span>
                                </div>
                            @endif
                        </div>

                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-primary me-2" id="submitBtn">
                                <span id="submitText">{{ $isEdit ? 'Update' : 'Submit' }}</span>
                                <span id="submitLoader" class="spinner-border spinner-border-sm d-none"
                                    role="status"></span>
                            </button>
                            @if (!$isEdit)
                                <button type="reset" class="btn btn-light" id="cancelBtn">Cancel</button>
                            @endif
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
            $('input[name="blog_name"]').on('input', function () {
                let blogName = $(this).val();
                let slug = blogName
                    .toLowerCase()               
                    .replace(/[^a-z0-9\s-]/g, '') 
                    .trim()                      
                    .replace(/\s+/g, '-');        
        
                $('input[name="slug"]').val(slug);
            });
      });
        document.addEventListener("DOMContentLoaded", () => {
           $('#addMoreBtn').on('click', function () {
                let count = $('#imageRepeater .repeater-item').length;
                let clone = $('#imageRepeater .repeater-item:last').clone();

                clone.attr('data-index', count);
                clone.find('input[type="file"]').attr('name', 'blog_images[' + count + ']');
                clone.find('input[type="file"]').val('');
                clone.find('img').remove(); 
                clone.find('.error-text')
                    .attr('class', 'text-danger error-text blog_images_' + count + '_error')
                    .text('');
                clone.find('.btn-remove').removeClass('d-none');

                $('#imageRepeater').append(clone);
            });

            $(document).on('click', '.btn-remove', function () {
                $(this).closest('.repeater-item').remove();
            });


            $(document).on('click', '.btn-remove', function() {
                $(this).closest('.repeater-item').remove();
            });
            $('#cancelBtn').on('click', function() {
                $('.ajax-form')[0].reset();
                $('.error-text').text('');
            });


            $(document).on('submit', '.ajax-form', function(e) {
                e.preventDefault();

                const $form = $(this);
                

                const formData = new FormData(this);

                $form.find('.error-text').text('');
                $('#submitBtn').prop('disabled', true);
                $('#submitLoader').removeClass('d-none');
                $('#submitText').text('Submitting...');

                $.ajax({
                    url: $form.attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        $('#submitText').text('Submit');
                        $('#submitLoader').addClass('d-none');
                        $('#submitBtn').prop('disabled', false);
                        toastr.success(res.message);
                        setTimeout(() => window.location.href =
                            "{{ route('admin.blog.list') }}", 2000);
                    },
                    error: function(xhr) {
                        $('#submitText').text('Submit');
                        $('#submitLoader').addClass('d-none');
                        $('#submitBtn').prop('disabled', false);

                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function(key, val) {
                                key = key.replace(/\./g, '_');
                                $form.find('.' + key + '_error').text(val[0]);
                            });
                        } else {
                            toastr.error('Something went wrong.');
                            console.error(xhr.responseJSON);
                        }
                    }
                });
            });
        });
    </script>


    <!--end page wrapper -->
@endsection
