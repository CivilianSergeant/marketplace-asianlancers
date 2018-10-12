<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <title>{{$title['title']}}</title>
    <link rel="shortcut icon" href="{{$theme}}img/favicon.png">
    <link rel="stylesheet" type="text/css" href="{{$theme}}bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/tabs.css"/>
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/style.css"/>
    <link rel="stylesheet" href="{{$theme}}js/plugin/select2/select2.css">
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/loader.css"/>
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/boxes.css"/>
    
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/tables.css"/>
    <link rel="stylesheet" type="text/css" href="{{$theme}}3dParty/rs-plugin/css/pi.settings.css"/>
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/slider.css"/>
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/counters.css"/>
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/shadows.css"/>
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/testimonials.css"/>
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/accordion.css"/>
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/tooltips.css"/>
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/dropcaps.css"/>

    <link rel="stylesheet" type="text/css" href="{{$theme}}css/galleries.css"/>
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/images.css"/>
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/portfolio.css"/>
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/alert-boxes.css"/>
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/animations.css"/>
    <link rel="stylesheet" type="text/css" href="{{$theme}}3dParty/colorbox/colorbox.css"/>
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/selectbox.css" />
    <link rel="stylesheet" href="{{$theme}}css/menu-style.css" type="text/css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="{{$theme}}js/plugin/bootstrap_validator/bootstrapValidator.min.css" />
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/flags/flags.css"/>
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/notification.css"/>
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/custom.css"/>
    

    <!--Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;subset=latin,cyrillic'
          rel='stylesheet' type='text/css'>
    <!--Fonts with Icons-->
    <link rel="stylesheet" href="{{$theme}}3dParty/fontello/css/fontello.css"/>
    <link rel="stylesheet" href="{{$theme}}3dParty/jquery-ui-1.11.1/jquery-ui.min.css"/>
    <!--[if lte IE 8]>
    <script src="{{$theme}}scripts/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="{{$theme}}3dParty/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="{{$theme}}js/library/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="{{$theme}}3dParty/jquery-ui-1.11.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{$theme}}js/plugin/select2/select2.js"></script>
    <script type="text/javascript" src="{{$theme}}js/plugin/timeago/jquery.timeago.js"></script>
    <script type="text/javascript" src="{{$theme}}js/library/angular-file-upload-shim.js"></script>
    <script type="text/javascript" src="{{$theme}}js/library/angular.js"></script>
    <script type="text/javascript" src="{{$theme}}js/library/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{$theme}}js/library/slider.js"></script>
    <script type="text/javascript" src="{{$theme}}js/library/angular-file-upload.min.js"></script>
    <script type="text/javascript" src="{{$theme}}js/plugin/select/select.js"></script>
    <script type="text/javascript" src="{{$theme}}js/plugin/angular_select2/an-select2.js"></script>


    <script type="text/javascript" src="{{$theme}}js/plugin/bootstrap_validator/bootstrapValidator.min.js"></script>
    <script type="text/javascript" src="{{$theme}}js/library/ui-bootstrap-tpls.js"></script>
    <link rel="stylesheet" href="{{$theme}}js/plugin/select/select.min.css" />
    <link rel="stylesheet" href="http://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css" />
    <script type="text/javascript">
        var BASE = "<?php echo url('/').'/' ?>";
        var defaultApp = angular.module('defaultApp',['ui.bootstrap'])
    </script>
</head>
<body>

