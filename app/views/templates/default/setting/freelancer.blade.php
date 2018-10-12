@extends('templates.default.default')

@section('content')
<script type="text/javascript">
    var freelancer = {{$freelancer}}
</script>
<script type="text/javascript" src="{{$theme}}js/custom/freelancer/settings.js"></script>
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
            <div class="pi-tabs-content pi-tabs-content-transparent" ng-app="freelancerSettings" ng-controller="FSettingsCtrl">
                <div ng-cloak class="pi-col-xs-12 form-horizontal">
                    <h3>Account Settings</h3>
                    <hr/>
                    <div class="form-group">
                        <label class="col-lg-4"> Available? <small>(Select checkbox if working with any profject)</small></label>
                        <div class="col-lg-7">
                            <input style="vertical-align:text-bottom;" ng-checked="Freelancer.available" ng-model="Freelancer.available" ng-click="changeStatus(Freelancer.available,'available')" type="checkbox"/>
                        </div>
                    </div>
                    <hr/>
                    <div class="form-group">
                        <label class="col-lg-4"> Publish your profile</small></label>
                        <div class="col-lg-7">
                            <input style="vertical-align:text-bottom;" ng-checked="Freelancer.publish_status" ng-model="Freelancer.publish_status" ng-click="changeStatus(Freelancer.publish_status,'publish_status')" type="checkbox"/>
                        </div>
                    </div>
                    <hr/>
                    <div class="form-group">
                        <label class="col-lg-4"> Show Education to public</label>
                        <div class="col-lg-7">
                            <input style="vertical-align:text-bottom;" ng-checked="Freelancer.edu_widget" ng-model="Freelancer.edu_widget" ng-click="changeStatus(Freelancer.edu_widget,'edu_widget')" type="checkbox"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4"> Show Certificate to public</label>
                        <div class="col-lg-7">
                            <input style="vertical-align:text-bottom;" ng-checked="Freelancer.certificate_widget" ng-model="Freelancer.certificate_widget" ng-click="changeStatus(Freelancer.certificate_widget,'certificate_widget')" type="checkbox"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4"> Show Professional Background to public</label>
                        <div class="col-lg-7">
                            <input style="vertical-align:text-bottom;" ng-checked="Freelancer.pbs_widget" ng-model="Freelancer.pbs_widget" ng-click="changeStatus(Freelancer.pbs_widget,'pbs_widget')" type="checkbox"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4"> Show Contact to public</label>
                        <div class="col-lg-7">
                            <input style="vertical-align:text-bottom;" ng-checked="Freelancer.contact_widget" ng-model="Freelancer.contact_widget" ng-click="changeStatus(Freelancer.contact_widget,'contact_widget')" type="checkbox"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4"> Show Earning to public</label>
                        <div class="col-lg-7">
                            <input style="vertical-align:text-bottom;" ng-checked="Freelancer.earning_widget" ng-model="Freelancer.earning_widget" ng-click="changeStatus(Freelancer.earning_widget,'earning_widget')" type="checkbox"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4"> Show Review to public</label>
                        <div class="col-lg-7">
                            <input style="vertical-align:text-bottom;" ng-checked="Freelancer.review_widget" ng-model="Freelancer.review_widget" ng-click="changeStatus(Freelancer.review_widget,'review_widget')" type="checkbox"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4"> Show Tests to public</label>
                        <div class="col-lg-7">
                            <input style="vertical-align:text-bottom;" ng-checked="Freelancer.exam_widget" ng-model="Freelancer.exam_widget" ng-click="changeStatus(Freelancer.exam_widget,'exam_widget')" type="checkbox"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop