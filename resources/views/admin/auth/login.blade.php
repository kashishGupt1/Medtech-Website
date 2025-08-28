<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--favicon-->
    <link rel="icon" href="{{ asset('admin/images/favicon-32x32.png') }}" type="image/png">
    <!--plugins-->
    <link href="{{ asset('admin/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet">
    <!-- loader-->
    <link href="{{ asset('admin/css/pace.min.css') }}" rel="stylesheet">
    <script src="{{ asset('admin/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/dark-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/semi-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/header-colors.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>MedTech - Website Admin Panel</title>

    <style>
        .error-text {
            color: red;
            font-size: 13px;
        }

        .btn-loader {
            display: inline-block;
            height: 1rem;
            width: 1rem;
            border: 2px solid #fff;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="">
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-cover">
            <div class="">
                <div class="row g-0">

                    <div
                        class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">

                        <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
                            <div class="card-body">
                                <img src={{ asset('admin/images/login-cover.svg') }}
                                    class="img-fluid auth-img-cover-login" width="650" alt="">
                            </div>
                        </div>

                    </div>

                    <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                        <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                            <div class="card-body p-sm-5">
                                <div class="">
                                    <div class="mb-3 text-center">
                                        <img src={{ asset('admin/images/logo-icon.png') }} width="100"
                                            alt="">
                                    </div>
                                    <div class="text-center mb-4">

                                        <p class="mb-0">Please log in to your account</p>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" id="loginForm">
                                            @csrf
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Email ID <span class="text-danger">*</span></label>
                                                <input type="email" name="email" class="form-control"
                                                    id="inputEmailAddress" placeholder="Enter email ID">
                                                <span class="text-danger error-text email_error"></span>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Password <span class="text-danger">*</span></label>
                                                <div class="input-group" id="togglePassword">
                                                    <input type="password" name="password"
                                                        class="form-control border-end-0" id="inputChoosePassword"
                                                        value="12345678" placeholder="Enter password"> <span
                                                        class="input-group-text" id="toggleIcon"><i
                                                            class="bx bx-hide"></i></span>
                                                </div>
                                                <span class="text-danger error-text password_error"></span>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" id="loginBtn" class="btn btn-primary">
                                                        <span id="submitText">Sign In</span>
                                                        <span id="submitLoader" class="spinner-border spinner-border-sm d-none"
                                                            role="status"></span>
                                                    </button>
                                                    
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!--app JS-->
    <script src="{{ asset('admin/js/app.js') }}"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#toggleIcon').on('click', function() {
            const passwordField = $('#inputChoosePassword');
            const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
            passwordField.attr('type', type);
            $(this).find('i').toggleClass('bx-hide bx-show');
        });

        $('#loginForm').on('submit', function(e) {
            e.preventDefault();

            $('.error-text').text('');

            const formData = $(this).serialize();
                $('#loginBtn').prop('disabled', true);
                $('#submitLoader').removeClass('d-none');
                $('#submitText').text('Signing...');

            $.ajax({
                url: "{{ route('admin.login.submit') }}",
                type: 'POST',
                data: formData,
                success: function(response) {
                    $('#submitText').text('Sign In');
                    $('#submitLoader').addClass('d-none');
                    $('#loginBtn').prop('disabled', false);
                    toastr.success(response.message);
                    setTimeout(() => window.location.href =
                            "{{ route('admin.dashboard') }}", 2000);
                },
                error: function(xhr) {
                        $('#submitText').text('Sign In');
                        $('#submitLoader').addClass('d-none');
                        $('#loginBtn').prop('disabled', false);

                    if (xhr.status === 422) {
                        $.each(xhr.responseJSON.errors, function(key, val) {
                            $('.' + key + '_error').text(val[0]);
                        });
                    } else {
                        toastr.error(xhr.responseJSON?.error || 'Invalid credentials.');
                    }
                }
            });
        });
    </script>
    <!--app JS-->
</body>
