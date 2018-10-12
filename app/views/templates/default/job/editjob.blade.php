@extends('templates.default.default')


@section('content')

<script type="text/javascript">
    var job_categories = {{$job_categories}};
    var job_post = {{$job_post}};
    var skills = {{$skills}};
    var select_skills = {{$select_skills}};
    var token = "<?php echo Form::tokenCode(); ?>"
</script>
<script type="text/javascript" src="{{$theme}}js/custom/job/jobcontroller.js"></script>

<!-- Breadcrumbs -->

<div class="pi-section-w pi-border-bottom pi-section-grey">
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url(strtolower($authenticateUserInfo['user_type']))}}">Overview</a></li>
                <li>Create Job</li>
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
                {{Theme::make('partial',array())}}
            </ul>
            <div class="pi-tabs-content pi-tabs-content-transparent">
                <div ng-controller="editJobController" ng-app="jobPostApp">
                    <div class="pi-row">
                        <div class="pi-col-xs-12">

                            <h4 class="pi-has-bg pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25"> Edit Job </h4>
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

                            <hr class="pi-divider-gap-10">

                            <!-- Forms -->
                            <form id="jobPostFrm" ng-submit="updateJobPost()" name="jobPostFrm" method="post" enctype="multipart/form-data">
                                <div class="form-group job-category-selection">
                                    <label for="job_category_id" class="col-lg-2">Job Category* </label>
                                    <div class="col-lg-4">
                                        <select name="job_category_id" ng-model="form.job_category_id" class="form-control">
                                            <option value="">---Select Job Category---</option>
                                            <option ng-repeat="job_category in job_categories" ng-selected="job_category.id==form.job_category_id" value="@{{job_category.id}}">@{{job_category.title}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr class="pi-divider-gap-10">
                                <div class="form-group">
                                    <label for="job_category_id" class="col-lg-2">Skill* </label>
                                    <div class="col-lg-4">
<!--                                        <select style="width:300px" ui-select2 ng-model="form.skill_tag" data-placeholder="Pick a skill" multiple>-->
<!--                                            <option ng-repeat="skill in skills" value="@{{skill.id}}" >@{{skill.category_name}}</option>-->
<!--                                        </select>-->
                                        <input type="hidden" style="width:300px" ui-select2="multiSelection" ng-model="form.skill_tag"/>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr class="pi-divider-gap-10">
                                <div class="form-group">
                                    <label for="title" class="col-lg-2">Title* </label>
                                    <div class="col-lg-10">
                                        <div class="pi-input-with-icon">
                                            <div class="pi-input-icon">
                                                <i class="icon-pencil"></i>
                                            </div>
                                            <input type="text" name="title" class="form-control" ng-model="form.title"  placeholder="Job Title">
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr class="pi-divider-gap-10">
                                <div class="form-group">
                                    <label for="title" class="col-lg-2">Description* </label>
                                    <div class="col-lg-10">
                                        <div class="pi-input-with-icon">
                                            <div class="pi-input-icon">
                                                <i class="icon-pencil"></i>
                                            </div>
                                            <textarea rows="8" placeholder="Description" id="description" name="description" ng-model="form.description" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr class="pi-divider-gap-10">
                                <div class="form-group">
                                    <label for="attachment" class="col-lg-2">Attachment </label>
                                    <div class="col-lg-10">
                                        <div class="pi-input-with-icon">
                                            <input type="file" name="attach_file[]" ng-model="attach_file" ng-file-select="onFileSelect($files)"  multiple  >
                                            <ul class="pi-bullets-square pi-bullets-contur-dark pi-bullets">
                                                <li ng-repeat="afn in attach_file_name">
                                                    <span class="pi-bullet-icon">
                                                        <i class="icon-link"></i>
                                                    </span>
                                                    <a href="{{url('jobPost/file-download')}}/@{{afn}}">@{{afn}} </a><span ng-click="deleteFile($index)" style="cursor:pointer;">Delete</span>
													
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr class="pi-divider-gap-10">
                                <!-- Submit button -->
                                <p>
                                    <button type="submit"
                                            class="btn pi-btn-base pi-btn-big pi-uppercase pi-weight-700 pi-letter-spacing">
                                        <i class="icon-check pi-icon-left"></i>Save
                                    </button>
                                </p>
                            </form>

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