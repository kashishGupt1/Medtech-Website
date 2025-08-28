 <footer class="footer-style1 overflow-hidden position-relative">
     <div class="container">
         <div class="row">
             <div class="col-sm-6 col-lg-3 wow fadeIn" data-wow-delay="200ms">
                 <div class="footer-top">
                     <img src="{{ $user->company_logo ? asset('storage/' . $user->company_footer_logo) : asset('assets/img/logos/logo.png') }}"
                         height="30" alt="MedTech">
                     <br>
                     <ul class="social-icon-style1 mt-3 mb-0 d-inline-block list-unstyled">
                         <li class="d-inline-block me-2"><a href="{{ $user->facebook_link ?? '#' }}" target="_blank"><i
                                     class="fab fa-facebook-f"></i></a></li>
                         <li class="d-inline-block me-2"><a href="{{ $user->twitter_link ?? '#' }}" target="_blank"><i
                                     class="fab fa-instagram"></i></a></li>
                         <li class="d-inline-block me-2"><a href="{{ $user->youtube_link ?? '#' }}" target="_blank"><i
                                     class="fab fa-youtube"></i></a></li>
                         <li class="d-inline-block"><a href="{{ $user->linkedin_link ?? '#' }}" target="_blank"><i
                                     class="fab fa-linkedin-in"></i></a></li>
                     </ul>
                 </div>
             </div>
             <div class="col-sm-6 col-lg-3  wow fadeIn" data-wow-delay="350ms">
                 <div class="footer-top">
                     <h3 class="h5 mb-1-9">Product Range</h3>
                     <ul class="footer-list ps-0">
                         @foreach ($footerMenuCategories as $cat)
                             <li>
                                 <a href="{{ url('/' . $cat->slug) }}"><i class="fa fa-arrow-up-right-from-square me-1"></i> {{ $cat->category_name }}</a>
                             </li>
                         @endforeach
                     </ul>
                 </div>
             </div>
             <div class="col-sm-6 col-lg-3  wow fadeIn" data-wow-delay="350ms">
                 <div class="footer-top">
                     <h3 class="h5 mb-1-9">Quick Links</h3>
                     <ul class="footer-list ps-0">
                         <li>
                             <a href="{{ url('/') }}"><i class="fa fa-arrow-up-right-from-square me-1"></i> Home</a>
                         </li>
                         <li>
                             <a href="{{ url('/about-us') }}"><i class="fa fa-arrow-up-right-from-square me-1"></i> About</a>
                         </li>
                         <li>
                             <a href="{{ $broucher && $broucher->broucher_pdf ? asset('storage/' . $broucher->broucher_pdf) : '#' }}"
                                 target="{{ $broucher && $broucher->broucher_pdf ? '_blank' : '_self' }}"><i
                                     class="fa fa-arrow-up-right-from-square me-1"></i> Brochure</a>
                         </li>
                         <li>
                             <a href="{{ url('/exhibitions') }}"><i class="fa fa-arrow-up-right-from-square me-1"></i>Exhibitions</a>
                         </li>
                         <li>
                             <a href="{{ url('/blog') }}"><i class="fa fa-arrow-up-right-from-square me-1"></i> Blog</a>
                         </li>
                         <li>
                             <a href="{{ url('/contact-us') }}"><i class="fa fa-arrow-up-right-from-square me-1"></i> Contact Us</a>
                         </li>
                     </ul>
                 </div>
             </div>
             <div class="col-md-6 col-lg-3  wow fadeIn" data-wow-delay="350ms">
                 <div class="footer-top">
                     <h3 class="h5 mb-1-9">Contact Us</h3>
                     <ul class="list-unstyled list-style6 mb-0">
                         <li><span><i class="fa fa-location-dot"></i> </span> {{ $user->address }} </li>
                         <li><span><i class="fa fa-phone"></i> </span>{{ $user->contact_no1 }}</li>
                         <li><span><i class="fa fa-envelope"></i> </span> {{ $user->email }}</li>
                     </ul>
                 </div>
             </div>
         </div>
     </div>
     <div class="footer-bar">
         <div class="container">
             <div class="row">
                 <div class="col-lg-12 text-center">
                     <!--&copy;-->
                     <p>July <span class="current-year"></span>
                         <a href="#!" class="text-primary text-white-hover">{{ $user->name ?? '#' }}</a> All
                         rights reserved.
                     </p>
                     <p>{{ $user->name ?? '#' }} and the {{ $user->name ?? '#' }} logo are treadmarks of
                         {{ $user->name ?? '#' }} or its affiliates.</p>
                 </div>
             </div>
         </div>
     </div>
 </footer>

 <div class="modal fade" id="homePopup" tabindex="-1" aria-labelledby="popupLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content text-center p-4">
             <div class="modal-header border-0">
                 <h5 class="modal-title w-100" id="popupLabel">Welcome to MedTech</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <p>Check out our latest products, certifications, and more.</p>

             </div>
         </div>
     </div>
 </div>


 <div class="side-pop" data-bs-toggle="modal" data-bs-target="#exampleFullScreenModal">
     <div class="main-side-pop">
         <ul>
             <li>
                 <button class="main-side" id="myBtn"> <span>Quick Product Finder</span> <i class="fa fa-search"
                         aria-hidden="true"></i></button>
             </li>
         </ul>
     </div>
 </div>
 <div class="modal fade" id="exampleFullScreenModal" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body container mt-5">
                 <div class="tabs row">
                     <div class="col-md-3">
                         <ul class="nav nav-tabs nav-primary d-block border-0" role="tablist">
                             @foreach ($finderCategories as $index => $category)
                                 <li class="nav-item" role="presentation">
                                     <a class="nav-link {{ $index == 0 ? 'active' : '' }}" data-bs-toggle="tab"
                                         href="#category-{{ $category->id }}" role="tab" aria-selected="true">
                                         <div class="tab-title">{{ $category->category_name }}</div>
                                     </a>
                                 </li>
                             @endforeach
                         </ul>
                     </div>

                     <div class="tab-content col-md-9">
                         @foreach ($finderCategories as $category)
                             <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}"
                                 id="category-{{ $category->id }}">
                                 <div class="row">
                                     @forelse ($category->products as $product)
                                         @php
                                             $canLink = filled($category->slug) && filled($product->slug);
                                             $url = $canLink
                                                 ? route('product.details', [
                                                     'categorySlug' => $category->slug,
                                                     'productSlug' => $product->slug,
                                                 ])
                                                 : '#';
                                         @endphp

                                         <div class="col-md-4 smart-search">
                                             <a href="{{ $url }}">{{ $product->product_name }}</a>
                                         </div>
                                     @empty
                                         <div class="col-12">
                                             <p class="text-muted">No products found</p>
                                         </div>
                                     @endforelse
                                 </div>
                             </div>
                         @endforeach
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 <script>
     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });

     $(document).ready(function() {
         $('.newsletter-form').on('submit', function(e) {
             e.preventDefault();

             let form = this;
             let formData = new FormData(form);

             $.ajax({
                 url: "{{ route('newsletter.add') }}",
                 method: "POST",
                 data: formData,
                 processData: false,
                 contentType: false,

                 beforeSend: function() {
                     $('.error-text').text('');
                 },

                 success: function(res) {
                     toastr.success(res.success);
                     setTimeout(() => {
                         location.reload();
                     }, 2000);
                 },

                 error: function(xhr) {
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
