@extends('templates.default.default')


@section('content')
<script type="text/javascript">

    var freelancer = {{$freelancer}};
    var job_offer = {{$jobOffer}};
</script>
<script type="text/javascript" src="{{$theme}}js/custom/client/feedbackcontroller.js"></script>
<!-- Breadcrumbs -->

<div class="pi-section-w pi-border-bottom pi-section-grey">
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('freelancer/overview')}}">Overview</a></li>

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

                    <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25 pi-has-bg">Job
                        History ( 146 jobs )</h3>

                    <div class="pi-section-w pi-shadow-inside-top pi-section-grey pi-margin-bottom-25">
                        <div class="pi-texture" style="background: url(img/hexagon.png) repeat;"></div>
                        <div class="pi-section pi-section-md pi-titlebar pi-titlebar-breadcrumb-top pi-titlebar-small"
                             style="padding:15px 20px;">

                            <div class="pi-row">
                                <div class="pi-col-xs-1"><a class="btn pi-btn-blue pi-btn-bigger"
                                                            style="font-size:12px; padding: 8px 15px; text-align:center;"
                                                            href="#">lEVEL<br/><span style="font-size: 25px;
    font-weight: bold;">10</span> </a></div>
                                <div class="pi-col-xs-3">
                                    <span><strong
                                            style="text-align:right; width:30%; display:inline-block; padding-right:5px;">146</strong> Jobs</span>
                                    <br/>
                                    <span><strong
                                            style="text-align:right; width:30%; display:inline-block; padding-right:5px;">184</strong> Milestones</span><br/>
                                    <span><strong
                                            style="text-align:right; width:30%; display:inline-block; padding-right:5px;">10</strong> Hours</span>
                                </div>
                                <div class="pi-col-xs-3">
<span><strong style="text-align:right; width:30%; display:inline-block; padding-right:5px;">4.9</strong>
<span class="star"></span>
<span class="star"></span>
<span class="star"></span>
<span class="star"></span>
<span class="star"></span>
</span> <br/>
                                    <span><strong
                                            style="text-align:right; width:30%; display:inline-block; padding-right:5px;">76</strong> Reviews</span><br/>
                                    <span><strong
                                            style="text-align:right; width:30%; display:inline-block; padding-right:5px;">93%</strong> Recommended</span>
                                </div>
                                <div class="pi-col-xs-2">
                                    <span><strong
                                            style="text-align:right; width:30%; display:inline-block; padding-right:5px;">130</strong> Clients</span>
                                    <br/>
                                    <span><strong
                                            style="text-align:right; width:30%; display:inline-block; padding-right:5px;">20%</strong> Repeat</span><br/>
                                </div>
                                <div class="pi-col-xs-3">
                                    <span><strong
                                            style="text-align:right; width:45%; display:inline-block; padding-right:5px;">$173,500 </strong> Earnings</span>
                                    <br/>
                                    <span><strong
                                            style="text-align:right; width:45%; display:inline-block; padding-right:5px;">$1,684 </strong> Per Client</span><br/>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="job-list-view">
                        <form ng-submit="saveClientFeedback()" method="post">
                        <h4>Job Description</h4>

                        <div class="pi-col-sm-12 pi-no-padding">

                            <div class="pi-accordion">
                                <div class="pi-accordion-item pi-accordion-item-active">
                                    <h5 class="pi-accordion-title">
                                        <a href="#"><span class="pi-accordion-toggle"></span>Conversion Rate Optimizer / Advisor</a>
                                    </h5>

                                    <div class="pi-accordion-content pi-section-grey pi-padding-bottom-10" style="display: block;">
                                        @if(!count($feedback))
                                            <div>
                                            <?php $feedback_score = (count($feedback))? $feedback->feedback_score : 0; ?>
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
                                                Client : Diaoman <a href="#">( See 9 other reviews )</a>
                                                <div class="pi-col-xs-12 pi-section-white pi-margin-top-5 pi-margin-bottom-10 pi-padding-bottom-10 pi-padding-top-10" style="font-size:13px; text-align:justify; line-height:normal;">
                                                    <!-- Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                     Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                                     when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                                     It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.s
                                                     It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                                                     and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.-->
                                                    <strong> Feedback Comments :</strong><br/>
                                                    @if(!count($feedback))
                                                    <textarea rows="2" placeholder="Type your comment" name="comment" class="form-control feedback_comment"></textarea><br/><br/>
                                                    <!--<a href="#">- Diaoman</a>-->

                                                    <input type="submit" class="btn pi-btn-green send_feedback_btn" value="Send Feedback"/>
                                                    @else
                                                        {{{$feedback->comment}}}<br/><br/>
                                                        <a href="" class="btn pi-btn-green disabled">Feedback submitted for this job offer</a>
                                                    @endif
                                                </div>



                                            </div>

                                        </div>
                                        @else
                                            <div>



                                            <div class="pi-col-xs-12">
                                                Client : Diaoman <a href="#">( See 9 other reviews )</a>
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
                                                                @if($i <= $feedback->feedback_score)
                                                                    <span class="star"></span>
                                                                @else
                                                                    <span class="star2"></span>
                                                                @endif
                                                            @endfor
                                                             <strong>{{{$feedback->feedback_score}}} / 5.0</strong>
                                                        </div>

                                                        <div class="pi-col-xs-12 pi-no-padding pi-text-right">

                                                            <span><strong>Date :</strong></span>

                                                              {{Helpers::dateTimeFormat('j F, Y',$feedback->created_at)}}

                                                        </div>



                                                        <hr class="pi-divider-gap-10">
                                                    </div><br/>
                                                    @if(!count($feedback) && !$feedback->id)
                                                    <textarea rows="2" placeholder="Type your comment" name="comment" class="form-control feedback_comment"></textarea><br/><br/>
                                                    <!--<a href="#">- Diaoman</a>-->

                                                    <input type="submit" class="btn pi-btn-green send_feedback_btn" value="Send Feedback"/>
                                                    @else
                                                    {{{$feedback->comment}}}<br/><br/>
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
                                    <h5 class="pi-accordion-title">
                                        <a href="#"><span class="pi-accordion-toggle"></span>One Phase Output</a>
                                    </h5>

                                    <div class="pi-accordion-content pi-section-grey" style="display: block;">

                                        <div class="pi-col-xs-12">
                                            <div>
                                                <p class="pi-col-xs-3 pi-no-padding"><span class="glyphicon glyphicon-calendar"></span> 09/11/2014</p>
                                                <p class="pi-col-xs-3 pi-no-padding"><span class="glyphicon glyphicon-ok"></span> Done</p>
                                                <p class="pi-col-xs-3 pi-no-padding"><span class="glyphicon glyphicon-dashboard"></span> 4</p>
                                                <p class="pi-col-xs-3 pi-no-padding"><span class="glyphicon glyphicon-usd"></span> 402</p>
                                            </div>
                                        </div>

                                        <div class="pi-col-xs-12">
                                            <div><p class="pi-no-margin-bottom"><strong>Phase Title : </strong>Wordpress Template Design</p></div>
                                        </div>

                                        <div class="pi-col-xs-12 pi-no-margin-top">
                                            <div><p align="justify"><span class="glyphicon glyphicon-pencil"></span> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy.</p></div>
                                        </div>

                                    </div>
                                </div>
                                <!-- End accordion item -->


                            </div>

                        </div>
                        </form>
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