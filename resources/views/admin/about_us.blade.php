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
                    <form class="ajax-form" id="aboutForm" enctype="multipart/form-data"
                        action="{{ isset($about) ? route('admin.about.update', $about->id) : route('admin.about.store') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="form-group col-md-6">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title"
                                       value="{{ old('title', $about->title ?? '') }}" placeholder="Enter title">
                                <span class="text-danger error-text title_error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Main Image <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="main_image" accept="application/image/png,image/jpeg,image/jpg,image/webp">
                                @if (isset($about) && $about->main_image)
                                    <img src="{{ asset('storage/' . $about->main_image) }}" width="80">
                                @endif
                                <span class="text-danger error-text main_image_error"></span>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Description <span class="text-danger">*</span></label>
                                <textarea class="ckeditor" name="we_description">{{ old('we_description', $about->we_description ?? '') }}</textarea>
                                <span class="text-danger error-text we_description_error"></span>
                            </div>
                        </div>
    
                        <!-- Vision & Mission -->
                        <h5 class="card-title mt-3">Our Vision & Mission</h5>
                        <hr>
                        <div class="row g-3">
                            <div class="form-group col-md-6">
                                <label>Vision Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="v_title"
                                       value="{{ old('v_title', $about->v_title ?? '') }}" placeholder="Enter title">
                                <span class="text-danger error-text v_title_error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Vision Description <span class="text-danger">*</span></label>
                                <textarea class="ckeditor" name="v_description">{{ old('v_description', $about->v_description ?? '') }}</textarea>
                                <span class="text-danger error-text v_description_error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Mission Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="m_title"
                                       value="{{ old('m_title', $about->m_title ?? '') }}" placeholder="Enter title">
                                <span class="text-danger error-text m_title_error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Mission Description <span class="text-danger">*</span></label>
                                <textarea class="ckeditor" name="m_description">{{ old('m_description', $about->m_description ?? '') }}</textarea>
                                <span class="text-danger error-text m_description_error"></span>
                            </div>
                        </div>
    
                        <!-- Why Choose Section -->
                        <h5 class="card-title mt-3">Why Choose SBRG MedTech</h5>
                        <hr>
                         <div class="row g-3">
                            <div class="form-group col-md-3">
                                <label>Why Choose Title <span class="text-danger">*</span></label>
                                <input type="text" name="why_choose_title" class="form-control"
                                       value="{{ old('why_choose_title', $about->why_choose_title ?? '') }}" placeholder="Enter title">
                                <span class="text-danger error-text why_choose_title_error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Why Choose Description</label>
                                <textarea name="why_choose_description" class="form-control"
                                          placeholder="Enter description">{{ old('why_choose_description', $about->why_choose_description ?? '') }}</textarea>
                                <span class="text-danger error-text why_choose_description_error"></span>
                            </div>
                        </div>
                        @php
                            $whyChooseItems = $about->why_choose ?? [];
                            if (empty($whyChooseItems)) {
                                $whyChooseItems[] = ['title' => '', 'description' => ''];
                            }
                        @endphp
                        <div id="whyChooseWrapper" class="row g-3">
                            @foreach($whyChooseItems as $index => $item)
                                <div class="why-choose-item col-md-12 border p-3 rounded mb-3">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Title <span class="text-danger">*</span></label>
                                            <input type="text" name="why_choose[{{ $index }}][title]" class="form-control"
                                                   value="{{ $item['title'] ?? '' }}" placeholder="Enter title">
                                            <span class="text-danger error-text why_choose_{{ $index }}_title_error"></span>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Why Choose Image <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" name="why_choose[{{ $index }}][image]">
                                            @if(isset($item['image']))
                                                <img src="{{ asset('storage/' . $item['image']) }}" width="80" class="mt-2">
                                            @endif
                                            <span class="text-danger error-text why_choose_{{ $index }}_image_error"></span>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Description</label>
                                            <textarea name="why_choose[{{ $index }}][description]" class="form-control ckeditor"
                                                      placeholder="Enter description">{{ $item['description'] ?? '' }}</textarea>
                                            <span class="text-danger error-text why_choose_{{ $index }}_description_error"></span>
                                        </div>
                                    </div>
                                    @if ($index > 0)
                                        <button type="button" class="btn btn-danger mt-2 remove-why-choose">Remove</button>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-primary mt-2" id="addWhyChoose">Add More</button>
    
                        <!-- Breadcrumbs -->
                        <h5 class="card-title mt-3">Breadcrumbs Information</h5>
                        <hr>
                        <div class="row g-3">
                            <div class="form-group col-md-4">
                                <label>Breadcrumbs Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="breadcrumb_name"
                                       value="{{ old('breadcrumb_name', $about->breadcrumb_name ?? '') }}">
                                       <span class="text-danger error-text breadcrumb_name_error"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Breadcrumbs Description</label>
                                <textarea class="ckeditor" name="breadcrumb_description">{{ old('breadcrumb_description', $about->breadcrumb_description ?? '') }}</textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Breadcrumbs Image</label>
                                <input type="file" class="form-control" name="breadcrumb_photo" accept="application/image/png,image/jpeg,image/jpg,image/webp">
                                @if (isset($about) && $about->breadcrumb_photo)
                                    <img src="{{ asset('storage/' . $about->breadcrumb_photo) }}" width="80">
                                @endif
                            </div>
                        </div>
    
                        <!-- Meta -->
                        <h5 class="card-title mt-3">Meta Information</h5>
                        <hr>
                        <div class="row g-3">
                            <div class="form-group col-md-4">
                                <label>Meta Keyword</label>
                                <input type="text" class="form-control" name="meta_keyword"
                                       value="{{ old('meta_keyword', $about->meta_keyword ?? '') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Meta Title</label>
                                <input type="text" class="form-control" name="meta_title"
                                       value="{{ old('meta_title', $about->meta_title ?? '') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Meta Description</label>
                                <textarea class="ckeditor" name="meta_description">{{ old('meta_description', $about->meta_description ?? '') }}</textarea>
                            </div>
                        </div>
    
                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-primary me-2" id="submitBtn">
                                <span id="submitText">Update</span>
                                <span id="submitLoader" class="spinner-border spinner-border-sm d-none" role="status"></span>
                            </button>
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

    document.addEventListener("DOMContentLoaded", () => {
        
        let whyChooseIndex = {{ count($whyChooseItems) }};
        $('#addWhyChoose').on('click', function () {
            const html = `
                <div class="why-choose-item col-md-12 mb-3 border p-3 rounded">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Title <span class="text-danger">*</span></label>
                            <input type="text" name="why_choose[${whyChooseIndex}][title]" class="form-control" placeholder="Enter title">
                            <span class="text-danger error-text why_choose_${whyChooseIndex}_title_error"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="why_choose[${whyChooseIndex}][image]">
                            <span class="text-danger error-text why_choose_${whyChooseIndex}_image_error"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Description</label>
                            <textarea name="why_choose[${whyChooseIndex}][description]" class="form-control ckeditor" placeholder="Enter description"></textarea>
                            <span class="text-danger error-text why_choose_${whyChooseIndex}_description_error"></span>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger mt-2 remove-why-choose">Remove</button>
                </div>`;
            $('#whyChooseWrapper').append(html);
            whyChooseIndex++;
        });

        $(document).on('click', '.remove-why-choose', function () {
            $(this).closest('.why-choose-item').remove();
        });

        $(document).on('submit', '.ajax-form', function (e) {
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
                success: function (res) {
                    $('#submitText').text('Update');
                    $('#submitLoader').addClass('d-none');
                    $('#submitBtn').prop('disabled', false);
                    toastr.success(res.message);
                    setTimeout(() => location.reload(), 2000);
                },
                error: function (xhr) {
                    $('#submitText').text('Update');
                    $('#submitLoader').addClass('d-none');
                    $('#submitBtn').prop('disabled', false);

                    if (xhr.status === 422) {
                        $.each(xhr.responseJSON.errors, function (key, val) {
                            key = key.replace(/\./g, '_');
                            $form.find('.' + key + '_error').text(val[0]);
                        });
                    } else {
                        toastr.error('Something went wrong.');
                    }
                }
            });
        });
    });
</script>


    <!--end page wrapper -->
@endsection
