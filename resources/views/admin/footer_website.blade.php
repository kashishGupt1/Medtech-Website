@extends('admin.layouts.layout')

@section('title', 'About Us | Medtech')

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
                        <li class="breadcrumb-item active" aria-current="page">Update About Us</li>
                    </ol>
                </nav>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-header py-3">
                    <h5 class="mb-0">Update About Us</h5>
                </div>
                <div class="card-body p-4">
                    <form class="ajax-form" id="blogForm" enctype="multipart/form-data" action="">
                        <!--@csrf-->
                        <div class="row g-3">
                            <div class="form-group col-md-12">
                                <label>Company Description <span class="text-danger">*</span></label>
                                <textarea class="ckeditor" name="we_description" placeholder="Enter description">{{ old('we_description', $blog->we_description ?? '') }}</textarea>
                                <span class="text-danger error-text we_description_error"></span>
                            </div>
                            <div class="form-group col-md-12">
                                <label>NewsLetter Description <span class="text-danger">*</span></label>
                                <textarea class="ckeditor" name="we_description" placeholder="Enter description">{{ old('we_description', $blog->we_description ?? '') }}</textarea>
                                <span class="text-danger error-text we_description_error"></span>
                            </div>
                        </div>
                        
                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-primary me-2" id="submitBtn">
                                <span id="submitText">Update</span>
                                <span id="submitLoader" class="spinner-border spinner-border-sm d-none"
                                    role="status"></span>
                            </button>
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


        document.addEventListener("DOMContentLoaded", () => {
            CKEditorHelper.init();
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
                CKEditorHelper.clearAll();
            });


            $(document).on('submit', '.ajax-form', function(e) {
                e.preventDefault();

                const $form = $(this);
                CKEditorHelper.updateAll();

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
