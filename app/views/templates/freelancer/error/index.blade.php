@extends('templates.freelancer.freelancer')


@section('content')
<div class="pi-section-w pi-border-bottom pi-section-grey">
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="#">Overview</a></li>
            </ul>
        </div>
        <div class="text-center">
            {{Helpers::showMessage()}}
        </div>
    </div>
</div>
<!-- End breadcrumbs -->



<!-- - - - - - - - - - SECTION - - - - - - - - - -->

<div id="page"><!-- - - - - - - - - - SECTION - - - - - - - - - -->

<div class="pi-section-w pi-section-white">
	<div class="pi-section pi-text-center pi-padding-top-70 pi-padding-bottom-80">
	
		<p class="pi-weight-700 pi-text-dark pi-404">404</p>
		<p class="lead-30 pi-weight-700 pi-uppercase pi-text-dark pi-margin-bottom-10">{{Translate::get("Sorry page not found",$lang)}}</p>
		<p>
			We're sorry, the page you requested cannot be found.<br>
			You can go back to
		</p>
		<p>
			<a class="btn pi-btn pi-btn-base pi-btn-big-paddings pi-btn-big" href="{{url('/')}}" >{{Translate::get("Back to Homepage",$lang)}}</a>
		</p>
		
	</div>
</div>
	
<!-- - - - - - - - - - END SECTION - - - - - - - - - --></div>

<!--<div class="pi-section-w pi-section-white pi-slider-enabled piSocials">
    <div class="pi-section pi-padding-bottom-30" ng-app="">

        <div class="pi-tabs-vertical pi-responsive-sm">

                <div class="pi-row col-lg-12 text-center">
                    <div>
                        <h2 color="red">404</h2>
                        <p></p>
                        <a href="{{url('/')}}">{{Translate::get("Back to Homepage",$lang)}}</a>
                    </div>
                </div>

        </div>
    </div>
</div>-->
@stop