@extends('templates.default.default')


@section('content')
<script type="text/javascript">
    var token = "<?php echo Form::tokenCode(); ?>"
    var pageName = 'create-default-profile';
</script>
<script type="text/javascript" src="{{$theme}}js/custom/admin/admin.js"></script>
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

<div data-ng-app="userApp" data-ng-controller="AdminController"  class="pi-section-w pi-section-white pi-slider-enabled piSocials">
    <div class="pi-section pi-padding-bottom-30">

        <!-- Openings -->
        <div class="pi-tabs-vertical pi-responsive-sm">
            <ul class="pi-tabs-navigation pi-tabs-navigation-transparent profile-po" id="myTabs">
                {{Theme::make('partial.menu',array())}}
            </ul>
            <div class="pi-tabs-content pi-tabs-content-transparent">

                <!-- Tab content -->
                <!-- <div  ng-app="userApp" data-ng-controller="AdminController">-->

                <!-- <div data-ng-app="settingApp" data-ng-controller="settingController">-->

                <div  class="pi-row col-lg-12">
                    <div  class="pi-alert-danger"  ng-show="errorMsg">
                        <button data-dismiss="alert" class="pi-close" type="button">
                            <i class="icon-cancel"></i>
                        </button>
                        <p ng-repeat="sm in errorMsg">
                            @{{sm[0]}}
                        </p>
                    </div>
                    <div ng-show="successMsg"  class="pi-alert-success pi-padding-bottom-20">
                        <button data-dismiss="alert" class="pi-close" type="button">
                            <i class="icon-cancel"></i>
                        </button>
                        <strong><a id="top">@{{successMsg}}</a></strong>

                    </div>

                </div>
                <hr class="pi-divider-gap-10">
                <div class="pi-row col-lg-5">
                    <!-- Col 6 -->
                    <form ng-submit="addUser()" method="post">

                        <div class="form-group">
                            <div class="pi-input-with-icon">
                                <div class="pi-input-icon"></div>
                                <select class="form-control" ng-init="form.userList = userTypeList[0]" ng-model="form.userList" ng-options="x.name for x in userTypeList"></select>
                             </div>
                        </div>

                        <div class="form-group">
                            <input type="text" ng-model="form.first_name" placeholder="First Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" ng-model="form.last_name" placeholder="Last Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="email" ng-model="form.email" placeholder="Email" class="form-control">
                        </div>
                        <div class="form-group" data-ng-hide="form.userList != userTypeList[2]">
                            <input type="text" ng-model="form.agency_name"  placeholder="Agency Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" ng-model="form.password"  placeholder="New Password" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" ng-model="form.confirm_password" placeholder="Retype New Password" class="form-control">
                        </div>

                        <p>
                            <button type="submit"
                                    class="btn pi-btn-base pi-btn-big pi-uppercase pi-weight-700 pi-letter-spacing">
                                <i class="icon-check pi-icon-left"></i> Create User
                            </button>
                        </p>
                    </form>
                    <!-- End col 6 -->

                </div>
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