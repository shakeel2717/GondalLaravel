<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ env('APP_NAME') }}</title>
    <!-- ASSETS -->
    <link rel="stylesheet" href="{{ asset('assets/theme/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/theme/css/line-awesome.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/theme/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/theme/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/theme/css/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/theme/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/theme/css/animated-headline.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/theme/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/theme/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/theme/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/theme/css/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/theme/css/mobile.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/theme/css/childstyle.css')}}">

    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
    <script src="{{ asset('assets/theme/js/jquery/jquery.min.js')}}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    <style>
        .hide {
            display: none;
        }

        .show_ {
            display: block !important;
        }

        #show,
        #multiway {
            display: none;
        }
    </style>
</head>

<body id="fadein" class="fixed-nav" style="padding-top:70px !important;">

    <!-- loading effect -->
    <!-- <div class="preloader centerrotate" id="preloader">
        <div class="rotatingDiv"></div>
    </div> -->
    <header class="header-area">
        <div class="header-menu-wrapper padding-right-100px padding-left-100px d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="menu-wrapper d-flex">
                            <div class="logo">
                                <a href="{{ route('index') }}" style="border-radius:5px">
                                    <img style="max-height:40px;border-radius:5px;background:transparent;padding:4px;" src="{{ asset('assets/img/logo.png') }}" alt="logo">
                                </a>
                                <div class="menu-toggler">
                                    <i class="la la-bars"></i>
                                    <i class="la la-times"></i>
                                </div>
                            </div>

                            <div class="main-menu-content w-100">
                                <div class="align-items-center d-flex justify-content-between gap-3">

                                    <div class="w-100">
                                        <nav class="px-5">
                                            <ul style="padding-top:10px!important">
                                                <li><a href=" {{ route('index') }}" title="home active">Home</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <div class="d-flex header-top-bar">
                                        <div class="header-right-action pt-1 pe-2">
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="ACCOUNT" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <svg class="pe-1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                        <circle cx="12" cy="7" r="4"></circle>
                                                    </svg>
                                                    Sign In
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="breadcrumb-area bread-bg-flights">
        <section class="container" style="border-radius:10px;padding:50px 0px">
            <div class="container">
                <h2 class="text-center" style="color:#fff">SEARCH FOR BEST FLIGHTS</h2>
                <br>
                <div style="padding:50px 20" id="fadein">
                    <form autocomplete="off" class="main_search">
                        <div class="row mb-3 g-1" style="justify-content: space-between;">
                            <div class="col-md-4 flight_types">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="trip" id="one-way" onclick="oneway();" value="oneway" checked>
                                            <label class="form-check-label" for="one-way">One Way</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="trip" id="round-trip" value="return">
                                            <label class="form-check-label" for="round-trip"> Round Trip</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="trip" id="multi-trip" onclick="multiway();" value="multi">
                                            <label class="form-check-label" for="multi-trip"> Multi Way</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select name="" id="flight_type" class="flight_type form-select form-select-sm">
                                    <option value="economy" selected>Economy</option>
                                    <option value="economy_premium">Economy Premium</option>
                                    <option value="business">Business</option>
                                    <option value="first">First</option>
                                </select>
                            </div>
                        </div>
                        <div class="row contact-form-action g-1" id="onereturn">
                            <div class="col-md-6">
                                <div class="row g-1">
                                    <div class="col-md-6">
                                        <div class="input-box input-items">
                                            <label class="label-text">Flying From</label>
                                            <div class="form-group">
                                                <span class="la la-plane-departure form-icon"></span>
                                                <input class="form-control autocomplete-airport" type="search" placeholder="Flying From" name="from" id="autocomplete" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-box input-items">
                                            <div id="swap" class="position-absolute">
                                                <div class="swap-places waves-effect shadow">
                                                    <span class="swap-places__arrow --top">
                                                        <svg width="13" height="6" viewBox="0 0 13 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3 4V6L0 3L3 0V2H13V4H3Z"></path>
                                                        </svg>
                                                    </span>
                                                    <span class="swap-places__arrow --bottom">
                                                        <svg width="13" height="6" viewBox="0 0 13 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3 4V6L0 3L3 0V2H13V4H3Z"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                            <label class="label-text">To Destination</label>
                                            <div class="form-group">
                                                <span class="la la-plane-arrival form-icon mx-2"></span>
                                                <input class="form-control autocomplete-airport focus px-5" type="search" placeholder="To Destination" name="to" id="autocomplete2" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row g-0">
                                    <div class="col">
                                        <div class="input-box">
                                            <label class="label-text">Departure Date</label>
                                            <div class="form-group">
                                                <span class="la la-calendar form-icon"></span>
                                                <input class="depart form-control" id="departure" name="depart" type="text" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col" id="show">
                                        <div class="input-box">
                                            <label class="label-text">Return Date</label>
                                            <div class="form-group">
                                                <span class="la la-calendar form-icon"></span>
                                                <input class="returning form-control dateright border-top-l0" name="returning" type="text" id="return" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="input-box">
                                    <label class="label-text">Passengers </label>
                                    <div class="form-group">
                                        <div class="dropdown dropdown-contain">

                                            <i class="la la-user form-icon"></i>
                                            <a class="dropdown-toggle dropdown-btn travellers" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                                <p>Travelers<span class="guest_flights"></span>
                                                </p>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-wrap">
                                                <div class="dropdown-item adult_qty">
                                                    <div class="qty-box d-flex align-items-center justify-content-between" style="margin-bottom: 10px; border-bottom: 1px solid #dedede; padding-bottom: 10px;">
                                                        <label style="line-height:16px">
                                                            <i class="la la-user"></i> Adults
                                                            <div class="clear"></div>
                                                            <small style="font-size:10px">+12</small>
                                                        </label>
                                                        <div class="qtyBtn d-flex align-items-center">
                                                            <input type="text" name="adults" id="fadults" value="" class="qtyInput_flights">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dropdown-item child_qty">
                                                    <div class="qty-box d-flex align-items-center justify-content-between" style="margin-bottom: 10px; border-bottom: 1px solid #dedede; padding-bottom: 10px;">
                                                        <label style="line-height:16px">
                                                            <i class="la la-female"></i> Childs
                                                            <div class="clear"></div>
                                                            <small style="font-size:10px">2 - 11</small>
                                                        </label>
                                                        <div class="qtyBtn d-flex align-items-center">
                                                            <input type="text" name="childs" id="fchilds" value="" class="qtyInput_flights">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dropdown-item infant_qty">
                                                    <div class="qty-box d-flex align-items-center justify-content-between">
                                                        <label style="line-height:16px">
                                                            <i class="la la-female"></i> Infants
                                                            <div class="clear"></div>
                                                            <small style="font-size:10px">-2</small>
                                                        </label>
                                                        <div class="qtyBtn d-flex align-items-center">
                                                            <input type="text" name="childs" id="finfant" value="" class="qtyInput_flights">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col-lg-3 -->
                            <div class="col-md-1">
                                <div class="btn-search text-center">
                                    <button type="button" id="flights-search" class="more_details w-100 btn-lg effect" data-style="zoom-in">
                                        <svg style="fill:currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" class="c8LPF-icon" role="img" height="24" cleanup="">
                                            <path d="M174.973 150.594l-29.406-29.406c5.794-9.945 9.171-21.482 9.171-33.819C154.737 50.164 124.573 20 87.368 20S20 50.164 20 87.368s30.164 67.368 67.368 67.368c12.345 0 23.874-3.377 33.827-9.171l29.406 29.406c6.703 6.703 17.667 6.703 24.371 0c6.704-6.702 6.704-17.674.001-24.377zM36.842 87.36c0-27.857 22.669-50.526 50.526-50.526s50.526 22.669 50.526 50.526s-22.669 50.526-50.526 50.526s-50.526-22.669-50.526-50.526z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="language" id="language" value="en">
                        <div class="multi-flight-wrap" id="multiway">
                            <div class="contact-form-action multi-flight-field">
                                <div class="row g-1 contact-form-action multi_flight">
                                    <div class="col-md-6">
                                        <div class="row g-1">
                                            <div class="col-md-6">
                                                <div class="input-box input-items">
                                                    <label class="label-text">Flying From</label>
                                                    <div class="form-group">
                                                        <span class="la la-plane-departure form-icon"></span>
                                                        <div class="autocomplete-wrapper _1 row_1">
                                                            <input class="form-control autocomplete-airport" type="search" placeholder="Flying From" name="from" id="autocomplete3" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-box input-items">
                                                    <label class="label-text">To Destination</label>
                                                    <div class="form-group">
                                                        <span class="la la-plane-arrival form-icon"></span>
                                                        <div class="autocomplete-wrapper _1 row_2">
                                                            <input class="form-control autocomplete-airport" type="search" placeholder="To Destination" name="to" id="autocomplete4" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <div class="input-box">
                                                    <label class="label-text">Departure Date</label>
                                                    <div class="form-group">
                                                        <span class="la la-calendar form-icon"></span>
                                                        <input class="dp form-control" id="departure" name="depart" type="text" value="26-02-2021">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col-lg-3 -->
                                    <div class="col-md-3 d-flex flight-remove" style="padding-left:10px;align-items:center">
                                        <label class="label-text">&nbsp;</label>
                                        <button class="btn multi-flight-remove d-flex align-items-center justi-content-center" type="button"><i class="la la-remove"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-lg-3 pr-0">
                                    <div class="form-group">
                                        <button class="theme-btn add-flight-btn margin-top-20px w-100" type="button"><i class="la la-plus mr-1"></i>Add another flight</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <script>
                        // URL beurify and search action
                        $("#flights-search").click(function() {
                            var trip_type = $('input[name=trip]:checked').val();
                            var origin = $("#autocomplete").val().toLowerCase();
                            var destination = $("#autocomplete2").val().toLowerCase();
                            var cdeparture = $("#departure").val();
                            var returnn = $("#return").val();
                            var flight_type = $("#flight_type").val().toLowerCase();
                            var adult = $("#fadults").val();
                            var children = $("#fchilds").val();
                            var infant = $("#finfant").val();
                            var language = $('#language').val();
                            var origin_split = origin.split(' ');
                            var origin = origin_split[0];
                            var destination_split = destination.split(' ');
                            var destination = destination_split[0];
                            if (origin == '') {
                                alert('Please fill out origin');
                                $('#autocomplete').focus();
                            } else if (destination == '') {
                                alert('Please fill out destination');
                                $('#autocomplete2').focus();

                                // main params of get url
                            } else {
                                var actionURL = '/' + 'en' + '/' + 'usd' + '/';

                                // for oneway
                                if (trip_type == 'oneway') {
                                    var finelURL = actionURL + origin + '/' + destination + '/' + trip_type + '/' + flight_type + '/' + cdeparture + '/' + adult + '/' + children + '/' + infant;
                                    $("html, body").animate({
                                        scrollTop: 0
                                    }, "fast");
                                    window.location.href = "{{ env('APP_URL') }}" + finelURL;

                                    // for return
                                } else if (trip_type == 'return') {
                                    var finelURL = actionURL + origin + '/' + destination + '/' + trip_type + '/' + flight_type + '/' + cdeparture + '/' + returnn + '/' + adult + '/' + children + '/' + infant;
                                    $("html, body").animate({
                                        scrollTop: 0
                                    }, "fast");
                                    window.location.href = "{{ env('APP_URL') }}" + finelURL;

                                    // for multi way
                                } else {
                                    var finelURL = actionURL + origin + '/' + destination + '/' + cdeparture + '/' + origin + '/' + destination + '/' + cdeparture + '/' + origin + '/' + destination + '/' + cdeparture + '/' + trip_type + '/' + flight_type + '/' + adult + '/' + children + '/' + infant;
                                    $("html, body").animate({
                                        scrollTop: 0
                                    }, "fast");
                                    window.location.href = "{{ env('APP_URL') }}" + finelURL;
                                }
                            }
                        });

                        /* oneway */
                        document.getElementById("one-way").onclick = function() {
                            document.getElementById("show").className = "col hide";
                            document.getElementById("onereturn").className = "row g-1 contact-form-action";
                            document.getElementById("multiway").className = "";
                            document.getElementById("departure").className = "depart form-control";
                        }

                        /* return */
                        document.getElementById("round-trip").onclick = function() {
                            document.getElementById("show").className = "col show_";
                            document.getElementById("onereturn").className = "row g-1 contact-form-action";
                            document.getElementById("multiway").className = "";
                            document.getElementById("departure").className = "depart form-control dateleft border-top-r0";
                        }

                        /* multiway */
                        document.getElementById("multi-trip").onclick = function() {
                            document.getElementById("multiway").className = "multi-flight-wrap show_";
                            document.getElementById("show").className = "col hide";
                            document.getElementById("departure").className = "depart form-control";
                        }
                    </script>
                </div>
            </div>
        </section>
    </section>
    <!-- start back-to-top -->
    <div id="back-to-top">
        <i class="la la-angle-up" title="Go top"></i>
    </div>
    <!-- end back-to-top -->

    <!-- ================================
    START INFO AREA
