@extends('admin.layouts.layout')

@section('title', 'Admin Dashboard | Medtech')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Company Profile</li>
                    </ol>
                </nav>
            </div>
            <!--end breadcrumb-->
            <div class="row g-3">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                 @if (Auth::user()->company_logo)
                                <img src="{{ asset('storage/' . Auth::user()->company_logo) }}" alt="Admin"
                                    class="rounded-circle p-1" width="110">
                                    @endif
                                <div class="mt-3">
                                     @if (Auth::user()->name)
                                    <h4>{{ Auth::user()->name }}</h4>
                                    @endif
                                    <p class="text-secondary mb-1"> </p>
                                    <p class="text-muted font-size-sm">{{ Auth::user()->address }}</p>
                                    <button class="btn btn-primary mb-2">{{ Auth::user()->email }}</button><br>
                                     @if (Auth::user()->contact_no1)
                                    <button class="btn btn-outline-primary mb-2">{{ Auth::user()->contact_no1 }}</button><br>
                                    @endif
                                     @if (Auth::user()->contact_no2)
                                    <button class="btn btn-outline-primary mb-2">{{ Auth::user()->contact_no2 }}</button>
                                     @endif  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form id="companyProfileForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <!-- Company Name -->
                                    <div class="form-group col-md-6">
                                        <label>Company Name <span class="text-danger">*</span></label>
                                        <input type="text" name="company_name" class="form-control"
                                               value="{{ old('company_name', Auth::user()->name) }}">
                                        <span class="text-danger error-text company_name_error"></span>
                                    </div>
                                    <!-- Email -->
                                    <div class="form-group col-md-6">
                                        <label>Email ID <span class="text-danger">*</span></label>
                                        <input type="text" name="email" class="form-control"
                                               value="{{ old('email', Auth::user()->email) }}" readonly disabled>
                                        <span class="text-danger error-text email_error"></span>
                                    </div>

                                    <!-- Company Logo -->
                                    <div class="form-group col-md-6">
                                        <label>Company Logo <span class="text-danger">*</span></label>
                                        <input type="file" name="company_logo" class="form-control" >
                                        <span class="text-danger error-text company_logo_error"></span>
                                        @if (Auth::user()->company_logo)
                                        <img src="{{ asset('storage/' . Auth::user()->company_logo) }}" width="80">
                                       @endif 
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Website Footer Company Logo <span class="text-danger">*</span></label>
                                        <input type="file" name="company_footer_logo" class="form-control" >
                                        <span class="text-danger error-text company_footer_logo_error"></span>
                                        @if (Auth::user()->company_footer_logo)
                                        <img src="{{ asset('storage/' . Auth::user()->company_footer_logo) }}" width="80">
                                       @endif  
                                    </div>

                                    <!-- Address -->
                                    <div class="form-group col-md-6">
                                        <label>Address <span class="text-danger">*</span></label>
                                        <input type="text" name="address" class="form-control"
                                               value="{{ old('address', Auth::user()->address) }}">
                                        <span class="text-danger error-text address_error"></span>
                                    </div>

                                    <!-- Contact 1 -->
                                    <div class="form-group col-md-6">
                                        <label>Contact No 1 <span class="text-danger">*</span></label>
                                        <input type="text" name="contact_no1" class="form-control"
                                               value="{{ old('contact_no1', Auth::user()->contact_no1) }}">
                                        <span class="text-danger error-text contact_no1_error"></span>
                                    </div>

                                    <!-- Contact 2 -->
                                    <div class="form-group col-md-6">
                                        <label>Contact No 2</label>
                                        <input type="text" name="contact_no2" class="form-control"
                                               value="{{ old('contact_no2', Auth::user()->contact_no2) }}">
                                        <span class="text-danger error-text contact_no2_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label>Desktop Upload Video (maxSize: 50MB)</label>
                                        <input type="file" name="company_video" class="form-control" accept="video/*">
                                        <span class="text-danger error-text company_video_error"></span>
                                        @if(Auth::user()->company_video)
                                        <div class="form-group col-md-12 mt-3">
                                            <label>Preview Uploaded Video:</label><br>
                                            <video width="320" height="240" controls>
                                                  <source src="{{ asset('storage/' . Auth::user()->company_video) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Mobile Upload Video (maxSize: 50MB)</label>
                                        <input type="file" name="mobile_company_video" class="form-control" accept="video/*">
                                        <span class="text-danger error-text mobile_company_video_error"></span>
                                        @if(Auth::user()->mobile_company_video)
                                        <div class="form-group col-md-12 mt-3">
                                            <label>Preview Uploaded Video:</label><br>
                                            <video width="320" height="240" controls>
                                                  <source src="{{ asset('storage/' . Auth::user()->mobile_company_video) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <h5 class="card-title mt-3">Social Media Information</h5>
                                <hr>

                                <div class="row g-3">
                                    <!-- Facebook -->
                                    <div class="form-group col-md-6">
                                        <label>Facebook Link</label>
                                        <input type="text" name="facebook_link" class="form-control"
                                               value="{{ old('facebook_link', Auth::user()->facebook_link) }}">
                                        <!-- <span class="text-danger error-text facebook_link_error"></span>-->
                                    </div>

                                    <!-- Instagram -->
                                    <div class="form-group col-md-6">
                                        <label>Instagram Link</label>
                                        <input type="text" name="twitter_link" class="form-control"
                                               value="{{ old('twitter_link', Auth::user()->twitter_link) }}">
                                        <!-- <span class="text-danger error-text twitter_link_error"></span>-->
                                    </div>

                                    <!-- YouTube -->
                                    <div class="form-group col-md-6">
                                        <label>YouTube Link</label>
                                        <input type="text" name="youtube_link" class="form-control"
                                               value="{{ old('youtube_link', Auth::user()->youtube_link) }}">
                                        <!-- <span class="text-danger error-text youtube_link_error"></span>-->
                                    </div>

                                    <!-- LinkedIn -->
                                    <div class="form-group col-md-6">
                                        <label>LinkedIn Link</label>
                                        <input type="text" name="linkedin_link" class="form-control"
                                               value="{{ old('linkedin_link', Auth::user()->linkedin_link) }}">
                                        <!-- <span class="text-danger error-text linkedin_link_error"></span>-->
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-sm-12 text-end mt-3">
                                        <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                                           <span id="submitText">Save Changes</span>
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
        </div>
    </div>
    <script>
    $(document).ready(function () {
        $('#companyProfileForm').on('submit', function (e) {
            e.preventDefault();

            let form = this;
            let formData = new FormData(form);
                $('#submitBtn').prop('disabled', true);
                $('#submitLoader').removeClass('d-none');
                $('#submitText').text('Updating...');

            $.ajax({
                url: "{{ route('admin.profile.update') }}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,

                beforeSend: function () {
                    $('.error-text').text('');
                },

                success: function (res) {
                     $('#submitText').text('Save Changes');
                     $('#submitLoader').addClass('d-none');
                     $('#submitBtn').prop('disabled', false);
                    toastr.success(res.success);
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                },

                error: function (xhr) {
                     $('#submitText').text('Save Changes');
                     $('#submitLoader').addClass('d-none');
                     $('#submitBtn').prop('disabled', false);
                    if (xhr.status === 422) {
                        $.each(xhr.responseJSON.errors, function (key, val) {
                            $('.' + key + '_error').text(val[0]);
                        });
                    } else {
                        toastr.error('Something went wrong!');
                    }
                }
            });
        });
    });
</script>
@endsection
