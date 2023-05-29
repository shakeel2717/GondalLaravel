<div id="fadein">
    <form autocomplete="off" class="main_search">
        <div class="row mb-3 g-1" style="justify-content: space-between;">
            <div class="col-md-8 flight_types">
                <div class="row">
                    <div class="d-flex justify-content-start gap-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="trip" id="one-way" onclick="oneway();" value="oneway" checked>
                            <label class="form-check-label" for="one-way">One Way</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="trip" id="round-trip" value="return">
                            <label class="form-check-label" for="round-trip"> Round Trip</label>
                        </div>
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
                                <input class="form-control autocomplete-airport" type="search" placeholder="Flying From" name="from" id="autocomplete" value="{{ old('from', (isset($data['from'])) ? $data['from'] : '' ) }}">
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
                                <input class="form-control autocomplete-airport focus px-5" type="search" placeholder="To Destination" name="to" id="autocomplete2" value="{{ old('to', (isset($data['to'])) ? $data['to'] : '' ) }}">
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
                                <input class="depart form-control" id="departure" name="depart" type="text" value="{{ old('depart', (isset($data['depart'])) ? $data['depart'] : now()->addDays(8)->format('d-m-Y') ) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col" id="show">
                        <div class="input-box">
                            <label class="label-text">Return Date</label>
                            <div class="form-group">
                                <span class="la la-calendar form-icon"></span>
                                <input class="returning form-control dateright border-top-l0" name="returning" type="text" id="return" value="{{ old('returning', (isset($data['returning'])) ? $data['returning'] : now()->addDays(16)->format('d-m-Y') ) }}">
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
                                            <input type="text" name="adults" id="fadults" value="{{ old('adults', (isset($data['adults'])) ? $data['adults'] : 1 ) }}" class="qtyInput_flights">
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
                                            <input type="text" name="childs" id="fchilds" value="{{ old('childs', (isset($data['childs'])) ? $data['childs'] : 0 ) }}" class="qtyInput_flights">
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
                                            <input type="text" name="childs" id="finfant" value="{{ old('childs', (isset($data['childs'])) ? $data['childs'] : 0 ) }}" class="qtyInput_flights">
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
                                            <input class="form-control autocomplete-airport" type="search" placeholder="Flying From" name="from" id="autocomplete3" value="" >
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
                var actionURL = 'flight' + '/';

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