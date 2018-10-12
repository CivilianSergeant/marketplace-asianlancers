@extends('templates.freelancer.freelancer')


@section('content')
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
                <div ng-app="">
                    <div class="pi-row col-lg-12">
                        <div class="pi-tab-pane" id="jobhistory">

                            <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-20 pi-has-bg">
                              {{Translate::get("My Job requests",$lang)}}
                            </h3>


                            <div class="pi-responsive-table-sm">
                                <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">

                                    <!-- Table head -->
                                    <thead>

                                    <!-- Table row -->
                                    <tr>
                                        <th style="width:200px;">
                                            {{Translate::get("Job Title",$lang)}}

                                        </th>
                                        <th>{{Translate::get("Estimated Price",$lang)}}</th>
                                        <th>
                                            {{Translate::get("Posted date",$lang)}}
                                        </th>
                                        <th>{{Translate::get("Status",$lang)}}</th>
                                        <th style="width:150px;">{{Translate::get("Action",$lang)}}</th>

                                    </tr>
                                    <!-- End table row -->

                                    </thead>
                                    <!-- End table head -->

                                    <!-- Table body -->
                                    <tbody>

                                    <!-- Table row -->
                                    @if(count($requests))
                                        @foreach($requests as $request)
                                        <?php

                                        $job = $request->JobPost;

                                        $client = $job->Client;
                                        $categoryId = Helpers::EncodeDecode($job->job_category_id);
                                        $jobId = Helpers::EncodeDecode($job->id);
                                        $clientId = Helpers::EncodeDecode($client->id);
                                        ?>
                                    <tr>

                                        <td>{{$job->title}} <br/><i class="pr-date"><a target="_blank" href="{{url('view/client/'.$clientId)}}"{{$client->getName()}}>{{$client->getName()}}</a></i></td>

                                        <td>
                                            {{$job->amount}}
                                        </td>
                                        <td>{{Helpers::dateTimeFormat("j F, Y",$request->created_at)}}</td>
                                        <td>
                                            @if($request->request_status == 'Requested')
                                            <div>
                                                <a  class="btn pi-btn-green disabled" disabled>Already Applied</a>
                                            </div>
                                            @elseif($request->request_status == 'Approved')
                                            <div>
                                                <a class="btn pi-btn-green disabled" disabled>Waiting for Client Review</a>
                                            </div>
                                            @elseif($request->request_status == 'Declined')
                                            <div>
                                                <a class="btn pi-btn-red disabled" disabled>Client Declined your request</a>
                                            </div>
                                            @elseif($request->request_status == 'Canceled')
                                            <div>
                                                <a class="btn pi-btn-red disabled" disabled>Admin Canceled your request</a>
                                            </div>
                                            @endif
                                        </td>
                                        <td align="center">
                                            <?php
                                                $job = $request->JobPost;
                                                $categoryId = Helpers::EncodeDecode($job->job_category_id);
                                                $jobId = Helpers::EncodeDecode($job->id);
                                            ?>
                                            <a target="_blank" href="{{url('view/job/'.$categoryId.'/'.$jobId)}}">{{Translate::get("View Details",$lang)}}</a>
                                        </td>
                                    </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">{{Translate::get("Sorry ! You did not made any job request yet.",$lang)}}</td>
                                        </tr>
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