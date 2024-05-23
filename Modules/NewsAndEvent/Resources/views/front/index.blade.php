@extends('pages::layouts.master')
@section('content')

<main>

    <!-- Baner Area -->
    <div class="inner-hero-area bg-image gredient-purple-bg banner-full-img">
        <div class="d-flex flex-grow-1">
            <div class="container align-self-center">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6 col-lg-5 mb-4">
                        <div class="inner-hero-text">
                            <h1 class="title">Media Center</h1>
                            <div class="title-desc pr-lg-4">
                                Catch up on the latest product updates,
                                news ,blogs ,promotions, and more.
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 offset-lg-1 mb-4">
                        <img src="{{asset('public/front/images/sub-banner/sub-media-center.png')}}" class="img-fluid" alt="banner">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Area END -->

    @if($medias->count() > 0)

	    <!-- Media Center -->
	    <section class="media-component media-component--gap">
	        <div class="media-component__inner">
	            <ul class="media-component__list media_center_wrapper">
	            	@foreach($medias as $media)
		                <li class="media-component__item">
		                    <a href="">
		                        <div class="visual-area">
		                            <div class="visual-area__image">
		                                <img src="{{storage_url()}}/{{$media->media}}" class="img-fluid" alt="media">
		                            </div>
		                            <div class="visual-area__content">
		                                <div class="visual-area__publish">{{date('F d, Y',strtotime($media->created_at))}}</div>
		                                <h4 class="visual-area__title">
		                                    {{$media->title}}
		                                </h4>
		                            </div>
		                        </div>
		                    </a>
		                </li>
		            @endforeach
	            </ul>

	            @if($media_count > 6)
		            <div class="text-center media_pagination_wrapper view_more">
		                <a class="btn-link btn-view-all-media media_pagination" data-page="1">View More</a>
		            </div>
		        @endif

	        </div>
	    </section>
	    <!-- Media Center END -->
	@else
		<section class="media-component media-component--gap">
	        <div class="media-component__inner">
	        	<p>No medias available</p>
	        </div>
	    </section>

	@endif





</main>

@stop