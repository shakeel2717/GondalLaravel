@extends('layouts.app')
@section('content')
<section class="breadcrumb-area bread-bg-flights">
    <section class="container" style="border-radius:10px;padding:50px 0px">
        <div class="container">
            <h2 class="text-center" style="color:#fff">FLIGHTS BOOKING</h2>
            <p class="text-center text-white">This Page will be Expired after <span id="timer">10:00</span></p>
        </div>
    </section>
</section>
<section class="booking-area padding-top-50px padding-bottom-70px">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @if (session('bookingData'))
                <div class="form-box">
                    <div class="form-title-wrap">
                        <h3 class="title">Re-Issue Ticket <span class="text-danger">{{ session('bookingData')->pnr }}</span></h3>
                    </div><!-- form-title-wrap -->
                    <div class="form-content">
                        <div class="section-tab check-mark-tab pb-4">
                            <div class="card-item shadow-none radius-none mb-4">
                                <h5>Old Price : {{ session('bookingData')->amount }} EUR</h5>
                                <h5>New Price: {{ commission($data['amount']) }} EUR</h5>
                                <h5>Diffrence: {{ session('bookingData')->amount - commission($data['amount']) }} EUR</h5>
                            </div>
                            <h5>if you want to Re-Issue This Ticket with Default Details, Please Click Continue?</h5>
                            <hr>
                            <div class="btn-box">
                                <form action="{{ route('flight.reissue.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="routes" value="{{ $routes }}">
                                    <input type="hidden" name="uri" value="{{ $data['uri'] }}">
                                    <button class="theme-btn book" type="submit" id="booking">Continue</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
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
                        <input type="hidden" name="lastTicketingDate" value="{{ json_decode($routes)->lastTicketingDate }}">
                        <input type="hidden" name="uri" value="{{ $data['uri'] }}">

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
                                    <label style="width:100%" class="form-check-label" for="gateway_bank-transfer">
                                        <div class="col-md-12 mb-1 gateway_bank-transfer">
                                            <div class="form-check nav-link p-2 px-3 m-1 d-flex" style="justify-content: space-between;border-radius: 4px !important;">
                                                <div class="d-flex mb-2 input" style="gap: 16px; align-items: center;">
                                                    <input checked="" class="form-check-input mx-auto" type="radio" name="payment_gateway" id="gateway_bank-transfer" value="bank-transfer" required="">
                                                    <span class="d-block pt-2">Pay With <strong>BANK TRANSFER</strong></span>
                                                </div>
                                                <div class="d-block">
                                                    <img src="{{ asset('assets/theme/img/gateways/bank-transfer.png') }}" style="max-height:40px;background:transparent" alt="Bank Transfer">
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    <label style="width:100%" class="form-check-label" for="gateway_bank-transfer">
                                        <div class="col-md-12 mb-1 gateway_bank-transfer">
                                            <div class="form-check nav-link p-2 px-3 m-1 d-flex" style="justify-content: space-between;border-radius: 4px !important;">
                                                <div class="d-flex mb-2 input" style="gap: 16px; align-items: center;">
                                                    <input checked="" class="form-check-input mx-auto" type="radio" name="payment_gateway" id="gateway_bank-transfer" value="Cash" required="">
                                                    <span class="d-block pt-2">Pay With <strong>CASH</strong></span>
                                                </div>
                                                <div class="d-block">
                                                    <img src="{{ asset('assets/theme/img/gateways/bank-transfer.png') }}" style="max-height:40px;background:transparent" alt="bank-transfer">
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    <label style="width:100%" class="form-check-label" for="gateway_bank-transfer">
                                        <div class="col-md-12 mb-1 gateway_bank-transfer">
                                            <div class="form-check nav-link p-2 px-3 m-1 d-flex" style="justify-content: space-between;border-radius: 4px !important;">
                                                <div class="d-flex mb-2 input" style="gap: 16px; align-items: center;">
                                                    <input checked="" class="form-check-input mx-auto" type="radio" name="payment_gateway" id="gateway_bank-transfer" value="Card" required="">
                                                    <span class="d-block pt-2">Pay With <strong>CARD</strong></span>
                                                </div>
                                                <div class="d-block">
                                                    <img src="{{ asset('assets/theme/img/gateways/bank-transfer.png') }}" style="max-height:40px;background:transparent" alt="bank-transfer">
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="form-box">
                        <div class="form-title-wrap">
                            <h3 class="title">Ticket Confirmation</h3>
                        </div><!-- form-title-wrap -->
                        <div class="form-content">
                            <div class="section-tab check-mark-tab text-center pb-4">
                                <ul class="nav nav-tabs gateways row" id="myTab" role="tablist">
                                    <label style="width:100%" class="form-check-label" for="ticketHold">
                                        <div class="col-md-12 mb-1 ticketHold">
                                            <div class="form-check nav-link p-2 px-3 m-1 d-flex" style="justify-content: space-between;border-radius: 4px !important;">
                                                <div class="d-flex mb-2 input" style="gap: 16px; align-items: center;">
                                                    <input checked="" class="form-check-input mx-auto" type="radio" name="ticket_status" id="ticketHold" value="Hold" required="">
                                                    <span class="d-block pt-2">Ticket On <strong>HOLD</strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    <label style="width:100%" class="form-check-label" for="ticketConfirm">
                                        <div class="col-md-12 mb-1 ticketConfirm">
                                            <div class="form-check nav-link p-2 px-3 m-1 d-flex" style="justify-content: space-between;border-radius: 4px !important;">
                                                <div class="d-flex mb-2 input" style="gap: 16px; align-items: center;">
                                                    <input class="form-check-input mx-auto" type="radio" name="ticket_status" id="ticketConfirm" value="Confirm" required="">
                                                    <span class="d-block pt-2">Ticket Is <strong>CONFIRMED</strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="form-box">
                        <div class="form-title-wrap">
                            <h3 class="title">Contact Detail</h3>
                        </div><!-- form-title-wrap -->
                        <div class="form-content">
                            <div class="section-tab check-mark-tab pb-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="label-text" for="email">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Contact Email" required />
                                    </div>
                                    <div class="col-md-2">
                                        <label class="label-text" for="phone_code">Country Code</label>
                                        <input type="text" name="phone_code" class="form-control" placeholder="Ex: +92" required />
                                    </div>
                                    <div class="col-md-10">
                                        <label class="label-text" for="phone">Phone</label>
                                        <input type="text" name="phone" class="form-control" placeholder="3037702717" required />
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
                                    <input type="hidden" name="pureAmount" id="pureAmount" value="{{ commission($data['amount']) }}">
                                    <input type="hidden" name="pureAmount" id="admin_buy_price" value="{{ $data['amount'] }}">
                                    <input type="hidden" name="marginAmount" id="marginAmount" value="{{ $data['amount'] }}">
                                    <input type="hidden" name="receivedAmount" id="receivedAmount" value="">
                                    <input type="hidden" name="negoAmount" id="negoAmount" value="">
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
                        <div class="form-title-wrap">
                            <h3 class="title">Grand Total</h3>
                        </div>
                        <div class="form-content">
                            <div class="card-item shadow-none radius-none mb-0">
                                <h5>Price : <span class="text-white" id="grandPrice">{{ commission($data['amount']) }}</span> EUR</h5>
                                <h5>Margin: <span class="text-white" id="totalMargin">{{ commission($data['amount']) }}</span> EUR</h5>
                            </div>
                            <hr>
                            <div class="card-item shadow-none radius-none mb-0">
                                <div class="form-group">
                                    <label for="chargesInput">Agent Sell Price</label>
                                    <input type="text" name="chargesInput" id="chargesInput" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="negoInput">NEGO</label>
                                    <input type="text" name="negoInput" id="negoInput" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="receivedInput">Recieved From Customer</label>
                                    <input type="text" name="receivedInput" id="receivedInput" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('footer')
<script>
    var grandPrice = document.getElementById("grandPrice");
    var totalMargin = document.getElementById("totalMargin");
    var chargesInput = document.getElementById("chargesInput");
    var pureAmount = document.getElementById("pureAmount");
    var marginAmount = document.getElementById("marginAmount");
    var receivedInput = document.getElementById("receivedInput");
    var receivedAmount = document.getElementById("receivedAmount");

    var negoInput = document.getElementById("negoInput");
    var negoAmount = document.getElementById("negoAmount");

    negoInput.addEventListener('keyup', function() {
        negoAmount.value = parseFloat(negoInput.value);
    });

    receivedInput.addEventListener('keyup', function() {
        receivedAmount.value = parseFloat(receivedInput.value);
    });

    chargesInput.addEventListener('keyup', function() {
        totalMargin.textContent = parseFloat(pureAmount.value - chargesInput.value).toFixed(2);
        marginAmount.value = parseFloat(chargesInput.value);
    });
</script>
@include('inc.timer')
@endsection