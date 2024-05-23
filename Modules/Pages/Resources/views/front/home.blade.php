@extends('pages::layouts.master')

@section('meta_title', $settings->meta_title)
@section('meta_tags', $settings->meta_tag)
@section('meta_description', $settings->meta_description)

@section('content')
@if(session()->has('message'))
<div class="col-12 alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session()->get('message') }}
</div>
@endif

@if($banners->count() > 0)
<div class="home-banner-carousel">
    <div class="sliderContainer">
        <div class="home-banner_container slider main-banner-slider">

            @foreach($banners as $banner)
            <!-- Slide -->
            <div class="slider-item banner_{{$banner->id}}">
                <div class="slider-content position-relative">

                    @if($banner->type == 1)
                    <div class="image" data-type="image">
                        <!-- Background Image -->
                        <div class="web">
                            <img src="{{storage_url()}}/{{$banner->image}}" class="image-preview" alt="slider">
                        </div>

                        <div class="mobile">
                            @if($banner->image_mobile != '')
                            <img src="{{storage_url()}}/{{$banner->image_mobile}}" class="image-preview" alt="slider">
                            @else
                            <img src="{{storage_url()}}/{{$banner->image}}" class="image-preview" alt="slider">
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="image" data-type="video">
                        <video style="width: 100%;" muted="" autoplay="autoplay" loop playsinline>
                            <source src="{{storage_url()}}/{{$banner->video}}" type="video/mp4">
                        </video>
                    </div>

                    @endif

                    @php
                    if($banner->position == 'middle')
                    $position_class = 'md-auto';
                    else if($banner->position == 'right')
                    $position_class = 'ml-auto';
                    else
                    $position_class = '';
                    @endphp

                    <div class="container web caption-container">
                        <div class="row">
                            <div class="col-md-8 col-lg-6 {{$position_class}}">
                                <div class="card content">
                                    <h4 class="small-title "
                                        style="color:{{$banner->short_color_code}}; @if($banner->short_font_size) font-size: {{$banner->short_font_size}}px @endif">
                                        {{$banner->short_description}}</h4>
                                    <h1 class="bold-title"
                                        style="color:{{$banner->title_color_code}}; @if($banner->title_font_size) font-size: {{$banner->title_font_size}}px @endif">
                                        {{$banner->title}}</h1>
                                    <div class="short-desc">
                                        <p
                                            style="color:{{$banner->description_color_code}};  @if($banner->description_font_size) font-size: {{$banner->description_font_size}}px @endif">
                                            {!!$banner->description!!}</p>
                                    </div>
                                    <div class="group-button">
                                        @if($banner->buy_now != '' || $banner->buy_now != null)
                                        <a style="color:{{$banner->buy_now_color_code}};background-color: {{$banner->buy_now_bg_color_code}};border-color: {{$banner->buy_now_bg_color_code}};"
                                            href="{{$banner->buy_now}}" class="btn button-buy-now" tabindex="0">
                                            @if($banner->buy_now_title){{$banner->buy_now_title}} @else
                                            {{'Explore the Range'}} @endif
                                        </a>
                                        @endif

                                        @if($banner->learn_more != '' || $banner->learn_more != null)
                                        <a style="color:{{$banner->learn_more_color_code}};background-color: {{$banner->learn_more_bg_color}};border-color: {{$banner->learn_more_color_code}};"
                                            href="{{$banner->learn_more}}" class="btn button-learn-more" tabindex="0">
                                            @if($banner->learn_more_title){{$banner->learn_more_title}} @else
                                            {{'Learn More'}} @endif
                                        </a>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="{{$banner->position_mobile}} mobile">
                        <div class="mobile_captions">
                            <div class="card content">
                                <h4 class="small-title "
                                    style="color:{{$banner->short_color_code}}; @if($banner->short_font_size) font-size: {{$banner->short_font_size}}px @endif">
                                    {{$banner->short_description}}</h4>
                                <h1 class="bold-title"
                                    style="color:{{$banner->title_color_code}}; @if($banner->title_font_size) font-size: {{$banner->title_font_size}}px @endif">
                                    {{$banner->title}}</h1>
                                <div class="short-desc"
                                    style="color:{{$banner->description_color_code}}; @if($banner->description_font_size) font-size: {{$banner->description_font_size}}px @endif">
                                    <p>{!!$banner->description!!}</p>
                                </div>
                                <div class="group-button">
                                    @if($banner->buy_now != '' || $banner->buy_now != null)
                                    <a style="color:{{$banner->buy_now_color_code}};background-color: {{$banner->buy_now_bg_color_code}};border-color: {{$banner->buy_now_bg_color_code}};"
                                        href="{{$banner->buy_now}}" class="btn button-buy-now" tabindex="0">
                                        @if($banner->buy_now_title){{$banner->buy_now_title}} @else
                                        {{'Explore the Range'}} @endif

                                    </a>
                                    @endif
                                    @if($banner->learn_more != '' || $banner->learn_more != null)
                                    <a style="color:{{$banner->learn_more_color_code}};background-color: {{$banner->learn_more_bg_color}};border-color: {{$banner->learn_more_color_code}}; "
                                        href="{{$banner->learn_more}}" class="btn button-learn-more" tabindex="0">
                                        @if($banner->learn_more_title){{$banner->learn_more_title}} @else
                                        {{'Learn More'}} @endif

                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Slide -->
            @endforeach

        </div>
        <div class="progress-flex">
            {{-- <div class="progressBarContainer d-none d-md-block"> --}}
            <div class="progressBarContainer  d-md-block">
                <div class="indicator-wrap">
                    @foreach($banners as $key=>$banner)
                    <div class="indicator__controls">
                        <span data-slick-index="{{$key}}" class="progressBar"></span>
                    </div>
                    @endforeach
                    <!-- <div class="indicator__controls">
							<span data-slick-index="1" class="progressBar"></span>
						</div> -->
                </div>
            </div>
            <div class="buttons">
                <button id='toggle'>
                    <i class="fa fa-pause"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@endif