================================= -->
    <section class="info-area info-bg padding-top-90px padding-bottom-20px">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 responsive-column">
                    <a href="http://localhost/GondalTravelFr/contact" class="icon-box icon-layout-2 d-flex bg-light">
                        <div class="info-icon flex-shrink-0">
                            <i class="la la-phone"></i>
                        </div><!-- end info-icon-->
                        <div class="info-content pt-2">
                            <h4 class="info__title">Need Help? Contact us</h4>
                            <p class="info__desc">
                                Our support team available 24/7 </p>
                        </div><!-- end info-content -->
                    </a><!-- end icon-box -->
                </div><!-- end col-lg-4 -->
                <div class="col-lg-4 responsive-column">
                    <div class="icon-box icon-layout-2 d-flex bg-light">
                        <div class="info-icon flex-shrink-0">
                            <i class="la la-money"></i>
                        </div><!-- end info-icon-->
                        <div class="info-content pt-2">
                            <h4 class="info__title">Secure Payments</h4>
                            <p class="info__desc">
                                Remarkable and 99.9% service uptime </p>
                        </div><!-- end info-content -->
                    </div><!-- end icon-box -->
                </div><!-- end col-lg-4 -->
                <div class="col-lg-4 responsive-column">
                    <div class="icon-box icon-layout-2 d-flex bg-light">
                        <div class="info-icon flex-shrink-0 ">
                            <i class="la la-times"></i>
                        </div><!-- end info-icon-->
                        <div class="info-content pt-2">
                            <h4 class="info__title">Cancel Policy</h4>
                            <p class="info__desc">
                                Cancellation made easy and automated </p>
                        </div><!-- end info-content -->
                    </div><!-- end icon-box -->
                </div><!-- end col-lg-4 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end info-area -->
    <!-- ================================
    END INFO AREA
================================= -->
    <section class="footer-area padding-top-100px padding-bottom-30px">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 responsive-column">
                    <div class="footer-item">
                        <div class="footer-logo padding-bottom-10px">
                            <a href="http://localhost/GondalTravelFr/" class="foot__logo"><img style="max-width: 150px;background:transparent" src="http://localhost/GondalTravelFr/api/uploads/global/logo.png" alt="logo"></a>
                        </div><!-- end logo -->
                        <ul class="list-items pt-3">
                            <li><strong> +1-234-56789 </strong></li>
                            <li><strong><a href="mailto:info@travelagency.com">info@travelagency.com</a></strong></li>
                            <li><a href="http://localhost/GondalTravelFr/contact"><strong>Contact Us</strong></a></li>
                        </ul>
                    </div><!-- end footer-item -->
                </div><!-- end col-lg-3 -->

                <div class="col-lg-9 responsive-column">
                    <ul class="foot_menu w-100">

                        <!-- header manue -->
                        <li class="footm">
                            <a href="company">Company <i class="la la-angle-down"></i></a>
                            <ul class="dropdown-menu-item">
                                <li><a href="http://localhost/GondalTravelFr/about-us">About Us</a>
                                </li>
                                <li><a href="http://localhost/GondalTravelFr/terms-of-use">Terms of Use</a>
                                </li>
                                <li><a href="http://localhost/GondalTravelFr/cookies-policy">Cookies policy</a>
                                </li>
                                <li><a href="http://localhost/GondalTravelFr/privacy-policy">Privacy Policy</a>
                                </li>
                            </ul>
                        </li>
                        <li class="footm">
                            <a href="supprt">Support <i class="la la-angle-down"></i></a>
                            <ul class="dropdown-menu-item">
                                <li><a href="http://localhost/GondalTravelFr/become-supplier">Become Supplier</a>
                                </li>
                                <li><a href="http://localhost/GondalTravelFr/faq">FAQ</a>
                                </li>
                                <li><a href="http://localhost/GondalTravelFr/booking-tips">Booking Tips</a>
                                </li>
                                <li><a href="http://localhost/GondalTravelFr/how-to-book">How to Book</a>
                                </li>
                            </ul>
                        </li>
                        <li class="footm">
                            <a href="services">Services <i class="la la-angle-down"></i></a>
                            <ul class="dropdown-menu-item">
                                <li><a href="http://localhost/GondalTravelFr/file-a-claim">File a claim</a>
                                </li>
                                <li><a href="http://localhost/GondalTravelFr/offers">Last minute deals</a>
                                </li>
                                <li><a href="http://localhost/GondalTravelFr/signup-supplier">Add your business</a>
                                </li>
                                <li><a href="http://localhost/GondalTravelFr/careers">Careers and Jobs</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div><!-- end row -->
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="term-box footer-item">
                        <ul class="list-items list--items d-flex align-items-center">
                            All Rights Reserved by All Rights Reserved by PHPTRAVELS </ul>
                    </div>
                </div><!-- end col-lg-8 -->
                <div class="col-lg-4">
                    <div class="footer-social-box text-right">
                        <ul class="social-profile">
                            <li><a href="https://www.facebook.com/phptravels" target="_blank"><i class="lab la-facebook"></i></a></li>
                            <li><a href="https://twitter.com/phptravels" target="_blank"><i class="lab la-twitter"></i></a></li>
                            <li><a href="https://www.youtube.com/c/PhptravelsOfficial" target="_blank"><i class="lab la-youtube"></i></a></li>
                            <li><a href="https://wa.me/123456789" target="_blank"><i class="lab la-whatsapp"></i></a></li>
                            <li><a href="https://www.instagram.com/phptravels_/" target="_blank"><i class="lab la-instagram"></i></a></li>
                        </ul>
                    </div>
                </div><!-- end col-lg-4 -->
            </div><!-- end row -->
        </div><!-- end container -->
        <div class="section-block mt-4"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="copy-right-content d-flex align-items-center justify-content-end padding-top-30px">
                        <h3 class="font-size-15" style="width:100%">
                            <!-- ********************   Removing powered by linkback will result to cancellation of your support service.    ********************  -->
                            <div class="d-none d-md-block" style="padding:0px;position:relative">
                                <div class="container">
                                    <div class="text-center">Powered by &nbsp;<a href="http://www.phptravels.com" target="_blank"> <img src="http://localhost/GondalTravelFr/api/uploads/global/phptravels.png" style="height:22px;display: inline-block; -webkit-transform: translateY(0px);transform: translateY(0px);" height="22" alt="PHPTRAVELS"> <strong>&nbsp;PHPTRAVELS</strong></a> v8</div>
                                </div>
                            </div>
                            <!-- ********************   Removing powered by linkback will result to cancellation of your support service.    ********************  -->
                        </h3>
                        <img src="http://localhost/GondalTravelFr/app/themes/default/assets/img/payment-img.png" alt="">
                    </div><!-- end copy-right-content -->
                </div><!-- end col-lg-5 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <script type="text/javascript">
        $(function() {
            $('#cookie_stop').click(function() {
                $('#cookie_disclaimer').slideUp();
                var nDays = 999;
                var cookieName = "disclaimer";
                var cookieValue = "true";
                var today = new Date();
                var expire = new Date();
                expire.setTime(today.getTime() + 3600000 * 24 * nDays);
                document.cookie = cookieName + "=" + escape(cookieValue) + ";expires=" + expire.toGMTString() + ";path=/";
            });

        });
    </script>

    <!-- javascript resouces and libs -->
    <script src="{{ asset('assets/theme/js/jquery-ui.js')}}"></script>
    <script src="{{ asset('assets/theme/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/theme/js/moment.min.js')}}"></script>
    <script src="{{ asset('assets/theme/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('assets/theme/js/jquery.fancybox.min.js')}}"></script>
    <script src="{{ asset('assets/theme/js/jquery.countTo.min.js')}}"></script>
    <script src="{{ asset('assets/theme/js/animated-headline.js')}}"></script>
    <script src="{{ asset('assets/theme/js/quantity-input.js')}}"></script>
    <script src="{{ asset('assets/theme/js/select2.js')}}"></script>
    <script src="{{ asset('assets/theme/js/main.js')}}"></script>
    <script src="{{ asset('assets/theme/js/app.js')}}"></script>

    <script>
        // LOADING EFFECT
        $(".foot_menu a,.blog-area a,.destination-area a,.hotel-area a,.popular-round-trip-wrap a,.loading_effect,.header-menu-wrapper a").click(function() {
            $('#preloader').fadeIn(250);
        })

        // homepage tab rearrange and make first one active default
        $(".listitems li").sort(sort_li).appendTo('.listitems');

        function sort_li(a, b) {
            return ($(b).data('position')) < ($(a).data('position')) ? 1 : -1;
        };
        $('.nav-tabs .nav-item:first-child button').addClass('active');
        $('.search_tabs .tab-pane:first-child').addClass('show active');

        // select 2 location init for hotels search 
        var $ajax = $(".city");

        function formatRepo(t) {
            return t.loading ? t.text : (console.log(t), '<i class="flag ' + t.icon.toLowerCase() + '"></i>' + t.text)
        }

        function formatRepoSelection(t) {
            return t.text
        }
        $ajax.select2({
            ajax: {
                url: "http://localhost/GondalTravelFr/hotels_locations",
                dataType: "json",
                data: function(t) {
                    return {
                        q: $.trim(t.term)
                    }
                },
                processResults: function(t) {
                    var e = [];
                    return t.forEach(function(t) {
                        e.push({
                            id: t.id,
                            text: t.text,
                            icon: t.icon
                        })
                    }), console.log(e), {
                        results: e
                    }
                },
                cache: !0
            },
            escapeMarkup: function(t) {
                return t
            },
            minimumInputLength: 3,
            templateResult: formatRepo,
            templateSelection: formatRepoSelection,
            dropdownPosition: 'below',
            cache: !0
        });
    </script>

    <script>
        $('.select_').select2({
            placeholder: {
                id: '1',
                text: 'Select Category'
            }
        });
        $('.select2-container').css('width', '100%')
        $('#select').select2({
            placeholder: {
                id: '1',
                text: 'Select Category'
            }
        });

        $('#email_subscribe').click(function() {
            let S_email = $('#exampleInputEmail1').val();
            if (S_email != 0) {
                if (isValidEmailAddress(S_email)) {
                    $.ajax({
                        type: "GET",
                        url: "http://localhost/GondalTravelFr/subscribe",
                        data: {
                            S_email: S_email
                        },
                        success: function(response) {
                            res = JSON.parse(response);
                            if (res.error) {
                                $('.wow').text("Please add email!");
                                $(".newstext").fadeIn(3000);
                                $(".newstext").fadeOut(3000);
                            } else {
                                if (res.status == true) {
                                    $('.wow').text("Thank you for subscription");
                                    $(".newstext").fadeIn(3000);
                                    $(".newstext").fadeOut(3000);
                                    $('#exampleInputEmail1').val('');
                                } else {
                                    $('.wow').text("Email exist");
                                    $(".newstext").fadeIn(3000);
                                    $(".newstext").fadeOut(3000);
                                    $('#exampleInputEmail1').val('');
                                }
                            }
                        }
                    });
                } else {
                    $('.wow').text("Please add correct email!");
                    $(".newstext").fadeIn(3000);
                    $(".newstext").fadeOut(3000);
                }
            } else {
                $('.wow').text("Please add email!");
                $(".newstext").fadeIn(3000);
                $(".newstext").fadeOut(3000);
            }
        });

        function isValidEmailAddress(emailAddress) {
            var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            return pattern.test(emailAddress);
        }
    </script>
    <script>
        // SWAP VALUES
        var btn = document.getElementById("swap");
        btn.addEventListener("click", function(e) {
            var from = document.getElementById("autocomplete"),
                to = document.getElementById("autocomplete2");
            if (!!from && !!to) {
                var _ = from.value;
                from.value = to.value;
                to.value = _;
            } else {
                console.log("some input elements could not be found");
            }
        });
    </script>

    <link rel="stylesheet" href="{{ asset('assets/theme/css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/js/custom.js')}}">

</body>

</html>