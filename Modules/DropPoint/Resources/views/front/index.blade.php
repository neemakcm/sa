@extends('pages::layouts.master')

@section('meta_title', $banner->meta_title)
@section('meta_tags', $banner->meta_tags)
@section('meta_description', $banner->meta_description)

@section('content')

<main>
    @if($banner)
    <!-- Baner Area -->
    <div class="inner-hero-area bg-image <?php echo $banner->mobile_image != ''?'web':''; ?> deferImage" data-src="{{storage_url()}}/{{$banner->image}}">
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
                                <select name="" id="state_id" class="form-control custom-select">
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
                                <select name="" id="district_id" class="form-control custom-select">
                                    <option value="all">All</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="button-wraper"> <button class="btn-serch-opt" id="drop_locator">
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
            @if($points->count() > 0)
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="result-container">
                        <div class="result-header">
                            <div class="result-header__title">
                                Results
                            </div>
                        </div>
                        <div class="result-body smooth-scroll-bar position-relative" >
                            <div id="drop_point">
                            <!-- Item -->
                            @foreach($points as $point)
	                            <div  class="result-body__content drop_wrapper" onClick="pointDetail({{$point->id}})" data-img="{{$point->location}}" data-district-id="{{$point->district}}" data-state-id="{{$point->state}}">
	                                <div class="media">
	                                    <div class="item-icon">
	                                        <img src="{{asset('public/front/images/icons/icon-map-pin.svg')}}" class="img-fluid" alt="icon">
	                                    </div>
	                                    <div class="media-body">
                                        <ul class="mb-3">
	                                            <li>
	                                        <div class="d-flex jusitfy-content-between flex-wrap">
	                                            <h5 class="item-title flex-grow-1 pr-2">{{$point->title}}</h5>
                                                <div class="distance" id="location_{{$point->id}}"></div>
	                                        </div>
                                            </li>
                                                </ul>
	                                        <div class="item-content mb-2">
                                            <ul class="mb-3">
	                                            <li>
	                                            {{$point->description}}
                                                </li>
                                                </ul>
	                                        </div>
	                                        <ul class="mb-3">
	                                            <li>
	                                                <span>
	                                                    <img src="{{asset('public/front/images/icons/icon-call.svg')}}" class="img-fluid"
	                                                        alt="call">
	                                                </span>
	                                                <a href="tel:{{$point->mobile}}"> {{$point->mobile}} </a>
	                                            </li>
	                                            <li>
	                                                <span>
	                                                    <img src="{{asset('public/front/images/icons/icon-mail.svg')}}" class="img-fluid"
	                                                        alt="call">
	                                                </span>
	                                                <a href="mailto:{{$point->email}}"> {{$point->email}} </a>
	                                            </li>
	                                        </ul>


	                                        <ul class="mb-3">
	                                            <li class="title-small">Open Hour</li>
	                                            <li>{{$point->open_hour}}</li>
	                                        </ul>
                                            <ul class="mb-3">
	                                            <li>
                                                    <a target="_blank" href="https://maps.google.com/?q={{$point->latitude}},{{$point->longitude}}">
                                                        <span>
                                                            <img src="{{asset('public/front/images/icons/icon-direction.svg')}}" class="img-fluid"
                                                                alt="location">
                                                        </span>
                                                   
	                                                Direction
                                                    </a> 
	                                            </li>
                                            </ul> 	                                        </ul>
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
                        <input type="hidden" name="drop_ids" id="drop_ids" value="{{implode(',',$points->pluck('id')->toArray())}}">
                        <input type="hidden" name="drop_id" id="drop_id" value="{{$points[0]->id}}">
                        <input type="hidden" name="lat" id="lat" value="{{$points[0]->latitude}}">
                        <input type="hidden" name="lng" id="lng" value="{{$points[0]->longitude}}">
                        <div id="map" style=" width:100%;height:540px;"></div>
                    </div>
                </div>
            </div>
            @else
                <p>No Drop Ponits</p>
            @endif
        </div>
    </section>
    <!-- Search result END -->
    {{-- {!! $page->description !!} --}}
 <!-- Section END -->
 <section class="about-program">
    <div class="position-relative">
    <div class="fixed-image-layer d-none d-lg-block deferImage" data-src="{{storage_url()}}/{{$page->image}}">&nbsp;</div>
    <div class="container">
    <div class="row">
    <div class="col-lg-6 d-lg-none mb-4 web"><img class="img-fluid w-100" src="{{storage_url()}}/{{$page->image}}" alt="image" width="640" height="500" /></div>
    <div class="col-lg-6 d-lg-none mb-4 mobile"><img class="img-fluid w-100" src="{{storage_url()}}/{{$page->mobile_image}}" alt="image" width="640" height="500" /></div>
    <div class="col-lg-6 ml-auto">
    <div class="about-program__content">
    <div class="about-program__title">About the Program</div>
    <div class="about-program__desc">{{ $page->sub_description }}</div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </section>
    <section class="list-contents about-program">
    <div class="position-relative">
    <div class="fixed-image-layer d-none d-lg-block right-fixed deferImage"  data-src="{{storage_url()}}/{{$page->description_desktop_image_upload}}">&nbsp;</div>
    <div class="container">
    <div class="row">
    <div class="col-lg-6">
    <div class="list-content__title">{{$page->sub_title}}</div>
    {!! $page->description !!}
    </div>
    <div class="col-lg-6 d-lg-none mb-4 web"><img class="img-fluid w-100" src="{{storage_url()}}/{{$page->description_desktop_image_upload}}" alt="image" width="582" height="658" /></div>
    <div class="col-lg-6 d-lg-none mb-4 mobile"><img class="img-fluid w-100" src="{{storage_url()}}/{{$page->description_mobile_image_upload}}" alt="image" width="582" height="658" /></div>
    </div>
    </div>
    </div>
    </section>
    <section class="descript-container">
    <div class="container">
    <div class="recycle-banner web"><img src="{{storage_url()}}/{{$page->footer_desktop_image_upload}}" width="1366" height="350" /></div>
    <div class="recycle-banner mobile"><img src="{{storage_url()}}/{{$page->footer_mobile_image_upload}}" width="640" height="350" /></div>
    <div class="descript__title ">{{$page->footer_title}}</div>
    <div class="descript__content">{{$page->footer_description}}</div>
    </div>
</section>

</main>
@stop
@section('script')
    <script src="{{asset('public/front/script/drop-point.js')}}"></script>
    <script src="{{asset('public/admins/js/google-api-point.js')}}"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{config('impex.keys.googleMap')}}&libraries=places&libraries=geometry&callback=initMap"></script>

@endsection