@extends('templates.default.default')


@section('content')

<!-- Breadcrumbs -->

<div ng-app="" class="pi-section-w pi-border-bottom pi-section-grey">
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="#">Overview</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- End breadcrumbs -->


<!-- - - - - - - - - - SECTION - - - - - - - - - -->

<div class="pi-section-w pi-section-white pi-slider-enabled piSocials"  ng-app="">
    <div class="pi-section pi-padding-bottom-30">

        <!-- Openings -->
        <div class="pi-tabs-vertical pi-responsive-sm">
            {{Helpers::showMessage()}}
            <ul class="pi-tabs-navigation pi-tabs-navigation-transparent profile-po" id="myTabs">
                {{Theme::make('partial.menu',array())}}
            </ul>
            <div class="pi-tabs-content pi-tabs-content-transparent">

                <!-- Tab content -->
                <div>
                    <div class="pi-row">

                        <!-- Col 6 -->
                        <div class="pi-col-xs-12">

                            <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25 pi-has-bg">Subject : {{$notification->subject}}</h3>

                            <div class="pi-box pi-border pi-padding-bottom-30 pi-round pi-border-top pi-text-left">

                                <h4 class="pi-weight-600 pi-col-sm-6 pi-no-padding-left">Message :</h4>
                                <span class="pi-text-right pi-col-sm-6 pi-no-padding-right pull-right">
                                    <strong>Invitation Date : {{Helpers::dateTimeFormat('j F, Y', $jobOffer->created_at)}}</strong>
                                </span>
                                <hr class="pi-clearfix">
                                <p>{{$notification->message}}</p>

                                <div class="pi-col-sm-12 pi-text-left pi-no-padding">
                                    <strong>Current Status : <span style="color:#C60;">{{$jobOffer->job_offer_status}}</span></strong>
                                </div>
<hr class="pi-divider"/>
                                <div class="pi-col-sm-12 pi-no-padding pi-text-right">
                                    <div class="pi-col-sm-12 pi-no-padding">

                                            @if($notification->notification_type == 'New Job Offer')
                                                @if($jobOffer->job_offer_status == 'Pending')
                                                           <form action="{{url('admin/update-job-invitation')}}" method="post">
                                                            <p class="pi-col-sm-1 pi-no-margin-bottom" style="padding:0;float:right;margin-left: 10px; ">
                                                            <input type="hidden" name="id" value="{{$jobOffer->id}}"/>
                                                            <input type="hidden" name="job_offer_status" value="Canceled"/>
                                                            <input type="hidden" name="url" value="{{Helpers::EncodeDecode($notification->id)}}"/>
                                                            <input type="hidden" name="nid" value="{{$notification->id}}"/>
                                                            <input type="submit" class="btn pi-btn-red pi-btn-small" value="Cancel"/>
                                                            </p>
                                                        </form>
                                        <form action="{{url('admin/update-job-invitation')}}" method="post">
                                            <p class="pi-col-sm-3 pi-no-margin-bottom" style="padding:0;float:right; ">
                                                <input type="hidden" name="id" value="{{$jobOffer->id}}"/>
                                                <input type="hidden" name="job_offer_status" value="Approved"/>
                                                <input type="hidden" name="url" value="{{Helpers::EncodeDecode($notification->id)}}"/>
                                                <input type="hidden" name="nid" value="{{$notification->id}}"/>
                                                <input type="submit" class="btn pi-btn-green pi-btn-small" value="Approve"/>
                                            </p>
                                        </form>
                                                @endif
                                            @endif
<div class="clearfix"></div>
                                    </div>

                                </div>




                            </div>




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop