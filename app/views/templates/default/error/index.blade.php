@extends('templates.default.default')


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

<div class="pi-section-w pi-section-white pi-slider-enabled piSocials">
    <div class="pi-section pi-padding-bottom-30" ng-app="">

        <!-- Openings -->
        <div class="pi-tabs-vertical pi-responsive-sm">

            <!--<div class="pi-tabs-content pi-tabs-content-transparent">-->

                <!-- Tab content -->

                <div class="pi-row col-lg-12 text-center">
                    <div>
                        <h2 color="red">404</h2>
                        <p>Sorry page not found.</p>
                        <a href="{{url('/')}}">Back to Homepage</a>
                    </div>
                </div>
            <!--</div>-->
        </div>
    </div>
</div>
@stop