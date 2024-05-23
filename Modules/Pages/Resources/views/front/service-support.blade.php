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
             <!-- Values -->
                <div class="section-abt-features">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-10 col-lg-10 mx-auto text-center">
                                <div class="section-header">
                                    <h2 class="title">Contact Us</h2>
                                    <div class="section-description pr-xl-4 pl-xl-4">
                                        <p>Feel free to connect with us! Our customer care executives are more than happy to help resolve your concerns.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container help-support">
                        <div class="support-box">
                            <div class="row no-gutters">

                                <div class="col-sm-6 col-md-6 col-lg-4 mb-4 border-l">
                                    <div class="card text-center box-inner">
                                        <div class="sm-icon">
                                            <img src="{{asset('front/images/icons/call.png')}}" alt="icon">
                                        </div>
                                        <h4 class="box-title">Phone</h4>
                                        <a href="{{URL('contact')}}">
                                            <div class="text-small">
                                        1800 425 9444 <br>
                                            Mon - Sat, 9 AM - 6 PM<br>
                                            Except for National Holidays
                                        </div> </a>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-4 mb-4 border-l">
                                    <div class="card text-center box-inner">
                                        <div class="sm-icon">
                                            <img src="front/images/icons/service-request.png" alt="icon">
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
                                            <img src="front/images/icons/find.png" style="width: 41px;" alt="icon">
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
                    </div>
                </div>
                <!-- Values END -->
                <div class="servesupport">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-10 col-lg-10 mx-auto text-center">
                                <div class="section-header">
                                    <h2 class="title">Service Support</h2>
                                    <div class="section-description pr-xl-4 pl-xl-4">
                                        <p>We have a committed after sales support team at our disposal ready to resolve any issue that you might face with any of our products.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 bottom-sep">
                                <div class="service-supporting">
                                    <img src="front/images/service-support/impex_product_support_service.webp" alt="service">
                                    <div class="about-service">
                                        <h6>Product Support</h6>
                                        <p>Discover all you need to know about Impex electronics and home appliances.  Know how to register your product or simply find the user manual required to install your product. </p>
                                        <div class="click-here">
                                            <a href="{{URL('product-support')}}" class="btn btn-accept">
                                                Click Here
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 bottom-sep">
                                <div class="service-supporting">
                                    <img src="front/images/service-support/impex_recycling_support_service.webp" alt="support">
                                    <div class="about-service">
                                        <h6>Recycling Support</h6>
                                        <p>We all must care for the environment. To properly recycle or dispose<br> e-waste. please connect with our recycle partner. </p>
                                        <div class="click-here">
                                            <a href="{{URL('drop-point')}}" class="btn btn-accept">
                                                Click Here
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 bottom-sep">
                                <div class="service-supporting">
                                    <img src="front/images/service-support/impex_service_feedback_service.webp" alt="support">
                                    <div class="about-service">
                                        <h6>Service Feedback</h6>
                                        <p>What do you feel about our service? Connect with us and let us know your thoughts.</p>
                                        <div class="click-here">
                                            <a href="{{URL('serviceFeedback')}}" class="btn btn-accept">
                                                Click Here
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 bottom-sep">
                                <div class="service-supporting">
                                    <img src="front/images/service-support/impex_escalate_to_service_head_service.webp" alt="support">
                                    <div class="about-service">
                                        <h6>Escalate to Service Head</h6>
                                        <p>Not satisfied with our service? Let our Service Head help resolve your concerns.</p>
                                        <div class="click-here">
                                            <a href="{{URL('escalate-to-service')}}" class="btn btn-accept">
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

{{-- 
    <div class="inner-hero-area bg-image recycle-bg deferImage" data-src="{{asset('public/front/images/service-support/recyle-support-bg.png')}}">
       <div class="d-flex flex-grow-1">
           <div class="container align-self-center">
               <div class="row">
                   <div class="col-md-8 col-lg-6 ml-auto">
                       <div class="inner-hero-text">
                           <h1 class="title">Recycling Support</h1>
                           <div class="title-desc">
                            We care for the environment and are always delighted to help you out with recycling your Impex products after use and help reduce E-waste. 
                           </div>
                           <div class="click-here">
                                <a href="{{URL('/drop-point')}}" class="btn btn-accept">
                                    Click Here
                                </a>
                            </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
   
   <div class="white-bg-new">
        <div class="servesupport" style="margin-top: 0;">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-10 col-lg-10 mx-auto text-center">
                        <div class="section-header">
                            <h2 class="title">Customer Feedback</h2>
                            <div class="section-description pr-xl-4 pl-xl-4">
                                <p> Your feedback is absolutely precious to us. We can't wait to hear about what you got to say about us. Leave a feedback and make us proud! </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="feedbacks">
                            <div class="feedback-img">
                                <img src="{{asset('public/front/images/service-support/feedback1.png')}}" alt="service">
                            </div>
                            <div class="feedback-details">
                                <h6>Product Feedback</h6>
                                <p>Satisfied with your Impex product? Do leave a feedback so that we know we are doing great! </p>
                                <div class="click-here">
                                    <a href="{{URL('/productFeedback')}}" class="btn btn-accept">
                                        Click Here
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="feedbacks">
                            <div class="feedback-img">
                                <img src="{{asset('public/front/images/service-support/feedback2.png')}}" alt="service">
                            </div>
                            <div class="feedback-details">
                                <h6>Service Feedback</h6>
                                <p>What do you feel about our service? Connect with us and let us know your thoughts.</p>
                                <div class="click-here">
                                    <a href="{{URL('/serviceFeedback')}}" class="btn btn-accept">
                                        Click Here
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="feedbacks">
                            <div class="feedback-img">
                                <img src="{{asset('public/front/images/service-support/feedback3.png')}}" alt="service">
                            </div>
                            <div class="feedback-details">
                                <h6>Escalate to Service Head</h6>
                                <p>Not satisfied with our service? Let our Service Head help resolve your concerns.</p>
                                <div class="click-here">
                                    <a href="{{URL('/escalate-to-service')}}" class="btn btn-accept">
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