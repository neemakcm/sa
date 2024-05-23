$(document).ready(function() {

    var rowIdx = 0;
    $('#add_new').on('click', function() {
        $('#tbody').append(`<tr id="R${++rowIdx}">
         <td style="padding:5px;">
                <input class="form-control " type="text"  name="ha_product[]" autocomplete="off" value="" >
            </td>
            <td style="padding:5px;">
                <input type="text" class=" form-control " name="ha_customer_place[]" autocomplete="off" value=""  />
            </td>
            <td style="padding:5px;">
                <input type="text" class=" form-control " name="ha_dealer_place[]" autocomplete="off" value=""  />
            </td>
            <td style="padding:5px;">
            <input type="text" class=" form-control  " name="ha_service_center[]"  value="" /></td>

          <td class="text-center">
            <button class="btn btn-danger remove" type="button"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></button>
            </td>
          </tr>`);
    });

    //   $(".datepicker").datepicker();
    // jQuery button click event to remove a row.
    $('#tbody').on('click', '.remove', function() {
                $(this).closest("tr").remove();

        // Getting all the rows next to the row
        // containing the clicked button
        // var child = $(this).closest('tr').nextAll();
        // // Iterating across all the rows
        // // obtained to change the index
        // child.each(function() {
        //     // Getting <tr> id.
        //     var id = $(this).attr('id');
        //     // Getting the <p> inside the .row-index class.
        //     var idx = $(this).children('.row-index').children('p');
        //     // Gets the row number from <tr> id.
        //     var dig = parseInt(id.substring(1));
        //     // Modifying row index.
        //     idx.html(`Row ${dig - 1}`);
        //     // Modifying row id.
        //     $(this).attr('id', `R${dig - 1}`);
        // });
        // // Removing the current row.
        // $(this).closest('tr').remove();
        // // Decreasing total number of rows by 1.
        // rowIdx--;

    });

    var rowIdxfirst = 0;
    $('#add_new_first').on('click', function() {
        $('#tbody1').append(`<tr id="R${++rowIdxfirst}">
         <td style="padding:5px;">
                <input class="form-control " type="text" name="ac_product[]" autocomplete="off" value="" >
            </td>
            <td style="padding:5px;">
                <input type="text" class=" form-control " name="ac_service[]" autocomplete="off" value=""  />
            </td>
            <td style="padding:5px;">
                <input type="text" class=" form-control " name="gas_charging[]" autocomplete="off" value=""  />
            </td>
            <td style="padding:5px;">
            <input type="text" class=" form-control  " name="installation[]"  value="" /></td>
          <td class="text-center">
            <button class="btn btn-danger remove"
              type="button"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></button>
            </td>
          </tr>`);
    });
    // 1674037105
    //   $(".datepicker").datepicker();
    // jQuery button click event to remove a row.
    $('#tbody1').on('click', '.remove', function() {
                $(this).closest("tr").remove();

        // // Getting all the rows next to the row
        // // containing the clicked button
        // var child = $(this).closest('tr').nextAll();
        // // Iterating across all the rows
        // // obtained to change the index
        // child.each(function() {
        //     // Getting <tr> id.
        //     var id = $(this).attr('id');
        //     // Getting the <p> inside the .row-index class.
        //     var idx = $(this).children('.row-index').children('p');
        //     // Gets the row number from <tr> id.
        //     var dig = parseInt(id.substring(1));
        //     // Modifying row index.
        //     idx.html(`Row ${dig - 1}`);
        //     // Modifying row id.
        //     $(this).attr('id', `R${dig - 1}`);
        // });

        // // Removing the current row.
        // $(this).closest('tr').remove();

        // // Decreasing total number of rows by 1.
        // rowIdxfirst--;

    });


    //entertainment/
    var rowIdEntertainment = 0;
    $('#add_new_entertainment').on('click', function() {
        // a
        $('#tbody_entertaimnet').append(`<tr id="R${++rowIdEntertainment}">
         <td style="padding:5px;">
                <input class="form-control " type="text"  name="entertaiment_product[]" autocomplete="off" value="" >
            </td>
            <td style="padding:5px;">
                <input type="text" class=" form-control " name="entertaiment_customer_place[]" autocomplete="off" value=""  />
            </td>
            <td style="padding:5px;">
                <input type="text" class=" form-control " name="entertaiment_dealer_place[]" autocomplete="off" value=""  />
            </td>
            <td style="padding:5px;">
            <input type="text" class=" form-control  " name="entertaiment_service_center[]"  value="" /></td>

          <td class="text-center">
            <button class="btn btn-danger remove" type="button"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></button>
            </td>
          </tr>`);
    });

    //   $(".datepicker").datepicker();
    // jQuery button click event to remove a row.
    $('#tbody_entertaimnet').on('click', '.remove', function() {
                $(this).closest("tr").remove();

        // // Getting all the rows next to the row
        // // containing the clicked button
        // var child = $(this).closest('tr').nextAll();
        // // Iterating across all the rows
        // // obtained to change the index
        // child.each(function() {
        //     // Getting <tr> id.
        //     var id = $(this).attr('id');
        //     // Getting the <p> inside the .row-index class.
        //     var idx = $(this).children('.row-index').children('p');
        //     // Gets the row number from <tr> id.
        //     var dig = parseInt(id.substring(1));
        //     // Modifying row index.
        //     idx.html(`Row ${dig - 1}`);
        //     // Modifying row id.
        //     $(this).attr('id', `R${dig - 1}`);
        // });
        // // Removing the current row.
        // $(this).closest('tr').remove();
        // // Decreasing total number of rows by 1.
        // rowIdEntertainment--;

    });
    // lighting
    //entertainment/
    var rowIdLighting = 0;
    $('#add_new_lighting').on('click', function() {
        $('#tbody_lighting').append(`<tr id="R${++rowIdLighting}">
         <td style="padding:5px;">
                <input class="form-control " type="text"  name="lighting_product[]" autocomplete="off" value="" >
            </td>
            <td style="padding:5px;">
                <input type="text" class=" form-control " name="lighting_customer_place[]" autocomplete="off" value=""  />
            </td>
            <td style="padding:5px;">
                <input type="text" class=" form-control " name="lighting_dealer_place[]" autocomplete="off" value=""  />
            </td>
            <td style="padding:5px;">
            <input type="text" class=" form-control  " name="lighting_service_center[]"  value="" /></td>

          <td class="text-center">
            <button class="btn btn-danger remove" type="button"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></button>
            </td>
          </tr>`);
    });

    $('#tbody_lighting').on('click', '.remove', function() {
                $(this).closest("tr").remove();

        // var child = $(this).closest('tr').nextAll();
        // child.each(function() {
        //     var id = $(this).attr('id');
        //     var idx = $(this).children('.row-index').children('p');
        //     var dig = parseInt(id.substring(1));
        //     idx.html(`Row ${dig - 1}`);
        //     $(this).attr('id', `R${dig - 1}`);
        // });
        // $(this).closest('tr').remove();
        // rowIdLighting--;

    });
    // personal care

    //entertainment/
    var rowIdpersonalCare = 0;
    $('#add_new_personal_care').on('click', function() {
        // a
        $('#tbody_personal_care').append(`<tr id="R${++rowIdpersonalCare}">
         <td style="padding:5px;">
                <input class="form-control " type="text" name="personal_care_product[]" autocomplete="off" value="" >
            </td>
            <td style="padding:5px;">
                <input type="text" class=" form-control " name="personal_care_customer_place[]" autocomplete="off" value=""  />
            </td>
            <td style="padding:5px;">
                <input type="text" class=" form-control " name="personal_care_dealer_place[]" autocomplete="off" value=""  />
            </td>
            <td style="padding:5px;">
            <input type="text" class=" form-control  " name="personal_care_service_center[]"  value="" /></td>

          <td class="text-center">
            <button class="btn btn-danger remove" type="button"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></button>
            </td>
          </tr>`);
    });

    $('#tbody_personal_care').on('click', '.remove', function() {
                $(this).closest("tr").remove();

        // var child = $(this).closest('tr').nextAll();
        // child.each(function() {
        //     var id = $(this).attr('id');
        //     var idx = $(this).children('.row-index').children('p');
        //     var dig = parseInt(id.substring(1));
        //     idx.html(`Row ${dig - 1}`);
        //     $(this).attr('id', `R${dig - 1}`);
        // });
        // $(this).closest('tr').remove();
        // rowIdpersonalCare--;
    });
//entertainment/
        var rowIdKitchenAppliances = 0;
        $('#add_new_kitchen_appliances').on('click', function() {
            // a
            $('#tbody_kitchen_appliances').append(`<tr id="R${++rowIdKitchenAppliances}">
            <td>
            <input type="text" class="form-control-small form-control " name="kitchen_appliances_product[]" value=""  />
        </td>
        <td>
            <input type="text" class=" form-control-small  form-control " name="kitchen_appliances_customer_place[]" value=""  />
        </td>
        <td>
            <input type="text" class=" form-control-small form-control " name="kitchen_appliances_dealer_place[]" value=""  />
        </td>
        <td>
            <input type="text" class="form-control-small  form-control " name="kitchen_appliances_service_center[]" value=""  />
        </td>
            
            <td class="text-center">
                <button class="btn btn-danger remove" type="button"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></button>
                </td>
            </tr>`);
        });
        $('#tbody_kitchen_appliances').on('click', '.remove', function() {
            $(this).closest("tr").remove();
        });
        var rowIdOtherBrands= 0;
        $('#add_new_other_brand').on('click', function() {
            // a
            $('#tbody_other_brand').append(`<tr id="R${++rowIdOtherBrands}">
            <td>
                <input type="text" class="form-control-small form-control " name="other_brand_product[]" value=""  />
            </td>
            <td>
                <input type="text" class=" form-control-small  form-control " name="other_brand_customer_place[]" value=""  />
            </td>
            <td>
                <input type="text" class=" form-control-small form-control " name="other_brand_dealer_place[]" value=""  />
            </td>
            <td>
                <input type="text" class="form-control-small  form-control " name="other_brand_service_center[]" value=""  />
            </td>
            
            <td class="text-center">
                <button class="btn btn-danger remove" type="button"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></button>
                </td>
            </tr>`);
        });
        $('#tbody_other_brand').on('click', '.remove', function() {
            $(this).closest("tr").remove();
        });
        var rowIdInspectionCharge= 0;
        $('#add_new_inspection_charge').on('click', function() {
            // a
            $('#tbody_inspection_charge').append(`<tr id="R${++rowIdInspectionCharge}">
            <td>
            <input type="text" class="form-control-small form-control " name="inspection_charge_product[]" value=""  />
        </td>
        <td>
            <input type="text" class=" form-control-small  form-control " name="inspection_charge_customer_place[]" value=""  />
        </td>
        <td>
            <input type="text" class=" form-control-small form-control " name="inspection_charge_dealer_place[]" value=""  />
        </td>
        <td>
            <input type="text" class="form-control-small  form-control " name="inspection_charge_service_center[]" value=""  />
        </td>
            <td class="text-center">
                <button class="btn btn-danger remove" type="button"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></button>
                </td>
            </tr>`);
        });
        $('#tbody_inspection_charge').on('click', '.remove', function() {
            $(this).closest("tr").remove();
        });


});
