@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content overview">
                <div class="breadcrumb d-flex">
                    <h1 class="mr-2">Welcome to Lulu mall</h1>
                    
                </div>
                <div class="separator-breadcrumb border-top"></div>
            </div>
        </div><!-- ============ Search UI Start ============= -->
       
        @stop