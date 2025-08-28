@extends('layouts.layout') @section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    <section class="page-title-section top-position1 bg-img cover-background left-overlay-dark" data-overlay-dark="6" data-background="{{ asset('storage/' . $breadcrumbImage) }}">
        <div class="container">
            <div class="page-title text-center">
                <div class="row">
                    <div class="col-md-12">
                        <h1>{{ $breadcrumbName }}</h1>
                    </div>
                    <div class="col-md-12">
                    <ul class="ps-0">
                        <li><a href="{{ url('/') }}" class="text-white">Home</a></li>
                        <li class="text-white">{{ $breadcrumbName }}</li>
                    </ul>
                        <ul class="ps-0">
                            <li class="text-white">{!! $breadcrumbDescription !!}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT FORM
                    ================================================== -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-6 mb-2-9 mb-lg-0">
                    <div class="pe-lg-3">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3508.324581010586!2d77.00074877615945!3d28.43963039281321!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d17c0c56a114f%3A0xffdc87e447b3445f!2sSBRG%20MedTech%20Private%20Limited!5e0!3m2!1sen!2sin!4v1751689153578!5m2!1sen!2sin"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <div class="card card-style4 mt-1-9">
                            <div class="card-body">
                                <h2 class="h3 mb-2">Contact Info</h2>
                                <p>Feel free to reach out to us via phone, email, or the contact form. We love
                                    hearing from our visitors and are always happy to assist you!</p>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 icon-box">
                                        <i class="ti-mobile text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <!--<h4 class="h5">Phone Number</h4>-->
                                        <span class="d-block">{{ $user->contact_no1 ?? '#' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 icon-box">
                                        <i class="ti-location-pin text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <!--<h4 class="h5">Location</h4>-->
                                        <span>{{ $user->address ?? '#' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 icon-box">
                                        <i class="ti-email text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <!--<h4 class="h5">Email Address</h4>-->
                                        <span class="d-block">{{ $user->email ?? '#' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-6">
                    <div class="ps-xl-3">
                        <h2 class="h3 mb-4">Let's Connect</h2>
                        <form class="quform" enctype="multipart/form-data">
                            @csrf
                            <div class="quform-elements">
                                <div class="row">
                                    <!-- Name -->
                                    <div class="col-md-12">
                                        <div class="quform-element form-group">
                                            <label for="name">Your Name <span class="text-danger">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" id="name" type="text" name="name"
                                                    placeholder="Your name here" />
                                                <span class="text-danger error-text name_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-12">
                                        <div class="quform-element form-group">
                                            <label for="email">Your Email  <span class="text-danger">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" id="email" type="text" name="email"
                                                    placeholder="Your email here" />
                                                <span class="text-danger error-text email_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-md-12">
                                        <div class="quform-element form-group">
                                            <label for="phone">Mobile No. <span class="text-danger">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" id="phone" type="text" name="phone"
                                                    placeholder="Your phone here" />
                                                <span class="text-danger error-text phone_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Product -->
                                    <div class="col-md-12">
                                        <div class="quform-element form-group">
                                            <label for="product_id">Select Product <span class="text-danger">*</span></label>
                                            <div class="quform-input">
                                                <select class="form-select" name="product_id" id="product_id">
                                                    <option value="">Please choose an option</option>
                                                    @foreach ($activeProducts as $product)
                                                        <option value="{{ $product->id }}">{{ $product->product_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger error-text product_id_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Country -->
                                    <div class="col-md-12">
                                        <div class="quform-element form-group">
                                            <label for="country">Country  <span class="text-danger">*</span></label>
                                            <div class="quform-input">
                                                <select class="form-select" name="country" id="country">
                                                    <option value="">Choose country</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country }}">{{ $country }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger error-text country_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Subject -->
                                    <div class="col-md-12">
                                        <div class="quform-element form-group">
                                            <label for="subject">Your Subject  <span class="text-danger">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" id="subject" type="text" name="subject"
                                                    placeholder="Your subject here" />
                                                <span class="text-danger error-text subject_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Message -->
                                    <div class="col-md-12">
                                        <div class="quform-element form-group">
                                            <label for="message">Message  <span class="text-danger">*</span></label>
                                            <div class="quform-input">
                                                <textarea class="form-control h-auto" id="message" name="message" rows="3"
                                                    placeholder="Tell us a few words"></textarea>
                                                <span class="text-danger error-text message_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Captcha <span class="text-danger">*</span></label>
                                            <div class="d-flex align-items-center">
                                                <span class="captcha-img">{!! captcha_img() !!}</span>
                                                <button type="button" class="btn btn-sm btn-secondary ms-2" id="reloadCaptcha">
                                                    ⟳
                                                </button>
                                            </div>
                                            <input type="text" name="captcha" class="form-control mt-2" placeholder="Enter captcha">
                                            <span class="text-danger error-text captcha_error"></span>
                                        </div>
                                    </div>


                                    <!-- Submit Button -->
                                    <div class="col-md-12">
                                        <div class="quform-submit-inner">
                                            <button
                                                class="butn border-0 w-100 d-flex justify-content-center align-items-center"
                                                type="submit" id="submitBtn">
                                                <span id="submitText">Send Message</span>
                                                <span id="submitLoader"
                                                    class="spinner-border spinner-border-sm text-light ms-2 d-none"
                                                    role="status"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#reloadCaptcha').click(function () {
            $.ajax({
                type: 'GET',
                url: '/reload-captcha',
                success: function (data) {
                    $(".captcha-img").html(data.captcha);
                }
            });
        });

        $(document).ready(function() {
            $('.quform').on('submit', function(e) {
                e.preventDefault();

                let form = this;
                let formData = new FormData(form);

                // Show loader
                $('#submitBtn').prop('disabled', true);
                $('#submitLoader').removeClass('d-none');
                $('#submitText').text('Submitting...');

                $.ajax({
                    url: "{{ route('contact.store') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    beforeSend: function() {
                        $('.error-text').text('');
                    },

                    success: function(res) {
                        toastr.success(res.success);

                        // Hide loader
                    $('#submitText').text('Send Message');
                    $('#submitLoader').addClass('d-none');
                    $('#submitBtn').prop('disabled', true);

                        setTimeout(() => {
                            location.reload();
                        }, 3000);
                    },

                    error: function(xhr) {
                        // Hide loader
                    $('#submitText').text('Send Message');
                    $('#submitLoader').addClass('d-none');
                    $('#submitBtn').prop('disabled', false);

                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function(key, val) {
                                $('.' + key + '_error').text(val[0]);
                            });
                        } else {
                            toastr.error("Something went wrong!");
                        }
                    }
                });
            });
        });
    </script>
@endsection
