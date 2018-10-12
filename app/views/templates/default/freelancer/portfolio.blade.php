@extends('templates.default.default')


@section('content')
<!-- Breadcrumbs -->
<script type="text/javascript">
    var errorMsg = {{json_encode($errorMsg)}}
</script>
<script type="text/javascript" src="{{$theme}}js/custom/freelancer/portfolio.js"></script>
<div class="pi-section-w pi-border-bottom pi-section-grey">
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('freelancer/overview')}}">Overview</a></li>
                <li><a href="{{url('freelancer/'.$title['action'])}}">{{$title['title']}}</a></li>
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
                        {{Translate::get("Portfolio",$lang)}}
                    </h3>


                    <hr class="pi-divider-gap-20">
                    <div ng-model="errorMsg" ng-if="errorMsg" class="pi-alert-danger">
                        <!--<button data-dismiss="alert" class="pi-close" type="button">
                            <i class="icon-cancel"></i>
                        </button>-->
                        <p>
                            <strong><a id="topEdu">Warning!</a></strong> <ul><li ng-repeat="em in errorMsg">@{{em[0]}}</li></ul>
                        </p>
                    </div>
                    <div class="pi-row col-lg-12">
                        <button class="btn btn-primary" ng-if="showFrm==0" ng-click="AddForm()"><i class="icon-plus"></i> {{Translate::get("Add Portfolio",$lang)}}</button>
                        <hr class="pi-divider-gap-20">
                        {{Form::Open(array('id'=>"portfolioFrm", 'data-ng-show'=>'showFrm', 'url'=>'freelancer/portfolio', 'method'=>'post', 'enctype'=>'multipart/form-data'))}}

                            <div class="form-group">
                                <label for="title">{{Translate::get("Title",$lang)}} <span class="required pi-text-red">*</span></label>
                                <input type="text" class="form-control" data-ng-model="title" name="title"/>
                            </div>
                            <div class="form-group">
                                <label for="category_name">{{Translate::get("Category",$lang)}} <span class="required pi-text-red">*</span></label>
                                <input type="text" class="form-control" data-ng-model="category_name" name="category_name"/>
                            </div>


                            <div class="form-group">
                                <label for="category_name">{{Translate::get("Url",$lang)}} <span class="required pi-text-red">*</span></label>
                                <input type="text" class="form-control" data-ng-model="url" name="url"/>
                            </div>
                            <div class="form-group">
                                <label for="category_name">{{Translate::get("Image",$lang)}} <span class="required pi-text-red">*</span></label>
                                <input type="file" name="photo"/>
                            </div>

                            <div class="form-group">
                                <label for="category_name">{{Translate::get("Description",$lang)}}</label>
                                <textarea class="form-control" name="description" data-ng-model="description"></textarea>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="{{Translate::get('Save',$lang)}}"/>
                                <input type="reset" ng-click="showFrm=0" class="btn pi-btn-blue" value="{{Translate::get('Cancel',$lang)}}"/>
                            </div>
                        {{Form::Close()}}
                    </div>
                    <hr class="pi-divider-gap-20">
                    <!-- Photo gallery -->
                    <div class="pi-row pi-liquid-col-sm-3 pi-liquid-col-xs-2 pi-gallery pi-stacked">

                        <!-- Photo gallery item -->
                        @if(count($portfolios))
                            @foreach($portfolios as $portfolio)

                                @if(File::exists($filePath.$portfolio->image))
                                <div class="pi-gallery-item">
                                    <div class="pi-img-w pi-img-hover-zoom">

                                        <img src="{{$imgUrl.$portfolio->image}}/" alt="{{$imgUrl.$portfolio->image}}">
                                        <div class="pi-img-overlay pi-img-overlay-dark">
                                            <div class="pi-caption-centered">
                                            <div>
                                                <a target="_blank" href="{{url('freelancer/portfolio-details/'.Helpers::EncodeDecode($portfolio->id))}}"><span class="pi-caption-icon pi-caption-scale icon-eye"></span></a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        @endif
                        <!-- End photo gallery item -->
                        
                        <!-- Photo gallery item -->
                        <!--<div class="pi-gallery-item">
                            <div class="pi-img-w pi-img-hover-zoom">
                                <img src="{{$theme}}img_external/gallery/img-21.jpg" alt="">
                                <div class="pi-img-overlay pi-img-overlay-dark">
                                    <div class="pi-caption-centered">
                                        <div>
                                            <a href="#"><span class="pi-caption-icon pi-caption-scale icon-eye"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <!-- End photo gallery item -->

                        <!-- Photo gallery item -->
                        <!--<div class="pi-gallery-item">
                            <div class="pi-img-w pi-img-hover-zoom">
                                <img src="{{$theme}}img_external/gallery/img-22.jpg" alt="">
                                <div class="pi-img-overlay pi-img-overlay-dark">
                                    <div class="pi-caption-centered">
                                        <div>
                                            <a href="#"><span class="pi-caption-icon pi-caption-scale icon-eye"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <!-- End photo gallery item -->

                        <!-- Photo gallery item -->
                        <!--<div class="pi-gallery-item">
                            <div class="pi-img-w pi-img-hover-zoom">
                                <img src="{{$theme}}img_external/gallery/img-23.jpg" alt="">
                                <div class="pi-img-overlay pi-img-overlay-dark">
                                    <div class="pi-caption-centered">
                                        <div>
                                            <a href="#"><span class="pi-caption-icon pi-caption-scale icon-eye"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <!-- End photo gallery item -->

                        <!-- Photo gallery item -->
                        <!--<div class="pi-gallery-item">
                            <div class="pi-img-w pi-img-hover-zoom">
                                <img src="{{$theme}}img_external/gallery/img-24.jpg" alt="">
                                <div class="pi-img-overlay pi-img-overlay-dark">
                                    <div class="pi-caption-centered">
                                        <div>
                                            <a href="#"><span class="pi-caption-icon pi-caption-scale icon-eye"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <!-- End photo gallery item -->

                        <!-- Photo gallery item -->
                        <!--<div class="pi-gallery-item">
                            <div class="pi-img-w pi-img-hover-zoom">
                                <img src="{{$theme}}img_external/gallery/img-25.jpg" alt="">
                                <div class="pi-img-overlay pi-img-overlay-dark">
                                    <div class="pi-caption-centered">
                                        <div>
                                            <a href="#"><span class="pi-caption-icon pi-caption-scale icon-eye"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <!-- End photo gallery item -->

                    </div>
                    <!-- End photo gallery -->
                    
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