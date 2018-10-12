@extends('templates.freelancer.freelancer')

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
                <li><a target="_blank" href="{{url('view/freelancer/'.Helpers::EncodeDecode($freelancer->id))}}">Preview as public</a></li>
            </ul>
            <div class="pi-tabs-content pi-tabs-content-transparent" ng-app="freelancerSettings" ng-controller="FSettingsCtrl">
                <div ng-cloak class="pi-col-xs-12 form-horizontal">
                
             <!--<div ng-show="successMsg" class="pi-alert-success pi-padding-bottom-20">
            <button data-dismiss="alert" class="pi-close" type="button">
                <i class="icon-cancel"></i>
            </button>
            <strong></strong>
        </div>-->
                
                <div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading">Account Settings <a style="color:#10a95b;" class="pull-right" id="top">@{{successMsg}}</a></div>

<ul class="list-group fre-sett">
    <li class="list-group-item"> <strong>Available?</strong> <small>(Select checkbox if working with any profject)</small> <span class="pull-right"><input ng-init="available = Freelancer.available==null?false:true " ng-checked="getStatus(Freelancer.available)" ng-model="available" ng-click="changeStatus(Freelancer.available,'available','Available')" type="checkbox"/></span></li>
    <li class="list-group-item">Publish your profile <span class="pull-right"><input ng-checked="getStatus(Freelancer.publish_status)" ng-model="Freelancer.publish_status" ng-click="changeStatus(Freelancer.publish_status,'publish_status','Profile publishing status')" type="checkbox"/></span></li>
    <li class="list-group-item">Show Education to public <span class="pull-right"><input ng-checked="getStatus(Freelancer.edu_widget)" ng-model="Freelancer.edu_widget" ng-click="changeStatus(Freelancer.edu_widget,'edu_widget','Education publishing status')" type="checkbox"/></span></li>
    <li class="list-group-item">Show Certificate to public <span class="pull-right"><input ng-checked="getStatus(Freelancer.certificate_widget)" ng-model="Freelancer.certificate_widget" ng-click="changeStatus(Freelancer.certificate_widget,'certificate_widget','Certificate publishing status')" type="checkbox"/></span></li>
    <li class="list-group-item">Show Professional Background to public <span class="pull-right"><input ng-checked="getStatus(Freelancer.pbs_widget)" ng-model="Freelancer.pbs_widget" ng-click="changeStatus(Freelancer.pbs_widget,'pbs_widget','Professional background publishing status')" type="checkbox"/></span></li>
    <li class="list-group-item">Show Contact to public <span class="pull-right"><input ng-checked="getStatus(Freelancer.contact_widget)" ng-model="Freelancer.contact_widget" ng-click="changeStatus(Freelancer.contact_widget,'contact_widget','Contact status')" type="checkbox"/></span></li>
    <li class="list-group-item">Show Earning to public <span class="pull-right"><input ng-checked="getStatus(Freelancer.earning_widget)" ng-model="Freelancer.earning_widget" ng-click="changeStatus(Freelancer.earning_widget,'earning_widget','Earn status')" type="checkbox"/></span></li>
    <li class="list-group-item">Show Review to public <span class="pull-right"><input ng-checked="getStatus(Freelancer.review_widget)" ng-model="Freelancer.review_widget" ng-click="changeStatus(Freelancer.review_widget,'review_widget','Review publishing status')" type="checkbox"/></span></li>
    <li class="list-group-item">Show Tests to public <span class="pull-right"><input ng-checked="getStatus(Freelancer.exam_widget)" ng-model="Freelancer.exam_widget" ng-click="changeStatus(Freelancer.exam_widget,'exam_widget','Feedback status')" type="checkbox"/></span></li>
  </ul>
</div>
                
                
<!--                    <div ng-show="successMsg" class="pi-alert-success pi-padding-bottom-20">
                        <button data-dismiss="alert" class="pi-close" type="button">
                            <i class="icon-cancel"></i>
                        </button>
                        <strong><a id="top">@{{successMsg}}</a></strong>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-4"> Available? <small>(Select checkbox if working with any profject)</small></label>
                        <div class="col-lg-7">
                            <input style="vertical-align:text-bottom;" ng-init="available = Freelancer.available==null?false:true " ng-checked="getStatus(Freelancer.available)" ng-model="available" ng-click="changeStatus(Freelancer.available,'available','Available')" type="checkbox"/>
                        </div>
                    </div>
                    <hr/>
                    <div class="form-group">
                        <label class="col-lg-4"> Publish your profile</small></label>
                        <div class="col-lg-7">
                            <input style="vertical-align:text-bottom;" ng-checked="getStatus(Freelancer.publish_status)" ng-model="Freelancer.publish_status" ng-click="changeStatus(Freelancer.publish_status,'publish_status','Profile publishing status')" type="checkbox"/>
                        </div>
                    </div>
                    <hr/>
                    <div class="form-group">
                        <label class="col-lg-4"> Show Education to public</label>
                        <div class="col-lg-7">
                            <input style="vertical-align:text-bottom;" ng-checked="getStatus(Freelancer.edu_widget)" ng-model="Freelancer.edu_widget" ng-click="changeStatus(Freelancer.edu_widget,'edu_widget','Education publishing status')" type="checkbox"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4"> Show Certificate to public</label>
                        <div class="col-lg-7">
                            <input style="vertical-align:text-bottom;" ng-checked="getStatus(Freelancer.certificate_widget)" ng-model="Freelancer.certificate_widget" ng-click="changeStatus(Freelancer.certificate_widget,'certificate_widget','Certificate publishing status')" type="checkbox"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4"> Show Professional Background to public</label>
                        <div class="col-lg-7">
                            <input style="vertical-align:text-bottom;" ng-checked="getStatus(Freelancer.pbs_widget)" ng-model="Freelancer.pbs_widget" ng-click="changeStatus(Freelancer.pbs_widget,'pbs_widget','Professional background publishing status')" type="checkbox"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4"> Show Contact to public</label>
                        <div class="col-lg-7">
                            <input style="vertical-align:text-bottom;" ng-checked="getStatus(Freelancer.contact_widget)" ng-model="Freelancer.contact_widget" ng-click="changeStatus(Freelancer.contact_widget,'contact_widget','Contact status')" type="checkbox"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4"> Show Earning to public</label>
                        <div class="col-lg-7">
                            <input style="vertical-align:text-bottom;" ng-checked="getStatus(Freelancer.earning_widget)" ng-model="Freelancer.earning_widget" ng-click="changeStatus(Freelancer.earning_widget,'earning_widget','Earn status')" type="checkbox"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4"> Show Review to public</label>
                        <div class="col-lg-7">
                            <input style="vertical-align:text-bottom;" ng-checked="getStatus(Freelancer.review_widget)" ng-model="Freelancer.review_widget" ng-click="changeStatus(Freelancer.review_widget,'review_widget','Review publishing status')" type="checkbox"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4"> Show Tests to public</label>
                        <div class="col-lg-7">
                            <input style="vertical-align:text-bottom;" ng-checked="getStatus(Freelancer.exam_widget)" ng-model="Freelancer.exam_widget" ng-click="changeStatus(Freelancer.exam_widget,'exam_widget','Feedback status')" type="checkbox"/>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</div>
@stop