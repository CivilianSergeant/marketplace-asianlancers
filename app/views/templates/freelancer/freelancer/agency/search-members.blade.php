@extends('templates.freelancer.freelancer')

@section('content')
<script>
    var skills = {{$skills}}
    var members = {{$members}}
    var fl_key = [];
</script>
<script type="text/javascript" src="{{$theme}}js/custom/freelancer/members.js"></script>
<!-- Breadcrumbs -->

<div class="pi-section-w pi-border-bottom pi-section-grey">
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('freelancer/overview')}}">Overview</a></li>
                <li><a href="#">members</a></li>
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
            <div class="pi-tabs-content pi-tabs-content-transparent">

                <!-- Tab content -->
                <div ng-app="memberApp" ng-controller="memberController" ng-cloak>

                    <form id="searchAgencyMembersFrm" ng-submit="search()">
                    <div class="pi-row pi-no-margin pi-margin-bottom-20 col-lg-12 form-horizontal breadcrumb">
                        <h1 class="pi-margin-bottom-10">{{Translate::get("Search Freelancer",$lang)}}</h1>
                        <hr/>
                        <div class="form-group">
                            <label class="col-lg-3">{{Translate::get("Price",$lang)}}</label>
                            <div class="col-lg-3" style="padding-top:4px;">
                                <div ui-slider="slider.options" min="5" step="5" max="30" range="true" ng-model="form.freelancer_price"></div>
                            </div>
                            <div class="col-lg-2">
                                <input type="text"  class="form-control" style="width:60px;" readonly ng-model="form.freelancer_price[0]" />
                            </div>
                            <div class="col-lg-2">
                                <input type="text"  class="form-control" style="width:60px;" readonly ng-model="form.freelancer_price[1]" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3">{{Translate::get("Skills",$lang)}}</label>
                            <div class="col-lg-9">
                                <input type="hidden" style="width:300px" ui-select2="multiSkillSelection" ng-model="tmp_skill_tag"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-9">
                                <button id="find_again" type="submit" class="btn pi-btn-base">{{Translate::get("Search",$lang)}}</button>
                            </div>
                        </div>
                    </div>

                    </form>

                    <form id="sentRequestFrm" ng-submit="sentRequest()">
                        <div id="ajaxContent"></div>

                        <div id="loadingFlag" class="img-responsive" style="display: none; margin: 0 auto; text-align: center;">
                            <img src="{{$theme}}img/45.gif" />
                        </div>
                    <?php /*
                    <div class="freelancers_lists" ng-repeat="freelancer in freelancers">
                        <div ng-if="freelancer.photos" class="pi-img-w pi-img-round-corners pi-img-left pi-margin-top-5 pi-shadow-effect4" style="width:155px;">
                            <div ng-switch on="freelancer.freelancer_type" >
                                <img ng-switch-when="Individual" src="{{CDN}}profile/freelancer/individual/@{{freelancer.photos}}" alt="@{{freelancer.fname}} @{{freelancer.lname}}"/>

                                <img ng-switch-when="Agency" src="{{CDN}}profile/freelancer/agency/@{{freelancer.photos}}" alt="@{{freelancer.fname}} @{{freelancer.lname}}"/>

                                <img src="{{CDN}}profile/leader-1.png" ng-switch-default alt=""/>
                            </div>
                        </div>
                        <div ng-if="checkPhotos($index)" class="pi-img-w pi-img-round-corners pi-img-left pi-margin-top-5 pi-shadow-effect4" style="width:155px;">
                            <img src="{{CDN}}profile/male-female.jpg" alt="@{{freelancer.fname}} @{{freelancer.lname}}"/>
                        </div>
                        <h3 class="h4 pi-margin-bottom-5">
                            <a target="_blank" href="{{url('view/freelancer')}}/@{{freelancer.code}}" class="pi-link-no-style" style="float: left;">
                                @{{freelancer.fname}} @{{freelancer.lname}} |
                            </a>
                            <i ng-show="@{{freelancer.available}}" class="avai" style="float: left;">
                                <img width="15" height="15" alt="available" src="{{$theme}}img/available.png">
                                Available |
                            </i>
                            <i ng-show="@{{freelancer.available}}==0" class="avai" style="float: left;">
                                <img width="15" height="15" alt="available" src="{{$theme}}img/no-available.png"> No Available |
                            </i>
                            <i class="rank-icon" style="float: left;">0</i>

                            <span class="select-box">
                                Select&nbsp;
                                <input style="margin: 7px 0 0" ng-show="@{{freelancer.available}}" class="pull-right" id="@{{freelancer.code}}" type="checkbox" value="@{{freelancer.code}}" ng-checked="form.selectFl.indexOf(freelancer.code) > -1" ng-click="toggleSelection(freelancer.code,$index)" />
                            </span>
                        </h3>
                        <br/><br/>
                            <p>@{{freelancer.overview}}</p>

                            <ul class="oInlineListExt">
                                <li ng-show="@{{freelancer.freelancer_price}}"><strong>$@{{freelancer.freelancer_price}}</strong> HOURLY RATE</li>
                                <li ng-bind-html="feedBackPrint(myHTML,$index)"></li>
                                <li><strong>0</strong> HOURS</li>
                                <li><i class="icon-home"></i><strong> @{{freelancer.address_country}}</strong></li>
                                <li><strong>@{{testTaken(freelancer)}}</strong> TESTS</li>
                                <li><strong>@{{freelancer.portfolio_item}}</strong> PORTFOLIO ITEM</li>
                                <li><strong>@{{formatDate($index) | dateFormat}}</strong> LAST ACTIVE</li>
                            </ul>

                        <ul class="cat-link clearFix" style="padding-left:0;">
                            <li ng-repeat="fs in freelancer.skills"><a class="" href="#">@{{fs.category_name}}</a></li>

                        </ul>

                            <hr class="pi-divider pi-divider-dashed clearfix">

                    </div>
                    */ ?>

                    </form>
                    <div ng-model="msg" ng-if="msg" class="pi-alert-success">
                        <button data-dismiss="alert" class="pi-close" type="button">
                            <i class="icon-cancel"></i>
                        </button>
                        <p>@{{msg}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop