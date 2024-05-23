@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Products Vendors</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('admin/products')}}">
                                Products
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                           Products Vendors
                        </li>

                    </ol>
                </nav>

                <div class="separator-breadcrumb border-top"></div>
                
                <div class="container"> 
                    <div class="row"> 
                        @if(session()->has('message'))
                           <div class="col-12 alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{ session()->get('message') }}
                            </div>
                        @endif
                    </div>
                </div>
                    
                <div class="row mb-4 role-management">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">

                                <button  type="button" class="btn btn-primary ripple m-1 addBtn" data-toggle="modal" data-target="#vendorModal">Add Product Vendor</button>
                                <input type="hidden" id="product_id" value="{{$id}}">
                                
                                <div class="table-responsive">                           
                                    <table class="display table table-striped table-bordered" id="products_vendor_table" style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th>Sl no</th>
                                                <th>Vendor</th>
                                                <th>Link</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>                                             
                                    </table>
                                </div>
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
    <!-- //////modal -->
    <!-- Modal -->
<div class="modal fade" id="vendorModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <form method="POST" action="{{URL('admin/products/vendor/store',$id)}}" >
             @csrf
            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
               
                    <div class="form-group">
                        <label for="inputName">Vendor</label>
                        <select name="vendor_id" id="vendor_id"  class="form-control" required>
                            <option value="">Select</option>
                            @foreach($vendors as $vendor)
                                <option value="{{$vendor->id}}" <?php echo old('vendor_id') == $vendor->id?'selected':''; ?>>{{$vendor->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Online Link</label>
                        <input type="text" class="form-control" name="link" required id="link" placeholder="Enter link"/>
                    </div>
                   
                
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary submitBtn" >SUBMIT</button>
            </div>
            </form>
        </div>
    </div>
</div>
    <!-- <modal end -->
@stop
@section('script')
    <script src="{{asset('public/admins/js/vendor-list.js')}}"></script>
@endsection