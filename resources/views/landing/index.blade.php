@extends('layouts.app')
@section('content')
<section class="breadcrumb-area bread-bg-flights">
    <section class="container" style="border-radius:10px;padding:150px 0px">
        <div class="container">
            <h2 class="text-center" style="color:#fff">SEARCH FOR BEST FLIGHTS</h2>
            <br>
            @include('inc.search-box')
        </div>
    </section>
</section>
@include('inc.info')
@include('inc.footer')
@endsection