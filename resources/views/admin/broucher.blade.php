@extends('admin.layouts.layout')

@section('title', 'Admin Dashboard | Medtech')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Brochure
                          
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="card">
                <div class="card-header py-3">
                    <h5 class="mb-0">Brochure</h5>
                </div>
                <div class="card-body p-4">
                    <form id="broucherForm" enctype="multipart/form-data" data-action="{{ isset($brouchers) ? route('admin.brouchers.update', $brouchers->id) : route('admin.brouchers.add') }}">
                        <div class="row">
                            @csrf
                            <div class="form-group col-md-6">
                                <label>Brochures PDF <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="broucher_pdf" accept="application/pdf">
                                <span class="text-danger error-text broucher_pdf_error"></span>
                            </div>
                            <div class="form-group col-md-6" style="margin-top: 10px">
                                @if(isset($brouchers) && $brouchers->broucher_pdf)
                                    <div class="mt-3">
                                        <a href="{{ asset('storage/' . $brouchers->broucher_pdf) }}" class="btn btn-primary" target="_blank">View Uploaded Brochure PDF</a>
                                    </div>
                                @endif
                            </div>
    
                            <div class="col-12 text-center mt-4">
                                <button type="submit" class="btn btn-primary me-2" id="submitBtn">
                                    <span id="submitText">{{ isset($brouchers) ? 'Update' : ' Submit' }}</span>
                                    <span id="submitLoader" class="spinner-border spinner-border-sm d-none" role="status"></span>
                                </button>
                                @if(!isset($brouchers))
                                <button type="reset" class="btn btn-light" id="cancelBtn">Cancel</button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
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
            $('#broucherForm').on('submit', function(e) {
                e.preventDefault();

                let form = $(this)[0];
                let formData = new FormData(form);
                let url = $(this).data('action');

            $('#submitBtn').prop('disabled', true);
            $('#submitLoader').removeClass('d-none');
            $('#submitText').text('Submitting...');
                $('.error-text').text('');

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

                        toastr.success(res.message);
                        setTimeout(() => {
                            window.location.reload();
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
                $('#broucherForm')[0].reset();
                $('.error-text').text('');
            });

        });
    </script>
@endsection
