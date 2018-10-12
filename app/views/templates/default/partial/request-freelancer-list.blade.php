
<div>
    <div class="clearfix"></div>
    <div ng-repeat="jrFreelancer in jobRequestFreelancer">

            <div class="pi-img-w pi-img-round-corners pi-img-left pi-margin-top-5 pi-shadow-effect4" style="width:155px;">
               <!-- <img src="{{$theme}}img_external/team/1 (1).jpg" alt=""/>-->
				
					<div ng-switch on="jrFreelancer.freelancer.freelancer_type" >
                        <img ng-switch-when="Individual" src="{{CDN}}profile/freelancer/individual/@{{jrFreelancer.freelancer.photos}}" alt="@{{jrFreelancer.freelancer.fname}} @{{jrFreelancer.freelancer.lname}}"/>
                      
                        <img ng-switch-when="Agency" src="{{CDN}}profile/freelancer/agency/@{{jrFreelancer.freelancer.photos}}" alt="@{{jrFreelancer.freelancer.fname}} @{{jrFreelancer.freelancer.lname}}"/>
                       
                        <img src="{{CDN}}profile/leader-1.png" ng-switch-default alt=""/>
                    </div>
            </div>
            <h3 class="h4 pi-margin-bottom-5">
                <a target="_blank" href="{{url('view/freelancer')}}/@{{jrFreelancer.freelancer.code}}" class="pi-link-no-style">
                    @{{jrFreelancer.freelancer.first_name}} @{{jrFreelancer.freelancer.last_name}}
                </a>
                |
                <i ng-show="@{{jrFreelancer.freelancer.available}}" class="avai">
                    <img width="15" height="15" alt="available" src="{{$theme}}img/available.png">
                    Available
                </i>
                <i ng-show="@{{jrFreelancer.freelancer.available}}==0" class="avai">
                    <img width="15" height="15" alt="available" src="{{$theme}}img/no-available.png"> No Available
                </i>
                |
                <i class="avai">
                    @{{jrFreelancer.request_status}}
                </i>
                <i class="rank-icon">0</i>
                <!--<input checkbox-group class="pull-right" type="checkbox" />-->
            </h3>

            <p class="pi-italic pi-text-base pi-margin-bottom-10">
                <img ng-show="@{{jrFreelancer.freelancer.verified}}" width="16" height="20" alt="0" src="{{$theme}}img/DJITVerified.png">
                @{{jrFreelancer.freelancer.profile_title}}
            </p>

            <p>@{{jrFreelancer.freelancer.overview}}</p>

            <ul class="oInlineListExt">
                <li ng-show="@{{jrFreelancer.freelancer.freelancer_price}}"><strong>$@{{jrFreelancer.freelancer.freelancer_price}}</strong> HOURLY RATE</li>
                <li><span class="star"></span>
                    <span class="star"></span>
                    <span class="star"></span>
                    <span class="star"></span>
                    <span class="star"></span>
                    <b>5.0</b>
                </li>
                <li><strong>0</strong> HOURS</li>
                <li><i class="icon-home"></i><strong> @{{jrFreelancer.freelancer.address_country}}</strong></li>
                <li><strong>@{{givenTesCount($index)}}</strong> TESTS</li>
                <li><strong>@{{jrFreelancer.freelancer.portfolio_item}}</strong> PORTFOLIO ITEM</li>
				<li><strong>@{{formatDate(jrFreelancer.freelancer.created_at) | dateFormat}}</strong> LAST ACTIVE</li>
            </ul>

            <ul class="cat-link clearFix" style="padding-left:0;">
              <li ng-repeat="fs in jrFreelancer.freelancer.skills"><a class="" href="#">@{{fs.get_tag.category_name}}</a></li>

           </ul>


            <hr class="pi-divider pi-divider-dashed">
            <div class="clearfix"></div>

    </div>
</div>

