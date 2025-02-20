var selectvalGlobal;
window.onload = function() { readCookie("session_id", "covid_session_id") };
var setCookie = function(e, t) {
    var a = new Date,
        i = "expires=";
    a.setDate(a.getDate() + 30), i += a.toGMTString(), document.cookie = e + "=" + t + "; " + i + "; path=/"
};

function readCookie(e, t) {
    for (var a = e + "=", i = (t = t + "=", 0), o = 0, r = decodeURIComponent(document.cookie).split(";"), s = 0; s < r.length; s++) {
        for (var n = r[s];
            " " == n.charAt(0);) n = n.substring(1);
        if (0 == n.indexOf(a)) i = 1, "true" == n.substring(a.length, n.length) ? $("#cookie_div").hide() : $("#cookie_div").show();
        if (0 == n.indexOf(t)) o = 1, "true" == n.substring(t.length, n.length) ? $("#covid_div").hide() : $("#covid_div").show()
    }
    return 0 == i && $("#cookie_div").show(), 0 == o && $("#covid_div").show(), ""
}

function accept() { setCookie("session_id", "true"), $("#cookie_div").hide() }

function offerAccept() { setCookie("offer_session_id", "true"), sessionStorage.setItem("offer_session_id", !0) }

function covidClose() { setCookie("covid_session_id", "true"), sessionStorage.setItem("covid_session_id", !0), $("#covid_div").hide() }

    function filter_check() {
        // alert(1);
        var e = {};
        $(".filter_change:checked").each(function() {
            var t = $(this).attr("name"),
                a = this.value;
            e[t] ? e[t] = e[t] + "," + a : e[t] = a
        });
        var t = base_url + "/products/" + $("#category_id").val(),
            a = 0;
        $.each(e, function(e, i) { t += 0 == a ? "?" : "&", t += e + "=" + i, a++ }), 0 == a ? $("#filtered_min_price").val() != $("#min_price").val() && $("#filtered_max_price").val() != $("#max_price").val() && (a++, t += "?min=" + $("#filtered_min_price").val() + "&max=" + $("#filtered_max_price").val()) : $("#filtered_min_price").val() != $("#min_price").val() && $("#filtered_max_price").val() != $("#max_price").val() && (a++, t += "&min=" + $("#filtered_min_price").val() + "&max=" + $("#filtered_max_price").val()),t += a > 0 ? "&Sort=" + selectvalGlobal : "?Sort="+selectvalGlobal,

        // console.log( $(".sort_change").find(":selected").val());
        // console.log(t);
        // console.log(t+"&Sort="+selectvalGlobal);
        window.location.href = t
    }
    if ($(".filter_change").click(function() { 
        filter_check() 
    }), 
    $(".sort_change").change(function() {
        selectvalGlobal =$(this).val();
        filter_check() 
        }), $("#minPriceField").length > 0) {
        var t = document.getElementById("minPriceField"),
            a = document.getElementById("maxPriceField"),
            o = ($("#min_price").val(), $("#max_price").val());
        $("#js-price-slider")[0].noUiSlider.destroy();
        var r = document.getElementById("js-price-slider"),
            s = [t, a];
        noUiSlider.create(r, { connect: !0, behaviour: "tap", start: [$("#filtered_min_price").val(), $("#filtered_max_price").val()], range: { min: [0], max: [10 * o] } }), r.noUiSlider.on("update", function(e, t) { s[t].value = e[t] }), r.noUiSlider.on("change.one", function(t, a) { $("#filtered_min_price").val(t[0]), $("#filtered_max_price").val(t[1]), filter_check() })
    }
    
