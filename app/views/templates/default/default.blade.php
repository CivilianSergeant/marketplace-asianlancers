<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <title>{{$title['title']}}</title>

    <link rel="shortcut icon" href="{{$theme}}img/favicon.png">

    <link rel="stylesheet" type="text/css" href="{{$theme}}css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/style.css"/>
    <link rel="stylesheet" href="{{$theme}}js/plugin/select2/select2.css">

    <link rel="stylesheet" type="text/css" href="{{$theme}}css/loader.css"/>
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/boxes.css"/>
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/tabs.css"/>
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/tables.css"/>
    <link rel="stylesheet" type="text/css" href="{{$theme}}css/pricing-tables.css"/>
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
    <link rel="stylesheet" type="text/css" href="{{$theme}}js/plugin/trumbowyg/dist/ui/trumbowyg.min.css"/>
    <!--Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;subset=latin,cyrillic'
          rel='stylesheet' type='text/css'>
    <!--Fonts with Icons-->
    <link rel="stylesheet" href="{{$theme}}3dParty/fontello/css/fontello.css"/>
    <!--[if lte IE 8]>
    <script src="{{$theme}}scripts/respond.min.js"></script>
    <![endif]-->

    <!-- Fix for old browsers for file upload -->
    <script src="{{$theme}}js/plugin/angular_file_upload/es5-shim.min.js"></script>
    <script src="{{$theme}}js/plugin/angular_file_upload/es5-sham.min.js"></script>

    <script type="text/javascript" src="{{$theme}}3dParty/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="{{$theme}}js/library/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="{{$theme}}js/plugin/select2/select2.js"></script>
    <script type="text/javascript" src="{{$theme}}js/plugin/timeago/jquery.timeago.js"></script>
    <script type="text/javascript" src="{{$theme}}js/plugin/angular_file_upload/console-sham.js"></script>
    <script type="text/javascript" src="{{$theme}}js/library/angular.js"></script>
    <script type="text/javascript" src="{{$theme}}js/library/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{$theme}}js/plugin/angular_file_upload/angular-file-upload.js"></script>
    <script type="text/javascript" src="{{$theme}}js/plugin/select/select.js"></script>
    <script type="text/javascript" src="{{$theme}}js/plugin/angular_select2/an-select2.js"></script>


    <script type="text/javascript" src="{{$theme}}js/plugin/bootstrap_validator/bootstrapValidator.min.js"></script>
    <script type="text/javascript" src="{{$theme}}js/library/ui-bootstrap-tpls.js"></script>
    <script type="text/javascript" src="{{$theme}}js/plugin/trumbowyg/dist/trumbowyg.min.js"></script>
    <script type="text/javascript">
        var BASE = "<?php echo url('/').'/' ?>";
        var defaultApp = angular.module('defaultApp',['ui.bootstrap']);

    </script>
    <link rel="stylesheet" href="{{$theme}}js/plugin/select/select.min.css" />
    <link rel="stylesheet" href="http://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css" />
</head>
<body>

<div id="pi-all">

    <!-- Header -->
    <div class="pi-main-header-w">

        <!-- Header row -->
        <div class="pi-section-w pi-section-header-w pi-section-dark pi-section-header-sm-w pi-shadow-bottom pi-border-top-light">
            <div class="pi-section pi-section-header pi-section-header-sm pi-clearfix">

                <!-- Menu -->
                <div class="pi-header-block">
                    <ul class="pi-menu pi-has-hover-border pi-items-have-borders pi-full-height pi-hidden-xs">
                        <!-- Home -->
                        <li><a href="{{url('/')}}"><span>{{Translate::get("Home",$lang)}}</span></a></li>
                        <li><a href="{{url('http://asianlancers.com/view/page/how-it-work.html')}}"><span>{{Translate::get("How It Works",$lang)}}</span></a></li>
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
                    @if(Request::Segment(1) != null && !in_array(Request::Segment(1),array('home','price')))
                    <span class="btn-group ">
                        <!--<button type="button" class="btn btn-danger">Action</button>-->
                        @if(!empty($notifications) && count($notifications))
                        <button type="button" title="Notification" class="topStatusMenu btn pi-btn-small pi-btn-red dropdown-toggle">
                            <i class="icon-flag"></i> ({{count($notifications)}})
                            <!--<span class="caret"></span>
                            <span class="sr-only">Split button!</span>-->
                        </button>

                        <!--<ul  role="menu">
                            @if(count($notifications))
                            @foreach($notifications as $notify)
                            <li><a href="{{url($notify->url.'/'.Helpers::EncodeDecode($notify->id))}}">{{$notify->subject}}</a></li>
                            <li class="divider"></li>
                            @endforeach
                            @else
                            <li><a>No Message found</a></li>
                            @endif
                        </ul>-->
                        <ul class="notification" id="nav" style="left:-125px!important;" >


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
                                                $photos = (!empty($sender->photos))? 'cdn/profile/freelancer/individual/'.$sender->photos : 'cdn/profile/leader-1.png';
                                            else
                                                $photos = (!empty($sender->photos))? 'cdn/profile/freelancer/agency/'.$sender->photos : 'cdn/profile/leader-1.png';

                                            $imagePath = url($photos);
                                        }
                                        else
                                        {
                                            $sender = Admin::find($senderId);
                                            $imagePath = url('cdn/profile/leader-1.png');
                                        }
                                        ?>
                                        <a href="{{url($notify->url.'/'.Helpers::EncodeDecode($notify->id))}}" class="noti-bar">
                                            <img src="{{$imagePath}}" class="img-responsive" width="50" height="50" alt="img"  />
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
                                    <div id="notificationFooter"><a href="#">See All</a></div>
                                </div>

                            </li>





                        </ul>
                        @endif
                    </span>
                    @endif
                    <a class="btn pi-btn-dark pi-btn-small" href="#"> {{$authenticateUserInfo->email}} </a>
                    <span class="btn-group">
                        <!--<button type="button" class="btn btn-danger">Action</button>-->
                        <button type="button" class="topStatusMenuLogin btn pi-btn-small pi-btn-base dropdown-toggle">
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
                    <a class="btn pi-btn-dark pi-btn-small" href="{{url('home/login')}}"> <i class="icon-login pi-icon-left"></i> {{Translate::get("Login",$lang)}} </a>
                    <a class="btn pi-btn-dark pi-btn-small" href="{{url('home/sign-up-client')}}"> <i class="icon-login pi-icon-left"></i> {{Translate::get("Sign Up",$lang)}} </a>
                    @endif

                </div>
                <!-- End search -->

                <!-- Mobile menu button -->
                <div class="pi-header-block pi-pull-right pi-hidden-lg-only pi-hidden-md-only pi-hidden-sm-only">
<!--                    <button class="btn pi-btn pi-btn-dark pi-btn-no-border pi-mobile-menu-toggler"><i class="icon-menu pi-text-center"></i></button>-->

                    @if(!empty($authenticateUserInfo))
                    <a class="btn pi-btn-dark pi-btn-small" href="#"> {{$authenticateUserInfo->email}} </a>
                    <span class="btn-group topstatusmenu">
                        <!--<button type="button" class="btn btn-danger">Action</button>-->
                        <button type="button" id="topStatusMenu" class="btn pi-btn-small pi-btn-base dropdown-toggle">
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
                    <a class="btn pi-btn-dark pi-btn-small" href="{{url('home/login')}}"> <i class="icon-login pi-icon-left"></i> {{Translate::get("Login",$lang)}} </a>
                    <a class="btn pi-btn-dark pi-btn-small" href="{{url('home/sign-up-client')}}"> <i class="icon-login pi-icon-left"></i> {{Translate::get("Sign Up",$lang)}} </a>
                    @endif

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
                            <li><a href="{{url('/')}}"><span>{{Translate::get("Home",$lang)}}</span></a></li>
                            <li><a href="#"><span>{{Translate::get("Work",$lang)}}</span></a></li>
                            <li><a href="#"><span>{{Translate::get("Contact us",$lang)}}</span></a></li>
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

                            <?php $methodName = Request::segment(2); ?>
                            <form class="pi-search-form-wide ng-pristine ng-valid pi-text-center pi-margin-bottom-20" method="post" action="{{url('search/jobs')}}" style="margin-top:28px;" role="form">
                                <select name="category" id="Items" class="form-control form-control-budjet" style="width:165px; height:38px;" >
                                    <option value="">{{Translate::get("Browse Categories",$lang)}}</option>
                                    @if(count($job_categories))
                                    @foreach($job_categories as $category)
                                    <?php

                                    $id = Helpers::EncodeDecode($category->id);

                                    $rid  = ($methodName == 'jobs' || $methodName == 'job' || $methodName == 'price' || (Request::segment(1)=='search' && $methodName == 'freelancer')) ? Request::segment(3) : '';


                                    ?>
                                    <option @if(!empty($rid) && $rid == $id) selected="selected" @endif value="{{$id}}">{{$category->title}}</option>
                                    @endforeach
                                    @endif
                                </select>




                                <div class="pi-input-inline" style="margin-right: -7px; width:270px;">
                                    <input class="form-control pi-input-wide" name="search_txt" placeholder="{{Translate::get('Search Jobs',$lang)}}" style="border-radius: 3px 0 0 3px; border-right-width: 0; width:100%;" type="text" >
                                </div>
                                <button type="submit" class="btn pi-btn-base pi-btn-icon-big" style="border-radius: 0 3px 3px 0;"><i class="icon-search"></i></button>

                            </form>

