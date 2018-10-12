@extends('templates.freelancer.freelancer')


@section('content')
<script type="text/javascript">

    var client = {{$client}};
    var job_offer = {{$jobOffer}};
</script>
<script type="text/javascript" src="{{$theme}}js/custom/freelancer/feedbackcontroller.js"></script>
<!-- Breadcrumbs -->

<div class="pi-section-w pi-border-bottom pi-section-grey">
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb">
            <ul>
                <li><a href="{{url('/')}}">{{Translate::get("Home",$lang)}}</a></li>
                <li><a href="{{url('freelancer/overview')}}">{{Translate::get("Overview",$lang)}}</a></li>

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
                <div ng-app="feedbackApp" ng-controller="feedbackController">
                    <div class="pi-row col-lg-12">
                        <div class="pi-tab-pane" id="jobhistory">

                            <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-20 pi-has-bg">
                                {{Translate::get("Job Offer",$lang)}} [<small><strong>{{$jobOffer->JobPost->title}} - {{$jobOffer->title}}</strong></small>]
                            </h3>
                            <div class="pi-section-gray pi-col-lg-12">

                                <h4>Job Description</h4>
                                <p>
                                    {{$jobOffer->JobPost->description}}
                                </p>
                                <h5>Job Offer Details</h5>
                                <p>
                                    {{$jobOffer->description}}
                                </p>

                                <h4>Your Rating : <span>
                                @if(count($feedback))
                                  {{  $feedback->feedback_score . ' / 5.00'}}
                                <?php $feedback_score = (!empty($feedback))? $feedback->feedback_score : ''; ?>
                                    @for($i=1; $i<=5; $i++)
                                        @if($i <= $feedback_score)
                                            <span class="star"></span>
                                            @else
                                            <span class="star2"></span>
                                        @endif
                                    @endfor
                                @else
                                    Not given yet
                                @endif
                                        </span>
                                </h4>
                                <div class="pi-col-sm-12 pi-no-padding">

                                <div class="pi-accordion">
                                <div class="pi-accordion-item pi-accordion-item-active">


                                    <div class="pi-accordion-content pi-section-grey pi-padding-bottom-10" style="display: block;">
                                        @if(!count($client_feedback))
                                        <form ng-submit="saveFreelancerFeedback()" method="post">
                                        <div>
                                            <?php $feedback_score = (count($client_feedback))? $client_feedback->feedback_score : 0; ?>
                                            <div class="pi-col-xs-4">
                                                <div class="pi-col-xs-5 pi-no-padding">

                                                    @for($i=1; $i<=5; $i++)
                                                    @if($i <= $feedback_score)
                                                    <span class="star"></span>
                                                    @else
                                                    <span class="star2"></span>
                                                    @endif
                                                    @endfor


                                                    <br/>

                                                    <div class="quality">
                                                        <span class="squ-box"></span>
                                                        <span class="squ-box"></span>
                                                        <span class="squ-box"></span>
                                                        <span class="squ-box"></span>
                                                        <span class="squ-box"></span>
                                                    </div>
                                                    <br/>
                                                    <div class="expertise">
                                                        <span class="squ-box"></span>
                                                        <span class="squ-box"></span>
                                                        <span class="squ-box"></span>
                                                        <span class="squ-box"></span>
                                                        <span class="squ-box"></span>
                                                    </div>
                                                    <br/>
                                                    <div class="schedule">
                                                        <span class="squ-box"></span>
                                                        <span class="squ-box"></span>
                                                        <span class="squ-box"></span>
                                                        <span class="squ-box"></span>
                                                        <span class="squ-box"></span>
                                                    </div>
                                                    <br/>
                                                    <div class="response">
                                                        <span class="squ-box"></span>
                                                        <span class="squ-box"></span>
                                                        <span class="squ-box"></span>
                                                        <span class="squ-box"></span>
                                                        <span class="squ-box"></span>
                                                    </div>
                                                    <br/>
                                                    <div class="professional">
                                                        <span class="squ-box"></span>
                                                        <span class="squ-box"></span>
                                                        <span class="squ-box"></span>
                                                        <span class="squ-box"></span>
                                                        <span class="squ-box"></span>
                                                    </div>

                                                </div>
                                                <div class="pi-col-xs-6 pi-no-padding">
                                                    <strong>

                                                        5.0

                                                    </strong><br/>

                                                    <strong>Quality</strong>
                                                    <strong>Expertise</strong>
                                                    <strong>Cost</strong>
                                                    <strong>Schedule</strong>
                                                    <strong>Response</strong>
                                                    <strong>Professional</strong>

                                                </div>



                                                <hr class="pi-divider-gap-10">
                                            </div>

                                            <div class="pi-col-xs-8">
                                                Give a feedback to client : {{$client->getName()}}
                                                <div class="pi-col-xs-12 pi-section-white pi-margin-top-5 pi-margin-bottom-10 pi-padding-bottom-10 pi-padding-top-10" style="font-size:13px; text-align:justify; line-height:normal;">
                                                    <!-- Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                     Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                                     when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                                     It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.s
                                                     It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                                                     and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.-->
                                                    <strong> Feedback Comments :</strong><br/>
                                                    @if(!count($client_feedback))
                                                    <textarea rows="2" placeholder="Type your comment" name="comment" class="form-control feedback_comment"></textarea><br/><br/>
                                                    <!--<a href="#">- Diaoman</a>-->

                                                    <input type="submit" class="btn pi-btn-green send_feedback_btn" value="Send Feedback"/>
                                                    @else
                                                    {{{$client_feedback->comment}}}<br/><br/>
                                                    <a href="" class="btn pi-btn-green disabled">Feedback submitted for this job offer</a>
                                                    @endif
                                                </div>



                                            </div>

                                        </div>
                                        </form>
                                        @else
                                        <div>



                                            <div class="pi-col-xs-12">
                                                Client :  {{$client->getName()}}
                                                <div class="pi-col-xs-12 pi-section-white pi-margin-top-5 pi-margin-bottom-10 pi-padding-bottom-10 pi-padding-top-10" style="font-size:13px; text-align:justify; line-height:normal;">
                                                    <!-- Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                     Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                                     when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                                     It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.s
                                                     It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                                                     and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.-->
                                                    <strong> Feedback Comments :</strong>
                                                    <div class="pi-col-xs-4 pull-right pi-no-padding-right">
                                                        <div class="pi-col-xs-12 pi-no-padding pi-text-right">
                                                            @for($i=1; $i<=5; $i++)
                                                            @if($i <= $client_feedback->feedback_score)
                                                            <span class="star"></span>
                                                            @else
                                                            <span class="star2"></span>
                                                            @endif
                                                            @endfor
                                                            <strong>{{{$client_feedback->feedback_score}}} / 5.0</strong>
                                                        </div>

                                                        <div class="pi-col-xs-12 pi-no-padding pi-text-right">

                                                            <span><strong>Date :</strong></span>

                                                            {{Helpers::dateTimeFormat('j F, Y',$client_feedback->created_at)}}

                                                        </div>



                                                        <hr class="pi-divider-gap-10">
                                                    </div><br/>
                                                    @if(!count($client_feedback) && !$client_feedback->id)
                                                    <textarea rows="2" placeholder="Type your comment" name="comment" class="form-control feedback_comment"></textarea><br/><br/>
                                                    <!--<a href="#">- Diaoman</a>-->

                                                    <input type="submit" class="btn pi-btn-green send_feedback_btn" value="Send Feedback"/>
                                                    @else
                                                    {{{$client_feedback->comment}}}<br/><br/>
                                                    <a href="" class="btn pi-btn-green disabled">Feedback submitted for this job offer</a>
                                                    @endif
                                                </div>



                                            </div>

                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- End accordion item -->

                                <!-- Accordion item -->
                                <div class="pi-accordion-item pi-accordion-item-active">
                                    <h5 class="pi-accordion-title pi-padding-top-20 pi-padding-bottom-10">
                                       Job Offer Phases :
                                    </h5>
                                    @if(count($jobOfferPhases))
                                        @foreach($jobOfferPhases as $phase)
                                            <div class="pi-accordion-content pi-section-grey" style="display: block;">
                                                <div class="pi-col-xs-12">
                                                    <div><p class="pi-no-margin-bottom"><strong>Phase Title : </strong>{{{$phase->phase_title}}}</p></div>
                                                </div>
                                                <div class="pi-col-xs-12">
                                                    <div>
                                                        <p class="pi-col-xs-3 pi-no-padding"><span class="glyphicon glyphicon-calendar"></span> {{Helpers::dateTimeFormat('j F, Y',$phase->phase_deadline)}}</p>
                                                        <p class="pi-col-xs-3 pi-no-padding"><span class="glyphicon glyphicon-ok"></span> {{{$phase->phase_payment_status}}}</p>
                                                        <p class="pi-col-xs-3 pi-no-padding"><span class="glyphicon glyphicon-dashboard"></span> {{{$phase->phase_hour}}}</p>
                                                        <p class="pi-col-xs-3 pi-no-padding"><span class="glyphicon glyphicon-usd"></span> {{{$phase->phase_hour}}}</p>
                                                    </div>
                                                </div>



                                                <div class="pi-col-xs-12 pi-no-margin-top">
                                                    <div>
                                                        <p align="justify"><span class="glyphicon glyphicon-pencil"></span>
                                                            {{{$phase->phase_details}}}
                                                        </p>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <!-- End accordion item -->


                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{$theme}}js/custom/common/common.js"></script>
<script type="text/javascript">
    $(function(){

        drawRating("div.quality,div.expertise,div.schedule,div.response,div.professional");

        $("div.quality,div.expertise,div.schedule,div.response,div.professional").children().bind('click',function(){
            setRating($(this));
        });

    });
</script>
@stop