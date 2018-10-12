@extends('templates.default.default')





@section('content')



<script type="text/javascript">

    var job_post = {{$job_post}};

    var select_skills = {{$select_skills}};

    var requested_freelancer = {{$requested_freelancer}};



    var clients = {{$clients}};

    var authenticateUserInfo = {{$authenticateUserInfo}};



    var job_prices = {{$job_prices}};

    var skills = {{$skills}};



</script>

<script type="text/javascript" src="{{$theme}}js/custom/common/common.js"></script>

<script type="text/javascript" src="{{$theme}}js/custom/job/jobcontroller.js"></script>



<!-- Breadcrumbs -->

<div ng-app="jobPostApp" ng-controller="jobViewController" >

    <div class="pi-section-w pi-border-bottom pi-section-grey">

        <div class="pi-section pi-titlebar pi-breadcrumb-only">

            <div class="pi-breadcrumb">

                <ul>

                    <li><a href="{{url('/')}}">Home</a></li>

                    <li><a href="{{url(strtolower($authenticateUserInfo['user_type']))}}">Overview</a></li>

                    <li>{{$job_post->title}}</li>

                </ul>

            </div>

        </div>

    </div>

<!-- End breadcrumbs -->





<!-- - - - - - - - - - SECTION - - - - - - - - - -->

    <div class="pi-section-w pi-section-white pi-slider-enabled piSocials" >

        <div class="pi-section pi-padding-bottom-30">

