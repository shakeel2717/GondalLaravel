@extends('layouts.app')
@section('head')
@livewireStyles
@livewireStyles
@powerGridStyles
@endsection
@section('content')
@include('inc.admin.nav')
<section class="dashboard-area">
    <div class="dashboard-content-wrap">

        <div class="dashboard-bread">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="breadcrumb-content">
                            <div class="section-heading">
                                <h2 class="sec__title font-size-30 text-white mb-4">API Setting</h2>
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
                                <div class="">
                                    <h3 class="title">API Live Mode</h3>
                                </div>
                            </div>
                            <div class="form-content p-2">
                                <div class="list-group drop-reveal-list">
                                    <div class="col-md-6 mx-auto">
                                        <form action="{{ route('admin.api.store') }}" method="POST">
                                            @csrf
                                            <div class="card mb-2">
                                                <label for="ApiLiveMode" class="form-check-label">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" name="ApiLiveMode" role="switch" id="ApiLiveMode" {{ option('live_api') ? 'checked' : '' }}>
                                                                Live API
                                                            </div>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>

                                            <div class="card mb-2">
                                                <label for="ApiLiveBooking" class="form-check-label">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" name="ApiLiveBooking" role="switch" id="ApiLiveBooking" {{ option('live_booking') ? 'checked' : '' }}>
                                                                Live Booking
                                                            </div>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>

                                            <div class="form-group mb-2">
                                                <button type="submit" class="btn btn-primary btn-large">Update Setting</button>
                                            </div>
                                        </form>
                                    </div>
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
@section('footer')
@livewireScripts
@powerGridScripts
@endsection