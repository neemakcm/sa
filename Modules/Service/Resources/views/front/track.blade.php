@extends('pages::layouts.master')

@section('meta_title', $banner->meta_title)
@section('meta_tags', $banner->meta_tags)
@section('meta_description', $banner->meta_description)

@section('content')

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


    <div class="page-product-reg">
        <div class="container">
        	@csrf
            <!-- Register Form -->
            <div class="reg-block-content">
                <div class="track-service-header">
                    Track your repair using any other phone number/email and Service Request number?
                </div>
                <div class="track-service-body">
                    <div class="track-summary mb-3">
                        <div class="input-content ">
                            <div class="form-group form-input-field">
                                <input type="text" class="form-control" placeholder="Case Number*" id="case_number">
                            </div>
                        </div>
                        <div class="input-content ">
                            <div class="form-group form-input-field">
                                <input type="text" class="form-control" placeholder="Mobile Number" id="mobile">
                            </div>
                        </div>
                        <div class="input-content ">
                            <div class="form-group form-input-field">
                                <input type="text" class="form-control" placeholder="Email" id="email">
                            </div>
                        </div>
                        <div class="button-wrapper">
                            <button class="btn btn-track-order track_service">
                                Search
                            </button>
                        </div>
                    </div>

                    <div class="checkbox-wrapper pl-md-3 pr-md-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="track_confirm">
                            <label class="custom-control-label" for="track_confirm">
                                * By clicking "Submit", I have read, agreed and giving consent to the terms of use
                                and the Privacy Policy
                            </label>
                        </div>

                        <div class="tems-and-privacy">
                            <ul>
                                <li>
                                    <a href="{{URL('privacyPolicy')}}" target="_blank">Privacy Policy </a>
                                </li>
                                <li>
                                    <a href="{{URL('terms')}}" target="_blank">Terms and Conditions</a>
                                </li>
                            </ul>
                            <p id="track_check_error" class="danger"></p>
                        </div>
                    </div>

                    <div class="checkbox-wrapper pl-md-3 pr-md-3 status_wrapper hide">
                        <div class="media track-status">
                            <div class="media-left mr-3 request_status">
                                Status :
                            </div>
                            <div class="media-body status_div">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Register Form -->


        </div>
    </div>

</main>

@stop