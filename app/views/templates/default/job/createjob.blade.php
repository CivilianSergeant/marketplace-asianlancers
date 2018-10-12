@extends('templates.default.default')


@section('content')

<script type="text/javascript">
    var job_categories = {{$job_categories}};
    var job_prices = {{$job_prices}};
    var skills = {{$skills}};
    var clients = {{$clients}};
    var token = "<?php echo Form::tokenCode(); ?>";
    var fl_key = [];
</script>
<!--<script type="text/javascript" src="{{$theme}}js/custom/common/common.js"></script>-->
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
                {{Theme::make('partial.menu',array())}}
            </ul>
            <div class="pi-tabs-content pi-tabs-content-transparent" >
                <div ng-controller="addJobController" ng-app="jobPostApp" ng-init="init()" ng-cloak>
                    <div class="pi-row">
                        <div class="pi-col-xs-12">

                            <h4 class="pi-has-bg pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25"> Create Job </h4>
                            <hr class="pi-divider-gap-10">
<?php /*
                            @if(is_array($error_msg) && !empty($error_msg))
                            <div class="pi-alert-danger">
                                <button data-dismiss="alert" class="pi-close" type="button">
                                    <i class="icon-cancel"></i>
                                </button>
                                <p>
                                    <strong><a id="top">Warning!</a></strong>
                                    @foreach($error_msg as $field)
                                        <ul>
                                            @foreach($field as $msg)
                                                <li>{{$msg}}</li>
                                            @endforeach
                                        </ul>
                                    @endforeach
                                </p>
                            </div>
                            @endif
*/ ?>
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
                            <!--<form id="jobPostFrm" action="{{url('jobPost/create-job')}}" name="jobPostFrm" method="post" enctype="multipart/form-data">-->
							<form id="jobPostFrm" ng-submit="addJobPost()" name="jobPostFrm" method="post" >
                                <div class="form-group job-category-selection">
                                    <label for="job_category_id" class="col-lg-3">Job Category: </label>
                                    <div class="col-lg-4">
                                        <label>@{{job_category.title}}</label>
                                        <?php /*<select name="job_category_id" ng-model="form.job_category_id" class="form-control">
                                            <option value="">---Select Job Category---</option>

                                            <option ng-repeat="jc in job_categories" value="@{{jc.id}}" ng-selected="jc.id==job_category.id">@{{jc.title}}</option>
                                        </select> */ ?>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr class="pi-divider-gap-10">
                                @if($authenticateUserInfo->user_type == 'Admin')
                                <div class="form-group job-category-selection">
                                    <label for="client_id" class="col-lg-3">Client: </label>
                                    <div class="col-lg-4">
                                       <select name="client_id" ng-model="form.client_id" ui-select2 class="">
                                            <option value="">---Select Client---</option>
                                            <option ng-repeat="client in clients" value="@{{client.id}}" >@{{client.first_name}} @{{client.last_name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr class="pi-divider-gap-10">
                                @endif
                                <div class="pi-col-xs-12 pi-no-padding">
                                    <div class="form-group">
                                        <label class="col-lg-3">Skills:</label>
                                        <div class="col-lg-9">
                                            <!--<select style="width:300px" ui-select2 ng-model="form.skill_tags" name="skill_tag[]" data-placeholder="Pick a skills" multiple>
                                                <option ng-repeat="skill in skills" value="@{{skill.id}}">@{{skill.category_name}}</option>
                                            </select>-->
                                            <input id="skill_tags_id" placeholder="Skill Required" required type="hidden" style="width: 100%;" ui-select2="multiSkillSelection" ng-model="tmp_skill_tag"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr class="pi-divider-gap-10">
                                <div class="pi-col-xs-12 pi-no-padding ">
                                    <div class="form-group">
                                        <label  class="col-lg-3">Prices:</label>
                                        <div class="col-lg-9">
                                            <!--<select style="width:300px" ui-select2 ng-model="form.job_price" data-placeholder="Pick a Prices" multiple>
                                                <option ng-repeat="jp in job_prices" value="@{{jp.id}}">@{{jp.title}}</option>
                                            </select>-->
                                            <input id="freelancer_price" type="hidden" placeholder="Hourly Price Required" required style="width: 100%;" ui-select2="multiPriceSelection" ng-model="tmp_freelancer_price"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr class="pi-divider-gap-10">
                                <div class="form-group">
                                    <label for="freelancers" class="col-lg-3">Selected Freelancers: </label>
                                    <div class="col-lg-9">
                                        <ul class="oInlineListExtNew col-lg-7">
                                            <li ng-repeat="sf_lancer in selected_freelancers">
<!--                                                <div ng-if="haveFreelancer(sf_lancer.fid)">-->
                                                    @{{sf_lancer.fname}}&nbsp;@{{sf_lancer.lname}}&nbsp;($@{{sf_lancer.freelancer_price}})
                                                    <a href="#" ng-click="removeFreelancer($index)" class="glyphicon glyphicon-remove-circle" ></a>
<!--                                                </div>-->
                                            </li>
                                        </ul>

                                        <a ng-show="cancelButtonFlag" class="btn pi-btn-red pi-btn-small pull-right pi-margin-left-10" ng-click="resetFreelancerList()" style="float:right; z-index:8; position:relative;" href="#">Cancel</a>
                                        <a id="find_again" class="btn pi-btn-blue pi-btn-small pull-right" ng-click="showFreelancerList(1)" style="z-index:8; position:relative;" href="#">Find Freelancer</a>
                                    </div>
                                    <?php /*
                                    <div ng-show="addFreelancerFlag">
                                        {{Theme::make('partial.freelancer-search-list',array('page'=>$page))}}
                                    </div>
                                    */ ?>

                                    <div id="ajaxContent"></div>

                                    <script type="text/javascript">
                                        var data = JSON.parse(localStorage.getItem('mySelection'));
                                        fl_key = data[0]['select_fl_key'];
                                    </script>

<!--                                    <div ng-show="loadingFlag" class="img-responsive" style="margin: 0 auto; text-align: center;">-->
                                    <div id="loadingFlag" class="img-responsive" style="margin: 0 auto; text-align: center; display: none;">
                                        <img src="{{$theme}}/img/45.gif" />
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <hr class="pi-divider-gap-10">
                                <div class="form-group">
                                    <label for="title" class="col-lg-3">Title: *</label>
                                    <div class="col-lg-9">
                                        <div class="pi-input-with-icon">
                                            <div class="pi-input-icon">
                                                <i class="icon-pencil"></i>
                                            </div>
                                            <input type="text" name="title" class="form-control" ng-model="form.title" placeholder="Job Title">
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr class="pi-divider-gap-10">
                                <div class="form-group">
                                    <label for="title" class="col-lg-3">Description: * </label>
                                    <div class="col-lg-9">
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
                                    <label for="title" class="col-lg-3">Total Hour: * </label>
                                    <div class="col-lg-3">
                                        <div class="pi-input-with-icon">
                                            <div class="pi-input-icon">
                                                <i class="icon-pencil"></i>
                                            </div>
                                            <input type="text" name="title" class="form-control" ng-model="form.hour" placeholder="Job Hour">
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="clearfix"></div>
                                <hr class="pi-divider-gap-10">
                                <div class="form-group">
                                    <label for="attachment" class="col-lg-2">Attachment: </label>
                                    <div class="col-lg-10">
                                        <div class="pi-input-with-icon">
                                            <input type="file" name="attach_file" multiple  >

                                        </div>
                                    </div>
                                </div>-->
                                <div class="clearfix"></div>
                                <hr class="pi-divider-gap-30">
                                <!-- Submit button -->
                                <p class="pi-col-xs-12" ng-show="saveButtonFlag">
                                    <button type="submit" class="btn pi-btn-small pi-btn-green pi-btn-same pi-uppercase pi-weight-700 pi-letter-spacing pull-right">
                                        <i class="icon-check pi-icon-left"></i>Save
                                    </button>
                                </p>
                                <p class="img-responsive pi-col-xs-12" style="margin: 0 auto; text-align: right;" ng-show="loadingSmallButtonFlag">
                                    <img src="{{$theme}}/img/49.gif" />
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