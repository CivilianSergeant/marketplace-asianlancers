@extends('templates.default.default')

@section('content')
<script type="text/javascript">
    var job_categories = {{$job_categories}};
</script>
<script type="text/javascript" src="{{$theme}}js/custom/common/common.js"></script>
<script type="text/javascript" src="{{$theme}}js/custom/front/frontcontroller.js"></script>

<div class="tp-banner-container free-bann">
    <div class="tp-banner pi-revolution-slider" >
        <ul class="">
            <!-- SLIDE -->
            <li data-transition="fade" data-slotamount="1" data-masterspeed="1000" style="text-align:center; " >
                <!-- MAIN IMAGE -->
                <img src="{{$theme}}img_external/revolution-slider/client_hero.jpg"  alt=""  data-bgfit="cover" data-bgposition="center top" data-bgrepeat="no-repeat">
                <!-- LAYERS -->
                <!-- LAYER NR. 3 -->
                <div class="tp-caption sft str popo-text"
                     data-x="350" data-hoffset="0"
                     data-y="157"
                     data-speed="500"
                     data-start="2400"
                     data-easing="Back.easeInOut"
                     data-endspeed="300"
                     style="z-index: 5; font-size: 34px; color: #21252b; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; line-height: 40px; background: rgba(255, 255, 255, 0.9); padding: 12px 16px; border-radius: 3px; box-shadow: 0 1px 1px rgba(0,0,0,0.15);">{{Translate::get("Find talented freelancers",$lang)}}</div>

                <!-- LAYER NR. 4 -->
                <div class="tp-caption sfl str popo-text2"
                     data-x="350" data-hoffset="0"
                     data-y="236"
                     data-speed="500"
                     data-start="2600"
                     data-easing="Back.easeInOut"
                     data-endspeed="300"
                     style="z-index: 6; font-size: 20px; color: #fff; font-weight: 300; line-height: 28px; background: rgba(33, 37, 43, 0.8); padding: 12px 16px; border-radius: 3px;">
                    {{Translate::get("Create cute websites fast with us!",$lang)}}
                </div>

                <!-- LAYER NR. 5 -->
                <div class="tp-caption sfb str popo-text3"
                     data-x="350" data-hoffset="0"
                     data-y="303"
                     data-speed="500"
                     data-start="2800"
                     data-easing="Back.easeInOut"
                     data-endspeed="300"
                     style="z-index:7;">
                    <a href="{{url('jobPost/new-job-create')}}" class="btn pi-btn-base">{{Translate::get("Post A Job!",$lang)}}</a>
                </div>

            </li>

        </ul>
    </div>
</div>

<span class="revolution-slider"></span>

<!-- - - - - - - - - - END SECTION - - - - - - - - - -->



<!-- - - - - - - - - - SECTION - - - - - - - - - -->


<div ng-controller="frontHomeController" ng-app="frontHomeApp" ng-cloak class="pi-section-w pi-section-white piCaptions" style="padding:2% 7% 5%; background:url({{$theme}}img/noise.png) repeat; background-color: rgba(241, 245, 249, 1); text-align:center;">
    <h1 class="lead-30 pi-text-dark pi-text-center" style="padding:2% 10%; text-transform:uppercase;">FIND FREELANCERS BEST SUITED FOR YOUR PROJECT<br/>
        <p class="lead-20 pi-text-dark pi-text-center pi-padding-top-20" style="text-transform:none; margin:0;">Skilled Programmer, game designer, Apps developer and many more different amazing freelancers are here to serve you</p>
    </h1>

    <div class="pi-container">
        <div class="pi-row pi-show-grid polo">
            <a href="#" class="pi-col-lg-4 box-1" ng-value="@{{showValue(0)}}" ng-click="setValueLocal(0)" ><img src="{{$theme}}img/Logos/web-design.png" class="pi-margin-top-15 pi-margin-bottom-15" alt="0" /><br/><span>@{{showText(0)}}</span></a>
            <a href="#" class="pi-col-lg-4 box-2" ng-value="@{{showValue(1)}}" ng-click="setValueLocal(1)" ><img src="{{$theme}}img/Logos/development.png" class="pi-margin-top-15 pi-margin-bottom-10" alt="0" /><br/><span>@{{showText(1)}}</span></a>
            <a href="#" class="pi-col-lg-4 box-3" ng-value="@{{showValue(2)}}" ng-click="setValueLocal(2)" ><img src="{{$theme}}img/Logos/graphic.png" class="pi-margin-top-15 pi-margin-bottom-10" alt="0" /><br/><span>@{{showText(2)}}</span></a>
            <a href="#" class="pi-col-lg-4 box-4" ng-value="@{{showValue(3)}}" ng-click="setValueLocal(3)" ><img src="{{$theme}}img/Logos/mobile-apps.png" class="pi-margin-top-15 pi-margin-bottom-10" alt="0" /><br/><span>@{{showText(3)}}</span></a>
            <a href="#" class="pi-col-lg-4 box-5" ng-value="@{{showValue(4)}}" ng-click="setValueLocal(4)" ><img src="{{$theme}}img/Logos/shop.png" class="pi-margin-top-15 pi-margin-bottom-10" alt="0" /><br/><span>@{{showText(4)}}</span></a>
            <a href="#" class="pi-col-lg-4 box-6" ng-value="@{{showValue(5)}}" ng-click="setValueLocal(5)" ><img src="{{$theme}}img/Logos/seo.png" class="pi-margin-top-15 pi-margin-bottom-10" alt="0" /><br/><span>@{{showText(5)}}</span></a>
        </div>
    </div>



</div>




<!-- - - - - - - - - - END SECTION - - - - - - - - - -->



<!-- <div class="pi-section-w pi-section-white">
    <div class="pi-section pi-padding-bottom-10">

       
        <div class="pi-row">

          
            <div class="pi-col-sm-10 pi-col-sm-offset-1 pi-padding-bottom-60">
                <p class="lead-30 pi-text-dark pi-text-center">
                    Nam libero tempore, <span class="pi-text-bg-base">cum soluta</span> nobis est optio cumque nihil
                    impedit quo minus id quod maxime
                </p>
            </div>
          

        </div>
       
        <div class="pi-row">


            


        </div>
        

    </div>
</div> -->

{{Theme::make('partial.front-footer-top',array('total_jobs'=>$total_jobs,'total_freelancers'=>$total_freelancers,'total_paid'=>$total_paid,'total_clients'=>$total_clients))}}



@stop