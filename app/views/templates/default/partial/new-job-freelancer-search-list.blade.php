
    <div class="clearfix"></div>

@{{$authenticateUserInfo}}

<div class="clearfix"></div>
<!-- Tab content -->
<div ng-if="total_freelancer>0">
    <div class="clearfix"></div>
    <pagination
        total-items="bigTotalItems"
        ng-model="bigCurrentPage"
        max-size="maxSize"
        boundary-links="true"
        rotate="false"
        num-pages="numPages"
        ng-change="pageChanged()">
    </pagination>
    <div class="clearfix"></div>
    <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25 pi-has-bg pi-margin-top-15" >@{{job_category.title}}</h3>
    <div ng-repeat="freelancer in freelancers">
        @if($page=='create-job')
        <div ng-if="showFreelancer(freelancer.code)==1">
        @endif
            <div ng-if="freelancer.photos" class="pi-img-w pi-img-round-corners pi-img-left pi-margin-top-5 pi-shadow-effect4" style="width:155px;">
               <!-- <img src="{{$theme}}img_external/team/1 (1).jpg" alt=""/>-->
				
					<div ng-switch on="freelancer.freelancer_type" >
                        <img ng-switch-when="Individual" src="{{CDN}}profile/freelancer/individual/@{{freelancer.photos}}" alt="@{{freelancer.fname}} @{{freelancer.lname}}"/>
                      
                        <img ng-switch-when="Agency" src="{{CDN}}profile/freelancer/agency/@{{freelancer.photos}}" alt="@{{freelancer.fname}} @{{freelancer.lname}}"/>
                       
                        <img src="{{CDN}}profile/leader-1.png" ng-switch-default alt=""/>
                    </div>
            </div>
            <div ng-if="checkPhotos($index)" class="pi-img-w pi-img-round-corners pi-img-left pi-margin-top-5 pi-shadow-effect4" style="width:155px;">
                <img src="{{CDN}}profile/male-female.jpg" alt="@{{freelancer.fname}} @{{freelancer.lname}}"/>
            </div>
            <h3 class="h4 pi-margin-bottom-5">
                <a target="_blank" href="{{url('view/freelancer')}}/@{{freelancer.code}}" class="pi-link-no-style" style="float: left;">
                    @{{freelancer.fname}} @{{freelancer.lname}} |
                </a>
                <i ng-show="@{{freelancer.available}}" class="avai" style="float: left;">
                    <img width="15" height="15" alt="available" src="{{$theme}}img/available.png">
                    Available |
                </i>
                <i ng-show="@{{freelancer.available}}==0" class="avai" style="float: left;">
                    <img width="15" height="15" alt="available" src="{{$theme}}img/no-available.png"> No Available |
                </i>
                <i class="rank-icon" style="float: left;">0</i>

                <span class="select-box">
                    Select&nbsp;
                    <input ng-show="@{{freelancer.available}}" class="pull-right" id="@{{freelancer.code}}" type="checkbox" value="@{{freelancer.code}}" ng-checked="form.selectFl.indexOf(freelancer.code) > -1" ng-click="toggleSelection(freelancer.code,$index)" />
                </span>
                <!--<input checkbox-group class="pull-right" type="checkbox" />-->
            </h3>
            <br/><br/>
            <p class="pi-italic pi-text-base pi-margin-bottom-10">
                <img ng-show="@{{freelancer.verified}}" width="16" height="20" alt="0" src="{{$theme}}img/DJITVerified.png">
                @{{freelancer.profile_title}}
            </p>

            <p>@{{freelancer.overview}}</p>

            <ul class="oInlineListExt">
                <li ng-show="@{{freelancer.freelancer_price}}"><strong>$@{{freelancer.freelancer_price}}</strong> HOURLY RATE</li>
                <li ng-bind-html="feedBackPrint(myHTML,$index)"></li>
                <li><strong>0</strong> HOURS</li>
                <li><i class="icon-home"></i><strong> @{{freelancer.address_country}}</strong></li>
<!--                <li><strong>@{{givenTesCount($index)}}</strong> TESTS</li>-->
                <li><strong>@{{freelancer.portfolio_item}}</strong> PORTFOLIO ITEM</li>
<!--				<li><strong>@{{formatDate($index) | dateFormat}}</strong> LAST ACTIVE</li>-->
            </ul>

<!--            <ul class="cat-link clearFix" style="padding-left:0;">-->
<!--                <li ng-repeat="fs in freelancer.skills"><a class="" href="#">@{{fs.category_name}}</a></li>-->

<!--            </ul>-->


            <hr class="pi-divider pi-divider-dashed" style="float: left; width: 100%; clear: both;">
            <div class="clearfix"></div>
        @if($page=='create-job')
        </div>
        @endif
    </div>
</div>

    <div class="not-found" ng-if="total_freelancer==0">
        <h1>No Freelancer found </h1>
    </div>
<!-- End tab content -->


