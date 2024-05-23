@extends('pages::layouts.master')

@section('meta_title', $banner->meta_title)
@section('meta_tags', $banner->meta_tags)
@section('meta_description', $banner->meta_description)

@section('content')
<!-- Main Wrapper -->
<main>

    <!-- Baner Area -->
    <div class="inner-hero-area bg-image <?php echo $banner->mobile_image != ''?'web':''; ?> deferImage"  data-src="{{storage_url()}}/{{$banner->image}}">
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

    <!-- Our Partners -->
    <section class="section-partners">
        <div class="container">
            <div class="section-header text-center">
                Our E-commerce Partners!
            </div>
            <div class="row">
            @foreach($vendors as $key=> $vendor)
                <div class="col-md-4 mb-4">
                    <a @if($vendor->link) href="{{$vendor->link}} " rel="noopener" target="_blank" @endif >
                        <div class="partners-logo">
                            <img src="{{storage_url()}}/resized/medium/{{$vendor->image}}" class="img-fluid" alt="flipkart">
                        </div>
                    </a>
                </div>
                @endforeach
               
            </div>
        </div>
    </section>
    <!-- Our Partners END -->


</main>
<!-- Main Wrapper END -->

@stop