$(document).ready(function() {


    var check=0;
    $(".type_filters").click(function () {
        var e = {};
        check=1;
        t = $(this).attr("name"),
        a = this.value;
        e[t] ? e[t] = e[t] + "," + a : e[t] = a
        var l = base_url + "/products/" + $("#category_id").val(),
        a = 0;
        $.each(e, function (e, i) {
            l += 0 == a ? "?" : "&", l += e + "=" + i
        })
        location.href = l;
        // l += a > 0 ? "&Sort=" + $(".sort_change").find(":selected").val() : "?Sort=" + $(".sort_change").find(":selected").val(), location.href = l

      
    })
    $(".filter_changes").click(function () {
        // alert(1);
        var e = {};
            $(".filter_change:checked").each(function () {
                t = $(this).attr("name"),
                    a = this.value;
                e[t] ? e[t] = e[t] + "," + a : e[t] = a
            });
            var t = base_url + "/products/" + $("#category_id").val(),
                a = 0;
            $.each(e, function (e, i) {
                t += 0 == a ? "?" : "&", t += e + "=" + i, a++
            }), t += a > 0 ? "&Sort=" + $(".sort_change").find(":selected").val() : "?Sort=" + $(".sort_change").find(":selected").val(), location.href = t
    })




    
    $(".varient_select").click(function() {
        var e = $(this).attr("data-sku"),
            t = $(this).attr("data-product_id");
        $(this).parents(".pd-size-slider").siblings(".button-content").children(".product_link").attr("href", base_url + "/products/detail/" + e), $(this).parents(".pd-size-slider").siblings(".button-content").children(".add_compare").attr("data-product_id", t);
        var a = $(this);
        $.ajax({
            type: "GET",
            url: base_url + "/products/getProductBasics/" + e,
            processData: !1,
            contentType: !1,
            success: function(e) {
                var t = (e = $.parseJSON(e)).price - e.offer_price;
                a.parents(".ps-product").find(".ps-product__thumbnail img").attr("src", storage_url + "/resized/medium/" + e.thumbnail), a.parents(".ps-product").find(".ps-product__thumbnail .product_image_link").attr("href", base_url + "/products/detail/" + e.slug), a.parents(".ps-product").find(".ps-product__content .product_title").html('<a href="' + base_url + "/products/detail/" + e.slug + '" class="button-buy-now">' + e.name + "</a>"), a.parents(".ps-product").find(".ps-product__content .price .product_offer_price").html(e.offer_price), a.parents(".ps-product").find(".ps-product__content .product_title").html('<a href="' + base_url + "/products/detail/" + e.slug + '" class="button-buy-now">' + e.name + "</a>"), a.parents(".ps-product").find(".ps-product__content .ps-product__price-prev .product_price").html(" " + e.price), a.parents(".ps-product").find(".ps-product__content .ps-product__price-prev .product_discount").html(t), t > 0 ? a.parents(".ps-product").find(".product_discount_wrapper").removeClass("hide") : a.parents(".ps-product").find(".product_discount_wrapper").addClass("hide")
            }
        })
    }), $("#modalPreload").length > 0 && (sessionStorage.getItem("offer_session_id") || setTimeout(function() { $("#modalPreload").modal("show") }, 5e3));
    $("#modalOfferModal").length > 0 && (sessionStorage.getItem("offer_session_id") || setTimeout(function() { $("#modalOfferModal").modal("show") }, 5e3));
    if ($(".clipboard").on("click", function() {
            var e = $("<input>"),
                t = $(location).attr("href");
            $("body").append(e), e.val(t).select(), document.execCommand("copy"), e.remove(), document.getElementById("myTooltip").innerHTML = "Copied to clipboard"
        }), $("body").on("click", ".store_wrapper", function() {
            var e = $(this).attr("data-img");
            $("#location_tag").attr("src", storage_url + "/" + e)
        }), $("#state").change(function() {
            var e = $(this).val();
            "all" == e ? $("#district").html('<option value="all">All</option>') : $.ajax({
                type: "GET",
                url: base_url + "/stores/getStateDistricts/" + e,
                success: function(e) {
                    e = $.parseJSON(e), $("#district").html('<option value="all">All</option>');
                    var t = "";
                    $.each(e, function(e, a) { t += '<option value="' + a.district + '">' + a.district + "</option>" }), $("#district").append(t)
                }
            })
        }), $("#store_locator").click(function() {
            var e = $("#state option:selected").val(),
                t = $("#district option:selected").val();
            "all" == e ? $(".store_wrapper").removeClass("hide") : "all" == t ? ($(".store_wrapper").removeClass("hide"), $(".store_wrapper").not('[data-state="' + e + '"]').addClass("hide")) : ($(".store_wrapper").removeClass("hide"), $(".store_wrapper").not('[data-district="' + t + '"]').addClass("hide"));
            var a = $(".store_wrapper").not(".hide").first().attr("data-img");
            $("#location_tag").attr("src", storage_url + "/" + a)
        }), $("#model_number").keyup(function() {
            $(this).val().length > 3 ? $.ajax({
                type: "POST",
                url: base_url + "/products/getModelNumber",
                data: { keyword: $(this).val(), _token: $('input[name="_token"]').val() },
                success: function(e) {
                    $("#model-suggestion-box").show(), result = $.parseJSON(e);
                    var t = "";
                    $.each(result, function(e, a) { t += '<div class="model_selected" data-value="' + a.sku + '" data-name="' + a.name + '" data-img="' + a.thumbnail + '">' + a.sku + "</div>" }), $("#model-suggestion-box").html(t)
                }
            }) : ($("#model-suggestion-box").html(""), $("#model-suggestion-box").hide(), $(".model_image").attr("src", base_url + "/public/front/images/icons/product-preview.png"), $(".img-box").css("opacity", .2), $(".model_name").html("Enter Model Number or Select by Product Category*"))
        }), $("body").on("click", ".model_selected", function() {
            var e = $(this).attr("data-value"),
                t = $(this).attr("data-name"),
                a = $(this).attr("data-img");
            $("#model_number").val(e), $("#model-suggestion-box").html(""), $("#model-suggestion-box").hide(), $(".model_image").attr("src", storage_url + "/" + a), $(".img-box").css("opacity", 1), $(".model_name").html(t), $("#type").html('<option value="">Product Type</option>'), $("#model_id").html('<option value="">Model Number</option>'), $("#category_id").val("")
        }), $("#category_id").change(function() {
            var e = $(this).val();
            "" == e ? $("#type").html('<option value="">Product Type</option>') : $.ajax({
                type: "GET",
                url: base_url + "/products/getCategoryTypes/" + e,
                success: function(e) {
                    e = $.parseJSON(e), $("#type").html('<option value="">Product Type</option>');
                    var t = "";
                    $.each(e, function(e, a) { t += '<option value="' + a.id + '">' + a.name + "</option>" }), $("#type").append(t)
                }
            })
        }), $("#type").change(function() {
            var e = $(this).val();
            "" == e ? $("#model_id").html('<option value="">Model Number</option>') : $.ajax({
                type: "GET",
                url: base_url + "/products/getCategoryModels/" + e,
                success: function(e) {
                    e = $.parseJSON(e), $("#model_id").html('<option value="">Model Number</option>');
                    var t = "";
                    $.each(e, function(e, a) { t += '<option value="' + a.id + '" data-name="' + a.name + '" data-img="' + a.thumbnail + '">' + a.sku + "</option>" }), $("#model_id").append(t)
                }
            })
        }), $("#model_id").change(function() {
            var e = $("#model_id").find(":selected").text(),
                t = $("#model_id").find(":selected").attr("data-name"),
                a = $("#model_id").find(":selected").attr("data-img");
            $("#model_number").val(e), $(".model_image").attr("src", storage_url + "/" + a), $(".img-box").css("opacity", 1), $(".model_name").html(t)
        }), $("#service_proof").change(function() { this.files[0].size > 1e7 ? ($("#service_proof_error").html("Maximum file size is 10MB"), this.value = "") : $("#service_proof_error").html("") }), $("#upload-files").change(function() { this.files[0].size > 1e7 ? ($("#service_proof_error").html("Maximum file size is 10MB"), this.value = "") : $("#service_proof_error").html("") }), $(".track_service").click(function() {
            if ("" == $("#case_number").val()) $("#case_number").addClass("not_filled");
            else if ($("#case_number").removeClass("not_filled"), $("#track_confirm").is(":checked")) {
                $("#track_check_error").html("");
                var e = $("#case_number").val(),
                    t = $("#mobile").val(),
                    a = $("#email").val();
                $(".status_wrapper").removeClass("hide"), $.ajax({ type: "POST", url: base_url + "/service/trackService", data: { case_id: e, mobile: t, email: a, _token: $('input[name="_token"]').val() }, success: function(e) { 0 == (e = $.parseJSON(e)).status ? ($(".request_status").addClass("danger"), $(".status_div").html(e.message)) : ($(".request_status").removeClass("danger"), 0 == e.message.length ? $(".status_div").html("No updates. Please try again later") : $(".status_div").html(e.message[0].status)) } })
            } else $("#track_check_error").html("Accept the privacy terms before proceed")
        }), $(".product_compare_slider").length > 0) {
        $(".add-remove").slick("unslick");
        var n = '<div class="slide-prev"><img src="' + base_url + '/public/front/images/icons/left-arrow.png" class="img-fluid" alt="icon"></div>',
            l = '<div class="slide-next"><img src="' + base_url + '/public/front/images/icons/right-arrow.png" class="img-fluid" alt="icon"></div>';
        $(".add-remove").slick({ slidesToShow: 3, slidesToScroll: 3, infinite: !1, prevArrow: n, nextArrow: l, responsive: [{ breakpoint: 480, settings: { slidesToShow: 1, slidesToScroll: 1, } }, { breakpoint: 767, settings: { slidesToShow: 2, slidesToScroll: 2, } }, ] }), $(".js-add-slide").on("click", function() { 0, $(".add-remove").slick("slickAdd", '<div class="item"><div class="product-content"><div class="product-image"> <img class="img-fluid ps-product__image " src="assets/images/products/list/compare-01.png" alt="product"></div><div class="product-desc"><h4>1m 08cm (43") T5500 Smart..</h4></div></div></div>') }), $(".js-add-slide").click(function() { $(this).addClass("active") }), $(".js-remove-slide").on("click", function() { $(".add-remove").slick("slickRemove", $(this)) })
    }

    function c() { $(".datepicker_month").datepicker({ autoclose: !0, endDate: new Date, maxDate: new Date, startDate: new Date(2e3, 1, 1), minDate: new Date(2e3, 1, 1), changeMonth: !0, changeYear: !0, showButtonPanel: !1, dateFormat: "mm/yyyy", format: "mm/yyyy", viewMode: "months", minViewMode: "months" }) }

    function d() { "" != $(".search_box").val() ? location.href = base_url + "/productSearch?search=" + $(".search_box").val() : location.href = location.protocol + "//" + location.host + location.pathname }

    function u() { "" != $(".mobile_search_box").val() ? location.href = base_url + "/productSearch?search=" + $(".mobile_search_box").val() : location.href = location.protocol + "//" + location.host + location.pathname }
    if ($(".add_compare").click(function() {
            $(this).addClass("active");
            var e = $(this).attr("data-product_id");
            $.ajax({
                type: "POST",
                url: base_url + "/products/addToCompare",
                data: { product_id: e, _token: $('input[name="_token"]').val() },
                success: function(e) {
                    // console.log(e);
                    if ((e = $.parseJSON(e)).length > 0) {
                        $(".product_compare_slider").removeClass("hide");
                        var t = "";
                        $(".add-remove").slick("unslick"), $.each(e, function(e, a) {
                            // console.log(a.category_id);
                            t += '<div class="item"><div class="product-content"><div class="product-image"> <img class="img-fluid ps-product__image " src="' + storage_url + "/resized/medium/" + a.thumbnail + '" alt="product"></div><div class="product-desc"><h4>' + a.name + "</h4></div></div></div>"
                        }), $(".add-remove").html(t);
                        var a = '<div class="slide-prev"><img src="' + base_url + '/public/front/images/icons/left-arrow.png" class="img-fluid" alt="icon"></div>',
                            i = '<div class="slide-next"><img src="' + base_url + '/public/front/images/icons/right-arrow.png" class="img-fluid" alt="icon"></div>'; +
                        $(".add-remove").slick({ slidesToShow: 3, slidesToScroll: 3, infinite: !1, prevArrow: a, nextArrow: i }), $(".compare_count").html("Compare (" + e.length + ")")
                    } else $(".product_compare_slider").addClass("hide")
                }
            })
        }), $(".compare_clear").click(function() { $(".product_compare_slider").addClass("hide"), $(".add_compare").removeClass("active"), $.ajax({ type: "POST", url: base_url + "/products/clearCompare", data: { _token: $('input[name="_token"]').val() }, success: function(e) {} }) }), $(".js-item-compare").owlCarousel({ loop: !1, margin: 0, autoplay: !1, dots: !1, autoplayHoverPause: !0, nav: !0, navText: ['<img src="' + base_url + '/public/front/images/icon/slider/arrow-left.png" class="img-fluid" alt="icon">', '<img src="' + base_url + '/public/front/images/icon/slider/arrow-right.png" class="img-fluid" alt="icon">'], responsive: { 0: { items: 1 }, 768: { items: 2 }, 992: { items: 3 } } }), $("body").on("click", ".center_wrapper", function() {
            var e = $(this).attr("data-img");
            $("#location_tag").attr("src", storage_url + "/" + e)
        }), $("#state").change(function() {
            var e = $(this).val();
            "all" == e ? $("#district").html('<option value="all">All</option>') : $.ajax({
                type: "GET",
                url: base_url + "/service/getStateDistricts/" + e,
                success: function(e) {
                    e = $.parseJSON(e), $("#district").html('<option value="all">All</option>');
                    var t = "";
                    $.each(e, function(e, a) { t += '<option value="' + a.district + '">' + a.district + "</option>" }), $("#district").append(t)
                }
            })
        }), $("#center_locator").click(function() {
            var e = $("#state option:selected").val(),
                t = $("#district option:selected").val();
            "all" == e ? $(".center_wrapper").removeClass("hide") : "all" == t ? ($(".center_wrapper").removeClass("hide"), $(".center_wrapper").not('[data-state="' + e + '"]').addClass("hide")) : ($(".center_wrapper").removeClass("hide"), $(".center_wrapper").not('[data-district="' + t + '"]').addClass("hide"));
            var a = $(".center_wrapper").not(".hide").first().attr("data-img");
            $("#location_tag").attr("src", storage_url + "/" + a)
        }), $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } }), $("#form_subscription").submit(function(e) {
            e.preventDefault();
            var t = $("#email").val();
            $.ajax({ type: "POST", url: base_url + "/subscribe", data: { email: t }, success: function(e) { $("#subscribe_message").html(e) } })
        }), $("#form_subscription_submit").submit(function(e) {
            e.preventDefault();
            var t = $("#sub_email").val();
            $.ajax({ type: "POST", url: base_url + "/subscribe", data: { email: t }, success: function(e) { $("#subscribed_message").html(e) } })
        }), $(".fancybox").fancybox({ autoPlay: !1 }), $(".media_pagination").click(function() {
            var e = $(this).attr("data-page");
            $.ajax({ type: "POST", url: base_url + "/mediaCenters/getPaginatedMedia", data: { page: e, _token: $('input[name="_token"]').val() }, success: function(t) { t = $.parseJSON(t), td = "", $.each(t.media, function(e, t) { td += '<li class="media-component__item"><a href=""><div class="visual-area"><div class="visual-area__image"><img src="' + storage_url + "/" + t.media + '" class="img-fluid" alt="media"></div><div class="visual-area__content"><div class="visual-area__publish">' + t.change_date + '</div><h4 class="visual-area__title">' + t.title + "</h4></div></div></a></li>" }), $(".media_center_wrapper").append(td), t.count > 0 ? $(".media_pagination").attr("data-page", parseInt(e) + 1) : $(".media_pagination_wrapper").addClass("hide") } })
        }), $("#upload-files").change(function() {
            $(this).prev("label").clone();
            var e = $("#upload-files")[0].files[0].name;
            $(this).prev("label").text(e)
        }), $("#job_search").change(function() {
            var e = $(this).val(),
                t = base_url + "/careers/search";
            t += "?Keyword=" + $('input[name="Keyword"]').val() + "&location=" + $('select[name="location"]').find(":selected").val() + "&sort=" + e, location.href = t
        }), c(), $("#add_education").click(function() { $(".educational_clone:eq(0)").clone().appendTo(".educational_wrapper"), $(".educational_clone").last().find("input").val(""), c(), $(".remove_education").removeClass("hide") }), $("#add_experience").click(function() { $(".experience_clone:eq(0)").clone().appendTo(".experience_wrapper"), $(".experience_clone").last().find("input").val(""), c(), $(".remove_experience").removeClass("hide") }), $("body").on("click", ".remove_education", function() { $(this).parents(".educational_clone").remove(), 1 == $(".educational_clone").length && $(".educational_clone").children().find(".remove_education").addClass("hide") }), $("body").on("click", ".remove_experience", function() { $(this).parents(".experience_clone").remove(), 1 == $(".experience_clone").length && $(".experience_clone").children().find(".remove_experience").addClass("hide") }), $(".upload_file").change(function() {
            var e = $(this)[0].files[0].name;
            e.length > 6 ? $(this).siblings(".upload_label").html(e.substring(0, 6) + "...") : $(this).siblings(".upload_label").html(e)
        }), $(".search_button").click(function() { $(".search_holder").toggleClass("hide") }), $(".search_box").keypress(function(e) { if (13 == e.keyCode) return d(), !1 }), $(".web_search_button_click").click(function(e) { d() }), $(".mobile_search_box").keypress(function(e) { if (13 == e.keyCode) return u(), !1 }), $(".mobile_search_button_click").click(function(e) { u() }), $("#parent_category").change(function() {
            var e = $(this).val();
            "" == e ? $("#sub_category").html('<option value="">Product Type</option>') : $.ajax({
                type: "GET",
                url: base_url + "/products/getFeedbackCategoryTypes/" + e,
                success: function(e) {
                    e = $.parseJSON(e), $("#sub_category").html('<option value="">Product Type</option>');
                    var t = "";
                    $.each(e, function(e, a) { 1 == a.is_last_child ? t += '<option value="' + a.id + '">' + a.name + "</option>" : $.each(a.children, function(e, a) { t += '<option value="' + a.id + '">' + a.name + "</option>" }) }), $("#sub_category").append(t)
                }
            })
        }), $("#sub_category").change(function() {
            var e = $(this).val();
            "" == e ? $("#product_id").html('<option value="">Select</option>') : $.ajax({
                type: "GET",
                url: base_url + "/products/getCategoryModels/" + e,
                success: function(e) {
                    e = $.parseJSON(e), $("#product_id").html('<option value="">Select</option>');
                    var t = "";
                    $.each(e, function(e, a) { t += '<option value="' + a.id + '">' + a.sku + "</option>" }), $("#product_id").append(t)
                }
            })
        }), $("#pills-newest-tab").click(function() {
            var e = $(".js-new-trends").find(".owl-item.active .item").attr("data-tab");
            $(".slider-dat").each(function() { $(this).attr("id") === e && $(this).addClass("current") })
        }), $("#pills-popular-tab").click(function() {
            setTimeout(function() {
                var e = $(".pop-js-new-trends").find(".owl-item.active .item").attr("data-tab");
                $(".pop-slider-dat").each(function() { $(this).attr("id") === e && $(this).addClass("current") })
            }, 1e3)
        }), $("#pills-offers-tab").click(function() {
            setTimeout(function() {
                var e = $(".off-js-new-trends").find(".owl-item.active .item").attr("data-tab");
                $(".off-slider-dat").each(function() { $(this).attr("id") === e && $(this).addClass("current") })
            }, 1e3)
        }), $("body").on("change", ".date_from", function() {
            var e = $(this).val();
            e = e.split("/"), $(this).parents(".left-el").siblings(".right-el").find(".date_to").datepicker("setStartDate", new Date(e[1], e[0], 1))
        }), $("body").on("change", ".exp_date_from", function() {
            var e = $(this).val();
            e = e.split("/"), $(this).parents(".left-el").siblings(".right-el").find(".exp_date_to").datepicker("setStartDate", new Date(e[1], e[0] - 1, 1))
        }), $("#stars li").on("mouseover", function() {
            var e = parseInt($(this).data("value"), 10);
            $(this).parent().children("li.star").each(function(t) { t < e ? $(this).addClass("hover") : $(this).removeClass("hover") })
        }).on("mouseout", function() { $(this).parent().children("li.star").each(function(e) { $(this).removeClass("hover") }) }), $("#stars li").on("click", function() {
            var e = parseInt($(this).data("value"), 10),
                t = $(this).parent().children("li.star");
            for (i = 0; i < t.length; i++) $(t[i]).removeClass("selected");
            for (i = 0; i < e; i++) $(t[i]).addClass("selected");
            var a = parseInt($("#stars li.selected").last().data("value"), 10);
            $("#rating").val(a)
        }), $(".js-Trending").length > 0) {
        new Swiper(".js-Trending", { navigation: { nextEl: "#trends-next", prevEl: "#trends-prev" }, centeredSlides: !0, autoplay: { delay: 2500, disableOnInteraction: !1 } });
        $('.trending-products-tab a[data-toggle="pill"]').on("shown.bs.tab", function(e) { new Swiper(".js-Trending", { navigation: { nextEl: "#trends-next", prevEl: "#trends-prev" }, centeredSlides: !0, autoplay: { delay: 2500, disableOnInteraction: !1 } }) })
    }
    if ($(".main-banner-slider").length > 0) {
        var p = $(".slider");

        function m(e, t) {
            var a = e.find(".slick-current"),
                i = e.find(".slick-current .image").attr("data-type");
            if (player = a.find("iframe").get(0), startTime = a.data("video-start"), "video" == i) switch (t) {
                case "play":
                    _(player, { event: "command", func: "mute" }), _(player, { event: "command", func: "playVideo" });
                    break;
                case "pause":
                    _(player, { event: "command", func: "pauseVideo" })
            }
        }

        function _(e, t) { null != e && null != t && e.contentWindow.postMessage(JSON.stringify(t), "*") }
        p.on("init", function(e) { e = $(e.currentTarget), setTimeout(function() { m(e, "play") }, 1e3), resizePlayer(iframes, 16 / 9) }), p.on("beforeChange", function(e, t) { m(t = $(t.$slider), "pause") }), p.on("afterChange", function(e, t) { m(t = $(t.$slider), "play") }), p.on("lazyLoaded", function(e, t, a, i) { lazyCounter++, lazyCounter === lazyImages.length && lazyImages.addClass("show") })
    }


    $('.manual-products-carousel').owlCarousel({
        loop: false,
        items: 5,
        margin: 0,
        autoplay: true,
        smartSpeed: 1500,
        dots: false,
        // autoPlay: true,
        // autoplayTimeout: 5000,
        autoplayHoverPause: true,
        nav: true,
        navText: [
            '<img src="' + base_url + '/public/front/images/icons/left-arrow.png" class="img-fluid" alt="icon">', '<img src="' + base_url + '/public/front/images/icons/right-arrow.png" class="img-fluid" alt="icon">'
        ],
        responsive: {
            0: {
                items: 2,
            },
            768: {
                items: 4,
            },
            992: {
                items: 5,
                margin: 40,
            },
        },

    });

    $('#videoPop').on('click', function(e) {
        e.preventDefault();
        $('#myModal').addClass('open');
    });
    $('.close').on('click', function(e) {
        e.preventDefault();
        close_video();
        var url = $('#pause').attr('src');
        $('#pause').attr('src', '');
        $('#pause').attr('src', url);
    });

    $(document).keyup(function(e) {
        if (e.keyCode === 27) { close_video(); }
    });

    function close_video() {
        $('.modal.open').removeClass('open').find('iframe');
    };
    $('.modal').click(function(event) {
        if (!$(event.target).closest('.modal-content').length) {
            $(".modal").removeClass('open');
        }
        var url = $('#pause').attr('src');
        $('#pause').attr('src', '');
        $('#pause').attr('src', url);
    });
    $('.js-filter-button').on('click', function() {
        $('.side-panel').addClass('active');
    });

    $('.js-filter-mob-close').on('click', function() {
        $('.side-panel').removeClass('active');
    });
    $(window).resize(function() {$('.main-banner-slider')[0].slick.refresh();});
});
