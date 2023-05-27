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
                    <div class="form-box payment-received-wrap mb-2">
                        <div class="form-title-wrap">
                            <h3 class="title">Travelers Information</h3>
                        </div>
                        <form action="{{ route('flight.booking.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="adult_count" value="{{ $data['adult'] }}">
                            <input type="hidden" name="children_count" value="{{ $data['children'] }}">
                            <input type="hidden" name="infant_count" value="{{ $data['infant'] }}">
                            @for ($adult = 0; $adult < $data['adult']; $adult++)
                                @include('inc.traveler', ['type' => 'adult', 'data' => $adult])
                            @endfor
                            @for ($children = 0; $children < $data['children']; $children++)
                                @include('inc.traveler', ['type' => 'children', 'data' => $children])
                            @endfor
                            @for ($infant = 0; $infant < $data['infant']; $infant++)
                                @include('inc.traveler', ['type' => 'infant', 'data' => $infant])
                            @endfor
                            <div class="col-lg-12">
                                <div class="input-box">
                                    <div class="form-group">
                                        <div class="custom-checkbox">
                                            <input type="hidden" name="routes" value="{{ $routes }}">
                                            <input type="checkbox" id="agreechb"
                                                onchange="document.getElementById('booking').disabled = !this.checked;">
                                            <label for="agreechb">By continuing, you agree to the <a target="_blank"
                                                    href="#">Terms and Conditions</a></label>
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
                                        <li style="font-size:22px"><span>Total Price:
                                            </span><strong>{{ $data['currency'] }}
                                                {{ number_format($data['amount'], 2) }} </strong></li>
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
