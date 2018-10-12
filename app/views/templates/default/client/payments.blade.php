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
                                {{Translate::get("Financial Statements",$lang)}}
                            </h3>



                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">

                                    <!-- Table head -->
                                    <thead>

                                    <!-- Table row -->
                                    <tr>
                                        <th style="width:200px;">
                                            {{Translate::get("Job Title",$lang)}}
                                        </th>
                                        <th>{{Translate::get("PayPal Payment ID",$lang)}}</th>
                                        <th>{{Translate::get("Paid",$lang)}}</th>
                                        <th>
                                            {{Translate::get("Payment Status",$lang)}}
                                        </th>
                                        <th>
                                            {{Translate::get("Date",$lang)}}
                                        </th>


                                    </tr>
                                    <!-- End table row -->

                                    </thead>
                                    <!-- End table head -->

                                    <!-- Table body -->
                                    <tbody>

                                    <!-- Table row -->
                                    @if(count($payments))
                                    @foreach($payments as $payment)
                                    <?php

                                    $jobOffer = $payment->JobOffer;
                                    $jobPost = $jobOffer->JobPost;

                                    $client = $jobPost->Client;
                                    $freelancer = $payment->Freelancer;
                                    $categoryId = Helpers::EncodeDecode($jobPost->job_category_id);
                                    $jobId = Helpers::EncodeDecode($jobPost->id);
                                    $clientId = Helpers::EncodeDecode($client->id);
                                    ?>
                                    <tr>

                                        <td>{{$jobOffer->title}} <br/><i class="pr-date"><a target="_blank" href="{{url('view/client/'.$clientId)}}"{{$client->getName()}}>{{$client->getName()}}</a></i></td>
                                        <td>{{$payment->payment_id}}</td>
                                        <td>
                                            $ {{$payment->amount}}
                                        </td>

                                        <td>{{$payment->payment_status}}</td>
                                        <td>{{Helpers::dateTimeFormat('j M,Y',$payment->release_dt)}}</td>

                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" class="text-center">{{Translate::get("Sorry ! No Financial transaction found",$lang)}}</td>
                                    </tr>
                                    @endif



                                    </tbody>
                                    <!-- End table body -->
                                    <tfoot>
                                        <tr>
                                            <td colspan="5">
                                            <?php

                                                if(count($payments))
                                                    echo $payments->links();

                                            ?></td>
                                        </tr>
                                    </tfoot>
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