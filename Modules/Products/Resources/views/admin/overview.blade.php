@extends('admin::layouts.master')

@section('content')

<div class="app-admin-wrap layout-sidebar-large">

    <h4 class="mr-2 font-weight-bold">Add Overview - {{$product->name}}</h4>

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
               Overview
            </li>

        </ol>
    </nav>

    <form id="updateOverview">
        @csrf

            <div class="col-md-12 mb-4">
                <button type="submit" id="submit" class="btn btn-primary float-right ml-3">Submit</button>
                <a class="btn btn-light ml-3 float-right" href="{{URL('admin/products')}}">Back</a>
            </div>

            <br>
        
            <input type="hidden" name="id" id="id" value="{{$product->id}}">

            

            <div id="gjs" style="height:0px; overflow:hidden;">
                <style> </style>
            </div>

            
            
    </form>
</div>

@section('script')
    <script src="{{asset('public/admins/js/grapejs.js')}}"></script>
@stop