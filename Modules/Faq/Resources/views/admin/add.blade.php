@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Add Faq</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('admin/faq')}}">
                                Faq
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                           Add Faq
                        </li>

                    </ol>
                </nav>
                
                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" action="{{URL('admin/faq/store')}}"  enctype='multipart/form-data'>
                                	@csrf
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Category</label>
                                            <select class="form-control" name="category_id" required>
                                                <option value="" disabled selected>Select</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Question</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter question" name="question" required>
                                        </div>

                                        <div class="col-md-12 form-group mb-3">
                                            <label >Answer</label>
                                            <textarea class="form-control tinymce" name="answer" required></textarea>
                                        </div>

                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a class="btn btn-light ml-3" href="{{URL('admin/faq')}}">Back</a>
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