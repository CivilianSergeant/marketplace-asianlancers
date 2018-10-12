@extends('templates.freelancer.freelancer')


@section('content')

<script type="text/javascript">
    var user = {{$user}}
    var prices = {{$prices}}
    <?php if(count($freelancer)){ ?>
    var Freelancer = {{$freelancer}}
    var Educations = {{$educations}}
    var Certs = {{$certs}}
    var Pbs = {{$pbs}}
    var MySkills = {{$rskills}};
    var testTaken = {{$test_taken}}
    <?php }else{?>
    var Freelancer = '';
    var Educations = '';
    var Certs = '';
    var Pbs = '';
    var MySkills = '';
    var testTaken = ''

    <?php } ?>
</script>
<script type="text/javascript" src="{{$theme}}js/custom/freelancer/overviewcontroller.js"></script>
<!-- - - - - - - - - - SECTION - - - - - - - - - -->
@if($freelancer->freelancer_type=='Individual')
<div class="pi-section-w pi-section-parallax piCounter piTabs piTooltips" style="background:url({{$theme}}img/hexagon-2.png) repeat;">
    <div class="pi-texture" style="background:rgba(96, 157, 219, 0.75);"></div>
    <div class="pi-section pi-padding-top-30 pi-padding-bottom-20 pi-text-center">
        <h2 class="pi-text-shadow pi-has-border pi-has-tall-border pi-has-base-border pi-has-short-border" style="font-size:50px;">
            <span style="color:#21252b;">{{$freelancer->first_name}}</span> {{$freelancer->last_name}}

        </h2>

        <p class="lead-18 pi-weight-300 pi-margin-bottom-25 pi-p-half" style="color:#000;">
            {{$freelancer->profile_title}}
        </p>

    </div>
</div>
@else
<div class="pi-section-w pi-section-parallax piCounter piTabs piTooltips" style="background:url({{$theme}}img/hexagon-2.png) repeat;">
    <div class="pi-texture" style="background:rgba(255, 102, 0, 0.70);"></div>
    <div class="pi-section pi-padding-top-30 pi-padding-bottom-20 pi-text-center">
        <h2 class="pi-text-shadow pi-has-border pi-has-tall-border pi-has-base-border pi-has-short-border" style="font-size:50px;">
            <span style="color:#21252b;">{{$freelancer->first_name}}</span> {{$freelancer->last_name}}
        </h2>

        <p class="lead-18 pi-weight-300 pi-margin-bottom-25 pi-p-half" style="color:#000;">
            {{$freelancer->profile_title}}
        </p>

    </div>
</div>
@endif
<!-- - - - - - - - - - END SECTION - - - - - - - - - -->
<!-- Breadcrumbs -->

<div class="pi-section-w pi-border-bottom pi-section-grey">
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>

            </ul>
        </div>
        <div class="text-center">
            {{Helpers::showMessage()}}
        </div>
    </div>
</div>
<!-- End breadcrumbs -->



<!-- - - - - - - - - - SECTION - - - - - - - - - -->

<div class="pi-section-w pi-section-white pi-slider-enabled piSocials">
<div class="pi-section pi-padding-bottom-30" ng-app="freelancerApp" ng-controller="freelancerAppController">
@if(count($freelancer) != 0)
<!-- Openings -->
<div class="pi-tabs-vertical pi-responsive-sm">
<ul class="pi-tabs-navigation pi-tabs-navigation-transparent profile-po" id="myTabs">
    <li class="f-view-profile">
        {{Theme::make('partial.freelancer-sidebar-widget',array('freelancer'=>$freelancer))}}
    </li>
</ul>
<div class="pi-tabs-content pi-tabs-content-transparent">

<!-- Tab content -->

<div ng-cloak class="pi-row col-lg-12">

<!-- Col 6 -->
{{Helpers::showMessage()}}

<!-- Tab content -->
<div class="pi-tab-pane pi-active" id="overview">

