 @extends('layouts.layout') @section('content')
     <section class="page-title-section top-position1 bg-img cover-background left-overlay-dark" data-overlay-dark="6"
         data-background="{{ asset('storage/' . $breadcrumbImage) }}">
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
     <section>
         <div class="container">
             <div class="row justify-content-center">
                 <div class="col-lg-12">
                     <div class="position-relative elements-block float-start w-100">
                         <div class="horizontaltab tab-style1 clearfix" style="display: block; width: 100%; margin: 0px;">
                             <ul class="resp-tabs-list hor_1">
                                 <li class="resp-tab-item hor_1 resp-tab-active" aria-controls="hor_1_tab_item-0"
                                     role="tab">Upcoming Events</li>
                                 <li class="resp-tab-item hor_1" aria-controls="hor_1_tab_item-1" role="tab">Present
                                     Events</li>
                                 <li class="resp-tab-item hor_1" aria-controls="hor_1_tab_item-2" role="tab">Past Events
                                 </li>
                             </ul>
                             <div class="resp-tabs-container hor_1 p-0">
                                 <div class="resp-tab-content hor_1 resp-tab-content-active"
                                     aria-labelledby="hor_1_tab_item-0" style="display:block">
                                     <div class="row">
                                         @if (count($upcoming))
                                             @foreach ($upcoming as $item)
                                                 <div class="col-md-6 col-lg-4 mt-1-9 wow fadeIn" data-wow-delay="200ms">
                                                     <article class="card card-style3 border-0">
                                                         <div class="card-image position-relative">
                                                             <img src="{{ asset('storage/' . $item->exhibition_photo) }}"
                                                                 class="card-img-top" alt="...">
                                                             <div class="blog-date position-absolute">
                                                                 <a href="{{ route('exhibitions.details', ['slug' => $item->slug]) }}"
                                                                     class="card-label upcoming">Upcoming Events</a>
                                                             </div>
                                                         </div>
                                                         <div class="card-body">
                                                             <h3 class="blog-heading mb-2"><a
                                                                     href="{{ route('exhibitions.details', ['slug' => $item->slug]) }}">{{ $item->exhibition_name }}</a>
                                                             </h3>
                                                             <ul class="mb-2 p-0">
                                                                 <li class="display-30">
                                                                     <i
                                                                         class="fa fa-calendar text-primary pe-2"></i>{{ \Carbon\Carbon::parse($item->exhibition_start_date)->format('d-m-Y') }}
                                                                     -
                                                                     {{ \Carbon\Carbon::parse($item->exhibition_end_date)->format('d-m-Y') }}
                                                                 </li>
                                                                 <li class="display-30">
                                                                     <i
                                                                         class="fa fa-location-dot text-primary pe-2"></i>{{ $item->exhibition_location }}
                                                                 </li>
                                                             </ul>
                                                             <div class="medtech-editor mb-2">{!! Str::limit($item->exhibition_description, 85) !!}</div>
                                                             <a href="javascript:void(0)"
                                                                 class="butn-style3 white sm openAppointmentModal"
                                                                 data-bs-toggle="modal" data-bs-target="#bookanappointment"
                                                                 data-exhibition="{{ $item->exhibition_name }}">
                                                                 <span>Book an Appointment</span>
                                                             </a>
                                                         </div>
                                                     </article>
                                                 </div>
                                             @endforeach
                                         @else
                                             <div class="col-12 text-center py-5">
                                                 <h5>No data found</h5>
                                             </div>
                                         @endif

                                     </div>
                                 </div>
                                 <div class="resp-tab-content hor_1" style="display: none;">
                                     <div class="row">
                                         @if (count($present))
                                             @foreach ($present as $item)
                                                 <div class="col-md-6 col-lg-4 mt-1-9 wow fadeIn" data-wow-delay="200ms">
                                                     <article class="card card-style3 border-0">
                                                         <div class="card-image position-relative">
                                                             <img src="{{ asset('storage/' . $item->exhibition_photo) }}"
                                                                 class="card-img-top" alt="Exhibition Photo">
                                                             <div class="blog-date position-absolute">
                                                                 <a href="{{ route('exhibitions.details', ['slug' => $item->slug]) }}"
                                                                     class="card-label present">Present</a>
                                                             </div>
                                                         </div>
                                                         <div class="card-body">
                                                             <h3 class="blog-heading mb-2"><a
                                                                     href="{{ route('exhibitions.details', ['slug' => $item->slug]) }}">{{ $item->exhibition_name }}</a>
                                                             </h3>
                                                             <ul class="mb-2 p-0">
                                                                 <li class="display-30">
                                                                     <i
                                                                         class="fa fa-calendar text-primary pe-2"></i>{{ \Carbon\Carbon::parse($item->exhibition_start_date)->format('d-m-Y') }}
                                                                     -
                                                                     {{ \Carbon\Carbon::parse($item->exhibition_end_date)->format('d-m-Y') }}
                                                                 </li>
                                                                 <li class="display-30">
                                                                     <i
                                                                         class="fa fa-location-dot text-primary pe-2"></i>{{ $item->exhibition_location }}
                                                                 </li>
                                                             </ul>
                                                             <div class="medtech-editor mb-2">{!! Str::limit($item->exhibition_description, 85) !!}</div>
                                                             <a href="javascript:void(0)"
                                                                 class="butn-style3 white sm openAppointmentModal"
                                                                 data-bs-toggle="modal" data-bs-target="#bookanappointment"
                                                                 data-exhibition="{{ $item->exhibition_name }}">
                                                                 <span>Book an Appointment</span>
                                                             </a>

                                                         </div>
                                                     </article>
                                                 </div>
                                             @endforeach
                                         @else
                                             <div class="col-12 text-center py-5">
                                                 <h5>No data found</h5>
                                             </div>
                                         @endif
                                     </div>
                                 </div>
                                 <div class="resp-tab-content hor_2" style="display: none;">
                                     <div class="row">
                                         @if (count($past))
                                             @foreach ($past as $item)
                                                 <div class="col-md-6 col-lg-4 mt-1-9 wow fadeIn" data-wow-delay="200ms">
                                                     <article class="card card-style3 border-0">
                                                         <div class="card-image position-relative">
                                                             <img src="{{ asset('storage/' . $item->exhibition_photo) }}"
                                                                 class="card-img-top" alt="...">
                                                             <div class="blog-date position-absolute">
                                                                 <a href="{{ route('exhibitions.details', ['slug' => $item->slug]) }}"
                                                                     class="card-label past">Past</a>
                                                             </div>
                                                         </div>
                                                         <div class="card-body">
                                                             <h3 class="blog-heading mb-2"><a
                                                                     href="{{ route('exhibitions.details', ['slug' => $item->slug]) }}">{{ $item->exhibition_name }}</a>
                                                             </h3>
                                                             <ul class="mb-2 p-0">
                                                                 <li class="display-30">
                                                                     <i
                                                                         class="fa fa-calendar text-primary pe-2"></i>{{ \Carbon\Carbon::parse($item->exhibition_start_date)->format('d-m-Y') }}
                                                                     -
                                                                     {{ \Carbon\Carbon::parse($item->exhibition_end_date)->format('d-m-Y') }}
                                                                 </li>
                                                                 <li class="display-30">
                                                                     <i
                                                                         class="fa fa-location-dot text-primary pe-2"></i>{{ $item->exhibition_location }}
                                                                 </li>
                                                             </ul>
                                                             <div class="medtech-editor mb-2">{!! Str::limit($item->exhibition_description, 85) !!}</div>
                                                             <a href="{{ route('exhibitions.details', ['slug' => $item->slug]) }}"
                                                                 class="butn-style3 white sm">
                                                                 <span>View Gallery</span>
                                                             </a>

                                                         </div>
                                                     </article>
                                                 </div>
                                             @endforeach
                                         @else
                                             <div class="col-12 text-center py-5">
                                                 <h5>No data found</h5>
                                             </div>
                                         @endif
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>


     <div class="modal fade" id="bookanappointment" tabindex="-1" aria-labelledby="bookanappointment"
         aria-hidden="true">
         <div class="modal-dialog modal-lg modal-dialog-centered">
             <div class="modal-content">
                 <form id="bookappointment">
                     @csrf
                     <input type="hidden" name="exhibition" id="modalExhibitionName">
                     <div class="modal-header">
                         <h5 class="modal-title" id="modalProductTitle">Book an Appointment</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>

                     <div class="modal-body">
                         <div id="successMessage" class="alert alert-success d-none"></div>

                         <div class="row">
                             @php

                                 $roles = [
                                     'Manufacturer',
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

                             <!-- Product -->
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>Select Product <span class="text-danger">*</span></label>
                                     <select class="form-select" name="role">
                                         <option value="">Select your product</option>
                                         @foreach ($roles as $role)
                                             <option value="{{ $role }}">{{ $role }}
                                             </option>
                                         @endforeach
                                     </select>
                                     <span class="text-danger error-text role_error"></span>
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
                                     <label>Subject <span class="text-danger">*</span></label>
                                     <input class="form-control" name="subject" type="text"
                                         placeholder="e.g., Procurement Manager">
                                     <span class="text-danger error-text subject_error"></span>
                                 </div>
                             </div>
                             <!-- Interested Product -->

                             <!-- Message -->
                             <div class="col-md-12">
                                 <div class="form-group">
                                     <label>Mesage <span class="text-danger">*</span></label>
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
                                 <input type="text" name="captcha" class="form-control mt-2"
                                     placeholder="Enter captcha">
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


     <script>
         document.addEventListener('DOMContentLoaded', function() {
             const tabs = document.querySelectorAll('.resp-tab-item');
             const contents = document.querySelectorAll('.resp-tab-content');

             tabs.forEach((tab, i) => {
                 tab.addEventListener('click', () => {
                     tabs.forEach(t => t.classList.remove('resp-tab-active'));
                     contents.forEach(c => c.style.display = 'none');

                     tab.classList.add('resp-tab-active');
                     contents[i].style.display = 'block';
                 });
             });
         });
     </script>

     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script>
         $('#reloadCaptcha').click(function() {
             $.ajax({
                 type: 'GET',
                 url: '/reload-captcha',
                 success: function(data) {
                     $(".captcha-img").html(data.captcha);
                 }
             });
         });
         document.querySelectorAll('.openAppointmentModal').forEach(button => {
             button.addEventListener('click', function() {
                 const exhibitionName = this.getAttribute('data-exhibition');

                 // Set hidden field
                 document.getElementById('modalExhibitionName').value = exhibitionName;

                 // Set modal title
                 document.getElementById('modalProductTitle').innerText = exhibitionName;
             });
         });
         $(document).ready(function() {
             $('#bookappointment').on('submit', function(e) {
                 e.preventDefault();

                 $('.error-text').text('');
                 $('#successMessage').addClass('d-none').text('');
                 $('#submitBtn').prop('disabled', true);
                 $('#submitLoader').removeClass('d-none');
                 $('#submitText').text('Submitting...');

                 $.ajax({
                     type: "POST",
                     url: "{{ route('book.exhibition.appointment') }}",
                     data: $(this).serialize(),
                     success: function(response) {
                         $('#bookappointment')[0].reset();
                         $('#submitText').text('Submit Request');
                         $('#submitLoader').addClass('d-none');
                         $('#submitBtn').prop('disabled', false);
                         $('#successMessage').removeClass('d-none').text(response.success);

                         setTimeout(function() {
                             window.location.reload();
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
