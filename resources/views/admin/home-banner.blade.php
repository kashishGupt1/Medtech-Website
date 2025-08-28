@extends('admin.layouts.layout')

@section('title', 'Admin Dashboard | Medtech')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Banner List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ isset($banner) ? 'Edit Banner' : 'Add New Banner' }}
                    </li>
                </ol>
            </nav>
        </div>

        <div class="card">
            <div class="card-header py-3">
                <h5 class="mb-0">{{ isset($banner) ? 'Edit Banner' : 'Add New Banner' }}</h5>
            </div>
            <div class="card-body p-4">
                <form id="bannerForm" enctype="multipart/form-data">
                    @csrf
                    @if(isset($banner))
                        <input type="hidden" name="id" value="{{ $banner->id }}">
                    @endif

                    <div class="row g-3">
                        <div class="form-group col-md-6">
                            <label>Desktop Banner Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="desktop_banner_photo" accept="application/image/png,image/jpeg,image/jpg,image/webp">
                            @if(isset($banner->desktop_banner_photo))
                                <img src="{{ asset('storage/' . $banner->desktop_banner_photo) }}" alt="Banner"
                                    style="width: 100%; margin-top: 10px;">
                            @endif
                            <span class="text-danger error-text desktop_banner_photo_error"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Mobile Banner Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="mobile_banner_photo" accept="application/image/png,image/jpeg,image/jpg,image/webp">
                            @if(isset($banner->mobile_banner_photo))
                                <img src="{{ asset('storage/' . $banner->mobile_banner_photo) }}" alt="Banner"
                                    style="width: 100%; margin-top: 10px;">
                            @endif
                            <span class="text-danger error-text mobile_banner_photo_error"></span>
                        </div>

                        @if(isset($banner))
                        <div class="form-group col-md-6">
                            <label>Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select">
                                <option value="Active" {{ (isset($banner) && $banner->status == 'Active') ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ (isset($banner) && $banner->status == 'Inactive') ? 'selected' : '' }}>Inactive</option>
                            </select>
                            <span class="text-danger error-text status_error"></span>
                        </div>
                         @endif
                    </div>

                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary me-2" id="submitBtn">
                            <span id="submitText">{{ isset($banner) ? 'Update' : 'Submit' }}</span>
                            <span id="submitLoader" class="spinner-border spinner-border-sm d-none" role="status"></span>
                        </button>
                        @if(!isset($banner))
                            <button type="reset" class="btn btn-light" id="cancelBtn">Cancel</button>
                         @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#bannerForm').on('submit', function(e) {
            e.preventDefault();

            let form = this;
            let formData = new FormData(form);

            let $submitBtn = $('#submitBtn');
            let $submitText = $('#submitText');
            let $submitLoader = $('#submitLoader');

            $('.error-text').text('');
            $submitBtn.prop('disabled', true);
            $submitText.text('{{ isset($banner) ? 'Updating...' : 'Submitting...' }}');
            $submitLoader.removeClass('d-none');

            $.ajax({
                url: "{{ isset($banner) ? route('admin.banner.update', $banner->id) : route('admin.banner.store') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,

                success: function(response) {
                    toastr.success(response.success);
                    setTimeout(function() {
                        window.location.href = "{{ route('admin.home.banner.list') }}";
                    }, 2000);
                },

                error: function(xhr) {
                    if (xhr.status === 422) {
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('.' + key + '_error').text(value[0]);
                        });
                    } else {
                        toastr.error('Something went wrong.');
                    }
                },

                complete: function() {
                    $submitBtn.prop('disabled', false);
                    $submitText.text('{{ isset($banner) ? 'Update' : 'Submit' }}');
                    $submitLoader.addClass('d-none');
                }
            });
        });
    });
</script>
@endsection
