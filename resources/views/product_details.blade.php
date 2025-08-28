 @extends('layouts.layout') @section('content')
     <section class="page-title-section top-position1 bg-img cover-background left-overlay-dark" data-overlay-dark="6"
         style="padding: 30px 0;">
         <div class="container">
             <div class="page-title text-center">
                 <div class="row">
                     <div class="col-md-12">
                         <h1>{{ $product->breadcrumb_name }}</h1>
                         <ul class="ps-0">
                              <li><a href="{{ url('/') }}" class="text-white">Home</a></li>
                              @php $category = $product->category ?? null; @endphp
                                @if($category)                                   
                                    <li><a href="{{ url('/' . $category->slug) }}" class="text-white">{{ $category->category_name }}</a></li>
                                @else
                                    <li class="text-white">Category</li>
                                @endif
                              <li class="text-white">{{ $product->breadcrumb_name }}</li>
                          </ul>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <section>
         <div class="container">
             <div class="row align-items-center about-style2">
                 <div class="col-lg-5 wow fadeIn" data-wow-delay="200ms">
                     <div class="position-relative">
                         <div class="about-img1 text-center position-relative image-hover">
                             <img src="{{ $product->product_main_image ? asset('storage/' . $product->product_main_image) : asset('assets/img/service/service.jpg') }}"
                                 alt="{{ $product->product_name }}" class="rounded" alt="...">
                         </div>
                     </div>
                 </div>
                 <div class="col-lg-7 wow fadeIn" data-wow-delay="400ms">
                     <h2 class="mb-1-6">{{ $product->product_name }}</h2>
                     <p class="text-primary"><b>Sizes:</b> {{$product->product_size}}
                        
                     </p>
                     <div class="row">
                        <div class="medtech-editor">{!! $product->product_description !!}</div>
                         <!-- <div class="col-md-4 col-4 text-center">
                             <img src="{{ $product->product_image_1 ? asset('storage/' . $product->product_image_1) : 'https://lifesthtml.websitelayout.net/img/avatar/avatar-01.jpg' }}"
                                 alt="{{ $product->product_heading_1 }}" class="rounded-circle border"
                                 style="height: 100px; width: 100px">
                             <p class="text-secondary">{{ $product->product_heading_1 }}</p>
                         </div>
                         <div class="col-md-4 col-4 text-center">
                             <img src="{{ $product->product_image_2 ? asset('storage/' . $product->product_image_2) : 'https://lifesthtml.websitelayout.net/img/avatar/avatar-01.jpg' }}"
                                 class="rounded-circle border" alt="{{ $product->product_heading_2 }}"
                                 style="height: 100px; width: 100px">
                             <p class="text-secondary">{{ $product->product_heading_2 }}</p>
                         </div>
                         <div class="col-md-4 col-4 text-center">
                             <img src="{{ $product->product_image_3 ? asset('storage/' . $product->product_image_3) : 'https://lifesthtml.websitelayout.net/img/avatar/avatar-01.jpg' }}"
                                 class="rounded-circle border" alt="{{ $product->product_heading_3 }}"
                                 style="height: 100px; width: 100px">
                             <p class="text-secondary">{{ $product->product_heading_3 }}</p>
                         </div> -->
                     </div>
                     <a href="#" class="butn-style3 white" data-bs-toggle="modal" data-bs-target="#quoteModal"><span>Request a Quote <i class="ti-arrow-right ms-2 align-middle display-30"></i></span></a>
                     <div class="modal fade" id="quoteModal" tabindex="-1" aria-labelledby="quoteModalLabel"
                         aria-hidden="true">
                         <div class="modal-dialog modal-lg modal-dialog-centered">
                             <div class="modal-content">
                                 <form id="quoteForm">
                                     @csrf
                                     <input type="hidden" name="product_name" value="{{ $product->product_name }}">
                                     <div class="modal-header">
                                         <h5 class="modal-title" id="quoteModalLabel">{{ $product->product_name }}</h5>
                                         <button type="button" class="btn-close" data-bs-dismiss="modal"
                                             aria-label="Close"></button>
                                     </div>

                                     <div class="modal-body">
                                         <div id="successMessage" class="alert alert-success d-none"></div>

                                         <div class="row">
                                             @php

                                                 $roles = [
                                                     'Manufacture',
                                                     'Importer',
                                                     'Consultant',
                                                     'Wholesaler/ Distributor',
                                                     'Retailer',
                                                     'Doctor',
                                                     'Others',
                                                 ];
                                             @endphp

                                             <!-- Full Name -->
                                             <div class="col-md-6">
                                                 <div class="form-group">
                                                     <label>Full Name <span class="text-danger">*</span></label>
                                                     <input class="form-control" name="name" type="text"
                                                         placeholder="Enter your full name">
                                                     <span class="text-danger error-text name_error"></span>
                                                 </div>
                                             </div>

                                             <!-- Company Name -->
                                             <div class="col-md-6">
                                                 <div class="form-group">
                                                     <label>Company Name <span class="text-danger">*</span></label>
                                                     <input class="form-control" name="company_name" type="text"
                                                         placeholder="Company name">
                                                     <span class="text-danger error-text company_name_error"></span>
                                                 </div>
                                             </div>

                                             <!-- Email -->
                                             <div class="col-md-6">
                                                 <div class="form-group">
                                                     <label>Email Address <span class="text-danger">*</span></label>
                                                     <input class="form-control" name="email" type="text"
                                                         placeholder="your.email@company.com">
                                                     <span class="text-danger error-text email_error"></span>
                                                 </div>
                                             </div>

                                             <!-- Phone -->
                                             <div class="col-md-6">
                                                 <div class="form-group">
                                                     <label>Contact No. <span class="text-danger">*</span></label>
                                                     <input class="form-control" name="phone" type="text"
                                                         placeholder="+1 (555) 123-4567">
                                                     <span class="text-danger error-text phone_error"></span>
                                                 </div>
                                             </div>

                                             <!-- Country -->
                                             <div class="col-md-6">
                                                 <div class="form-group">
                                                     <label>Country <span class="text-danger">*</span></label>
                                                     <select class="form-select" name="country" id="country">
                                                         <option value="">Choose Country</option>
                                                         @foreach ($countries as $country)
                                                             <option value="{{ $country }}">{{ $country }}
                                                             </option>
                                                         @endforeach
                                                     </select>
                                                     <span class="text-danger error-text country_error"></span>
                                                 </div>
                                             </div>

                                             <!-- Designation -->
                                             <div class="col-md-6">
                                                 <div class="form-group">
                                                     <label>Designation <span class="text-danger">*</span></label>
                                                     <input class="form-control" name="designation" type="text"
                                                         placeholder="e.g., Procurement Manager">
                                                     <span class="text-danger error-text designation_error"></span>
                                                 </div>
                                             </div>
                                             <!-- Interested Product -->


                                             <!-- Role -->
                                             <div class="col-md-12">
                                                 <div class="form-group">
                                                     <label>You Are <span class="text-danger">*</span></label>
                                                     <select class="form-select" name="role">
                                                         <option value="">Select your role</option>
                                                         @foreach ($roles as $role)
                                                             <option value="{{ $role }}">{{ $role }}
                                                             </option>
                                                         @endforeach
                                                     </select>
                                                     <span class="text-danger error-text role_error"></span>
                                                 </div>
                                             </div>

                                             <!-- Message -->
                                             <div class="col-md-12">
                                                 <div class="form-group">
                                                     <label>Specific Requirements <span class="text-danger">*</span></label>
                                                     <textarea class="form-control" name="message" rows="3" placeholder="Tell us more..."></textarea>
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
                                                    ?
                                                </button>
                                            </div>
                                            <input type="text" name="captcha" class="form-control mt-2" placeholder="Enter captcha">
                                            <span class="text-danger error-text captcha_error"></span>
                                        </div>
                                    </div>
                                     </div>


                                     <div class="modal-footer">
                                         <button type="submit" class="btn btn-primary" id="submitBtn">
                                            <span id="submitText">Submit Request</span>
                                            <span id="submitLoader" class="spinner-border spinner-border-sm d-none"
                                                role="status"></span>
                                        </button>
                                                                            
                                     </div>
                                 </form>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>

     <!-- <section class="border-top">
         <div class="container">
             <div class="row about-style2">
                 <div class="col-lg-12 wow fadeIn" data-wow-delay="400ms">
                     <h2 class="mb-1-6 text-center">Product Description</h2>
                     <div class="medtech-editor">{!! $product->product_description !!}</div>
                 </div>
             </div>
         </div>
     </section> -->

     <section class="service-style01 mx-xl-4 rounded-lg bg-light">
         <div class="container">
             <div class="row position-relative g-xl-4">
                 <div class="col-lg-12 col-xxl-12 wow fadeIn" data-wow-delay="100ms">
                     <div class="section-title01 text-center">
                         <h2>Product Features</h2>
                     </div>
                 </div>
                 @foreach ($features as $feature)
                     <div class="col-md-4 mb-2 d-flex">
                         <div class="card card-style11 border-radius-5 border-0 w-100">
                             <div class="card-body d-flex align-items-baseline">
                                 <i class="fa fa-circle me-1 fs-12"></i>
                                 <p class="mb-0"> {{ $feature }}</p>
                             </div>
                         </div>
                     </div>
                 @endforeach
             </div>
         </div>
     </section>
     <section class="service-style01 mx-xl-4 rounded-lg bg-light pt-0">
         <div class="container">
             <div class="row position-relative g-xl-4">
                 <div class="col-lg-12 col-xxl-12 wow fadeIn" data-wow-delay="100ms">
                     <div class="section-title01 text-center">
                         <h2>Technical Specifications</h2>
                     </div>
                 </div>
                 <div class="medtech-editor">{!! $product->product_technical_specifications_information !!}</div>
             </div>
         </div>
     </section>

     <section class="service-style01 mx-xl-4 rounded-lg">
         <div class="container">
             <div class="row position-relative g-xl-4">
                 <div class="col-lg-12 col-xxl-12 wow fadeIn" data-wow-delay="100ms">
                     <div class="section-title01 text-center">
                         <h2>Related Products</h2>
                         <p class="mb-0">Complete your IV access solution with our complementary products</p>
                     </div>
                 </div>
                 @foreach ($relatedProducts as $related)
                     <div class="col-md-3">
                         <div class="card mt-3 card-style11 border-radius-5">
                             <img src="{{ $related->product_main_image ? asset('storage/' . $related->product_main_image) : asset('assets/img/service/service.jpg') }}"
                                 alt="{{ $related->product_name }}">
                             <div class="card-body">
                                 <h3><a
                                         href="{{ url('/' . $related->category->slug . '/' . $related->slug) }}">{{ $related->product_name }}</a>
                                 </h3>
                                 <div class="medtech-editormb-4">{!! Str::limit($related->product_description, 85) !!}</div>
                                 <a href="{{ url('/' . $related->category->slug . '/' . $related->slug) }}"
                                     class="butn-style3 white sm"><span>Learn more <i
                                             class="ti-arrow-right ms-2 align-middle display-30"></i></span></a>
                             </div>
                         </div>
                     </div>
                 @endforeach
             </div>
         </div>
     </section>

     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script>
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
             $('#quoteForm').on('submit', function(e) {
                 e.preventDefault();

                 $('.error-text').text('');
                 $('#successMessage').addClass('d-none').text('');
                 $('#submitBtn').prop('disabled', true);
                 $('#submitLoader').removeClass('d-none');
                 $('#submitText').text('Submitting...');

                 $.ajax({
                     type: "POST",
                     url: "{{ route('request.quote') }}",
                     data: $(this).serialize(),
                     success: function(response) {
                         $('#quoteForm')[0].reset();
                         $('#submitText').text('Submit Request');
                         $('#submitLoader').addClass('d-none');
                         $('#submitBtn').prop('disabled', false);
                         $('#successMessage').removeClass('d-none').text(response.success);
                       
                         setTimeout(function() {
                             window.location.href = "{{ route('request.quote.thank.you') }}"
                         }, 2000);
                        
                     },
                     error: function(xhr) {
                        $('#submitText').text('Submit Request');
                        $('#submitLoader').addClass('d-none');
                        $('#submitBtn').prop('disabled', false);
                         if (xhr.status === 422) {
                             $.each(xhr.responseJSON.errors, function(key, val) {
                                 $('.' + key + '_error').text(val[0]);
                             });
                         }
                     }
                 });
             });
         });
     </script>
 @endsection
