@extends('layouts.layout') 
@section('content')
<section class="page-title-section top-position1 bg-img cover-background left-overlay-dark">
    <div class="container">
        <div class="page-title">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h1>Search Results for: {{ $searchTerm }}</h1>
                    <form class="search-form" action="#" method="GET" accept-charset="utf-8">
                        <div class="input-group align-items-center">
                            <input type="text" class="search-form_input form-control" name="s" autocomplete="off" value="{{ $searchTerm }}" placeholder="Search here..." style="height: 55px;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="service-style01 mx-xl-4 rounded-lg bg-light">
    <div class="container">
        <div class="row position-relative z-index-9 g-xl-4 mt-n5">
            <div class="col-lg-12 col-xxl-12 mt-4 wow fadeIn" data-wow-delay="100ms">
                <div class="section-title01 text-center">
                    <h2>Featured Products</h2>
                    <p class="mb-0">Explore our innovative product line designed to meet the highest standards in medical care.</p>
                </div>
            </div>

            @if($products->count() > 0)
                @foreach($products as $product)
                    <div class="col-md-3">
                        <div class="card card-style11 border-radius-5 border-0">
                            <img src="{{ $product->product_main_image ? asset('storage/' . $product->product_main_image) : asset('assets/img/service/service.jpg') }}" alt="{{ $product->product_name }}">
                            <div class="card-body">
                                <h3><a href="{{ url('/' . $product->category->slug . '/' . $product->slug) }}">{{ $product->product_name }}</a></h3>
                                <div class="medtech-editor mb-4">{{ Str::limit(strip_tags($product->product_description), 85) }}</div>
                                <a href="{{ url('/' . $product->category->slug . '/' . $product->slug) }}" class="butn-style3 white sm">
                                    <span>Learn more <i class="ti-arrow-right ms-2 align-middle display-30"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            @if($products->isEmpty() && $categories->isEmpty())
                <p class="text-center">No data found</p>
            @endif

        </div>
    </div>
</section>

<section class="service-style01 mx-xl-4 rounded-lg">
    <div class="container">
        <div class="row position-relative z-index-9 g-xl-4 mt-n5">
            <div class="col-lg-12 col-xxl-12 mt-4 wow fadeIn" data-wow-delay="100ms">
                <div class="section-title01 text-center">
                    <h2>Search Our Product Categories</h2>
                    <p class="mb-0">Explore our comprehensive range of medical technology solutions designed to meet diverse healthcare needs.</p>
                </div>
            </div>

            @if($categories->count() > 0)
                @foreach($categories as $category)
                    <div class="col-md-3">
                        <div class="card card-style14 border-radius-6 border-0">
                            <div class="card-body">
                                <div class="service-img text-center">
                                    <i class="fa fa-medkit"></i>
                                </div>
                                <a href="{{ url('/' . $category->slug) }}">{{ $category->category_name }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
@endsection
