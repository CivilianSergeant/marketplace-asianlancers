@extends('templates.freelancer.freelancer')


@section('content')
<!-- Breadcrumbs -->

<script type="text/javascript" src="{{$theme}}js/custom/freelancer/portfolio.js"></script>
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
                <div ng-app="portfolioApp" ng-controller="portfolioController">
                    <div ng-cloak class="pi-row col-lg-12">
                        {{Helpers::showMessage()}}
                    	   <!-- Tab content -->
                <div class="pi-tab-pane" id="works">


                    <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25 pi-has-bg">
                        {{Translate::get("Portfolio Details",$lang)}}
                        <span class="btn-group pull-right">
                            <a href="{{url('freelancer/delete-portfolio/'.Helpers::EncodeDecode($portfolio->id))}}" class="btn pi-btn-small pi-btn-danger">
                                <i class="icon-trash"></i>
                            </a>
                        </span>
                    </h3>

                    <hr class="pi-divider-gap-20">
                    <div class="col-lg-12">
                        <div class="col-lg-6">
                        <div class="pi-gallery-item">
                            <div class="pi-img-w pi-img-hover-zoom">

                                <img  src="{{$imgUrl.$portfolio->image}}/" alt="{{$imgUrl.$portfolio->image}}">
                                <div class="pi-img-overlay pi-img-overlay-dark">
                                    <div class="pi-caption-centered">
                                        <div>
                                            <a target="_blank" href="{{$portfolio->url}}"><span class="pi-caption-icon pi-caption-scale icon-eye"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label class="col-lg-6">Title</label>
                        <span class="col-lg-6">{{$portfolio->title}}</span>
                    </div>
                    <div class="col-lg-12">
                        <label class="col-lg-6">Category</label>
                        <span class="col-lg-6">{{$portfolio->category_name}}</span>
                    </div>
                    <div class="col-lg-12">
                        <label class="col-lg-6">Description</label>
                        <span >{{$portfolio->description}}</span>
                    </div>
                    <div class="col-lg-12">
                        <label class="col-lg-6">Link</label>
                        <span class="col-lg-6"><a target="_blank" href="{{$portfolio->url}}">{{$portfolio->url}}</a></span>
                    </div>
                    
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