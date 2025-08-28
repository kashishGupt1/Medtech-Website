@extends('layouts.layout') @section('content')
<section class="page-title-section top-position1 bg-img cover-background left-overlay-dark"
            data-overlay-dark="6" data-background="{{ asset('storage/' . $about->breadcrumb_photo) }}">
    <div class="container">
        <div class="page-title">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $about->breadcrumb_name }}</h1>
                </div>
                            
                <div class="col-md-12">
                    <ul class="ps-0">
                        <li><a href="{{ url('/') }}" class="text-white">Home</a></li>
                        <li class="text-white">{{ $about->breadcrumb_name }}</li>
                    </ul>
                    <ul class="ps-0">
                        <li class="text-white">{!! $about->breadcrumb_description !!}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row about-style2">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="400ms">
                <h2 class="mb-1-6">{{ $about->title }}</h2>
                <div class="medtech-editor">{!! $about->we_description !!}</div>
              
            </div>
            <div class="col-lg-6 mb-1-9 mb-lg-0 wow fadeIn" data-wow-delay="200ms">
                <div class="mb-md-2-9 position-relative">
                    <div class="text-end about-img1 position-relative image-hover">
                        <img src="{{ asset('storage/' . $about->main_image) }}" class="rounded" alt="{{ $about->title }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="service-style01 mx-xl-4 rounded-lg bg-light">
    <div class="container">
        <div class="row position-relative z-index-9 g-xl-4 ">
            <div class="col-lg-12 col-xxl-12 wow fadeIn" data-wow-delay="100ms">
                <div class="section-title01 text-center">
                    <h2>Our Vision & Mission</h2>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="card card-style14 border-radius-6 border-0">
                    <div class="card-body">
                        <div class="service-img text-center">
                            <!--<i class="fa fa-lightbulb"></i>-->
                            <img src="{{ asset('assets/img/vision.png') }}" alt="{{ $about->v_title }}">
                        </div>
                        <b>{{ $about->v_title }}</b>
                        <div class="medtech-editor mb-0">{!! $about->v_description !!}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="card card-style14 border-radius-6 border-0">
                    <div class="card-body">
                        <div class="service-img">
                            <!--<i class="fa fa-stethoscope"></i>-->                         
                            <img src="{{ asset('assets/img/Mission.png') }}" alt="{{ $about->m_title }}">
                        </div>
                        <b>{{ $about->m_title }}</b>
                        <div class="medtech-editor mb-0">{!! $about->m_description !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@php
    $whyChoose = $about->why_choose ?? [];
@endphp


<section class="service-style01 mx-xl-4 rounded-lg">
    <div class="container">
        <div class="row g-xl-4 ">
            <div class="col-lg-12 col-xxl-12 wow fadeIn" data-wow-delay="100ms">
                <div class="section-title01 text-center">
                    <h2>{{ $about->why_choose_title }}</h2>
                    <div class="medtech-editor mb-0">{!! $about->why_choose_description !!}</div>
                </div>
            </div>
             @if(count($whyChoose))
             @foreach($whyChoose as $item)
            <div class="col-md-4 col-6">
                <div class="card card-style14 border-radius-6 border-0">
                    <div class="card-body">
                        <div class="text-center">
                            <!--<i class="fa fa-shield"></i>-->
                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['title'] }}" style="width:150px; height: 150px" class="mb-3">
                        </div>
                        <b>{{ $item['title'] }}</b>
                        <!--<p class="mb-0">{!! $item['description'] !!}</p>-->
                    </div>
                </div>
            </div>
              @endforeach
              @endif
        </div>
    </div>
</section>
        
@endsection