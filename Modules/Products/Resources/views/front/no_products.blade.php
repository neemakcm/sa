@extends('pages::layouts.master')

@section('meta_title', $banner->meta_title)
@section('meta_tags', $banner->meta_tags)
@section('meta_description', $banner->meta_description)

@section('content')

<main>

    @csrf

    <!-- Sub Banner -->
    <section class="page-sub-banner">
        <div class="image-cover deferImage" data-src="{{storage_url()}}/{{$banner->image}}">
            <div class="container">
                <div class="col-md-8 col-lg-6 col-xl-6 ml-auto">
                    {!! $banner->description !!}
                </div>
            </div>
        </div>
    </section>
    <!-- Sub Banner END -->

    <section class="product-list-main">
        <div class="product-list__container">

            <div class="product-list__inner">

                <!-- Product Content -->
                <div class="product-list__right">
                    <div class="prd-shop__content">
                        
                        <div class="row">
                            No results found
                        </div>

                        <!-- <div class="text-center mt-2">
                            <a href="javascript: void(0)" class="btn-link btn-all-products">View More</a>
                        </div> -->

                    </div>
                </div>
                <!-- Product Content END -->

            </div>
        </div>
    </section>

</main>

@stop