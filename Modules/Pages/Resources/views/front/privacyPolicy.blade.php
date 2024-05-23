@extends('pages::layouts.master')

@section('meta_title', $page->meta_title)
@section('meta_tags', $page->meta_tags)
@section('meta_description', $page->meta_description)

@section('content')

<!-- Main Wrapper -->
<main>

    <!-- Banner -->
    <section class="intro-text_banner">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-auto text-center inner-padding ">
                    <h2 class="header-title ">Privacy Policy</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner END -->

    <!-- Content -->
    <section class="p-page_content">
        <div class="container">
            {!! $page->description !!}
        </div>

    </section>
    <!-- Content END -->

</main>
<!-- Main Wrapper END -->

@stop