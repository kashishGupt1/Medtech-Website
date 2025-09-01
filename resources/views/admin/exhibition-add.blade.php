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
                        <li class="breadcrumb-item"><a href="{{ route('admin.exhibition.list') }}">Exhibition List</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $exhibition ? 'Edit' : 'Add New Exhibition' }}</li>
                    </ol>
                </nav>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-header py-3">
                    <h5 class="mb-0">{{ $exhibition ? 'Edit' : 'Add New' }} Exhibition</h5>
                </div>
                <div class="card-body p-4">
                    <form class="ajax-form" id="exhibitionForm" enctype="multipart/form-data"
                        data-action="{{ $exhibition ? route('admin.exhibition.update', $exhibition->id) : route('admin.exhibition.store') }}">
                        @csrf

                        <div class="row g-3">
                            <div class="form-group col-md-4">
                                <label>Exhibition Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="exhibition_name"
                                    value="{{ $exhibition->exhibition_name ?? '' }}" placeholder="Enter exhibition name">
                                <span class="text-danger error-text exhibition_name_error"></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Exhibition Slug <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="slug"
                                    value="{{ $exhibition->slug ?? '' }}" placeholder="Enter slug">
                                <span class="text-danger error-text slug_error"></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Exhibition Start Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="exhibition_start_date" id="exhibition_start_date"
                                    value="{{ old('exhibition_start_date', isset($exhibition) && $exhibition->exhibition_start_date ? \Carbon\Carbon::parse($exhibition->exhibition_start_date)->format('Y-m-d') : '') }}">
                                <span class="text-danger error-text exhibition_start_date_error"></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Exhibition End Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="exhibition_end_date" id="exhibition_end_date"
                                    value="{{ old('exhibition_end_date', isset($exhibition) && $exhibition->exhibition_end_date ? \Carbon\Carbon::parse($exhibition->exhibition_end_date)->format('Y-m-d') : '') }}">
                                <span class="text-danger error-text exhibition_end_date_error"></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Exhibition Location <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="exhibition_location"
                                    value="{{ $exhibition->exhibition_location ?? '' }}"
                                    placeholder="Enter exhibition location">
                                <span class="text-danger error-text exhibition_location_error"></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Exhibition Description</label>
                                <textarea class="ckeditor" name="exhibition_description" placeholder="Enter exhibition description">{{ $exhibition->exhibition_description ?? '' }}</textarea>
                                <!--<span class="text-danger error-text exhibition_description_error"></span>-->
                            </div>

                            <div class="form-group col-md-4">
                                <label>Exhibition Main Image</label>
                                <input type="file" class="form-control" name="exhibition_photo"
                                    accept="application/image/png,image/jpeg,image/jpg,image/webp">
                                @if ($exhibition && $exhibition->exhibition_photo)
                                    <img src="{{ asset('storage/' . $exhibition->exhibition_photo) }}" class="mt-2"
                                        width="100">
                                @endif
                                <!--<span class="text-danger error-text exhibition_photo_error"></span>-->
                            </div>

                            <div id="imageRepeater" class="form-group col-md-12">
                                @php $existingImages = $exhibition->decoded_images ?? []; @endphp

                                @foreach ($existingImages as $index => $image)
                                    <div class="row g-2 align-items-end repeater-item" data-index="{{ $index }}">
                                        <div class="col-md-4">
                                            <label>Existing Exhibition Image {{ $index + 1 }}</label><br>
                                            <img src="{{ asset('storage/' . $image) }}" alt="Exhibition Image"
                                                class="img-thumbnail mb-2" width="150">
                                            <input type="file" name="exhibition_images_existing[{{ $index }}]"
                                                class="form-control mt-2" accept="image/*">
                                            <input type="hidden" name="existing_exhibition_images[]"
                                                value="{{ $image }}">
                                            <span
                                                class="text-danger error-text exhibition_images_{{ $index }}_error"></span>
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
                                        <label>New Exhibition Image</label>
                                        <input type="file" name="exhibition_images[]" class="form-control"
                                            accept="image/*">
                                        <span
                                            class="text-danger error-text exhibition_images_{{ count($existingImages) }}_error"></span>
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

                        <h5 class="card-title mt-4">Breadcrumbs Information</h5>
                        <hr>

                        <div class="row g-3">
                            <div class="form-group col-md-4">
                                <label>Breadcrumb Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="breadcrumb_name"
                                    value="{{ $exhibition->breadcrumb_name ?? '' }}"
                                    placeholder="Enter exhibition breadcrumb name ">
                                <span class="text-danger error-text breadcrumb_name_error"></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Breadcrumb Description</label>
                                <textarea class="ckeditor" name="breadcrumb_description" placeholder="Enter exhibition breadcrumb description">{{ $exhibition->breadcrumb_description ?? '' }}</textarea>
                                <!--<span class="text-danger error-text breadcrumb_description_error"></span>-->
                            </div>

                            <div class="form-group col-md-4">
                                <label>Breadcrumb Image</label>
                                <input type="file" class="form-control" name="breadcrumb_photo"
                                    accept="application/image/png,image/jpeg,image/jpg,image/webp">
                                @if ($exhibition && $exhibition->breadcrumb_photo)
                                    <img src="{{ asset('storage/' . $exhibition->breadcrumb_photo) }}" class="mt-2"
                                        width="100">
                                @endif
                                <span class="text-danger error-text breadcrumb_photo_error"></span>
                            </div>
                        </div>

                        <h5 class="card-title mt-4">Meta Information</h5>
                        <hr>
                        <div class="row g-3">
                            <div class="form-group col-md-4">
                                <label>Meta Keyword</label>
                                <input type="text" class="form-control" name="meta_keyword"
                                    value="{{ $exhibition->meta_keyword ?? '' }}"
                                    placeholder="Enter exhibition meta keyword">
                                <!--<span class="text-danger error-text meta_keyword_error"></span>-->
                            </div>

                            <div class="form-group col-md-4">
                                <label>Meta Title</label>
                                <input type="text" class="form-control" name="meta_title"
                                    value="{{ $exhibition->meta_title ?? '' }}"
                                    placeholder="Enter exhibition meta title">
                                <!--<span class="text-danger error-text meta_title_error"></span>-->
                            </div>

                            <div class="form-group col-md-4">
                                <label>Meta Description</label>
                                <textarea class="ckeditor" name="meta_description" placeholder="Enter exhibition meta description">{{ $exhibition->meta_description ?? '' }}</textarea>
                                <!--<span class="text-danger error-text meta_description_error"></span>-->
                            </div>
                        </div>
                        @if (isset($exhibition))
                            <div class="form-group col-md-4">
                                <label>Exhibition Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-select">
                                    <option value="Active" {{ $exhibition->status == 'Active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="Inactive" {{ $exhibition->status == 'Inactive' ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>
                                <span class="text-danger error-text status_error"></span>
                            </div>
                        @endif

                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-primary me-2" id="submitBtn">
                                <span id="submitText">{{ $exhibition ? 'Update' : 'Submit' }}</span>
                                <span id="submitLoader" class="spinner-border spinner-border-sm d-none"
                                    role="status"></span>
                            </button>
                            @if (!isset($exhibition))
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
        document.addEventListener("DOMContentLoaded", function() {
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
            $('input[name="exhibition_name"]').on('input', function() {
                let exhibitionName = $(this).val();
                let slug = exhibitionName
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .trim()
                    .replace(/\s+/g, '-');

                $('input[name="slug"]').val(slug);
            });
            $('#addMoreBtn').on('click', function() {
                let count = $('#imageRepeater .repeater-item').length;
                let clone = $('#imageRepeater .repeater-item:last').clone();

                clone.attr('data-index', count);
                clone.find('input[type="file"]').attr('name', 'exhibition_images[' + count + ']');
                clone.find('input[type="file"]').val('');
                clone.find('img').remove();
                clone.find('.error-text')
                    .attr('class', 'text-danger error-text exhibition_images_' + count + '_error')
                    .text('');
                clone.find('.btn-remove').removeClass('d-none');

                $('#imageRepeater').append(clone);
            });

            $(document).on('click', '.btn-remove', function() {
                $(this).closest('.repeater-item').remove();
            });
            $('#exhibitionForm').on('submit', function(e) {
                e.preventDefault();
                $('#cancelBtn').on('click', function() {
                    $('#exhibitionForm')[0].reset();
                    $('.error-text').text('');
                    CKEditorHelper.clearAll();
                });
                let form = this;
                let formData = new FormData(form);
                let url = $(this).data('action');

                $('#submitBtn').prop('disabled', true);
                $('#submitLoader').removeClass('d-none');
                $('#submitText').text('Submitting...');

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        $('#submitText').text('Submit');
                        $('#submitLoader').addClass('d-none');
                        $('#submitBtn').prop('disabled', false);
                        toastr.success(res.success);
                        setTimeout(() => {
                            window.location.href =
                                "{{ route('admin.exhibition.list') }}";
                        }, 2000);
                    },
                    error: function(xhr) {
                        $('#submitText').text('Submit');
                        $('#submitLoader').addClass('d-none');
                        $('#submitBtn').prop('disabled', false);

                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function(key, val) {
                                $('.' + key + '_error').text(val[0]);
                            });
                        } else {
                            toastr.error('Something went wrong!');
                        }
                    }
                });
            });

            $('#cancelBtn').on('click', function() {
                $('#exhibitionForm')[0].reset();
                $('.error-text').text('');
            });
        });
    </script>
@endsection
