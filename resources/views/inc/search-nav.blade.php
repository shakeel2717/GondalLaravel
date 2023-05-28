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
</section>