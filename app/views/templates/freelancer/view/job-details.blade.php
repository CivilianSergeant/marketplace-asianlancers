@extends('templates.freelancer.freelancer')

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
            <ul class="pi-tabs-navigation">
                <li class="pi-no-padding">
                    <span class="snapshot pi-no-margin-top">
                    <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
                        <tbody>
                            <tr>
                                <td class="pi-active">
                                    <i class="pi-no-margin-top">
                                        <a class="ng-binding pi-no-padding pi-no-border" style="text-transform:uppercase; margin-bottom: 5px;">@{{clients.first_name}}
                                            @{{clients.last_name}}</a><span style="margin-right:13px;vertical-align:text-top;">@{{clients.country}} (UTC+05)</span>
                                        <span class="star"></span>
                                        <span class="star"></span>
                                        <span class="star"></span>
                                        <span class="star"></span>
                                        <span class="star"></span>
                                        <br/><span>Member Since @{{formatDate(clients.created_at) | dateFormat}}</span>

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
                                    <a class="btn-po btn pi-btn-grey pi-btn-small" href="{{url('view/client/'.Helpers::EncodeDecode($job->client_id))}}">View Client Profile</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    </span>
                </li>
                <!--<li class="pi-no-padding">
                    <span class="snapshot pi-no-margin-top">
                        <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
                            <tbody>
                                <tr>
                                    <td class="pi-active">
                                        <i class="pi-no-margin-top" style="text-transform:uppercase;">{{Translate::get("Job Overview",$lang)}}</i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="part11" style="width:50%;">{{Translate::get("Category",$lang)}}</span>
                                        <span class="part22" style="width:50%;"><a class="pi-no-padding pi-no-border" href="#">@{{job_post.job_category.title}}</a></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="part11" style="width:50%;">{{Translate::get("Status",$lang)}}</span>
                                        <span class="part22" style="width:50%;"><a class="pi-no-padding pi-no-border" href="#">@{{job_post.job_status}}</a></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </span>
                </li>-->
            </ul>
            <div class="pi-tabs-content pi-tabs-content-transparent">


                        <div class="bs-docs-section" >
                        <div class="bs-example">
                            <a class="title ng-binding" href="">{{$job->title}}</a>
                            @if($_SERVER['SERVER_NAME']===FREELANCER_DOMAIN)

                                @if(count($user) && $user->user_type == 'Freelancer')
                                    @if(count($jobrequest))
                                        @if($jobrequest->request_status == JobRequest::$REQUESTED)
                                            <span style="position:absolute;right:15px; font-size:12px; top:10px;" class="pull-right pi-text-bg-green">Already Applied</span>
                                        @elseif($jobrequest->request_status == JobRequest::$APPROVED)
                                            <span style="position:absolute;right:15px; font-size:12px; top:10px;" class="pull-right pi-text-bg-yellow">Verified by DJIT, Waiting for Client</span>
                                        @elseif($jobrequest->request_status == JobRequest::$DECLINED)
                                            <span style="position:absolute;right:15px; font-size:12px; top:10px;" class="pull-right pi-alert-warning">Client declined your job request</span>
                                        @elseif($jobrequest->request_status == JobRequest::$CANCELED)
                                            <span style="position:absolute;right:15px; font-size:12px; top:10px;" class="pull-right pi-alert-danger">DJIT Canceled your job request</span>
                                        @endif
                                    @endif
                                    @if(count($jobInvitation))
                                        @if($jobInvitation->job_offer_status == JobOffer::$PENDING)
                                            <span style="position:absolute;right:15px; font-size:12px; top:10px;" class="pull-right pi-text-bg-orange">Waiting for DJIT approval</span>
                                        @elseif($jobInvitation->job_offer_status == JobOffer::$CANCELED)
                                            <span style="position:absolute;right:15px; font-size:12px; top:10px;" class="pull-right pi-text-bg-red">Job Offer Invitaion canceled by DJIT.</span>
                                        @elseif($jobInvitation->job_offer_status == JobOffer::$ACCEPTED)
                                            <span style="position:absolute;right:15px; font-size:12px; top:10px;" class="pull-right pi-text-bg-green">Job offer Accepted</span>
                                        @elseif($jobInvitation->job_offer_status == JobOffer::$COMPLETED)
                                            <span style="position:absolute;right:15px; font-size:12px; top:10px;" class="pull-right pi-text-bg-green">Job Offer Completed</span>
                                        @elseif($jobInvitation->job_offer_status == JobOffer::$PROGRESS)
                                            <span style="position:absolute;right:15px; font-size:12px; top:10px;" class="pull-right pi-text-bg-green">Job Offer Progressed</span>
                                        @elseif($jobInvitation->job_offer_status == JobOffer::$DECLINED)
                                            <span style="position:absolute;right:15px; font-size:12px; top:10px;" class="pull-right pi-text-bg-red">Job Offer Declined</span>
                                        @endif
                                    @endif
                                @endif
                            @endif

                            <ol class="breadcrumb">
                                <li class="active">
                                    <strong>@{{job_post.job_category.title}}</strong> -
                                    <b style="color:#090;">Est. Budget: $@{{job_post.amount}} </b> -
                                    <b>Est. Hour: @{{job_post.hour}} </b> -
                                  <i>Posted @{{formatDate(job_post.created_at) | timeAgo}}</i>
                                </li>
                            </ol>
                            <p>{{$job->description}}</p>
                        </div>
                        <div class="highlight">
                            <ul class="cat-link-new clearFix" style="padding-left:0; margin-bottom:0;">
                                <li ng-repeat="jrt in job_post.related_tags"><a class="">@{{jrt.name}}</a></li>
                            </ul>
                        </div>
                    </div>

                        <div class="pi-col-lg-12 pi-no-padding-right pi-no-padding-left">

                            @if($_SERVER['SERVER_NAME']===FREELANCER_DOMAIN)

                                @if(count($user) && $user->user_type == 'Freelancer')
                                    @if(!count($jobrequest))
                                        @if(!count($jobInvitation))
                                        <form action="{{url('job-apply')}}" class="pull-right" method="POST">
                                            <input type="hidden" name="rurl" value="{{Request::url()}}"/>
                                            <input type="hidden" name="id" value="{{$user->id}}"/>
                                            <input type="hidden" name="fid" value="{{$user->user_id}}"/>
                                            <input type="hidden" name="jid" value="{{$job->job_id}}"/>
                                            <input type="hidden" name="jcid" value="{{$job->category_id}}"/>

                                            <button type="submit" class="btn pi-btn-small pi-btn-green">Apply</button>
                                        </form>
                                        @else
                                            @if($jobInvitation->job_offer_status == JobOffer::$APPROVED)
                                                <form action="{{url('freelancer/update-job-invitation')}}" method="post">
                                                    <p class="pi-col-sm-1 pi-no-padding-left">
                                                        <input type="hidden" name="id" value="{{$jobInvitation->id}}"/>
                                                        <input type="hidden" name="job_offer_status" value="Accepted"/>

                                                        <input type="submit" class="btn pi-btn-green pi-btn-small" value="Accept"/>
                                                    </p>
                                                </form>
                                                <form action="{{url('freelancer/update-job-invitation')}}" method="post">
                                                    <p class="pi-col-sm-2">
                                                        <input type="hidden" name="id" value="{{$jobInvitation->id}}"/>
                                                        <input type="hidden" name="job_offer_status" value="Declined"/>

                                                        <input type="submit" class="btn pi-btn-red pi-btn-small" value="Decline"/>
                                                    </p>
                                                </form>
                                            @endif
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

                            <?php $printCount=0; ?>
                            @foreach($job_post->JobOffer as $jo_i=>$job_offer)
                                @if($authenticateUserInfo->user_id==$job_offer->freelancer_id && $authenticateUserInfo->user_type=='Freelancer')

                                    <accordion close-others="oneAtATime">
                                        <accordion-group is-open="status.open">
                                            <accordion-heading>
                                                <label>{{$job_offer->title}}&nbsp;-&nbsp;{{$job_offer->Freelancer->first_name}} {{$job_offer->Freelancer->last_name}}</label>
                                                <i class="pull-right glyphicon" ng-class="{'glyphicon-chevron-down': status.open, 'glyphicon-chevron-right': !status.open}"></i>
                                            </accordion-heading>

                                            <div class="pi-col-xs-12">

                                                    <p class="pi-col-xs-5 pi-no-padding"><span class="glyphicon glyphicon-user"></span>&nbsp;{{$job_offer->Freelancer->first_name}} {{$job_offer->Freelancer->last_name}}</p>
                                                    <p class="pi-col-xs-3 pi-no-padding pi-text-green"><span class="glyphicon glyphicon-ok"></span>&nbsp;{{$job_offer->job_offer_status}}</p>
                                                    <p class="pi-col-xs-2 pi-no-padding"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;{{$job_offer->job_offer_hour}}</p>
                                                    <p class="pi-col-xs-2 pi-no-padding"><span class="glyphicon glyphicon-usd"></span>&nbsp;{{$job_offer->job_offer_price}}</p>


                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="pi-col-xs-12">
                                                <div><p class="pi-no-margin-bottom"><strong>{{$job_offer->title}}</strong></p></div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div ng-if="checkPermission(index_jo)" class="pi-col-xs-12 pi-no-margin-top">
                                                <p>{{$job_offer->description}}</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr class="pi-divider-gap-10">

                                            @foreach($job_offer->JobPhase as $jo_ph_i=>$job_phase)
                                            <accordion close-others="oneAtATimePhase-{{$jo_ph_i}}">
                                                <accordion-group is-open="status.openPhase{{$jo_ph_i}}">
                                                    <accordion-heading>
                                                        {{$job_phase->phase_title}} <i class="pull-right glyphicon" ng-class="{'glyphicon-chevron-down': status.openPhase{{$jo_ph_i}}, 'glyphicon-chevron-right': !status.openPhase{{$jo_ph_i}}}"></i>
                                                    </accordion-heading>
                                                    <div class="pi-col-xs-12">
                                                        <div>
                                                            <p class="pi-col-xs-3 pi-no-padding"><span class="glyphicon glyphicon-calendar"></span> {{Helpers::dateTimeFormat('j F, Y', $job_phase->phase_start)}}</p>
                                                            <p class="pi-col-xs-3 pi-no-padding"><span class="glyphicon glyphicon-calendar"></span> {{Helpers::dateTimeFormat('j F, Y', $job_phase->phase_deadline)}}</p>
                                                            <p class="pi-col-xs-2 pi-no-padding"><span class="glyphicon glyphicon-ok"></span> {{$job_phase->phase_payment_status}}</p>
                                                            <p class="pi-col-xs-1 pi-no-padding"><span class="glyphicon glyphicon-dashboard"></span> {{$job_phase->phase_hour}}</p>
                                                            <p class="pi-col-xs-1 pi-no-padding"><span class="glyphicon glyphicon-usd"></span> {{$job_phase->phase_price}}</p>

                                                            @if($job_phase->phase_payment_status=='Pending')
                                                            <p class="pi-col-xs-2 pi-no-padding"><span class="btn pi-btn-green pi-btn-small pull-right" ng-click="phaseStatus('<?php echo $jo_i; ?>','<?php echo $jo_ph_i; ?>','Progress')" style="cursor:pointer;">Progress</span></p>
                                                            @elseif($job_phase->phase_payment_status=='Progress' || $job_phase->phase_payment_status=='Hold')
                                                            <p class="pi-col-xs-2 pi-no-padding"><span class="btn pi-btn-green pi-btn-small pull-right" ng-click="phaseStatus('<?php echo $jo_i; ?>','<?php echo $jo_ph_i; ?>','Done')" style="cursor:pointer;">Done</span></p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="pi-col-xs-12 pi-no-margin-top">
                                                        <p>{{$job_phase->phase_details}}</p>
                                                    </div>
                                                </accordion-group>
                                            </accordion>
                                            @endforeach
                                            <div class="clearfix"></div>
                                            <ul>
                                                <?php //@foreach($job_offer->Comments as $job_offer_comment) ?>
                                                <li ng-repeat="comment in job_post.job_offer[{{$jo_i}}].comments" style="list-style: none;" >
                                                    <div>
                                                        <p class="pi-col-xs-6 pi-no-padding pi-no-margin-bottom"><span class="glyphicon glyphicon-user"></span>&nbsp;@{{comment.honour.first_name}} @{{comment.honour.last_name}}</p>
                                                        <p class="pi-col-xs-6 pi-no-padding pi-no-margin-bottom pi-text-right"><span class="glyphicon glyphicon-dashboard"></span> @{{formatDate(comment.created_at) | dateFormat}}</p>
                                                        <div class="clearfix"></div>
                                                        <p class="pi-col-xs-12 pi-no-padding">  @{{comment.message}}</p>
                                                    </div>

