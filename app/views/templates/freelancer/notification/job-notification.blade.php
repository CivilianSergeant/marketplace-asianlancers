@extends('templates.freelancer.freelancer')

@section('content')
<script type="text/javascript">

</script>
<!--<script type="text/javascript" src="{{$theme}}js/custom/freelancer/notification.js"></script>-->
<!-- Breadcrumbs -->

<div class="pi-section-w pi-border-bottom pi-section-grey">
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>

            </ul>
        </div>
        <div class="text-center">
            {{Helpers::showMessage()}}
        </div>
    </div>
</div>
<!-- End breadcrumbs -->
<div class="pi-section-w pi-section-white pi-slider-enabled piSocials">
    <div class="pi-section pi-padding-bottom-30" >

        <!-- Openings -->
        <div class="pi-tabs-vertical pi-responsive-sm">
            <ul class="pi-tabs-navigation pi-tabs-navigation-transparent profile-po" id="myTabs">
                {{Theme::make('partial.menu',array('freelancer'=>$freelancer))}}
            </ul>
            <div class="pi-tabs-content pi-tabs-content-transparent">

                <!-- Tab content -->

                <div class="pi-row col-lg-12">
                    <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25 pi-has-bg">{{{$notification->subject}}}</h3>


                    <div class="pi-box pi-border pi-padding-bottom-30 pi-round pi-border-top pi-text-left">

                        <h4 class="pi-weight-600 pi-col-sm-6 pi-no-padding-left">Message :</h4>

                        <span class="pi-text-right pi-col-sm-6 pi-no-padding-right pull-right">
                            <strong>{{$jobOffer[0]->job_offer_status}} Date : {{Helpers::dateTimeFormat('j F, Y', $notification->created_at)}}</strong>
                        </span>
                        <hr class="pi-clearfix">
                        <p>{{$notification->message}}</p>
                        <div class="pi-col-sm-6 pi-text-left pi-no-padding">
                            <strong>Current Status : <span style="color:#C60;">{{$jobOffer[0]->job_offer_status}}</span></strong>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@stop