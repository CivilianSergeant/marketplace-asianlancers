@extends('templates.freelancer.freelancer')

@section('content')
<script type="text/javascript">
    var data = {{$agency_member}}
    var notification = {{$notification}}
</script>
<script type="text/javascript" src="{{$theme}}js/custom/freelancer/notification.js"></script>
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
                {{Theme::make('partial.menu',array('freelancer'=>$freelancer))}}
            </ul>
            <div class="pi-tabs-content pi-tabs-content-transparent">

                <!-- Tab content -->

                <div ng-cloak class="pi-row col-lg-12">
                    <h1>{{{$notification->subject}}}</h1>
                    <label>Message: </label>
                    <p>
                        {{$notification->message}}

                    </p>
                    @if($notification->notification_type == 'Team Invitation')
                    <form id="AgencyTeamInvitationFrm" class="form-horizontal">
                        <p class="col-lg-12"><strong>Agency Name :</strong> <strong>{{$agency_member->GetAgencyProfile->first_name. ' '.$agency_member->GetAgencyProfile->last_name}}</strong></p>
                        <p class="col-lg-12">Requested Date: {{Helpers::dateTimeFormat('j F, Y', $agency_member->created_at)}} </p>
                        @if($user->is_agent == 0 && $agency_member->status == 'Requested')
                        <p class="col-lg-12">Do you have interest to join with <strong>{{$agency_member->GetAgencyProfile->first_name. ' '.$agency_member->GetAgencyProfile->last_name}}</strong> and work with them as a team member?</p>
                        @endif
                        <p class="col-lg-12">Current Status : <span class="text-blue1">{{$agency_member->status}}</span></p>
                        <div class="col-lg-12">
                        @if($agency_member->status == 'Requested' && $user->is_agent == 0)
                        <div class="col-lg-2 pi-margin-right-10">
                            <input type="button" class="btn pi-btn-green pi-btn-sm" ng-click="setStatus('Accept','TI')" value="Accept"/>
                        </div>
                        @endif
                        @if($agency_member->status != 'Canceled' && $agency_member->status != 'Inactivated' && $user->is_agent == 0)
                        <div class="col-lg-1 pi-no-padding-left">
                            <input type="button" class="btn pi-btn-red pi-btn-sm @if($agency_member->status == 'Requested') pull-right @endif" ng-click="setStatus('Cancel','TI')" value="Cancel"/>
                        </div>
                        @endif

                        @if($agency_member->status == 'Accepted' && $user->is_agent == 1)
                        <div class="col-lg-1 pi-no-padding-left">
                            <input type="button" class="btn pi-btn-red pi-btn-sm @if($agency_member->status == 'Requested') pull-right @endif" ng-click="setStatus('Inactivat','TI')" value="Deactivate"/>
                        </div>
                        @endif
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop