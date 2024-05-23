function ValidateDrop(a) { var e = new RegExp("^[0-9-!@#$%*+, ?]"),
        t = String.fromCharCode(a.charCode ? a.which : a.charCode); if (!e.test(t)) return a.preventDefault(), !1 }

function mobileValidation(a) { if (/^([0|\+[0-9]{1,5})?([7-9][0-9]{9})$/.test(a)) return !0;
    document.getElementById("mobile").value = "", alert("invalid phone number") }
$(function() { $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } }), $("#warranty_category_id").on("change", function(a) { alert(1); var e = $(this).val();
        $.ajax({ type: "POST", url: base_url + "/warranty-extension/category-product", data: { id: e }, success: function(a) { var e = JSON.parse(a);
                e ? ($("#warranty_product_id").empty(), $("#warranty_product_id").focus, $("#warranty_product_id").append('<option value="">  Select  Product </option>'), $.each(e, function(a, e) { $('select[name="warranty_product_id"]').append('<option value="' + e.id + '">' + e.name + "</option>") })) : $("#warranty_product_id").empty() } }) }), $("#warranty_product_id").on("change", function(a) { var e = $(this).val();
        $.ajax({ type: "POST", url: base_url + "/warranty-extension/product-model", data: { id: e }, success: function(a) { if ($("#warranty_model").empty(), a) { var e = JSON.parse(a).sku;
                    $("#warranty_model").val(e) } else $("#warranty_model").empty() } }) }), $("#upload-files").change(function() { $(this).prev("label").clone(); var a = $("#upload-files")[0].files[0].name;
        $(this).prev("label").text(a) }) });