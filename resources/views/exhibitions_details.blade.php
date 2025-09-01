 @extends('layouts.layout') @section('content')
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lightgallery.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lg-zoom.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/justifiedGallery@3.8.1/dist/css/justifiedGallery.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lg-thumbnail.css">
     <style>
         .lg-fullscreen:after {
             content: "\e20c";
         }

         .lg-backdrop,
         .lg-outer,
         .lg {
             z-index: 99999999 !important;
             position: fixed;
             top: 0;
             left: 0;
             width: 100%;
             height: 100%;
         }
     </style>
     <section class="page-title-section top-position1 bg-img cover-background left-overlay-dark" data-overlay-dark="6">
         <div class="container">
             <div class="page-title text-center">
                 <div class="row">
                     <div class="col-md-12">
                         <h1>{{ $exhibition->exhibition_name }}</h1>
                     </div>
                     <div class="col-md-12">
                         <ul class="ps-0">
                             <li><a href="{{ url('/') }}" class="text-white">Home</a></li>
                             <li><a href="{{ url('/exhibitions') }}" class="text-white">Exhibition List</a></li>
                             <li class="text-white">{{ $exhibition->exhibition_name }}</li>
                         </ul>
                         <ul class="ps-0">
                             <li class="text-white">{!! $exhibition->breadcrumb_description !!}</li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <section>
         <div class="container">
             <div class="row">
                 <div class="col-lg-12">
                     <article class="card card-style3 border-0 h-100">
                         <div class="card-body p-1-9 position-relative">
                             <h3 class="mb-4">{{ $exhibition->exhibition_name }}</h3>
                             <ul class="mb-2 p-0">
                                 <li class="display-30 d-inline-block text-capitalize me-3"><i
                                         class="fa fa-calendar text-primary pe-2"></i>{{ \Carbon\Carbon::parse($exhibition->exhibition_start_date)->format('d-m-Y') }}
                                     -
                                     {{ \Carbon\Carbon::parse($exhibition->exhibition_end_date)->format('d-m-Y') }}</li>
                                 <li class="display-30 d-inline-block"><i
                                         class="fa fa-location-dot text-primary pe-2"></i>{{ $exhibition->exhibition_location }}
                                 </li>
                             </ul>
                             <div class="medtech-editor mb-2">{!! $exhibition->exhibition_description !!}</div>
                             <div class="row mb-4">
                                 <div class="gallery-container" id="animated-thumbnails-gallery">
                                     @if ($exhibition->exhibition_images)
                                         @foreach (json_decode($exhibition->exhibition_images) as $image)
                                             <a class="gallery-item" data-src="{{ asset('storage/' . $image) }}">
                                                 <img class="img-responsive" src="{{ asset('storage/' . $image) }}"
                                                     alt="{{ $exhibition->exhibition_name }}" />
                                             </a>
                                         @endforeach
                                     @endif
                                 </div>
                             </div>
                         </div>
                     </article>
                 </div>
             </div>
         </div>
     </section>
     <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/justifiedGallery@3.8.1/dist/js/jquery.justifiedGallery.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/lightgallery.umd.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/plugins/zoom/lg-zoom.umd.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/plugins/thumbnail/lg-thumbnail.umd.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/plugins/fullscreen/lg-fullscreen.umd.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/plugins/download/lg-download.umd.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/plugins/share/lg-share.umd.js"></script>


     <script>
         jQuery("#animated-thumbnails-gallery")
             .justifiedGallery({
                 captions: false,
                 // lastRow: "hide",
                 rowHeight: 250,
                 margins: 10,
             })
             .on("jg.complete", function() {
                 window.lightGallery(
                     document.getElementById("animated-thumbnails-gallery"), {
                         autoplayFirstVideo: false,
                         pager: false,
                         galleryId: "nature",
                         plugins: [lgZoom, lgThumbnail, lgFullscreen],
                         mobileSettings: {
                             controls: false,
                             showCloseIcon: false,
                             download: false,
                             rotate: false,
                         },
                     }
                 );
             });
     </script>


 @endsection
