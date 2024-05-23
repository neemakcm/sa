/**
 * Template : Impex
 * Author: WebCastle Media
 * Author URL :https://webcastletech.com/
 */
$(document).ready(function() {

    // Assign some jquery elements we'll need
    var $swiper = $(".swiper-container");
    var $bottomSlide = null; // Slide whose content gets 'extracted' and placed
    // into a fixed position for animation purposes
    var $bottomSlideContent = null; // Slide content that gets passed between the
    // panning slide stack and the position 'behind'
    // the stack, needed for correct animation style
    var mySwiper = new Swiper(".js-new-launch", {
        spaceBetween: 50,
        slidesPerView: 1,
        centeredSlides: true,
        roundLengths: true,
        loop: true,
        autoplay: true,
        loopAdditionalSlides: 30,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
        }

    });

    $('.new-launch-product-tabs a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
        console.log('ddd');
        var paneTarget = $(e.target).attr('href');
        var $thePane = $('.tab-pane' + paneTarget);
        var paneIndex = $thePane.index();
        if ($thePane.find('.swiper-container').length > 0 && 0 === $thePane.find('.swiper-slide-active').length) {
            mySwiper[paneIndex].update();
        }
    });

    /**
     * ------------------------------------------------------------------
     * Product Size Slider
     * ------------------------------------------------------------------
     */
    $('.ps-size-carousel').owlCarousel({
        loop: false,
        margin: 15,
        nav: true,
        dots: false,
        mouseDrag: true,
        touchDrag: true,
        autoWidth: true,
        navText: [
            '<img src="front/images/icons/slider-left-arrow.svg" class="img-fluid" alt="icon">', '<img src="front/images/icons/slider-right-arrow.svg" class="img-fluid" alt="icon">'
        ],
        responsive: {
            0: {
                items: 4
            },
            600: {
                items: 4
            },
            1000: {
                items: 5
            }
        }
    });
    /**
     * ------------------------------------------------------------------
     *cookies hide
     * ------------------------------------------------------------------
     */

    $(".js-close-cookie").click(function() {
        $(".section-cookie").css("display", "none");
    });

    /**
     * --------------------------------------------------------------------------------------
     * Offcanvas Menu
     * --------------------------------------------------------------------------------------
     */
    var menu = new MmenuLight(
        document.querySelector('#menu'),
        'all'
    );

    var navigator = menu.navigation({
        // selectedClass: 'Selected',
        // slidingSubmenus: true,
        // theme: 'dark',
        // title: 'Menu'
    });

    var drawer = menu.offcanvas({
        position: 'right'
    });

    //	Open the menu.
    document.getElementById('#menu')
        .addEventListener('click', function(evnt) {
            evnt.preventDefault();
            drawer.open();
        });
    $('.js-nav-menu-close').on('click', function(evnt) {
        evnt.preventDefault();
        drawer.close();
    });


    /*
    ----------------------------------------------------------------
    Megamenu
    ----------------------------------------------------------------
    // */
    // $(".megamenu-link").hover(

    //     function (e) {
    //         $('.megamenubar', this).not('.in .megamenubar').stop(true, true).slideDown("000");
    //         $(this).toggleClass('open');
    //     },
    //     function (e) {

    //         $('.megamenubar', this).not('.in .megamenubar').stop(true, true).slideUp("000");
    //         $(this).toggleClass('open');
    //     }
    // );

    // $(".dropdown").hover(function () {
    //     var dropdownMenu = $(this).children(".dropdown-menu");
    //     alert();
    //     if (dropdownMenu.is(" dropdownMenu:hidden")) {
    //         alert(2);
    //         dropdownMenu.parent().toggleClass("open");
    //     }
    // });

    "use strict";

    // $(".megamenu-inner .megamenu__link").on('mouseenter', function() {
    //     $(".megamenu-link.open .megamenu-inner .megamenu__link").removeClass('active');
    //     $(".megamenu-link.open .megamenu-inner .submenu-wrapper").removeClass('active');
    //     // $(".megamenu-inner .submenu-wrapper").removeClass('active');
    //     $(this).addClass('active');
    //     $(this).find('.submenu-wrapper').addClass('active');
    // });
    $(".megamenu-inner .megamenu__link").on('mouseenter', function() {
        $(".megamenu-link.open .megamenu-inner .megamenu__link").removeClass('active');
        $(".megamenu-link.open .megamenu-inner .submenu-wrapper").removeClass('active');
        // $(".megamenu-inner .submenu-wrapper").removeClass('active');
        $(this).addClass('active');
        $(this).find('.submenu-wrapper').addClass('active');
    });
    $(".submenus-news .subdropdown").on('mouseenter', function() {
        $(".submenus-news .subdropdown").removeClass('active');
        $(".submenus-news .new-submenu-wrapper").removeClass('active');
        $(this).addClass('active');
        $(this).find('.new-submenu-wrapper').addClass('active');
    });

    /*
    ----------------------------------------------------------------
    Home Banner Carousel
    ----------------------------------------------------------------
    */
    $(".slider").slick({
        infinite: true,
        speed: 2000,
        slidesToShow: 1,
        slidesToScroll: 1,
        pauseOnHover: true,
        autoplay: true,
        autoplaySpeed: 4000,
        // dots: true,
        // arrows: false,
        prevArrow: '<button class="slick-arrow-left"><img src="' + base_url + 'front/images/icons/left-arrow.png" class="img-fluid" alt="icon"></button>',
        nextArrow: '<button class="slick-arrow-right"><img src="' + base_url + 'front/images/icons/right-arrow.png" class="img-fluid" alt="icon"></button>',
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    dots: false,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: false,
                },
            },
            {
                breakpoint: 0,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: false,
                },
            },
        ],

        // responsive: [
        //     {
        //         breakpoint: 0,
        //         settings: {
        //             autoplay: true,
        //             arrows: false,
        //             dots: true,
        //         }
        //     },
        //     {
        //         breakpoint: 768,
        //         settings: {
        //             dots: false,
        //             autoplay: false,
        //             arrows: true,
        //         }
        //     },
        //     {
        //         breakpoint: 1024,
        //         settings: {
        //             dots: false,
        //             autoplay: false,
        //             arrows: true,
        //         }
        //     },
        // ]
    });

    //     $('#toggle').click( function() {
    //   if ($(this).html() == '<i class="fa fa-pause"></i>'){
    //      $('.slider').slick('slickPause')
    //      $(this).html('<i class="fa fa-play"></i>') 
    //   } else {
    //     $('.slider').slick('slickPlay')  
    //     $(this).html('<i class="fa fa-pause"></i>') 
    //   }  
    // });

    // $(".main-banner-slider").slick({
    //     dots: true,
    //     fade: true,
    //     pauseOnHover: false,
    //     arrows: true,
    //     infinite: true,
    //     autoplay: true,
    //     autoplaySpeed: 3000,
    //     speed: 3000,
    //     slidesToShow: 1,
    //     adaptiveHeight: false,
    //     prevArrow: '<button class="slick-arrow-left"><img src="' + base_url + 'front/images/icon/slider/arrow-left.png" class="img-fluid" alt="icon"></button>',
    //     nextArrow: '<button class="slick-arrow-right"><img src="' + base_url + 'front/images/icon/slider/arrow-right.png" class="img-fluid" alt="icon"></button>',
    // });

    $('#toggle').click(function() {
        if ($(this).html() == '<i class="fa fa-pause"></i>') {
            $('.main-banner-slider').slick('slickPause')
            $(this).html('<i class="fa fa-play"></i>')
        } else {
            $('.main-banner-slider').slick('slickPlay')
            $(this).html('<i class="fa fa-pause"></i>')
        }
    });

    /**
     * -----------------------------------------------------------------
     * Slider Nav 
     * -----------------------------------------------------------------
     */
    $('.js-product-featured').owlCarousel({
        items: 1,
        dots: true,
        nav: true,
        margin: 0,
        autoplay: true,
        autoPlaySpeed: 5000,
        autoPlayTimeout: 5000,
        autoplayHoverPause: true,
        navText: [
            '<img src="' + base_url + 'front/images/icons/left-arrow.png" class="img-fluid" alt="icon">', '<img src="' + base_url + 'front/images/icons/right-arrow.png" class="img-fluid" alt="icon">'
        ],
    });

    /**
     * ------------------------------------------------------------------
     * Product Details Carousel
     * ------------------------------------------------------------------
     */

    setTimeout(function() {
        $('.slider-for').slick({
            slidesToShow: 1,
            //slidesToScroll: 1,
            //arrows: true,
            //fade: true,
            asNavFor: '.slider-nav',
            margin: 0,
            autoplay: false,
            centerMode: false,
            nav: true,
            infinite: false,
        });

        $('.slider-for').on('afterChange', function(event, slick, currentSlide) {

            var length = $('.slider-item').length;

            if (currentSlide === length - 1) {
                $('.slick-next').addClass('hidden');
            } else {
                $('.slick-next').removeClass('hidden');
            }

            if (currentSlide === 0) {
                $('.slick-prev').addClass('hidden');
            } else {
                $('.slick-prev').removeClass('hidden');
            }
        });

        $('.slider-nav').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            vertical: true,
            infinte: false,
            asNavFor: '.slider-for',
            //dots: false,
            focusOnSelect: true,
            verticalSwiping: true,
            // prevArrow: '<img src="'+base_url+'front/images/icons/arrow-up.svg" class="img-fluid" alt="arrow>',
            // nextArrow: '<img src="'+base_url+'front/images/icons/arrow-down.svg" class="img-fluid" alt="arrow>',
            responsive: [{
                    breakpoint: 992,
                    settings: {
                        vertical: true,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        vertical: true,
                    }
                },
                {
                    breakpoint: 580,
                    settings: {
                        vertical: false,
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 380,
                    settings: {
                        vertical: false,
                        slidesToShow: 2,
                    }
                }
            ]
        });

        if ($('.zoom_effect').length > 0) {
            $('.zoom_effect .slick-current img').elevateZoom();

            $('.slider-for').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
                var img = $(slick.$slides[nextSlide]).find("img");
                $('.zoomWindowContainer,.zoomContainer').remove();
                $(img).elevateZoom();
            });
        }
    }, 1000);

    setTimeout(function() {
        $('.zoom_effect').removeClass('visible_hide');
    }, 1500);

    /**
     * -----------------------------------------------------------------
     * Other Products 
     * -----------------------------------------------------------------
     */
    $('.js-product-carousel').owlCarousel({
        loop: true,
        margin: 0,
        autoplay: true,
        smartSpeed: 1500,
        dots: false,
        // autoPlay: true,
        // autoplayTimeout: 5000,
        autoplayHoverPause: true,
        nav: true,
        navText: [
            '<img src="' + base_url + 'front/images/icons/left-arrow.png" class="img-fluid" alt="icon">', '<img src="' + base_url + 'front/images/icons/right-arrow.png" class="img-fluid" alt="icon">'
        ],
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 2,
            },
            992: {
                items: 2.5,
                margin: 40,
            },
        },

    });


    /**
     * -----------------------------------------------------------------
     * Related Products
     * -----------------------------------------------------------------
     */
    $('.js-item-list').owlCarousel({
        //loop: true,
        margin: 0,
        autoplay: true,
        smartSpeed: 1500,
        dots: false,
        // autoPlay: true,
        // autoplayTimeout: 5000,
        autoplayHoverPause: true,

        navText: [
            '<img src="' + base_url + 'front/images/icons/left-arrow.png" class="img-fluid" alt="icon">', '<img src="' + base_url + 'front/images/icons/right-arrow.png" class="img-fluid" alt="icon">'
        ],
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 2,
                nav: false
            },
            992: {
                items: 3,
                margin: 40,
                nav: true
            },
        },

    });
    /**
     * -----------------------------------------------------------------
     * compare Products
     * -----------------------------------------------------------------
     */
    $('.js-item-compare').owlCarousel({
        loop: false,
        margin: 0,
        autoplay: false,
        dots: false,
        // autoPlay: true,
        // autoplayTimeout: 5000,
        autoplayHoverPause: true,
        nav: true,
        navText: [
            '<img src="' + base_url + 'front/images/icons/left-arrow.png" class="img-fluid" alt="icon">', '<img src="' + base_url + 'front/images/icons/right-arrow.png" class="img-fluid" alt="icon">'
        ],
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 2,
            },
            992: {
                items: 3,
            },
        },

    });

    /**
     * -----------------------------------------------------------------
     * New Trends
     * -----------------------------------------------------------------
     */
    var newLaunch = $('.js-new-trends').owlCarousel({
        loop: true,
        // rtl: true,
        items: 3,
        margin: 30,
        autoplay: true,
        nav: false,
        dots: false,
        autoplayTimeout: 5000,
        smartSpeed: 1500,
        animateOut: 'fadeOut',
        autoplayHoverPause: true,
        animateIn: 'fadeIn',
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            992: {
                items: 2
            },
            1200: {
                items: 2
            }
        },
    });

    $(".js-slide-prev").click(function() {
        newLaunch.trigger('prev.owl.carousel');
    });
    $(".js-slide-next").click(function() {
        newLaunch.trigger('next.owl.carousel');
    });
    // $('.slider-dat').removeClass('current');

    newLaunch.on('translate.owl.carousel', function(event) {
        var activeSlideIndex = newLaunch.find(".owl-item.active .item").attr("data-tab");
        $('.slider-dat').removeClass('current');
        $('.slider-dat').each(function() {
            if ($(this).attr('id') === activeSlideIndex) {
                $(this).addClass('current');
                // console.log('find')
            }
        });
    });

    var slideActive = newLaunch.find(".owl-item.active .item").attr("data-tab");
    $('.slider-dat').each(function() {
        if ($(this).attr('id') === slideActive) {
            $(this).addClass('current');
        }
    });



    var popNewLaunch = $('.pop-js-new-trends').owlCarousel({
        loop: true,
        // rtl: true,
        items: 3,
        margin: 30,
        autoplay: true,
        nav: false,
        dots: false,
        autoplayTimeout: 5000,
        smartSpeed: 1500,
        animateOut: 'fadeOut',
        autoplayHoverPause: true,
        animateIn: 'fadeIn',
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            992: {
                items: 2
            },
            1200: {
                items: 2
            }
        },
    });

    $(".pop-js-slide-prev").click(function() {
        popNewLaunch.trigger('prev.owl.carousel');
    });
    $(".pop-js-slide-next").click(function() {
        popNewLaunch.trigger('next.owl.carousel');
    });
    // $('.slider-dat').removeClass('current');

    popNewLaunch.on('translate.owl.carousel', function(event) {
        var activeSlideIndex = popNewLaunch.find(".owl-item.active .item").attr("data-tab");
        $('.pop-slider-dat').removeClass('current');
        $('.pop-slider-dat').each(function() {
            if ($(this).attr('id') === activeSlideIndex) {
                $(this).addClass('current');
                // console.log('find')
            }
        });
    });

    var slideActive = popNewLaunch.find(".owl-item.active .item").attr("data-tab");
    $('.pop-slider-dat').each(function() {
        if ($(this).attr('id') === slideActive) {
            $(this).addClass('current');
        }
    });


    var offNewLaunch = $('.off-js-new-trends').owlCarousel({
        loop: true,
        rtl: true,
        items: 3,
        margin: 30,
        autoplay: true,
        nav: false,
        dots: false,
        autoplayTimeout: 5000,
        smartSpeed: 1500,
        animateOut: 'fadeOut',
        autoplayHoverPause: true,
        animateIn: 'fadeIn',
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            992: {
                items: 2
            },
            1200: {
                items: 2
            }
        },
    });

    $(".off-js-slide-prev").click(function() {
        offNewLaunch.trigger('prev.owl.carousel');
    });
    $(".off-js-slide-next").click(function() {
        offNewLaunch.trigger('next.owl.carousel');
    });
    // $('.slider-dat').removeClass('current');

    offNewLaunch.on('translated.owl.carousel', function(event) {
        var activeSlideIndex = offNewLaunch.find(".owl-item.active .item").attr("data-tab");
        $('.off-slider-dat').removeClass('current');
        $('.off-slider-dat').each(function() {
            if ($(this).attr('id') === activeSlideIndex) {
                $(this).addClass('current');
                // console.log('find')
            }
        });
    });

    var slideActive = popNewLaunch.find(".owl-item.active .item").attr("data-tab");
    $('.off-slider-dat').each(function() {
        if ($(this).attr('id') === slideActive) {
            $(this).addClass('current');
        }
    });

    /**
     * -----------------------------------------------------------------
     * Home Video Section Slider
     * -----------------------------------------------------------------
     */
    $('.js-slider-video').owlCarousel({
        // loop: true,
        margin: 20,
        autoplay: true,
        smartSpeed: 1500,
        dots: true,
        lazyLoad: true,
        autoplayHoverPause: true,
        autoplayTimeout: 10000,
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 1,
            },
            992: {
                items: 1,
            },
        },

    });


    /*$('.js-new-launch').on('initialized.owl.carousel', function(e) {
        $('.owl-item.active').addClass('scale');
    });
    $('.js-new-launch').on('translate.owl.carousel', function(e) {
        $('.owl-item.active').removeClass('scale');

    });

    $('.js-new-launch').on('translated.owl.carousel', function(e) {
        $('.owl-item.active').addClass('scale');

    });

    $('.js-new-launch').owlCarousel({
        loop: true,
        margin: 0,
        autoplay: true,
        dots: false,
        autoplayTimeout: 8500,
        smartSpeed: 1500,
        nav: true,
        autoplayHoverPause: true,
        // animateOut: 'fadeOut',
        // animateIn: 'fadeIn',
        navText: [
            '<img src="' + base_url + 'front/images/icons/slider/arrow-left.png" class="img-fluid" alt="icon">', '<img src="' + base_url + 'front/images/icons/slider/arrow-right.png" class="img-fluid" alt="icon">'
        ],
        responsive: {
            0: {
                items: 1,
                margin: 10,
            },
            768: {
                items: 1,
                margin: 10,
            },
            992: {
                items: 1,
                margin: 10,
            },
            1200: {
                center: true,
                items: 1,
                stagePadding: 0,
            }
        }
    });*/


    /**
     * ------------------------------------------------------------------
     * About Us Slider
     * ------------------------------------------------------------------
     */
    var aboutPage = $('.js-about-slider').owlCarousel({
        loop: true,
        autoplay: true,
        smartSpeed: 1000,
        dots: true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        nav: true,
        navText: [
            '<img src="' + base_url + 'front/images/icons/left-arrow.png" class="img-fluid" alt="icon">', '<img src="' + base_url + 'front/images/icons/right-arrow.png" class="img-fluid" alt="icon">'
        ],

        responsive: {
            0: {
                items: 1,
                margin: 10,
                nav: false,
            },
            768: {
                items: 1,
                margin: 10,
            },
            992: {
                items: 1,
                margin: 10,
            },
            1200: {
                items: 1,
                margin: 10,
            }
        }
    });
    $('.btn-slide-play').click(function() {
        $(this).removeClass('active').addClass('in-active');
        $('.btn-slide-pause').removeClass('in-active').addClass('active');
    });
    $('.btn-slide-pause').click(function() {
        $(this).removeClass('active').addClass('in-active');
        $('.btn-slide-play').removeClass('in-active').addClass('active');
    });
    $('.btn-slide-play').on('click', function() {
        aboutPage.trigger('play.owl.autoplay');
        console.log('play');
    })
    $('.btn-slide-pause').on('click', function() {
        aboutPage.trigger('stop.owl.autoplay');
        console.log('stop');
    });

    /**
     * ------------------------------------------------------------------
     * Timeline Slider
     * ------------------------------------------------------------------
     */
    timeline(document.querySelectorAll('.timeline'), {
        forceVerticalMode: 700,
        mode: 'horizontal',
        verticalStartPosition: 'left',
        visibleItems: 6
    });
    /**
     * ------------------------------------------------------------------
     * Awwards Carousel
     * ------------------------------------------------------------------
     */

    $('.js-awwards-slider').owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        smartSpeed: 1000,
        autoplayTimeout: 5000,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 2,
            },
            768: {
                items: 3,
                margin: 20,
            },
            992: {
                items: 4,
                margin: 40,
            },
        }
    });

    var awwardsCarousel = $('.js-awwards-slider');

    $('.slider-next-button').click(function() {
        awwardsCarousel.trigger('next.owl.carousel');
    });

    $('.slider-prev-button').click(function() {
        awwardsCarousel.trigger('prev.owl.carousel');
    });

    /**
     * ------------------------------------------------------------------
     * Media Content Slider
     * ------------------------------------------------------------------
     */

    $('.carousel-media-content').owlCarousel({
        loop: true,
        margin: 10,
        // autoplay: true,
        smartSpeed: 1000,
        autoplayTimeout: 4000,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 2,
                margin: 20,
            },
            768: {
                items: 2,
                margin: 30,
            },
            1200: {
                items: 3,
                margin: 60,
            },
        }
    });

    var mediacenterCarousel = $('.carousel-media-content');

    $('.slide-next').click(function() {
        mediacenterCarousel.trigger('next.owl.carousel');
    });

    $('.slide-prev').click(function() {
        mediacenterCarousel.trigger('prev.owl.carousel');
    });


    /**
     * ------------------------------------------------------------------
     * Product Size Slider
     * ------------------------------------------------------------------
     */
    $('.ps-size-carousel').owlCarousel({
        loop: false,
        margin: 15,
        nav: true,
        dots: false,
        mouseDrag: false,
        touchDrag: false,
        autoWidth: true,
        navText: [
            '<img src="' + base_url + 'front/images/icons/slider-left-arrow.svg" class="img-fluid" alt="icon">', '<img src="' + base_url + 'front/images/icons/slider-right-arrow.svg" class="img-fluid" alt="icon">'
        ],
        responsive: {
            0: {
                items: 4
            },
            600: {
                items: 4
            },
            1000: {
                items: 5
            }
        }
    });


    /**
     * ------------------------------------------------------------------
     * Active Size
     * ------------------------------------------------------------------
     */
    $('.pd-size-slider .item  .btn-size-picker').click(function() {
        $('.pd-size-slider .item ').removeClass('active');
        $(this).parent().addClass('active');
    })

    /**
     * ------------------------------------------------------------------
     * Dynamic Add
     * ------------------------------------------------------------------
     */
    var backButton = '<div class="slide-prev"><img src="assets/images/icons/slider/arrow-left.png" class="img-fluid" alt="icon"></div>';
    var nextButton = '<div class="slide-next"><img src="assets/images/icons/slider/arrow-right.png" class="img-fluid" alt="icon"></div>';
    var slideIndex = 1;
    $('.add-remove').slick({
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: false,
        prevArrow: backButton,
        nextArrow: nextButton,
        responsive: [{
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    nav: false,
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: false
                }
            }

        ]
    });
    $('.js-add-slide').on('click', function() {
        slideIndex++;
        $('.add-remove').slick('slickAdd', '<div class="item"><div class="product-content"><div class="product-image"> <img class="img-fluid ps-product__image " src="assets/images/products/list/compare-01.png" alt="product"></div><div class="product-desc"><h4>1m 08cm (43") T5500 Smart..</h4></div></div></div>');
    });

    /*$('.js-add-slide').click(function() {
        $(this).addClass('active');
    })*/

    $('.js-remove-slide').on('click', function() {
        alert();
        $('.add-remove').slick('slickRemove', $(this));
        // if (slideIndex !== 0) {
        //     slideIndex--;
        // }
    });
    /**
     * ------------------------------------------------------------------
     * Product Filter
     * ------------------------------------------------------------------
     */



    /**
     * ------------------------------------------------------------------
     * Footer Accordion
     * ------------------------------------------------------------------
     */




    /**
     * ------------------------------------------------------------------
     * Accordion
     * ------------------------------------------------------------------
     */
    $('.panel-collapse').on('show.bs.collapse', function() {
        $(this).siblings('.accordion-box__header').parent().addClass('active');
    });

    $('.panel-collapse').on('hide.bs.collapse', function() {
        $(this).siblings('.accordion-box__header').parent().removeClass('active');
    });

    $('.panel-collapse').on('show.bs.collapse', function() {
        $(this).parent('.accordion-block').addClass('active');
    });

    $('.panel-collapse').on('hide.bs.collapse', function() {
        $(this).parent('.accordion-block').removeClass('active');
    });
    /**
     * ------------------------------------------------------------------
     * Datepicker
     * ------------------------------------------------------------------
     */
    $('.js-date-picker').datepicker({
        autoclose: true,
        endDate: new Date(),
        maxDate: new Date(),
        startDate: new Date(2000, 1, 1),
        minDate: new Date(2000, 1, 1),
        format: 'dd-mm-yyyy'
    });


    /**
     * --------------------------------------------------------------------------------------
     * Dynamic Input
     * --------------------------------------------------------------------------------------
     */

    //Add Input Fields
    var wrapper = $(".dynamic-input-list");
    var add_button = $(".btn-add-dynamic");
    $(add_button).click(function(e) {
        e.preventDefault();
        //add input field
        $(wrapper).append('<div class="dynamic-input-item"> <div class="row"> <div class="col-12 col-md-12 col-lg-6"> <div class="form-group form-input-field"> <label class="input-field__label">Subject *</label> <div class="position-relative"> <input type="text" class="form-control input-field__block"> </div></div></div><div class="col-12 col-md-12 col-lg-6"> <div class="form-group form-input-field"> <label class="input-field__label">Attachment</label> <div class="input-group"> <input type="text" class="form-control input-field__block input-file-name"  value=""> <div class="input-group-append"><!-- <button type="button" class="btn btn-file-upload"> Browse</button> --> <label class="btn btn-file-upload mb-0 form-input-file"> Browse <input type="file" hidden class="form-control-file "/> </label> <button class="btn btn-remove-dynamic"> <i class="lni lni-trash"></i> </button> </div></div></div><div class="upload-info-small"> <div class="info-icon"> <i class="fas fa-exclamation"></i> </div>File must be less than 10MB. Allowed file types : jpeg, jpg, gif, pdf, png, tif, zip. </div></div></div></div>');

    });
    //when user click on remove button
    $(wrapper).on("click", ".btn-remove-dynamic", function(e) {
        e.preventDefault();
        $(this).closest('.dynamic-input-item').remove();
    });

    /**
     * --------------------------------------------------------------------------------------
     * Upload File
     * --------------------------------------------------------------------------------------
     */
    $('.btn-file-upload').each(function() {
        $(this).change(function() {
            let fileName;
            fileName = $('.form-control-file').val().replace(/C:\\fakepath\\/i, '');
            alert(fileName);
            $(this).closest('.input-group').find('input').val(fileName);
        });
    });



});



