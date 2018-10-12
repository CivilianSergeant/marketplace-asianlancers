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
                                    <strong>Requested Date: {{Helpers::dateTimeFormat('j F, Y', $jobRequest->created_at)}}</strong>
                                </span>
                                <hr class="pi-clearfix">
                                <p>{{$notification->message}}</p>

                                <div class="pi-col-sm-6 pi-text-left pi-no-padding">
                                    <strong>Current Status : <span style="color:#C60;">{{$jobRequest->request_status}}</span></strong>
                                </div>

                                @if($notification->notification_type == 'Job Request')
                                    <div class="pi-col-sm-6 pi-no-padding pi-text-right">
                                        <div class="pi-col-sm-12 pi-no-padding">
                                            @if($jobRequest->request_status == 'Approved')
                                                @if($freelancer->available==1)
                                                    <form action="{{url('client/update-job-request')}}" method="post">
                                                        <div class="pi-col-sm-10">
                                                            <input type="hidden" name="id" value="{{$jobRequest->id}}"/>
                                                            <input type="hidden" name="request_status" value="Accepted"/>
                                                            <input type="hidden" name="url" value="{{Helpers::EncodeDecode($notification->id)}}"/>
                                                            <input type="hidden" name="nid" value="{{$notification->id}}"/>
                                                            <input type="hidden" name="jid" value="{{Helpers::EncodeDecode($jobRequest->job_id)}}"/>
                                                            <input type="hidden" name="fid" value="{{Helpers::EncodeDecode($jobRequest->freelancer_id)}}"/>
                                                            <div class="pi-col-sm-8 pi-no-padding">
                                                                <input type="text" name="hour" placeholder="Job Offer hour" required class="form-control input-sm" />
                                                            </div>
                                                            <div class="pi-col-sm-4 pi-no-padding">
                                                                <input type="submit" class="btn pi-btn-green pi-btn-small" value="Accept"/>
                                                            </div>
                                                        </div>
                                                    </form>

                                                    <form action="{{url('client/update-job-request')}}" method="post">
                                                        <p class="pi-col-sm-2">
                                                        <input type="hidden" name="id" value="{{$jobRequest->id}}"/>
                                                        <input type="hidden" name="request_status" value="Declined"/>
                                                        <input type="hidden" name="url" value="{{Helpers::EncodeDecode($notification->id)}}"/>
                                                        <input type="hidden" name="nid" value="{{$notification->id}}"/>
                                                        <input type="hidden" name="fid" value="{{Helpers::EncodeDecode($jobRequest->freelancer_id)}}"/>
                                                        <input type="submit" class="btn pi-btn-red pi-btn-small" value="Decline"/>
                                                        </p>
                                                    </form>
                                                @else
                                                <div class="col-lg-12 pi-no-padding-left">
                                                    <p>
                                                        This freelancer no longer available.
                                                    </p>
                                                </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    @if($jobRequest->request_status == 'Requested')
                                        <p class="col-lg-12">Client need your approval to review this job request for freelancer <a href="{{url('view/freelancer/'.Helpers::EncodeDecode($jobRequest->freelancer_id))}}"><strong>{{$jobRequest->Freelancer->getName()}}</strong></a></p>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop