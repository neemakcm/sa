function ValidateDrop(e) { var a = new RegExp("^[0-9-!@#$%*+, ?]"),
        t = String.fromCharCode(e.charCode ? e.which : e.charCode); if (!a.test(t)) return e.preventDefault(), !1 }
$(function() { $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } }), $("#product_id").on("change", function(e) { var a = $(this).val();
        $.ajax({ type: "POST", url: base_url + "/escalate-to-service/product-model", data: { id: a }, success: function(e) { if ($("#model").empty(), e) { var a = JSON.parse(e).sku;
                    $("#model").val(a) } else $("#model").empty() } }) }), $("#upload-files").change(function() { $(this).prev("label").clone(); var e = $("#upload-files")[0].files[0].name;
        $(this).prev("label").text(e) }) });