<!-- Openings -->

            <div class="pi-tabs-vertical pi-responsive-sm" ng-cloak>



                        <ul class="pi-tabs-navigation pi-tabs-navigation-transparent profile-po" id="myTabs">

                            {{Theme::make('partial.menu',array())}}





                        <li class="pi-no-padding">

                            <span class="snapshot pi-no-margin-top">

                                <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">

                                    <tbody>

                                    <tr>

                                        <td class="pi-active">

                                            <i class="pi-no-margin-top">

                                                <a class="ng-binding pi-no-padding pi-no-border" style="text-transform:uppercase; margin-bottom: 5px;">@{{job_post.client.first_name}}

                                                    @{{job_post.client.last_name}}

                                                </a>

                                                <span>@{{job_post.client.country}} (UTC+05)</span>

                                                <br>

                                                <span>Member Since @{{formatDate(job_post.client.created_at) | dateFormat}}</span>

                                            </i>

                                        </td>

                                    </tr>

                                    <tr>

                                        <td>

                                            <span class="part11">{{Translate::get("Total Spent",$lang)}}</span>

                                            <span class="part22">${{$total_amount}}</span>

                                        </td>

                                    </tr>



                                    <tr>

                                        <td>

                                            <span class="part11">{{Translate::get("Hours Billed",$lang)}}</span>

                                            <span class="part22">0 hr</span>

                                        </td>

                                    </tr>

                                    <tr>

                                        <td>

                                            <span class="part11">{{Translate::get("Hires",$lang)}}</span>

                                            <span class="part22">0</span>

                                        </td>

                                    </tr>

                                    <tr>

                                        <td>

                                            <span class="part11">{{Translate::get("Jobs Posted",$lang)}}</span>

                                            <span class="part22">{{$total_job}}</span>

                                        </td>

                                    </tr>

                                    <tr>

                                        <td>

                                            <span class="part11">{{Translate::get("Jobs Progress",$lang)}}</span>

                                            <span class="part22">{{$total_progress_job}}</span>

                                        </td>

                                    </tr>

                                    <tr>

                                        <td>

                                            <span class="part11">{{Translate::get("Jobs Completed",$lang)}}</span>

                                            <span class="part22">{{$total_completed_job}}</span>

                                        </td>

                                    </tr>

                                    <tr>

                                        <td colspan="2" align="center">

                                            <a href="{{url('/view/client')}}/{{$client_code}}" class="btn btn-po pi-btn-grey pi-btn-small">{{Translate::get("View Client Profile",$lang)}}</a>

                                        </td>

                                    </tr>

                                    </tbody>

                                </table>

                            </span>

                        </li>

                    <li class="pi-no-padding"><span class="snapshot pi-no-margin-top">

                            <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">

                                <tbody>

                                <tr>

                                    <td class="pi-active">

                                        <i class="pi-no-margin-top">{{Translate::get("Job Overview",$lang)}}</i>

                                    </td>

                                </tr>

                                <tr>

                                    <td>

                                        <span class="part11" style="width:50%;">{{Translate::get("Category",$lang)}}</span>

                                        <span class="part22" style="width:50%;"><a class="pi-no-padding pi-no-border" href="#">@{{job_post.job_category.title}}</a></span></td>

                                </tr>

                                <tr>

                                    <td>

                                        <span class="part11" style="width:50%;">{{Translate::get("Status",$lang)}}</span>

                                        <span class="part22" style="width:50%;"><a class="pi-no-padding pi-no-border" href="#">@{{job_post.job_status}}</a></span></td>

                                </tr>

                                </tbody>

                            </table>



                                    </span></li>



                        </ul>

                <div class="pi-tabs-content pi-tabs-content-transparent" style="min-height: 1px;">



                    <div class="pi-section-w pi-shadow-inside-top pi-section-grey pi-margin-bottom-25">

                        <div style="background: url({{$theme}}img/hexagon.png) repeat;" class="pi-texture"></div>

                        <div style="padding:15px 25px;"

                             class="pi-section pi-section-md pi-titlebar pi-titlebar-breadcrumb-top pi-titlebar-small">

                            <h1 class="pi-margin-bottom-10">@{{job_post.title}}</h1>



                            <div class="pi-breadcrumb">

                                <ul style="margin:0px;padding-left:0;" class="oInlineListExt">

                                    <li><strong>@{{job_post.job_category.title}} -</strong> <b>Est. Budget: ${{$job_total_amount}} -</b> <b>Est. Hour: {{$job_total_hour}} -</b>

                                        <i>Posted @{{formatDate(job_post.created_at) | timeAgo}}</i></li>

                                </ul>

                            </div>

                            @if(!empty($authenticateUserInfo) && ($authenticateUserInfo->user_id == $job_post->client_id ||

                            $authenticateUserInfo->user_type == 'Admin'))

                            <a href="#" ng-click="editJobPostFlag=1" class="btn pi-btn-lime">{{Translate::get("Edit",$lang)}}</a>

                            @endif

                        </div>

                    </div>



                    <div id="edit_job" class="col-lg-12 pi-no-padding" ng-show="editJobPostFlag">

                        <div ng-model="errorMsg" ng-if="errorMsg" class="pi-alert-danger">

                            <button data-dismiss="alert" class="pi-close" type="button">

                                <i class="icon-cancel"></i>

                            </button>

                            <p>

                                <strong><a id="top">Warning!</a></strong>

                            <ul>

                                <li ng-repeat="em in errorMsg">@{{em[0]}}</li>

                            </ul>

                            </p>

                        </div>



                        <form id="jobPostFrm" ng-submit="updateJobPost()" name="jobPostFrm" method="post">



                            <input type="hidden" ng-model="form._token" value="<?php echo Form::tokenCode(); ?>"/>



                            @if($authenticateUserInfo->user_type == 'Admin')

                            <div class="form-group job-category-selection">

                                <label for="client_id" class="col-lg-12 pi-no-padding">{{Translate::get("Client",$lang)}}: </label>

                                <div class="col-lg-12 pi-no-padding">

                                    <select name="client_id" ng-model="form.client_id" ui-select2 class="">

                                        <option value="" >---Select Client---</option>

                                        <option ng-repeat="client in clients" value="@{{client.id}}" >@{{client.first_name}} @{{client.last_name}}</option>

                                    </select>

                                </div>

                            </div>

                            <div class="clearfix"></div>

                            <hr class="pi-divider-gap-10">

                            @endif

                            <div class="form-group">

                                <label for="title" class="col-lg-12 pi-no-padding">{{Translate::get("Title",$lang)}}* </label>



                                <div class="col-lg-12 pi-no-padding">

                                    <div class="pi-input-with-icon">

                                        <div class="pi-input-icon">

                                            <i class="icon-pencil"></i>

                                        </div>

                                        <input type="text" name="title" class="form-control" ng-model="form.title"

                                               placeholder="Job Title">

                                    </div>

                                </div>

                            </div>

                            <div class="clearfix"></div>

                            <hr class="pi-divider-gap-10">

                            <div class="form-group">

                                <label class="col-lg-12 pi-no-padding">{{Translate::get("Description",$lang)}}* </label>



                                <div class="col-lg-12 pi-no-padding">

                                    <div class="pi-input-with-icon">

                                        <div class="pi-input-icon">

                                            <i class="icon-pencil"></i>

                                        </div>

                                        <textarea rows="8" placeholder="Description" id="description" name="description"

                                                  ng-model="form.description" class="form-control"></textarea>

                                    </div>

                                </div>

                            </div>

                            <div class="clearfix"></div>

                            <hr class="pi-divider-gap-10">

                            <?php if(!empty($authenticateUserInfo) && $authenticateUserInfo->user_type == 'Client'){ ?>

                                <div class="form-group" ng-if="form.job_status=='Progress' || form.job_status=='Completed'">

                                    <label class="col-lg-12 pi-no-padding">{{Translate::get("Status",$lang)}}: * </label>

                                    <div class="col-lg-12 pi-no-padding">

                                        <div class="pi-input-with-icon">

                                            <select ng-model="form.job_status" class="form-control">

                                                <option value="Progress">Progress</option>

                                                <option value="Completed">Complete</option>

                                            </select>

                                        </div>

                                    </div>

                                </div>

                                <div class="clearfix"></div>

                                <hr class="pi-divider-gap-10">

                            <?php }elseif(!empty($authenticateUserInfo) && $authenticateUserInfo->user_type == 'Admin'){ ?>

                                <div class="form-group" ng-if="form.job_status=='Progress' || form.job_status=='Completed'">

                                    <label class="col-lg-12 pi-no-padding">{{Translate::get("Status",$lang)}}: * </label>

                                    <div class="col-lg-12 pi-no-padding">

                                        <div class="pi-input-with-icon">

                                            <select ng-model="form.job_status" class="form-control">

                                                <option value="Pending">Pending</option>

                                                <option value="Approved">Approve</option>

                                                <option value="Progress">Progress</option>

                                                <option value="Completed">Complete</option>

                                                <option value="Canceled">Cancel</option>

                                            </select>

                                        </div>

                                    </div>

                                </div>

                                <div class="clearfix"></div>

                                <hr class="pi-divider-gap-10">

                            <?php } ?>

<!--                            <div class="clearfix"></div>-->

<!--                            <hr class="pi-divider-gap-10">-->

<!--                            <div class="form-group">-->

<!--                                <label for="title" class="col-lg-12 pi-no-padding">Total Hour: * </label>-->

<!---->

<!--                                <div class="col-lg-12 pi-no-padding">-->

<!--                                    <div class="pi-input-with-icon">-->

<!--                                        <div class="pi-input-icon">-->

<!--                                            <i class="icon-pencil"></i>-->

<!--                                        </div>-->

<!--                                        <input type="text" name="title" class="form-control" ng-model="form.hour"-->

<!--                                               placeholder="Total Hour">-->

<!--                                    </div>-->

<!--                                </div>-->

<!--                            </div>-->

                            <div class="clearfix"></div>

                            <hr class="pi-divider-gap-30">

                            <!-- Submit button -->

                            <p class="pi-col-xs-12 pi-no-padding">

                                <span class="btn pi-btn-red pi-btn pull-right" ng-click="editJobPostFlag=0" style="cursor:pointer;">{{Translate::get("Cancel",$lang)}}</span>

                                <button ng-show="jobPostSaveButtonFlag" type="submit"

                                        class="btn pi-btn-green pi-btn-same pi-uppercase pi-weight-700 pi-letter-spacing pull-right pi-margin-right-10">

                                    <i class="icon-check pi-icon-left"></i>{{Translate::get("Save",$lang)}}

                                </button>

                                <img ng-show="jobPostLoadingFlag" src="{{$theme}}/img/49.gif" class="pull-right" />

                            </p>

                        </form>



                    </div>



                    <div class="job-list-view">

                        <h4>{{Translate::get("Job Description",$lang)}}</h4>



                        <p>{{$job_post->description}}</p>



                        <ul class="cat-link clearFix padding-left-0">

                            <li ng-repeat="jrt in job_post.related_tags"><a class="" href="#">@{{jrt.name}}</a></li>

                        </ul>



                        <div class="clearfix"></div>

                        <div >

                            <label for="attachment" class="col-lg-12 pi-no-padding">{{Translate::get("Attachment",$lang)}}: </label>



                            <div class="col-lg-12 pi-no-padding">

                                <div class="pi-input-with-icon">

                                    <ul class="pi-bullets-square pi-bullets-contur-dark pi-bullets">

                                        <li ng-repeat="(af_index,af) in job_post.attach_file">

                                            <span class="pi-bullet-icon">

                                                <i class="icon-link"></i>

                                            </span>

                                            <a href="{{url('jobPost/file-download')}}/@{{af}}">@{{af}} </a><span

                                                ng-click="deleteFile(af_index)" class="glyphicon glyphicon-remove-circle" style="cursor:pointer;"></span>

                                        </li>

                                    </ul>

                                </div>

                            </div>

                        </div>

                        <div class="clearfix"></div>

                        <br/>



                        <div id="middle" class="btn-group pull-right">

                            <button type="button" class="btn btn-primary pi-btn-base dropdown-toggle" data-toggle="dropdown">

                                {{Translate::get("Action",$lang)}} <span class="caret"></span>

                            </button>

                            <ul class="dropdown-menu" role="menu">

                                <li><a href="#" ng-click="fileUploadFlag=1;jobOfferListFlag=0;newJobOffer=0;">{{Translate::get("Upload File",$lang)}}</a></li>

                                <li><a href="#" ng-click="jobOfferListFlag=1;newJobOffer=0;fileUploadFlag=0;">{{Translate::get("Job Offer List",$lang)}}</a></li>

                                <li><a href="#" ng-click="showNewJobOffer()">{{Translate::get("New Job Offer",$lang)}}</a></li>

