<!DOCTYPE html>
<html lang="en">

<head>
    <!-- metas -->
    <meta charset="utf-8" />
    <meta name="author" content="#" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="keywords" content="{{ $meta_keywords ?? 'keyword1, keyword2, keyword3' }}" />
    <meta name="description" content="{!! strip_tags($meta_description ?? 'Default description here') !!}" />
    <meta name="google-site-verification" content="cQQfGg2ZtQ2a6W9E40J0h_1v1uI0bOoQQgcGYOCwxr4" />

    <title>{{ $meta_title ?? 'SBRG | Med Tech' }}</title>

    <link rel="shortcut icon" href="{{ $user->company_logo ? asset('storage/' . $user->company_logo) : asset('assets/img/logos/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ $user->company_logo ? asset('storage/' . $user->company_logo) : asset('assets/img/logos/logo.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('assets/css/plugins.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet">

</head>

<body>

    <div id="preloader"></div>
    <div class="main-wrapper">
        @include('layouts.header')
    
        @yield('content')
    
        @include('layouts.footer')
    </div>

    <div class="scroll-to-top"><i class="fa-solid fa-angle-up"></i></div>

    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/core.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script

</body>

</html>