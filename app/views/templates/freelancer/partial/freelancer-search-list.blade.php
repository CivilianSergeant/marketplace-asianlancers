
<?php /*<form id="serachFreelancerFrm" ng-submit="searchFreelancers()" name="serachFreelancerFrm" method="post">
    <div class="pi-col-xs-6">
        <div class="form-group">
            <label for="exampleInputName-3">Skills:</label>
            <!--<select style="width:300px" ui-select2 ng-model="form.skill_tags" name="skill_tag[]" data-placeholder="Pick a skills" multiple>
                <option ng-repeat="skill in skills" value="@{{skill.id}}">@{{skill.category_name}}</option>
            </select>-->
            <input type="hidden" style="width:300px" ui-select2="multiSkillSelection" ng-model="tmp_skill_tag"/>
        </div>
    </div>
    <div class="pi-col-xs-6">
        <div class="form-group">
            <label for="exampleInputName-3">Prices:</label>
            <!--<select style="width:300px" ui-select2 ng-model="form.job_price" data-placeholder="Pick a Prices" multiple>
                <option ng-repeat="jp in job_prices" value="@{{jp.id}}">@{{jp.title}}</option>
            </select>-->
            <input type="hidden" style="width:300px" ui-select2="multiPriceSelection" ng-model="tmp_freelancer_price"/>
        </div>
    </div>
    <div class="pull-left">
        <!-- Submit button -->
        <button type="submit" class="btn pi-btn-blue pi-btn-small">Find Again</button>

        @if(!empty($authenticateUserInfo) && $authenticateUserInfo->user_type == 'Client')
        <input type="button" class="btn pi-btn-red pi-btn-small" ng-click="addFreelancerFlag=0" value="Cancel"/>
        @endif
        <!-- End submit button -->
    </div>
</form> */ ?>


    <div class="pi-col-xs-6">
        <div class="form-group">
            <label for="exampleInputName-3">Skills:</label>
            <!--<select style="width:300px" ui-select2 ng-model="form.skill_tags" name="skill_tag[]" data-placeholder="Pick a skills" multiple>
                <option ng-repeat="skill in skills" value="@{{skill.id}}">@{{skill.category_name}}</option>
            </select>-->
            <input type="hidden" style="width:300px" ui-select2="multiSkillSelection" ng-model="tmp_skill_tag"/>
        </div>
    </div>
    <div class="pi-col-xs-6">
        <div class="form-group">
            <label for="exampleInputName-3">Prices:</label>
            <!--<select style="width:300px" ui-select2 ng-model="form.job_price" data-placeholder="Pick a Prices" multiple>
                <option ng-repeat="jp in job_prices" value="@{{jp.id}}">@{{jp.title}}</option>
            </select>-->
            <input type="hidden" style="width:300px" ui-select2="multiPriceSelection" ng-model="tmp_freelancer_price"/>
        </div>
    </div>
    <div class="pull-left">
        <!-- Submit button -->
        <a class="btn pi-btn-blue pi-btn-small" ng-click="searchFreelancers()">Find Again</a>

        @if(!empty($authenticateUserInfo) && $authenticateUserInfo->user_type == 'Client' && $page== 'create-job')
        <a class="btn pi-btn-red pi-btn-small" ng-click="addFreelancerFlag=0" >Cancel</a>
        @endif
        <!-- End submit button -->
        @if($page== 'search')
        <a ng-click="goToJobPost()" class="btn pi-btn-blue pi-btn-small" >Next</a>
        @endif
    </div>


<div class="clearfix"></div>
<!-- Tab content -->
<div ng-if="total_freelancer>0">
    <div class="clearfix"></div>
    <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25 pi-has-bg" >@{{job_category.title}}</h3>
    <div ng-repeat="freelancer in freelancers">
        @if($page=='create-job')
        <div ng-if="showFreelancer(freelancer.code)==1">
        @endif
            <div class="pi-img-w pi-img-round-corners pi-img-left pi-margin-top-5 pi-shadow-effect4" style="width:155px;">
                <img src="{{$theme}}img_external/team/1 (1).jpg" alt=""/>
            </div>
            <h3 class="h4 pi-margin-bottom-5">
                <a href="#" class="pi-link-no-style">
                    @{{freelancer.first_name}} @{{freelancer.last_name}}
                </a>
                <input class="pull-right" id="@{{freelancer.code}}" type="checkbox" value="@{{freelancer.code}}" ng-checked="form.selectFl.indexOf(freelancer.code) > -1" ng-click="toggleSelection(freelancer.code,$index)" />
                <!--<input checkbox-group class="pull-right" type="checkbox" />-->
            </h3>

            <p class="pi-italic pi-text-base pi-margin-bottom-10">Different Thinks But Better</p>

            <p>@{{freelancer.overview}}</p>

            <ul class="oInlineListExt">
                <li ng-show="@{{freelancer.freelancer_price}}"><strong>$@{{freelancer.freelancer_price}}</strong> HOURLY RATE</li>
                <li ng-bind-html="feedBackPrint(myHTML,$index)"></li>
                <li><strong>1204</strong> HOURS</li>
                <li><i class="icon-home"></i><strong> @{{freelancer.address_country}}</strong></li>
                <li><strong>4</strong> TESTS</li>
                <li><strong>1</strong> PORTFOLIO ITEM</li>
                <li><strong>Aug 19, 2014</strong> LAST ACTIVE</li>
            </ul>

            <ul class="cat-link clearFix" style="padding-left:0;">
                <!--<li><a href="#" class="">Web Design</a></li>
                <li><a href="#" class="">CSS3</a></li>
                <li><a href="#" class="">HTML5</a></li>
                <li><a href="#" class="">Web Design</a></li>
                <li><a href="#" class="">HTML5</a></li>
                <li><a href="#" class="">CSS3</a></li>
                <li><a href="#" class="">Web Design</a></li>
                <li><a href="#" class="">HTML5</a></li>
                <li><a href="#" class="">CSS3</a></li>
                <li><a href="#" class="">Web Design</a></li>
                <li><a href="#" class="">HTML5</a></li>
                <li><a href="#" class="">CSS3</a></li>-->
                <li ng-repeat="fs in freelancer.skills"><a class="" href="#">@{{fs.category_name}}</a></li>

            </ul>


            <hr class="pi-divider pi-divider-dashed">
        @if($page=='create-job')
        </div>
        @endif
    </div>
</div>

<div ng-if="total_freelancer==0">
    <h1>No Freelancer found </h1>
</div>
<!-- End tab content -->