<h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25 pi-has-bg">Overview

</h3>

<div class="pi-img-w pi-img-round-corners profile-img pi-img-shadow pi-img-left pi-margin-top-5" style="width:150px; overflow:hidden;">
    @if(count($freelancer) && ($freelancer->photos != null))
    @if($freelancer->freelancer_type=='Individual')
    <img src="{{CDN}}profile/freelancer/individual/{{$freelancer->photos}}" alt="{{$freelancer->photos or 'photo'}}"/>
    @else
    <img src="{{CDN}}profile/freelancer/agency/{{$freelancer->photos}}" alt="{{$freelancer->photos or 'photo'}}"/>
    @endif
    @else
    <img src="{{CDN}}profile/leader-1.png" alt=""/>
    @endif


</div>
<div>


    <p ng-model="overviewForm.overview">
        @{{overviewForm.overview}}
    </p>
    <ul class="oInlineListExt" style="margin:0px;">
        <li><i class="icon-home"></i><strong ng-show="Freelancer.address_country">@{{Freelancer.address_country}}</strong></li>
        <li ng-show="overviewForm.freelancer_price>0"><strong>$@{{overviewForm.freelancer_price}}</strong> HOURLY RATE</li>
       <?php
       $widgetData = $freelancer->getWidgetData();
       ?>
        <li>
            @for($i=1; $i<=5; $i++)
            @if($i <= $widgetData['avg_feedback'])
            <span class="star"></span>
            @else
            <span class="star2"></span>
            @endif
            @endfor
            <b>{{$widgetData['avg_feedback']}}</b>
        </li>
        <li ng-show="overviewForm.years_of_experience>0"><strong>@{{overviewForm.years_of_experience}}</strong> Years Exp</li>
        <li ng-show="testTaken"><strong>@{{testTaken}}</strong> TEST<span ng-show="testTaken >1">S</span></li>
    </ul>
    <ul ng-show="skills.length" class="cat-link clearFix">
        <li ng-repeat="s in skills"><a href="#" class="">@{{s.skill.category_name}}</a></li>
    </ul>
</div>
<div style="clear:both;"></div>


<h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-20 pi-has-bg">My Skills :</h3>
<div ng-show="skills.length" class="pi-row">
    <div class="pi-col-sm-12">
        <ul class="pi-bullets-square pi-bullets-contur pi-bullets">
            <li ng-repeat="s in skills" class="pi-col-sm-6"><span class="pi-bullet-icon"><i class="icon-flash"></i></span>@{{s.skill.category_name}}</li>
        </ul>
    </div>

