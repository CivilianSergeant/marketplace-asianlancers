@extends('templates.default.default')

@section('content')
<script type="text/javascript">
    var token = "<?php echo Form::tokenCode(); ?>"
</script>
<script type="text/javascript" src="{{$theme}}js/custom/setting/settingController.js"></script>
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

<div data-ng-app="settingApp" data-ng-controller="settingController"  class="pi-section-w pi-section-white pi-slider-enabled piSocials">
    <div class="pi-section pi-padding-bottom-30">

        <!-- Openings -->
        <div class="pi-tabs-vertical pi-responsive-sm">
            <ul class="pi-tabs-navigation pi-tabs-navigation-transparent" id="myTabs">
                {{Theme::make('partial.menu',array())}}
            </ul>
            <div class="pi-tabs-content pi-tabs-content-transparent">

                <!-- Tab content -->
               <!-- <div  ng-app="userApp" data-ng-controller="AdminController">-->

                   <!-- <div data-ng-app="settingApp" data-ng-controller="settingController">-->

                      <div ng-cloak  class="pi-row col-lg-12">
                          <div ng-model="errorMsg" ng-show="errorMsg !=''" class="pi-alert-danger">
                              <button data-dismiss="alert" class="pi-close" type="button">
                                  <i class="icon-cancel"></i>
                              </button>
                              <p>
                                  <strong><a id="top">@{{errorMsg}}</a></strong>

                              </p>
                          </div>
                          <div  ng-model="successMsg"  ng-show="successMsg !=''" class="pi-alert-success pi-padding-bottom-20">
                              <button data-dismiss="alert" class="pi-close" type="button">
                                  <i class="icon-cancel"></i>
                              </button>
                              <strong><a id="top">@{{successMsg}}</a></strong>

                          </div>

                      </div>



                <form ng-submit="changePassword()" method="post">
                    <div class="panel panel-success"><div class="panel-heading"><h3 class="panel-title">Change Password</h3></div>
                        <div class="panel-body">

                            <div style="width:100%;" class="input-group">
                                <span style="width:30%;" class="input-group-addon">Old Password</span>
                                <input type="password" style="width:100%;" class="form-control" data-ng-model="form.oldPassword">
                            </div>
                            <hr class="pi-divider-gap-10">
                            <div style="width:100%;" class="input-group">
                                <span style="width:30%;" class="input-group-addon">New Password</span>
                                <input type="password" style="width:100%;" class="form-control" data-ng-model="form.newPassword">
                            </div>
                            <hr class="pi-divider-gap-10">
                            <div style="width:100%;" class="input-group">
                                <span style="width:30%;" class="input-group-addon">Retype New Password</span>
                                <input type="password" style="width:100%;" class="form-control" data-ng-model="form.confPassword">
                            </div>
                            <hr class="pi-divider-gap-10">
                            <span class="divider"></span>
                            <button type="submit" class="btn pi-btn-green pi-btn-small pull-right"><i class="icon-check pi-icon-left"></i> Reset Password</button>
                        </div>
                    </div>
                </form>


                    <!-- End row -->
                <!--</div>-->
                <!-- End tab content -->

            <!--</div>-->
        </div>
        <!-- End tabs -->

    </div>
</div>

<!-- - - - - - - - - - END SECTION - - - - - - - - - -->

<!-- - - - - - - - - - SECTION - - - - - - - - - -->
<div class="pi-section-w pi-shadow-inside-top pi-section-base">
    <div class="pi-texture" style="background: url({{$theme}}img/hexagon.png) repeat;"></div>
    <div class="pi-section pi-padding-top-60 pi-padding-bottom-40 pi-text-center">

        <p class="lead-30">
            <span class="pi-text-white">Have a project with us? <span class="pi-weight-400">Feel free.</span></span>

            <a href="#" class="btn pi-btn-base-2 pi-btn-big" style="margin-left: 25px;">
                <i class="icon-mail pi-icon-left"></i> Get in Touch
            </a>

        </p>

    </div>
</div>
<!-- - - - - - - - - - END SECTION - - - - - - - - - --></div>

@stop