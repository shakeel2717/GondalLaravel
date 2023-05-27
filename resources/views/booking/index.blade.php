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
                    </div>
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
                </div>
                <form action="{{ route('flight.booking.store') }}" method="POST">
                    <div class="form-box payment-received-wrap mb-2">
                        <div class="form-title-wrap">
                            <h3 class="title">Travelers Information</h3>
                        </div>
                        @csrf
                        <input type="hidden" name="adult_count" value="{{ $data['adult'] }}">
                        <input type="hidden" name="children_count" value="{{ $data['children'] }}">
                        <input type="hidden" name="infant_count" value="{{ $data['infant'] }}">
                        <input type="hidden" name="trip_type" value="{{ $data['trip_type'] }}">
                        @for ($adult = 0; $adult < $data['adult']; $adult++) @include('inc.traveler', ['type'=> 'adult', 'data' => $adult])
                            @endfor
                            @for ($children = 0; $children < $data['children']; $children++) @include('inc.traveler', ['type'=> 'children', 'data' => $children])
                                @endfor
                                @for ($infant = 0; $infant < $data['infant']; $infant++) @include('inc.traveler', ['type'=> 'infant', 'data' => $infant])
                                    @endfor
                    </div>
                    <div class="form-box">
                        <div class="form-title-wrap">
                            <h3 class="title">Payment Method</h3>
                        </div><!-- form-title-wrap -->
                        <div class="form-content">
                            <div class="section-tab check-mark-tab text-center pb-4">
                                <ul class="nav nav-tabs gateways row" id="myTab" role="tablist">
                                    <label style="width:100%" class="form-check-label" for="gateway_pay-later">
                                        <label style="width:100%" class="form-check-label" for="gateway_bank-transfer">
                                            <div class="col-md-12 mb-1 gateway_bank-transfer">
                                                <div class="form-check nav-link p-2 px-3 m-1 d-flex" style="justify-content: space-between;border-radius: 4px !important;">
                                                    <div class="d-flex mb-2 input" style="gap: 16px; align-items: center;">
                                                        <input checked="" class="form-check-input mx-auto" type="radio" name="payment_gateway" id="gateway_bank-transfer" value="bank-transfer" required="">
                                                        <span class="d-block pt-2">Pay With <strong>BANK TRANSFER</strong></span>
                                                    </div>
                                                    <div class="d-block">
                                                        <img src="{{ asset('assets/theme/img/gateways/bank-transfer.png') }}" style="max-height:40px;background:transparent" alt="bank-transfer">
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </label>
                                </ul>
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
                    </div>
                    <div class="col-lg-12">
                        <div class="btn-box">
                            <button class="theme-btn book" type="submit" id="booking">Confirm Booking</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <div class="sticky-top">
                    <div class="form-box booking-detail-form">
                        <div class="form-title-wrap">
                            <h3 class="title">Booking Details</h3>
                        </div>
                        <div class="form-content">
                            <div class="card-item shadow-none radius-none mb-0">
                                @foreach (json_decode($routes)->itineraries as $allFlights)
                                @foreach ($allFlights->segments as $flight)
                                @include('inc.routes')
                                <hr>
                                @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection