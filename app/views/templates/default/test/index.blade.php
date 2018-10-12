@extends('templates.default.default')


@section('content')
<!-- Breadcrumbs -->

<div class="pi-section-w pi-border-bottom pi-section-grey">
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Categories</a></li>
                <li>Web Design</li>
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
            <ul class="pi-tabs-navigation pi-tabs-navigation-transparent" id="myTabs">
                {{Theme::make('partial.menu',array())}}
            </ul>
            <div class="pi-tabs-content pi-tabs-content-transparent">

                <!-- Tab content -->
                <div>
                    <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25 pi-has-bg">Web Design Freelancers</h3>
                    <div class="pi-img-w pi-img-round-corners pi-img-left pi-margin-top-5 pi-shadow-effect4" style="width:155px;">
                        <img src="{{CDN}}profile/leader-1.png" alt=""/>
                    </div>
                    <h3 class="h4 pi-margin-bottom-5">
                        <a href="#" class="pi-link-no-style">Michael Collins</a>
                    </h3>
                    <p class="pi-italic pi-text-base pi-margin-bottom-10">Different Thinks But Better</p>
                    <p>Neque porro quisquam est, qui dolorem ipsum llam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur quia dolor sit amet, consectetur,adipisci</p>
                    <ul class="cat-link clearFix">
                        <li><a href="#" class="">Web Design</a></li>
                        <li><a href="#" class="">HTML5</a></li>
                        <li><a href="#" class="">CSS3</a></li>
                        <li><a href="#" class="">Web Design</a></li>
                        <li><a href="#" class="">HTML5</a></li>
                        <li><a href="#" class="">CSS3</a></li>
                        <li><a href="#" class="">Web Design</a></li>
                        <li><a href="#" class="">HTML5</a></li>
                        <li><a href="#" class="">CSS3</a></li>
                        <li><a href="#" class="">Web Design</a></li>
                        <li><a href="#" class="">HTML5</a></li>
                        <li><a href="#" class="">CSS3</a></li>
                    </ul>

                    <hr class="pi-divider pi-divider-dashed">

                    <div class="pi-img-w pi-img-round-corners pi-img-left pi-margin-top-5 pi-shadow-effect4" style="width: 155px;">
                        <img src="{{CDN}}profile/leader-2.png" alt=""/>
                    </div>
                    <h3 class="h4 pi-margin-bottom-5">
                        <a href="#" class="pi-link-no-style">Jim Torres</a>
                    </h3>
                    <p class="pi-italic pi-text-base pi-margin-bottom-10">BCC Web Development Certified</p>
                    <p>Neque porro quisquam est, qui dolorem ipsum llam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur quia dolor sit amet, consectetur, adipisci
                    </p>
                    <ul class="pi-social-icons pi-jump pi-colored-bg pi-small pi-round pi-no-margin-bottom clearFix">
                        <li><a href="#" class="pi-social-icon-facebook"><i class="icon-facebook"></i></a></li>
                        <li><a href="#" class="pi-social-icon-twitter"><i class="icon-twitter"></i></a></li>
                        <li><a href="#" class="pi-social-icon-dribbble"><i class="icon-dribbble"></i></a></li>
                    </ul>

                    <hr class="pi-divider pi-divider-dashed">

                    <div class="pi-img-w pi-img-round-corners pi-img-left pi-margin-top-5 pi-shadow-effect4" style="width: 155px;">
                        <img src="{{CDN}}profile/leader-3.png" alt=""/>
                    </div>
                    <h3 class="h4 pi-margin-bottom-5">
                        <a href="#" class="pi-link-no-style">Helen Butler</a>
                    </h3>
                    <p class="pi-italic pi-text-base pi-margin-bottom-10">Wordpress Expert |Magento,Volusion,Shopify Listing | Etsy | Data Entry</p>
                    <p>
                        Neque porro quisquam est, qui dolorem ipsum llam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur quia dolor sit amet, consectetur, adipisci
                    </p>
                    <ul class="pi-social-icons pi-jump pi-colored-bg pi-small pi-round pi-no-margin-bottom clearFix">
                        <li><a href="#" class="pi-social-icon-facebook"><i class="icon-facebook"></i></a></li>
                        <li><a href="#" class="pi-social-icon-twitter"><i class="icon-twitter"></i></a></li>
                        <li><a href="#" class="pi-social-icon-dribbble"><i class="icon-dribbble"></i></a></li>
                    </ul>

                    <hr class="pi-divider pi-divider-dashed">

                    <div class="pi-img-w pi-img-round-corners pi-img-left pi-margin-top-5 pi-shadow-effect4" style="width: 155px;">
                        <img src="{{CDN}}profile/leader-4.png" alt=""/>
                    </div>
                    <h3 class="h4 pi-margin-bottom-5">
                        <a href="#" class="pi-link-no-style">Janet Harris</a>
                    </h3>
                    <p class="pi-italic pi-text-base pi-margin-bottom-10">WebDeveloper|Wordpress|ExpertVA|Ecommerce Product Entry|Researcher|SEO</p>
                    <p>
                        Neque porro quisquam est, qui dolorem ipsum llam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur quia dolor sit amet, consectetur, adipisci
                    </p>
                    <ul class="pi-social-icons pi-jump pi-colored-bg pi-small pi-round pi-no-margin-bottom clearFix">
                        <li><a href="#" class="pi-social-icon-facebook"><i class="icon-facebook"></i></a></li>
                        <li><a href="#" class="pi-social-icon-twitter"><i class="icon-twitter"></i></a></li>
                        <li><a href="#" class="pi-social-icon-dribbble"><i class="icon-dribbble"></i></a></li>
                    </ul>

                    <hr class="pi-divider pi-divider-dashed">

                    <div class="pi-img-w pi-img-round-corners pi-img-left pi-margin-top-5 pi-shadow-effect4" style="width: 155px;">
                        <img src="{{CDN}}profile/leader-5.png" alt=""/>
                    </div>
                    <h3 class="h4 pi-margin-bottom-5">
                        <a href="#" class="pi-link-no-style">Jim Torres</a>
                    </h3>
                    <p class="pi-italic pi-text-base pi-margin-bottom-10">PHP/Codeigniter/CSS/Jquery/HTML5/Bootstrap 3</p>
                    <p>
                        Neque porro quisquam est, qui dolorem ipsum llam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur quia dolor sit amet, consectetur, adipisci
                    </p>
                    <ul class="pi-social-icons pi-jump pi-colored-bg pi-small pi-round pi-no-margin-bottom clearFix">
                        <li><a href="#" class="pi-social-icon-facebook"><i class="icon-facebook"></i></a></li>
                        <li><a href="#" class="pi-social-icon-twitter"><i class="icon-twitter"></i></a></li>
                        <li><a href="#" class="pi-social-icon-dribbble"><i class="icon-dribbble"></i></a></li>
                    </ul>

                    <hr class="pi-divider pi-divider-dashed">

                    <div class="pi-img-w pi-img-round-corners pi-img-left pi-margin-top-5 pi-shadow-effect4" style="width: 155px;">
                        <img src="{{CDN}}profile/leader-6.png" alt=""/>
                    </div>
                    <h3 class="h4 pi-margin-bottom-5">
                        <a href="#" class="pi-link-no-style">Helen Butler</a>
                    </h3>
                    <p class="pi-italic pi-text-base pi-margin-bottom-10">Data entry and web research executive</p>
                    <p>
                        Neque porro quisquam est, qui dolorem ipsum llam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur quia dolor sit amet, consectetur, adipisci
                    </p>
                    <ul class="pi-social-icons pi-jump pi-colored-bg pi-small pi-round pi-no-margin-bottom clearFix">
                        <li><a href="#" class="pi-social-icon-facebook"><i class="icon-facebook"></i></a></li>
                        <li><a href="#" class="pi-social-icon-twitter"><i class="icon-twitter"></i></a></li>
                        <li><a href="#" class="pi-social-icon-dribbble"><i class="icon-dribbble"></i></a></li>
                    </ul>

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
    <div class="pi-texture" style="background: url(img/hexagon.png) repeat;"></div>
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