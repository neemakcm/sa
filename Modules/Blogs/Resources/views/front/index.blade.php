@extends('pages::layouts.master')

@section('meta_title', $banner->meta_title)
@section('meta_tags', $banner->meta_tags)
@section('meta_description', $banner->meta_description)

@section('content')
<!-- Main Wrapper -->
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
    <!-- media-tab -->
    <section class="media-tab-content">
        <!-- Tab Heder -->
        <div class="media-tab__header sticky-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-lg-8 mx-auto">
                        <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-blogs-tab" data-toggle="pill" href="#pills-blogs"
                                    role="tab" aria-controls="pills-blogs" aria-selected="true">
                                    <div class="caption">
                                        Blogs
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-news-tab" data-toggle="pill" href="#pills-news" role="tab"
                                    aria-controls="pills-news" aria-selected="false">
                                    <div class="caption">
                                        News & Events
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-videos-tab" data-toggle="pill" href="#pills-videos"
                                    role="tab" aria-controls="pills-videos" aria-selected="false">
                                    <div class="caption">
                                        Brand Videos
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tab Heder -->

        <!-- Tab Content -->
        <div class="media-tab__content">
            <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade  show active" id="pills-blogs" role="tabpanel"
                    aria-labelledby="pills-blogs-tab">

                    <!-- Tab Container -->
                    <div class="tab-container">

                        <div class="container">
                            <div class="text-center">
                                <div class="media-tab__title">
                                    Latest Blogs
                                </div>
                            </div>
                        </div>
						@if($blogs->count() > 0)
                        <!-- Media Center -->
                        <section class="media-component">
                            <div class="media-component__inner">
                                <ul class="media-component__list blog_center_wrapper">
									@foreach($blogs as $blog)
										<li class="media-component__item">
											<a href="{{URL('blogs/details/'.$blog->id)}}">
												<div class="visual-area">
													<div class="visual-area__image">
														<img src="{{storage_url()}}/{{$blog->media}}" class="img-fluid" alt="media">
													</div>
													<div class="visual-area__content">
														<div class="visual-area__publish">{{date('F d, Y',strtotime($blog->created_at))}}</div>
														<h4 class="visual-area__title">
															{{$blog->title}}
														</h4>
													</div>
												</div>
											</a>
										</li>
									@endforeach
                                </ul>
                                
								@if($blogs_count > 9)
                                <div class="text-center blog_pagination_wrapper view_more ">
                                    <a class="btn-link btn-view-all-media blog_pagination " data-page="1">View More</a>
                                </div>
								@endif
                            </div>
                        </section>
						@else
							<section class="media-component media-component--gap">
								<div class="media-component__inner">
									<p>No medias available</p>
								</div>
							</section>
						@endif
                        <!-- Media Center END -->


                    </div>
                    <!-- Tab Container END -->

                </div>


                <div class="tab-pane fade" id="pills-news" role="tabpanel" aria-labelledby="pills-news-tab">

                    <!-- Tab Container -->
                    <div class="tab-container">

                        <div class="container">
                            <div class="text-center">
                                <div class="media-tab__title">
                                    News & Events
                                </div>
                            </div>
                        </div>
						@if($news->count() > 0)
                        <!-- Media Center -->
                        <section class="media-component">
                            <div class="media-component__inner">
                                <ul class="media-component__list news_center_wrapper">
									@foreach($news as $new)
                                    <li class="media-component__item">
                                        <a href="{{URL('news/details/'.$new->id)}}">
                                            <div class="visual-area">
                                                <div class="visual-area__image">
                                                    <img src="{{storage_url()}}/{{$new->media}}"
                                                        class="img-fluid" alt="media">
                                                </div>
                                                <div class="visual-area__content">
                                                    <div class="visual-area__publish">{{date('F d, Y',strtotime($new->created_at))}}</div>
                                                    <h4 class="visual-area__title">
														{{$new->title}}
													</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
									@endforeach
                                    
                                </ul>

                                @if($news_count > 9)
                                <div class="text-center news_pagination_wrapper view_more">
                                    <a class="btn-link btn-view-all-media news_pagination" data-page="1">View More</a>
                                </div>
								@endif

                            </div>
                        </section>
						@else
							<section class="media-component media-component--gap">
								<div class="media-component__inner">
									<p>No News available</p>
								</div>
							</section>
						@endif
                        <!-- Media Center END -->


                    </div>
                    <!-- Tab Container END -->

                </div>

                <div class="tab-pane fade" id="pills-videos" role="tabpanel" aria-labelledby="pills-videos-tab">

                    <!-- Tab Container -->
                    <div class="tab-container">

                        <div class="container">
                            <div class="text-center">
                                <div class="media-tab__title">
                                    Latest Videos
                                </div>
                            </div>
                        </div>
						@if($videos->count() > 0)

                        <!-- Media Center -->
                        <section class="video-tut-component">
                            <div class="video-tut-component__inner">
                                <ul class="video-tut-component__list video_center_wrapper">
                                @foreach($videos as $video)
                                    <li class="video-tut-component__item">
                                        <a href="">
                                            <div class="visual-area">
                                                <div class="visual-area__image">
                                                    <img src="{{storage_url()}}/resized/small/{{$video->thumbnail}}"
                                                        class="img-fluid" alt="media">

                                                    <!-- Play Button -->
                                                    @if($video->type == 0)
                                                        <a class="icon" data-fancybox="" href="{{storage_url()}}/{{$video->video}}">
                                                    @else
                                                        <a class="icon" data-fancybox="" href="{{$video->video}}">
                                                    @endif
                                                        <img src="{{base_url()}}/public/front/images/page/videos/thumb/video-play.svg"class="img-fluid" alt="play"></a>
                                                    <!-- Play Button END -->
                                                </div>
                                                <div class="visual-area__content">
                                                    <div class="visual-area__publish">{{date('F d, Y',strtotime($video->created_at))}}</div>
                                                    <h4 class="visual-area__title">
                                                        {{$video->title}}
                                                    </h4>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                    @endforeach

                                </ul>
                                @if($video_count > 9)
                                <div class="text-center video_pagination_wrapper view_more">
                                    <a class="btn-link btn-view-all-media video_pagination" data-page="1">View More</a>
                                </div>
								@endif

                            </div>
                        </section>
                        <!-- Media Center END -->
                        @else
							<section class="media-component media-component--gap">
								<div class="media-component__inner">
									<p>No Videos available</p>
								</div>
							</section>
						@endif
                        
                    </div>
                    <!-- Tab Container END -->

                </div>
            </div>

        </div>
        <!-- Tab Content END -->

    </section>
    <!-- media-tab END-->






</main>


@stop
@section('script')
    <script src="{{asset('public/front/script/blog-and-news.js')}}"></script>
@endsection