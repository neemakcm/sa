@extends('pages::layouts.master')

@section('meta_title', $product->meta_title)
@section('meta_tags', $product->meta_tags)
@section('meta_description', $product->meta_description)


@section('content')

<link href="{{asset('public/front/css/template-style.css')}}" rel="stylesheet" />

<main>
    <section class="margin-sub-pad border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-top">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL('/')}}">Home</a></li>
                    @if($product->category->parent != null && $product->category->parent->parent_id != 0)
                        <li class="breadcrumb-item"><a href="{{URL('products/'.$product->category->parent->slug)}}">{{$product->category->parent->name}}</a></li>
                    @endif
                    <li class="breadcrumb-item"><a href="{{URL('products/'.$product->category->slug)}}">{{$product->category->name}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> {{$product->name}}</li>
                </ol>
            </nav>
        </div>
    </section>

    @if(session()->has('message'))
        <div class="col-12 alert {{ session()->get('alert-class') }} alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session()->get('message') }}
        </div>
    @endif

    <!-- Product Main -->
    <section class="product-detail-wrapper">
        <div class="container-large">
            <div class="row">
                <div class="col-12">
                    <div class="product-grid-main">

                        <div class="product-col-left">
                            <div class="vertical-product-carousel banner-content clearfix">
                                <div class="slider-container">

                                    <div class="slider-left slider-nav thumb-image d-none d-md-block" id="slider-left">
                                        <?php //$data=json_encode($img_array);?>

                                        @foreach($img_array as $key => $images)
                                            @if($images['status']==1 && $product->url)
                                                <div class="thumbnail-image">
                                                    <div class="thumbImg">
                                                        <div class="videoIcon"><div class="video-play-button"><span></span></div><img src="{{storage_url()}}/resized/small/{{$images['image']}}" class="img-fluid"
                                                        alt="{{$images['alt'] ? $images['alt']: 'slider-img'}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="thumbnail-image">
                                                    <div class="thumbImg">
                                                    {{-- {{$key}} --}}
                                                        <img src="{{storage_url()}}/resized/small/{{$images['image']}}" class="img-fluid"
                                                            alt="{{$images['alt'] ? $images['alt']: 'slider-img'}}">

                                                    </div>
                                                </div>
                                            @endif
	                                    @endforeach

                                    </div>

                                    <div class="slider-right slider-for zoom_effect visible_hide" style="">
                                        @foreach($img_array as $key => $images)
                                        @if($images['status']==1 && $product->url)
                                            <div class="slider-item">
                                               <div class="videoIcon deferImage" id="videoPop" data-src="{{storage_url()}}/resized/detail/{{$images['image']}}">
                                                    <div class="video-play-button">
                                                        <span></span>
                                                    </div>
                                                </div>

                                            </div>
                                            @else
                                            <div class="slider-item">
                                                <img src="{{storage_url()}}/resized/detail/{{$images['image']}}" data-zoom-image="{{storage_url()}}/resized/zoom_detail/{{$images['image']}}" class="img-fluid"
                                                    alt="{{$images['alt'] ? $images['alt']: 'image'}}">
                                            </div>
                                            @endif

	                                    @endforeach

                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="product-col-right">
                            <div class="product-info">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <div class="product-info__code">
                                            <span class="mr-4">
                                                {{$product->sku}}
                                            </span>
                                            @if($product->is_new)
	                                            <div class="product-info__tag">
	                                                New
	                                            </div>
	                                        @endif
                                        </div>
                                    </div>
                                    <div class="product-info__share-btn clipboard">
                                        <button>
                                            <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
                                            <img src="{{asset('public/front/images/icons/share.svg')}}">
                                        </button>
                                    </div>
                                </div>
                                <h1 class="product-info__title">
                                    {{$product->name}}
                                </h1>
                                <div class="product-info__desc">
                                    {!! $product->description !!}
                                </div>

                                @if($varients->count() > 0)
	                                <div class="product-info__size-chart">
	                                    <div class="product-info__label">
	                                        Available {{$varient_attributes[0]->attribute->name}}
	                                    </div>
	                                    <ul class="list-inline">
                                            @foreach($varients as $varient)
    	                                        <li class="list-inline-item">
    	                                            <a href="{{URL('products/detail')}}/{{$varient->slug}}">
    	                                                <div class="item-size <?php echo $varient->id == $product->id?'active':''; ?>">
    	                                                    {{$varient->attributes[0]->value}}
    	                                                </div>
    	                                            </a>
    	                                        </li>
                                            @endforeach
	                                    </ul>
	                                </div>
                               	@endif

                                <div class="product-price-card">
                                    <div class="product-price">
                                        SAR {{$product->offer_price}}
                                    </div>
                                    @if($product->offer_price != $product->price)
                                        <div class="product-price-sub">
                                            <span class="mr-3">
                                                <del>SAR {{$product->price}}</del>
                                            </span>
                                            <span class="text-italic ">
                                                Save SAR {{round($product->price-$product->offer_price,2)}}
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                @php
                                    if($product->type == 0)
                                        $online = $product->online;
                                    else
                                        $online = $product->parent->online;

                                @endphp
                                 <div class="button-group">
                            @if($product->product_code)
 @include('products::front.shopify-product-code')
@endif

                                    <a class="btn btn-buy-online <?php echo $online->count() == 0?'online_disable':''; ?>" id="buyOnline">
                                        Buy Online
                                    </a>
                                    <a class="btn btn-visit-store" href="{{URL('stores')}}">
                                        Visit Store
                                    </a>
                                    <div class="add_compare btn btn-visit-store" data-product_id="{{$product->id}}">
                                        <a>Add to Compare</a>
                                    </div>
                                </div>


                                @if($online->count() > 0)
                                    <div class="online-shops" style="display:none">
                                        <div class="D--flex">
                                            @foreach($online as $onlne)
                                                <div class="buy-onlines">
                                                    <a rel="noopener" class="btn btn-shop-online " href="{{$onlne->online_link}}" target="_blank" >
                                                        <img src="@if($onlne->vendor){{storage_url()}}/resized/small/{{$onlne->vendor->image}}@endif" class="img-fluid"
                                                            alt="icon">
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif


                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close">&times;</span>
                </div>
                <div class="modal-body">
                    <iframe id="pause" width="100%" height="100%" src="{{$product->url}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Main END -->

    <!-- Product Description -->
    <section class="product-description_tab">

        <!-- Tab Header -->
        <div class="tab-wrapper-head nav-sticky">
            <div class="inner-container">
                <ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-overview-tab" data-toggle="pill" href="#pills-overview"
                            role="tab" aria-controls="pills-overview" aria-selected="true">
                            <div class="text-block">
                                <span>
                                    <img src="{{asset('public/front/images/icons/icon-overview.svg')}}" class="img-fluid" alt="icon">
                                </span>
                                Overview
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-specification-tab" data-toggle="pill" href="#pills-specification"
                            role="tab" aria-controls="pills-specification" aria-selected="false">
                            <div class="text-block">
                                <span>
                                    <img src="{{asset('public/front/images/icons/icon-spec.svg')}}" class="img-fluid" alt="icon">
                                </span>
                                Specifications
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-reviews-tab" data-toggle="pill" href="#pills-reviews" role="tab"
                            aria-controls="pills-reviews" aria-selected="false">
                            <div class="text-block">
                                <span>
                                    <img src="{{asset('public/front/images/icons/icon-review.svg')}}" class="img-fluid" alt="icon">
                                </span>
                                Reviews
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-support-tab" data-toggle="pill" href="#pills-support" role="tab"
                            aria-controls="pills-support" aria-selected="false">
                            <div class="text-block">
                                <span>
                                    <img src="{{asset('public/front/images/icons/icon-support.svg')}}" class="img-fluid" alt="icon">
                                </span>
                                Support
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-faq-tab" data-toggle="pill" href="#pills-faq" role="tab"
                            aria-controls="pills-faq" aria-selected="false">
                            <div class="text-block">
                                <span>
                                    <img src="{{asset('public/front/images/icons/icon-faq.svg')}}" class="img-fluid" alt="icon">
                                </span>
                                FAQs
                            </div>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
        <!-- Tab Header END -->

        <!-- Tab Wrapper -->

        <div class="tab-panel_block">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade  show active" id="pills-overview" role="tabpanel" aria-labelledby="pills-overview-tab">

                    {!! $product->overview !!}
                    <style type="text/css">
                        {{ $product->overview_style }}
                    </style>


                    <?php
                        if($compare->count() > 0)
                            $compare_list = $compare->pluck('id')->toArray();
                        else
                            $compare_list = array();

                    ?>

                    <!-- Container -->
                    @if($related->count() > 0)
                        <div class="container section-gap-large">
                            <div class="row">
                                <div class="col-12 col-md-10 col-lg-8 mx-auto text-center">
                                    <div class="card transparent-card mb-5">
                                        <h2 class="bold-title" data-sal="slide-up" data-sal-delay="50"
                                            data-sal-easing="ease-out-back">Related Products</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 product-slide_wrap ">
                                <div class="js-item-list owl-carousel owl-theme">
                                    @foreach($related as $relate)
                                        <div class="item">
                                            <div class="product-single">
                                                <!-- <button class="wish-list">
                                                    <i class="lni lni-heart"></i>
                                                </button> -->
                                                <div class="image-container">
                                                    <a href="{{URL('products/detail')}}/{{$relate->slug}}"><img src="{{storage_url()}}/resized/medium/{{$relate->thumbnail}}" class="img-fluid img-auto "
                                                        alt="img"></a>
                                                </div>
                                                <div class="content-body">
                                                    <h4 class="product-caption"><a href="{{URL('products/detail')}}/{{$relate->slug}}">{{$relate->name}}</a></h4>
                                                    <div class="current-price">
                                                        <span><i class="lni lni-rupee"></i></span>
                                                        {{$relate->offer_price}}
                                                    </div>
                                                    @if($relate->offer_price < $relate->price)
                                                        <div class="flex-group">
                                                            <div class="initial-price">
                                                                <span><i class="lni lni-rupee"></i></span>
                                                                {{$relate->price}}
                                                            </div>
                                                            <div class="discount-price">Save <span><i
                                                                        class="lni lni-rupee"></i></span>
                                                                {{$relate->price-$relate->offer_price}}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <hr>
                                                <div class="content-footer">
                                                    @if($relate->type == 0)
                                                        {!! $relate->short_description !!}
                                                    @else
                                                        @if($relate->parent)
                                                            {!! $relate->parent->short_description !!}
                                                        @endif
                                                    @endif
                                                    <a href="{{URL('products/detail')}}/{{$relate->slug}}" class="btn btn-block button-buy-now"> Buy Online</a>
                                                        <a class="btn btn-block button-visit-store" href="{{URL('stores')}}">
                                                    Visit Store
                                                </a>
                                                    <div class="text-center">
                                                        <a class="btn btn-block button-compare add_compare <?php echo in_array($relate->id, $compare_list)?'active':'';  ?>" data-product_id="{{$relate->id}}">
                                                        <i class="fas fa-check"></i>
                                                    <i class="lni lni-plus"></i>
                                                        Add to Compare</a>
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- Container END -->

                </div>
                <div class="tab-pane fade" id="pills-specification" role="tabpanel"
                    aria-labelledby="pills-specification-tab">
                    <!-- Tab Container -->
                    <div class="container tab-spec ">

                        {!! $product->specification !!}


                    </div>
                    <!-- Tab Container END -->

                </div>
                <div class="tab-pane fade " id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">

                	@if($reviews->count() > 0)
                		<?php
                			$overall = round($reviews->avg('rating'));
                		?>

	                    <!-- Container -->
	                    <div class="container review-wrapper">
	                        <div class="row">
	                            <div class="col-12 col-md-12 col-lg-10 mx-auto">
	                                <div class="card boxed-reviews">
	                                    <div class="box-inner">
	                                        <div class="rating-overall">
	                                            <h4 class="text-small">Overall Rating</h4>
	                                            <h2 class="text-large">{{$overall}}</h2>
	                                            <ul class="list-inline rating-star">
	                                            	@for($i=1;$i<=5;$i++)
		                                                <li class="list-inline-item">
		                                                    <i class="fas fa-star <?php echo $i<=$overall?'fill-star':''; ?> "></i>
		                                                </li>
		                                            @endfor
	                                            </ul>
	                                            <div class="small-text">Based On {{$reviews->count()}} Reviews</div>
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#reviewModal">Write a review</button>
	                                        </div>
	                                        <div class="rating-desc">
	                                            <h4 class="text-small">Rating Breakdown</h4>

	                                            <div class="media-group">
	                                                <div class="media media-object">
	                                                    <div class="col-left align-self-center ">
	                                                        <div class="rating">
	                                                            5
	                                                            <span>
	                                                                <i class="fas fa-star"></i>
	                                                            </span>
	                                                        </div>
	                                                    </div>
	                                                    <div class="media-body align-self-center ">
	                                                        <div class="progress">
	                                                            <div class="progress-bar progress-bar-success success-progress "
	                                                                role="progressbar" aria-valuenow="20" aria-valuemin="0"
	                                                                aria-valuemax="{{($reviews->where('rating',5)->count()/$reviews->count())*100}}" style="width: {{($reviews->where('rating',5)->count()/$reviews->count())*100}}%">

	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                    <div class="col-right align-self-center ">
	                                                        <div class="review-count">
	                                                            {{$reviews->where('rating',5)->count()}}
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <div class="media-group">
	                                                <div class="media media-object">
	                                                    <div class="col-left align-self-center ">
	                                                        <div class="rating">
	                                                            4
	                                                            <span>
	                                                                <i class="fas fa-star"></i>
	                                                            </span>
	                                                        </div>
	                                                    </div>
	                                                    <div class="media-body align-self-center ">
	                                                        <div class="progress">
	                                                            <div class="progress-bar progress-bar-success primary-progress"
	                                                                role="progressbar" aria-valuenow="20" aria-valuemin="0"
	                                                                aria-valuemax="{{($reviews->where('rating',4)->count()/$reviews->count())*100}}" style="width: {{($reviews->where('rating',4)->count()/$reviews->count())*100}}%">

	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                    <div class="col-right align-self-center ">
	                                                        <div class="review-count">
	                                                            {{$reviews->where('rating',4)->count()}}
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>

	                                            <div class="media-group">
	                                                <div class="media media-object">
	                                                    <div class="col-left align-self-center ">
	                                                        <div class="rating">
	                                                            3
	                                                            <span>
	                                                                <i class="fas fa-star"></i>
	                                                            </span>
	                                                        </div>
	                                                    </div>
	                                                    <div class="media-body align-self-center ">
	                                                        <div class="progress">
	                                                            <div class="progress-bar progress-bar-success info-progress"
	                                                                role="progressbar" aria-valuenow="20" aria-valuemin="0"
	                                                                aria-valuemax="{{($reviews->where('rating',3)->count()/$reviews->count())*100}}" style="width: {{($reviews->where('rating',3)->count()/$reviews->count())*100}}%">

	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                    <div class="col-right align-self-center ">
	                                                        <div class="review-count">
	                                                            {{$reviews->where('rating',3)->count()}}
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>

	                                            <div class="media-group">
	                                                <div class="media media-object">
	                                                    <div class="col-left align-self-center ">
	                                                        <div class="rating">
	                                                            2
	                                                            <span>
	                                                                <i class="fas fa-star"></i>
	                                                            </span>
	                                                        </div>
	                                                    </div>
	                                                    <div class="media-body align-self-center ">
	                                                        <div class="progress">
	                                                            <div class="progress-bar progress-bar-success warning-progress"
	                                                                role="progressbar" aria-valuenow="20" aria-valuemin="0"
	                                                                aria-valuemax="{{($reviews->where('rating',2)->count()/$reviews->count())*100}}" style="width: {{($reviews->where('rating',2)->count()/$reviews->count())*100}}%">

	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                    <div class="col-right align-self-center ">
	                                                        <div class="review-count">
	                                                            {{$reviews->where('rating',2)->count()}}
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>

	                                            <div class="media-group">
	                                                <div class="media media-object">
	                                                    <div class="col-left align-self-center ">
	                                                        <div class="rating">
	                                                            1
	                                                            <span>
	                                                                <i class="fas fa-star"></i>
	                                                            </span>
	                                                        </div>
	                                                    </div>
	                                                    <div class="media-body align-self-center ">
	                                                        <div class="progress">
	                                                            <div class="progress-bar progress-bar-success danger-progress"
	                                                                role="progressbar" aria-valuenow="20" aria-valuemin="0"
	                                                                aria-valuemax="{{($reviews->where('rating',1)->count()/$reviews->count())*100}}" style="width: {{($reviews->where('rating',1)->count()/$reviews->count())*100}}%">

	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                    <div class="col-right align-self-center ">
	                                                        <div class="review-count">
	                                                            {{$reviews->where('rating',1)->count()}}
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>

	                                        </div>
	                                    </div>
	                                </div>
	                            </div>

	                            <!-- Review Header -->
	                            <div class="col-12 col-md-10 col-lg-8 mx-auto">
	                                <div class="card review-header_wrap text-center">
	                                    <h3>What People Are Saying</h3>
	                                </div>
	                            </div>
	                            <!-- Review Header -->

	                        </div>


	                        <div class="testimonial-wrapper">
	                            <div class="row">

	                            	@foreach($reviews as $review)
		                                <!-- Testimonials -->
		                                <div class="col-12 col-md-12 col-lg-6 mb-4">
		                                    <div class="card testimonial-box">
		                                        <div class="card-body">
		                                            <div class="media">
		                                                <div class="avatar-image">
		                                                	@if($review->image == null)
		                                                    	<img src="{{asset('public/front/images/user.png')}}" class="img-fluid" alt="avatar">
		                                                    @else
		                                                    	<img src="{{storage_url()}}/{{$review->image}}" class="img-fluid" alt="avatar">
		                                                    @endif
		                                                </div>
		                                                <div class="media-body">
		                                                    <div class="d-flex flex-wrap justify-content-between">
		                                                        <ul class="list-inline rating-star mr-3">
		                                                            @for($i=1;$i<=5;$i++)
						                                                <li class="list-inline-item">
						                                                    <i class="fas fa-star <?php echo $i<=$review->rating?'fill-star':''; ?> "></i>
						                                                </li>
						                                            @endfor
		                                                        </ul>
		                                                        <div class="posted-on">
		                                                            {{date('d M Y',strtotime($review->created_at))}}
		                                                        </div>
		                                                    </div>
		                                                    <h4 class="avatar-name">{{$review->name}}</h4>

		                                                    <div class="review-box">
		                                                        <h5 class="small-text">{{$review->title}} </h5>
		                                                        <div class="details">
		                                                            <p>{{$review->review}}</p>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>

		                                    </div>
		                                </div>
		                                <!-- Testimonials END -->
		                            @endforeach

	                            </div>
	                        </div>

	                    </div>
	                    <!-- Container END -->

                    @else

                    	<!-- Container -->
                        <div class="container review-wrapper">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-10 mx-auto">
                                    <div class="small-text"><a href="#" data-toggle="modal" data-target="#reviewModal">Be the first to review this item</a></div>
                                    <br>
                                </div>

                            </div>

                        </div>
                        <!-- Container END -->

                    @endif

                </div>

                <div class="tab-pane fade" id="pills-support" role="tabpanel" aria-labelledby="pills-support-tab">

                    <!-- Tab Container -->
                    <div class="container help-support">
                        <div class="row no-gutters">
                            <div class="col-12  mb-3 mb-lg-5">
                                <div class="section-header text-center">
                                    <h2 class="title-md">Simply choose a support option</h2>
                                </div>
                            </div>
                        </div>

                        <div class="support-box">
                            <div class="row no-gutters">

                                <div class="col-sm-6 col-md-6 col-lg-4 mb-4 border-l">
                                    <div class="card text-center box-inner">
                                        <div class="sm-icon">
                                            <img src="{{asset('public/front/images/icons/call.png')}}" alt="icon">
                                        </div>
                                        <h4 class="box-title">Phone</h4>
                                        <a href="{{URL('contact')}}">
                                        <div class="text-small">@if($settings){{$settings->mobile}}@endif</div>
                                        <div class="text-small">@if($settings){{$settings->timing}}@endif</div>
                                        <div class="text-small">Except national holidays</div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-4 mb-4 border-l">
                                    <div class="card text-center box-inner">
                                        <div class="sm-icon">
                                            <img src="{{asset('public/front/images/icons/service-request.png')}}" alt="icon">
                                        </div>
                                        <h4 class="box-title">Request Service</h4>
                                        <a href="https://tinyurl.com/servicetz" rel="noopener" target="_blank">
                                            <div class="text-small">Register Your Service Request
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-4 mb-4 border-l">
                                    <div class="card text-center box-inner">
                                        <div class="sm-icon">
                                            <img src="{{asset('public/front/images/icons/locate-service-center.png')}}" style="width: 41px;" alt="icon">
                                        </div>
                                        <h4 class="box-title">Find Service Center</h4>
                                        <a href="{{URL('service/centers')}}">
                                            <div class="text-small">Locate Your Nearest Service Center
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            </div>


                        </div>

                        <div class="row no-gutters">
                            <div class="col-12  mb-3 mb-lg-5">
                                <div class="section-header text-center">
                                    <h2 class="title-md">What can we help you ?</h2>
                                </div>
                            </div>
                        </div>

                        <div class="service-links">
                            <div class="D--flex">
                                <div class="support-option">
                                    <a href="{{URL('service')}}">
                                        <div class="supp-icon">
                                            <img src="{{asset('public/front/images/support-options/customer-support.svg')}}" alt="svg">
                                        </div>
                                        <div class="support-details">
                                            <h6>Request Repair</h6>
                                            <p>Service request for Impex product   </p>
                                        </div>
                                    </a>

                                </div>
                                <div class="support-option">
                                    <a href="{{URL('user-manuals')}}">
                                        <div class="supp-icon">
                                            <img src="{{asset('public/front/images/support-options/user-manual.svg')}}" alt="svg">
                                        </div>
                                        <div class="support-details">
                                            <h6>User Manuals</h6>
                                            <p>Find all our user manuals here
                                            </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="support-option">
                                    <a href="{{URL('service/centers')}}">
                                        <div class="supp-icon">
                                            <img src="{{asset('public/front/images/support-options/find-servicecenter.svg')}}" alt="svg">
                                        </div>
                                        <div class="support-details">
                                            <h6>Find Service Centers</h6>
                                            <p>Locate your nearest Impex service centre </p>
                                        </div>
                                    </a>
                                </div>

                                <div class="support-option">
                                    <a href="{{URL('escalate-to-service')}}">
                                        <div class="supp-icon">
                                            <img src="{{asset('public/front/images/support-options/service-head.svg')}}" alt="svg">
                                        </div>
                                        <div class="support-details">
                                            <h6>Escalate to Service Head</h6>
                                            <p>Let our service head assist you</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="support-option">
                                    <a href="{{URL('warranty-terms')}}">
                                        <div class="supp-icon">
                                            <img src="{{asset('public/front/images/support-options/warrenty.svg')}}" alt="svg">
                                        </div>
                                        <div class="support-details">
                                            <h6>Warranty Terms & Conditions</h6>
                                            <p>Find general warranty terms & conditions </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="support-option">
                                    <a href="{{URL('warranty-extension')}}">
                                        <div class="supp-icon">
                                            <img src="{{asset('public/front/images/support-options/amc.svg')}}" alt="svg">
                                        </div>
                                        <div class="support-details">
                                            <h6>Warranty Extension/AMC</h6>
                                            <p> Extend your warranty period</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="support-option">
                                    <a href="{{URL('servicePolicy')}}">
                                        <div class="supp-icon">
                                            <img src="{{asset('public/front/images/support-options/service-policy.svg')}}" alt="svg">
                                        </div>
                                        <div class="support-details">
                                            <h6>Service Policy & Charges</h6>
                                            <p>Discover latest updates in service policy </p>
                                        </div>
                                    </a>
                                </div>

                                <div class="support-option">
                                    <a href="{{URL('faq')}}">
                                        <div class="supp-icon">
                                            <img src="{{asset('public/front/images/support-options/faq.svg')}}" alt="svg">
                                        </div>
                                        <div class="support-details">
                                            <h6>FAQs</h6>
                                            <p>Everything you need to know about Impex products
                                            </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="support-option">
                                    <a href="{{URL('productRegister')}}">
                                        <div class="supp-icon">
                                            <img src="{{asset('public/front/images/support-options/product-registration.svg')}}" alt="svg">
                                        </div>
                                        <div class="support-details">
                                            <h6>Product Registration</h6>
                                            <p>Register your Impex Product </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="support-option">
                                    <a href="{{URL('product-enquiry')}}">
                                        <div class="supp-icon">
                                            <img src="{{asset('public/front/images/support-options/product-enquiry.svg')}}" alt="svg">
                                        </div>
                                        <div class="support-details">
                                            <h6>Product Enquiry</h6>
                                            <p>Know about your Impex Product </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="support-option">
                                    <a href="{{URL('productFeedback')}}">
                                        <div class="supp-icon">
                                            <img src="{{asset('public/front/images/support-options/product-feedback.svg')}}" alt="svg">
                                        </div>
                                        <div class="support-details">
                                            <h6>Product Feedback</h6>
                                            <p>Leave a feedback on any Impex product </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="support-option">
                                    <a href="{{URL('serviceFeedback')}}">
                                        <div class="supp-icon">
                                            <img src="{{asset('public/front/images/support-options/service-feedback.svg')}}" alt="svg">
                                        </div>
                                        <div class="support-details">
                                            <h6>Service Feedback</h6>
                                            <p>Leave a valuable feedback on our service </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="tab-pane fade " id="pills-faq" role="tabpanel" aria-labelledby="pills-faq-tab">
                	@if($faqs->count() > 0)
                    <!-- Tab Container -->
                    <div class="container tab-faq-wrapper">
                        <div class="tab-content-header text-center bold-title">
                            Related Questions
                        </div>

                        <div class="row">
                            <div class="col-12 faq-accordion">

                                <div id="accordionFaq" class="accordion">

                                	@foreach($faqs as $key => $faq)
	                                    <div class="card faq-accordion__block">
	                                        <div class="card-header faq-accordion__header" id="heading{{$key}}">

	                                            <a data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true"
	                                                aria-controls="collapse{{$key}}">
	                                                {{$faq->question}}
	                                            </a>

	                                        </div>
	                                        <div id="collapse{{$key}}" class="collapse <?php echo $key==0?'show':''; ?>" aria-labelledby="heading{{$key}}"
	                                            data-parent="#accordionFaq">
	                                            <div class="card-body faq-accordion__body">
	                                                <p class="mb-0">{!!$faq->answer!!}
	                                                </p>
	                                            </div>
	                                        </div>
	                                    </div>
                                    @endforeach



                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Tab Container END -->

                    @else
                    	<div class="container tab-faq-wrapper">
                    		<div class="row">
                            	<div class="col-12 faq-accordion">
                    				<p>No questions added</p>
                    			</div>
                    		</div>
                    	</div>
                   	@endif

                </div>
            </div>
            <!-- Tab Wrapper END -->

    </section>
    <!-- Product Description END -->
</main>



<div class="product-compare-wrapper product_compare_slider <?php echo $compare->count() > 0?'':'hide'; ?>">
    <div class="product-wrapper__inner">
        <div class="row align-items-center">
            <div class="col-md-9">
                <div class="position-relative">
                    <div class="slider add-remove">
                        @foreach($compare as $comp)
                            <div class="item">
                                <div class="product-content">
                                    <div class="product-image">
                                        <img class="img-fluid ps-product__image "
                                            src="{{storage_url()}}/resized/medium/{{$comp->thumbnail}}" alt="product">
                                    </div>
                                    <div class="product-desc">
                                        <h4>{{$comp->name}}</h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="comp-wrapper text-center">
                    <div class="title compare_count">Compare ({{$compare->count()}})</div>
                    <a class="d-block btn-clr-box compare_clear" href="javascript:void(0)">Clear All</a>
                    <a href="{{URL('compare')}}" class="btn btn-compare">Compare</a>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="offerModalTitle" aria-hidden="true"  data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn close-modal" data-dismiss="modal" aria-label="Close" onClick="offerAccept()">
                <i class="lni lni-close"></i>
            </button>
            <div class="modal-wrap">
                <div class="">
                    <img src="{{storage_url()}}/resized/large/{{$product->thumbnail}}" class="img-fluid img-center" alt="img">
                </div>
                <div class="content-right">
                    <div class="modal-content text-center">
                        <div class="md-title">{{$product->name}}</div>

                        <form method="POST" action="{{URL('postReview')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="application-body text-left mb-2">
                                <div class="row">
                                    @if($product->type == 2)
                                        <input type="hidden" name="product_id" value="{{$product->parent_id}}">
                                        <input type="hidden" name="review_product_id" value="{{$product->id}}">
                                    @else
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <input type="hidden" name="review_product_id" value="{{$product->id}}">
                                    @endif
                                    <input type="hidden" name="product_slug" value="{{$product->slug}}">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <input type="text" class="form-control" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group form-input-field">
                                                <label class="input-field__label">Image</label>
                                                <label class="d-block btn file-upload-button" for="upload-files">
                                                    Choose File
                                                </label>
                                                <input type="file" class="form-control input-field__block upload-files" id="upload-files" name="image" accept="image/*" hidden>

                                                <small class="caution"> <i class="far fa-question-circle"></i> jpeg, jpg, png.</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Overall Rating*</label>
                                            <div class='rating-stars text-center'>
                                                <ul id='stars'>
                                                    <li class='star' title='Poor' data-value='1'>
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                    <li class='star' title='Fair' data-value='2'>
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                    <li class='star' title='Good' data-value='3'>
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                    <li class='star' title='Excellent' data-value='4'>
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                    <li class='star' title='WOW!!!' data-value='5'>
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>
                                                </ul>
                                                <input type="text" style="opacity:0.01" name="rating" id="rating" required>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Review Title*</label>
                                            <input type="text" class="form-control" name="title" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Review*</label>
                                            <textarea class="form-control" rows="10" required name="review"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-shop-now">Post Review</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>


@stop
@section('script')
    <script src="{{asset('public/admins/js/product-detail.js')}}"></script>
    <script src="{{asset('public/front/plugins/plugin-bundle.min.js')}}" async></script>
@endsection
