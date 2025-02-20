<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- favicon -->
    <!-- <link rel="icon" href="{{asset('front/images/logo/favicon.png')}}" type="image/x-icon"> -->
    <link rel="icon" href="{{storage_url()}}/{{$settings->fav_icon}}" type="image/x-icon">
    <!-- Icons -->

    <link rel="stylesheet" href="{{asset('front/css/style.min.css')}}" media="screen">
    <link rel="stylesheet" href="{{asset('front/css/dev.min.css')}}" media="screen">
    <!-- Custom CSS -->
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.1/css/OverlayScrollbars.min.css"
    integrity="sha512-jN4O0AUkRmE6Jwc8la2I5iBmS+tCDcfUd1eq8nrZIBnDKTmCp5YxxNN1/aetnAH32qT+dDbk1aGhhoaw5cJNlw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="{{asset('front/css/custom-css.css')}}"> -->

    <title>Impex @yield('meta_title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="@yield('meta_tags')">
    <meta name="description" content="@yield('meta_description')">

    <meta property="og:title" content="Impex @yield('meta_title')" />
    <meta property="og:description" content="@yield('meta_description')" />
    <meta property="og:image" content="{{asset('front/images/logo/logo-meta.png')}}" />
    <meta name="facebook-domain-verification" content="secjfa3ilvsfilmwhx0sh0imr28yce" />

    <script type="text/javascript">
        var base_url = "{{url('/')}}";
        var storage_url = "{{storage_url()}}";

    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->


    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KX88VTH8');</script>
<!-- End Google Tag Manager -->

</head>

<body id="bodyEl">

    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KX88VTH8"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    
        <header>

        @if($pages[0])

        @if($settings->notification && $pages[0]->status==1)
        <div class="updates" id="covid_div" >
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h6 class="service-upadets font-w-300">
                            {{-- There is service &amp; logistics notice update relating to covid-19 - --}}

                            {{$settings->notification}}
                            <span class="view_more ml-2"><a data-toggle="modal" data-target="#serviceModal">Know
                                    More</a></span>
                            <span onclick="covidClose()" class="cta-remove-update"><i class="lni lni-close"></i></span>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endif
        <!-- Main Navbar -->
        <div class="main-menubar d-none d-lg-block">
            <nav class="navbar navbar-expand">
                <div class="nav-container">
                    <a class="navbar-brand" href="{{URL('/')}}">
                        @if($settings->logo)
                        <img src="{{storage_url()}}/{{$settings->logo}}" class="img-fluid"  alt="impex">
                        @else
                        <img src="{{asset('front/images/logo/logo-nav.png')}}"  class="img-fluid"
                            alt="impex">
                        @endif
                    </a>
                    <div class="navbar-collapse nav-link-content">
                        <ul class="navbar-nav mr-auto">

                            <li class="nav-item megamenu-link position-static">
                                <a href="{{URL('/')}}" class="nav-link dropdown-toggle">
                                    <span class="nav-link__text">
                                        Products
                                    </span>
                                </a>
                                <div class="dropdown-menu megamenubar">
                                    <div class="container">

                                        <!-- Magamenu Inner -->
                                        <div class="megamenu-inner">
                                            <div class="megamenu-inner__left">
                                                <ul class="megamenu-list">
                                                    @foreach($category as $key => $value)
                                                    <li
                                                        class="dropdown megamenu__link <?php echo $key == 0?'active':''; ?>">
                                                        <a class="megamenu__item <?php echo count($value['child']) > 0?'menu-has-child':''; ?>"
                                                            href="#">
                                                            {{$value['name']}}
                                                        </a>

                                                        @if(count($value['child']) > 0)
                                                        <div
                                                            class="submenu-wrapper <?php echo $key == 0?'active':''; ?>">
                                                            <div class="submenu-wrapper__inner  smooth-scroll-bar">
                                                                <ul class="submenus-news">

                                                                    @foreach($value['child'] as $key1 => $value1)
                                                                    <li class="subdropdown megamenu_link">
                                                                        <a href="{{URL('products/'.$value1['slug'])}}"
                                                                            class="submegamenu_item <?php echo count($value1['child']) > 0?'submenu-has-child':''; ?>">
                                                                            {{$value1['name']}}
                                                                        </a>

                                                                        @if(count($value1['child']) > 0)
                                                                        <div class="new-submenu-wrapper">
                                                                            <div class="newsubmenu-wraper_inner">
                                                                                <!-- Grid -->
                                                                                <div class="submenu-grid">
                                                                                    <ul class="submenu__list">
                                                                                        @foreach($value1['child'] as
                                                                                        $key2 => $value2)
                                                                                        <li class="submenu__link ">
                                                                                            <a class="submenu__item"
                                                                                                href="{{URL('products/'.$value2['slug'].'?Type='.urlencode($value2['name']))}}">
                                                                                                {{$value2['name']}}
                                                                                            </a>
                                                                                        </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </div>
                                                                                <!-- Grid END -->
                                                                            </div>
                                                                        </div>
                                                                        @endif
                                                                    </li>
                                                                    @endforeach

                                                                </ul>

                                                            </div>
                                                        </div>
                                                        @endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>


                                        </div>
                                        <!-- Magamenu Inner -->

                                    </div>
                                </div>
                            </li>

                            <li class="nav-item megamenu-link position-static">
                                <a href="{{URL('vendors')}}" class="nav-link dropdown-toggle">
                                    <span class="nav-link__text">
                                        Buy Here
                                    </span>
                                </a>
                                <div class="dropdown-menu megamenubar">
                                    <div class="container">

                                        <!-- Magamenu Inner -->
                                        <div class="megamenu-inner">
                                            <div class="megamenu-inner__left">
                                                <ul class="megamenu-list">
                                                    <li class="dropdown megamenu__link active">
                                                        <a class="megamenu__item menu-has-child"
                                                            href="{{URL('vendors')}}">
                                                            Buy Online
                                                        </a>
                                                        <div class="submenu-wrapper active">
                                                            <div class="submenu-wrapper__inner smooth-scroll-bar ">
                                                                <!-- Grid -->
                                                                <div class="submenu-grid w-100">
                                                                    <ul class="submenu__list online-items">
                                                                        @foreach($vendors as $keyV => $vendor)
                                                                        <li class="submenu__link ">
                                                                            <a class="submenu__item" target="_blank"
                                                                                href="{{$vendor->link}}" rel="noopener">
                                                                                {{$vendor->name}}
                                                                            </a>
                                                                        </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown megamenu__link">
                                                        <a class="megamenu__item" href="{{URL('stores')}}">
                                                            Visit Store
                                                        </a>
                                                    </li>
                                                    <!-- <li class="dropdown megamenu__link ">
                                                        <a class="megamenu__item"
                                                            href="{{URL('product-enquiry')}}">
                                                            Product Enquiry
                                                        </a>
                                                    </li> -->
                                                    <li class="dropdown megamenu__link">
                                                        <a class="megamenu__item" href="{{URL('business-enquiry')}}">
                                                            Business Enquiry
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>


                                        </div>
                                        <!-- Magamenu Inner -->

                                    </div>
                                </div>
                            </li>

                            <li class="nav-item megamenu-link position-static">
                                <a href="{{URL('service-support')}}" class="nav-link dropdown-toggle">
                                    <span class="nav-link__text">
                                        Service & Support
                                    </span>
                                </a>
                                <div class="dropdown-menu megamenubar">
                                    <div class="container">

                                        <!-- Magamenu Inner -->
                                        <div class="megamenu-inner">
                                            <div class="megamenu-inner__left">
                                                <ul class="megamenu-list">
                                                    {{-- <li class="dropdown megamenu__link">

                                                        <a class="megamenu__item" href="https://tinyurl.com/servicetz" rel="noopener" target="_blank">
                                                            Register your Service Request
                                                        </a>
                                                    </li>
                                                    <li class="dropdown megamenu__link">

                                                        <a class="megamenu__item" href="{{URL('service/centers')}}">
                                                    Find Service Centers

                                                    </a>
                            </li> --}}
                            <li class="dropdown megamenu__link active">
                                <a class="megamenu__item menu-has-child" href="{{URL('service-support')}}">
                                    Service Support
                                </a>
                                <div class="submenu-wrapper active">
                                    <div class="submenu-wrapper__inner  smooth-scroll-bar">
                                        <!-- Grid -->
                                        <div class="submenu-grid w-100">
                                            <ul class="submenu__list">
                                                <li class="submenu__link ">
                                                    <a class="submenu__item" href="https://tinyurl.com/servicetz"
                                                        rel="noopener" target="_blank">
                                                        Register Your Service Request
                                                    </a>
                                                </li>
                                                <!-- <li class="submenu__link ">
                                                                            <a class="submenu__item" href="{{URL('service/track')}}">
                                                                                Track Your Service Request

                                                                            </a>
                                                                        </li> -->

                                                <li class="submenu__link ">
                                                    <a class="submenu__item" href="{{URL('service/centers')}}">
                                                        Find Service Centers

                                                    </a>
                                                </li>
                                                <li class="submenu__link ">
                                                    <a class="submenu__item" href="{{URL('serviceFeedback')}}">
                                                        Service Feedback
                                                    </a>
                                                </li>
                                                <li class="submenu__link ">
                                                    <a class="submenu__item" href="{{URL('escalate-to-service')}}">
                                                        Escalate to Service Head
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </li>
                            {{--
                                                    <li class="dropdown megamenu__link">
                                                        <a class="megamenu__item"
                                                        href="{{URL('serviceFeedback')}}">
                            Service Feedback
                            </a>
                            </li>
                            <li class="megamenu__link ">
                                <a class="megamenu__item" href="{{URL('escalate-to-service')}}">
                                    Escalate to Service Head
                                </a>
                            </li>
                            --}}
                            <li class="dropdown megamenu__link">
                                <a class="megamenu__item menu-has-child" href="{{URL('product-support')}}">
                                    Product Support
                                </a>
                                <div class="submenu-wrapper">
                                    <div class="submenu-wrapper__inner  smooth-scroll-bar">
                                        <!-- Grid -->
                                        <div class="submenu-grid w-100">
                                            <ul class="submenu__list">

                                              <!--  <li class="submenu__link ">
                                                    <a class="submenu__item" href="http://59.92.232.2:98/view/RegistrationWarranty.aspx">
                                                        Register Your Product Warranty
                                                    </a>
                                                </li>  -->
                                                {{--
                                                     <!--    <li class="submenu__link ">
                                                                            <a class="submenu__item"
                                                                                href="http://59.92.232.2:98/view/RegistrationWarranty.aspx">
                                                                        Warranty Extension/AMC

                                                                           </a>
                                                           </li>  -->
                                                  --}}
                            <li class="submenu__link ">
                                <a class="submenu__item" href="{{URL('user-manuals')}}">
                                    <!-- User Manuals -->
                                    User Manuals & Product Warranty Details
                                </a>
                            </li>
                            <li class="submenu__link ">
                                <a class="submenu__item" href="{{URL('warranty-terms')}}">
                                    <!-- Warranty Terms & Conditions -->
                                    General Warranty Terms & Conditions
                                </a>
                            </li>
                            <li class="submenu__link ">
                                <a class="submenu__item" href="{{URL('servicePolicy')}}">
                                    <!-- Service Policy & charges -->
                                    Service Charges
                                </a>
                            </li>
                            <li class="submenu__link ">
                                <a class="submenu__item" href="{{URL('/productFeedback')}}">
                                    Product Feedback
                                </a>
                            </li>
                            <li class="submenu__link ">
                                <a class="submenu__item" href="{{URL('faq')}}">
                                    FAQs
                                </a>
                            </li>
                            <!-- <li class="submenu__link ">
                                                                            <a class="submenu__item"
                                                                                href="{{URL('video-tutorials')}}">
                                                                                Video Tutorials
                                                                            </a>
                                                                        </li> -->
                        </ul>
                    </div>

                </div>
        </div>
        </li>
        <li class="dropdown megamenu__link">
            <a class="megamenu__item" href="{{URL('/drop-point')}}">
                Recycling Support
            </a>
        </li>
        {{-- <li class="dropdown megamenu__link">
                                                        <a class="megamenu__item menu-has-child" href="#">
                                                            Warranty & Service Policy
                                                        </a>
                                                        <div class="submenu-wrapper">
                                                            <div class="submenu-wrapper__inner  smooth-scroll-bar">
                                                                <!-- Grid -->
                                                                <div class="submenu-grid w-100">
                                                                    <ul class="submenu__list">




                                                                    </ul>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="dropdown megamenu__link">
                                                        <a class="megamenu__item menu-has-child" href="#">
                                                            Customer Feedback
                                                        </a>
                                                        <div class="submenu-wrapper">
                                                            <div class="submenu-wrapper__inner  smooth-scroll-bar">
                                                                <!-- Grid -->
                                                                <div class="submenu-grid w-100">
                                                                    <ul class="submenu__list">


                                                                    </ul>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </li> --}}

        </ul>
        </div>


        </div>
        <!-- Magamenu Inner -->

        </div>
        </div>
        </li>

        <!-- <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="nav-link__text">
                                        About Us
                                    </span>
                                </a>
                            </li> -->


        <li class="nav-item megamenu-link position-static">
            <a href="{{URL('/about')}}" class="nav-link dropdown-toggle">
                <span class="nav-link__text">
                    About Us
                </span>
            </a>
            <div class="dropdown-menu megamenubar">
                <div class="container">

                    <!-- Magamenu Inner -->
                    <div class="megamenu-inner">
                        <div class="megamenu-inner__left">
                            <ul class="megamenu-list">
                                <li class="dropdown megamenu__link active">
                                    <a class="megamenu__item menu-has-child" href="javascript:void(0);">
                                        Overview
                                    </a>
                                    <div class="submenu-wrapper active">
                                        <div class="submenu-wrapper__inner  smooth-scroll-bar">
                                            <!-- Grid -->
                                            <div class="submenu-grid w-100">
                                                <ul class="submenu__list">
                                                    <li class="submenu__link ">
                                                        <a class="submenu__item"
                                                            href="{{URL('about#history_section')}}">
                                                            Our History
                                                        </a>
                                                    </li>
                                                    <li class="submenu__link ">
                                                        <a class="submenu__item"
                                                            href="{{URL('about#milestone_section')}}">
                                                            Our Milestones

                                                        </a>
                                                    </li>

                                                    <li class="submenu__link ">
                                                        <a class="submenu__item"
                                                            href="{{URL('about#management_section')}}">
                                                            Message
                                                        </a>
                                                    </li>

                                                    <li class="submenu__link ">
                                                        <a class="submenu__item"
                                                            href="{{URL('about#mission_section')}}">
                                                            Mission & Vision
                                                        </a>
                                                    </li>

                                                    {{-- <li class="submenu__link ">
                                                                            <a class="submenu__item" href="{{URL('about#team_section')}}">
                                                    Our Team
                                                    </a>
                                </li>

                                <li class="submenu__link ">
                                    <a class="submenu__item" href="{{URL('about#awards_section')}}">
                                        Awards & Accolades

                                    </a>
                                </li>

                                <li class="submenu__link ">
                                    <a class="submenu__item" href="{{URL('about#brands_section')}}">
                                        Our Brands
                                    </a>
                                </li> --}}

                            </ul>
                        </div>

                    </div>
                </div>
        </li>
        <li class="dropdown megamenu__link">
            <a class="megamenu__item menu-has-child" href="javascript:void(0);">
                Careers
            </a>
            <div class="submenu-wrapper">
                <div class="submenu-wrapper__inner  smooth-scroll-bar">
                    <!-- Grid -->
                    <div class="submenu-grid w-100">
                        <ul class="submenu__list">
                            <li class="submenu__link ">
                                <a class="submenu__item" href="{{URL('careers')}}">
                                    Careers
                                </a>
                            </li>
                            <li class="submenu__link ">
                                <a class="submenu__item" href="{{URL('workingAtImpex')}}">
                                    Working at Impex

                                </a>
                            </li>

                            {{-- <li class="submenu__link ">
                                                                            <a class="submenu__item"
                                                                                href="{{URL('jobFields')}}">
                            Job Fields
                            </a>
        </li> --}}

        <li class="submenu__link ">
            <a class="submenu__item" href="{{URL('careers/search')}}">
                Search
            </a>
        </li>



        </ul>
        </div>

        </div>
        </div>
        </li>

        <li class="dropdown megamenu__link">
            <a class="megamenu__item" href="{{URL('mediaCenters')}}">
                Media / PRs
            </a>
        </li>
        </ul>
        </div>


        </div>
        <!-- Magamenu Inner -->

        </div>
        </div>
        </li>
        </ul>
        </div>


        <div class="nav-search-wrapper">
            <div class="search_holder <?php echo isset($_GET['search']) && $_GET['search'] != ''?'':'' ?>">
                <input type="text" name="search" placeholder="Search" class="form-control search_box"
                    value="{{isset($_GET['search'])?$_GET['search']:''}}">
                <!-- <button class="btn btn-nav-search search_button_click web_search_button_click">

                                <i class="fas fa-chevron-circle-right"></i>

                            </button> -->
            </div>

            <button class="btn btn-nav-search search_button_click web_search_button_click">

                <svg xmlns="http://www.w3.org/2000/svg" width="18.052" height="18.052" viewBox="0 0 18.052 18.052">
                    <g id="Group_1" data-name="Group 1" transform="translate(406.894 -970.568)">
                        <path id="Path_1" data-name="Path 1"
                            d="M21.257,966.366a7.253,7.253,0,1,0,4.767,12.708l4.563,4.556a.481.481,0,1,0,.68-.68l-4.556-4.563a7.244,7.244,0,0,0-5.455-12.02Zm0,.967a6.286,6.286,0,1,1-6.286,6.286A6.279,6.279,0,0,1,21.257,967.333Z"
                            transform="translate(-420.598 4.502)" stroke="#000" stroke-width="0.6" />
                    </g>
                </svg>

            </button>
        </div>

        </div>
        </nav>
        </div>
        <!-- Main Navbar END -->


        <!-- Mobile Menubar -->
        <nav class="nav-header nav-mob">

            <!-- <button class="nav-mob_toggler" id="#menu">
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 96 96" focusable="false">
                    <path d="M83 70v8H13v-8h70zm0-26v8H13v-8h70zm0-26v8H13v-8h70z"></path>
                </svg>
            </button> -->

            <div class="nav-mob__logo">
                <a href="{{URL('/')}}">
                    @if($settings->logo)
                    <img src="{{storage_url()}}/{{$settings->logo}}" class="img-fluid" loading="lazy" alt="impex">
                    @else
                    <img src="{{asset('front/images/logo/logo-nav.png')}}" loading="lazy" class="img-fluid"
                        alt="impex">
                    @endif
                </a>
                {{-- <a href="{{URL('/')}}">
                <img src="{{asset('front/images/logo/logo-nav.png')}}" loading="lazy" class="img-fluid"
                    alt="impex">
                </a>--}}
            </div>
            <div class="nav-mobileins">
                <div class="nav-mob__right">
                    <!-- Search -->
                    <div class="search_holder <?php echo isset($_GET['search']) && $_GET['search'] != ''?'':'hide' ?>">
                        <input type="text" name="search" class="form-control mobile_search_box"
                            value="{{isset($_GET['search'])?$_GET['search']:''}}">
                        <button class="btn btn-nav-search search_button_click mobile_search_button_click">

                            <i class="fas fa-chevron-circle-right"></i>

                        </button>
                    </div>
                    <button class="btn nav-mob__search search_button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18.052" height="18.052"
                            viewBox="0 0 18.052 18.052">
                            <g id="Group_4743" data-name="Group 4743" transform="translate(406.894 -970.568)">
                                <path id="Path_1" data-name="Path 1"
                                    d="M21.257,966.366a7.253,7.253,0,1,0,4.767,12.708l4.563,4.556a.481.481,0,1,0,.68-.68l-4.556-4.563a7.244,7.244,0,0,0-5.455-12.02Zm0,.967a6.286,6.286,0,1,1-6.286,6.286A6.279,6.279,0,0,1,21.257,967.333Z"
                                    transform="translate(-420.598 4.502)" stroke="#000" stroke-width="0.6" />
                            </g>
                        </svg>
                    </button>
                    <!-- Search END -->
                </div>
                <button class="nav-mob_toggler" id="#menu">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 96 96" focusable="false">
                        <path d="M83 70v8H13v-8h70zm0-26v8H13v-8h70zm0-26v8H13v-8h70z"></path>
                    </svg>
                </button>
            </div>
            <nav id="menu">
                <button class="btn nav-menu-close | js-nav-menu-close" id="navClose">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 96 96" focusable="false">
                        <path
                            d="M79.17 11.17L48 42.34 16.83 11.17l-5.66 5.66L42.34 48 11.17 79.17l5.66 5.66L48 53.66l31.17 31.17 5.66-5.66L53.66 48l31.17-31.17z">
                        </path>
                    </svg>
                </button>
                <ul>
                    <li class="Selected"><a href="{{URL('/')}}">Home</a></li>
                    <li><span>Products</span>
                        <ul>
                            @foreach($category as $key => $value)
                            <li><span>{{$value['name']}}</span>
                                @if(count($value['child']) > 0)
                                <ul>
                                    @foreach($value['child'] as $key1 => $value1)
                                    <li>
                                        <a href="{{URL('products/'.$value1['slug'])}}">{{$value1['name']}}</a>
                                        @if(count($value1['child']) > 0)
                                        <ul>
                                            @foreach($value1['child'] as $key2 => $value2)
                                            <li>
                                                <a href="{{URL('products/'.$value2['slug'])}}">
                                                    {{$value2['name']}}
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </li>

                    <li><span>Buy Here</span>
                        <ul>
                            <li><a href="{{URL('vendors')}}">Buy Here</a></li>
                            <li><span>Buy Online</span>
                                <ul>
                                    <li><a href="{{URL('vendors')}}">Buy Online</a></li>
                                    @foreach($vendors as $keyV => $vendor)
                                    <li>
                                        <a target="_blank" rel="noopener" href="{{$vendor->link}}">
                                            {{$vendor->name}}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li>
                                <a href="{{URL('stores')}}">
                                    Visit Store
                                </a>
                            </li>
                            <!-- <li>
                                <a
                                    href="{{URL('product-enquiry')}}">
                                    Product Enquiry
                                </a>
                            </li> -->
                            <li>
                                <a href="{{URL('business-enquiry')}}">
                                    Business Enquiry
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li><span>Service & Support</span>
                        <ul>
                            <li><span>Service Support</span>
                                <ul>
                                    <li><a href="{{URL('service-support')}}">Service & Support</a></li>
                                    <li>
                                        <a href="https://tinyurl.com/servicetz" rel="noopener" target="_blank">
                                            Register Your Service Request
                                        </a>
                                    </li>
                                    <!-- <li >
                                        <a href="{{URL('service/track')}}">
                                            Track Your Service Request

                                        </a>
                                    </li> -->
                                    <li>
                                        <a href="{{URL('service/centers')}}">
                                            Find Service Centers
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{URL('serviceFeedback')}}">
                                            Service Feedback
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{URL('escalate-to-service')}}">
                                            Escalate to Service Head
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li><span>Product Support</span>
                                <ul>
                                    <!-- <li><a href="{{URL('product-support')}}">Product Support</a></li> -->
                                  <!--  <li>
                                        <a href="http://59.92.232.2:98/view/RegistrationWarranty.aspx">
                                            Register Your Product Warranty
                                        </a>
                                    </li>  -->

                                    <li>
                                        <a href="{{URL('user-manuals')}}">
                                            User Manuals & Product Warranty Details
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{URL('warranty-terms')}}">
                                            General Warranty Terms & Conditions
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{URL('servicePolicy')}}">
                                            Service charges

                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{URL('/productFeedback')}}">
                                            Product Feedback
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{URL('faq')}}">
                                            FAQ
                                        </a>
                                    </li>
                                    <!-- <li>
                                        <a href="{{URL('video-tutorials')}}">
                                            Video Tutorials
                                        </a>
                                    </li> -->
                                </ul>
                            </li>
                            <!-- <li><span>Warranty & Service Policy</span>
                                <ul>

                                    <li>
                                        <a href="{{URL('warranty-extension')}}">
                                            Warranty Extension/AMC

                                        </a>
                                    </li>


                                </ul>
                            </li> -->
                            <li><a href="{{URL('/drop-point')}}">
                                    Recycling Support
                                </a>
                            </li>
                            <!-- <li><span>Customer Feedback</span>
                                <ul>





                                </ul>
                            </li> -->

                        </ul>
                    </li>

                    <li><span>About Us</span>
                        <ul>
                            <li>
                                <a href="{{URL('about')}}">
                                    Overview
                                </a>
                            </li>
                            <!--<li>
                                <a href="{{URL('service/centers')}}">
                                    Service Centers
                                </a>
                            </li>-->
                            <li>
                                <span>Careers</span>
                                <ul>
                                    <li>
                                        <a href="{{URL('careers')}}">
                                            Careers
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{URL('workingAtImpex')}}">
                                            Working at Impex

                                        </a>
                                    </li>

                                    {{-- <li>
                                        <a href="{{URL('jobFields')}}">
                                    Job Fields
                                    </a>
                            </li> --}}

                            <li>
                                <a href="{{URL('careers/search')}}">
                                    Search
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{URL('mediaCenters')}}">Media / PRs</a>
                    </li>
                </ul>
                </li>
                <li>
                    <a href="{{URL('contact')}}">Contact Us</a>
                </li>
                <li class="social-links">
                    @if($settings->facebook)
                    <a href="{{$settings->facebook}}" target="_blank" class="icon">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    @endif
                    @if($settings->twitter)
                    <a href="{{$settings->twitter}}" target="_blank" class="icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    @endif
                    @if($settings->instagram)
                    <a href="{{$settings->instagram}}" target="_blank" class="icon">
                        <i class="fab fa-instagram"></i>
                    </a>
                    @endif
                    @if($settings->linkedin)
                    <a href="{{$settings->linkedin}}" target="_blank" class="icon">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    @endif
                    @if($settings->youtube)
                    <a href="{{$settings->youtube}}" target="_blank" class="icon">
                        <i class="fab fa-youtube"></i>
                    </a>
                    @endif

                </li>
                </ul>
            </nav>
        </nav>
        <!-- Mobile Menubar END -->

    </header>



    @yield('content')


    <!-- Modal Cookie -->
    <div class="modal fade" id="cookiesModal" tabindex="-1" role="dialog" aria-labelledby="cookiesModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn close-modal" data-dismiss="modal" aria-label="Close">
                    <i class="lni lni-close"></i>
                </button>
                <div class="modal-wrap">
                    <h2 class="modal-caption mb-3">Cookie Preferences</h2>
                    {!! $pages[1]->description !!}

                    <div class="group-button">
                        <!-- <a href="" class="btn required-button mr-3 ">
                            Required Only
                        </a> -->
                        <a onClick="accept()" class="btn accept-all-button" data-dismiss="modal" aria-label="Close">
                            Accept All
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal Cookie END -->

    <!-- Modal Service & Support -->
    <div class="modal fade serviceNsupport" id="serviceModal" tabindex="-1" role="dialog"
        aria-labelledby="serviceModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn close-modal" data-dismiss="modal" aria-label="Close">
                    <i class="lni lni-close"></i>
                </button>
                <div class="full-model">
                    <div class="left-image">
                        <img src="{{storage_url()}}/{{$pages[0]->image}}" loading="lazy" class="img-fluid" alt="img">
                    </div>
                    <div class="right-content">
                        <h6 class="pop-title">{{$pages[0]->title}}</h6>
                        {!! $pages[0]->description !!}
                        <h6 class="support-links">Supports From US</h6>
                        <div class="supporting">
                            <ul>
                                <li>
                                    <div class="support-icns">
                                        <img src="{{asset('front/images/icons/chat.png')}}" loading="lazy"
                                            class="img-fluid" alt="img">
                                    </div>
                                    <div class="S-links">
                                        <a href="{{URL('contact')}}">Chat With Us</a>
                                    </div>
                                </li>
                                @if($settings->whatsapp)
                                <?php
                                $whatsapp=preg_replace('/[^A-Za-z0-9\-]/', '', $settings->whatsapp);
                            ?>
                                <li>
                                    <div class="support-icns">
                                        <img src="{{asset('front/images/icons/whatsapp.png')}}" loading="lazy"
                                            class="img-fluid" alt="img">
                                    </div>
                                    <div class="S-links">
                                        <a target="_blank" id="whatsapp"
                                            href="http://api.whatsapp.com/send?phone={{$whatsapp}}">To WhatsApp Us</a>
                                    </div>
                                </li>
                                @endif
                                @if($settings->email)
                                <li>
                                    <div class="support-icns">
                                        <img src="{{asset('front/images/icons/mail.png')}}" loading="lazy"
                                            class="img-fluid" alt="img">
                                    </div>
                                    <div class="S-links">

                                        <a href="mailto:{{$settings->email}}">Email US</a>

                                    </div>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Service & Support END -->
    <div class="scroll-top">
        <button onclick="topFunction()" id="myBtn">
            <div class="ico animated">

                <div class="circle circle-top"></div>
                <div class="circle circle-main"></div>
                <div class="circle circle-bottom"></div>
                <img src="{{asset('front/images/icons/arrow-down.svg')}}" loading="lazy" class="img-fluid"
                    alt="icon">
                <!-- <svg class="svg" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 612 612" style="enable-background:new 0 0 612 612;" xml:space="preserve" >
        <defs>
            <clipPath id="cut-off-arrow">
            <circle cx="306" cy="306" r="287"/>
            </clipPath>

            <filter id="goo">
            <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
            <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
            <feBlend in="SourceGraphic" in2="goo" />
            </filter>

        </defs>
            <path  class="st-arrow" d="M317.5,487.6c0.3-0.3,0.4-0.7,0.7-1.1l112.6-112.6c6.3-6.3,6.3-16.5,0-22.7c-6.3-6.3-16.5-6.3-22.7,0
                            l-86,86V136.1c0-8.9-7.3-16.2-16.2-16.2c-8.9,0-16.2,7.3-16.2,16.2v301.1l-86-86c-6.3-6.3-16.5-6.3-22.7,0
                            c-6.3,6.3-6.3,16.5,0,22.7l112.7,112.7c0.3,0.3,0.4,0.7,0.7,1c0.5,0.5,1.2,0.5,1.7,0.9c1.7,1.4,3.6,2.3,5.6,2.9
                            c0.8,0.2,1.5,0.4,2.3,0.4C308.8,492.6,313.8,491.3,317.5,487.6z"/>
        </svg> -->
            </div>
        </button>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">


                <div class="col-sm-6   col-lg-2 widget-group">
                    <h4 class="widget-title">Products</h4>
                    <ul>
                        @foreach($footers as $child)
                        <li><a href="{{URL('products')}}/{{$child->category->slug}}">{{$child->category->name}}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-sm-6 col-lg-2 offset-lg-1  widget-group">
                    <h4 class="widget-title"> Service & Support</h4>
                    <ul>
                        @foreach($service_links as $service)
                        <li><a href="{{$service->link}}">{{$service->title}}
                            </a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm-6 col-lg-2 offset-lg-1 widget-group">
                    <h4 class="widget-title">Quick Links</h4>
                    <ul>
                        @foreach($quick_links as $quick)
                        <li><a href="{{$quick->link}}">{{$quick->title}}
                            </a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-sm-6 col-lg-3 widget-group offset-lg-1 ">
                    <div class="footerFlex">
                        <div class="footer-right">
                            <a href="{{URL('/')}}">
                                @if($settings->logo)
                                <img src="{{storage_url()}}/{{$settings->logo}}" loading="lazy"
                                    class="img-fluid footer-logo" alt="impex">
                                @else
                                <img src="{{asset('front/images/logo/logo-nav.png')}}" loading="lazy"
                                    class="img-fluid footer-logo" alt="impex">
                                @endif
                            </a>
                            <div class="news-letter">
                                <form method="post" id="form_subscription_submit">
                                    {{ csrf_field() }}
                                    <div class="input-group mb-3">
                                        <input type="email" name="sub_email" id="sub_email" class="form-control"
                                            placeholder="Subscribe for newsletters"
                                            aria-label="subscribe for newsletters" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn " type="submit">
                                                <img src="{{asset('public/front/images/icons/right-arrow.png')}}"
                                                    loading="lazy" alt="">
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <span style="color:red" id="subscribed_message"></span>
                            </div>
                            <div class="social-links">
                                @if($settings->facebook)
                                <a href="{{$settings->facebook}}" class="icon" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                @endif
                                @if($settings->twitter)
                                <a href="{{$settings->twitter}}" class="icon" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                @endif
                                @if($settings->instagram)
                                <a href="{{$settings->instagram}}" class="icon" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                @endif
                                @if($settings->linkedin)
                                <a href="{{$settings->linkedin}}" class="icon" target="_blank">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                @endif
                                @if($settings->youtube)
                                <a href="{{$settings->youtube}}" target="_blank" class="icon">
                                    <i class="fab fa-youtube"></i>
                                </a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </footer>
    <div class="copy-right">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <ul class="list-inline">
                        <!-- <li class="list-inline-item">
                            <a class="social-icon text-xs-center" href="#">Sitemap</a>
                        </li> -->
                        <li class="list-inline-item"><a class="social-icon text-xs-center"
                                href="{{URL('privacyPolicy')}}">Privacy
                                Policy</a>
                        </li>
                        <li class="list-inline-item"><a class="social-icon text-xs-center" href="{{URL('terms')}}">Terms
                                &
                                Conditions</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="col-right text-md-right">{{$settings->copyright}}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer END -->
    <link rel="stylesheet" href="{{asset('front/fonticon/font-css/LineIcons.min.css')}}" media="screen">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
        media="screen"
        integrity="sha512-L7MWcK7FNPcwNqnLdZq86lTHYLdQqZaz5YcAgE+5cnGmlw8JT03QB2+oxL100UeB6RlzZLUxCGSS4/++mNZdxw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="{{asset('front/fonticon/fontawsome/css/all.min.css')}}" media="screen"> -->
    <!-- Font Family -->
    <link rel="stylesheet" href="{{asset('front/font-family/font-css/font-style.min.css')}}" media="screen">
    <!-- Plugins -->
    <!-- <link rel="stylesheet" href="{{asset('front/plugins/plugin-bundle.css')}}" media="screen"> -->
    <link rel="stylesheet" href="{{asset('front/plugins/mmenu/mmenu-light.css')}}" media="screen">
    <link rel="stylesheet" href="{{asset('front/plugins/datepicker/bootstrap-datepicker.min.css')}}" media="screen">
    <link rel="stylesheet" href="{{asset('front/plugins/slick/slick.min.css')}}" media="screen">
    <link rel="stylesheet" href="{{asset('front/plugins/scrollbar/jquery.mCustomScrollbar.min.css')}}" media="screen">
    <link rel="stylesheet" href="{{asset('front/plugins/perfect-scroll/perfect-scroll.css')}}" media="screen">
    <link rel="stylesheet" href="{{asset('front/plugins/owl-carousel/assets/owl.carousel.min.css')}}" media="screen">
    <link rel="stylesheet" href="{{asset('front/plugins/owl-carousel/assets/owl.theme.default.min.css')}}" media="screen">
    <link rel="stylesheet" href="{{asset('front/plugins/timeline/timeline.min.css')}}" media="screen">
    <link rel="stylesheet" href="{{asset('front/plugins/pricerange/nouislider.min.css')}}" media="screen">
    <link rel="stylesheet" href="{{asset('front/plugins/fancybox/jquery.fancybox.min.css')}}" media="screen">
    <!-- Core CSS -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" media="screen" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
        integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.5.0/swiper-bundle.min.css"
        integrity="sha512-T9Nrm9JU37BvYFgjYGVYc8EGnpd3nPDz/NY19X6gsNjb0VHorik8KDBljLHvqWdqz9igNqTBvZY4oCJQer4Xtg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="{{asset('front/plugins/slick/slick.min.css')}}" media="screen"> -->
    <!-- JavaScript -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src='https://www.google.com/recaptcha/api.js' async defer></script> -->

    <script src="{{asset('front/script/frameworks/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/script/frameworks/popper.min.js')}}"></script>
    <!-- Plugins -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.6.7/js/min/perfect-scrollbar.jquery.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="{{asset('front/plugins/plugin-bundle.min.js')}}" async></script> -->

    <script src="{{asset('front/plugins/timeline/timeline.min.js')}}"></script>
    <!-- Menubar -->
    <script src="{{asset('front/plugins/mmenu/mmenu-light.js')}}"></script>
    <script src="{{asset('front/plugins/mmenu/mmenu-light.polyfills.js')}}"></script>
    <!-- Custom Script -->
    <script src="{{asset('front/script/slick.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"
        integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('front/script/bootstrap-tagsinput.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/elevatezoom/3.0.8/jquery.elevatezoom.min.js"
        integrity="sha512-egjn0g4nyX3074dTJbuzFHdPDu17RP8ElcYpQuQbl9VUu6RKQaqlX4dJJ/l7Z5fFniqLSOJgytwP0FiKf4MEfA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.5.0/swiper-bundle.min.js"
        integrity="sha512-VfcksjYXPZW36rsAGxeRGdB0Kp/htJF9jY5nlofHtRtswIB+scY9sbCJ5FdpdqceRRkpFfHZ3a9AHuoL4zjG5Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{asset('front/plugins/plugin-bundle.js')}}" async></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.7.0/nouislider.min.js" integrity="sha512-jWNpWAWx86B/GZV4Qsce63q5jxx/rpWnw812vh0RE+SBIo/mmepwOSQkY2eVQnMuE28pzUEO7ux0a5sJX91g8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{asset('front/script/app.js')}}"></script>
    <script src="{{asset('front/script/dev.js')}}"></script>
    {{-- <script src="{{asset('front/script/dev-not-minified.js')}}"></script> --}}

    <script src="{{asset('admins/js/moment.min.js')}}"></script>
    @yield('script')
    <!-- lazy loading -->
   <script>
        function init() {
            var imgDefer = document.querySelectorAll('div[data-src]');
            var style = "background-image: url({url})";
            for (var i = 0; i < imgDefer.length; i++) {

                imgDefer[i].setAttribute('style', style.replace("{url}", imgDefer[i].getAttribute('data-src')));

            }
        }

        window.onload = init;

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var lazyloadImages;

            if ("IntersectionObserver" in window) {
                lazyloadImages = document.querySelectorAll(".lazy");
                var imageObserver = new IntersectionObserver(function (entries, observer) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            var image = entry.target;
                            image.src = image.dataset.src;
                            image.classList.remove("lazy");
                            imageObserver.unobserve(image);
                        }
                    });
                });

                lazyloadImages.forEach(function (image) {
                    imageObserver.observe(image);
                });
            } else {
                var lazyloadThrottleTimeout;
                lazyloadImages = document.querySelectorAll(".lazy");

                function lazyload() {
                    if (lazyloadThrottleTimeout) {
                        clearTimeout(lazyloadThrottleTimeout);
                    }

                    lazyloadThrottleTimeout = setTimeout(function () {
                        var scrollTop = window.pageYOffset;
                        lazyloadImages.forEach(function (img) {
                            if (img.offsetTop < (window.innerHeight + scrollTop)) {
                                img.src = img.dataset.src;
                                img.classList.remove('lazy');
                            }
                        });
                        if (lazyloadImages.length == 0) {
                            document.removeEventListener("scroll", lazyload);
                            window.removeEventListener("resize", lazyload);
                            window.removeEventListener("orientationChange", lazyload);
                        }
                    }, 20);
                }

                document.addEventListener("scroll", lazyload);
                window.addEventListener("resize", lazyload);
                window.addEventListener("orientationChange", lazyload);
            }
        })

    </script>
    <!-- ends -->

    <script>


        $(document).ready(function () {
            $('.widget-group .widget-title').click(function () {
                // $('.widget-group').removeClass('open');
                // $(this).closest('.widget-group').toggleClass('open');
                //  $('.widget-group').removeClass('open');
                if ($(this).parent().hasClass('open')) {
                    $(this).parent().removeClass('open');
                } else {
                    $('.widget-group').removeClass('open');
                    $(this).parent().addClass('open');
                }
            });


            $(".megamenu-link").hover(function (e) {
                $(this).toggleClass('open');
                if ($(window).width() > 992) {
                    $(this).children(".megamenubar").stop(true, false).fadeToggle(150);
                    e.preventDefault();
	                }
            });

        });

    </script>
    

  

  <script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.1/js/OverlayScrollbars.min.js"
      integrity="sha512-B1xv1CqZlvaOobTbSiJWbRO2iM0iii3wQ/LWnXWJJxKfvIRRJa910sVmyZeOrvI854sLDsFCuFHh4urASj+qgw=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
        let targetEl;
        function scrollToTop(e){
            let currentScrollpos=e.target.scrollTop;
            targetEl =e.target;
            if(currentScrollpos>500){
                $('.scroll-top').show();
            }else{
                $('.scroll-top').hide();
            }
        }

        function topFunction(){
           //targetEl.scrollTop=0;
           $(targetEl).animate({ scrollTop: 0 }, 'slow');
        }

      //initializes Overlay Scrollbar
      var bottomReached = false;
        var instance = $('#bodyEl').overlayScrollbars({
            resize: "none",
            callbacks: {
                onScroll: function(e){
                    scrollToTop(e)
                }
            }
        }).overlayScrollbars();




    //   $('.os-host-overflow-y ').scroll(function () {
    //       console.log("josco")
    //         var y = $(this).scrollTop();
    //         if (y > 500) {
    //             $('.scroll-top').show();
    //         } else {
    //             $('.scroll-top').hide();
    //         }
    //     });
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js"></script>
</body>


</html>
