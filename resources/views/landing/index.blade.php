@extends('layouts.app')
@section('content')
<section class="breadcrumb-area bread-bg-flights">
    <section class="container" style="border-radius:10px;padding:100px 0px">
        <div class="container">
            <h2 class="text-center" style="color:#fff">SEARCH FOR BEST FLIGHTS</h2>
            <br>
            @include('inc.search-box')
            @auth
            <div class="row my-5">
                <div class="col-md-12">
                    <p class="mt-2" style="color:#fff">Recent Searches</p>
                    <hr style="margin: 4px 0; color: #fff;border-color:#fff">
                </div>
                @forelse (mySearches(auth()->user()->id) as $result)
                <div class="col-md-2 mt-3">
                    <div class="list-group">
                        <a href="{{ $result->uri }}" target="_blank" class="list-group-item list-group-item-action border-top-0 waves-effect">
                            <div class="msg-body d-flex align-items-center">
                                <div class="icon-element flex-shrink-0 mr-3 ml-0">
                                    <i class="la la-plane"></i>
                                </div>
                                <div class="msg-content w-100">
                                    <h3 class="title pb-0 px-2" style="text-transform:uppercase">flights</h3>
                                    <p class="msg-text px-2" style="text-transform:capitalize">{{ strtoupper($result->origin) }}<i class="la la-arrow-right px-1"></i>{{ strtoupper($result->destination) }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-md-12 mt-3">
                    <div class="list-group bg-white p-3">
                        <div class="msg-content w-100">
                            <h3 class="title pb-0 px-2" style="text-transform:uppercase">Your Recent Search will be appear here</h3>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
            @endauth
        </div>
    </section>
</section>
@include('inc.info')
@include('inc.footer')
@endsection