<div id="pi-all">

    <!-- Header -->
    <div class="pi-main-header-w">

        <!-- Header row -->
        <div class="pi-section-w pi-section-header-w pi-section-base pi-section-header-sm-w pi-shadow-bottom pi-border-top-light">
            <div class="pi-section pi-section-header pi-section-header-sm pi-clearfix">

                <!-- Menu -->
                <div class="pi-header-block">
                    <ul class="pi-menu pi-has-hover-border pi-items-have-borders pi-full-height pi-hidden-xs">
                        <!-- Home -->
                        <li><a href="{{url('/')}}"><span>{{Translate::get("Home",$lang)}}</span></a></li>
                        <li><a href="{{url('http://asianlancers.com/view/page/how-it-work.html')}}"><span>{{Translate::getReturn("How It Works",$lang)}}</span></a></li>
                        <li><a href="#contact"><span>{{Translate::get("Contact",$lang)}}</span></a></li>
                        @if(!empty($authenticateUserInfo))
                            <li><a href="{{url('message')}}"><span><i class="icon-mail"></i>{{Translate::get("Message",$lang)}}</span> ({{$messageCount or 0}})</a></li>
                        @endif
                    </ul>

                </div>
                <!-- End menu -->

                <!-- Search -->
                <div class="pi-header-block pi-pull-right pi-hidden-sm">
                    <form class="form-inline" style="margin:0;" action="{{url('home/set-lang')}}" method="POST" role="form">
                        <input type="hidden" name="url" value="{{Request::url()}}"/>
                        <input type="hidden" name="lang" value="en"/>
                        <input type="submit" class="en-flag flag flag-us" name="us-btn" value="">
                    </form>
                    <form class="form-inline" style="margin:0;"  action="{{url('home/set-lang')}}" method="POST" role="form">
                        <input type="hidden" name="url" value="{{Request::url()}}"/>
                        <input type="hidden" name="lang" value="jpn"/>
                        <input type="submit" class="j-flag flag flag-jp" name="jpn-btn" value="">
                    </form>
                    @if(!empty($authenticateUserInfo))
                    @if(Request::Segment(1) != null)
                        <span class="btn-group">
                            <!--<button type="button" class="btn btn-danger">Action</button>-->

                            <button type="button" title="Notification" class="topStatusMenu btn pi-btn-small pi-btn-red dropdown-toggle">
                                <i class="icon-flag"></i> ( {{count($notifications)}} )
                                <!--<span class="caret"></span>
                                <span class="sr-only">Split button!</span>-->
                            </button>

                            <ul class="notification" id="nav" style="position:relative!important; left:-125px!important;">

                                <li id="notification_li">
                                    <div id="notificationContainer">
                                        <div id="notificationTitle">Notifications ({{count($notifications)}})</div>
                                        <div id="notificationsBody" class="notifications">
                                            @if(count($notifications))
                                            @foreach($notifications as $notify)
                                            <?php
                                            $senderId = $notify->sender_id;
                                            $senderType = $notify->sender_type;
                                            $sender = null;
                                            $imagePath = null;
                                            if($senderType == 'Client')
                                            {
                                                $sender = Client::find($senderId);
                                                $imagePath = url('cdn/client_profile/'.$sender->photos);
                                            }
                                            elseif($senderType == 'Freelancer')
                                            {
                                                $sender = Freelancer::find($senderId);
                                                if($sender->freelancer_type == 'Individual')
                                                    $imagePath = url('cdn/profile/freelancer/individual/'.$sender->photos);
                                                else
                                                    $imagePath = url('cdn/profile/freelancer/agency/'.$sender->photos);
                                            }
                                            else
                                            {
                                                $sender = Admin::find($senderId);
                                                $imagePath = url('cdn/profile/leader-1.png');
                                            }
                                            ?>
                                            <a href="{{url('freelancer/'.$notify->url.'/'.Helpers::EncodeDecode($notify->id))}}" class="noti-bar">
                                                <img src="{{$imagePath}}" width="50" height="50" alt="img"  />
                                                <div class="content">

                                                    <span class="n-title">{{$sender->getName()}}</span>
                                                    <span class="n-body">{{$notify->subject}}</span>
                                                    <span class="n-time">{{Helpers::dateTimeFormat('j F,Y',$notify->created_at)}}</span>
                                                </div>
                                            </a>

                                            @endforeach
                                            @else
                                                <span class="empty-mail"></span>
                                            @endif

                                        </div>
                                        <div id="notificationFooter"><a href="{{url('freelancer/notifications')}}">See All</a></div>
                                    </div>

                                </li>
                                </ul>

                        </span>
                    @endif
                    <a class="btn pi-btn-base-2 pi-btn-small" style="margin-top:2px;" href="#"> {{$authenticateUserInfo->email}} </a>
                    <span class="btn-group">
                        <!--<button type="button" class="btn btn-danger">Action</button>-->
                        <button type="button" class="topStatusMenuLogin btn pi-btn-small pi-btn-dark dropdown-toggle" style="margin-top:2px;">
                            <i class="icon-user"></i>
                            <!--<span class="caret"></span>
                            <span class="sr-only">Split button!</span>-->
                        </button>
                       <ul class="dropdown-menu" role="menu">
                            {{Theme::getMenu(strtolower($authenticateUserInfo->user_type),'popup')}}
                            <li class="divider"></li>
                            <li><a href="{{url('home/logout')}}">{{Translate::get("Logout",$lang)}}</a></li>
                        </ul>
                    </span>
                    @else

                    <a class="btn pi-btn-base-2 pi-btn-small" href="{{url('home/login')}}"> <i class="icon-login pi-icon-left"></i> {{Translate::get("Login",$lang)}} </a>
                    <a class="btn pi-btn-base-2 pi-btn-small" href="{{url('home/sign-up-freelancer')}}"> <i class="icon-login pi-icon-left"></i> {{Translate::get("Sign Up",$lang)}} </a>
                    @endif

                </div>
                <!-- End search -->

                <!-- Mobile menu button -->
                <div class="pi-header-block pi-pull-right pi-hidden-lg-only pi-hidden-md-only pi-hidden-sm-only">
                    @if(!empty($authenticateUserInfo))
                    @if(Request::Segment(1) != null && !in_array(Request::Segment(1),array('home','view')))
                    <span class="btn-group">
                        <!--<button type="button" class="btn btn-danger">Action</button>-->
                        <button type="button" title="Notification" class="topStatusMenuLogin btn pi-btn-small pi-btn-red dropdown-toggle">
                            <i class="icon-flag"></i> ({{count($notifications)}})
                            <!--<span class="caret"></span>
                            <span class="sr-only">Split button!</span>-->
                        </button>
                        <ul class="dropdown-menu" role="menu" style="left:0!important;">
                            @if(count($notifications))
                            @foreach($notifications as $notify)
                            <li><a href="{{url('freelancer/'.$notify->url.'/'.Helpers::EncodeDecode($notify->id))}}">{{$notify->subject}}</a></li>
                            <li class="divider"></li>
                            @endforeach
                            @else
                            <li><a>{{Translate::get("No Message found",$lang)}}</a></li>
                            @endif
                        </ul>
                    </span>
                    @endif
                    <a class="btn pi-btn-base-2 pi-btn-small" href="#"> {{$authenticateUserInfo->email}} </a>
                    <span class="btn-group topstatusmenu">
                        <!--<button type="button" class="btn btn-danger">Action</button>-->
                        <button type="button" class="topStatusMenuLogin btn pi-btn-small pi-btn-dark dropdown-toggle">
                            <i class="icon-user"></i>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            {{Theme::getMenu(strtolower($authenticateUserInfo->user_type),'popup')}}
                            <li class="divider"></li>
                            <li><a href="{{url('home/logout')}}">{{Translate::get("Logout",$lang)}}</a></li>
                        </ul>
                    </span>
                    @else
                    <a class="btn pi-btn-base-2 pi-btn-small" href="{{url('home/login')}}"> <i class="icon-login pi-icon-left"></i> {{Translate::get("Login",$lang)}} </a>
                    <a class="btn pi-btn-base-2 pi-btn-small" href="{{url('home/sign-up-freelancer')}}"> <i class="icon-login pi-icon-left"></i> {{Translate::get("Sign Up",$lang)}} </a>
                    @endif
                    <!--<button class="btn pi-btn pi-btn-dark pi-btn-no-border pi-mobile-menu-toggler"><i class="icon-menu pi-text-center"></i></button>-->
                </div>
                <!-- End mobile menu button -->

                <!-- Mobile menu -->
                <div class="pi-section-menu-mobile-w pi-section-dark">
                    <div class="pi-section-menu-mobile">

                        <!-- Search form -->
                        <form class="form-inline pi-search-form-wide ng-pristine ng-valid" role="form">
                            <div class="pi-input-with-icon">
                                <div class="pi-input-icon"><i class="icon-search-1"></i></div>
                                <input type="text" class="form-control pi-input-wide" placeholder="Search..">
                            </div>
                        </form>
                        <!-- End search form -->

                        <ul class="pi-menu-mobile pi-menu-mobile-dark">
                            <li><a href="#"><span>Home</span></a></li>
                            <li><a href="#"><span>Work</span></a></li>
                            <li><a href="#"><span>Contact us</span></a></li>
                        </ul>

                    </div>
                </div>

                <!-- End mobile menu -->

            </div>
        </div>
        <!-- End header row -->

        <div class="pi-header-row-sticky-w">
            <!-- Header row -->
            <div class="pi-section-w pi-section-header-w pi-section-white pi-section-header-lg-w pi-header-row-sticky pi-shadow-bottom">
                <div class="pi-section pi-section-header pi-section-header-lg pi-clearfix">

                    <!-- Logo -->
                    <div class="pi-header-block pi-header-block-logo">
                        <a href="{{url('http://asianlancers.com')}}"><img src="{{$theme}}img/logo-base.png" alt=""></a>
                    </div>
                    <!-- End logo -->
                    <!-- Menu -->
                    <div class="pi-header-block pi-pull-right">

                        <div class="pi-header-block pi-pull-right pi-hidden-sm">

