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
