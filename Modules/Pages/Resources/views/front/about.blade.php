@extends('pages::layouts.master')

@section('meta_title', $page[0]->meta_title)
@section('meta_tags', $page[0]->meta_tags)
@section('meta_description', $page[0]->meta_description)

@section('content')

<main>
    <!-- Sub Banner -->
    <section class="page-about_intro web">
        <div class="slider-wrap js-about-slider owl-carousel owl-theme">
            @foreach($banners as $banner)
                <!-- Slide web-->
                
                <div class="slide-item image-cover deferImage" data-src="{{storage_url()}}/{{$banner->image}}">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-lg-6 mx-auto">
                                <div class="card transparent-card text-center">
                                    <div class="banner-caption">
                                        <h1 class="bold-title">{{$banner->name}}</h1>
                                    </div>
                                    <div class="sub-caption">
                                        <div class="short-note">
                                            <p>{{$banner->title}}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide END -->
            @endforeach
        </div>
        <div class="slider-play">
            <button class="btn btn-slide-play active">
                <i class="fas fa-play active"></i>
            </button>
            <button class="btn btn-slide-pause in-active">
                <i class="fas fa-pause"></i>
            </button>
        </div>
    </section>
    <!-- Sub Banner END -->
    <!-- Sub Banner -->
    <section class="page-about_intro tab">
        <div class="slider-wrap js-about-slider owl-carousel owl-theme">
            @foreach($banners as $banner)
                <!-- Slide web-->
                
                <div class="slide-item image-cover deferImage" data-src="{{storage_url()}}/{{$banner->tablet_image}}">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-lg-6 mx-auto">
                                <div class="card transparent-card text-center">
                                    <div class="banner-caption">
                                        <h1 class="bold-title">{{$banner->name}}</h1>
                                    </div>
                                    <div class="sub-caption">
                                        <div class="short-note">
                                            <p>{{$banner->title}}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slide END -->
            @endforeach
        </div>
        <div class="slider-play">
            <button class="btn btn-slide-play active">
                <i class="fas fa-play active"></i>
            </button>
            <button class="btn btn-slide-pause in-active">
                <i class="fas fa-pause"></i>
            </button>
        </div>
    </section>
    <!-- Sub Banner END -->
    <!-- Sub Banner -->
    <section class="page-about_intro mobile">
        <div class="slider-wrap js-about-slider owl-carousel owl-theme">
            @foreach($banners as $banner)
                <!-- Slide tab-->
                <div class="slide-item image-cover deferImage" data-src="{{storage_url()}}/{{$banner->mobile_image}}">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-lg-6 mx-auto">
                                <div class="card transparent-card text-center">
                                    <div class="banner-caption">
                                        <h1 class="bold-title">{{$banner->name}}</h1>
                                    </div>
                                    <div class="sub-caption">
                                        <div class="short-note">
                                            <p>{{$banner->title}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <!-- Slide END -->
            @endforeach
        </div>
        <div class="slider-play">
            <button class="btn btn-slide-play active">
                <i class="fas fa-play active"></i>
            </button>
            <button class="btn btn-slide-pause in-active">
                <i class="fas fa-pause"></i>
            </button>
        </div>
    </section>
    <!-- Sub Banner END -->


    <!-- Overview -->
    <section class="overview-block ">
        <div class="container text-center">
            <div>
                <h2 class="header-overview mb-3">Overview</h2>
            </div>
            <div class="block-description">
                {!! $page[0]->description !!}
            </div>
        </div>
    </section>
    <!-- Overview END -->

    <section class="section-benefits imageblock gap-bottom-lg ">
        <div class="imageblock__content col-lg-6 col-md-6  col-sm-12 mx-auto hidden-xs">
            <div class="background-image-holder right-radius"
                style="background: url('<?php echo storage_url().'/'.$page[1]->image; ?>');">
            </div>
            <div class="image-wrapper">
                <img src="{{storage_url()}}/{{$page[1]->image}}" class="img-fluid image-hide_block" alt="img" loading="lazy">
            </div>

        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 text-left ml-auto">
                    <div class="card boxed-holder">

                        <h5 class="title-small">What We Believe</h5>
                        <h3 class="title-large">Why Us</h3>
                        <div class="info-block">
                            {!! $page[1]->description !!}
                        </div>
                    </div>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>

    <!-- History -->
    <section class="section-history" id="history_section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto text-center">
                    <h2 class="section-header">
                        Our History
                    </h2>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="card gallery-element">
                {!! $page[2]->description !!}
            </div>
        </div>
    </section>
    <!-- History END -->

    <!-- Details Block -->
    <section class="section-about-history">
        <div class="container p-md-0">
            {!! $page[3]->description !!}
        </div>
    </section>
    <!-- Details Block END -->

    <!-- Milestones -->
    <section class="section-milestone" id="milestone_section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-10 col-lg-10 mx-auto text-center">
                    <div class="section-header">
                        <h2 class="title">Our Milestones</h2>
                        <div class="section-description pr-xl-4 pl-xl-4">
                            @if(!empty($page[8])){!!$page[8]->description!!} @endif</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="timeline">
                <div class="timeline__wrap">
                    <div class="timeline__items">
                    	@foreach($milestones as $milestone)
	                        <!-- Slide -->
	                        <div class="timeline__item text-center">
	                            <div class="timeline__content">
	                                <h4>{{$milestone->year}}</h4>
	                                <p>{{$milestone->milestone}}</p>
	                            </div>
	                        </div>
	                        <!-- Slide END -->
	                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Milestones END -->

    <!-- Team -->
    <section class="section-team-small gap-bottom-lg " id="management_section">
        <div class="container">

            <div class="row mb-4">
                <div class="col-md-8 mx-auto text-center">
                    <div class="team-header">
                        <h2 class="title ">@if($managements->count() > 0){{$managements[0]->title}}@endif</h2>
                        <!-- <div class="short-description">
                            @if(!empty($page[9])) {!!$page[9]->description!!}.@endif
                        </div> -->
                    </div>
                </div>
            </div>

            <!--end of row-->
            <div class="col-10 mx-auto">
                @foreach($managements as $management)
                <div class="row">
                        <div class="col-sm-4 col-md-4 col-lg-4 mb-4">
                            <!-- Small team member -->
                            <div class="team-member">
                                <div class="team-member_profile">
                                    <img alt="team" src="{{storage_url()}}/{{$management->image}}" class="img-fluid radus-10 " loading="lazy">
                                </div>
                            </div>
                            <!-- end of small team member -->
                        </div>
                        <div class="col-sm-8 col-md-8 col-lg-8 mb-4">
                            <div class="description">
                                {{$management->description}}
                               
                                <div class="team-member">
                                    <h4 class="team-member">{{$management->name}}</h4>
                                    <span class="team-member_role">{{$management->position}}</span>
                                </div>
                            </div>
                        </div>
                </div>
                @endforeach
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    <!-- Team END -->

    <!-- Cols -->
    <section class="section-benefits imageblock key-point_gap " id="mission_section">
        <div class="imageblock__content col-lg-6 col-md-6  col-sm-12 mx-auto hidden-xs">
            <div class="background-image-holder right-radius"
                style="background: url('<?php echo storage_url().'/'.$page[4]->image; ?>');">
            </div>
            <div class="image-wrapper">
                <img src="<?php echo storage_url().'/'.$page[4]->image; ?>" class="img-fluid image-hide_block" alt="img" loading="lazy">
            </div>

        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 text-left ml-auto">
                    <div class="card boxed-holder">

                        <h3 class="title-large">Our Mission</h3>
                        <div class="info-block">
                            {!! $page[4]->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Cols END -->

    <!-- Cols -->
    <section class="section-benefits imageblock col-right-align pos-right key-point_gap-sec" >
        <div class="imageblock__content col-lg-6 col-md-6  col-sm-12 mx-auto col-right-align ">
            <div class="background-image-holder right-radius"
                style="background: url('<?php echo storage_url().'/'.$page[5]->image; ?>');">
            </div>
            <div class="image-wrapper">
                <img src="<?php echo storage_url().'/'.$page[5]->image; ?>" class="img-fluid image-hide_block" alt="img" loading="lazy">
            </div>

        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 text-left mr-auto">
                    <div class="card boxed-holder text-md-right">

                        <h3 class="title-large">Our Vision</h3>
                        <div class="info-block">
                            {!! $page[5]->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Cols END -->

    <!-- Section Values -->
    <section class="section-abt-features">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-10 col-lg-10 mx-auto text-center">
                    <div class="section-header">
                        <h2 class="title">Core Values</h2>
                        <!-- <div class="section-description pr-xl-4 pl-xl-4">
                            @if(!empty($page[10]))  {!!$page[10]->description!!} @endif
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

        @if($values->count() > 0)
        <div class="container">
            <div class="row justify-content-center">
                @foreach($values as $value)
                    <!-- Item -->
                    <div class="col-lg-4 col-md-6 icon-bx--gap">
                        <div class="icon-bx-wraper position-relative">
                            <div class="icon-bx__content">
                                <div class="icon-bx__icon">
                                    <img src="{{storage_url()}}/{{$value->image}}" class="img-fluid" alt="icon" loading="lazy">
                                </div>
                                <div class="icon-bx__desc_title">{{$value->title}}</div>
                                <div class="icon-bx__desc">
                                    {{$value->description}}
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </section>
    <!-- Section Values END -->

    <!-- Maufacturing Unit -->
    <section class="manufacture-units">

        <div class="container">
            <div class="row">
                <div class="col-12 col-md-10 col-lg-9 mx-auto text-center">
                    <div class="section-header">
                        <h2 class="title">Manufacturing </h2>
                        <div class="section-description">
                            <p>{{$page[6]->sub_title}}.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            {!! $page[6]->description !!}
        </div>
    </section>
    <!-- Maufacturing Unit END -->


    <!-- Our Teams -->
    <section class="section-team-content" id="team_section">
        <div class="container section-team__head">
            <div class="row align-items-center">
                <div class="col-lg-12 mb-12">
                    <div class="section-team__title text-center">
                        Our Team
                    </div>
                </div>

                <div class="col-lg-8 pr-lg-0 mb-8 mx-auto">
                    <div class="section-team__desc text-center">
                        @if(!empty($page[11])){!! $page[11]->description !!} @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="container text-center">
            @if(!empty($page[11]))
            <img src="<?php echo storage_url().'/'.$page[11]->image; ?>" class="img-fluid image-hide_block" alt="img" loading="lazy">
            @else
            <img src="{{asset('front/images/page/about/about-team-min.png')}}" class="img-fluid section-team__image-thumb"
                alt="team" loading="lazy">
                @endif
        </div>
    </section>
    <!-- Our Teams END-->
    <!-- Awwards -->
    @if($awards->count() > 0)
    <section class="section-awwards" id="awards_section">

        <div class="container">
            <div class="row">
                <div class="col-12 col-md-10 col-lg-10 mx-auto text-center">
                    <div class="section-header">
                        <h2 class="title">Awards & Accolades</h2>
                        <div class="section-description pr-xl-4 pl-xl-4">
                            @if(!empty($page[12])) {!! $page[12]->description !!}@endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="awwards-slider-container position-relative">

            <div class="container">

                <div class="js-awwards-slider owl-carousel owl-theme">
                    @foreach($awards as $award)
	                    <!-- Slide -->
	                    <div class="item">
	                        <div class="awwards-content">
	                            <img src="{{storage_url()}}/{{$award->image}}" class="img-fluid img-center"
	                                alt="awward" loading="lazy">
	                        </div>
	                    </div>
	                    <!-- Slide END -->
	                @endforeach
                </div>

            </div>


            <div class="slider-nav-controls">
                <button class="slider-arrows  slider-prev-button">
                    <img src="{{asset('front/images/icons/slider/arrow-left.png')}}" class="img-fluid" alt="icon" loading="lazy">
                </button>
                <button class="slider-arrows  slider-next-button">
                    <img src="{{asset('front/images/icons/slider/arrow-right.png')}}" class="img-fluid" alt="icon" loading="lazy">
                </button>
            </div>
        </div>
    </section>
    <!-- Awwards END -->
@endif
    <!-- Media Center -->
    <section class="page-about-media" id="page-about-media">
        <div class="container">
            <div class="main-title text-center">
                Media Center
            </div>
        </div>
        <div class="position-relative media-abt-page">
            <div class="container">

                <!-- Slide Container -->
                <div class="carousel-media-content owl-carousel owl-theme">
                	@foreach($medias as $media)
	                    <!-- Slide -->
	                    <div class="item">
	                        <a href="{{URL('mediaCenters/details/'.$media->id)}}">
	                            <div class="media-content-bx">
	                                <div class="media-content__image">
	                                    <img src="{{storage_url()}}/{{$media->media}}" class="img-fluid" alt="media" loading="lazy">
	                                </div>
	                                <div class="media-content__desc">
	                                    <div class="media-content__publish">{{date('F d, Y',strtotime($media->created_at))}}</div>
	                                    <h4 class="media-content__title">
	                                        {{$media->title}}
	                                    </h4>
	                                </div>
	                            </div>
	                        </a>
	                    </div>
	                    <!-- Slide END -->
	                @endforeach

                </div>
                <!-- Slide Container END -->

            </div>

            <div class="slider-nav-controls">
                <button class="slider-arrows  slide-prev">
                    <img src="{{asset('public/front/images/icons/left-arrow.png')}}" class="img-fluid" alt="icon" loading="lazy">
                </button>
                <button class="slider-arrows  slide-next">
                    <img src="{{asset('public/front/images/icons/right-arrow.png')}}" class="img-fluid" alt="icon" loading="lazy">
                </button>
            </div>
        </div>
    </section>
    <!-- Media Center END -->
@if($page[7]->status==1)
    <!-- Service -->
    <section class="page-about-service">
        <div class="container">
            <div class="service-desc-wrapper">
                <div class="service-desc__logo">
                    <img src="{{storage_url()}}/{{$page[7]->image}}" class="img-fluid img-center" alt="logo" loading="lazy">
                </div>
                <div class="service-desc__content">
                    {!! $page[7]->description !!}
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- Service END -->
@if($brands->count() > 0)
    <!-- Our Brands -->

    <!-- <section class="page-about-brands" id="brands_section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-4">
                    <div class="section-brand__title">
                        Our Brands
                    </div>
                </div>
                <div class="col-lg-7 mb-4">
                    <div class="row">
                    	@foreach($brands as $brand)
	                        <div class="col-6 col-md-4 col-lg-3 mb-3">
	                            <div class="brand-logo">
	                                <img src="{{storage_url()}}/{{$brand->image}}" class="img-fluid img-center"
	                                    alt="brand">
	                            </div>
	                        </div>
	                    @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section> -->

    <!-- Our Brands END -->
@endif
    <!-- Careers -->
    <section class="page-about-careers">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <div class="career-thumb">
                        @if(!empty($page[13]))
                        <img src="{{storage_url()}}/{{$page[13]->image}}" class="img-fluid image-hide_block" alt="img" loading="lazy">
                        @else
                        <img src="{{asset('front/images/page/about/thumb-03.png')}}" class="img-fluid " alt="career" loading="lazy">
                    @endif
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class="careers-content">
                        <div class="careers-content__inner">
                            <div class="sub-title">
                                Careers
                            </div>
                            <div class="main-title">
                                How to Join US
                            </div>
                            <div class="careers-content__main">
                                @if(!empty($page[13])){!! $page[13]->sub_title !!}@endif
                            </div>
                            <div class="careers-content__desc">
                                @if(!empty($page[13])) {!! $page[13]->description !!}@endif
                            </div>
                            <a class="btn btn-view-careers" href="{{URL('careers')}}">View Careers</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Careers END -->


</main>

@stop