function slickProgressIndicators() {
    if ($(window).width() > 320) {
        //ticking machine
        var percentTime;
        var tick;
        var time = 1;
        var progressBarIndex = 0;

        $('.progressBarContainer .progressBar').each(function(index) {
            var progress = "<div class='inProgress inProgress" + index + "'></div>";
            $(this).html(progress);
        });

        function startProgressbar() {
            resetProgressbar();
            percentTime = 0;
            tick = setInterval(interval, 10);
        }

        function interval() {
            if (($('.slider .slick-track div[data-slick-index="' + progressBarIndex + '"]').attr("aria-hidden")) === "true") {
                progressBarIndex = $('.slider .slick-track div[aria-hidden="false"]').data("slickIndex");
                startProgressbar();
            } else {
                percentTime += 1 / (time + 5);
                $('.inProgress' + progressBarIndex).css({
                    width: percentTime + "%"
                });
                if (percentTime >= 100) {
                    $('.single-item').slick('slickNext');
                    progressBarIndex++;
                    if (progressBarIndex > 2) {
                        progressBarIndex = 0;
                    }
                    startProgressbar();
                }
            }
        }

        function resetProgressbar() {
            $('.inProgress').css({
                width: 0 + '%'
            });
            clearInterval(tick);
        }
        startProgressbar();
        // End ticking machine

        $('.progressBarContainer div').click(function() {
            clearInterval(tick);
            var goToThisIndex = $(this).find("span").data("slickIndex");
            $('.single-item').slick('slickGoTo', goToThisIndex, false);
            startProgressbar();
        });
    } else {
        return 0;
    }
}
$(window).on('load resize', function() {
    slickProgressIndicators();
});

/**
 * ------------------------------------------------------------------
 * Perfect Scrollbar
 * ------------------------------------------------------------------
 */

$('.smooth-scroll-bar').perfectScrollbar({
    suppressScrollX: true
});

/**
 * ------------------------------------------------------------------
 * Price Range
 * ------------------------------------------------------------------
 */
var input0 = document.getElementById('minPriceField');
var input1 = document.getElementById('maxPriceField');
var priceRangeSlider = document.getElementById('js-price-slider');
var inputs = [input0, input1];

if (priceRangeSlider != null) {
    noUiSlider.create(priceRangeSlider, {
        connect: true,
        behaviour: 'tap',
        start: [500, 40000],
        range: {
            // Starting at 500, step the value by 500,
            // until 4000 is reached. From there, step by 1000.
            'min': [0],
            // '10%': [500, 500],
            // '50%': [4000, 1000],
            'max': [200000]
        }
    });
    priceRangeSlider.noUiSlider.on('update', function(values, handle) {
        inputs[handle].value = values[handle];
    });


}