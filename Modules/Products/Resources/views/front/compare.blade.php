@extends('pages::layouts.master')

@section('meta_title', $banner->meta_title)
@section('meta_tags', $banner->meta_tags)
@section('meta_description', $banner->meta_description)

@section('content')

<main>

    <section class="margin-sub">
        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-top">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Compare</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Sub Banner -->
    <section class="page-sub-banner">


        <div class="image-cover <?php echo $banner->mobile_image != ''?'web':''; ?> deferImage" data-src="{{storage_url()}}/{{$banner->image}}">
            <div class="container">
                <div class="col-md-8 col-lg-6 col-xl-6 ml-auto">
                    {!! $banner->description !!}
                </div>
            </div>
        </div>
        @if($banner->tablet_image != '')
        <div class="image-cover tab deferImage" data-src="{{storage_url()}}/{{$banner->tablet_image}}">
            <div class="container">
                <div class="col-md-8 col-lg-6 col-xl-6 ml-auto">
                    {!! $banner->description !!}
                </div>
            </div>
        </div>
    @endif
        @if($banner->mobile_image != '')
            <div class="image-cover mobile deferImage" data-src="{{storage_url()}}/{{$banner->mobile_image}}">
                <div class="container">
                    <div class="col-md-8 col-lg-6 col-xl-6 ml-auto">
                        {!! $banner->description !!}
                    </div>
                </div>
            </div>
        @endif

    </section>
    <!-- Sub Banner END -->

    <section class="compare-products">
        <div class="container help-support">
            <div class="row no-gutters">
                <div class="col-12  mb-3 mb-lg-5">
                    <div class="section-header text-center">
                        <h2 class="title-md">Compare</h2>
                        <div class="short-note">
                            <p>Impex Technologies has made a journey of two decades and has a big success-story to share that they have made<br> so far. The journey of the Impex Technologies.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="D--flex">
                <div class="c-details">
                    <div class="compare-details">
                        <div class="common-spec">
                            <ul>
                            	<li>Name</li>
                            	@foreach($attribute_list as $attribute)
	                                <li>{{$attribute['name']}}</li>
	                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="c-types">
                    <div class="compare_wrap ">
                        <div class="js-item-compare owl-carousel owl-theme">

                        	@foreach($compare_options as $compare)
	                           	<!-- Item -->
	                           	<div class="item">
		                            <div class="product-single">
		                                <div class="image-container">
		                                    <img src="{{storage_url()}}/resized/medium/{{$compare['image']}}" class="img-fluid img-auto " alt="img" width="50">
		                                </div>
		                            </div>
		                            <div class="product-spec">
		                                <ul>
		                                    <li>
		                                        ‎{{substr($compare['name'],0,30)}}
		                                    </li>
		                                    @foreach($compare['attributes'] as $attributes)
			                                    <li>
			                                        {{$attributes}}
			                                    </li>
			                                @endforeach
		                                </ul>
		                            </div>
		                        </div>
	                        	<!-- Item END -->
	                       	@endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   

</main>

@stop