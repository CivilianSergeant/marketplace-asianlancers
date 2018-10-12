@extends('templates.default.default')



@section('content')



<script type="text/javascript">

    var authenticateUserInfo="";

    @if(!empty($authenticateUserInfo))



        var authenticateUserInfo = {{$authenticateUserInfo}};

    @endif





    var clients = {{$client}};

    var job_post = {{$job_post}};



    var select_skills = {{$select_skills}};

    var job_prices = {{$job_prices}};

    var skills = {{$skills}};









</script>



<script type="text/javascript" src="{{$theme}}js/custom/view/jobcontroller.js"></script>

<!-- Breadcrumbs -->



<div class="pi-section-w pi-border-bottom pi-section-grey">

    <div class="pi-section pi-titlebar pi-breadcrumb-only">

        <div class="pi-breadcrumb">

            <ul>

                <li><a href="{{url('/')}}">Home</a></li>

                <li><a href="{{url('search/jobs/'.Request::segment(3))}}">Search</a></li>

                <li>Jobs</li>

            </ul>

        </div>

    </div>

</div>

<!-- End breadcrumbs -->

<!-- - - - - - - - - - SECTION - - - - - - - - - -->



<div class="pi-section-w pi-section-white pi-slider-enabled piSocials">

<div class="pi-section pi-padding-bottom-30">

{{Helpers::showMessage()}}



@if(!empty($job))

<!-- Openings -->

<div class="pi-tabs-vertical pi-responsive-sm" ng-app="jobViewApp" ng-controller="jobViewController" ng-cloak>

<ul class="pi-bullets-square pi-bullets pi-col-xs-3 pi-list-dashed" style="margin-top:0;">

    <li class="pi-no-padding">

                    <span class="snapshot pi-no-margin-top">

                    <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">

                        <tbody>

                        <tr>

                            <td class="pi-active">

                                <i class="pi-no-margin-top">

                                    <a style="text-transform:uppercase;">Client Name : @{{clients.first_name}}

                                        @{{clients.last_name}}</a><br/>

                                    <span class="star"></span>

                                    <span class="star"></span>

                                    <span class="star"></span>

                                    <span class="star"></span>

                                    <span class="star"></span>

                                    <br/><span>@{{clients.country}} (UTC+05)</span><br/><span>Member Since @{{formatDate(clients.created_at) | dateFormat}}</span>



                                </i>

                            </td>

                        </tr>

                        <tr>

                            <td>

                                <span class="part11">Total Spent</span>

                                <span class="part22">${{$total_amount}}</span></td>

                        </tr>

                        <tr>

                            <td>

                                <span class="part11">{{Translate::get("Hours Billed",$lang)}}</span>

                                <span class="part22">0 hr</span></td>

                        </tr>

                        <tr>

                            <td>

                                <span class="part11">{{Translate::get("Hires",$lang)}}</span>

                                <span class="part22">0</span></td>

                        </tr>

                        <tr>

                            <td>

                                <span class="part11">{{Translate::get("Jobs Posted",$lang)}}</span>

                                <span class="part22">{{$total_job}}</span></td>

                        </tr>

                        <tr>

                            <td>

                                <span class="part11">{{Translate::get("Jobs Progress",$lang)}}</span>

                                <span class="part22">{{$total_progress_job}}</span></td>

                        </tr>

                        <tr>

                            <td>

                                <span class="part11">{{Translate::get("Jobs Completed",$lang)}}</span>

                                <span class="part22">{{$total_completed_job}}</span></td>

                        </tr>

                        <tr>

                            <td align="center">

                                <a class="btn pi-btn-grey pi-btn-small" href="{{url('view/client/'.Helpers::EncodeDecode($job->client_id))}}">View Client Profile</a>

                            </td>

                        </tr>

                        </tbody>

                    </table>



                    </span>

    </li>

    <li class="pi-no-padding">

                    <span class="snapshot pi-no-margin-top">

                        <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">

                            <tbody>

                            <tr>

                                <td class="pi-active">

                                    <i class="pi-no-margin-top">{{Translate::get("Job Overview",$lang)}}</i>

                                </td>

                            </tr>

                            <tr>

                                <td>

                                    <span class="part11">{{Translate::get("Category",$lang)}}</span>

                                    <span class="part22"><a href="#">@{{job_post.job_category.title}}</a></span>

                                </td>

                            </tr>

                            <tr>

                                <td>

                                    <span class="part11">{{Translate::get("Status",$lang)}}</span>

                                    <span class="part22"><a href="#">@{{job_post.job_status}}</a></span>

                                </td>

                            </tr>

                            </tbody>

                        </table>

                    </span>

    </li>

