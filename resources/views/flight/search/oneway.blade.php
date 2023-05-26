@extends('layouts.app')
@section('head')
<script src="{{ asset('assets/theme/js/mixitup.min.js') }}"></script>
<script src="{{ asset('assets/theme/js/mixitup-pagination.min.js') }}"></script>
<script src="{{ asset('assets/theme/js/mixitup-multifilter.min.js') }}"></script>
<script src="{{ asset('assets/theme/js/plugins/ion.rangeSlider.min.js') }}"></script>
@endsection
@section('content')
<section class="breadcrumb-area bread-bg-flights">
    <div class="breadcrumb-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="breadcrumb-content">
                        <div class="section-heading">
                            <div class="left-side-info rtl-align-right" style="color:#fff">
                                <span>
                                    <strong style="text-transform: capitalize">
                                        <h2 class="sec__title_list">{{ $data['from'] }} <i class="la la-arrow-right"></i> {{ $data['to'] }}</h2>
                                    </strong>
                                </span>
                                <div>

                                    <!-- SHOW DATES -->
                                    <p><strong>Dates</strong>({{ $data['departure'] }})</p>

                                    <p><strong>Adults</strong> {{ $data['adult'] }} <strong>Childs</strong> {{ $data['children'] }} <strong>Infants</strong> {{ $data['infant'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="breadcrumb-list d-flex gap-2 accordion">
                        <ul class="list-items d-flex justify-content-end d-none d-sm-block">
                            <li class="d-flex justify-content-center align-items-center h-100"><a href="javascript:void(0)"><i class="la la-plane mx-1"></i> Total Flights : {{ count($allFlights) }}</a></li>
                        </ul>
                        <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="accordion-button btn btn-outline-light w-100">Modify Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb-wrap -->
</section>
<main class="cd-main-content container mt-3">
    <div class="row g-3">
        <div class="col-md-3 d-sm-block search_filter_options" id="fadein" style="display: none">
            <div class="sticky-top">
                <form>
                    <div class="card-header">
                        <strong>Modify Search</strong>
                    </div>
                    <div class="sidebar mt-0">
                        <div class="sidebar-widget">
                            <div class="sidebar-widget-item">
                                <div class="contact-form-action">
                                    <div class="sidebar-widget">
                                        <div class="sidebar-box">
                                            <h3 class="title stroke-shape">Flight Stops</h3>
                                            <div class="box-content">
                                                <fieldset data-filter-group>
                                                    <ul class="list remove_duplication">
                                                        <li>
                                                            <div class="form-check">
                                                                <input class="form-check-input filter" type="radio" name="type" id="all" checked="" value="all" onchange="changeStop('all')">
                                                                <label class="form-check-label" for="all"> All Flights</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check">
                                                                <input class="form-check-input filter" type="radio" name="type" id="directFlight" value="0" onchange="changeStop(0)">
                                                                <label class="form-check-label" for="directFlight"> Direct</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check">
                                                                <input class="form-check-input filter" type="radio" name="type" id="singleStop" value="1" onchange="changeStop(1)">
                                                                <label class="form-check-label" for="singleStop"> Stops 1</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check">
                                                                <input class="form-check-input filter" type="radio" name="type" id="doubleStop" value="2" onchange="changeStop(2)">
                                                                <label class="form-check-label" for="doubleStop"> Stops 2</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </fieldset>
                                                <!-- cd-filter-content -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sidebar-widget controls">
                                        <h3 class="title stroke-shape">Price Range</h3>
                                        <div class="sidebar-price-range">
                                            <input type="range" class="form-range" min="{{ $data['minPrice'] }}" max="{{ $data['maxPrice'] }}" step="10" id="priceRange" value="{{ $data['maxPrice'] }}">
                                            <small>Maximum <span id="currentFilterRangePrice"></span></small>
                                        </div>
                                    </div>
                                    <fieldset data-filter-group>
                                        <div class="sidebar-box mb-4 controls">
                                            <h3 class="title stroke-shape" style="text-transform:capitalize">Airlines</h3>
                                            <ul class="list remove_duplication checkbox-group">
                                                @foreach ($data['flightsFilters'] as $flightsFilter)
                                                <li>
                                                    <div class="custom-checkbox flights_line">
                                                        <input class="filter" type="checkbox" id="{{ $loop->iteration }}" value="{{ $flightsFilter }}" onchange="filterListItems()">
                                                        <label for="{{ $loop->iteration }}"> <img class="lazyload" data-src="{{ asset('assets/airlines/'.$flightsFilter.'.png') }}" style="background:transparent;max-width:20px;padding-top:0px;margin: 0 6px" />{{ $flightsFilter }}</label>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <!-- end sidebar-widget-item -->
                        </div>
                        <!-- end sidebar-widget -->
                    </div>
                    <!-- end sidebar -->
                </form>

            </div>
            <!-- cd-filter -->
        </div>

        <!-- cd-filter -->
        <div class="col-md-9">
            <section data-ref="container" id="data">
                <ul class="catalog-panel">
                    @foreach ($allFlights as $flight)
                    <li class="mix all qr oneway_1" data-a="503" data-b="" data-price="{{ $flight['price']['grandTotal'] }}" data-stops="{{ count($flight['itineraries'][0]['segments']) -1 }}" data-flights="{{ $flight['validatingAirlineCodes'][0] }}">
                        <div class="theme-search-results-item _mb-10 theme-search-results-item-rounded theme-search-results-item-">
                            <form class="row" action="#" name="" method="post">
                                <input name="routes" type="hidden" value="">
                                <input name="prices" type="hidden" value="">
                                <input name="travelers" type="hidden" value="">
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
                                                                        <h5 class="theme-search-results-item-flight-section-airline-title" style="margin-top:3px">{{ $flightCode }}</h5>
                                                                        <img class="theme-search-results-item-flight-section-airline-logo lazyload" style="background:transparent" data-src="{{ asset('assets/airlines/'.$flightCode.'.png') }}">
                                                                        <h5 class="theme-search-results-item-flight-section-airline-title" style="margin-top:44px"><strong>{{ $itineraries['segments'][0]['number'] }}</strong></h5>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-10 col-12">
                                                                    <div class="theme-search-results-item-flight-section-item">
                                                                        <div class="row">
                                                                            <div class="col-md-3 col-3">
                                                                                <div class="theme-search-results-item-flight-section-meta">
                                                                                    <p class="theme-search-results-item-flight-section-meta-time">{{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s', $itineraries['segments'][0]['departure']['at'])->format('h:i A') }}</p>
                                                                                    <p class="theme-search-results-item-flight-section-meta-city">{{ $itineraries['segments'][0]['departure']['iataCode'] }}</p>
                                                                                    <p class="theme-search-results-item-flight-section-meta-date">{{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s', $itineraries['segments'][0]['departure']['at'])->format('d M Y') }}</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-6 g-0">
                                                                                <div class="theme-search-results-item-flight-section-path">
                                                                                    <div class="theme-search-results-item-flight-section-path-fly-time">
                                                                                        @php
                                                                                        $interval = new DateInterval($itineraries['segments'][0]['duration']);
                                                                                        $hours = $interval->h;
                                                                                        $minutes = $interval->i;

                                                                                        $totalMinutes = ($hours * 60) + $minutes;
                                                                                        $tripDuration = sprintf("%02d:%02d Hours", floor($totalMinutes / 60), $totalMinutes % 60);
                                                                                        @endphp
                                                                                        <p><strong>Trip Duration {{ $tripDuration }}</strong></p>
                                                                                    </div>
                                                                                    <div class="theme-search-results-item-flight-section-path-line"></div>
                                                                                    <div class="theme-search-results-item-flight-section-path-line-start">
                                                                                        <i class="la la-plane-departure theme-search-results-item-flight-section-path-icon"></i>
                                                                                        <div class="theme-search-results-item-flight-section-path-line-dot"></div>
                                                                                        <div class="theme-search-results-item-flight-section-path-line-title">{{ $itineraries['segments'][0]['departure']['iataCode'] }}</div>
                                                                                    </div>
                                                                                    <div class="theme-search-results-item-flight-section-path-line-middle">
                                                                                        <!--<i class="fa fa-plane theme-search-results-item-flight-section-path-icon"></i>
                                                                                                    <div class="theme-search-results-item-flight-section-path-line-dot"></div>-->
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
                                                                                    <p class="theme-search-results-item-flight-section-meta-time">{{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s', $itineraries['segments'][0]['arrival']['at'])->format('h:i A') }}</p>
                                                                                    <p class="theme-search-results-item-flight-section-meta-city">{{ end($itineraries['segments'])['arrival']['iataCode'] }}</p>
                                                                                    <p class="theme-search-results-item-flight-section-meta-date">{{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s', $itineraries['segments'][0]['arrival']['at'])->format('d M Y') }}</p>
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
                                        @endforeach
                                        <div class="collapse theme-search-results-item-collapse" id="searchResultsItem-{{ $loop->index }}">
                                            <div class="theme-search-results-item-extend">
                                                <div class="theme-search-results-item-extend-close" data-bs-toggle="collapse" href="#searchResultsItem-0" role="button">&#10005;</div>
                                                @foreach ($flight['itineraries'] as $itineraries)
                                                @foreach($itineraries['segments'] as $segment)
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
                                                                                        <p class="d-flex align-items-center" style="gap:6px"><i style="font-size:22px" class="la la-passport"></i> <strong>Flight Class</strong> {{ $flight['travelerPricings'][0]['fareDetailsBySegment'][0]['cabin'] }} </p>
                                                                                        <p class="d-flex align-items-center" style="gap:6px"><i style="font-size:20px" class="la la-history"></i> <strong> Trip Duration </strong> {{ $tripDuration }} </p>

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
                                                @endforeach
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">

                                        <div class="theme-search-results-item-book row">
                                            <!--<div class="theme-search-results-item-price">
                                            <p class="theme-search-results-item-price-sign">ECONOMY</p>
                                        </div>-->

                                            <button type="submit" class="btn btn-block theme-search-results-item-price-btn ladda" data-style="zoom-in">
                                                <strong>{{ $flight['price']['currency'] }} {{ $flight['price']['grandTotal'] }}</strong>
                                                <span class="btn btn-primary">Book Now <i class="la la-angle-right"></i></span>
                                            </button>
                                            <!--<p><small style="display: inline-block; line-height: 18px; font-size: 10px;" class="text-danger">Only registered users can book</small></p>-->
                                            <!--<button type="submit" data-bs-toggle="collapse" href="#searchResultsItem-0" class="btn btn-default btn-block btn-sm">Details</button>-->
                                        </div>
                                    </div>
                                </div>

                            </form>
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



@endsection