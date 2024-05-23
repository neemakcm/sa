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
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
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


    <div class="white-bg-new">
        <div class="container">
                <div class="servesupport product-support">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 bottom-sep">
                                <div class="service-supporting">
                                    <img src="./public/front/images/product-support/Register-your-Product-Warranty-Extension_product_support.webp" alt="service">
                                    <div class="about-service">
                                        <h6>Register Your Product/Warranty Extension</h6>
                                        <p>All you need to know about the warranty policy of Impex electronics and home appliances. </p>
                                        <div class="click-here">
                                            <a href="{{URL('productRegister')}}" class="btn btn-accept">
                                                Click Here
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 bottom-sep">
                                <div class="service-supporting">
                                    <img src="./public/front/images/product-support/impex_user_manuals.webp" alt="service">
                                    <div class="about-service">
                                        <h6>User Manuals and Product Warranty Details</h6>
                                        <p>Find the user manuals and product warranty details.</p>
                                        <div class="click-here">
                                            <a href="{{URL('user-manuals')}}" class="btn btn-accept">
                                                Click Here
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 bottom-sep">
                                <div class="service-supporting">
                                    <img src="./public/front/images/product-support/impex_general_warranty.webp" alt="service">
                                    <div class="about-service">
                                        <h6>General Warranty Terms & Conditions</h6>
                                        <p>All you need to know about the warranty policy of Impex electronics and home appliances.  </p>
                                        <div class="click-here">
                                            <a href="{{URL('warranty-terms')}}" class="btn btn-accept">
                                                Click Here
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 bottom-sep">
                                <div class="service-supporting">
                                    <img src="./public/front/images/product-support/impex_service_charge.webp" alt="service">
                                    <div class="about-service">
                                        <h6>Service Charges</h6>
                                        <p>Everything you need to know about our service policy and the charges associated with the same. </p>
                                        <div class="click-here">
                                            <a href="{{URL('servicePolicy')}}" class="btn btn-accept">
                                                Click Here
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 bottom-sep">
                                <div class="service-supporting">
                                    <img src="./public/front/images/product-support/impex_product_feedback.webp" alt="service">
                                    <div class="about-service">
                                        <h6>Product Feedback</h6>
                                        <p>Satisfied with your Impex product? Do leave a feedback so that we know we are doing great! </p>
                                        <div class="click-here">
                                            <a href="{{URL('productFeedback')}}" class="btn btn-accept">
                                                Click Here
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 bottom-sep">
                                <div class="service-supporting">
                                    <img src="./public/front/images/product-support/impex_faqs_product.webp" alt="service">
                                    <div class="about-service">
                                        <h6>FAQs</h6>
                                        <p>Discover the answers to all your queries about Impex electronics and home appliances. </p>
                                        <div class="click-here">
                                            <a href="{{URL('faq')}}" class="btn btn-accept">
                                                Click Here
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>


   
   {{-- <div class="white-bg-new">
        <div class="servesupport" style="margin-top: 0;">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-10 col-lg-10 mx-auto text-center">
                        <div class="section-header">
                            <h2 class="title">Warranty & Service Policy</h2>
                            <div class="section-description pr-xl-4 pl-xl-4">
                                <p>Discover how Impex warranty and service policy works. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="feedbacks">
                            <div class="feedback-img">
                                <img src="./public/front/images/service-support/amc.png" alt="service">
                            </div>
                            <div class="feedback-details">
                                <h6>Warranty 
                                    Terms & Conditions</h6>
                                <p>All you need to know about the warranty policy of Impex electronics and home appliances. </p>
                                <div class="click-here">
                                    <a href="{{URL('warranty-terms')}}" class="btn btn-accept">
                                        Click Here
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="feedbacks">
                            <div class="feedback-img">
                                <img src="./public/front/images/service-support/amc1.png" alt="service">
                            </div>
                            <div class="feedback-details">
                                <h6>Warranty Extension
                                    Or AMC</h6>
                                <p>Extend the warranty or Annual Maintenance Charge of your Impex product absolutely free of charges.</p>
                                <div class="click-here">
                                    <a href="{{URL('warranty-extension')}}" class="btn btn-accept">
                                        Click Here
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="feedbacks">
                            <div class="feedback-img">
                                <img src="./public/front/images/service-support/amc2.png" alt="service">
                            </div>
                            <div class="feedback-details">
                                <h6>Service Policy & 
                                    charges</h6>
                                <p>Everything you need to know about our service policy and the charges associated with the same.</p>
                                <div class="click-here">
                                    <a href="{{URL('servicePolicy')}}" class="btn btn-accept">
                                        Click Here
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div> --}}

</main>

@stop