@extends('templates.freelancer.freelancer')


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
                        {{Translate::get("Active jobs",$lang)}}
                    </h3>
                    

                    <div class="pi-responsive-table-sm">
            <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
            
                <!-- Table head -->
                <thead>
                
                    <!-- Table row -->
                    <tr>
                        <th style="width:200px;">
                            {{Translate::get("Project Name",$lang)}}
                        </th>
                        <th>
                            {{Translate::get("Client",$lang)}}
                        </th>
                        <th>
                            {{Translate::get("Status",$lang)}}
                        </th>

                        <th style="width:150px;">Action</th>

                    </tr>
                    <!-- End table row -->
                
                </thead>
                <!-- End table head -->
                
                <!-- Table body -->
                <tbody>
                
                    <!-- Table row -->
                    @if(count($activeJobs))
                        @foreach($activeJobs as $activeJob)
                            <tr>
                                <td><strong><a href="{{url('freelancer/job-offer/'.Helpers::EncodeDecode($activeJob->id))}}">{{{$activeJob->JobPost->title}}}</a></strong>
                                    <p>
                                        <br/><i class="pr-date">{{{Helpers::dateTimeFormat('j F, Y',$activeJob->created_at)}}}</i></p>
                                </td>

                                <td align="center">
                                     {{$activeJob->JobPost->Client->getName()}}
                                </td>
                                <td>{{$activeJob->job_offer_status}}</td>
                                <td><a target="_blank" href="{{url('view/job/'.Helpers::EncodeDecode($activeJob->JobPost->job_category_id).'/'.Helpers::EncodeDecode($activeJob->job_post_id))}}" class="btn pi-btn pi-btn-small">View Details</a></td>
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