</div>
<div class="pi-row">
@if($user->is_agent !=1 && $freelancer->edu_widget)
<div class="pi-col-sm-12 pi-padding-bottom-20" style="margin-top:25px;">
    <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-20 pi-has-bg">Education :</h3>
    <div class="pi-responsive-table-sm">

        <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
            <thead>
            <tr>
                <th colspan="2">Institute</th>
                <th>Faculty</th>
                <th>Start Year</th>
                <th>Passing Year</th>
                <th>Grade/Point/Division</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="Edu in Educations">
                <td colspan="2">@{{Edu.institute_name}}<br/><small style="display:block;width:100px;word-wrap:break-word;"><em>@{{Edu.description}}</em></small></td>
                <td>@{{Edu.area_of_study}}</td>
                <td>@{{Edu.start_year}}</td>
                <td>@{{Edu.end_year}}</td>
                <td>@{{Edu.degree}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
@endif
<hr class="pi-divider-gap-50">

<div class="pi-row">
    @if($freelancer->contact_widget = 0)
    <div class="pi-col-sm-12 pi-padding-bottom-20">
        <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-20 pi-has-bg">Contact Information :


        </h3>
        <div class="pi-responsive-table-sm">
            <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
                <tbody>

                <tr>
                    <td>Country</td>
                    <td>@{{Freelancer.address_country}}</td>
                </tr>

                <tr>
                    <td>Address</td>
                    <td>@{{Freelancer.address}}</td>
                </tr>

                <tr>
                    <td>Division</td>
                    <td>@{{Freelancer.division}}</td>
                </tr>

                <tr>
                    <td>City</td>
                    <td>@{{Freelancer.address_city}}</td>
                </tr>

                <tr>
                    <td>Zip/Postal Code</td>
                    <td>@{{Freelancer.address_zip}}</td>
                </tr>

                <tr>
                    <td>Phone</td>
                    <td>@{{Freelancer.contact_number}}</td>
                </tr>

                <tr>
                    <td>Mobile</td>
                    <td>@{{Freelancer.mobile}}</td>
                </tr>

                <!--<tr>
                    <td>Profile to PDF</td>
                    <td><a class="btn pi-btn-green pi-btn-small" href="#"><i class="icon-download pi-icon-left"></i>Download</a></td>
                </tr>-->


                </tbody>
                <!-- End table body -->

            </table>
        </div>
    </div>
    @endif
    @if($freelancer->exam_widget)
    <div class="pi-col-sm-12 pi-padding-bottom-20">

        <h2 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-has-bg pi-margin-bottom-30">
           @if($freelancer->freelancer_type == Freelancer::$INDIVIDUAL) I Am @else We Are @endif  Good At
        </h2>

        <!-- Progress bar -->


        @foreach($rskills as $rskill)
        @if($rskill->test_taken && $rskill->display)
        <div class="pi-counter pi-counter-round pi-counter-line" data-counter-type="line" data-count-from="0" data-count-to="{{{$rskill->test_percentage}}}" data-easing="easeInCirc" data-duration="2000" data-frames-per-second="10">

            <p class="pi-counter-label">{{{$rskill->GetTag->category_name}}} {{{$rskill->test_percentage}}}%</p>

            <div class="pi-counter-count">
                <div class="pi-counter-progress pi-bar-one"></div>
            </div>

        </div>
        @else
            @if($rskill->display)
                <div class="pi-counter pi-counter-round pi-counter-line" data-counter-type="line" data-count-from="0" data-count-to="1" data-easing="easeInCirc" data-duration="2000" data-frames-per-second="10">

                    <p class="pi-counter-label">{{{$rskill->GetTag->category_name or ''}}} Test not taken yet</p>

                    <div class="pi-counter-count">
                        <div class="pi-counter-progress pi-bar-one"></div>
                    </div>

                </div>
            @endif
        @endif
        @endforeach

    </div>
    @endif
</div>



</div>
@if($user->is_agent != 1 && $freelancer->certificate_widget)
<div class="pi-row">
    <div class="pi-col-sm-12 pi-padding-bottom-20">
        <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-20 pi-has-bg">Certification :


        </h3>
        <div class="pi-responsive-table-sm">

            <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
                <thead>
                <tr>
                    <th colspan="2">Title</th>
                    <th>Provider</th>
                    <th>Date Earned</th>
                    <th>Submission code / link</th>


                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="Cert in Certs">
                    <td colspan="2">@{{Cert.title}}<br/><small style="display:block;width:100px;word-wrap:break-word;"><em>@{{Cert.description}}</em></small></td>
                    <td>@{{Cert.provider}}</td>
                    <td>@{{Cert.date_earned | limitTo:10}}</td>
                    <td>@{{Cert.submission_code_or_link}}</td>

                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr class="pi-divider-gap-50">
</div>
@endif
@if($user->is_agent != 1 && $freelancer->pbs_widget)
<div class="pi-row">
    <div class="pi-col-sm-12 pi-padding-bottom-20">
        <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-20 pi-has-bg">Professional Background :


        </h3>
        <div class="pi-responsive-table-sm">

            <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
                <thead>
                <tr>
                    <th colspan="2">Org names</th>
                    <th>Org type</th>
                    <th>Responsibility</th>


                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="Pb in Pbs">
                    <td colspan="2">@{{Pb.org_name}}<br/><small style="display:block;width:100px;word-wrap:break-word;"><em>@{{Pb.designation}}</em></small></td>

                    <td>@{{Pb.org_type}}</td>
                    <td>@{{Pb.responsibility}}</td>


                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr class="pi-divider-gap-50">



    <div class="pi-row pi-liquid-col-sm-3 pi-liquid-col-xs-2 pi-gallery pi-stacked">
        <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25 pi-has-bg">
            Portfolio :
        </h3>
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
                            <?php if(preg_match('/https/', $portfolio->url)){ ?> 
                                <a href="{{ur($portfolio->url)}}"><span class="pi-caption-icon pi-caption-scale icon-eye"></span></a>
                            <?php }else{ ?>
                                <a href="#"><span class="pi-caption-icon pi-caption-scale icon-eye"></span></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
        @endif


    </div>


</div>
@endif

@if(count($members))
<div class="pi-row pi-liquid-col-sm-3 pi-liquid-col-xs-2 pi-gallery pi-stacked">
    <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25 pi-has-bg">
        Team Members :
    </h3>
    @foreach($members as $member)
    <?php $individual = $member->GetMemberProfile;  ?>
    <div class="freelancers_lists">

        <div class="pi-img-w pi-img-round-corners pi-img-left pi-margin-top-5 pi-shadow-effect4" style="width:155px;">

            @if(count($individual) && ($individual->photos != null))
            @if($individual->freelancer_type=='Individual')
            <img src="{{CDN}}profile/freelancer/individual/{{$individual->photos}}" alt="{{$individual->photos or 'photo'}}"/>
            @else
            <img src="{{CDN}}profile/freelancer/agency/{{$individual->photos}}" alt="{{$individual->photos or 'photo'}}"/>
            @endif
            @else
            <img src="{{CDN}}profile/leader-1.png" alt=""/>
            @endif

        </div>
        <h3 class="h4 pi-margin-bottom-5">
            <a href="{{url('view/freelancer/'.Helpers::EncodeDecode($individual->id))}}" target="_blank" class="pi-link-no-style">
                {{$individual->first_name}} {{$individual->last_name}}
            </a>
            |
            @if($member->status == 'Activated')
            <i class="avai"><img src="{{$theme}}img/available.png" width="15" height="15" alt="available" > Activated </i>
            @else
            <i class="avai"><img src="{{$theme}}img/no-available.png" width="15" height="15" alt="available" > {{$member->status}} </i>
            @endif
            <i class="rank-icon">1</i>
            <p class="pi-italic pi-text-base pi-margin-bottom-10"><img src="{{$theme}}img/DJITVerified.png" width="16" height="20" alt="0" /> <small class="pi-text-green">Djit Verfied</small></p>


            <!--<input checkbox-group class="pull-right" type="checkbox" />-->
        </h3>

        <!--<p class="pi-italic pi-text-base pi-margin-bottom-10">Different Thinks But Better</p>-->

        <p>{{$individual->overview}}</p>

        <ul class="oInlineListExt">
            @if($individual->freelancer_price)
            <li><strong>{{$individual->freelancer_price}}</strong> HOURLY RATE</li>
            @endif
            <li><span class="star"></span>
                <span class="star"></span>
                <span class="star"></span>
                <span class="star"></span>
                <span class="star"></span>
                <b>5.0</b>
            </li>
            <li><strong>1204</strong> HOURS</li>
            <li><i class="icon-home"></i><strong> {{$individual->address_country}}</strong></li>
            <?php
            $relatedTags = $individual->RelatedTags;
            $testTaken = 0;
            if(count($relatedTags))
            {
                foreach($relatedTags as $rt)
                {
                    if($rt->test_taken && $rt->score != null)
                        $testTaken++;
                }
            }
            ?>
            <li><strong>{{$testTaken}}</strong> TESTS</li>

        </ul>

        @if(count($relatedTags))
        <ul class="cat-link clearFix" style="padding-left:0;">
            @foreach($relatedTags as $rt)
            <li><a class="" href="#">{{$rt->GetTag->category_name}}</a></li>
            @endforeach
        </ul>
        @endif

        <hr class="pi-divider pi-divider-dashed clearfix">

    </div>
    @endforeach
</div>
@endif

@if(count($agencies))
<div class="pi-row pi-liquid-col-sm-3 pi-liquid-col-xs-2 pi-gallery pi-stacked">
    <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25 pi-has-bg">
       My Agencies :
    </h3>
    @foreach($agencies as $agency)
    <?php $individual = $agency->GetAgencyProfile;  ?>
    <div class="freelancers_lists">

        <div class="pi-img-w pi-img-round-corners pi-img-left pi-margin-top-5 pi-shadow-effect4" style="width:155px;">

            @if(count($individual) && ($individual->photos != null))
            @if($individual->freelancer_type=='Individual')
            <img src="{{CDN}}profile/freelancer/individual/{{$individual->photos}}" alt="{{$individual->photos or 'photo'}}"/>
            @else
            <img src="{{CDN}}profile/freelancer/agency/{{$individual->photos}}" alt="{{$individual->photos or 'photo'}}"/>
            @endif
            @else
            <img src="{{CDN}}profile/leader-1.png" alt=""/>
            @endif

        </div>
        <h3 class="h4 pi-margin-bottom-5">
            <a href="{{url('view/freelancer/'.Helpers::EncodeDecode($individual->id))}}" target="_blank" class="pi-link-no-style">
                {{$individual->first_name}} {{$individual->last_name}}
            </a>
            |
            @if($agency->status == 'Accepted')
            <i class="avai"><img src="{{$theme}}img/available.png" width="15" height="15" alt="available" > Current </i>
            @else
            <i class="avai"><img src="{{$theme}}img/no-available.png" width="15" height="15" alt="available" > Past </i>
            @endif
            <i class="rank-icon">1</i>
            <p class="pi-italic pi-text-base pi-margin-bottom-10"><img src="{{$theme}}img/DJITVerified.png" width="16" height="20" alt="0" /> <small class="pi-text-green">Djit Verfied</small></p>


            <!--<input checkbox-group class="pull-right" type="checkbox" />-->
        </h3>

        <!--<p class="pi-italic pi-text-base pi-margin-bottom-10">Different Thinks But Better</p>-->

        <p>{{$individual->overview}}</p>

        <ul class="oInlineListExt">
            @if($individual->freelancer_price)
            <li><strong>{{$individual->freelancer_price}}</strong> HOURLY RATE</li>
            @endif
            <li><span class="star"></span>
                <span class="star"></span>
                <span class="star"></span>
                <span class="star"></span>
                <span class="star"></span>
                <b>5.0</b>
            </li>
            <li><strong>1204</strong> HOURS</li>
            <li><i class="icon-home"></i><strong> {{$individual->address_country}}</strong></li>
            <?php
            $relatedTags = $individual->RelatedTags;
            $testTaken = 0;
            if(count($relatedTags))
            {
                foreach($relatedTags as $rt)
                {
                    if($rt->test_taken && $rt->score != null)
                        $testTaken++;
                }
            }
            ?>
            <li><strong>{{$testTaken}}</strong> TESTS</li>

        </ul>

        @if(count($relatedTags))
        <ul class="cat-link clearFix" style="padding-left:0;">
            @foreach($relatedTags as $rt)
            <li><a class="" href="#">{{$rt->GetTag->category_name}}</a></li>
            @endforeach
        </ul>
        @endif

        <hr class="pi-divider pi-divider-dashed clearfix">

    </div>
    @endforeach
</div>
@endif
<!-- End tab content -->




<!-- End col 6 -->


</div>
<!-- End row -->

<!-- End tab content -->

</div>
</div>
<!-- End tabs -->
@else

Sorry! no profile found

@endif
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