@if($flagship->count() > 0)
<!-- Flaghip products -->
<section class="section-flagship">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto text-center">
                <div class="flagship-header">
                    <h2 class="title">Flagship
                        Products</h2>
                    <div class="short-description">
                        <p>Have a sneak peek at some of our renowned products designed to ease your lives!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container flagship-tabs">
        <div class="row">
            <div class="col-md-12 mx-auto tab-header">
                <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                    @foreach($flagship as $key => $flag)
                    <li class="nav-item">
                        <a class="nav-link <?php echo $key == 0?'active':''; ?>" id="pills-{{$flag->slug}}-tab"
                            data-toggle="pill" href="#pills-{{$flag->slug}}" role="tab"
                            aria-controls="pills-{{$flag->slug}}" aria-selected="true">{{$flag->name}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-12 p-0">
            <div class="tab-content" id="pills-tabContent">
                @foreach($flagship as $key => $flag)
                <div class="tab-pane fade show <?php echo $key == 0?'active':''; ?> flagship_{{$flag->products[0]->slug}}"
                    id="pills-{{$flag->slug}}" role="tabpanel" aria-labelledby="pills-{{$flag->slug}}-tab">

                    <!-- Tab Container -->
                    <div class="image-wrap">
                        <img src="{{storage_url()}}/resized/xl/{{$flag->products[0]->thumbnail}}"
                            class="img-fluid image-thumb" alt="product" loading="lazy">
                        <div class="product-info">
                            <h4 class="product-title">
                                {{$flag->products[0]->sku}}
                            </h4>
                            <div class="short-note">
                                {{$flag->products[0]->flagship_description}}
                            </div>
                        </div>
                        <div class="group-button">
                            @php
                            if($flag->products[0]->type == 0)
                            $online = $flag->products[0]->online;
                            else
                            $online = $flag->products[0]->parent->online;
                            @endphp

                            @if($online->count() > 0)
                            <a target="_blank" rel="noopener" href="{{$online[0]->online_link}}"
                                class="btn buy-button ">
                                Buy Now
                            </a>
                            @endif
                            <a href="{{URL('products/detail')}}/{{$flag->products[0]->slug}}" class="btn learn-button">
                                Learn More
                            </a>
                        </div>
                    </div>
                    <!-- Tab Container END -->
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Flagship Products END -->
@endif

@if(isset($block[0]))
<!-- Products -->
<section class="section-largebg cover-image web blocks_{{$block[0]->categories->slug}}"
    style="background-image:url('{{storage_url()}}/{{$block[0]->image}}');">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-6">
                <div class="product-details">
                    <div class="product-info">
                        <h4 class="product-title"
                            style="color:{{$block[0]->category_color_code}}; @if($block[0]->category_font_size) font-size: {{$block[0]->category_font_size}}px @endif">
                            {{$block[0]->categories->name}}
                        </h4>
                        <div class="short-note">
                            <p
                                style="color:{{$block[0]->description_color_code}}; @if($block[0]->description_font_size) font-size: {{$block[0]->description_font_size}}px @endif">
                                {{$block[0]->description}}</p>
                        </div>
                    </div>
                    <div class="group-button gap-large">
                        <a style="color:{{$block[0]->buy_now_color_code}} ;background-color: {{$block[0]->buy_now_bg_color_code}}; border-color: {{$block[0]->buy_now_bg_color_code}};"
                            href="{{URL('products')}}/{{$block[0]->categories->slug}}" class="btn buy-button ">
                            @if($block[0]->buy_now_title){{$block[0]->buy_now_title}} @else
                            {{"Explore the Range"}}@endif
                        </a>
                        @if($block[0]->learn_more != '')
                        <a style="color:{{$block[0]->learn_more_color_code}} ;background-color: {{$block[0]->learn_more_bg_color}}; border-color: {{$block[0]->learn_more_color_code}};"
                            href="{{$block[0]->learn_more}}" class="btn learn-button">
                            @if($block[0]->learn_more_title){{$block[0]->learn_more_title}} @else {{"Learn More"}}
                            @endif
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-largebg cover-image mobile blocks_{{$block[0]->categories->slug}}"
    style="background-image: url('{{storage_url()}}/{{$block[0]->mobile_image}}')">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-6">
                <div class="product-details">
                    <div class="product-info">
                        <h4 class="product-title"
                            style="color:{{$block[0]->category_color_code}}; @if($block[0]->category_font_size) font-size: {{$block[0]->category_font_size}}px @endif">
                            {{$block[0]->categories->name}}
                        </h4>
                        <div class="short-note">
                            <p
                                style="color:{{$block[0]->description_color_code}}; @if($block[0]->description_font_size) font-size: {{$block[0]->description_font_size}}px @endif">
                                {{$block[0]->description}} </p>
                        </div>
                    </div>
                    <div class="group-button gap-large">
                        <a style="color:{{$block[0]->buy_now_color_code}} ;background-color: {{$block[0]->buy_now_bg_color_code}}; border-color: {{$block[0]->buy_now_bg_color_code}};"
                            href="{{URL('products')}}/{{$block[0]->categories->slug}}" class="btn buy-button ">
                            @if($block[0]->buy_now_title){{$block[0]->buy_now_title}} @else
                            {{"Explore the Range"}}@endif
                        </a>
                        @if($block[0]->learn_more != '')
                        <a style="color:{{$block[0]->learn_more_color_code}} ;background-color: {{$block[0]->learn_more_bg_color}}; border-color: {{$block[0]->learn_more_color_code}};"
                            href="{{$block[0]->learn_more}}" class="btn learn-button">
                            @if($block[0]->learn_more_title){{$block[0]->learn_more_title}} @else {{"Learn More"}}
                            @endif
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@if(isset($block[1]))
<section class="section-largebg cover-image mb-0 web blocks_{{$block[1]->categories->slug}}"
    style="background-image:url('{{storage_url()}}/{{$block[1]->image}}');">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 mx-auto text-center">
                <div class="product-details">
                    <div class="product-info">
                        <h4 class="product-title"
                            style="color:{{$block[1]->category_color_code}}; @if($block[1]->category_font_size) font-size: {{$block[1]->category_font_size}}px @endif">
                            {{$block[1]->categories->name}}
                        </h4>
                        <div class="short-note">
                            <p
                                style="color:{{$block[1]->description_color_code}}; @if($block[1]->description_font_size) font-size: {{$block[1]->description_font_size}}px @endif">
                                {{$block[1]->description}}</p>
                        </div>
                    </div>
                    <div class="group-button">
                        <a style="color:{{$block[1]->buy_now_color_code}} ;background-color: {{$block[1]->buy_now_bg_color_code}}; border-color: {{$block[1]->buy_now_bg_color_code}};"
                            href="{{URL('products')}}/{{$block[1]->categories->slug}}" class="btn buy-button ">
                            @if($block[1]->buy_now_title){{$block[1]->buy_now_title}} @else
                            {{"Explore the Range"}}@endif
                        </a>
                        @if($block[1]->learn_more != '')
                        <a style="color:{{$block[1]->learn_more_color_code}} ;background-color: {{$block[1]->learn_more_bg_color}}; border-color: {{$block[1]->learn_more_color_code}};"
                            href="{{$block[1]->learn_more}}" class="btn learn-button">
                            @if($block[1]->learn_more_title){{$block[1]->learn_more_title}} @else {{"Learn More"}}
                            @endif
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-largebg cover-image mb-0 mobile blocks_{{$block[1]->categories->slug}}"
    style="background-image:url('{{storage_url()}}/{{$block[1]->mobile_image}}');">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 mx-auto text-center">
                <div class="product-details">
                    <div class="product-info">
                        <h4 class="product-title"
                            style="color:{{$block[1]->category_color_code}}; @if($block[1]->category_font_size) font-size: {{$block[1]->category_font_size}}px @endif">
                            {{$block[1]->categories->name}}
                        </h4>
                        <div class="short-note">
                            <p class="light-font font-16 mt-1"
                                style="color:{{$block[1]->description_color_code}}; @if($block[1]->description_font_size) font-size: {{$block[1]->description_font_size}}px @endif">
                                {{$block[1]->description}}</p>
                        </div>
                    </div>
                    <div class="group-button">
                        <a style="color:{{$block[1]->buy_now_color_code}} ;background-color: {{$block[1]->buy_now_bg_color_code}}; border-color: {{$block[1]->buy_now_bg_color_code}};"
                            href="{{URL('products')}}/{{$block[1]->categories->slug}}" class="btn buy-button ">
                            @if($block[1]->buy_now_title){{$block[1]->buy_now_title}} @else
                            {{"Explore the Range"}}@endif
                        </a>
                        @if($block[1]->learn_more != '')
                        <a style="color:{{$block[1]->learn_more_color_code}} ;background-color: {{$block[1]->learn_more_bg_color}}; border-color: {{$block[1]->learn_more_color_code}};"
                            href="{{$block[1]->learn_more}}" class="btn learn-button">
                            @if($block[1]->learn_more_title){{$block[1]->learn_more_title}} @else {{"Learn More"}}
                            @endif
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<section class="section-grid web">

    @if(isset($block[2]))
    <div class="col-grid">
        <div data-src="{{storage_url()}}/{{$block[2]->image}}"
            class="cover-image bg-image h-100 flex-grow blocks_{{$block[2]->categories->slug}} deferImage">
            <div class="image-cover">
                <div class="product-details text-center">
                    <div class="product-title"
                        style="color:{{$block[2]->category_color_code}}; @if($block[2]->category_font_size) font-size: {{$block[2]->category_font_size}}px @endif">
                        {{$block[2]->categories->name}}</div>
                    <div class="short-note product-details">
                        <p
                            style="color:{{$block[2]->description_color_code}}; @if($block[2]->description_font_size) font-size: {{$block[2]->description_font_size}}px @endif">
                            {{$block[2]->description}}</p>
                    </div>
                    <div class="group-button">
                        <a style="color:{{$block[2]->buy_now_color_code}} ;background-color: {{$block[2]->buy_now_bg_color_code}}; border-color: {{$block[2]->buy_now_bg_color_code}};"
                            href="{{URL('products')}}/{{$block[2]->categories->slug}}" class="btn buy-button ">
                            @if($block[2]->buy_now_title){{$block[2]->buy_now_title}} @else
                            {{"Explore the Range"}}@endif
                        </a>
                        @if($block[2]->learn_more != '')
                        <a style="color:{{$block[2]->learn_more_color_code}} ;background-color: {{$block[2]->learn_more_bg_color}}; border-color: {{$block[2]->learn_more_color_code}};"
                            href="{{$block[2]->learn_more}}" class="btn learn-button">
                            @if($block[2]->learn_more_title){{$block[2]->learn_more_title}} @else {{"Learn More"}}
                            @endif
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(isset($block[3]))
    <div class="col-grid">
        <div style="background-image: url('{{storage_url()}}/{{$block[3]->image}}');"
            class="cover-image bg-image h-100 flex-grow blocks_{{$block[3]->categories->slug}}">
            <div class="image-cover">
                <div class="product-details text-center">
                    <div class="product-title"
                        style="color:{{$block[3]->category_color_code}}; @if($block[3]->category_font_size) font-size: {{$block[3]->category_font_size}}px @endif">
                        {{$block[3]->categories->name}}</div>
                    <div class="short-note product-details">
                        <p
                            style="color:{{$block[3]->description_color_code}}; @if($block[3]->description_font_size) font-size: {{$block[3]->description_font_size}}px @endif">
                            {{$block[3]->description}}</p>
                    </div>
                    <div class="group-button">
                        <a style="color:{{$block[3]->buy_now_color_code}} ;background-color: {{$block[3]->buy_now_bg_color_code}}; border-color: {{$block[3]->buy_now_bg_color_code}};"
                            href="{{URL('products')}}/{{$block[3]->categories->slug}}" class="btn buy-button ">
                            @if($block[3]->buy_now_title){{$block[3]->buy_now_title}} @else
                            {{" Explore the Range"}}@endif
                        </a>
                        @if($block[3]->learn_more != '')
                        <a style="color:{{$block[3]->learn_more_color_code}} ;background-color: {{$block[3]->learn_more_bg_color}}; border-color: {{$block[3]->learn_more_color_code}};"
                            href="{{$block[3]->learn_more}}" class="btn learn-button">
                            @if($block[3]->learn_more_title){{$block[3]->learn_more_title}} @else {{" Learn More"}}
                            @endif
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

</section>

@if(isset($block[2]))
<section class="section-largebg cover-image mb-0 mobile blocks_{{$block[2]->categories->slug}}"
    style="background-image:url('{{storage_url()}}/{{$block[2]->mobile_image}}');">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 mx-auto text-center">
                <div class="product-details">
                    <div class="product-info">
                        <h4 class="product-title"
                            style="color:{{$block[2]->category_color_code}}; @if($block[2]->category_font_size) font-size: {{$block[2]->category_font_size}}px @endif">
                            {{$block[2]->categories->name}}
                        </h4>
                        <div class="short-note">
                            <p style="color:{{$block[2]->description_color_code}}; @if($block[2]->description_font_size) font-size: {{$block[2]->description_font_size}}px @endif"
                                class="light-font font-16 mt-1">{{$block[2]->description}}</p>
                        </div>
                    </div>
                    <div class="group-button">
                        <a style="color:{{$block[2]->buy_now_color_code}} ;background-color: {{$block[2]->buy_now_bg_color_code}}; border-color: {{$block[2]->buy_now_bg_color_code}};"
                            href="{{URL('products')}}/{{$block[2]->categories->slug}}" class="btn buy-button ">
                            @if($block[2]->buy_now_title){{$block[2]->buy_now_title}} @else
                            {{"Explore the Range"}}@endif
                        </a>
                        @if($block[2]->learn_more != '')
                        <a style="color:{{$block[2]->learn_more_color_code}} ;background-color: {{$block[2]->learn_more_bg_color}}; border-color: {{$block[2]->learn_more_color_code}};"
                            href="{{$block[2]->learn_more}}" class="btn learn-button">
                            @if($block[2]->learn_more_title){{$block[2]->learn_more_title}} @else {{"Learn More"}}
                            @endif
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@if(isset($block[3]))
<section class="section-largebg cover-image mb-0 mobile blocks_{{$block[3]->categories->slug}}"
    style="background-image:url('{{storage_url()}}/{{$block[3]->mobile_image}}');">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 mx-auto text-center">
                <div class="product-details">
                    <div class="product-info">
                        <h4 class="product-title"
                            style="color:{{$block[3]->category_color_code}}; @if($block[3]->category_font_size) font-size: {{$block[3]->category_font_size}}px @endif">
                            {{$block[3]->categories->name}}
                        </h4>
                        <div class="short-note">
                            <p style="color:{{$block[3]->description_color_code}}; @if($block[3]->description_font_size) font-size: {{$block[3]->description_font_size}}px @endif"
                                class="light-font font-16 mt-1">{{$block[3]->description}}</p>
                        </div>
                    </div>
                    <div class="group-button">
                        <a style="color:{{$block[3]->buy_now_color_code}} ;background-color: {{$block[3]->buy_now_bg_color_code}}; border-color: {{$block[3]->buy_now_bg_color_code}};"
                            href="{{URL('products')}}/{{$block[3]->categories->slug}}" class="btn buy-button ">
                            @if($block[3]->buy_now_title){{$block[3]->buy_now_title}} @else
                            {{" Explore the Range"}}@endif
                        </a>
                        @if($block[3]->learn_more != '')
                        <a style="color:{{$block[3]->learn_more_color_code}} ;background-color: {{$block[3]->learn_more_bg_color}}; border-color: {{$block[3]->learn_more_color_code}};"
                            href="{{$block[3]->learn_more}}" class="btn learn-button">
                            @if($block[3]->learn_more_title){{$block[3]->learn_more_title}} @else {{" Learn More"}}
                            @endif
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endif
<!-- Products END -->

@if($other->count() > 0)
<!-- Others -->
<section class="section-product-othr">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto text-center">
                <div class="othr-product-header">
                    <h2 class="title">Other
                        Products</h2>
                    <div class="short-description">
                        <p>Discover more products designed to ease your life!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container product-tabs">
        <div class="row">
            <div class="col-md-12 mx-auto tab-header">
                <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                    <!-- <li class="nav-item">
		                        <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab"
		                            aria-controls="pills-all" aria-selected="true">All</a>
		                    </li> -->
                    @foreach($other as $key => $item)
                    <li class="nav-item">
                        <a class="nav-link <?php echo $key == 0? 'active':''; ?>"
                            id="pills-{{$item->categories->slug}}-tab" data-toggle="pill"
                            href="#pills-{{$item->categories->slug}}" role="tab"
                            aria-controls="pills-{{$item->categories->slug}}"
                            aria-selected="false">{{$item->categories->name}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid pr-lg-0">
        <div class="tab-content" id="pills-tabContent">

            @foreach($other as $key => $item)
            <div class="tab-pane fade <?php echo $key == 0? 'show active':''; ?>" id="pills-{{$item->categories->slug}}"
                role="tabpanel" aria-labelledby="pills-{{$item->categories->slug}}-tab">

                <!-- Tab Container -->
                <div class="slider-wrapper">
                    <div class="js-product-carousel owl-carousel owl-theme">

                        @foreach($item->homeDesignSubcategory as $children)
                        @if($children->categories->icon != '')
                        <!-- Slide -->
                        <div class="item others_{{$children->categories->slug}}">
                            <div class="product-card mb-3 mb-sm-0">
                                <!-- Background -->
                                <div class="card-bg">
                                    <div class="card-bg-img bg-cover">
                                        <div class="web"><img
                                                src="<?php echo storage_url().'/resized/medium/'.$children->categories->icon ?>"
                                                alt="" loading="lazy"></div>
                                        <div class="mobile"><img
                                                src="<?php echo storage_url().'/'.$children->categories->mobile_image ?>"
                                                alt="" loading="lazy"></div>
                                    </div>
                                    <div class="card-outer-body">
                                        <div class="card-body my-auto text-center">
                                            <!-- Heading -->
                                            <h4
                                                style="color:{{$children->category_color_code}}; @if($children->category_font_size) font-size: {{$children->category_font_size}}px @endif">
                                                {{$children->categories->name}}</h4>
                                            <h5
                                                style="color:{{$children->category_color_code}}; @if($children->category_font_size) font-size: {{$children->category_font_size}}px @endif">
                                                {{$children->categories->sub_title}}</h5>
                                        </div>
                                        <div class="card-footer">
                                            <!-- Link -->
                                            <div class="group-button">
                                                <a style="color:{{$children->buy_now_color_code}} ;background-color: {{$children->buy_now_bg_color_code}};"
                                                    href="{{URL('products')}}/{{$children->categories->slug}}"
                                                    class="btn buy-button ">
                                                    Buy Now
                                                </a>
                                                @if($children->online_link != '')
                                                <a style="color:{{$children->learn_more_color_code}} ;background-color: {{$children->learn_more_bg_color}};"
                                                    rel="noopener" href="{{$children->online_link}}"
                                                    class="btn learn-button">
                                                    Learn More
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Body -->


                            </div>
                        </div>
                        <!-- Slide END -->
                        @endif
                        @endforeach


                    </div>
                </div>
                <!-- Tab Container END -->

            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!-- Others END -->

@if($newest->count() > 0 || $popular->count() > 0 || $offers->count() > 0)
<!-- Trending -->
<section class="section-trending">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto text-center">
                <div class="trending-header ">
                    <h2 class="title">Trending Now</h2>
                    <div class="short-description">
                        <p>Explore new arrivals, popular products, exciting deals and much more</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container trend-product-tabs">
        <div class="row">
            <div class="col-md-12 mx-auto tab-header">
                <ul class="nav nav-pills justify-content-center trending-products-tab" id="pills-tab" role="tablist">
                    @if($newest->count() > 0)
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-newest-tab" data-toggle="pill" href="#pills-newest"
                            role="tab" aria-controls="pills-newest" aria-selected="true">Newest</a>
                    </li>
                    @endif
                    @if($popular->count() > 0)
                    <li class="nav-item">
                        <a class="nav-link" id="pills-popular-tab" data-toggle="pill" href="#pills-popular" role="tab"
                            aria-controls="pills-popular" aria-selected="false">Most Popular</a>
                    </li>
                    @endif
                    @if($offers->count() > 0)
                    <li class="nav-item">
                        <a class="nav-link" id="pills-offers-tab" data-toggle="pill" href="#pills-offers" role="tab"
                            aria-controls="pills-offers" aria-selected="false">Exciting Offers</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="bg-layer">
            <div class="tab-content" id="pills-tabContent">
                @if($newest->count() > 0)
                <div class="tab-pane fade show active" id="pills-newest" role="tabpanel"
                    aria-labelledby="pills-newest-tab">

                    <!-- Tab Container -->
                    <div class="">
                        <div class="col-12">
                            <div class="trends">
                                <div class="swiper js-Trending">
                                    <div class="swiper-wrapper">

                                        @foreach($newest as $key => $new)
                                        <div class="swiper-slide newest_{{$new->products->category->slug}}">
                                            <div class="row align-items-center">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="trend-item">
                                                        @if($new->image != '')
                                                        <img src="{{storage_url()}}/resized/xl/{{$new->image}}"
                                                            loading="lazy">
                                                        @else
                                                        <img src="{{storage_url()}}/resized/xl/{{$new->products->thumbnail}}"
                                                            loading="lazy">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="trend-product">
                                                        <h1>{{$new->products->sku}}</h1>
                                                        <h4>{{$new->products->category->name}}</h4>
                                                        <p>{{$new->description}}</p>
                                                        <div class="group-button">
                                                            @php
                                                            if($new->products->type == 0)
                                                            $online = $new->products->online;
                                                            else
                                                            $online = $new->products->parent->online;
                                                            @endphp

                                                            @if($online->count() > 0)
                                                            <a rel="noopener" href="{{$online[0]->online_link}}"
                                                                target="_blank" class="btn buy-button ">
                                                                Buy Now
                                                            </a>
                                                            @endif
                                                            @if($new->learn_more != '')
                                                            <a href="{{$new->learn_more}}" class="btn learn-button">
                                                                Learn More
                                                            </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                                <div class="swiper-button-prev" id="trends-prev"></div>
                                <div class="swiper-button-next" id="trends-next"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Tab Container END -->

                </div>
                @endif

                @if($popular->count() > 0)
                <div class="tab-pane fade" id="pills-popular" role="tabpanel" aria-labelledby="pills-popular-tab">

                    <!-- Tab Container -->
                    <div class="">
                        <div class="col-12 ">
                            <div class="trends">
                                <div class="swiper js-Trending">
                                    <div class="swiper-wrapper">

                                        @foreach($popular as $key => $pop)
                                        <div class="swiper-slide pop_{{$new->products->category->slug}}">
                                            <div class="row align-items-center">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="trend-item">
                                                        @if($pop->image != '')
                                                        <img src="{{storage_url()}}/resized/xl/{{$pop->image}}"
                                                            loading="lazy">
                                                        @else
                                                        <img src="{{storage_url()}}/resized/xl/{{$pop->products->thumbnail}}"
                                                            loading="lazy">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="trend-product">
                                                        <h1>{{$pop->products->sku}}</h1>
                                                        <h4>{{$pop->products->category->name}}</h4>
                                                        <p>{{$pop->description}}</p>
                                                        <div class="group-button">
                                                            @php
                                                            if($pop->products->type == 0)
                                                            $online = $pop->products->online;
                                                            else
                                                            $online = $pop->products->parent->online;
                                                            @endphp

                                                            @if($online->count() > 0)
                                                            <a rel="noopener" href="{{$online[0]->online_link}}"
                                                                target="_blank" class="btn buy-button ">
                                                                Buy Now
                                                            </a>
                                                            @endif
                                                            @if($pop->learn_more != '')
                                                            <a href="{{$pop->learn_more}}" class="btn learn-button">
                                                                Learn More
                                                            </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                                <div class="swiper-button-prev" id="trends-prev"></div>
                                <div class="swiper-button-next" id="trends-next"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Tab Container END -->

                </div>
                @endif

                @if($offers->count() > 0)
                <div class="tab-pane fade" id="pills-offers" role="tabpanel" aria-labelledby="pills-offers-tab">

                    <!-- Tab Container -->
                    <div class="">
                        <div class="col-12 ">
                            <div class="trends">
                                <div class="swiper js-Trending">
                                    <div class="swiper-wrapper">

                                        @foreach($offers as $key => $offer)
                                        <div class="swiper-slide offer_{{$offer->products->category->slug}}">
                                            <div class="row align-items-center">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="trend-item">
                                                        @if($offer->image != '')
                                                        <img src="{{storage_url()}}/resized/xl/{{$offer->image}}"
                                                            loading="lazy">
                                                        @else
                                                        <img src="{{storage_url()}}/resized/xl/{{$offer->products->thumbnail}}"
                                                            loading="lazy">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="trend-product">
                                                        <h1>{{$offer->products->sku}}</h1>
                                                        <h4>{{$offer->products->category->name}}</h4>
                                                        <p>{{$offer->description}}</p>
                                                        <div class="group-button">
                                                            @php
                                                            if($offer->products->type == 0)
                                                            $online = $offer->products->online;
                                                            else
                                                            $online = $offer->products->parent->online;
                                                            @endphp

                                                            @if($online->count() > 0)
                                                            <a rel="noopener" href="{{$online[0]->online_link}}"
                                                                target="_blank" class="btn buy-button ">
                                                                Buy Now
                                                            </a>
                                                            @endif
                                                            @if($offer->learn_more != '')
                                                            <a href="{{$offer->learn_more}}" class="btn learn-button">
                                                                Learn More
                                                            </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                                <div class="swiper-button-prev" id="trends-prev"></div>
                                <div class="swiper-button-next" id="trends-next"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Tab Container END -->

                </div>
                @endif

            </div>
        </div>
    </div>
</section>
<!-- Trending END -->
@endif

@if(count($launchs) > 0)
<section class="section-new-launch">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto text-center">
                <div class="new-launch-header">
                    <h2 class="title">New Launches</h2>
                    <div class="short-description">
                        <p>Say hello to our new arrivals in town</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container new-launch-product-tabs">
        <div class="row">
            <div class="col-md-12 mx-auto tab-header">
                <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                    @php
                    $counter = 0;
                    @endphp

                    @foreach($launch_categories_parent as $category)
                    <li class="nav-item">
                        <a class="nav-link <?php echo reset($launchs)['products'][0]->category->parent->slug == $category->parent->slug? 'active':''; ?>"
                            id="pills-new-{{$category->parent->slug}}-tab" data-toggle="pill"
                            href="#pills-new-{{$category->parent->slug}}" role="tab"
                            aria-controls="pills-new-{{$category->parent->slug}}"
                            aria-selected="false">@if($category->parent->parent_id==0){{$category->name}}@else{{$category->parent->name}}@endif</a>
                    </li>
                    @php
                    $counter++;
                    @endphp
                    @endforeach


                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid p-lg-0">
        <div class="tab-content" id="pills-tabContent">
            @php
            $counter = 0;
            @endphp

            @foreach($launchs as $key => $category)
            <div class="tab-pane fade <?php echo $counter == 0?'show active':'';?>" id="pills-new-{{$key}}"
                role="tabpanel" aria-labelledby="pills-new-{{$key}}-tab">
                <!-- Tab Container -->
                <div class="tab-slider">
                    <div class="container slider-new-launch">
                        <div class="row">
                            <div class="col-md-7 mx-auto">
                                <div class="swiper-container js-new-launch">
                                    <!-- Additional required wrapper -->
                                    <div class="swiper-wrapper">
                                        @foreach($category['products'] as $product)
                                        <div class="swiper-slide new_launches_{{$product->slug}}">
                                            <!-- Slide -->
                                            <div class="item">
                                                <div class="shadow-effect">
                                                    <div class="card-body">
                                                        <img src="{{storage_url()}}/resized/xl/{{$product->thumbnail}}"
                                                            loading="lazy" class="img-fluid" alt="img">
                                                    </div>
                                                    <div class="card-footer">
                                                        <h4>{{$product->sku}}</h4>
                                                        <div class="details">{{$product->name}}</div>
                                                        <div class="group-button">

                                                            @php
                                                            if($product->type == 0)
                                                            $online = $product->online;
                                                            else
                                                            $online = $product->parent->online;
                                                            @endphp
                                                            @if($online)
                                                            @if($online->count() > 0)
                                                            <a rel="noopener" href="{{$online[0]->online_link}}"
                                                                target="_blank" class="btn buy-button ">
                                                                Buy Now
                                                            </a>
                                                            @endif
                                                            @endif

                                                            @if(isset($launches_link[$product->id]))
                                                            <a href="{{$launches_link[$product->id]}}"
                                                                class="btn learn-button">
                                                                Learn More
                                                            </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- Slide End -->
                                        </div>
                                        @endforeach
                                    </div>

                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Tab Container END -->

            </div>
            @php
            $counter++;
            @endphp
            @endforeach


        </div>
    </div>
</section>
@endif

@if($latest->count() > 0)
		<!-- Latest Videos -->
		<section class="section-videos">
		    <div class="container">
		        <div class="row">
		            <div class="col-md-8 mx-auto text-center">
		                <div class="video-block-header ">
		                    <h2 class="title">Our Latest Videos</h2>
		                    <div class="short-description">
		                        <p>Have a look at some of the clips we found intriguing</p>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>


		    <!-- Video Wrapper Web -->
		    <div class="video-wrapper-lg web">
		        <div class="video-carosel">
		            <div class="js-slider-video owl-theme owl-carousel">
		            	@php
		            		$latests = array_chunk($latest->toArray(),5);
		            		$mobile_latests = $latest;

		            	@endphp

		            	@foreach($latests as $latest)
			                <!-- Item -->
			                <div class="item">
			                    <div class="row">
			                        <div class="col-md-12 col-lg-3">
			                            <div class="row">
			                            	@if(isset($latest[0]))
			                                <div class="col-12 col-md-6 col-lg-12 mb-30 latest_{{$latest[0]['id']}}">

			                                    <div class="card">
			                                    	@if($latest[0]['type'] == 0)
			                                    		<a href="{{storage_url()}}/resized/small/{{$latest[0]['video']}}" data-fancybox="gallery">
			                                    	@else
			                                    		<a href="{{$latest[0]['video']}}" data-fancybox="gallery">
			                                    	@endif
				                                        <div class="product-card mb-3 mb-sm-0">
				                                            <!-- Background -->
				                                            <div class="card-bg">
				                                                <div class="card-bg-img bg-cover deferImage" data-src="<?php echo storage_url().'/'.$latest[0]['thumbnail']; ?>">
				                                                </div>
				                                            </div>
				                                            <!-- Body -->
				                                            <div class="card-body my-auto text-center">
				                                                <button class="video-play">
				                                                    <img src="{{asset('front/images/video-thumb/play.png')}}" loading="lazy" class="img-fluid"
				                                                        alt="icon">
				                                                </button>
				                                                <div class="details-block">
				                                                    <h4 style="color:{{$latest[0]['title_color_code']}}; @if($latest[0]['title_font_size']) font-size: {{$latest[0]['title_font_size']}}px @endif">{{$latest[0]['title']}}</h4>
				                                                    <div class="small-text sm-col" style="color:{{$latest[0]['description_color_code']}}; @if($latest[0]['description_font_size']) font-size: {{$latest[0]['description_font_size']}}px @endif">{{$latest[0]['description']}}</div>
				                                                </div>
				                                            </div>

				                                        </div>
				                                    </a>
			                                    </div>

			                                </div>
			                                @endif
			                                @if(isset($latest[1]))
			                                <div class="col-12 col-md-6 col-lg-12 mb-30 latest_{{$latest[1]['id']}}">

			                                    <div class="card">
			                                    	@if($latest[1]['type'] == 0)
			                                    		<a href="{{storage_url()}}/resized/small/{{$latest[1]['video']}}" data-fancybox="gallery">
			                                    	@else
			                                    		<a href="{{$latest[1]['video']}}" data-fancybox="gallery">
			                                    	@endif
				                                        <div class="product-card mb-3 mb-sm-0">
				                                            <!-- Background -->
				                                            <div class="card-bg">
				                                                <div class="card-bg-img bg-cover deferImage" data-src="<?php echo storage_url().'/'.$latest[1]['thumbnail']; ?>);">
				                                                </div>
				                                            </div>
				                                            <!-- Body -->
				                                            <div class="card-body my-auto text-center">
				                                                <button class="video-play">
				                                                    <img src="{{asset('front/images/video-thumb/play.png')}}" loading="lazy" class="img-fluid"
				                                                        alt="icon">
				                                                </button>
				                                                <div class="details-block">
																	<h4 style="color:{{$latest[1]['title_color_code']}}; @if($latest[1]['title_font_size']) font-size: {{$latest[1]['title_font_size']}}px @endif">{{$latest[1]['title']}}</h4>
				                                                    <div class="small-text sm-col" style="color:{{$latest[1]['description_color_code']}}; @if($latest[1]['description_font_size']) font-size: {{$latest[1]['description_font_size']}}px @endif">{{$latest[1]['description']}}</div>
				                                                </div>
				                                            </div>

				                                        </div>
				                                    </a>
			                                    </div>

			                                </div>
			                                @endif
			                            </div>
			                        </div>

			                        @if(isset($latest[2]))
				                        <div class="col-lg-6 mb-30 latest_{{$latest[2]['id']}}">

				                            <div class="card">
				                            	@if($latest[2]['type'] == 0)
			                                    		<a href="{{storage_url()}}/resized/medium/{{$latest[2]['video']}}" data-fancybox="gallery">
			                                    	@else
			                                    		<a href="{{$latest[2]['video']}}" data-fancybox="gallery">
			                                    	@endif
					                                <div class="product-card mb-3 mb-sm-0">
					                                    <!-- Background -->
					                                    <div class="card-bg">
					                                        <div class="card-bg-img bg-cover deferImage" data-src="<?php echo storage_url().'/'.$latest[2]['thumbnail']; ?>);">
					                                        </div>
					                                    </div>
					                                    <!-- Body -->
					                                    <div class="card-body lg-col  my-auto text-center">
					                                        <button class="video-play">
					                                            <img src="{{asset('front/images/video-thumb/play-lg.png')}}" loading="lazy" class="img-fluid"
					                                                alt="icon">
					                                        </button>
					                                        <div class="details-block">
																<h4 style="color:{{$latest[2]['title_color_code']}}; @if($latest[2]['title_font_size']) font-size: {{$latest[2]['title_font_size']}}px @endif">{{$latest[2]['title']}}</h4>
																<div class="small-text sm-col" style="color:{{$latest[2]['description_color_code']}}; @if($latest[2]['description_font_size']) font-size: {{$latest[2]['description_font_size']}}px @endif">{{$latest[2]['description']}}</div>
															</div>
					                                    </div>

					                                </div>
					                            </a>
				                            </div>


				                        </div>
				                    @endif

			                        <div class="col-md-12 col-lg-3">
			                            <div class="row">
			                                @if(isset($latest[3]))
			                                <div class="col-12 col-md-6 col-lg-12 mb-30 latest_{{$latest[3]['id']}}">

			                                    <div class="card">
			                                    	@if($latest[3]['type'] == 0)
			                                    		<a href="{{storage_url()}}/resized/small/{{$latest[3]['video']}}" data-fancybox="gallery">
			                                    	@else
			                                    		<a href="{{$latest[3]['video']}}" data-fancybox="gallery">
			                                    	@endif
				                                        <div class="product-card mb-3 mb-sm-0">
				                                            <!-- Background -->
				                                            <div class="card-bg">
				                                                <div class="card-bg-img bg-cover deferImage" data-src="<?php echo storage_url().'/'.$latest[3]['thumbnail']; ?>);">
				                                                </div>
				                                            </div>
				                                            <!-- Body -->
				                                            <div class="card-body my-auto text-center">
				                                                <button class="video-play">
				                                                    <img src="{{asset('front/images/video-thumb/play.png')}}" loading="lazy" class="img-fluid"
				                                                        alt="icon">
				                                                </button>
				                                                <div class="details-block">
																	<h4 style="color:{{$latest[3]['title_color_code']}}; @if($latest[3]['title_font_size']) font-size: {{$latest[3]['title_font_size']}}px @endif">{{$latest[3]['title']}}</h4>
				                                                    <div class="small-text sm-col" style="color:{{$latest[3]['description_color_code']}}; @if($latest[3]['description_font_size']) font-size: {{$latest[3]['description_font_size']}}px @endif">{{$latest[3]['description']}}</div>
				                                                </div>
				                                            </div>

				                                        </div>
				                                    </a>




			                                    </div>

			                                </div>
			                                @endif

			                                @if(isset($latest[4]))
			                                <div class="col-12 col-md-6 col-lg-12 mb-30 latest_{{$latest[4]['id']}}">

			                                    <div class="card">
			                                    	@if($latest[4]['type'] == 0)
			                                    		<a href="{{storage_url()}}/resized/small/{{$latest[4]['video']}}" data-fancybox="gallery">
			                                    	@else
			                                    		<a href="{{$latest[4]['video']}}" data-fancybox="gallery">
			                                    	@endif
				                                        <div class="product-card mb-3 mb-sm-0">
				                                            <!-- Background -->
				                                            <div class="card-bg">
				                                                <div class="card-bg-img bg-cover deferImage" data-src="<?php echo storage_url().'/'.$latest[4]['thumbnail']; ?>);">
				                                                </div>
				                                            </div>
				                                            <!-- Body -->
				                                            <div class="card-body my-auto text-center">
				                                                <button class="video-play">
				                                                    <img src="{{asset('front/images/video-thumb/play.png')}}" loading="lazy" class="img-fluid"
				                                                        alt="icon">
				                                                </button>
				                                                <div class="details-block">
																	<h4 style="color:{{$latest[4]['title_color_code']}}; @if($latest[4]['title_font_size']) font-size: {{$latest[4]['title_font_size']}}px @endif">{{$latest[4]['title']}}</h4>
				                                                    <div class="small-text sm-col" style="color:{{$latest[4]['description_color_code']}}; @if($latest[4]['description_font_size']) font-size: {{$latest[4]['description_font_size']}}px @endif">{{$latest[4]['description']}}</div>
				                                                </div>
				                                            </div>

				                                        </div>
				                                    </a>
			                                    </div>

			                                </div>
			                                @endif
			                            </div>
			                        </div>

			                    </div>
			                </div>
			                <!-- Item END -->
		                @endforeach

		            </div>
		        </div>
		    </div>
		    <!-- Video Wrapper web END -->
			<!-- Video Wrapper  mobile start-->
			<div class="video-wrapper-lg mobile">
				<div class="video-carosel">
					<div class="js-slider-video owl-theme owl-carousel">
					

		            	@foreach($mobile_latests as $key => $mobile_latest)
						{{-- @if($key <= 5) --}}
						<?php //dd($mobile_latest->video);?>
						<!-- Item -->
						<div class="item mobile_latest_{{$mobile_latest->id}}">
							<div class="card">
								@if($mobile_latest->type == 0)
									<a href="{{storage_url()}}/resized/small/{{$mobile_latest->video}}" data-fancybox="gallery">
								@else
									<a href="{{$mobile_latest->video}}" data-fancybox="gallery">
								@endif
								<!-- <a href="assets/images/video-thumb/vl-01.png" data-fancybox="gallery"> -->
									<div class="product-card mb-3 mb-sm-0">
										<!-- Background -->
										<div class="card-bg">
											<div class="card-bg-img bg-cover deferImage" data-src="<?php echo storage_url().'/'.$mobile_latest->thumbnail; ?>);">
											</div>
										</div>
										<!-- Body -->
										<div class="card-body my-auto text-center">
											<button class="video-play">
												<img src="{{asset('front/images/video-thumb/play.png')}}" loading="lazy" class="img-fluid"
													alt="icon">
											</button>
											<div class="details-block">
												<h4 style="color:{{$mobile_latest->title_color_code}}; @if($mobile_latest->title_font_size) font-size: {{$mobile_latest->title_font_size}}px @endif">{{$mobile_latest->title}}</h4>
				                                <div class="small-text sm-col" style="color:{{$mobile_latest->description_color_code}}; @if($mobile_latest->description_font_size) font-size: {{$mobile_latest->description_font_size}}px @endif">{{$mobile_latest->description}}</div>
											</div>
										</div>

									</div>
								</a>
							</div>
						</div>
						{{-- @endif --}}
						<!-- item -->
						@endforeach
					</div>

					<!-- <div class="text-center">
						<a href="" class="btn learn-button">
							Learn More
						</a>
					</div> -->
				</div>
			</div>
    <!-- Video Wrapper END -->

		</section>
		<!-- Latest Videos END -->
	@endif


<!-- Subscription -->
<section class="section-subscription">
    <div class="img image-overlay web deferImage" data-src="{{storage_url()}}/{{$latest_blogs->image}}"></div>
    <div class="img image-overlay mobile deferImage" data-src="{{storage_url()}}/{{$latest_blogs->mobile_image}}"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-6  py-5">
                {!! $latest_blogs->description !!}
            </div>
            <div class="col-md-5 offset-md-1 py-5 aside-stretch">
                <div class="subscribeUs">
                    <div class="card subscript-form">
                        <h2>Subscribe Us</h2>
                        <div class="note">Be first to know about our latest products & services.</div>

                        <div class="news-letter">
                            <form method="post" id="form_subscription">
                                {{ csrf_field() }}
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" type="email" name="email" id="email"
                                        placeholder="Subscribe for newsletters" aria-label="subscribe for newsletters"
                                        aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn " type="submit">
                                            <img src="{{asset('public/front/images/icons/right-arrow.png')}}"
                                                loading="lazy" alt="">
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <span style="color:red" id="subscribe_message"></span>
                        </div>
                        
                </div>
            </div> 
        </div>
    </div>
</section>
<!-- Subscription END -->

<section class="mobile-subscribe">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card subscript-form">
                    <h2>Subscribe Us</h2>
                    <div class="note">Be first to know about our latest products & services.</div>

                    <div class="news-letter">
                        <form method="post" id="form_subscription">
                            {{ csrf_field() }}
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" type="email" name="email" id="email"
                                    placeholder="Subscribe for newsletters" aria-label="subscribe for newsletters"
                                    aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn " type="submit">
                                        <img src="{{asset('front/images/icons/news-arrow.png')}}" loading="lazy"
                                            alt="">
                                    </button>
                                </div>
                            </div>
                        </form>
                        <span style="color:red" id="subscribe_message"></span>
                    </div>
                    <div class="social">
                        <div class="block">
                            <h4>Follow Us</h4>
                        </div>

                        <div class="social-links">
                            @if($settings->facebook)
                            <a href="{{$settings->facebook}}" class="icon" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            @endif
                            @if($settings->twitter)
                            <a href="{{$settings->twitter}}" class="icon" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                            @endif
                            @if($settings->instagram)
                            <a href="{{$settings->instagram}}" class="icon" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                            @endif
                            @if($settings->linkedin)
                            <a href="{{$settings->linkedin}}" class="icon" target="_blank">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            @endif
                            @if($settings->youtube)
                            <a href="{{$settings->youtube}}" class="icon" target="_blank">
                                <i class="fab fa-youtube"></i>
                            </a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Services -->
<section class="section-service-cu">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto text-center">
                <div class="customer-header">
                    <h2 class="title">Customer
                        Service</h2>
                    <div class="short-description">
                        <p>We would be more than happy to assist you. Please feel free to connect with us.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container service-block">
        <div class="row no-gutters">

            <div class="col-sm-6 col-md-6 col-lg-4 mb-3 border-l">
                <div class="card text-center">
                    <div class="sm-icon">
                        <img src="{{asset('front/images/icons/call.png')}}" loading="lazy" alt="icon">
                    </div>
                    <h4>Phone</h4>
                    <div class="text-small">
                        <a href="{{URL('contact')}}">
                            @if($settings){{$settings->mobile}}@endif <br>
                            @if($settings){{$settings->timing}}@endif<br>Except national holidays
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-4 mb-3 border-l">
                <div class="card text-center">
                    <div class="sm-icon">
                        <img src="{{asset('front/images/icons/service-request.png')}}" loading="lazy" alt="icon">
                    </div>
                    <h4>Request Service</h4>
                    <div class="text-small"><a href="https://tinyurl.com/servicetz" rel="noopener" target="_blank">
                            <div class="text-small">Register Your Service Request
                            </div>
                        </a></div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-4 mb-3 border-l">
                <div class="card text-center">
                    <div class="sm-icon">
                        <img src="./front/images/icons/locate-service-center.png" loading="lazy"
                            style="width: 41px;" alt="icon">
                    </div>
                    <h4>Service Center</h4>
                    <div class="text-small"><a href="{{URL('service/centers')}}">
                            <div class="text-small">Locate Your Nearest Service Center
                            </div>
                        </a> </div>
                </div>
            </div>


        </div>
    </div>
</section>
<!-- Services END -->

<!-- <section class="section-cookie" id="cookie_div" style="display:none"> -->
<section class="section-cookie" id="cookie_div" style="display:none">
    <div class="cookie-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <h4>We Value Your Privacy</h4>
                    <div class="short-note">
                        We use cookies to personalize and enhance your browsing experience on our websites.By clicking
                        "Accept all cookies", you agree to the use of cookies.You can manage your settings at any time
                        through Cookie Preferences or read our <a target="_blank" href="{{URL('privacyPolicy')}}">Cookie
                            Policy</a> to learn more.
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ml-md-auto">
                        <div class="group-button">
                            <a onClick="accept()" class="btn btn-accept ml-md-auto ">
                                Accept All
                            </a>
                            <a href="" class="btn btn-preferences ml-md-auto" data-toggle="modal"
                                data-target="#cookiesModal">
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn close-btn js-close-cookie">
                <i class="lni lni-close"></i>
            </button>
        </div>
</section>
<!-- Cookie Wrapper END -->
@if($pop_offer != null)
@if($pop_offer->type == 0)
<div class="modal fade serviceNsupport" id="modalPreload" tabindex="-1" role="dialog"
    aria-labelledby="modalPreloadTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn close-modal" data-dismiss="modal" aria-label="Close"
                onClick="offerAccept()">
                <i class="lni lni-close"></i>
            </button>
            <div class="full-model">
                <div class="left-image">
                    <img src="{{storage_url()}}/resized/large/{{$pop_offer->products->thumbnail}}" loading="lazy"
                        class="img-fluid" alt="">
                </div>
                <div class="right-content">
                    <div class="offer-content">
                        <div class="md-title">{{$pop_offer->title}}</div>
                        <div class="lg-title">
                            {{$pop_offer->sub_title}}
                        </div>
                        <div class="short-descript">
                            <p>{{$pop_offer->description}}</p>
                        </div>
                        <a onClick="offerAccept()" href="{{URL('products/detail')}}/{{$pop_offer->products->slug}}"
                            class="btn btn-shop-now">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="modal fade" id="modalOfferModal" tabindex="-1" role="dialog" aria-labelledby="offerModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn close-modal" data-dismiss="modal" aria-label="Close"
                onClick="offerAccept()">
                <i class="lni lni-close"></i>
            </button>
            <div class="modal-wrap">
                <div class="">
                    <img src="{{storage_url()}}/resized/large/{{$pop_offer->products->thumbnail}}" loading="lazy"
                        class="img-fluid img-center" alt="img">
                </div>
                <div class="content-right">
                    <div class="modal-content text-center">
                        <div class="md-title">{{$pop_offer->title}}</div>
                        <div class="lg-title">
                            {{$pop_offer->sub_title}}
                        </div>
                        <div class="short-descript">
                            <p>{{$pop_offer->description}}</p>
                        </div>

                        <form method="POST" action="{{URL('postOfferInterest')}}">
                            @csrf
                            <div class="application-body text-left mb-2">
                                <div class="row">
                                    <input type="hidden" name="offer_id" value="{{$pop_offer->id}}">
                                    <input type="hidden" name="product_slug" value="{{$pop_offer->products->slug}}">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">First Name</label>
                                            <input type="text" class="form-control" name="first_name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Last Name</label>
                                            <input type="text" class="form-control" name="last_name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" class="form-control" name="email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Phone</label>
                                            <input type="text" class="form-control" name="phone" required
                                                pattern="[0-9]*"
                                                oninvalid="setCustomValidity('Enter correct mobile number')"
                                                onchange="try{setCustomValidity('')}catch(e){}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">State</label>
                                            <select class="form-control" name="state" required>
                                                <option value=""></option>
                                                @foreach($states as $state)
                                                <option value="{{$state->name}}">{{$state->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">City</label>
                                            <input type="text" class="form-control" name="city" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center" onClick="offerAccept()">
                                <button type="submit" class="btn btn-shop-now">Shop Now</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@endif

@endif

@stop
