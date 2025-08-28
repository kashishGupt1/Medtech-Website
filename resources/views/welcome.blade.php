@extends('layouts.layout') @section('content')
    <div class="desktop">
        <div class="slider-fade3 owl-carousel owl-theme">
            @foreach ($banners as $banner)
                <div class="item bg-img cover-background left-overlay-dark">
                    <img src="{{ asset('storage/' . $banner->desktop_banner_photo) }}">
                </div>
            @endforeach
        </div>
    </div>

    <div class="mobile">
        <div class="slider-fade3 owl-carousel owl-theme">
            @foreach ($banners as $banner)
                <div class="item bg-img cover-background left-overlay-dark">
                    <img src="{{ asset('storage/' . $banner->mobile_banner_photo) }}">
                </div>
            @endforeach
        </div>
    </div>

    <section class="service-style01 mx-4 rounded-lg bg-light">
        <div class="container">
            <div class="row g-xl-4">
                <div class="col-lg-12 col-xxl-12 wow fadeIn" data-wow-delay="100ms">
                    <div class="section-title01 text-center">
                        <h2>Our Product Categories</h2>
                        <p class="mb-0">Explore our comprehensive range of medical technology solutions
                            designed to meet diverse heathcare needs.</p>
                    </div>
                </div>
                @foreach ($categories as $category)
                    @php

                        $icons = [
                            'infusion-therepy' => asset('assets/img/infusion-therapy.png'),
                            'vascular-access' => asset('assets/img/vascular-access.png'),
                            'transfusion-system' => asset('assets/img/transfusion-system.png'),
                            'anaesthesia-respiratory-care' => asset('assets/img/anaesthesia-and-respiratory-care.png'),
                            'urology' => asset('assets/img/urology.png'),
                            'gastroenterology' => asset('assets/img/gastroenterology.png'),
                            'surgery-and-wound-drainage' => asset('assets/img/surgery-and-wound-drainage.png'),
                            'others' => asset('assets/img/others.png'),
                        ];
                        $candidates = array_filter([
                            $category->slug ?? null,
                            \Illuminate\Support\Str::slug($category->category_name),
                            strtolower(trim($category->category_name)),
                        ]);
                        $iconSrc = null;
                        foreach ($candidates as $key) {
                            if (isset($icons[$key])) {
                                $iconSrc = $icons[$key];
                                break;
                            }
                        }
                        $iconSrc = $iconSrc ?? asset('assets/img/others.png');
                    @endphp

                    <div class="col-md-3">
                        <a href="{{ url('/' . $category->slug) }}">
                            <div class="card card-style14 border-radius-6 border-0">
                                <div class="card-body">
                                    <div class="service-img text-center">
                                        <img src="{{ $iconSrc }}" alt="{{ $category->category_name }}"
                                            style="height:40px;">
                                    </div>
                                    <a href="{{ url('/' . $category->slug) }}">{{ $category->category_name }}</a>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <section class="overflow-visible">
        <div class="container">
            <div class="row g-xl-4">
                <div class="col-lg-12 col-xxl-12">
                    <div class="section-title01 text-center">
                        <h2>Our Featured Products</h2>
                        <p class="mb-0">Explore our innovative product line designed to meet the highest standards
                            in medical care.</p>
                    </div>
                </div>
            </div>
            <div class="services-carousel-four owl-carousel owl-theme">
                @foreach ($products as $product)
                    @php
                        $canLink = $product->category && filled($product->category->slug) && filled($product->slug);
                        $url = $canLink
                            ? route('product.details', [
                                'categorySlug' => $product->category->slug,
                                'productSlug' => $product->slug,
                            ])
                            : '#';
                    @endphp
                    <div class="card card-style11 border-radius-5 border-1 mt-4">
                        @if (!empty($product->product_main_image) && file_exists(public_path('storage/' . $product->product_main_image)))
                            <img src="{{ asset('storage/' . $product->product_main_image) }}"
                                alt="{{ $product->product_name }}">
                        @else
                            <img src="{{ asset('assets/img/service/service.jpg') }}" alt="Default Image">
                        @endif

                        <div class="card-body">
                            <h3><a href="{{ $url }}"> {{ $product->product_name }}</a>
                            </h3>
                            <div class="medtech-editor mb-4 data">{!! Str::limit($product->product_description, 85) !!}</div>
                            <a href="{{ $url }}" class="butn-style3 white sm"><span>Learn
                                    more <i class="ti-arrow-right ms-2 align-middle display-30"></i></span></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <section class="service-style01 mx-xl-4 rounded-lg bg-light">
        <div class="container">
            <div class="row g-xl-4">
                <div class="col-lg-12 col-xxl-12 wow fadeIn" data-wow-delay="100ms">
                    <div class="section-title01 text-center">
                        <h2>Our Global Footprint</h2>
                        <p class="mb-0">Explore our comprehensive range of medical technology solutions
                            designed to meet diverse heathcare needs.</p>
                    </div>
                </div>
                <div class="col-md-12 image-hover text-center">
                    <div class="desktop">
                        <video autoplay muted loop playsinline width="100%">
                            <source src="{{ asset('storage/' . $user->company_video) }}" type="video/mp4">
                        </video>
                    </div>
                    <div class="mobile">
                        <video autoplay muted loop playsinline width="100%">
                            <source src="{{ asset('storage/' . $user->mobile_company_video) }}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
