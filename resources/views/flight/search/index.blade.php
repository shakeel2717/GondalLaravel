@extends('layouts.app')
@section('head')
<script src="{{ asset('assets/theme/js/mixitup.min.js') }}"></script>
<script src="{{ asset('assets/theme/js/mixitup-pagination.min.js') }}"></script>
<script src="{{ asset('assets/theme/js/mixitup-multifilter.min.js') }}"></script>
<script src="{{ asset('assets/theme/js/plugins/ion.rangeSlider.min.js') }}"></script>
@endsection
@section('content')
@include('inc.search-nav')
<main class="cd-main-content container mt-3">
    <div class="row g-3">
        @include('inc.filter-bar')
        <div class="col-md-9">
            <section data-ref="container" id="data">
                <div class="flight-search-box mb-3" id="flightSearchBox">
                    @include('inc.search-box')
                </div>
                <div class="next-date-panel mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                @if ($data['trip_type'] == "return")
                                <a href="{{ route('flight.search.return', $data['backDayRoute'] ) }}" class="btn btn-primary">Check in Previews Date <i class="la la-angle-right"></i></a>
                                <a href="{{ route('flight.search.return', $data['nextDayRoute'] ) }}" class="btn btn-primary">Check in Next Date <i class="la la-angle-right"></i></a>
                                @else
                                <a href="{{ route('flight.search.oneway', $data['backDayRoute'] ) }}" class="btn btn-primary">Check in Previews Date <i class="la la-angle-right"></i></a>
                                <a href="{{ route('flight.search.oneway', $data['nextDayRoute'] ) }}" class="btn btn-primary">Check in Next Date <i class="la la-angle-right"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="catalog-panel">
                    @foreach ($allFlights as $flight)
                    <li class="mix all qr oneway_1" data-a="503" data-b="" data-price="{{ $flight['price']['grandTotal'] }}" data-stops="{{ count($flight['itineraries'][0]['segments']) -1 }}" data-flights="{{ $flight['validatingAirlineCodes'][0] }}">
                        <div class="theme-search-results-item _mb-10 theme-search-results-item-rounded theme-search-results-item-">
                            <div class="row g-0">
                                <div class="col-md-10">
                                    @foreach ($flight['itineraries'] as $itineraries)
                                    <div class="theme-search-results-item-preview">
                                        <div class="theme-search-results-item-mask-link" data-bs-toggle="collapse" href="#searchResultsItem-{{ $loop->parent->index }}" role="button"></div>
                                        <div class="row" data-gutter="20">
                                            <span class="module_color" data-bs-toggle="tooltip" data-bs-placement="top" title="Module Color" style="background:#005eb8;top: 10px;left:10px"></span>
                                            <div class="col-md-12">
                                                <div class="theme-search-results-item-flight-sections">
                                                    <div class="theme-search-results-item-flight-section">
                                                        <div class="row-no-gutter row-eq-height row">
                                                            <div class="col-md-2 col-12">
                                                                <div class="theme-search-results-item-flight-section-airline-logo-wrap" style="border-radius: 5px;">
                                                                    @php
                                                                    $flightCode = $itineraries['segments'][0]['carrierCode'];
                                                                    @endphp
                                                                    <h5 class="theme-search-results-item-flight-section-airline-title" style="margin-top:3px">{{ findAirlineName($flightCode) }}</h5>
                                                                    <img class="theme-search-results-item-flight-section-airline-logo lazyload" style="background:transparent" data-src="https://assets.kplus.com.tr/images/airline/180x60/logo_{{$flightCode }}.png">
                                                                    <h5 class="theme-search-results-item-flight-section-airline-title" style="margin-top:44px"><strong>{{ $flightCode }} - {{ $itineraries['segments'][0]['number'] }} ({{ $flight['travelerPricings'][0]['fareDetailsBySegment'][$loop->index]['class'] ?? "0" }})</strong></h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8 col-12">
                                                                <div class="theme-search-results-item-flight-section-item">
                                                                    <div class="row">
                                                                        <div class="col-md-3 col-3">
                                                                            <div class="theme-search-results-item-flight-section-meta">
                                                                                <p class="theme-search-results-item-flight-section-meta-time">{{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s', $itineraries['segments'][0]['departure']['at'])->format('H:i') }} {{ $itineraries['segments'][0]['departure']['iataCode'] }}</p>
                                                                                <p class="theme-search-results-item-flight-section-meta-time text-primary">{{ findCityName($itineraries['segments'][0]['departure']['iataCode']) }}</p>
                                                                                <p class="theme-search-results-item-flight-section-meta-date">{{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s', $itineraries['segments'][0]['departure']['at'])->format('d M Y') }}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-6 g-0">
                                                                            <div class="theme-search-results-item-flight-section-path">
                                                                                <div class="theme-search-results-item-flight-section-path-fly-time">
                                                                                    <p><strong>Duration {{ getDuration($itineraries['segments'][0]['duration']) }}</strong></p>
                                                                                </div>
                                                                                <div class="theme-search-results-item-flight-section-path-line"></div>
                                                                                <div class="theme-search-results-item-flight-section-path-line-start">
                                                                                    <i class="la la-plane-departure theme-search-results-item-flight-section-path-icon"></i>
                                                                                    <div class="theme-search-results-item-flight-section-path-line-dot"></div>
                                                                                    <div class="theme-search-results-item-flight-section-path-line-title">{{ $itineraries['segments'][0]['departure']['iataCode'] }}</div>
                                                                                </div>
                                                                                <div class="theme-search-results-item-flight-section-path-line-middle">
                                                                                    <div class="theme-search-results-item-flight-section-path-line-title" style="margin-top:35px;color:#000;font-weight:bold;width:40px">
                                                                                        <strong>Stops {{ count($itineraries['segments'])-1 }}</strong>

                                                                                    </div>
                                                                                </div>
                                                                                <div class="theme-search-results-item-flight-section-path-line-end">
                                                                                    <i class="la la-plane-arrival theme-search-results-item-flight-section-path-icon"></i>
                                                                                    <div class="theme-search-results-item-flight-section-path-line-dot"></div>
                                                                                    <div class="theme-search-results-item-flight-section-path-line-title">{{ end($itineraries['segments'])['arrival']['iataCode'] }}</div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3 col-3">
                                                                            <div class="theme-search-results-item-flight-section-meta">
                                                                                <p class="theme-search-results-item-flight-section-meta-time">{{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s', end($itineraries['segments'])['arrival']['at'])->format('H:i') }} {{ end($itineraries['segments'])['arrival']['iataCode'] }}</p>
                                                                                <p class="theme-search-results-item-flight-section-meta-time text-primary">{{ findCityName(end($itineraries['segments'])['arrival']['iataCode']) }}</p>
                                                                                <p class="theme-search-results-item-flight-section-meta-date">{{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s', end($itineraries['segments'])['arrival']['at'])->format('d M Y') }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="text-center">
                                                                            <p class="" style="font-size:10px">Connecting Time: <span class="connectingTime{{ $loop->parent->index }}" id="connectingTime{{ $loop->parent->index }}"></span></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-12">
                                                                <div class="">
                                                                    <p class="d-flex align-items-center" style="gap:6px"><img src="{{ asset('assets/img/seat.png') }}" width="20" alt="Seat"> {{ $flight['numberOfBookableSeats'] }} </p>
                                                                    <p class="d-flex align-items-center" style="gap:6px"><i style="font-size:22px" class="la la-passport"></i> {{ $flight['travelerPricings'][0]['fareDetailsBySegment'][0]['cabin'] ?? "0" }} </p>
                                                                    <p class="d-flex align-items-center" style="gap:6px"><i style="font-size:22px" class="la la-suitcase-rolling"></i>
                                                                        {{ $flight['travelerPricings'][0]['fareDetailsBySegment'][0]['includedCheckedBags']['weight'] ?? "0" }} {{ $flight['travelerPricings'][0]['fareDetailsBySegment'][0]['includedCheckedBags']['weightUnit'] ?? "0" }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="collapse theme-search-results-item-collapse" id="searchResultsItem-{{ $loop->index }}">
                                        <div class="theme-search-results-item-extend">
                                            <div class="theme-search-results-item-extend-close" data-bs-toggle="collapse" href="#searchResultsItem-0" role="button">&#10005;</div>
                                            @php
                                            $oldDate = "";
                                            @endphp
                                            @foreach ($flight['itineraries'] as $itineraries)
                                            @foreach($itineraries['segments'] as $segment)
                                            @if($oldDate != "")
                                            <div class="text-center">
                                                Connecting Time: {{ getConnectingTime($oldDate,$segment['departure']['at']) }}
                                                <input type="hidden" id="getConnectingTime{{ $loop->parent->parent->index }}" value="{{ getConnectingTime($oldDate,$segment['departure']['at']) }}">
                                            </div>
                                            @endif
                                            <div class="theme-search-results-item-extend-inner">
                                                <div class="theme-search-results-item-flight-detail-items">
                                                    <div class="theme-search-results-item-flight-details">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div style="display: nonee;" class="theme-search-results-item-flight-details-info p-3">
                                                                    <h5 class="theme-search-results-item-flight-details-info-title">From</h5>
                                                                    <p class="theme-search-results-item-flight-details-info-date">{{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s', $segment['departure']['at'])->format('d M Y') }}</p>
                                                                    <p class="theme-search-results-item-flight-details-info-cities">{{ $segment['departure']['iataCode'] }}</p>
                                                                    <p class="theme-search-results-item-flight-details-info-fly-time">{{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s', $segment['departure']['at'])->format('h:i A') }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="theme-search-results-item-flight-details-schedule">
                                                                    <ul class="theme-search-results-item-flight-details-schedule-list">
                                                                        <li>
                                                                            <i class="la la-plane theme-search-results-item-flight-details-schedule-icon"></i>
                                                                            <div class="theme-search-results-item-flight-details-schedule-dots"></div>
                                                                            <p class="theme-search-results-item-flight-details-schedule-date">To {{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s', $segment['arrival']['at'])->format('d M Y') }}</p>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <div class="theme-search-results-item-flight-details-schedule-time">
                                                                                        <span class="theme-search-results-item-flight-details-schedule-time-item">
                                                                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s', $segment['departure']['at'])->format('h:i A') }}
                                                                                        </span>
                                                                                        <span class="theme-search-results-item-flight-details-schedule-time-separator">-</span>
                                                                                        <span class="theme-search-results-item-flight-details-schedule-time-item">
                                                                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s', $segment['arrival']['at'])->format('h:i A') }}
                                                                                        </span>
                                                                                    </div>

                                                                                    <div class="theme-search-results-item-flight-details-schedule-destination">
                                                                                        <div class="theme-search-results-item-flight-details-schedule-destination-item">
                                                                                            <p class="theme-search-results-item-flight-details-schedule-destination-title">
                                                                                                <b>{{ $segment['departure']['iataCode'] }}</b> {{ $segment['departure']['iataCode'] }}
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="theme-search-results-item-flight-details-schedule-destination-separator">
                                                                                            <span>&#8594;</span>
                                                                                        </div>
                                                                                        <div class="theme-search-results-item-flight-details-schedule-destination-item">
                                                                                            <p class="theme-search-results-item-flight-details-schedule-destination-title">
                                                                                                <b>{{ $segment['arrival']['iataCode'] }}</b> {{ $segment['arrival']['iataCode'] }}
                                                                                            </p>
                                                                                            <p class="theme-search-results-item-flight-details-schedule-destination-city"></p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <ul class="theme-search-results-item-flight-details-schedule-features">
                                                                                        <li>{{ $segment['carrierCode'] }}</li>
                                                                                    </ul>
                                                                                </div>

                                                                                <div class="col-6 flight_desc">
                                                                                    <p class="d-flex align-items-center" style="gap:6px"><i style="font-size:22px" class="la la-passport"></i> <strong>Flight Class</strong> {{ $flight['travelerPricings'][0]['fareDetailsBySegment'][0]['cabin'] }} {{ $flight['travelerPricings'][0]['fareDetailsBySegment'][$loop->index]['class'] ?? "0" }}</p>
                                                                                    <p class="d-flex align-items-center" style="gap:6px"><i style="font-size:20px" class="la la-history"></i> <strong> Trip Duration </strong> {{ getDuration($itineraries['segments'][0]['duration']) }} </p>

                                                                                    <p class="d-flex align-items-center" style="gap:6px"><i style="font-size:22px" class="la la-suitcase-rolling"></i> <strong>Baggage </strong> {{ $flight['travelerPricings'][0]['fareDetailsBySegment'][0]['includedCheckedBags']['weight'] ?? "0" }} {{ $flight['travelerPricings'][0]['fareDetailsBySegment'][0]['includedCheckedBags']['weightUnit'] ?? "KG" }} </p>
                                                                                    <hr>
                                                                                    <p> </p>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                            $oldDate = $segment['arrival']['at'];
                                            @endphp
                                            @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    @csrf
                                    <div class="theme-search-results-item-book row">
                                        <form action="{{ route('flight.search.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="routes" id="routes" value="{{ json_encode($flight) }}">
                                            <input type="hidden" name="amount" value="{{ $flight['price']['grandTotal'] }}">
                                            <input type="hidden" name="currency" value="{{ $flight['price']['currency'] }}">
                                            <input type="hidden" name="adult" value="{{ $data['adult'] }}">
                                            <input type="hidden" name="children" value="{{ $data['children'] }}">
                                            <input type="hidden" name="infant" value="{{ $data['infant'] }}">
                                            <input type="hidden" name="trip_type" value="{{ $data['trip_type'] }}">
                                            <button type="submit" class="btn btn-block theme-search-results-item-price-btn ladda" data-style="zoom-in">
                                                <strong>{{ $flight['price']['currency'] }} {{ $flight['price']['grandTotal'] }}</strong>
                                                <span class="btn btn-primary">Book Now <i class="la la-angle-right"></i></span>
                                            </button>
                                        </form>
                                        <div class="d-flex justify-content-center">
                                            <p class="d-flex align-items-center" style="gap:6px"><a onclick="copyData('HI')" href="javascript:;"><i style="font-size:22px" class="las la-clipboard"></i>Copy</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </section>
        </div>
    </div>
</main>
@endsection
@section('footer')
<script>
    var priceRange = document.getElementById("priceRange");
    var listItemsByPrice = document.querySelectorAll('li[data-price]');
    var currentFilterRangePrice = document.getElementById("currentFilterRangePrice");
    currentFilterRangePrice.textContent = parseFloat(priceRange.value);
    priceRange.addEventListener('change', function() {
        listItemsByPrice.forEach(function(item) {
            var itemPrice = parseFloat(item.getAttribute('data-price'));
            currentFilterRangePrice.textContent = parseFloat(priceRange.value);
            if (itemPrice <= parseFloat(priceRange.value)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });

    function changeStop(stops) {
        var listItemsByPrice = document.querySelectorAll('li[data-stops]');
        if (stops == "all") {
            listItemsByPrice.forEach(function(item) {
                var currentStop = parseFloat(item.getAttribute('data-stops'));
                item.style.display = 'block';
            });
        } else {
            listItemsByPrice.forEach(function(item) {
                var currentStop = parseFloat(item.getAttribute('data-stops'));
                if (currentStop == stops) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    }


    function filterListItems() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var listItems = document.querySelectorAll('li[data-flights]');

        console.log("Checkboxes:", checkboxes);
        console.log("List items:", listItems);

        var selectedFlights = [];

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                selectedFlights.push(checkbox.value);
                console.log("Selected:", checkbox.value);
            }
        });

        console.log("Selected flights:", selectedFlights);

        listItems.forEach(function(item) {
            var dataFlights = item.getAttribute('data-flights');

            console.log("List item data-flights:", dataFlights);

            if (selectedFlights.length === 0) {
                item.style.display = 'block'; // Show the list item
                console.log("Showing list item:", item);
            } else {
                if (selectedFlights.includes(dataFlights)) {
                    item.style.display = 'block'; // Show the list item
                    console.log("Showing list item:", item);
                } else {
                    item.style.display = 'none'; // Hide the list item
                    console.log("Hiding list item:", item);
                }
            }
        });
    }
</script>

<script>
    // var connectingTime1 = document.getElementById("getConnectingTime1").value;
    // document.getElementById("connectingTime1").textContent = connectingTime1;
    var totalFlights = <?php echo count($allFlights); ?>;
    for (var i = 0; i <= totalFlights; i++) {
        var connectingTimeId = "getConnectingTime" + i;
        var connectingTimeValue = document.getElementById(connectingTimeId).value;
        var connectingTimeSpanId = "connectingTime" + i;
        document.getElementById(connectingTimeSpanId).textContent = connectingTimeValue;
    }
</script>
<script>
    function copyData(data) {
        var tempInput = document.createElement("input");
        tempInput.value = data;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
    }
</script>
<script>
    document.getElementById("flightSearchBox").style.display = "none";
</script>


@endsection