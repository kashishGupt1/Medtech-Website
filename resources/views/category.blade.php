 @extends('layouts.layout') @section('content')
     <section class="page-title-section top-position1 bg-img cover-background left-overlay-dark" data-overlay-dark="6"
         data-background="{{ $currentCategory && $currentCategory->breadcrumb_image ? asset('storage/' . $currentCategory->breadcrumb_image) : asset('assets/img/banner/product-image.jpg') }}">
         <div class="container">
             <div class="page-title">
                 <div class="row">
                     <div class="col-md-12">
                         <h1>{{ $currentCategory->breadcrumb_name}}</h1>
                     </div>
                     <div class="col-md-12">
                     <ul class="ps-0">
                            <li><a href="{{ url('/') }}" class="text-white">Home</a></li>
                            <li class="text-white">{{ $currentCategory->breadcrumb_name }}</li>
                        </ul>
                         <ul class="ps-0">
                             <li class="text-white">{!! $currentCategory->breadcrumb_description !!}</li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </section>

     <section class="">
         <div class="container">
             <div class="row about-style2">
                 <div class="col-lg-12 text-center wow fadeIn" data-wow-delay="400ms">
                     <h2 class="mb-1-6">{{ $currentCategory->category_name }}</h2>
                     <div class="medtech-editor mb-1-9">{!! $currentCategory->short_description !!}</div>
                 </div>
                 <!-- <div class="col-lg-6 wow fadeIn" data-wow-delay="200ms">
                     <div class="position-relative">
                         <div class="text-end about-img1 position-relative image-hover text-center">
                             <img src="{{ $currentCategory && $currentCategory->category_image ? asset('storage/' . $currentCategory->category_image) : asset('assets/img/content/product.jpg') }}" class="rounded" alt="{{$currentCategory->category_name}}">
                         </div>
                     </div>
                 </div> -->
             </div>
         </div>
     </section>

     <section class="service-style01 mx-xl-4 rounded-lg bg-light">
         <div class="container">
             <div class="row g-xl-4 ">
                 <div class="col-lg-12 col-xxl-12 wow fadeIn" data-wow-delay="100ms">
                     <div class="section-title01 text-center">
                         <h2>Our {{ $currentCategory->category_name }} Product Range</h2>
                         <p class="mb-0">Comprehensive solutions designed for healthcare professionals to
                             deliver optimal patient care</p>
                     </div>
                 </div>
                 @foreach($products as $product)
                 @php
                   $hasSlug = filled($product->slug) && filled($currentCategory->slug);
                 @endphp
                 <div class="col-md-3 mt-4">
                     <div class="card card-style11 border-radius-5">
                         <img src="{{ $product->product_main_image ? asset('storage/' . $product->product_main_image) : asset('assets/img/service/service.jpg') }}" alt="{{ $product->product_name }}">
                         <div class="card-body">
                             <h3>
                              @if ($hasSlug)
                             <a href="{{ route('product.details', ['categorySlug' => $currentCategory->slug, 'productSlug' => $product->slug]) }}">{{ $product->product_name }}</a>
                             @else
                              <a href="#">
                              {{ $product->product_name }}
                              </a>
                              @endif
                             </h3>
                             <div class="medtech-editor mb-4 data">{!! Str::limit($product->product_description, 85) !!}</div>
                              @if ($hasSlug)
                             <a href="{{ route('product.details', ['categorySlug' => $currentCategory->slug, 'productSlug' => $product->slug]) }}" class="butn-style3 white sm"><span>Learn more <i
                                         class="ti-arrow-right ms-2 align-middle display-30"></i></span></a>
                                         @endif
                         </div>
                     </div>
                 </div>
                 @endforeach
             </div>
         </div>
     </section>

     <section class="service-style01 mx-xl-4 rounded-lg">
         <div class="container">
             <div class="row g-xl-4 ">
                 <div class="col-lg-12 col-xxl-12 wow fadeIn" data-wow-delay="100ms">
                     <div class="section-title01 text-center">
                         <h2>Explore Other Categories</h2>
                         <p class="mb-0">Discover our complete range of medical technology solutions</p>
                     </div>
                 </div>
                 <div class="col-lg-12">
                     <div class="tags text-center">
                         @foreach($activeCategories as $cat)
                         <a href="{{ url('/' . $cat->slug) }}">{{ $cat->category_name }}</a>
                          @endforeach
                     </div>
                 </div>
             </div>
         </div>
     </section>
 @endsection
