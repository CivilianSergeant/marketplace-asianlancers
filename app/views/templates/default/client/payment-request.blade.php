@extends('templates.default.default')


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
            {{Helpers::showMessage()}}
            <ul class="pi-tabs-navigation pi-tabs-navigation-transparent profile-po" id="myTabs">
                {{Theme::make('partial.menu',array())}}
            </ul>
            <div class="pi-tabs-content pi-tabs-content-transparent">

                <!-- Tab content -->
                <div ng-app="">
                    <div class="pi-row col-lg-12">
                        <div class="pi-tab-pane" id="jobhistory">

                            <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-20 pi-has-bg">
                                {{Translate::get("Payment Request",$lang)}}
                            </h3>

                            <div class="pi-responsive-table-sm">
                                <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">

                                    <!-- Table head -->
                                    <thead>

                                    <!-- Table row -->
                                    <tr>
                                        <th style="width:200px;">
                                            {{Translate::get("Title",$lang)}}
                                        </th>
                                        <th>{{Translate::get("Hour",$lang)}}</th>
                                        <th>{{Translate::get("Price",$lang)}}</th>
                                        <th style="width:150px;">{{Translate::get("Action",$lang)}}</th>

                                    </tr>
                                    <!-- End table row -->

                                    </thead>
                                    <!-- End table head -->

                                    <!-- Table body -->
                                    <tbody>
                                    <!-- Table row -->
                                    @if(count($jobOfferList))
                                        @foreach($jobOfferList as $jobOffer)
                                            @foreach($jobOffer->WaitingJobPhase as $jobPhase)
                                                <tr>

                                                    <td>
                                                        {{$jobPhase->phase_title}} <br/>
                                                        <i class="pr-date">
                                                            <a target="_blank" href="{{url('view/freelancer/'.Helpers::EncodeDecode($jobOffer->Freelancer->id))}}">
                                                                {{$jobOffer->Freelancer->first_name}} {{$jobOffer->Freelancer->last_name}}
                                                            </a>
                                                        </i>
                                                    </td>

                                                    <td>
                                                        {{$jobPhase->phase_hour}}
                                                    </td>
                                                    <td>
                                                        {{$jobPhase->phase_price}}
                                                    </td>
                                                    <td align="center">
                                                        <a class="btn pi-btn pi-btn-small" target="_blank" href="{{url('payment/paynow/'.Helpers::EncodeDecode($jobPhase->id))}}">
                                                            {{Translate::get("View Details",$lang)}}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
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