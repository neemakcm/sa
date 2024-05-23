$(document).ready(function() {
    // $('.online-shops').hide();

    $('#buyOnline').click(function(e) {
        $('.online-shops').toggle("slide");
        e.stopPropagation();
    });
    $(document).click(function(e) {
        if (!$(e.target).is('.online-shops, .online-shops *')) {
            $(".online-shops").hide();
        }
    });
    setTimeout(function() {
        document.getElementById('slider-left').style.visibility = 'visible';
    }, 2000);

});


$('.add_button').click(function() {
    $('.field_wrapper').removeClass('hide');
    $('.add_button').addClass('hide');
});

$('body').on('click', '.add_more_vendor', function(e) {
    e.preventDefault();
    var vendor_list = [];
    $('.vendor_change').each(function(index, value) {
        vendor_list.push($(value).children("option:selected").val());
    });
    $('.vendor_clone').eq(0).clone().appendTo('.add_vendor_div');
    $('.vendor_clone:last input[type="text"]').val('');
    $('.vendor_clone:last select.vendor_change').removeAttr('readonly');
    $('.vendor_clone:last .remove_more_vendor').removeClass('hide');
    $('.vendor_clone:last .add_more_vendor').remove();
    var vendor = $('.vendor_clone:last').find('select.vendor_change option').eq(0).val();
    var vendor_options = $('.vendor_clone:last').find('select.vendor_change option');
    $.each(vendor_options, function(index, value) {
        $(value).removeClass('hide');
        if ($.inArray($(value).val(), vendor_list) > -1)
            $(value).attr('disabled', 'disabled');
        else
            $(value).removeAttr('disabled');
        if ($(value).val() == '')
            $(value).attr('selected', 'selected');
        else
            $(value).removeAttr('selected');
    });
    var voucher_options = $('.vendor_clone:last .card_clone').find('select.vendor_voucher option');
    $.each(voucher_options, function(index, value) {
        if ($(value).val() == '')
            $(value).attr('selected', 'selected');
        else
            $(value).removeAttr('selected');
    });
});
$('body').on('click', '.remove_more_vendor', function(e) {
    e.preventDefault();
    $(this).parents('.vendor_clone').remove();
});
$(function() {
    $('.is_flagship').click(function() {
        var flagship = $(this).val();
        console.log(flagship);
        if (flagship == 1) {
            $('.flagship_type').removeClass('hide');
            $('.flagship_type').children('textarea').removeAttr('required');
        } else {
            $('.flagship_type').addClass('hide');
        }
    });

});
function priceCalculation()
{
    var max_price =parseFloat($("#max_price").val());
    var offer_price =parseFloat($("#offer_price").val());
    if ( !isNaN( max_price )  && !isNaN( offer_price)  )
    {
        if ( offer_price >= max_price )//if greater than or equal to then show error alert
        {
            alert( "Offer price from should be less than price" );
            $("#offer_price").val("");
            return false;
        }
    }
}
