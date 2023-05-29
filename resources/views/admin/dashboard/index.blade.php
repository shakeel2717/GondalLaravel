@extends('layouts.app')
@section('content')
@include('inc.admin.nav')
<section class="dashboard-area">
    <div class="dashboard-content-wrap">

        <div class="dashboard-bread">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="breadcrumb-content">
                            <div class="section-heading">
                                <h2 class="sec__title font-size-30 text-white">Hi, <span style="text-transform:capitalize">{{ auth()->user()->name }}</span> Welcome Back</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="breadcrumb-list text-right">
                            <p style="font-weight:bold;color:#fff" id="ct">{{ now() }}</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-3 col-12 responsive-column-m user_wallet">
                        <div class="icon-box icon-layout-2 dashboard-icon-box">
                            <div class="d-flex">
                                <div class="info-icon icon-element flex-shrink-0">
                                    <i class="la la-wallet"></i>
                                </div>
                                <div class="info-content">
                                    <p class="info__desc">Wallet Balance</p>
                                    <h4 class="info__title">EUR {{ number_format(companyBalance(),2) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12 responsive-column-m">
                        <div class="icon-box icon-layout-2 dashboard-icon-box">
                            <div class="d-flex">
                                <div class="info-icon icon-element bg-2 flex-shrink-0">
                                    <i class="la la-shopping-cart"></i>
                                </div>
                                <div class="info-content">
                                    <p class="info__desc">Total Bookings</p>
                                    <h4 class="info__title">{{ totalBookings() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12 responsive-column-m">
                        <div class="icon-box icon-layout-2 dashboard-icon-box">
                            <div class="d-flex">
                                <div class="info-icon icon-element bg-4 flex-shrink-0">
                                    <i class="la la-star"></i>
                                </div>
                                <div class="info-content">
                                    <p class="info__desc">Total Ticket Sold</p>
                                    <h4 class="info__title">{{ number_format(totalTicketSold(),2) }} EUR</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12 responsive-column-m">
                        <div class="icon-box icon-layout-2 dashboard-icon-box">
                            <div class="d-flex">
                                <div class="info-icon icon-element bg-2 flex-shrink-0">
                                    <i class="la la-shopping-cart"></i>
                                </div>
                                <div class="info-content">
                                    <p class="info__desc">Total Receivable</p>
                                    <h4 class="info__title">{{ number_format(totalReceivable(),2) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12 responsive-column-m">
                        <div class="icon-box icon-layout-2 dashboard-icon-box">
                            <div class="d-flex">
                                <div class="info-icon icon-element bg-4 flex-shrink-0">
                                    <i class="la la-clock"></i>
                                </div>
                                <div class="info-content">
                                    <p class="info__desc">IATA Balance</p>
                                    <h4 class="info__title">EUR {{ number_format(iataBalance(),2) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12 responsive-column-m">
                        <div class="icon-box icon-layout-2 dashboard-icon-box">
                            <div class="d-flex">
                                <div class="info-icon icon-element bg-3 flex-shrink-0">
                                    <i class="la la-clock"></i>
                                </div>
                                <div class="info-content">
                                    <p class="info__desc">Total Admin</p>
                                    <h4 class="info__title">{{ totalUsers(1) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12 responsive-column-m">
                        <div class="icon-box icon-layout-2 dashboard-icon-box">
                            <div class="d-flex">
                                <div class="info-icon icon-element bg-3 flex-shrink-0">
                                    <i class="la la-clock"></i>
                                </div>
                                <div class="info-content">
                                    <p class="info__desc">Total Agents</p>
                                    <h4 class="info__title">{{ totalUsers(2) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12 responsive-column-m">
                        <div class="icon-box icon-layout-2 dashboard-icon-box">
                            <div class="d-flex">
                                <div class="info-icon icon-element bg-3 flex-shrink-0">
                                    <i class="la la-clock"></i>
                                </div>
                                <div class="info-content">
                                    <p class="info__desc">Total Agencies</p>
                                    <h4 class="info__title">{{ totalUsers(3) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 responsive-column--m">
                        <div class="form-box dashboard-card">
                            <div class="form-title-wrap">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="title">Recent Searches</h3>
                                    <button type="button" class="icon-element mark-as-read-btn ml-auto mr-0 waves-effect">
                                        <i class="la la-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-content p-0">
                                <div class="list-group drop-reveal-list">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="border-top mt-4"></div>
            </div>
        </div>
    </div>
</section>
@endsection