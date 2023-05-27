@extends('layouts.app')
@section('content')
<section class="breadcrumb-area bread-bg-flights">
    <section class="container" style="border-radius:10px;padding:50px 0px">
        <div class="container">
            <h2 class="text-center" style="color:#fff">FLIGHTS BOOKING</h2>
        </div>
    </section>
</section>
<section class="booking-area padding-top-50px padding-bottom-70px">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="form-box mb-2">
                    <div class="form-title-wrap">
                        <h3 class="title">Your Personal Information</h3>
                    </div><!-- form-title-wrap -->
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-2"><strong>Full Name</strong></div>
                            <div class="col-md-9">{{ auth()->user()->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><strong>Email</strong></div>
                            <div class="col-md-9">{{ auth()->user()->email }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><strong>Phone</strong></div>
                            <div class="col-md-9">{{ auth()->user()->phone }}</div>
                        </div>
                    </div>
                </div><!-- end form-box -->
                <form action="{{ route('flight.booking.store') }}" method="POST">
                    @csrf
                    <div class="form-box payment-received-wrap mb-2">
                        <div class="form-title-wrap">
                            <h3 class="title">Travelers Information</h3>
                        </div>
                        <div class="card-body">
                            <!-- adults -->
                            <div class="card mb-3">
                                <div class="card-header">
                                    Adult Traveler <strong>1</strong>
                                </div>
                                <div class="card-body">
                                    <!-- personal info -->
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="label-text">Title</label>
                                            <select name="title" class="form-select">
                                                <option value="Mr">Mr</option>
                                                <option value="Miss">Miss</option>
                                                <option value="Mrs">Mrs</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="label-text">First Name</label>
                                            <input type="text" name="firstname" class="form-control" placeholder="First Name" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="label-text">Last Name</label>
                                            <input type="text" name="lastname" class="form-control" placeholder="Last Name" />
                                        </div>
                                    </div>

                                    <!-- nationality and personality -->
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label class="label-text">Nationality</label>
                                            <select class="form-select form-select" name="nationality">
                                                @foreach(countryList() as $country)
                                                <option value="{{ $country }}">{{ $country }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-5">
                                                    <label class="label-text">Date of Birth</label>
                                                    <select class="form-select form-select" name="dob_month">
                                                        @foreach (monthsList() as $month)
                                                        <option value="{{ $month }}">{{ $month }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <label class="label-text">Day</label>
                                                    <select name="dob_day" class="form-select form-select">
                                                        @for ($i=0; $i < 32; $i++) <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option>
                                                            @endfor
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <label class="label-text">Year</label>
                                                    <select class="form-select form-select" name="dob_year">
                                                        @for ($i=1920; $i < date('Y'); $i++) <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option>
                                                            @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- passport credentials -->
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <label class="label-text">Passport or ID number</label>
                                            <input type="text" name="passport" class="form-control" placeholder="Passport or ID number" value="" />
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="row">
                                                <div class="col-5">
                                                    <label class="label-text">Passport Expiry Date</label>
                                                    <select class="form-select form-select" name="passport_month">
                                                        @foreach (monthsList() as $month)
                                                        <option value="{{ $month }}">{{ $month }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <label class="label-text">Day</label>
                                                    <select name="passport_day" class="form-select form-select">
                                                        @for ($i=0; $i < 32; $i++) <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option>
                                                            @endfor
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <label class="label-text">Year</label>
                                                    <select class="form-select form-select" name="passport_year">
                                                        @for ($i=date('Y'); $i < 2035; $i++) <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option>
                                                            @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="input-box">
                            <div class="form-group">
                                <div class="custom-checkbox">
                                    <input type="hidden" name="routes" value="{{ $routes }}">
                                    <input type="checkbox" id="agreechb" onchange="document.getElementById('booking').disabled = !this.checked;">
                                    <label for="agreechb">By continuing, you agree to the <a target="_blank" href="#">Terms and Conditions</a></label>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col-lg-12 -->
                    <div class="col-lg-12">
                        <div class="btn-box">
                            <button class="theme-btn book" type="submit" id="booking">Confirm Booking</button>
                        </div>
                    </div><!-- end col-lg-12 -->
                </form>
            </div><!-- end col-lg-8 -->
            <div class="col-lg-4">
                <div class="sticky-top">
                    <div class="form-box booking-detail-form">
                        <div class="form-title-wrap">
                            <h3 class="title">Booking Details</h3>
                        </div><!-- end form-title-wrap -->
                        <div class="form-content">
                            <div class="card-item shadow-none radius-none mb-0">
                                <div class="card-body p-0">
                                    <div class="section-block"></div>
                                    <li style="font-size:22px"><span>Total Price: </span><strong>EUR 0.15 </strong></li>
                                    </ul>
                                </div>
                            </div><!-- end card-item -->
                        </div><!-- end form-content -->
                    </div><!-- end form-box -->
                </div><!-- end col-lg-4 -->
            </div><!-- end col-lg-4 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end booking-area -->
</section>
@endsection