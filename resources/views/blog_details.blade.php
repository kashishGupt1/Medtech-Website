@extends('layouts.layout') @section('content')
    <section class="page-title-section top-position1 bg-img cover-background left-overlay-dark" data-overlay-dark="6">
        <div class="container">
            <div class="page-title text-center">
                <div class="row">
                    <div class="col-md-12">
                        <h1>{{ $blog->breadcrumb_name }}</h1>
                    </div>
                    <div class="col-md-12">
                        <ul class="ps-0">
                            <li><a href="{{ url('/') }}" class="text-white">Home</a></li>
                            <li><a href="{{ url('/blog') }}" class="text-white">Blog List</a></li>
                            <li class="text-white">{{ $blog->breadcrumb_name }}</li>
                        </ul>
                        <ul class="ps-0">
                            <li class="text-white">{!! $blog->breadcrumb_description !!}</li>
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
                    <div class="row">
                        <div class="col-lg-12">
                            <article class="card card-style3 border-0 h-100">
                                <div class="card-body p-1-9 position-relative">
                                    <h3 class="mb-4">{{ $blog->blog_name }}</h3>
                                    <img src="{{ asset('storage/' . $blog->blog_main_image) }}"  alt="{{ $blog->blog_name }}" class="card-img-top mb-4">
                                    <div class="blog-date position-absolute">
                                        <span
                                            class="d-block text-white z-index-2 position-relative alt-font font-weight-700 display-26 display-sm-22 lh-1 mb-2">{{ \Carbon\Carbon::parse($blog->blog_date)->format('d') }}</span>
                                        <span
                                            class="d-block text-white z-index-2 position-relative alt-font text-uppercase small lh-1">{{ \Carbon\Carbon::parse($blog->blog_date)->format('M') }}</span>
                                        <span class="blog-shape"></span>
                                    </div>
                                    <ul class="mb-2 p-0">
                                        <li class="display-30 d-inline-block text-capitalize me-3"><a href="#!"><i
                                                    class="ti-user text-primary pe-2"></i>admin</a></li>
                                        <li class="display-30 d-inline-block"><i
                                                class="ti-comments text-primary pe-2"></i>13 Comments</li>
                                    </ul>
                                    <div class="medtech-editor">{!! $blog->blog_description !!}</div>

                                    <div class="row mb-4">
                                        @if ($blog->blog_images)
                                            @foreach (json_decode($blog->blog_images) as $img)
                                                <div class="col-6">
                                                    <div class="image-hover">
                                                        <img src="{{ asset('storage/' . $img) }}" class="card-img-top" alt="{{ $blog->blog_name }}" class="rounded" >
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>

                                </div>
                                <div
                                    class="border-top border-color-light-black p-1-9 g-0 d-md-flex align-items-center entry-footer float-start w-100">
                                    <div class="tags flex-grow-1 mb-4 mb-md-0 pe-md-3 wow fadeIn" data-wow-delay="200ms">
                                        <label class="h6 me-3 mb-0">Tags:</label>
                                        <a href="#!">business</a>
                                        <a href="#!">finance</a>
                                        <a href="#!">analysis</a>
                                    </div>
                                    <div class="blog-share-icon wow fadeIn wow fadeIn" data-wow-delay="400ms">
                                        <label class="h6 me-1 mb-0">Share:</label>
                                        <ul class="share-post m-0 p-0 d-inline-block">
                                            <li><a href="#!"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#!"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#!"><i class="fab fa-pinterest-p"></i></a></li>
                                            <li><a href="#!"><i class="fab fa-linkedin-in"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog sidebar ps-xl-4">

                        <div class="widget mb-1-9 wow fadeIn" data-wow-delay="400ms">
                            <div class="widget-title">
                                <h3 class="mb-0 h6">Recent Posts</h3>
                            </div>
                            <div class="p-1-9">
                                @foreach($recentBlogs as $recent)
                                <div class="d-flex mb-4">
                                    <div class="flex-shrink-0 image-hover">
                                        <img src="{{ asset('storage/' . $blog->blog_main_image) }}" class="card-img-top" alt="{{ $blog->blog_name }}" style="height:45px; width: 45px; border-radius:50px ;" class="rounded" alt="{{$blog->blog_name}}">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h4 class="h6"><a href="{{ route('blog.details', $recent->id) }}">{{ \Illuminate\Support\Str::limit($recent->blog_name, 40) }}</a></h4>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($recent->blog_date)->format('d-m-Y') }}</small>
                                    </div>
                                </div>
                                 @endforeach

                            </div>
                        </div>
                        <div class="widget wow fadeIn mb-1-9" data-wow-delay="600ms">
                            <div class="widget-title">
                                <h3 class="mb-0 h6">Follow Us</h3>
                            </div>
                            <div class="p-1-9">
                                <ul class="social-icon-style2 mb-0 d-inline-block list-unstyled">
                                    <li class="d-inline-block me-2"><a href="#!"><i
                                                class="fab fa-facebook-f"></i></a></li>
                                    <li class="d-inline-block me-2"><a href="#!"><i class="fab fa-twitter"></i></a>
                                    </li>
                                    <li class="d-inline-block me-2"><a href="#!"><i class="fab fa-youtube"></i></a>
                                    </li>
                                    <li class="d-inline-block"><a href="#!"><i class="fab fa-linkedin-in"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
