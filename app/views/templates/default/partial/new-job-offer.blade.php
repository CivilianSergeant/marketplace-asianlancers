
<div>
    <div class="clearfix"></div>
    <h3>{{Translate::get("New Job Offer",$lang)}}</h3>
    <div ng-model="errorMsg" ng-if="errorMsg" class="pi-alert-danger">
        <button data-dismiss="alert" class="pi-close" type="button">
            <i class="icon-cancel"></i>
        </button>
        <p>
            <strong><a id="top">Warning!</a></strong> <ul><li ng-repeat="em in errorMsg">@{{em[0]}}</li></ul>
        </p>
    </div>
    <div class="clearfix"></div>
    <form id="jobOfferFrm" ng-submit="addJobOffer()" name="jobOfferFrm" method="post" >
        <div class="form-group">
            <label for="title" class="col-lg-2 pi-no-padding-left">{{Translate::get("Title",$lang)}}: * </label>
            <div class="col-lg-10 pi-no-padding-right">
                <div class="pi-input-with-icon">
                    <div class="pi-input-icon">
                        <i class="icon-pencil"></i>
                    </div>
                    <input type="text" name="title" class="form-control" ng-model="form.jobOffer.title" placeholder="{{Translate::get('Job Title',$lang)}}">
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <hr class="pi-divider-gap-10">
        <div class="form-group">
            <label for="title" class="col-lg-2 pi-no-padding-left">{{Translate::get("Description",$lang)}}: * </label>
            <div class="col-lg-10 pi-no-padding-right">
                <div class="pi-input-with-icon">
                    
                    <textarea rows="8" placeholder="{{Translate::get('Description',$lang)}}" id="jo_description" name="description" ng-model="form.jobOffer.description" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <hr class="pi-divider-gap-10">
        <div class="form-group">
            <label for="freelancers" class="col-lg-2 pi-no-padding-left">{{Translate::get("Freelancer",$lang)}}: </label>
            <div class="col-lg-10 pi-no-padding-right">
                <ul class="oInlineListExtNew col-lg-7">
                    <li ng-repeat="sf_lancer in selectFreelancer">
                        @{{sf_lancer.fname}}&nbsp;@{{sf_lancer.lname}}&nbsp;($@{{sf_lancer.freelancer_price}})
                        <a href="#" ng-click="removeFreelancer($index)" class="glyphicon glyphicon-remove-circle" ></a>
                    </li>
                </ul>

                <a ng-show="searchJOCButtonFlag" class="btn pi-btn-red pi-btn-small pull-right pi-margin-left-10" ng-click="resetFreelancerList()" style="float:right; z-index:8; position:relative;margin-left: 5px;" href="#">Cancel</a>
                <a id="find_again" ng-show="searchJOSButtonFlag" class="btn pi-btn-blue pi-btn-small" ng-click="showFreelancerList()" style="float:right; z-index:8; position:relative;" href="#">{{Translate::get("Search Freelancer",$lang)}}</a>

            </div>
            <?php /*<div ng-show="addFreelancerFlag">
                {{Theme::make('partial.job-offer-freelancer-search-list')}}
            </div> */ ?>

            <div id="ajaxContent"></div>


<!--            <div ng-show="searchJOLFlag" class="img-responsive" style="margin: 0 auto; text-align: center;">-->
            <div id="searchJOLFlag" class="img-responsive" style="display:none;margin: 0 auto; text-align: center;">
                <img src="{{$theme}}/img/45.gif" />
            </div>
        </div>
        <div class="clearfix"></div>
        <hr class="pi-divider-gap-10">
        <div class="form-group">
            <label for="title" class="col-lg-2 pi-no-padding-left">{{Translate::get("Total Hour",$lang)}}: *</label>
            <div class="col-lg-3">
                <div class="pi-input-with-icon">
                    <div class="pi-input-icon">
                        <i class="icon-pencil"></i>
                    </div>
                    <input type="text" name="title" class="form-control" ng-model="form.jobOffer.job_offer_hour" ng-change="newOfferPriceCalculate()" placeholder="{{Translate::get('Total Hour',$lang)}}">
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <hr class="pi-divider-gap-10">
        <div class="form-group">
            <label for="title" class="col-lg-2 pi-no-padding-left">{{Translate::get("Total Cost",$lang)}}: *</label>
            <div class="col-lg-3">
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input type="text" class="form-control" disabled ng-model="form.jobOffer.job_offer_price">
<!--                    <span class="input-group-addon">.00</span>-->
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <hr class="pi-divider-gap-10">
        <!-- Submit button -->
        <p>
            <img ng-show="jobOfferLoadingFlag" src="{{$theme}}/img/49.gif" />
            <button ng-show="jobOfferSaveButtonFlag" type="submit"
                    class="btn pi-btn-green pi-btn-small pi-uppercase pi-weight-700 pi-letter-spacing">
                <i class="icon-check pi-icon-left"></i>{{Translate::get("Save",$lang)}}
            </button>
            <span class="btn pi-btn-red pi-btn-small" ng-click="newJobOffer=0;jobOfferListFlag=1;" style="cursor:pointer;">{{Translate::get("Cancel",$lang)}}</span>
        </p>
    </form>
</div>

