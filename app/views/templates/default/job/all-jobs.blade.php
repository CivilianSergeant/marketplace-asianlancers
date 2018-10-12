@extends('templates.default.default')


@section('content')

<script type="text/javascript">
    var my_jobs = {{$my_jobs}};
</script>
<script type="text/javascript" src="{{$theme}}js/custom/job/jobcontroller.js"></script>

<!-- Breadcrumbs -->

<div class="pi-section-w pi-border-bottom pi-section-grey">
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url(strtolower($authenticateUserInfo['user_type']))}}">Overview</a></li>
                <li>All Jobs</li>
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
                <div ng-controller="myJobListController" ng-app="jobPostApp" ng-cloak>
                    <div class="pi-row">
                        <div class="pi-col-xs-12">

                            <h4 class="pi-has-bg pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25">
                                All Jobs
                                <a href="{{url('jobPost/new-job-create')}}" class="btn pi-btn-green pull-right" style="position: relative;">New Job</a>
                            </h4>
                            <hr class="pi-divider-gap-10">

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
                            @if(count($my_jobs))

                            <pagination
                                total-items="bigTotalItems"
                                ng-model="bigCurrentPage"
                                max-size="maxSize"
                                boundary-links="true"
                                rotate="false"
                                num-pages="numPages"
                                ng-change="pageChanged()">
                            </pagination>


                            <div style="border-left:none;">
                                <div class="bs-docs-section" ng-repeat="(mjIndex, my_job) in my_jobs">
                                    <div class="bs-example">
                                        <a href="{{url('jobPost/view')}}/@{{my_job.code}}" class="title">@{{my_job.title}}</a>
                                        <a class="btn pi-btn-blue pi-btn-small pull-right " style="margin: 3px;" ng-click="showAllPhase($index)" href="#">View All Phases</a>
                                        <ol class="breadcrumb">
                                            <li class="active">
                                                <strong>@{{my_job.job_category.title}} </strong> -
                                                <b style="color:#090;">Est. Budget: $@{{my_job.amount}} </b> -
                                                <b>Est. Hour: @{{my_job.hour}} </b> -
                                                <i >@{{formatDate($index) | timeAgo}} -</i>
                                                <i>@{{my_job.job_status}}</i>
                                            </li>
                                        </ol>
                                        <p>
                                            @{{wordPrint(my_job.description,200)}}
                                        </p>
                                    </div>
                                    <div class="highlight">
                                        <ul style="padding-left:0; margin-bottom:0;" class="cat-link-new clearFix">
                                            <li ng-repeat="jss in my_job.skills" class="ng-scope"><a class="ng-binding">@{{jss.name}}</a></li>
                                        </ul>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>

                            </div>

                            <pagination
                                total-items="bigTotalItems"
                                ng-model="bigCurrentPage"
                                max-size="maxSize"
                                boundary-links="true"
                                rotate="false"
                                num-pages="numPages"
                                ng-change="pageChanged()">
                            </pagination>
                            @else
                            <div class="bs-docs-section">
                                <div class="bs-example">
                                    <p class="no-jobs"></p>
                                </div>
                                <div class="highlight"></div>
                            </div>
                            @endif
                        </div>
                        <!-- End col 6 -->


                    </div>
                    <!-- End row -->
                </div>
                <!-- End tab content -->

            </div>
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