$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#product_id').on('change', function(e) {
        var id = $(this).val();
        $.ajax({
            type: 'POST',
            url: base_url + "/admin/homePage/sub-category",
            data: { id: id },
            success: function(res) {
                data = $.parseJSON(res);
                if (data) {
                    // $('#sub_category').empty();
                    $('select[name="sub_category[]"]').empty();
                    // $('.sub_category_clone').remove();
                    // $('.sub_category_clone').append();
                    var sub_cat = "";
                    $('#sub_category').focus;
                    $('select[name="sub_category[]"]').append('<option value="" selected="selected" disabled>  Select Sub Category </option>');
                    var children = data;

                    $.each(children, function(key, value) {
                        sub_cat = value.children;
                        if (sub_cat.length > 0) {
                            $.each(sub_cat, function(key, value1) {
                                $('select[name="sub_category[]"]').append('<option value="' + value1.id + '">' + value1.name + '</option>');
                            })
                        } else {
                            $('select[name="sub_category[]"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                        }
                    });

                } else {
                    $('#sub_category').empty();
                }
            }
        });
    });


});
$('body').on('click', '.add_more_sub_category', function(e) {
    e.preventDefault();

    var sub_category_list = [];
    $('.sub_category_change').each(function(index, value) {
        sub_category_list.push($(value).children("option:selected").val());
    });
    $('.sub_category_clone').eq(0).clone().appendTo('.add_sub_category_div');
    $('.sub_category_clone:last input[type="url"]').val('');
    $('.sub_category_clone:last input[type="text"]').val('');
    $('.sub_category_clone:last input[type="number"]').val('');
    $('.sub_category_clone:last select.sub_category_change').removeAttr('readonly');
    $('.sub_category_clone:last .remove_more_sub_category').removeClass('hide');
    $('.sub_category_clone:last .add_more_sub_category').remove();
    var vendor = $('.sub_category_clone:last').find('select.sub_category_change option').eq(0).val();
    var sub_category_options = $('.sub_category_clone:last').find('select.sub_category_change option');
    $.each(sub_category_options, function(index, value) {
        $(value).removeClass('hide');
        if ($.inArray($(value).val(), sub_category_list) > -1)
            $(value).attr('disabled', 'disabled');
        else
            $(value).removeAttr('disabled');
        if ($(value).val() == '')
            $(value).attr('selected', 'selected');
        else
            $(value).removeAttr('selected');
    });

});
$('body').on('click', '.remove_more_sub_category', function(e) {
    e.preventDefault();
    $(this).parents('.sub_category_clone').remove();
});
$('body').on('focus', ".colorpicker", function() {
    $('.colorpicker').colorpicker();
});