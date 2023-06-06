@extends('layouts.app')
@section('title')
{{$booking->pnr}} {{$booking->passengers[0]->firstname}} {{$booking->passengers[0]->lastname}}
@endsection
@section('head')
<style>
    .termtext {
        font-size: 10px;
        margin: 0 !important;
        line-height: 1.5;
    }

    .line {
        width: 70px;
        height: 5px;
    }

    .print {
        max-width: 210mm;
        min-height: 297mm;
    }

    @media print {
        header {
            display: none;
            margin-bottom: 0;
        }

        .print {
            position: absolute;
            top: 0;
        }

    }
</style>
@endsection
@section('content')
<section class="payment-area section-bg section-padding">
    <div class="">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center" id="">
                <div class="form-box mb-0 print">
                    <div class="form-content pb-0">
                        <div class="payment-received-list">
                            <div class="mt-2 mb-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="brand-area d-flex justify-content-around">
                                            <div class="col-md-4">
                                                <img style="filter: grayscale(100%);" src="{{ asset('assets/img/logo.png') }}" width="200" alt="Logo">
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <h6>@foreach($flightData->itineraries as $segments)

                                                    {{ findCityName($segments->segments[0]->departure->iataCode) }}

                                                    @endforeach
                                                    -
                                                    @foreach($flightData->itineraries as $segments)

                                                    {{ findCityName(end($segments->segments)->arrival->iataCode) }}


                                                    @endforeach
                                                </h6>
                                            </div>
                                            <div class="col-md-4 text-end">
                                                <h5>PNR: {{$booking->pnr}}</h5>
                                                <!-- <h5>CONFIRMED: 546543</h5> -->
                                            </div>
                                        </div>
                                        <hr class="my-2">
                                        <div class="col-md-12">
                                            <div class="passenger my-2">
                                                <div>
                                                    <span class="name">Passenger's Name</span>
                                                </div>
                                                <div class="row">
                                                    @foreach ($booking->passengers as $passenger)
                                                    <div class="col-6">
                                                        <span style="display: inline-block; width: 20px; height: 20px; line-height: 20px; text-align: center; border-radius: 50%; background-color: #ddd; color: #000; font-weight: bold; margin-right: 10px;">
                                                            {{ $loop->iteration }}
                                                        </span>
                                                        <span>{{ $passenger->title }}</span> {{ $passenger->firstname }} {{ $passenger->lastname }} <small style="font-size:10px;"><sup class="text-uppercase"> {{ $passenger->type }}</sup></small>
                                                        @if($passenger->etkt != "")
                                                        </br>
                                                        <span class="ms-5">
                                                            ETKT: {{$passenger->etkt}}
                                                        </span>
                                                        @endif
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
                                                            $fareDetailsBySegment = 0;
                                                            @endphp
                                                            @foreach($flightData->itineraries as $segments)
                                                            @if(count($flightData->itineraries) > 1 && $loop->index != 0)
                                                            <tr>
                                                                <td colspan="6">
                                                                    <div class="text-center">
                                                                        @if ($booking->trip_type == 'return')
                                                                        <b><span style="font-size: 20px;">Return Ticket</span></b>
                                                                        @else
                                                                        <b><span style="font-size: 20px;">Next Departure</span></b>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @endif
                                                            @foreach($segments->segments as $flight)
                                                            @if($oldDate != "" && count($flightData->itineraries) > 0 && $loop->index != 0)
                                                            <tr>
                                                                <td colspan="6">
                                                                    <div class="text-center">
                                                                        Layover in {{ findCityName($flight->departure->iataCode) }} {{ getConnectingTime($oldDate,$flight->departure->at) }}
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @endif
                                                            <tr>
                                                                <td class="text-center align-middle">
                                                                    <p style="font-weight: bold;white-space: nowrap;">{{ str()->limit(findAirlineName($flight->carrierCode),10)}}</p>
                                                                    <p style="font-weight: bold;">{{$flight->carrierCode}}-{{$flight->number}}</p>
                                                                    <p>{{ $flightData->travelerPricings[0]->fareDetailsBySegment[0]->cabin ?? "" }} {{ $flightData->travelerPricings[0]->fareDetailsBySegment[$fareDetailsBySegment]->class ?? "" }}</p>
                                                                </td>
                                                                <td class="text-center align-middle">
                                                                    <p class="font-weight: bold;white-space: nowrap;"><b>{{$flight->departure->iataCode}} <small>({{findCityName($flight->departure->iataCode)}})</b></small></p>
                                                                    <p style="white-space: nowrap;"><time class=""><b>{{getFullDate($flight->departure->at)}}</b></time></p>
                                                                    <p><small style="font-size: 10px;"><b>{{ str()->limit(findAirportName($flight->departure->iataCode),17)}} Terminal-{{ $flight->departure->terminal ?? "" }}</b></small></p>
                                                                </td>
                                                                <td class="text-center align-middle">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="airplan">
                                                                            <div class="d-flex align-items-center">
                                                                                <i style="font-size: 2em;" class="la la-plane-departure m-2"></i>
                                                                                <div class="line"></div>
                                                                                <i style="font-size: 2em;" class="la la-plane-arrival  m-2"></i>
                                                                            </div>
                                                                            <p style="margin-top:-35px;font-size:13px">{{getDuration($flight->duration)}}</p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center align-middle">
                                                                    <p class="font-weight: bold;white-space: nowrap;"><b>{{$flight->arrival->iataCode}} <small>({{findCityName($flight->arrival->iataCode)}})</b></small></p>
                                                                    <p style="white-space: nowrap;"><b>{{getFullDate($flight->arrival->at)}}</b></p>
                                                                    <p><small style="font-size: 10px;"><b>{{ str()->limit(findAirportName($flight->arrival->iataCode),17)}} Terminal-{{ $flight->arrival->terminal ?? "" }}</b></small></p>
                                                                </td>
                                                                <td class="text-center align-middle">
                                                                    <div class="d-flex">
                                                                        <div class="suitecase text-center me-1">
                                                                            <i style="font-size: 1.5rem;" class="la la-suitcase"></i>
                                                                            <p style="font-size:12px;">{{ getWeight($booking,$flightData->travelerPricings[0]->fareDetailsBySegment[$loop->index]->includedCheckedBags) }}</p>
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
                                                            $fareDetailsBySegment++;
                                                            @endphp
                                                            @endforeach
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mt-4 pb-3">
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
</section>
@endsection