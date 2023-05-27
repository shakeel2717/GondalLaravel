@extends('layouts.app')
@section('head')
<style>
    .termtext {
        font-size: 10px;
        margin: 0 !important;
        line-height: 1.5;
    }

    .line {
        /* border-bottom: 2px solid black; */
        width: 70px;
        height: 5px;
    }
</style>
@endsection
@section('content')
<section class="payment-area section-bg section-padding pt-4">
    <div class="container">
        <div class="row">
            <div>
                <div class="col-lg-8 mx-auto print" id="">
                    <div class="form-box payment-received-wrap mb-0">
                        <div class="form-content pb-0">
                            <div class="payment-received-list">
                                <div class="mt-2 mb-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <img style="filter: grayscale(100%);" src="https://gondaltravel.com/images/logo.png" width="100" alt="Logo">
                                            </div>
                                            <div class="col-md-8 text-end">
                                                <h5>PNR: {{$booking->pnr}}</h5>
                                                <h5>CONFIRMED: 546543</h5>
                                                <h5>@foreach($flightData->itineraries as $segments)
                                                    @foreach($segments->segments as $flight)
                                                    {{ findCityName($flight->departure->iataCode) }}
                                                    @if($loop->remaining)
                                                    To
                                                    @endif
                                                    @endforeach
                                                    @endforeach
                                                </h5>
                                            </div>
                                            <hr class="my-2">
                                            <div class="col-md-12">
                                                <div class="passenger my-2">
                                                    <div>
                                                        <span class="name">Passenger's Name</span>
                                                    </div>
                                                    <div class="row">
                                                        @foreach ($booking->passengers as $passenger)
                                                        <div class="col-md-6">
                                                            <span style="display: inline-block; width: 20px; height: 20px; line-height: 20px; text-align: center; border-radius: 50%; background-color: #ddd; color: #000; font-weight: bold; margin-right: 10px;">
                                                                {{ $loop->iteration }}
                                                            </span>
                                                            <span>
                                                                {{ $passenger->firstname }}

                                                            </span> {{ $passenger->firstname }} {{ $passenger->lastname }} <small style="font-size:10px;"><sup class="text-uppercase"> {{ $passenger->type }}</sup></small>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="mb-0 mt-0">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table class="table table-sm mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Flight</th>
                                                                    <th>Departure</th>
                                                                    <th></th>
                                                                    <th>Arrival</th>
                                                                    <th>Baggage</th>
                                                                </tr>
                                                                @php
                                                                $oldDate = "";
                                                                @endphp
                                                                @foreach($flightData->itineraries as $segments)
                                                                @foreach($segments->segments as $flight)
                                                                @if($oldDate != "")
                                                                @php
                                                                $date1 = new DateTime($oldDate);
                                                                $date2 = new DateTime($flight->departure->at);

                                                                $diff = $date1->diff($date2);

                                                                // Accessing the time difference
                                                                $hours = $diff->h;
                                                                $minutes = $diff->i;
                                                                @endphp
                                                                <tr>
                                                                    <td colspan="6">
                                                                        <div class="text-center">
                                                                            Connecting Time: {{ $hours }} hours {{ $minutes }} minutes
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                <tr>
                                                                    <td class="text-center align-middle">
                                                                        <p style="font-weight: bold;white-space: nowrap;">{{ findAirlineName($flight->carrierCode)}}</p>
                                                                        <p style="font-weight: bold;">{{$flight->carrierCode}}-{{$flight->number}}</p>
                                                                        <p>{{ $flightData->travelerPricings[$loop->parent->index]->fareDetailsBySegment[$loop->index]->cabin ?? "" }}</p>
                                                                    </td>
                                                                    <td class="text-center align-middle">
                                                                        <h4>{{$flight->departure->iataCode}} <small>({{findCityName($flight->departure->iataCode)}})</small></h4>
                                                                        <p style="white-space: nowrap;"><time class="">{{$flight->departure->at}}</time></p>
                                                                        <p><small style="font-size: 10px;">{{ findAirportName($flight->departure->iataCode)}}</small></p>
                                                                    </td>
                                                                    <td class="text-center align-middle">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="airplan">
                                                                                <div class="d-flex align-items-center">
                                                                                    <i style="font-size: 2em;" class="la la-plane-departure mb-3"></i>
                                                                                    <div class="line"></div>
                                                                                    <i style="font-size: 2em;" class="la la-plane-arrival  mb-3"></i>
                                                                                </div>
                                                                                <p style="margin-top:-35px;font-size:13px">{{$flight->duration}}</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center align-middle">
                                                                        <h4>{{$flight->arrival->iataCode}} <small>({{findCityName($flight->arrival->iataCode)}})</small></h4>
                                                                        <p style="white-space: nowrap;">{{$flight->arrival->at}}</p>
                                                                        <p><small style="font-size: 10px;">{{ findAirportName($flight->arrival->iataCode)}}</small></p>
                                                                    </td>
                                                                    <td class="text-center align-middle">
                                                                        <div class="d-flex">
                                                                            <div class="suitecase text-center me-1">
                                                                                <i style="font-size: 1.5rem;" class="la la-suitcase"></i>
                                                                                <p style="font-size:12px;">{{ $flightData->travelerPricings[$loop->parent->index]->fareDetailsBySegment[$loop->index]->includedCheckedBags->weight ?? "0" }} {{ $flightData->travelerPricings[$loop->parent->index]->fareDetailsBySegment[$loop->index]->includedCheckedBags->weightUnit ?? "" }}</p>
                                                                            </div>
                                                                            <div class="handcarry text-center">
                                                                                <i style="font-size: 1.5rem;" class="la la-shopping-bag"></i>
                                                                                <p style="font-size:12px;">1Bag</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                @php
                                                                $oldDate = $flight->arrival->at;
                                                                @endphp
                                                                @endforeach
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p class="text-center">Terms & Conditions</p>
                                                        <p class="termtext">The following terms and conditions should be read carefully.</p>
                                                        <p class="termtext">1)Check-in counters open 3 hours prior to flight departure and close 1 hour prior to flight departure. If you fail to report on time you may be denied boarding.</p>
                                                        <p class="termtext">2)The passenger's name(s) should be checked as per their passport/identity proof, departure and arrival dates, times, flight number, terminal, and baggage information.</p>
                                                        <p class="termtext">3) When traveling internationally, please confirm your travel documentation requirements with your airline or relevant Embassy, such as your passport, visa, and ok to board.</p>
                                                        <p class="termtext">4)Some countries may impose local taxes (VAT, tourist tax, etc.) that must be paid locally.</p>
                                                        <p class="termtext">5) We are not responsible for schedule changes or flight cancellations by the airline before or after tickets are issued.</p>
                                                        <p class="termtext">6) We cannot be held liable for any loss, damage or mishap to the traveler's or his/her belongings due to accident, theft or other unforeseeable circumstances.</p>
                                                        <p class="termtext">7)Booking amendments will be subject to the airline's terms and conditions, including penalties, fare difference, and availability.</p>
                                                        <p class="termtext">8)A cancellation or refund of a booking will be handled on a case-by-case basis depending on the airline and agency policies.</p>
                                                        <p class="termtext">9)Should you need amendments, cancellations, or ancillary services, contact your travel partner.</p>
                                                        <p class="text-center">Bon Voyage!</p>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p class="termtext">
                                                                CUSTOMER SERVICE <br>
                                                                FRA: 0187653786 <br>
                                                                UK: 00448007074285 <br>
                                                                USA: 0018143008040
                                                            </p>
                                                            <p>
                                                                www.gondaltravel.com
                                                            </p>
                                                            <p class="termtext">
                                                                BOOKING PARTNER<br>
                                                                MAIN OFFICE <br>
                                                                OFFICE PHONE: <br>
                                                                0033187653786 <br>
                                                                hello@gondaltravel.com
                                                            </p>
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
                </div>
            </div>
        </div>
    </div>
</section>
@endsection