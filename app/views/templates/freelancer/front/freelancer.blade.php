@extends('templates.freelancer.freelancer')

@section('content')


<div class="tp-banner-container free-bann">
    <div class="tp-banner pi-revolution-slider" >
        <ul class="">
            <!-- SLIDE -->
            <li data-transition="fade" data-slotamount="1" data-masterspeed="1000" style="text-align:center; " >
                <img src="{{$theme}}img/freelancer.jpg"  alt=""  data-bgfit="cover" data-bgposition="center top" data-bgrepeat="no-repeat">
                <div class="free-box"><h1>118,026 Jobs</h1><span>posted in past 30 days</span></div>

            </li>

        </ul>
    </div>
</div>

<span class="revolution-slider"></span>

<!-- - - - - - - - - - END SECTION - - - - - - - - - -->



<!-- - - - - - - - - - SECTION - - - - - - - - - -->


<div class="pi-section-w pi-section-white piCaptions" style="padding:3% 7% 3%; background:#FFF; text-align:center;">
    <h1 class="lead-30 pi-text-dark pi-text-center" style="padding:2% 10%; text-transform:uppercase;">
        Find freelancing projects from our online market place<br/>
        <p class="lead-20 pi-text-dark pi-text-center pi-padding-top-20 pi-margin-bottom-25" style="text-transform:none;">
            Skilled Programmer, game designer, Apps developer and many more different amazing freelancers are here to serve you
        </p>
    </h1>

    <div class="pi-container">
        <div class="row">
            
            @if(count($job_categories))
                @foreach($job_categories as $i => $category)
                    <div class="col-md-4">
                        <div style="" class="services-post{{(($i>0)? $i+1 : '')}} triggerAnimation animated fadeInLeft" data-animate="fadeInLeft">
                            <a href="{{url('search/jobs/'.Helpers::EncodeDecode($category->id))}}">
                                <i class="fa fa-globe">
                                    <img src="{{$theme}}img/Logos/{{$i+1}}.png" alt="" />
                                </i>
                            </a>
                            <div class="services-post-content">
                                <h3>{{$category->title}}</h3>
                                <p>{{$category->description}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
            <h1 class="lead-30  pi-text-orange pi-text-center" style="padding:2% 10%; text-transform:uppercase;">
                Opps! Jobs Category may not created yet.
            </h1>
            @endif
            <!--<div class="col-md-4">
                <div style="" class="services-post2 triggerAnimation animated fadeInUp" data-animate="fadeInUp">
                    <a href="Job-list-view.html">
                        <i class="fa fa-globe">
                            <img src="{{$theme}}img/Logos/development.png" alt="0" />
                        </i>
                    </a>
                    <div class="services-post-content">
                        <h3>Website programing</h3>
                        <p>Lorem Ipsum is simply dummy text of the printingry.</p>
                    </div>
                </div>
            </div>-->

            <!--<div class="col-md-4">
                <div style="" class="services-post3 triggerAnimation animated fadeInRight" data-animate="fadeInRight">
                    <a href="Job-list-view.html">
                        <i class="fa fa-print">
                            <img src="{{$theme}}img/Logos/graphic.png" alt="" />
                        </i>
                    </a>
                    <div class="services-post-content">
                        <h3>Banner/graphic development</h3>
                        <p>Lorem Ipsum is simply du.</p>
                    </div>
                </div>
            </div>-->

            <!--<div class="col-md-4">
                <div style="" class="services-post4 triggerAnimation animated fadeInLeft" data-animate="fadeInLeft">
                    <a href="Job-list-view.html">
                        <i class="fa fa-tasks">
                            <img src="{{$theme}}img/Logos/mobile-apps.png" alt="0" />
                        </i>
                    </a>
                    <div class="services-post-content">
                        <h3>Mobile apps development</h3>
                        <p>Lorem Ipsum is simply dum.</p>
                    </div>
                </div>
            </div>-->

            <!--<div class="col-md-4">
                <div style="" class="services-post5 triggerAnimation animated fadeInDown" data-animate="fadeInDown">
                    <a href="Job-list-view.html">
                        <i class="fa fa-hdd-o">
                            <img src="{{$theme}}img/Logos/shop.png" alt="0" />
                        </i>
                    </a>
                    <div class="services-post-content">
                        <h3>Ecommerce</h3>
                        <p>Lorem Ipsum is simply dummy text of the printingry.</p>
                    </div>
                </div>
            </div>-->

            <!--<div class="col-md-4">
                <div style="" class="services-post6 triggerAnimation animated fadeInRight" data-animate="fadeInRight">
                    <a href="Job-list-view.html">
                        <i class="fa fa-cloud">
                            <img src="{{$theme}}img/Logos/seo.png" alt="0" />
                        </i>
                    </a>
                    <div class="services-post-content">
                        <h3>SEO</h3>
                        <p>Lorem Ipsum is simply dummy text of the printingry.</p>
                    </div>
                </div>
            </div>-->
        </div>

    </div>



</div>




<!-- - - - - - - - - - END SECTION - - - - - - - - - -->




{{Theme::make('partial.front-footer-top',array())}}



@stop