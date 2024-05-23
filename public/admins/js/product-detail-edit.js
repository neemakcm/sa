$(document).ready(function() {
    $('#onlinestore').hide();


});

$('.add_button').click(function() {
    $('.field_wrapper').removeClass('hide');
    $('.add_button').addClass('hide');
});


$('body').on('click', '.add_more_vendor', function(e) {
    e.preventDefault();

    var parent = $(this).parents('.add_card_div');

    $(this).parents('.add_card_div').find('.vendor_clone').eq(0).clone().appendTo(parent);
    $(this).parents('.add_card_div').find('.vendor_clone:last input[type="text"]').val('');
    $(this).parents('.add_card_div').find('.vendor_clone:last select.vendor_change').val('');
    $(this).parents('.add_card_div').find('.vendor_clone:last .add_more_vendor').remove();
    $(this).parents('.add_card_div').find('.vendor_clone:last .delete_vendor_id_edit').addClass('delete_vendor_edit');


    $(this).parents('.add_card_div').find('.vendor_clone:last .delete_vendor_edit').removeClass('hide');
    $(this).parents('.add_card_div').find('.vendor_clone:last .delete_vendor_edit').removeAttr("href");
    $(this).parents('.add_card_div').find('.vendor_clone:last .delete_vendor_edit').attr('#');
});


$('body').on('click', '.delete_vendor_edit', function(e) {
    e.preventDefault();

    $(this).parents('.vendor_clone').remove();
});
$(function() {
    $('.is_flagship').click(function() {
        var flagship = $(this).val();
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
