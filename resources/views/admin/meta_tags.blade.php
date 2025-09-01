@extends('admin.layouts.layout')

@section('title', 'Meta Tags | Medtech')

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
                        <li class="breadcrumb-item active" aria-current="page">Meta Tags</li>
                    </ol>
                </nav>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-header py-3">
                    <h5 class="mb-0">Meta Tags</h5>
                </div>
                <div class="card-body p-4">
                    <form class="ajax-form" id="blogForm" enctype="multipart/form-data" action="">
                        @csrf
                        <div class="row g-3">
                            <div class="form-group col-md-12">
                                <label>Pages <span class="text-danger">*</span></label>
                                <select class="form-select" name="page">
                                    <option>Select page</option>
                                    <option>Homepage</option>
                                    <option>Certificate</option>
                                    <option>Contact us</option>
                                    <option>Blog</option>
                                    <option>Exhibition</option>
                                </select>
                                <span class="text-danger error-text title_error"></span>
                            </div>
                        </div>

                        <div id="metaTagFields" class="d-none mt-4">
                            <h5 class="card-title mt-3">Breadcrumbs Information</h5>
                            <hr>
                            <div class="row g-3">
                                <div class="form-group col-md-4">
                                    <label>Breadcrumbs Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="breadcrumb_name"
                                        placeholder="Enter meta breadcrumbs name">
                                    <span class="text-danger error-text breadcrumb_name_error"></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Breadcrumbs Description</label>
                                    <textarea class="ckeditor form-control" name="breadcrumb_description" placeholder="Enter breadcrumbs description"></textarea>
                                    <span class="text-danger error-text breadcrumb_description_error"></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Breadcrumbs Image </label>
                                    <input type="file" class="form-control" name="breadcrumb_image"
                                        accept="application/image/png,image/jpeg,image/jpg,image/webp">
                                    <img id="breadcrumbImagePreview" src="#" alt="Image Preview"
                                        class="img-fluid mt-2 d-none" width="150" height="150">
                                    <span class="text-danger error-text breadcrumb_image_error"></span>
                                </div>
                            </div>

                            <h5 class="card-title mt-3">Meta Information</h5>
                            <hr>
                            <div class="row g-3">
                                <div class="form-group col-md-4">
                                    <label>Meta Keyword</label>
                                    <input type="text" class="form-control" name="meta_keyword"
                                        placeholder="Enter meta keyword">
                                    <span class="text-danger error-text meta_keyword_error"></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Meta Title</label>
                                    <input type="text" class="form-control" name="meta_title"
                                        placeholder="Enter meta title">
                                    <span class="text-danger error-text meta_title_error"></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Meta Description</label>
                                    <textarea class="ckeditor form-control" name="meta_description" placeholder="Enter meta description"></textarea>
                                    <span class="text-danger error-text meta_description_error"></span>
                                </div>
                            </div>

                            <div class="col-12 text-center mt-4">
                                <button type="submit" class="btn btn-primary me-2" id="submitBtn">
                                    <span id="submitText">Update</span>
                                    <span id="submitLoader" class="spinner-border spinner-border-sm d-none"
                                        role="status"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <script>
        const CKEditorHelper = {
            instances: {},
            init() {
                document.querySelectorAll('textarea.ckeditor').forEach(textarea => {
                    ClassicEditor
                        .create(textarea)
                        .then(editor => {
                            this.instances[textarea.name] = editor;
                        })
                        .catch(error => {
                            console.error('CKEditor init failed for', textarea.name, error);
                        });
                });
            },
            updateAll() {
                for (let name in this.instances) {
                    if (this.instances[name]) {
                        const data = this.instances[name].getData();
                        document.querySelector(`textarea[name="${name}"]`).value = data;
                    }
                }
            }
        };

        $(document).ready(function() {
            CKEditorHelper.init();

            function previewBreadcrumbImage(event) {
                const file = event.target.files[0];
                const preview = document.getElementById('breadcrumbImagePreview');

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('d-none');
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.src = '#';
                    preview.classList.add('d-none');
                }
            }

            $('select[name="page"]').on('change', function() {
                let page = $(this).val();

                if (!page || page === 'Select page') {
                    $('#metaTagFields').addClass('d-none');
                    return;
                }

                $('#metaTagFields').removeClass('d-none');
                $('.error-text').text('');

                // 🔁 Hide Breadcrumbs Image if page is Homepage
                if (page === 'Homepage') {
                    $('input[name="breadcrumb_image"]').closest('.form-group').addClass('d-none');
                } else {
                    $('input[name="breadcrumb_image"]').closest('.form-group').removeClass('d-none');
                }

                $.ajax({
                    url: '{{ route('meta-tags.get') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        page: page
                    },
                    success: function(response) {
                        let data = response.data || {};

                        $('input[name="breadcrumb_name"]').val(data.breadcrumb_name || '');
                        $('textarea[name="breadcrumb_description"]').val(data
                            .breadcrumb_description || '');
                        $('input[name="meta_keyword"]').val(data.meta_keyword || '');
                        $('input[name="meta_title"]').val(data.meta_title || '');
                        $('textarea[name="meta_description"]').val(data.meta_description || '');

                        setTimeout(() => {
                            CKEditorHelper.instances['breadcrumb_description']?.setData(
                                data.breadcrumb_description || '');
                            CKEditorHelper.instances['meta_description']?.setData(data
                                .meta_description || '');
                        }, 500);


                        if (page !== 'Homepage' && data.breadcrumb_image) {
                            $('#breadcrumbImagePreview')
                                .attr('src', '/storage/' + data.breadcrumb_image)
                                .removeClass('d-none');
                        } else {
                            $('#breadcrumbImagePreview')
                                .attr('src', '#')
                                .addClass('d-none');
                        }
                    }
                });
            });


            $('.ajax-form').on('submit', function(e) {
                e.preventDefault();
                CKEditorHelper.updateAll();

                $('.error-text').text('');
                $('#submitText').text('Submitting...');
                $('#submitLoader').removeClass('d-none');

                let formData = new FormData(this);
                $.ajax({
                    url: '{{ route('meta-tags.save') }}',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        toastr.success(res.message);
                        setTimeout(() => {
                            location.reload();
                        }, 3000);
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, val) {
                                $(`.${key}_error`).text(val[0]);
                            });
                        } else {
                            toastr.error('Something went wrong.');
                        }
                    },
                    complete: function() {
                        $('#submitText').text('Update');
                        $('#submitLoader').addClass('d-none');
                    }
                });
            });
        });
    </script>



    <!--end page wrapper -->
@endsection
