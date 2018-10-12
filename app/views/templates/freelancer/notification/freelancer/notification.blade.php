@extends('templates.freelancer.freelancer')

@section('content')
<!-- Breadcrumbs -->

<div class="pi-section-w pi-border-bottom pi-section-grey">
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb">
            <ul>
                <li><a href="{{url('/')}}">{{Translate::get("Home",$lang)}}</a></li>
                <li><a href="{{url('freelancer/overview')}}">{{Translate::get("Overview",$lang)}}</a></li>

            </ul>
        </div>
    </div>
</div>
<!-- End breadcrumbs -->

<!-- - - - - - - - - - SECTION - - - - - - - - - -->

<div class="pi-section-w pi-section-white pi-slider-enabled piSocials">
    <div class="pi-section pi-padding-bottom-30">

        <!-- Openings -->
        <div class="pi-tabs-vertical pi-responsive-sm">
            <ul class="pi-tabs-navigation pi-tabs-navigation-transparent profile-po" id="myTabs">
                {{Theme::make('partial.menu',array())}}
            </ul>
            <div class="pi-tabs-content pi-tabs-content-transparent">

                <!-- Tab content -->
                <div ng-app="">
                    <div class="pi-row col-lg-12">
                        <div class="pi-tab-pane" id="jobhistory">

                            <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-20 pi-has-bg">
                                {{Translate::get("Notification",$lang)}}
                            </h3>
                            <div class="pi-section-grey pi-padding-bottom-10 pi-padding-top-10 pi-col-lg-12" style="display: block;">

                                    <p>
                                       <strong>{{Translate::get($notification->subject,$lang)}}</strong>
                                    </p>


                                    <div>
                                        {{$notification->message}}
                                    </div>



                            </div>
                            <hr class="clearfix"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop