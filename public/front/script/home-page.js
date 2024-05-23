function newLaunchesCat(e) { e = e;
    $.ajax({ type: "get", url: base_url + "/new-launches-products", data: { id: e }, success: function(e) {} }) }

function ValidateDrop(e) { var t = new RegExp("^[0-9-!@#$%*+, ?]"),
        a = String.fromCharCode(e.charCode ? e.which : e.charCode); if (!t.test(a)) return e.preventDefault(), !1 }

function mobileValidation(e) { if (/^([0|\+[0-9]{1,5})?([7-9][0-9]{9})$/.test(e)) return !0;
    document.getElementById("mobile").value = "", alert("invalid phone number") }
$(function() { $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } }), $("#category_id").on("click", function(e) { var t = $(this).val();
        $.ajax({ type: "POST", url: base_url + "/escalate-to-service/category-product", data: { id: t }, success: function(e) { var t = JSON.parse(e);
                t ? ($("#product_id").empty(), $("#product_id").focus, $("#product_id").append('<option value="">  Select  Product </option>'), $.each(t, function(e, t) { $('select[name="product_id"]').append('<option value="' + t.id + '">' + t.name + "</option>") })) : $("#product_id").empty() } }) }), $("#product_id").on("change", function(e) { var t = $(this).val();
        $.ajax({ type: "POST", url: base_url + "/escalate-to-service/product-model", data: { id: t }, success: function(e) { if ($("#model").empty(), e) { var t = JSON.parse(e).sku;
                    $("#model").val(t) } else $("#model").empty() } }) }), $("#upload-files").change(function() { $(this).prev("label").clone(); var e = $("#upload-files")[0].files[0].name;
        $(this).prev("label").text(e) }) });