</ul>

<div class="pi-tabs-content pi-tabs-content-transparent">



<!-- Tab content -->

<div>

<div class="pi-row">

<div class="pi-section-w pi-shadow-inside-top pi-section-grey pi-margin-bottom-25">

    <div class="pi-texture" style="background: url({{$theme}}img/hexagon.png) repeat;"></div>

    <div class="pi-section pi-section-md pi-titlebar pi-titlebar-breadcrumb-top pi-titlebar-small" style="padding:15px 25px;">

        <h1 class="pi-margin-bottom-10">{{$job->title}}</h1>

        <div class="pi-breadcrumb">

            <ul class="oInlineListExt" style="margin:0px;padding-left:0;">

                <ul style="margin:0px;padding-left:0;" class="oInlineListExt">

                    <li>

                        <strong>@{{job_post.job_category.title}} -</strong>

                        <b>Est. Budget: ${{$job_total_amount}} -</b>

                        <b>Est. Hour: {{$job_total_hour}} -</b>

                        <i>Posted @{{formatDate(job_post.created_at) | timeAgo}}</i>

                    </li>

                </ul>

            </ul>

        </div>

        <!--<a class="btn pi-btn-lime" href="#">Post a job like this</a>-->

    </div>

</div>

<div class="job-list-view pi-col-lg-12 pi-no-padding-left">

<h4>Job Description</h4>

{{$job->description}}

<ul class="cat-link clearFix pi-no-padding-left">

    <li ng-repeat="jrt in job_post.related_tags"><a class="" href="#">@{{jrt.name}}</a></li>

</ul>

@if($_SERVER['SERVER_NAME']===FREELANCER_DOMAIN)



@if(count($user) && $user->user_type == 'Freelancer')

    @if(!count($jobrequest))

        @if(!count($jobInvitation))

            <form action="{{url('job-apply')}}" method="POST">

                <input type="hidden" name="rurl" value="{{Request::url()}}"/>

                <input type="hidden" name="id" value="{{$user->id}}"/>

                <input type="hidden" name="fid" value="{{$user->user_id}}"/>

                <input type="hidden" name="jid" value="{{$job->job_id}}"/>

                <input type="hidden" name="jcid" value="{{$job->category_id}}"/>



                <button type="submit" class="btn pi-btn-green">Apply</button>

            </form>

        @else

            <div>

                <a  class="btn pi-btn-orange disabled" disabled>You already have invitaion</a>

            </div>

        @endif

    @else

        @if($jobrequest->request_status == 'Requested')

        <div>

            <a  class="btn pi-btn-green disabled" disabled>Already Applied</a>

        </div>

        @elseif($jobrequest->request_status == 'Approved')

        <div>

            <a class="btn pi-btn-green disabled" disabled>Verified By Djit Waiting for Client Review</a>

        </div>

        @elseif($jobrequest->request_status == 'Declined')

        <div>

            <a class="btn pi-btn-red disabled" disabled>Client Declined your request</a>

        </div>

        @elseif($jobrequest->request_status == 'Canceled')

        <div>

            <a class="btn pi-btn-red disabled" disabled>Admin Canceled your request</a>

        </div>

        @endif

    @endif

@else

    <form action="{{url('job-apply')}}" method="POST">

        <input type="hidden" name="rurl" value="{{Request::url()}}"/>

        <button type="submit" class="btn pi-btn-green">Apply</button>

    </form>

@endif



@endif



@if(!empty($authenticateUserInfo) && count($my_offer_exists)>0)

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

                    <a href="{{url('freelancer/file-download')}}/@{{af}}">@{{af}} </a>

                </li>

            </ul>

        </div>

    </div>

</div>

<div class="clearfix"></div>







@endif



</div>

</div>

</div>

</div>

</div>

@endif

</div>

</div>

{{Theme::make('search.partial.partial')}}

@stop