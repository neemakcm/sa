@extends ('pages::layouts.master')

@section('content')
    <section class="section-service-cu no_page_section">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-8 mx-auto text-center">
	                <div class="customer-header">
	                    <h2 class="title" data-sal="slide-up" data-sal-delay="300" data-sal-easing="ease-out-back">The page you requested is not available</h2>
	                    <div class="short-description">
	                        <p data-sal="slide-up" data-sal-delay="600" data-sal-easing="ease-out-back">Sorry, we are having a problem executing your request. It is possible your bookmark is old one or you just meet broken link. Please refer to link about information.</p>
	                    </div>
	                    <a href="{{URL('/')}}" class="s-link-text">Go to impexappliances.com Home</a>
	                    <br>
	                    <br>
	                    <br>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
@stop
