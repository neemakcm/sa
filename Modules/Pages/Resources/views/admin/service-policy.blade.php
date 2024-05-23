@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <div class="breadcrumb">
                    <h1 class="mr-2">Edit Page</h1>

                </div>

                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" action="{{URL('admin/pages/update')}}" enctype='multipart/form-data'>
                                    @csrf
                                    <input type="hidden" name="id" value="{{$page->id}}">
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Title</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter your title" name="title" required value="{{$page->title}}">
                                        </div>

                                        {{-- <div class="col-md-6 form-group mb-3">
                                            <label id="image_label">Image</label>

                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="image_upload" type="file" name="image" accept=".jpeg,.jpg,.png,.gif">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>
                                            <img id="imagePreview" width="70">
                                            @if($page->image != null)
                                                <img src="{{storage_url()}}/{{$page->image}}" width="100">
                                            @endif
                                        </div> --}}

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Status</label>
                                            <select class="form-control" name="status" required>
                                                <option value="1" <?php echo $page->status == 1?'selected':''; ?>>Active</option>
                                                <option value="0" <?php echo $page->status == 0?'selected':''; ?>>Inactive</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Description</label>
                                            <textarea class="form-control" name="service_description">{{$page->description}}</textarea>
                                        </div>
                                        <div class="col-md-12 form-group mb-3">
                                            <div class="d-flex flex-wrap align-items-center mb-4">
                                            <label >Home Appilances</label>
                                                <a id="add_new" class="btn add-input-fields btn-light ml-3 ">
                                                    Add New
                                                </a>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-borderless"  cellpadding="0" cellspacing="0" >
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Work at Customer Place(SAR) </th>
                                                            <th>Work at Dealer Place (SAR)</th>
                                                            <th>Work at Service Center (SAR)</th>
                                                            <th></th>
                                                        </tr>
                                                    <thead>
                                                        @if($page->home_appilance_table)
                                                        <?php
                                                            $home_appilance_tables = json_decode($page->home_appilance_table, true);
                                                        ?>
                                                    <tbody id="tbody">
                                                        @foreach($home_appilance_tables as $key=>$hatable)
                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control-small form-control " name="ha_product[]" value="{{$hatable['product']}}"  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small  form-control " name="ha_customer_place[]" value="{{$hatable['customer_place']}}"  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small form-control " name="ha_dealer_place[]" value="{{$hatable['dealer_place']}}"  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control-small  form-control " name="ha_service_center[]" value="{{$hatable['service_center']}}"  />
                                                            </td>
                                                            @if($key > 0)
                                                            <td class="text-center">
                                                                <button class="btn btn-danger remove"
                                                                type="button"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></button>
                                                            </td>
                                                            @else
                                                            <td></td>
                                                            @endif
                                                            @endforeach
                                                        </tr>
                                                    </tbody>
                                                    @else
                                                    <tbody id="tbody">

                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control-small form-control " name="ha_product[]" value=""  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small  form-control " name="ha_customer_place[]" value=""  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small form-control " name="ha_dealer_place[]" value=""  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control-small  form-control " name="ha_service_center[]" value=""  />
                                                            </td>

                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                    @endif
                                                </table>
                                            </div>
                                        </div>

                                        <div class="col-md-12 form-group mb-3">
                                            <div class="d-flex flex-wrap align-items-center mb-4">
                                            <label >Air Conditioners</label>
                                            <a id="add_new_first" class="btn add-input-fields btn-light ml-3 ">
                                                    Add New
                                                </a>
                                            </div>
                                            @if($page->ac_table)
                                            <?php
                                                $ac_tables = json_decode($page->ac_table, true);

                                        ?>
                                            <div class="table-responsive">
                                                <table class="table table-borderless"  cellpadding="0" cellspacing="0" >
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Service (SAR)</th>
                                                            <th>Gas Charging (SAR)</th>
                                                            <th>installation (SAR)</th>
                                                            <th></th>
                                                        </tr>
                                                    <thead>
                                                    <tbody id="tbody1">
                                                                                                                                                     @foreach($ac_tables as $keys=>$actable)

                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control-small form-control " name="ac_product[]" value="{{$actable['product']}}"  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small  form-control " name="ac_service[]" value="{{$actable['ac_service']}}"  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small form-control " name="gas_charging[]" value="{{$actable['gas_charging']}}"  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control-small  form-control " name="installation[]" value="{{$actable['installation']}}"  />
                                                            </td>
                                                            @if($keys > 0)
                                                            <td class="text-center">
                                                                <button class="btn btn-danger remove"
                                                                type="button"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></button>
                                                            </td>
                                                            @else
                                                            <td></td>
                                                            @endif
                                                        </tr>
                                                          @endforeach
                                                    </tbody>

                                                </table>
                                            </div>
                                            @else
                                            <div class="table-responsive">
                                                <table class="table table-borderless"  cellpadding="0" cellspacing="0" >
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Service (SAR)</th>
                                                            <th>Gas Charging (SAR)</th>
                                                            <th>installation (SAR)</th>
                                                            <th></th>
                                                        </tr>
                                                    <thead>
                                                   <tbody id="tbody1">
                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control-small form-control " name="ac_product[]" value=""  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small  form-control " name="ac_service[]" value=""  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small form-control " name="gas_charging[]" value=""  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control-small  form-control " name="installation[]" value=""  />
                                                            </td>

                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-md-12 form-group mb-3">
                                            <div class="d-flex flex-wrap align-items-center mb-4">
                                            <label >Entertainment</label>
                                                <a id="add_new_entertainment" class="btn add-input-fields btn-light ml-3 ">
                                                    Add New
                                                </a>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-borderless"  cellpadding="0" cellspacing="0" >
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Work at Customer Place (SAR) </th>
                                                            <th>Work at Dealer Place (SAR)</th>
                                                            <th>Work at Service Center (SAR)</th>
                                                            <th></th>
                                                        </tr>
                                                    <thead>
                                                        @if($page->entertainment_table)
                                                        <?php
                                                            $entertainment_tables = json_decode($page->entertainment_table, true);
                                                        ?>
                                                    <tbody id="tbody_entertaimnet">
                                                        @foreach($entertainment_tables as $ekey=>$entertainmenttable)
                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control-small form-control " name="entertaiment_product[]" value="{{$entertainmenttable['product']}}"  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small  form-control " name="entertaiment_customer_place[]" value="{{$entertainmenttable['customer_place']}}"  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small form-control " name="entertaiment_dealer_place[]" value="{{$entertainmenttable['dealer_place']}}"  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control-small  form-control " name="entertaiment_service_center[]" value="{{$entertainmenttable['service_center']}}"  />
                                                            </td>
                                                            @if($ekey > 0)
                                                            <td class="text-center">
                                                                <button class="btn btn-danger remove"
                                                                type="button"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></button>
                                                            </td>
                                                            @else
                                                            <td></td>
                                                            @endif
                                                            @endforeach
                                                        </tr>
                                                    </tbody>
                                                    @else
                                                    <tbody id="tbody_entertaimnet">

                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control-small form-control " name="entertaiment_product[]" value=""  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small  form-control " name="entertaiment_customer_place[]" value=""  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small form-control " name="entertaiment_dealer_place[]" value=""  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control-small  form-control " name="entertaiment_service_center[]" value=""  />
                                                            </td>

                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                    @endif
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group mb-3">
                                            <div class="d-flex flex-wrap align-items-center mb-4">
                                            <label >Lighting</label>
                                                <a id="add_new_lighting" class="btn add-input-fields btn-light ml-3 ">
                                                    Add New
                                                </a>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-borderless"  cellpadding="0" cellspacing="0" >
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Work at Customer Place (SAR)</th>
                                                            <th>Work at Dealer Place (SAR)</th>
                                                            <th>Work at Service Center (SAR)</th>
                                                            <th></th>
                                                        </tr>
                                                    <thead>
                                                        @if($page->lighting_table)
                                                        <?php
                                                            $lighting_tables = json_decode($page->lighting_table, true);
                                                        ?>
                                                    <tbody id="tbody_lighting">
                                                        @foreach($lighting_tables as $lkey=>$lighting_table)
                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control-small form-control " name="lighting_product[]" value="{{$lighting_table['product']}}"  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small  form-control " name="lighting_customer_place[]" value="{{$lighting_table['customer_place']}}"  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small form-control " name="lighting_dealer_place[]" value="{{$lighting_table['dealer_place']}}"  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control-small  form-control " name="lighting_service_center[]" value="{{$lighting_table['service_center']}}"  />
                                                            </td>
                                                            @if($lkey > 0)
                                                            <td class="text-center">
                                                                <button class="btn btn-danger remove"
                                                                type="button"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></button>
                                                            </td>
                                                            @else
                                                            <td></td>
                                                            @endif
                                                            @endforeach
                                                        </tr>
                                                    </tbody>
                                                    @else
                                                    <tbody id="tbody_lighting">

                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control-small form-control " name="lighting_product[]" value=""  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small  form-control " name="lighting_customer_place[]" value=""  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small form-control " name="lighting_dealer_place[]" value=""  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control-small  form-control " name="lighting_service_center[]" value=""  />
                                                            </td>

                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                    @endif
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group mb-3">
                                            <div class="d-flex flex-wrap align-items-center mb-4">
                                            <label >Personal Care</label>
                                                <a id="add_new_personal_care" class="btn add-input-fields btn-light ml-3 ">
                                                    Add New
                                                </a>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-borderless"  cellpadding="0" cellspacing="0" >
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Work at Customer Place (SAR)</th>
                                                            <th>Work at Dealer Place (SAR)</th>
                                                            <th>Work at Service Center (SAR)</th>
                                                            <th></th>
                                                        </tr>
                                                    <thead>
                                                        @if($page->personal_care_table)
                                                        <?php
                                                            $personal_care_tables = json_decode($page->personal_care_table, true);
                                                        ?>
                                                    <tbody id="tbody_personal_care">
                                                        @foreach($personal_care_tables as $pkey=>$personal_care_table)
                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control-small form-control " name="personal_care_product[]" value="{{$personal_care_table['product']}}"  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small  form-control " name="personal_care_customer_place[]" value="{{$personal_care_table['customer_place']}}"  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small form-control " name="personal_care_dealer_place[]" value="{{$personal_care_table['dealer_place']}}"  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control-small  form-control " name="personal_care_service_center[]" value="{{$personal_care_table['service_center']}}"  />
                                                            </td>
                                                            @if($pkey > 0)
                                                            <td class="text-center">
                                                                <button class="btn btn-danger remove"
                                                                type="button"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></button>
                                                            </td>
                                                            @else
                                                            <td></td>
                                                            @endif
                                                            @endforeach
                                                        </tr>
                                                    </tbody>
                                                    @else
                                                    <tbody id="tbody_personal_care">

                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control-small form-control " name="personal_care_product[]" value=""  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small  form-control " name="personal_care_customer_place[]" value=""  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small form-control " name="personal_care_dealer_place[]" value=""  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control-small  form-control " name="personal_care_service_center[]" value=""  />
                                                            </td>

                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                    @endif
                                                </table>
                                            </div>
                                        </div>

                                        <div class="col-md-12 form-group mb-3">
                                            <div class="d-flex flex-wrap align-items-center mb-4">
                                            <label >Kitchen Appliances</label>
                                                <a id="add_new_kitchen_appliances" class="btn add-input-fields btn-light ml-3 ">
                                                    Add New
                                                </a>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-borderless"  cellpadding="0" cellspacing="0" >
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Work at Customer Place (SAR)</th>
                                                            <th>Work at Dealer Place (SAR)</th>
                                                            <th>Work at Service Center (SAR)</th>
                                                            <th></th>
                                                        </tr>
                                                    <thead>
                                                    @if($page->kitchen_appliances_table)
                                                    <?php
                                                        $kitchen_appliances_tables = json_decode($page->kitchen_appliances_table, true);
                                                    ?>
                                                    <tbody id="tbody_kitchen_appliances">
                                                        @foreach($kitchen_appliances_tables as $kakey=>$kitchen_appliances_table)
                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control-small form-control " name="kitchen_appliances_product[]" value="{{$kitchen_appliances_table['product']}}"  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small  form-control " name="kitchen_appliances_customer_place[]" value="{{$kitchen_appliances_table['customer_place']}}"  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small form-control " name="kitchen_appliances_dealer_place[]" value="{{$kitchen_appliances_table['dealer_place']}}"  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control-small  form-control " name="kitchen_appliances_service_center[]" value="{{$kitchen_appliances_table['service_center']}}"  />
                                                            </td>
                                                            @if($kakey > 0)
                                                            <td class="text-center">
                                                                <button class="btn btn-danger remove"
                                                                type="button"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></button>
                                                            </td>
                                                            @else
                                                            <td></td>
                                                            @endif
                                                            @endforeach
                                                        </tr>
                                                    </tbody>
                                                    @else
                                                    <tbody id="tbody_kitchen_appliances">
                                                       
                                                        <tr>
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
                                                           
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                    @endif
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group mb-3">
                                            <div class="d-flex flex-wrap align-items-center mb-4">
                                            <label >Other Brand</label>
                                                <a id="add_new_other_brand" class="btn add-input-fields btn-light ml-3 ">
                                                    Add New
                                                </a>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-borderless"  cellpadding="0" cellspacing="0" >
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Work at Customer Place (SAR)</th>
                                                            <th>Work at Dealer Place (SAR)</th>
                                                            <th>Work at Service Center (SAR)</th>
                                                            <th></th>
                                                        </tr>
                                                    <thead>
                                                        @if($page->other_brand_table)
                                                        <?php
                                                            $other_brand_tables = json_decode($page->other_brand_table, true);
                                                        ?>
                                                    <tbody id="tbody_other_brand">
                                                        @foreach($other_brand_tables as $obkey=>$other_brand_table)
                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control-small form-control " name="other_brand_product[]" value="{{$other_brand_table['product']}}"  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small  form-control " name="other_brand_customer_place[]" value="{{$other_brand_table['customer_place']}}"  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small form-control " name="other_brand_dealer_place[]" value="{{$other_brand_table['dealer_place']}}"  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control-small  form-control " name="other_brand_service_center[]" value="{{$other_brand_table['service_center']}}"  />
                                                            </td>
                                                            @if($obkey > 0)
                                                            <td class="text-center">
                                                                <button class="btn btn-danger remove"
                                                                type="button"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></button>
                                                            </td>
                                                            @else
                                                            <td></td>
                                                            @endif
                                                            @endforeach
                                                        </tr>
                                                    </tbody>
                                                    @else
                                                    <tbody id="tbody_other_brand">
                                                       
                                                        <tr>
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
                                                           
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                    @endif
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group mb-3">
                                            <div class="d-flex flex-wrap align-items-center mb-4">
                                            <label >Visiting/Inspection Charge</label>
                                                <a id="add_new_inspection_charge" class="btn add-input-fields btn-light ml-3 ">
                                                    Add New
                                                </a>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-borderless"  cellpadding="0" cellspacing="0" >
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Work at Customer Place (SAR)</th>
                                                            <th>Work at Dealer Place (SAR)</th>
                                                            <th>Work at Service Center (SAR)</th>
                                                            <th></th>
                                                        </tr>
                                                    <thead>
                                                        @if($page->inspection_charge_table)
                                                        <?php
                                                            $inspection_charge_tables = json_decode($page->inspection_charge_table, true);
                                                        ?>
                                                    <tbody id="tbody_inspection_charge">
                                                        @foreach($inspection_charge_tables as $ickey=>$inspection_charge_table)
                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control-small form-control " name="inspection_charge_product[]" value="{{$inspection_charge_table['product']}}"  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small  form-control " name="inspection_charge_customer_place[]" value="{{$inspection_charge_table['customer_place']}}"  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control-small form-control " name="inspection_charge_dealer_place[]" value="{{$inspection_charge_table['dealer_place']}}"  />
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control-small  form-control " name="inspection_charge_service_center[]" value="{{$inspection_charge_table['service_center']}}"  />
                                                            </td>
                                                            @if($ickey > 0)
                                                            <td class="text-center">
                                                                <button class="btn btn-danger remove"
                                                                type="button"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></button>
                                                            </td>
                                                            @else
                                                            <td></td>
                                                            @endif
                                                            @endforeach
                                                        </tr>
                                                    </tbody>
                                                    @else
                                                    <tbody id="tbody_inspection_charge">
                                                       
                                                        <tr>
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
                                                           
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                    @endif
                                                </table>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-12 form-group mb-3">
                                            <label >Content</label>
                                            <textarea class="form-control tinymce" name="description">{{$page->description}}</textarea>
                                        </div> -->

                                        <div class="col-md-12">
                                            <h4>Meta Fields</h4>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Meta Title</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter your meta title" name="meta_title" value="{{$page->meta_title}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Meta Keywords</label><small>( Seperate by commas)</small>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter your meta keywords" name="meta_tags" value="{{$page->meta_tags}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Meta Description</label>
                                            <textarea class="form-control" name="meta_description">{{$page->meta_description}}</textarea>
                                        </div>

                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a class="btn btn-light ml-3" href="{{URL('admin/pages')}}">Back</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end of col-->
                </div>
            </div>
            <div class="flex-grow-1"></div>

            <!-- fotter end -->
        </div>
    </div>


@stop
@section('script')
<script src="{{asset('public/admins/js/service-policy.js')}}"></script>

@endsection
