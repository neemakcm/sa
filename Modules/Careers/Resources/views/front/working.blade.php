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

    <section class="mn-content-wrapper">

        <!-- Row -->
        <div class="mn-content-block mn-content--odd row-gap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6 col-lg-6 mb-5">
                        <div class="mn-content__media">
                            <img src="{{storage_url()}}/{{$page[0]->image}}" class="img-fluid w-100" alt="image">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 mb-5">
                        <div class="mn-content__desc">
                            <div class="mn-content__title">
                                {{$page[0]->title}}
                            </div>
                            <div class="mn-content__text">
                                {!! $page[0]->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row END -->

        <!-- Row -->
        <div class="mn-content-block mn-content--even row-gap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6 col-lg-6 mb-5 order-2 order-md-1">
                        <div class="mn-content__desc">
                            <div class="mn-content__title">
                                {{$page[1]->title}}
                            </div>
                            <div class="mn-content__text">
                                {!! $page[1]->description !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 mb-5 order-1 order-md-2">
                        <div class="mn-content__media">
                            <img src="{{storage_url()}}/{{$page[1]->image}}" class="img-fluid w-100" alt="image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row END -->

        <!-- Row -->
        <div class="mn-content-block mn-content--odd">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6 col-lg-6 mb-5">
                        <div class="mn-content__media">
                            <img src="{{storage_url()}}/{{$page[2]->image}}" class="img-fluid w-100" alt="image">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 mb-5">
                        <div class="mn-content__desc">
                            <div class="mn-content__title">
                                {{$page[2]->title}}
                            </div>
                            <div class="mn-content__text">
                                {!! $page[2]->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row END -->

    </section>

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


</main>

@stop