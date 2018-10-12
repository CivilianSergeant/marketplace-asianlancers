@extends('templates.default.default')


@section('content')
<script type="text/javascript" src="{{$theme}}js/custom/freelancer/individual.js"></script>
<script>
    var token = "<?php echo Form::tokenCode(); ?>"

    var UserData = {{$user_data}};
    var country = {{$country}};
</script>
<!-- - - - - - - - - - SECTION - - - - - - - - - -->

<!-- Breadcrumbs -->
<div class="pi-section-w pi-border-bottom pi-section-grey">
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('freelancer/overview')}}">Overview</a></li>
                <li><a href="{{url('freelancer/'.$title['action'])}}">{{$title['title']}}</a></li>

            </ul>
        </div>
    </div>
</div>
<!-- End breadcrumbs -->

<!-- - - - - - - - - - END SECTION - - - - - - - - - -->

<!-- - - - - - - - - - SECTION - - - - - - - - - -->

<div class="pi-section-w pi-section-white pi-slider-enabled piSocials">
    <div class="pi-section pi-padding-bottom-30">

        <!-- Openings -->
        <div class="pi-tabs-vertical pi-responsive-sm">
            <ul class="pi-tabs-navigation pi-tabs-navigation-transparent profile-po" id="myTabs">
                {{Theme::make('partial.menu',array())}}
            </ul>
            <div class="pi-tabs-content pi-tabs-content-transparent" data-ng-app="xApp" data-ng-controller="IndividualCtrl">
                <div ng-cloak class="pi-col-xs-12">
                    <div ng-model="errorMsg" ng-if="errorMsg" class="pi-alert-danger">
                        <button data-dismiss="alert" class="pi-close" type="button">
                            <i class="icon-cancel"></i>
                        </button>

                        <p >
                            <strong><a id="top">Warning!</a></strong> <ul><li ng-repeat="em in errorMsg">@{{em[0]}}</li></ul>
                        </p>
                    </div>
                    <h3>Edit Contact informations</h3>
                    <form id="updateContactFrm" ng-submit="updateContact()">
                        <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
                            <thead>

                            <tr>
                                <th colspan="2">Address:</th>
                                <th>
                                    <div class="col-lg-10">
                                        <textarea name="address" ng-model="form.address" class="form-control"></textarea>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2">Country:</th>
                                <th>
                                    <div class="col-lg-10">
                                        <input name="country" ng-model="form.country" class="form-control" typeahead="c.name for c in country | filter:$viewValue | limitTo:5">
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2">City:</th>
                                <th>
                                    <div class="col-lg-10">
                                        <input name="area" ng-model="form.city" class="form-control">
                                    </div>
                                </th>
                            </tr>
                            <tr ng-show="form.country=='BANGLADESH'">
                                <th colspan="2">Division:</th>
                                <th>
                                    <div class="col-lg-10">
                                         <select ng-model="form.division" class="form-control">
                                             <option ng-repeat="d in divisions" ng-selected="d.ID == form.division" value="@{{d.ID}}">@{{d.Title}}</option>
                                         </select>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2">Zip:</th>
                                <th>
                                    <div class="col-lg-10">
                                        <input name="zip" ng-model="form.zip" class="form-control">
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2">Phone:</th>
                                <th>
                                    <div class="col-lg-10">
                                        <input name="contact_number" ng-model="form.contact_number" class="form-control">
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2">Mobile:</th>
                                <th>
                                    <div class="col-lg-10">
                                        <input name="contact_number" ng-model="form.mobile" class="form-control">
                                    </div>
                                </th>
                            </tr>


                            <tr>
                                <th colspan="2">

                                </th>
                                <th>
                                    <button class="btn pi-btn-small btn-info pull-right" type="button" ng-click="updateContact()">Update</button>
                                </th>

                            </tr>

                            </thead>
                        </table>
                    </form>


                </div>
            </div>
            <!-- End tabs -->

        </div>
    </div>

    <!-- - - - - - - - - - END SECTION - - - - - - - - - -->

    <!-- - - - - - - - - - SECTION - - - - - - - - - -->
    <div class="pi-section-w pi-shadow-inside-top pi-section-base" style="background:#e6e6e6;">
        <div class="pi-texture" style="background: url(img/hexagon.png) repeat;"></div>
        <div class="pi-section pi-padding-top-60 pi-padding-bottom-40 pi-text-center">

            <p class="lead-30">
                <span class="pi-text-white" style="color:#232323!important;">Have a project with us? <span class="pi-weight-400" style="color:#59b900;">Feel free.</span></span>

                <a href="#" class="btn pi-btn-base-2 pi-btn-big" style="margin-left: 25px;">Post A Job !<i class="icon-paper-plane pi-icon-right"></i></a>
            </p>

        </div>
    </div>



    @stop