<!--<div class="btn-group">
      <button class="btn btn-primary" style="margin-top:0;" type="button">Browse Categories</button>
      <button data-toggle="dropdown" style="margin-top:0;" class="btn btn-primary dropdown-toggle" type="button" aria-expanded="false">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
      </button>
      <ul role="menu" class="dropdown-menu new-cat-fre">
        <li><a href="#">Web Design</a></li>
        <li class="divider"></li>
        <li><a href="#">Web Programing</a></li>
        <li class="divider"></li>
        <li><a href="#">Graphics Design</a></li>
        <li class="divider"></li>
        <li><a href="#">Mobile Apps</a></li>
        <li class="divider"></li>
        <li><a href="#">Ecommerce</a></li>
        <li class="divider"></li>
        <li><a href="#">SEO-Search Engine Optimization</a></li>
      </ul>
    </div>-->



                            <?php $methodName = Request::segment(2);?>
                            <form class="pi-search-form-wide ng-pristine ng-valid pi-text-center pi-margin-bottom-20" method="post" action="{{url('search/jobs')}}" style="margin-top:28px;" role="form">
                                <select name="category" id="Items" class="form-control form-control-budjet" style="width:100%; height:38px;" >
                                    <option value="">{{Translate::get("Browse Categories",$lang)}}</option>
                                    @if(count($job_categories))
                                    @foreach($job_categories as $category)
                                    <?php

                                        $id = Helpers::EncodeDecode($category->id);

                                        $rid  = ($methodName == 'jobs' || $methodName == 'job') ? Request::segment(3) : '';

                                    ?>
                                    <option @if(!empty($rid) && $rid == $id) selected="selected" @endif value="{{$id}}">{{$category->title}}</option>
                                    <!--<option>Website programing</option>
                                    <option>Banner/graphic development</option>
                                    <option>Mobile apps development</option>
                                    <option>Ecommerce</option>
                                    <option>SEO</option>-->
                                    @endforeach
                                    @endif
                                </select>
                                <!--
                                <select name="Items2" id="Items2" class="selectbox2 form-control form-control-budjet" style="width:120px; height:38px;" >
                                <option>Jobs</option>
                                <option>Freelancers</option>
                                </select>-->




                                <div class="pi-input-inline" style="margin-right: -7px; width:270px;">
                                    <input class="form-control pi-input-wide" name="search_txt" placeholder="{{Translate::get("Search Jobs",$lang)}}" style="border-radius: 3px 0 0 3px; border-right-width: 0; width:100%;" type="text" >
                                </div>
                                <button type="submit" class="btn pi-btn-base pi-btn-icon-big" style="border-radius: 0 3px 3px 0;"><i class="icon-search"></i></button>

                            </form>

                        </div>
                    </div>
                    <!-- End menu -->

                    <!-- Mobile menu button -->
                    <div class="pi-header-block pi-pull-right pi-hidden-lg-only pi-hidden-md-only">
                        <button class="btn pi-btn pi-mobile-menu-toggler" data-target="#pi-main-mobile-menu">
                            <i class="icon-menu pi-text-center"></i>
                        </button>
                    </div>
                    <!-- End mobile menu button -->


                    <!-- Mobile menu -->
                    <div id="pi-main-mobile-menu" class="pi-section-menu-mobile-w pi-section-dark">
                        <div class="pi-section-menu-mobile">

                            <!-- Search form -->
                            <form class="form-inline pi-search-form-wide ng-pristine ng-valid" role="form">
                                <div class="pi-input-with-icon">
                                    <div class="pi-input-icon"><i class="icon-search-1"></i></div>
                                    <input type="text" class="form-control pi-input-wide" placeholder="Search..">
                                </div>
                            </form>
                            <!-- End search form -->

                            <ul class="pi-menu-mobile pi-items-have-borders pi-menu-mobile-dark">
                                <li class="active"><a href="{{url('/')}}"><span>{{Translate::get("Home",$lang)}}</span></a></li>
                                <li><a href="#"><span>{{Translate::get("Work",$lang)}}</span></a></li>
                                <li><a href="#"><span>{{Translate::get("Contact us",$lang)}}</span></a></li>
                            </ul>

                        </div>
                    </div>
                    <!-- End mobile menu -->

                </div>
            </div>
            <!-- End header row -->
        </div>

    </div>
    <!-- End header -->

    <div id="page"><!-- - - - - - - - - - SECTION - - - - - - - - - -->
        @yield('content')
    </div>


    <div class="pi-section-w pi-border-bottom pi-border-top-light pi-section-grey">

        <div class="pi-section pi-padding-bottom-10">

            <!-- Row -->
            <div class="pi-row">

                <!-- Col 4 -->
                <div class="pi-col-md-4 pi-padding-bottom-30">

                    <!-- <h6 class="pi-margin-bottom-25 pi-weight-700 pi-uppercase pi-letter-spacing">
                        <a href="#" class="pi-link-no-style">{{Translate::get("Latest Tweet",$lang)}}</a>
                    </h6> -->
                    {{Widget::get('twitter')}}
                    <!-- Twitter -->
                    
                    <!-- End twitter -->

                </div>
                <!-- End col 4 -->

                <div class="pi-clearfix pi-hidden-lg-only pi-hidden-md-only"></div>

                <!-- Col 4 -->
                <a name="contact">&nbsp;</a>
                <div class="pi-col-md-4 pi-col-sm-6 pi-padding-bottom-30">

                    <h6 class="pi-margin-bottom-20 pi-weight-700 pi-uppercase pi-letter-spacing">
                        {{Translate::get("Contact",$lang)}}
                    </h6>
                    {{Widget::get('contact')}}

                </div>
                <!-- End col 4 -->

                <!-- Col 4 -->
                <div class="pi-col-md-4 pi-col-sm-6 pi-padding-bottom-30">

                    <h6 class="pi-margin-bottom-15 pi-weight-700 pi-uppercase pi-letter-spacing">
                        {{Translate::get("Follow Us",$lang)}}
                    </h6>
                    <ul class="pi-social-icons-simple pi-clearfix">
                        <li><a href="{{url('https://www.facebook.com/asianlancers?ref=hl')}}" class="pi-social-icon-dribbble"><i class="icon-facebook"></i></a></li>
                        <li><a href="{{url('https://twitter.com/asianlancers')}}" class="pi-social-icon-twitter"><i class="icon-twitter"></i></a></li>
                        <!-- <li><a href="#" class="pi-social-icon-linkedin"><i class="icon-linkedin"></i></a></li> -->
                    </ul>

                    <!-- Subscribe form -->
                    <form class="pi-grouped-input pi-pi-search-form-wide pi-margin-bottom-10">
                        <button type="submit" class="btn pi-btn-base"><i class="icon-mail"></i></button>
                        <div class="pi-input-inline">
                            <input class="form-control pi-input-wide" placeholder="{{Translate::get("Enter e-mail for subscribe",$lang)}}" type="text">
                        </div>
                    </form>
                    <!-- End subscribe form -->

                    <p class="pi-smaller-text pi-italic pi-letter-spacing pi-text-opacity-70">
                        {{Translate::get("We promise not to send you spam",$lang)}} 
                    </p>

                </div>
                <!-- End col 4 -->

            </div>
            <!-- End row -->

        </div>

    </div>

    <div class="pi-section-w pi-section-header-w pi-section-grey pi-border-top-light pi-border-bottom-strong-base pi-section-header-md-w">

        <div class="pi-section pi-section-header pi-section-header-md pi-center-text-2xs pi-clearfix">

            <!-- Menu -->
            <!-- <div class="pi-header-block pi-center-text-lg">
                <ul class="pi-simple-menu pi-full-height pi-hidden-xs">

                    <li>
                        <a href="#"><span>{{Translate::get("Help",$lang)}}</span></a>
                    </li>
                    <li>
                        <a href="#"><span>{{Translate::get("Privacy",$lang)}}</span></a>
                    </li>
                    <li>
                        <a href="#"><span>{{Translate::get("Terms",$lang)}}</span></a>
                    </li>

                </ul>
            </div> -->
            <!-- End menu -->

            <!-- Text -->
		<span style="margin-right: 0px;" class="pi-header-block pi-header-block-txt pi-hidden-xs">© 2014. <a href="http://asianlancers.com" class="pi-link-no-style">asianlancers.com</a>
		</span>
            <!-- End text -->

        </div>

    </div>