<!--                            <form class="pi-search-form-wide ng-pristine ng-valid pi-text-center pi-margin-bottom-20" style="margin-top:28px;" role="form">-->
<!--                                <select name="Items" id="Items" class="form-control form-control-budjet" style="width:165px; height:38px;" >-->
<!--                                    <option>Browse Categories</option>-->
<!---->
<!--                                    <option>Web Development</option>-->
<!--                                    <option>Software Development</option>-->
<!--                                    <option>Networking & Info Systems</option>-->
<!--                                    <option>Writing & Translation</option>-->
<!--                                    <option>Administrative Support</option>-->
<!--                                    <option>Design & Multimedia</option>-->
<!--                                    <option>Customer Service</option>-->
<!--                                    <option>Sales & Marketing</option>-->
<!--                                    <option>Business Services</option>-->
<!--                                    <option>View All Categories</option>-->
<!---->
<!--                                </select>-->
<!---->
<!--                                <div class="pi-input-inline" style="margin-right: -7px; width:270px;">-->
<!--                                    <input class="form-control pi-input-wide" id="exampleInputSearch" placeholder="e.g. Inspiration" style="border-radius: 3px 0 0 3px; border-right-width: 0; width:100%;" type="text" >-->
<!--                                </div>-->
<!--                                <button type="submit" class="btn pi-btn-base pi-btn-icon-big" style="border-radius: 0 3px 3px 0;"><i class="icon-search"></i></button>-->
<!---->
<!--                            </form>-->

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

    <!-- - - - - - - - - - END SECTION - - - - - - - - - -->
    </div>

    <!-- Footer -->
    <!-- Widget area -->
    <div class="pi-section-w pi-border-bottom pi-border-top-light pi-section-grey">
        <div class="pi-section pi-padding-bottom-10">

            <!-- Row -->
            <div class="pi-row">

                <!-- Col 4 -->
                <div class="pi-col-md-4 pi-padding-bottom-30">

                    <!-- <h6 class="pi-margin-bottom-25 pi-weight-700 pi-uppercase pi-letter-spacing">
                        <a href="#" class="pi-link-no-style">{{Translate::get("Latest Tweet",$lang)}}</a>
                    </h6> -->
                    <div id="pi-footer-tweets" class="tw" style="height:200px;">
                        <?php echo Widget::get('twitter'); ?>
                    </div>
                    <!-- Twitter -->
                   <!--  <div id="pi-footer-tweets">
                        <ul class="pi-bullets-circle pi-bullets-base pi-bullets pi-list-big-margins">
                            <li><span class="pi-bullet-icon">
                <i class="icon-twitter"></i></span><a href="{{url('https://twitter.com/asianlancers')}}" target="_blank" title="Asianlancers on Twitter">@asianlancers</a> Meet asianlancers alpha version a lot new things are coming soon. <br><span class="pi-smaller-text pi-italic pi-text-opacity-50">Jan. 29, 2015</span></li>
                            <li><span class="pi-bullet-icon"><i class="icon-twitter"></i></span><a href="{{url('https://twitter.com/asianlancers')}}" target="_blank" title="Asianlancers on Twitter">@asianlancers</a> Hey, this is Asianlancers Twitter account! <br><span class="pi-smaller-text pi-italic pi-text-opacity-50">Jan. 29, 2015</span></li></ul></div> -->
                    <!-- End twitter -->

                </div>
                <!-- End col 4 -->

                <div class="pi-clearfix pi-hidden-lg-only pi-hidden-md-only"></div>

                <!-- Col 4 -->
                <div class="pi-col-md-4 pi-col-sm-6 pi-padding-bottom-30" style="background-image: url('{{$theme}}img/map-base.png'); background-position: 50% 55px; background-repeat: no-repeat;">
                    <a name="contact">&nbsp;</a>    
                    <h6 class="pi-margin-bottom-25 pi-weight-700 pi-uppercase pi-letter-spacing">
                        {{Translate::get("Contact Us",$lang)}}
                    </h6>

                    <!-- Contact info -->
                    {{Widget::get('contact')}}
                    <!-- End contact info -->

                </div>
                <!-- End col 4 -->

                <!-- Col 4 -->
                <div class="pi-col-md-4 pi-col-sm-6 pi-padding-bottom-30">

                    <h6 class="pi-margin-bottom-25 pi-weight-700 pi-uppercase pi-letter-spacing">
                        {{Translate::get("Newsletter Subscription",$lang)}}
                    </h6>

                    <!-- Contact form -->
                    <form role="form" action="#" class="pi-footer-form">
                        <div class="pi-error-container"></div>
                        <div class="pi-row pi-grid-small-margins">
                            <!-- <div class="pi-col-2xs-6">
                                <div class="form-group">
                                    <div class="pi-input-with-icon">
                                        <div class="pi-input-icon"><i class="icon-user"></i></div>
                                        <input class="form-control form-control-name" id="exampleInputName"
                                               placeholder="Name">
                                    </div>
                                </div>
                            </div> -->
                            <div class="pi-col-2xs-12">
                                <div class="form-group">
                                    <div class="pi-input-with-icon">
                                        <div class="pi-input-icon"><i class="icon-mail"></i></div>
                                        <input type="email" class="form-control form-control-email" id="exampleInputEmail"
                                               placeholder="Email">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <div class="pi-input-with-icon">
                                <div class="pi-input-icon"><i class="icon-pencil"></i></div>
                                <textarea class="form-control form-control-comments" id="exampleInputMessage"
                                          placeholder="Message"
                                          rows="3"></textarea>
                            </div>
                        </div> -->
                        <p>
                            <button type="submit" class="btn pi-btn-base pi-btn-no-border">{{Translate::get("Subscribe",$lang)}}</button>
                        </p>
                    </form>
                    <!-- End contact form -->

                </div>

                <!-- End col 4 -->

            </div>
            <br class="clearfix"/>
            <!-- End row -->

        </div>
    </div>
    <!-- End widget area -->

    <!-- Copyright area -->
    <div class="pi-section-w pi-section-header-w pi-section-dark pi-border-top-light pi-border-bottom-strong-base pi-section-header-lg-w">
        <div class="pi-section pi-section-header pi-section-header-lg pi-center-text-2xs pi-clearfix">

            <!-- Social icons -->
            <div class="pi-header-block pi-pull-right pi-hidden-2xs">
                <ul class="pi-social-icons-simple pi-small clearFix">
                    <li><a href="{{url('https://www.facebook.com/asianlancers?ref=hl')}}" class="pi-social-icon-facebook"><i class="icon-facebook"></i></a></li>
                    <li><a href="{{url('https://twitter.com/asianlancers')}}" class="pi-social-icon-twitter"><i class="icon-twitter"></i></a></li>
                   <!--  <li><a href="#" class="pi-social-icon-dribbble"><i class="icon-dribbble"></i></a></li>
                    <li><a href="#" class="pi-social-icon-tumblr"><i class="icon-tumblr"></i></a></li>
                    <li><a href="#" class="pi-social-icon-vimeo"><i class="icon-vimeo"></i></a></li>
                    <li><a href="#" class="pi-social-icon-rss"><i class="icon-rss"></i></a></li> -->
                </ul>
            </div>
            <!-- End social icons -->

            <!-- Footer logo -->
            <div class="pi-header-block pi-header-block-logo pi-header-block-bordered"><a href="#"><img src="{{$theme}}img/logo-opacity-dark.png" alt=""></a></div>
            <!-- End footer logo -->

            <!-- Text -->
		<span class="pi-header-block pi-header-block-txt pi-hidden-xs">&copy; 2014. &laquo;<a href="http://asianlancers.com/" target="_blank" > asianlancers.com </a>&raquo;.
			{{Translate::get("All right reserved",$lang)}}
		</span>
            <!-- End text -->

        </div>
    </div>
    <!-- End copyright area -->
    <!-- End footer -->
    