<!--                                <li><a href="#" ng-click="newJobOffer=1;fileUploadFlag=0;jobOfferListFlag=0;">Requested freelancer</a></li>-->

                            </ul>

                        </div>

                    </div>





                    <div id="middle-content">



                        @if(!empty($authenticateUserInfo) && ($authenticateUserInfo->user_id == $job_post->client_id ||

                        $authenticateUserInfo->user_type == 'Admin'))

                        <div class="pi-col-sm-12" ng-show="fileUploadFlag">

                            <div nv-file-drop="" uploader="uploader">

                                <div ng-show="uploader.isHTML5">

                                    <!-- 3. nv-file-over uploader="link" over-class="className" -->

                                    <div class="well my-drop-zone" nv-file-over="" uploader="uploader">

                                        {{Translate::get("Base drop zone",$lang)}}

                                    </div>

                                </div>

                            </div>



                            <div class="pi-input-with-icon">

                                <!--<input type="file" ng-file-select="onFileSelect($files)" accept="image/*">-->

                                <input type="file" nv-file-select="" uploader="uploader" accept="image/*"/>

                            </div>

                            <div>

                                {{Translate::get("Upload Progress",$lang)}}:

                                <div class="progress" style="">

                                    <div class="progress-bar" role="progressbar" ng-style="{ 'width': uploader.progress + '%' }"></div>

                                </div>

                            </div>

                            <div class="clearfix"></div>

                            <span class="btn pi-btn-red pi-btn-small pull-right " ng-click="fileUploadFlag=0;jobOfferListFlag=1;" style="cursor:pointer;">{{Translate::get("Cancel",$lang)}}</span>

                        </div>

                        @endif



                        <div ng-show="newJobOffer">

                            {{Theme::make('partial.new-job-offer',array())}}

<!--                            <span class="btn pi-btn-red pi-btn-small pull-right " ng-click="newJobOffer=0" style="cursor:pointer;">{{Translate::get("Back",$lang)}}</span>-->

                        </div>

                        <div ng-show="jobOfferListFlag">

                            {{Theme::make('partial.job-offer',array('job_post'=>$job_post))}}

<!--                            <span class="btn pi-btn-red pi-btn-small pull-right " ng-click="jobOfferListFlag=0" style="cursor:pointer;">Back</span>-->

                        </div>

                    </div>



                </div>



            </div>

<!-- End tabs -->



        </div>

    </div>

<!-- - - - - - - - - - END SECTION - - - - - - - - - -->

</div>

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


<script type="text/javascript">
 $(function(){
        $('textarea#description').trumbowyg({fullscreenable: false});
        $('textarea#jo_description').trumbowyg({fullscreenable: false});
    });
</script>
@stop