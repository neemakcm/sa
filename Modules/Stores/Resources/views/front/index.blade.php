@extends('pages::layouts.master')

@section('meta_title', $banner->meta_title)
@section('meta_tags', $banner->meta_tags)
@section('meta_description', $banner->meta_description)

@section('content')

<main>
@if($banner)
    <!-- Baner Area -->
    <div class="inner-hero-area bg-image <?php echo $banner->mobile_image != ''?'web':''; ?> deferImage"  data-src="{{storage_url()}}/{{$banner->image}}">
        <div class="d-flex flex-grow-1">
            <div class="container align-self-center">
                <div class="row">
                    <div class="col-lg-12">
                        {!! $banner->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Area END -->
@endif

@if($banner->tablet_image != '')
<!-- Banner Area Tab -->
    <div class="inner-hero-area bg-image tab deferImage" data-src="{{storage_url()}}/{{$banner->tablet_image}}">
        <div class="d-flex flex-grow-1">
            <div class="container align-self-center">
                <div class="row">
                    <div class="col-lg-12">
                        {!! $banner->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Banner Area END -->
@endif
@if($banner->mobile_image != '')
        <!-- Baner Area -->
        <div class="inner-hero-area bg-image mobile deferImage" data-src="{{storage_url()}}/{{$banner->mobile_image}}">
            <div class="d-flex flex-grow-1">
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-lg-12">
                            {!! $banner->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner Area END -->
    @endif
    <!-- Dealers -->
    <section class="find-dealer">
        <div class="container">
            <div class="inner-content">
                <div class="d-flex flex-wrap align-items-end">
                    <div class="select-box-wrapper d-sm-flex">
                        <div class="select-box__item">
                            <div class="form-group">
                                <label for="">State</label>
                                <select name="state_id" id="state_id" class="form-control custom-select">
                                	<option value="all">All</option>
                                    @foreach($states as $state)
                                    	<option value="{{$state->state}}">{{$state->state}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="select-box__item">
                            <div class="form-group">
                                <label for="">District</label>
                                <select name="district" id="district_id" class="form-control custom-select">
                                    <option value="all">All</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="button-wraper"> <button class="btn-serch-opt" id="stores_locator">
                            Search
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Dealers END -->

    <!-- Search result -->
    <section class="dealer-address">
        <div class="container">
            @if($stores->count() > 0)
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="result-container">
                        <div class="result-header">
                            <div class="result-header__title">
                                Results
                            </div>
                        </div>
                        <div class="result-body smooth-scroll-bar position-relative" >
                            <div id="store_point">
                            
                            @foreach($stores as $store)
	                            <div class="result-body__content store_wrapper" onClick="storeDetail({{$store->id}})" data-img="{{$store->location}}" data-district="{{$store->district}}" data-state="{{$store->state}}">
	                                <div class="media">
	                                    <div class="item-icon">
	                                        <img src="{{asset('public/front/images/icons/icon-map-pin.svg')}}" class="img-fluid" alt="icon">
	                                    </div>
	                                    <div class="media-body">
                                        <ul class="mb-3">
	                                            <li>
	                                        <div class="d-flex jusitfy-content-between flex-wrap">
	                                            <h5 class="item-title flex-grow-1 pr-2">{{$store->title}}</h5>
                                                <div class="distance" id="location_{{$store->id}}"></div>
	                                        </div>
                                            </li>
                                                </ul>
	                                        <div class="item-content mb-2">
                                                <ul class="mb-3">
                                                    <li>
                                                    {{$store->description}}
                                                    </li>
                                                </ul>
	                                        </div>
	                                        <ul class="mb-3">
	                                            <li>
	                                                <span>
	                                                    <img src="{{asset('public/front/images/icons/icon-call.svg')}}" class="img-fluid"
	                                                        alt="call">
	                                                </span>
	                                                <a href="tel:{{$store->mobile}}"> {{$store->mobile}} </a>
	                                            </li>
	                                            <li>
	                                                <span>
	                                                    <img src="{{asset('public/front/images/icons/icon-mail.svg')}}" class="img-fluid"
	                                                        alt="call">
	                                                </span>
	                                                <a href="mailto:{{$store->email}}"> {{$store->email}} </a>
	                                            </li>
	                                        </ul>


	                                        <ul class="mb-3">
	                                            <li class="title-small">Open Hour</li>
	                                            <li>{{$store->open_hour}}</li>
	                                        </ul>
                                            <ul class="mb-3">
	                                            <li>
                                                    <a target="_blank" href="https://maps.google.com/?q={{$store->latitude}},{{$store->longitude}}">
                                                        <span>
                                                            <img src="{{asset('public/front/images/icons/icon-direction.svg')}}" class="img-fluid"
                                                                alt="location">
                                                        </span>
                                                    
	                                                Direction
                                                    </a> 
	                                            </li>
                                            </ul>
	                                        <!-- <a class="navigation-link" href="">
	                                            <span>
	                                                <img src="{{asset('public/front/images/icons/icon-direction.svg')}}" class="img-fluid"
	                                                    alt="icon">
	                                            </span>
	                                            Direction
	                                        </a> -->
	                                    </div>
	                                </div>
	                            </div>
	                        @endforeach
                            <!-- Item -->
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6  mb-4">
                    <div class="map-container">
                    <input type="hidden" name="store_ids" id="store_ids" value="{{implode(',',$stores->pluck('id')->toArray())}}">
                    <input type="hidden" name="store_id" id="store_id" value="{{$stores[0]->id}}">
                        <input type="hidden" name="lat" id="lat" value="{{$stores[0]->latitude}}">
                        <input type="hidden" name="lng" id="lng" value="{{$stores[0]->longitude}}">
                    <div id="map" style=" width:100%;height:540px;"></div>
                    </div>
                </div>
            </div>
            @else
                <p>No stores</p>
            @endif
        </div>
    </section>
    <!-- Search result END -->


</main>


@stop
@section('script')
<script src="{{asset('public/admins/js/google-api-store.js')}}"></script>
<script src="{{asset('public/front/script/store.js')}}"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{config('impex.keys.googleMap')}}&libraries=places&libraries=geometry&callback=initMap"></script>

@endsection