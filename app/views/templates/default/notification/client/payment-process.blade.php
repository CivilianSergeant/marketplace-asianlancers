@extends('templates.default.default')

@section('content')
<script type="text/javascript">
    var notification = {{$notification}}
    var jobPhase = {{$jobPhase}}
</script>
<script type="text/javascript" src="{{$theme}}js/custom/notification/notification.js"></script>
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
    <div class="pi-section pi-padding-bottom-30" ng-app="notifyApp" ng-controller="notifyController">

        <!-- Openings -->
        <div class="pi-tabs-vertical pi-responsive-sm">
            <ul class="pi-tabs-navigation pi-tabs-navigation-transparent profile-po" id="myTabs">
                {{Theme::make('partial.menu',array())}}
            </ul>
            <div class="pi-tabs-content pi-tabs-content-transparent">

                <!-- Tab content -->

                <div ng-cloak class="pi-row col-lg-12">
                    <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25 pi-has-bg">{{{$notification->subject}}}</h3>
                    <div class="pi-shadow-effect7">

                    <div class="pi-box pi-border pi-padding-bottom-30 pi-round pi-border-top pi-text-left">
                        <h4 class="pi-weight-600 pi-col-sm-6 pi-no-padding-left">Message :</h4>
                                <span class="pi-text-right pi-col-sm-6 pi-no-padding-right pull-right">
                                    <strong>{{$jobPhase->job_offer_status}} Date : {{Helpers::dateTimeFormat('j F, Y', $notification->created_at)}}</strong>
                                </span>
                        <hr class="pi-clearfix">
                        <p>{{$notification->message}}</p>
                        <div class="pi-col-sm-6 pi-text-left pi-no-padding">
                            <strong>Current Status : <span style="color:#C60;">{{$jobPhase->phase_payment_status}}</span></strong>
                        </div>

                        @if($notification->notification_type == 'Payment')
                        <div class="pi-col-sm-6 pi-no-padding pi-text-right">
                            <div class="pi-col-sm-12 pi-no-padding">
                                @if($jobPhase->phase_payment_status == 'Waiting')
                                <form method="post" ng-submit="paymentProcess()">
                                    <div class="pi-col-sm-10">
                                        <input type="hidden" name="jpid" value="{{$jobPhase->id}}"/>
                                        <input type="hidden" name="request_status" value="Accepted"/>
                                        <input type="hidden" name="url" value="{{Helpers::EncodeDecode($notification->id)}}"/>
                                        <input type="hidden" name="nid" value="{{$notification->id}}"/>
                                        <input type="hidden" name="joid" value="{{Helpers::EncodeDecode($jobPhase->job_offer_id)}}"/>
                                        <div class="pi-col-sm-4 pi-no-padding">
                                            <input type="submit" class="btn pi-btn-green pi-btn-small"  value="Accept"/>
                                        </div>
                                    </div>
                                </form>

                                <form action="{{url('client/update-payment-request')}}" method="post">
                                    <div class="pi-col-sm-2">
                                        <input type="hidden" name="jpid" value="{{$jobPhase->id}}"/>
                                        <input type="hidden" name="request_status" value="Hold"/>
                                        <input type="hidden" name="url" value="{{Helpers::EncodeDecode($notification->id)}}"/>
                                        <input type="hidden" name="nid" value="{{$notification->id}}"/>
                                        <input type="hidden" name="joid" value="{{Helpers::EncodeDecode($jobPhase->job_offer_id)}}"/>
                                        <input type="submit" class="btn pi-btn-red pi-btn-small" value="Hold"/>
                                    </div>
                                </form>
                                @endif
                            </div>
                        </div>

                        @endif

                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop