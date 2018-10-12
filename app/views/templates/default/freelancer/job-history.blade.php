@extends('templates.default.default')


@section('content')
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
                <div ng-app="">
                    <div class="pi-row col-lg-12">
                    	<div class="pi-tab-pane" id="jobhistory">
                
                    <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-20 pi-has-bg">
                        {{Translate::get("Completed job list",$lang)}}
                    </h3>
                    

                    
                    <div class="pi-responsive-table-sm">
            <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
            
                <!-- Table head -->
                <thead>
                
                    <!-- Table row -->
                    <tr>
                        <th style="width:200px;">
                            {{Translate::get("Projects Name",$lang)}}
                        </th>
                        <th>
                            {{Translate::get("Status",$lang)}}
                        </th>
                        <th>
                            {{Translate::get("Clients Say",$lang)}}
                        </th>
                        <th style="width:150px;">{{Translate::get("Rating",$lang)}}</th>

                    </tr>
                    <!-- End table row -->
                
                </thead>
                <!-- End table head -->
                
                <!-- Table body -->
                <tbody>
                
                    <!-- Table row -->
                    @if(count($jobhistories))
                        @foreach($jobhistories as $jobhistory)
                            <tr>
                                <td><strong><a href="{{url('freelancer/job-offer/'.Helpers::EncodeDecode($jobhistory->id))}}">{{{$jobhistory->JobPost->title}}}</a></strong>
                                    <p>{{{$jobhistory->title}}}
                                        <br/><i class="pr-date">{{{Helpers::dateTimeFormat('j F, Y',$jobhistory->created_at)}}}</i></p>
                                </td>
                                <td>{{$jobhistory->job_offer_status}}</td>
                                <td>
                                    @if(!empty($jobhistory->Feedback))
                                    {{{$jobhistory->Feedback->comment}}}
                                    @else
                                        No Feedback yet
                                    @endif
                                </td>

                                <td align="center"><b class="ret">
                                        @if(!empty($jobhistory->Feedback))
                                            {{$jobhistory->Feedback->feedback_score}}
                                        @endif</b> <br/>
                                    <?php $feedback_score = (!empty($jobhistory->Feedback))? $jobhistory->Feedback->feedback_score : 'No Feedback yet'; ?>
                                    @if(is_numeric($feedback_score))
                                        @for($i=1; $i<=5; $i++)
                                            @if($i <= $feedback_score)
                                                <span class="star"></span>
                                                @else
                                                <span class="star2"></span>
                                            @endif
                                        @endfor
                                    @else
                                        <span>{{$feedback_score}}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif

                
                
                </tbody>
                <!-- End table body -->
                
            </table>
        </div>
                    <hr class="pi-divider-gap-20">

        
                </div>
                <!-- End tab content -->
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