</div>
<div class="pi-scroll-top-arrow" data-scroll-to="0"></div>

<!--<script src="{{$theme}}3dParty/jquery-1.11.0.min.js"></script>-->
<script src="{{$theme}}scripts/pi.easings.js"></script>
<script src="{{$theme}}scripts/pi.helpers.js"></script>
<script src="{{$theme}}scripts/pi.boundManager.js"></script>
<script src="{{$theme}}3dParty/inview.js"></script>
<script src="{{$theme}}scripts/pi.imagesLoader.js"></script>
<script src="{{$theme}}scripts/pi.columnFix.js"></script>
<script src="{{$theme}}scripts/pi.init.caption.js"></script>
<script src="{{$theme}}scripts/pi.slider.js"></script>
<script src="{{$theme}}scripts/pi.init.slider.js"></script>
<script src="{{$theme}}3dParty/gauge.min.js"></script>
<script src="{{$theme}}scripts/pi.counter.js"></script>
<script src="{{$theme}}scripts/pi.init.counter.js"></script>
<script src="{{$theme}}scripts/pi.parallax.js"></script>
<script src="{{$theme}}scripts/pi.init.parallax.js"></script>
<script src="{{$theme}}3dParty/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script src="{{$theme}}3dParty/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="{{$theme}}scripts/pi.init.revolutionSlider.js"></script>
<script src="{{$theme}}scripts/pi.init.social.js"></script>
<script src="{{$theme}}scripts/pi.ddMenu.js"></script>
<script src="{{$theme}}scripts/pi.init.removeLastElMargin.js"></script>
<script src="{{$theme}}scripts/pi.fixedHeader.js"></script>
<script src="{{$theme}}scripts/pi.mobileMenu.js"></script>
<script src="{{$theme}}scripts/pi.init.submitFormFooter.js"></script>
<script src="{{$theme}}scripts/pi.detectTransition.js"></script>
<script src="{{$theme}}scripts/pi.alert.js"></script>
<script src="{{$theme}}scripts/pi.init.formsBlurClasses.js"></script>
<script src="{{$theme}}scripts/pi.init.placeholder.js"></script>
<script src="{{$theme}}3dParty/colorbox/jquery.colorbox-min.js"></script>
<script src="{{$theme}}scripts/pi.init.colorbox.js"></script>
<script src="{{$theme}}3dParty/jquery.easing.1.3.js"></script>
<script src="{{$theme}}3dParty/jquery.scrollTo.min.js"></script>
<script src="{{$theme}}scripts/pi.init.jqueryScrollTo.js"></script>
<script src="{{$theme}}scripts/pi.scrollTopArrow.js"></script>
<script type="text/javascript" src="{{$theme}}3dParty/jquery.selectbox-0.5.js"></script>
<script src="http://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        //$('#Items').selectbox();
        $('#Items2').selectbox();
        $('#Items').selectbox();
        $('.selectbox2').selectbox();
        /*$(".topStatusMenu").click(function(){

            $(this).next().toggleClass('display');
        });*/

        $(window).load(function(){
            $("#notificationsBody").mCustomScrollbar({
                theme:"dark",
                scrollButtons:{
                    enable:true
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        var $menu = $('#ldd_menu');
        $menu.children('li').each(function(){
            var $this = $(this);
            var $span = $this.children('span');
            $span.data('width',$span.width());

            $this.bind('mouseenter',function(){
                $menu.find('.ldd_submenu').stop(true,true).hide();
                $span.stop().animate({'width':'auto'},300,function(){
                    $this.find('.ldd_submenu').slideDown(300);
                });
            }).bind('mouseleave',function(){
                $this.find('.ldd_submenu').stop(true,true).slideUp();
                $span.stop().animate({'width':$span.data('width')+'px'},300);
            });
        });

        $(".topStatusMenu").click(function(){
            $(".dropdown-menu").removeClass('display-login-menu');
            $("ul#nav").toggleClass('display');

        });
        $(".topStatusMenuLogin").click(function(){
            $("ul#nav").removeClass('display');
            $(this).next().toggleClass('display-login-menu');
        });
    });
</script>
</body>
</html>