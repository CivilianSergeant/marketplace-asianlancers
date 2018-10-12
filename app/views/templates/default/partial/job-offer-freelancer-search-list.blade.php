<div class="pi-col-xs-6 pi-no-padding">
    <div class="form-group">
        <label for="exampleInputName-3">Skills:</label>
        <div class="clearfix"></div>
        <select style="width: 100%;" ui-select2 ng-model="form.search.tmp_skill_tags_id" data-placeholder="Pick a skills" multiple>
            <option ng-repeat="skill in skills" value="@{{skill.id}}">@{{skill.category_name}}</option>
        </select>
    </div>
</div>
<div class="pi-col-xs-1 pi-no-padding "></div>
<div class="pi-col-xs-5 pi-no-padding ">
    <div class="form-group">
        <label for="exampleInputName-3">Prices:</label>
        <div class="clearfix"></div>
        <select style="width: 100%;" ui-select2 ng-model="form.search.tmp_freelancer_price" data-placeholder="Pick a Prices" multiple>
            <option ng-repeat="jp in job_prices" value="@{{jp.title}}">@{{jp.title}}</option>
        </select>

    </div>
</div>
<div class="clearfix"></div>
<div class="pull-left">
    <a class="btn pi-btn-blue pi-btn-small" ng-click="searchFreelancers()">Find Again</a>
</div>

<div class="clearfix"></div>
<div ng-if="totalFreelancers>0">
    <div ng-repeat="freelancer in freelancers">
<!--    <div ng-if="showFreelancer(freelancer.code)==1">-->
        <div class="pi-img-w pi-img-round-corners pi-img-left pi-margin-top-5 pi-shadow-effect4" style="width:155px;">
            <!-- <img src="{{$theme}}img_external/team/1 (1).jpg" alt=""/>-->

            <div ng-switch on="freelancer.freelancer_type" >
                <img ng-switch-when="Individual" src="{{CDN}}profile/freelancer/individual/@{{freelancer.photos}}" alt="@{{freelancer.fname}} @{{freelancer.lname}}"/>

                <img ng-switch-when="Agency" src="{{CDN}}profile/freelancer/agency/@{{freelancer.photos}}" alt="@{{freelancer.fname}} @{{freelancer.lname}}"/>

                <img src="{{CDN}}profile/leader-1.png" ng-switch-default alt=""/>
            </div>
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
            <input ng-show="@{{freelancer.available}}" class="pull-right" id="@{{freelancer.code}}" ng-model="form.jobOffer.freelancer_id" type="radio" value="@{{freelancer.code}}" ng-click="freelancerSelection($index)" />

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
            <li><strong>@{{givenTesCount($index)}}</strong> TESTS</li>
            <li><strong>@{{freelancer.portfolio_item}}</strong> PORTFOLIO ITEM</li>
            <li><strong> @{{formatDate(freelancer.last_login) | dateFormat}}</strong> LAST ACTIVE</li>
        </ul>

        <ul class="cat-link clearFix" style="padding-left:0;">
            <li ng-repeat="fs in freelancer.skills"><a class="" href="#">@{{fs.category_name}}</a></li>

        </ul>


        <hr class="pi-divider pi-divider-dashed" style="float: left; width: 100%; clear: both;">
        <div class="clearfix"></div>
<!--    </div>-->
    </div>
</div>
<div class="not-found" ng-if="totalFreelancers==0">
    <h1>No Freelancer found </h1>
</div>