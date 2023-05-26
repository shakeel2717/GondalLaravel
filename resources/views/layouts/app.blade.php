<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>{{ env('APP_NAME') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">

    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
    <script async src="{{ asset('assets/js/api.js') }}"></script>
    <style>
        .sb-customizer-toggler {
            display: none !important
        }
    </style>
</head>

<body class="bg-primary">
    <!-- Layout wrapper-->
    <div id="layoutAuthentication">
        <!-- Layout content-->
        <div id="layoutAuthentication_content">
            <!-- Main page content-->
            <main>
                <!-- Main content container-->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8">
                            <div class="card card-raised shadow-10 mt-5 mt-xl-10 mb-4">
                                <div class="card-body p-5">
                                    <!-- Auth header with logo image-->
                                    <div class="text-center">
                                        <img class="mb-3" src="{{ asset('assets/img/favicon.png') }}" alt="..." style="max-height: 48px;border-radius: 8px;" />
                                        <h1 class="display-5 mb-0"><strong>Login</strong></h1>
                                        <div class="subheading-1 mb-5">Administrator Users Only</div>
                                    </div>
                                    <!-- Login submission form-->

                                    <form method="POST" action="login" data-wow-duration="0.2s" data-wow-delay="0.2s" class="form-signin form-horizontal wow fadeIn animated">
                                        @csrf

                                        <div class="mb-2">
                                            <label class="pure-material-textfield-outlined">
                                                <input placeholder="Email" name="email" type="text" autofocus="">
                                                <span>Email</span>
                                            </label>
                                        </div>

                                        <div class="mb-2">
                                            <label class="pure-material-textfield-outlined">
                                                <input type="password" name="password" placeholder=" " autofocus="">
                                                <span>Password</span>
                                            </label>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col-xs-6">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="remember" value="remember-me"> Remember me </label>
                                            </div>

                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">

                                            <div class="text-right small fw-500 text-decoration-none">
                                                <a id="link-forgot" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ForgetPassword"> <strong class="small fw-500 text-decoration-none">Forget Password</strong></a>
                                                <div class="clearfix"></div>
                                            </div>

                                            <button data-wow-duration="2s" data-wow-delay="s" type="submit" class="btn btn-primary btn-block ladda-button fadeIn animated" data-style="zoom-in">Login</button>
                                        </div>
                                        <div style="margin-top:10px" class="resultlogin"></div>
                                    </form>
                                </div>
                            </div>
                            <!-- Auth card message-->
                            <div class="text-center mb-5">
                                <div class="me-sm-3 mb-2 mb-sm-0">
                                    <div class="fw-500 text-white">Powered by <a target="_blank" style="color: #FFFFFF" href="#">
                                            <b>{{ env('APP_NAME') }}</b>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- Load Bootstrap JS bundle-->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
    <script type="module" src="{{ asset('assets/js/material.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/sb-customizer.js') }}"></script>
    <sb-customizer project="material-admin-pro"></sb-customizer>
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/fa.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/include/login/ladda-themeless.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/include/login/spin.min.js') }}"></script>
    <script src="{{ asset('assets/include/login/ladda.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>

    <script src="{{ asset('assets/include/icheck/icheck.min.js') }}"></script>
    <link href="{{ asset('assets/include/icheck/square/grey.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/js/custom.js') }}" rel="stylesheet">
    <x-alert />
</body>

</html>