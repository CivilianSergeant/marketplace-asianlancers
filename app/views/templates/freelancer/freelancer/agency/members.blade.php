@extends('templates.freelancer.freelancer')

@section('content')
<!-- Breadcrumbs -->

<div class="pi-section-w pi-border-bottom pi-section-grey">
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('freelancer/overview')}}">Overview</a></li>
                <li><a href="#">members</a></li>
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



                    @if(count($members))
                    <div class="pi-row pi-liquid-col-sm-3 pi-liquid-col-xs-2 pi-gallery pi-stacked">
                        <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25 pi-has-bg">
                            {{Translate::get("My Agencies",$lang)}} :
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
                                @if($member->status == 'Accepted')
                                <i class="avai"><img src="{{$theme}}img/available.png" width="15" height="15" alt="available" > Active </i>
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
                </div>
            </div>
        </div>
    </div>
</div>
@stop