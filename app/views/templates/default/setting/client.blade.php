@extends('templates.default.default')

@section('content')
<script type="text/javascript">
    var client = {{$client}}
</script>
<script type="text/javascript" src="{{$theme}}js/custom/client/settings.js"></script>
<!-- Breadcrumbs -->

<div class="pi-section-w pi-border-bottom pi-section-grey" >
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

<div class="pi-section-w pi-section-white pi-slider-enabled piSocials">
    <div class="pi-section pi-padding-bottom-30">

        <!-- Openings -->
        <div class="pi-tabs-vertical pi-responsive-sm">
            <ul class="pi-tabs-navigation pi-tabs-navigation-transparent profile-po" id="myTabs">
                {{Theme::make('partial.menu',array())}}
            </ul>
            <div class="pi-tabs-content pi-tabs-content-transparent" ng-app="clientSettingsApp" ng-controller="clientSettingsController" ng-cloak>
                <div ng-model="errorMsg" ng-if="errorMsg" class="pi-alert-danger">
                    <button data-dismiss="alert" class="pi-close" type="button">
                        <i class="icon-cancel"></i>
                    </button>
                    <p>
                        <strong><a id="top">Warning!</a></strong> <ul><li ng-repeat="em in errorMsg">@{{em[0]}}</li></ul>
                    </p>
                </div>
                <div ng-model="successMsg" ng-if="successMsg" class="pi-alert-success">
                    <button data-dismiss="alert" class="pi-close" type="button">
                        <i class="icon-cancel"></i>
                    </button>
                    <p ng-repeat="sm in successMsg">
                        @{{sm[0]}}
                    </p>
                </div>
                <div  class="panel panel-info">
                    <!-- Default panel contents -->


                    <div class="panel-heading">Account Settings <a id="top" class="pull-right ng-binding" style="color:#10a95b;"></a></div>

                    <ul class="list-group fre-sett">

                        <li class="list-group-item">Show Picture to public<span class="pull-right"><input type="checkbox" ng-checked="client.picture_widget" ng-model="client.picture_widget" ng-click="changeStatus(client.picture_widget,'picture_widget')"/></span></li>
                        <li class="list-group-item">Show Address to public<span class="pull-right"><input type="checkbox" ng-checked="client.address_widget" ng-model="client.address_widget" ng-click="changeStatus(client.address_widget,'address_widget')"/></span></li>
                        <li class="list-group-item">Show Country to public<span class="pull-right"><input type="checkbox" ng-checked="client.country_widget" ng-model="client.country_widget" ng-click="changeStatus(client.country_widget,'country_widget')"/></span></li>
                        <li class="list-group-item">Show Phone Number to public<span class="pull-right"><input type="checkbox"ng-checked="client.phone_widget" ng-model="client.phone_widget" ng-click="changeStatus(client.phone_widget,'phone_widget')" /></span></li>
                        </ul>
                </div>







            </div>
        </div>
    </div>
</div>
@stop