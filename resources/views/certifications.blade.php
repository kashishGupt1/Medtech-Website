@extends('layouts.layout') @section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lightgallery-bundle.min.css" />
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

<section>
    <div class="container">
        <div class="row" id="lightgallery">
            @foreach($certificates as $certificate)
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="200ms">
                    <div class="team-style1">
                    <a
                        href="{{ $certificate->certificate_photo ? asset('storage/' . $certificate->certificate_photo) : asset('assets/img/service/service.jpg') }}"
                        class="gallery-item"
                        data-lg-size="1400-1400"
                    >
                        <img
                            src="{{ $certificate->certificate_photo ? asset('storage/' . $certificate->certificate_photo) : asset('assets/img/service/service.jpg') }}"
                            alt="{{ $certificate->certificate_name }}"
                            style="width: 100%; height: 500px; cursor: zoom-in;"
                        />
                    </a>
                    <div class="team-content text-center mt-2">
                        <p class="mb-1">{{ $certificate->certificate_name }}</p>
                    </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/lightgallery.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/zoom/lg-zoom.umd.min.js"></script>
         <script>
        lightGallery(document.getElementById('lightgallery'), {
            selector: '.gallery-item',
            plugins: [lgZoom],
            // zoom: true,
            // download: false,
            // fullscreen: true,
            // actualSize: true,
            // mousewheel: true,
            speed: 400
        });
    </script>
@endsection