<hr class="pi-divider" />

                                                </li>
                                                <?php //@endforeach ?>
                                            </ul>
                                            <div>
                                                <form id="jobOfferCommentFrm" name="jobOfferCommentFrm" method="post" >
                                                    <div class="pi-col-xs-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputName-3">{{Translate::get("Comment:",$lang)}}</label>
                                                        </div>
                                                    </div>
                                                    <div class="pi-col-xs-12">
                                                        <div class="form-group">
                                                            <div class="pi-input-with-icon">
                                                                <div class="pi-input-icon"><i class="icon-pencil"></i></div>
                                                                <textarea rows="3" placeholder="Type your text" ng-required="true" required ng-model="form.jobOfferComment.message" class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="pi-col-xs-12">
                                                        <div class="form-group">
                                                            <span class="btn pi-btn-green pi-btn-small pull-right" ng-click="addJobOfferComment({{$jo_i}})" style="cursor:pointer;">{{Translate::get("Reply",$lang)}}</span>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="clearfix"></div>
                                        </accordion-group>
                                    </accordion>
                                <?php /*@else
                                    <?php if($printCount==0){ ?>
                                        <h4>Others Freelancer</h4>
                                    <?php } $printCount++; ?>

                                    <div class="pi-img-w pi-img-round-corners pi-img-left pi-margin-top-5 pi-shadow-effect4" style="width:155px;">
                                        <!-- <img src="{{$theme}}img_external/team/1 (1).jpg" alt=""/>-->

                                        <div ng-switch on="{{$job_offer->Freelancer->freelancer_type}}" >
                                            <img ng-switch-when="Individual" src="{{CDN}}profile/freelancer/individual/{{$job_offer->Freelancer->photos}}" alt="{{$job_offer->Freelancer->first_name}} {{$job_offer->Freelancer->last_name}}"/>

                                            <img ng-switch-when="Agency" src="{{CDN}}profile/freelancer/agency/{{$job_offer->Freelancer->photos}}" alt="{{$job_offer->Freelancer->first_name}} {{$job_offer->Freelancer->last_name}}"/>

                                            <img src="{{CDN}}profile/leader-1.png" ng-switch-default alt=""/>
                                        </div>
                                    </div>
                                    <h3 class="h4 pi-margin-bottom-5">
                                        <a target="_blank" href="{{url('view/freelancer')}}/{{Helpers::EncodeDecode($job_offer->Freelancer->id)}}" class="pi-link-no-style" style="float: left;">
                                            {{$job_offer->Freelancer->first_name}} {{$job_offer->Freelancer->last_name}}
                                        </a>
                                    </h3>
                                    <br/><br/>
                                    <p class="pi-italic pi-text-base pi-margin-bottom-10">
                                        <img ng-show="{{$job_offer->Freelancer->verified}}" width="16" height="20" alt="0" src="{{$theme}}img/DJITVerified.png">
                                        {{$job_offer->Freelancer->profile_title}}
                                    </p>

                                    <p>{{$job_offer->Freelancer->overview}}</p>

                                    <ul class="oInlineListExt">
                                        <li ng-show="{{$job_offer->Freelancer->freelancer_price}}"><strong>${{$job_offer->Freelancer->freelancer_price}}</strong> HOURLY RATE</li>
                                        <li><span class="star"></span>
                                            <span class="star"></span>
                                            <span class="star"></span>
                                            <span class="star"></span>
                                            <span class="star"></span>
                                            <b>5.0</b>
                                        </li>
                                        <li><strong>0</strong> HOURS</li>
                                        <li><i class="icon-home"></i><strong> {{$job_offer->Freelancer->address_country}}</strong></li>
                                    </ul>
                                */ ?>
                                @endif
                            @endforeach

                            @endif

                        </div>

            </div>
        </div>
        @endif
    </div>
</div>
{{Theme::make('search.partial.partial')}}

@stop