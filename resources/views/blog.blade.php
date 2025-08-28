@extends('layouts.layout') @section('content')
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
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="border-bottom border-color-light-black g-0 d-md-flex align-items-center entry-footer float-start w-100">
                    <div class="tags flex-grow-1 mb-4 mb-md-0 pe-md-3 wow fadeIn" data-wow-delay="200ms">
                        <label class="h4">Latest Articles</label>
                    </div>
                    <div class="blog-share-icon wow fadeIn wow fadeIn" data-wow-delay="400ms">
                        <ul class="share-post m-0 p-0 d-inline-block">
                            <li>
                                 Showing {{ $blogs->firstItem() }} - {{ $blogs->lastItem() }} of {{ $blogs->total() }} articles
                                </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    @if (count($blogs))
                    @foreach($blogs as $blog)
                    <div class="col-md-6 col-lg-6 mt-1-9 wow fadeIn" data-wow-delay="200ms">
                        <article class="card card-style3 border-0">
                            <div class="card-image position-relative">
                                <img src="{{ asset('storage/' . $blog->blog_main_image) }}" class="card-img-top" alt="{{ $blog->blog_name }}">
                                <div class="blog-date position-absolute">
                                     <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}" class="card-label blog">Surgery</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="blog-heading mb-2">
                                    <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}">{{ $blog->blog_name }}</a>
                                </h3>
                                <div class="medtech-editor mb-2">{!! Str::limit($blog->blog_description, 100) !!}</div>
                            </div>
                            <div class="card-footer py-3 border-color-light-gray d-flex justify-content-between">
                                <a><i class="fa fa-calendar text-primary pe-2"></i>{{ \Carbon\Carbon::parse($blog->blog_date)->format('d-m-Y') }}</a>
                                <a href="{{ route('blog.details', ['slug' => $blog->slug]) }}"
                                    class="text-secondary text-primary-hover font-weight-600">Read more <i
                                        class="ti-arrow-right ms-2 align-middle display-30"></i></a>
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
            <div class="col-lg-4">
                <div class="blog sidebar ps-xl-4">
                    <!--<div class="widget mb-1-9 p-4 wow fadeIn" data-wow-delay="200ms">-->
                    <!--    <div class="input-group">-->
                    <!--        <input type="text" class="form-control search-input" placeholder="Search here...">-->
                    <!--        <div class="input-group-append">-->
                    <!--            <button class="butn border-0" type="button"><i-->
                    <!--                    class="fa fa-search"></i></button>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="widget mb-1-9 wow fadeIn" data-wow-delay="400ms">
                        <div class="widget-title">
                            <h3 class="mb-0 h6">Recent Posts</h3>
                        </div>
                        <div class="p-1-9">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection