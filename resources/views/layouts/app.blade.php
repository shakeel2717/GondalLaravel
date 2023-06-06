<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title') {{ env('APP_NAME') }}</title>
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
    @yield('head')
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
                                    <img style="max-height:60px;border-radius:5px;background:transparent;padding:4px;" src="{{ asset('assets/img/logo.png') }}" alt="logo">
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
                                                @auth
                                                <li><a href=" {{ route('admin.dashboard.index') }}" title="Dashboard">Dashboard</a></li>
                                                @if (auth()->user()->role == 1)
                                                <li><a href=" {{ route('admin.booking.index') }}" title="Booking">Go to Bookings</a></li>
                                                @endif
                                                @endauth
                                            </ul>
                                        </nav>
                                    </div>
                                    @auth
                                    <div class="w-100 text-end">
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary">
                                                    <svg class="pe-1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                        <circle cx="12" cy="7" r="4"></circle>
                                                    </svg>
                                                    Sign Out
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    @endauth
                                    @guest
                                    <div class="w-100 d-flex justify-content-end">
                                        <div class="me-1">
                                            <a href="{{ route('login') }}" class="btn btn-primary">
                                                <svg class="pe-1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                                B2B Login
                                            </a>
                                        </div>
                                        <div class="ms-1">
                                            <a href="{{ route('register') }}" class="btn btn-primary">
                                                <svg class="pe-1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                                Join Us
                                            </a>
                                        </div>
                                    </div>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    @yield('content')
    <!-- start back-to-top -->
    <div id="back-to-top">
        <i class="la la-angle-up" title="Go top"></i>
    </div>
    <!-- end back-to-top -->
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
    @yield('footer')
    <x-alert />
</body>

</html>