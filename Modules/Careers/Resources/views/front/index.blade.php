@extends('pages::layouts.master')

@section('meta_title', $banner->meta_title)
@section('meta_tags', $banner->meta_tags)
@section('meta_description', $banner->meta_description)

@section('content')

<main>

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

    <!-- Job Search Wrapper -->
    <section class="career-search-container">
        <div class="container">
            <div class="career-search__inner">
                <div class="career-search__content text-center">
                    <h3 class="career-search__heading">Search Jobs</h3>
                    <div class="career-search__sub-heading">Explore exciting opportunities and apply now to join
                        us.</div>
                    <div class="text-center">
                        <a class="btn btn-search-jobs" href="{{URL('careers/search')}}">Search Jobs</a>
                    </div>

                </div>

                <figure class="media-thumbnail mb-0">
                    <img class="img-fluids" alt="careers" src="{{asset('public/front/images/page/career/job-search.png')}}">
                </figure>
            </div>
        </div>
    </section>
    <!-- Job Search Wrapper END -->

    <div class="job-content-list">
        <!-- Section -->
        <section class="job-content-block job-content-item ">
            <div class="position-relative w-100">
                <!-- Fixed Image -->
                <div class="fixed-bg-image align-left d-none d-lg-block">
                    <img src="{{storage_url()}}/{{$page[0]->image}}" class="img-fluid" alt="image">
                </div>
                <!-- Fixed Image END -->

                <div class="container">
                    <div class="row">
                        <div class="col-12 mb-4 d-lg-none">
                            <img src="{{storage_url()}}/{{$page[0]->image}}" class="img-fluid w-100" alt="image">
                        </div>
                        <div class="col-12 col-lg-6 mb-5 mb-lg-0 ml-auto">
                            <div class="text-content text-align-left">
                                <h4 class="text-content__title">{{$page[0]->title}}</h4>
                                <div class="text-content__desc">
                                    {!! $page[0]->description !!}
                                </div>
                                <div class="text-left">
                                    <a class="btn btn-learn-more" href="{{URL('workingAtImpex')}}">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section END -->

        <!-- Section -->
        <section class="job-content-block">
            <div class="position-relative job-content__inner w-100">
                <!-- Fixed Image -->
                <div class="fixed-bg-image align-right d-none d-lg-block">
                    <img src="{{storage_url()}}/{{$page[1]->image}}" class="img-fluid" alt="image">
                </div>
                <!-- Fixed Image END -->

                <div class="container">
                    <div class="row">
                        <div class="col-12 mb-4 d-lg-none">
                            <img src="{{storage_url()}}/{{$page[1]->image}}" class="img-fluid w-100" alt="image">
                        </div>
                        <div class="col-12 col-lg-6 mb-5 mb-lg-0 mr-auto">
                            <div class="text-content text-align-right">
                                <h4 class="text-content__title">{{$page[1]->title}}</h4>
                                <div class="text-content__desc">
                                    {!! $page[1]->description !!}
                                </div>

                                <a class="btn btn-learn-more" href="{{URL('jobFields')}}">Learn More</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section END -->
    </div>


</main>

@stop