@extends('pages::layouts.master')
@section('content')

<!-- Main Wrapper -->
<main>

      <!-- Baner Area -->
      <section class="intro-text_banner">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-auto text-center inner-padding ">
                    <h2 class="header-title ">FAQ</h2>
                </div>
            </div>
        </div>
    </section>
    @if($faqs->count() > 0)

    <!-- Content -->
    <section class="page-faq-main">
        <div class="container">
            <div class="faq-accordion-main">
                <div id="accordionFAQ">
                    @foreach($faqs as $key => $faq)
                    <!-- Accordion Box -->
                    <div class="accordion-box active">
                        <!-- Heder Content-->
                        <div class="accordion-box__header" id="heading{{$key}}">
                            <div data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="false"
                                aria-controls="collapse{{$key}}">
                                <div class="title">
                                    <div class="title-content">
                                        <span class="mr-1">
                                            {{$key + 1}}
                                        </span>
                                        <div class="content">
                                        {{$faq->question}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Header Content -->
                        <!-- Content Body -->
                        <div id="collapse{{$key}}" class="panel-collapse collapse " aria-labelledby="heading{{$key}}"
                            data-parent="#accordionFAQ">
                            <div class="accordion-box__body">
                                <!-- content -->
                                <div class="accordion-box__content">
                                    <div class="faq-title">
                                        <div class="content">
                                        {!!$faq->answer!!}
                                         </div>
                                    </div>
                                </div>
                                <!-- content END -->
                            </div>
                        </div>
                        <!-- Content Body -->
                    </div>
                    <!-- Accordion Box -->
                    @endforeach
                </div>
            </div>
        </div>

    </section>
    <!-- Content END -->
@endif
</main>
<!-- Main Wrapper END -->

@stop