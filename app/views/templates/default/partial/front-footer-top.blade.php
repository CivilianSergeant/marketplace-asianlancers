
<!-- - - - - - - - - - SECTION - - - - - - - - - -->


<div class="pi-section-w pi-section-parallax" style="background-image: url({{$theme}}img_external/gallery/new-york.jpg);">
    <div class="pi-texture pi-section-overlay-base"></div>
    <div class="pi-section pi-padding-bottom-30">

        <!-- Row -->
        <div class="pi-row pi-grid-small-margins pi-text-center">

            <!-- Col 3 -->
            <div class="pi-col-sm-3 pi-col-2xs-6 pi-padding-bottom-20">
                <div class="pi-counter pi-counter-simple" data-count-from="0" data-count-to="{{$total_jobs}}" data-easing="easeInCirc" data-duration="1000" data-frames-per-second="0">
                    <div class="pi-counter-count pi-counter-count-big pi-text-white pi-weight-300">

                        <p>
                            <i class="icon-briefcase pi-icon pi-icon-big pi-text-white"></i>
                        </p>

                        <div class="pi-counter-number">{{$total_jobs}}</div>

                    </div>
                    <p style="color:#000;">{{Translate::get('Total Jobs',$lang)}}</p>
                </div>
            </div>
            <!-- End col 3 -->

            <!-- Col 3 -->
            <div class="pi-col-sm-3 pi-col-2xs-6 pi-padding-bottom-20">
                <div class="pi-counter pi-counter-simple" data-count-from="0" data-count-to="{{$total_paid}}" data-easing="easeInCirc" data-duration="2000" data-frames-per-second="10">
                    <div class="pi-counter-count pi-counter-count-big pi-text-white pi-weight-300">

                        <p>
                            <i class="icon-globe pi-icon pi-icon-big pi-text-white"></i>
                        </p>

                        $<span class="pi-counter-number">{{$total_paid}}</span>

                    </div>
                    <p style="color:#000;">{{Translate::get('Total Paid',$lang)}}</p>
                </div>
            </div>
            <!-- End col 3 -->

            <!-- Col 3 -->
            <div class="pi-col-sm-3 pi-col-2xs-6 pi-padding-bottom-20">
                <div class="pi-counter pi-counter-simple" data-count-from="0" data-count-to="{{$total_freelancers}}" data-easing="easeInCirc" data-duration="3000" data-frames-per-second="10">
                    <div class="pi-counter-count pi-counter-count-big pi-text-white pi-weight-300">

                        <p>
                            <i class="icon-users pi-icon pi-icon-big pi-text-white"></i>
                        </p>

                        <span class="pi-counter-number">{{$total_freelancers}}</span>

                    </div>
                    <p style="color:#000;">{{Translate::get('Total Freelancers',$lang)}}</p>
                </div>
            </div>
            <!-- End col 3 -->

            <!-- Col 3 -->
            <div class="pi-col-sm-3 pi-col-2xs-6 pi-padding-bottom-20">
                <div class="pi-counter pi-counter-simple" data-count-from="0" data-count-to="{{$total_clients}}" data-easing="easeInCirc" data-duration="4000" data-frames-per-second="10">
                    <div class="pi-counter-count pi-counter-count-big pi-text-white pi-weight-300">

                        <p>
                            <i class="icon-user pi-icon pi-icon-big pi-text-white"></i>
                        </p>

                        <span class="pi-counter-number">{{$total_clients}}</span>

                    </div>
                    <p style="color:#000;">{{Translate::get('Total Clients',$lang)}}</p>
                </div>
            </div>
            <!-- End col 3 -->

        </div>
        <!-- End row -->

    </div>
</div>

<!-- - - - - - - - - - END SECTION - - - - - - - - - -->