</div>
<div class="pi-scroll-top-arrow" data-scroll-to="0"></div>



<script src="{{$theme}}scripts/pi.easings.js"></script>
<script src="{{$theme}}scripts/pi.helpers.js"></script>
<script src="{{$theme}}scripts/pi.boundManager.js"></script>
<script src="{{$theme}}3dParty/inview.js"></script>
<script src="{{$theme}}scripts/pi.imagesLoader.js"></script>
<script src="{{$theme}}scripts/pi.accordion.js"></script>
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
<script type="text/javascript" src="{{$theme}}js/custom/common/common.js"></script>
<script src="http://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#Items').selectbox();
        $('.selectbox2').selectbox();
        $(".topStatusMenu").click(function(){
            $(".dropdown-menu").removeClass('display-login-menu');
            $(this).next().toggleClass('display');

        });
        $(".topStatusMenuLogin").click(function(){
            $("ul#nav").removeClass('display');
            $(this).next().toggleClass('display-login-menu');
        });
//        var mySelectionStatus = statusHtmlStorage('mySelection');
//        if(mySelectionStatus){
//            var data = JSON.parse(localStorage.getItem('mySelection'));
//            console.log(data[0]);
//            console.log('#Items_container ul li#Items_input_'+data[0].category_value.id);
//            jQuery("#Items_container ul li").removeClass();
//            jQuery('#Items_container ul li#Items_input_'+data[0].category_value.id).addClass('selceted');
//            jQuery("#Items_input").val(data[0].category_value.title);
//        }

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
</body>
</html>