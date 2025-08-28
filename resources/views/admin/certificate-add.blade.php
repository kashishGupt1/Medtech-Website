@extends('admin.layouts.layout')

@section('title', 'Admin Dashboard | Medtech')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.certificate.list') }}">Certificate List</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ isset($certificate) ? 'Edit Certificate' : 'Add Certificate' }}
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="card">
                <div class="card-header py-3">
                    <h5 class="mb-0">{{ isset($certificate) ? 'Edit Certificate' : 'Add New Certificate' }}</h5>
                </div>
                <div class="card-body p-4">
                    <form id="certificateForm" enctype="multipart/form-data"
                        data-action="{{ isset($certificate) ? route('admin.certificate.update', $certificate->id) : route('admin.certificate.store') }}">
                        @csrf
                        @if (isset($certificate))
                            @method('PUT')
                        @endif

                        <div class="row g-3">
                            <div class="form-group col-md-6">
                                <label>Certificate Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="certificate_name"
                                    value="{{ $certificate->certificate_name ?? '' }}" placeholder="Enter certificate name">
                                <span class="text-danger error-text certificate_name_error"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Certificate Image <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="certificate_photo" accept="application/image/png,image/jpeg,image/jpg,image/webp">
                                 @if (isset($certificate) && $certificate->certificate_photo)
                                    <img src="{{ asset('storage/' . $certificate->certificate_photo) }}" width="80"
                                        class="mt-2">
                                @endif 
                                <span class="text-danger error-text certificate_photo_error"></span>
                            </div>

                            @if (isset($certificate))
                                <div class="form-group col-md-4">
                                    <label>Status</label>
                                    <select name="status" class="form-select">
                                        <option value="Active" {{ $certificate->status == 'Active' ? 'selected' : '' }}>
                                            Active</option>
                                        <option value="Inactive" {{ $certificate->status == 'Inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                    <span class="text-danger error-text status_error"></span>
                                </div>
                            @endif
                        </div>

                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-primary me-2" id="submitBtn">
                                <span id="submitText">Submit</span>
                                <span id="submitLoader" class="spinner-border spinner-border-sm d-none"
                                    role="status"></span>
                            </button>
                            @if (!isset($certificate))
                                <button type="reset" class="btn btn-light" id="cancelBtn">Cancel</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('#certificateForm').on('submit', function(e) {
                e.preventDefault();

                let form = $(this)[0];
                let formData = new FormData(form);
                let url = $(this).data('action');

                $('#submitBtn').prop('disabled', true);
                $('#submitLoader').removeClass('d-none');
                $('#submitText').text('Submitting...');
                $.ajax({
                    url: url,
                    type: 'POST',
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
                                "{{ route('admin.certificate.list') }}";
                        }, 3000);
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

                            toastr.warning('Something went wrong');
                        }
                    }
                });
            });
            $('#cancelBtn').on('click', function() {
                $('#certificateForm')[0].reset();
                $('.error-text').text('');
            });

        });
    </script>
@endsection
