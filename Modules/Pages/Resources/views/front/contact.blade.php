@extends('pages::layouts.master')

@section('meta_title', $banner->meta_title)
@section('meta_tags', $banner->meta_tags)
@section('meta_description', $banner->meta_description)

@section('content')

<main>

    <!-- Baner Area -->
    <div class="inner-hero-area bg-image <?php echo $banner->mobile_image != ''?'web':''; ?> deferImage"
    data-src="{{storage_url()}}/{{$banner->image}}">
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


    <!-- Contact Type Container -->
    <section class="contact-type-container">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-6 grid-gap">
                    <div class="contact-type-block">
                        <div class="contact-type__icon">
                            <img src="{{asset('front/images/contact/icon-whatsapp.svg')}}" class="img-fluid" alt="icon" loading="lazy">
                        </div>
                        <div class="contact-type__title">
                            WhatsApp Us
                        </div>
                        <a href="https://api.whatsapp.com/send?phone={{$settings->whatsapp}}" target="_blank" class="contact-type__descript">
                            {{$settings->whatsapp}}
                        </a>
                    </div>
                </div>

                <div class="col-12 col-md-6 grid-gap">
                    <div class="contact-type-block">
                        <div class="contact-type__icon">
                            <img src="{{asset('front/images/contact/icon-chat.svg')}}" class="img-fluid" alt="icon" loading="lazy">
                        </div>
                        <div class="contact-type__title">
                            Chat with Us
                        </div>
                        <a href="sms:{{$settings->chat}}" class="contact-type__descript">
                            {{$settings->chat}}
                        </a>
                    </div>
                </div>

                <div class="col-12 col-md-6 grid-gap">
                    <div class="contact-type-block">
                        <div class="contact-type__icon">
                            <img src="{{asset('front/images/contact/icon-mail.svg')}}" class="img-fluid" alt="icon" loading="lazy">
                        </div>
                        <div class="contact-type__title">
                            Email Us
                        </div>
                        <a href="mailto:{{$settings->email}}" class="contact-type__descript">
                            {{$settings->email}}
                        </a>
                    </div>
                </div>

                <div class="col-12 col-md-6 grid-gap">
                    <div class="contact-type-block">
                        <div class="contact-type__icon">
                            <img src="{{asset('front/images/contact/icon-call.svg')}}" class="img-fluid" alt="icon" loading="lazy">
                        </div>
                        <div class="contact-type__title">
                            Call Us
                        </div>
                        <a href="tel:{{$settings->mobile}}" class="contact-type__descript">
                            {{$settings->mobile}}
                        </a>
                    </div>
                </div>

                <div class="col-12 col-md-6 grid-gap">
                    <div class="contact-type-block">
                        <div class="contact-type__icon">
                            <img src="{{asset('front/images/contact/icon-map.svg')}}" class="img-fluid" alt="icon" loading="lazy">
                        </div>
                        <div class="contact-type__title">
                            Address 1
                        </div>
                        <div class="contact-type__descript">
                            {{$settings->address_1}}
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 grid-gap">
                    <div class="contact-type-block">
                        <div class="contact-type__icon">
                            <img src="{{asset('front/images/contact/icon-map.svg')}}" class="img-fluid" alt="icon" loading="lazy">
                        </div>
                        <div class="contact-type__title">
                            Address 2
                        </div>
                        <div class="contact-type__descript">
                            {{$settings->address_2}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Contact Type Container END -->


</main>

@stop