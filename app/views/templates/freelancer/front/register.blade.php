@extends('templates.freelancer.freelancer')

@section('content')


<!-- Breadcrumbs -->
<div class="pi-section-w pi-border-bottom pi-section-grey">
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb pi-center-text-xs">
            <ul><li>User Type</li></ul>
        </div>
    </div>
</div>
<!-- End breadcrumbs -->

<!-- - - - - - - - - - END SECTION - - - - - - - - - -->

<!-- - - - - - - - - - SECTION - - - - - - - - - -->

<div class="pi-section-w pi-section-white">
    <div class="pi-section pi-padding-bottom-10">

        <!-- Row -->
        <div class="pi-row">

            <!-- Col 10 -->
            <div class="pi-col-sm-10 pi-col-sm-offset-1 pi-padding-bottom-60">
                <p class="lead-30 pi-text-dark pi-text-center">
                    <span class="pi-text-bg-base">Let's get started!</span> First, tell us what you're looking for.
                </p>
            </div>
            <!-- End col 10 -->

        </div>
        <!-- End row -->

        <!-- Row -->
        <div class="pi-row pi-grid-big-margins">

            <!-- Col 3 -->
            <div class="pi-col-sm-6 pi-col-xs-6 pi-padding-bottom-50">

                <div class="pi-icon-box-vertical pi-icon-box-vertical-icon-bigger pi-text-center">

                    <div style="background: #e14d39;" class="pi-icon-box-icon pi-icon-box-icon-circle pi-icon-box-icon-base">
                        <img alt="" src="{{$theme}}img/user.png">
                    </div>

                    <h4><a class="pi-link-dark" href="#">I need a freelancer</a></h4>

                    <p>Find, hire, manage, and pay for help, on demand.</p>
                    <p>
                        <a href="{{url('home/sign-up-client')}}" class="btn pi-btn-red">{{Translate::get("Sign Up",$lang)}}</a>
                    </p>

                </div>

            </div>
            <!-- End col 3 -->

            <!-- Col 3 -->
            <div class="pi-col-sm-6 pi-col-xs-6 pi-padding-bottom-50">

                <div class="pi-icon-box-vertical pi-icon-box-vertical-icon-bigger pi-text-center">

                    <div style="background: #4c92da;" class="pi-icon-box-icon pi-icon-box-icon-circle pi-icon-box-icon-base">
                        <img alt="" src="{{$theme}}img/user.png">
                    </div>

                    <h4><a class="pi-link-dark" href="#">I need a job</a></h4>

                    <p>Find work, earn money, and grow your career.	</p>

                    <p>
                        <a class="btn pi-btn-blue" href="{{url('home/sign-up-freelancer')}}">{{Translate::get("Sign Up",$lang)}}</a>
                    </p>

                </div>

            </div>
            <!-- End col 3 -->

            <div class="pi-clearfix pi-visible-xs"></div>

        </div>
        <!-- End row -->

    </div>
</div>
<!-- End promo -->

<!-- - - - - - - - - - END SECTION - - - - - - - - - -->

<!-- - - - - - - - - - SECTION - - - - - - - - - -->
<div style="background-image: url({{$theme}}img_external/gallery/consulting.jpg);" class="pi-section-w pi-shadow-inside-top pi-section-parallax">
    <div style="background: rgba(31, 37, 44, 0.85);" class="pi-texture"></div>
    <div class="pi-section pi-padding-top-110 pi-padding-bottom-100 pi-text-center">

        <h3 class="pi-uppercase pi-weight-700 pi-letter-spacing pi-margin-bottom-20">
            Want to work with us?
        </h3>

        <p class="lead-16 pi-margin-bottom-30">
            Sed ut perspiciatis unde omnis iste natus error sit voluptatem <br>accusantium doloremque laudantium
        </p>

        <p>
            <a class="btn pi-btn-contur-3 pi-btn-big" href="#">
                Get in Touch
            </a>

            <span class="pi-or">or</span>

            <a class="btn pi-btn-base pi-btn-no-border pi-shadow pi-btn-big" href="#">
                Get a Free Quote
            </a>
        </p>

    </div>
</div>
@stop