<div><!--    <p>-->
    <!--        <a type="submit" class="btn pi-btn-base pi-btn-small pi-uppercase pi-weight-700 pi-letter-spacing" ng-click="jobOfferFormFlag=1;">-->
    <!--            <i class="icon-check pi-icon-left"></i>Add Job Offer--><!--        </a>--><!--    </p>-->
    <div class="clearfix"></div>
    <div id="status_form" ng-show="statusFormFlag">
        <div ng-model="errorMsgStatus" ng-if="errorMsgStatus" class="pi-alert-danger">
            <button data-dismiss="alert" class="pi-close" type="button"><i class="icon-cancel"></i></button>
            <p><strong><a id="top">Warning!</a></strong>
            <ul>
                <li ng-repeat="ems in errorMsgStatus">@{{ems[0]}}</li>
            </ul>
            </p>        </div>
        <div class="clearfix"></div>
        <form id="jobOfferStatusFrm" ng-submit="updateJobOfferStatus()" name="jobOfferStatusFrm" method="post">
            <div class="form-group"><label for="title" class="col-lg-3">{{Translate::get("Status",$lang)}}: * </label>

                <div class="col-lg-9">
                    <div class="pi-input-with-icon">
                        <div class="pi-input-icon"><i class="icon-pencil"></i>
                        </div>                        <?php if (!empty($authenticateUserInfo) && $authenticateUserInfo->user_type == 'Admin'): ?>
                            <select ng-model="form.jobOfferStatus.job_offer_status" ng-required="true"
                                    class="form-control">
                                <option value="" selected="selected">---Select Status---</option>
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Canceled">Cancel</option>
                            </select>                        <?php endif; ?>                        <?php if (!empty($authenticateUserInfo) && $authenticateUserInfo->user_type == 'Client'): ?>
                            <select ng-model="form.jobOfferStatus.job_offer_status" ng-required="true"
                                    class="form-control">
                                <option value="" selected="selected">---Select Status---</option>
                                <!--                                <option value="Accepted">Accepted</option>-->
                                <option value="Completed">Completed</option>
                                <!--                                <option value="Paused">Paused</option>-->
                                <!--                                <option value="Declined">Decline</option>-->
                            </select>                        <?php endif; ?>                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <hr class="pi-divider-gap-10">
            <div class="form-group"><label for="title" class="col-lg-3">{{Translate::get("Reason",$lang)}}: * </label>

                <div class="col-lg-9">
                    <div class="pi-input-with-icon">
                        <div class="pi-input-icon"><i class="icon-pencil"></i></div>
                        <textarea rows="8" placeholder="Reason" id="reason" name="reason"
                                  ng-model="form.jobOfferStatus.job_offer_status_reason" ng-required="true"
                                  class="form-control"></textarea></div>
                </div>
            </div>
            <div class="clearfix"></div>
            <hr class="pi-divider-gap-10">
            <!-- Submit button -->
            <p>
                <button type="submit"
                        class="btn pi-btn-green pi-btn-small pi-uppercase pi-weight-700 pi-letter-spacing"><i
                        class="icon-check pi-icon-left"></i>{{Translate::get("Save",$lang)}}
                </button>
                <span class="btn pi-btn-red pi-btn-small" ng-click="statusFormFlag=0" style="cursor:pointer;">{{Translate::get("Cancel",$lang)}}</span>
            </p>
        </form>
    </div><?php if (!empty($authenticateUserInfo) && ($authenticateUserInfo->user_id == $job_post->client_id || $authenticateUserInfo->user_type == 'Admin')): ?>
        <div class="clearfix"></div>
        <div ng-show="jobOfferFormFlag">        <h3>{{Translate::get("Job Offer",$lang)}}</h3>

        <div ng-model="errorMsg" ng-if="errorMsg" class="pi-alert-danger">
            <button data-dismiss="alert" class="pi-close" type="button"><i class="icon-cancel"></i></button>
            <p><strong><a id="top">Warning!</a></strong>
            <ul>
                <li ng-repeat="em in errorMsg">@{{em[0]}}</li>
            </ul>
            </p>        </div>
        <div class="clearfix"></div>
        <form id="jobOfferFrm" ng-submit="updateJobOfferPost()" name="jobOfferFrm" method="post">
            <div class="form-group"><label for="title" class="col-lg-3">{{Translate::get("Title",$lang)}}: * </label>

                <div class="col-lg-9">
                    <div class="pi-input-with-icon">
                        <div class="pi-input-icon"><i class="icon-pencil"></i></div>
                        <input type="text" name="title" class="form-control" ng-model="form.jobOffer.title"
                               placeholder="Job Title"></div>
                </div>
            </div>
            <div class="clearfix"></div>
            <hr class="pi-divider-gap-10">
            <div class="form-group"><label for="title" class="col-lg-3">{{Translate::get("Description",$lang)}}:
                    * </label>

                <div class="col-lg-9">
                    <div class="pi-input-with-icon">
                        
                        <textarea rows="8" placeholder="Description" id="description" name="description"
                                  ng-model="form.jobOffer.description" class="form-control"></textarea></div>
                </div>
            </div>
            <div class="clearfix"></div>
            <hr class="pi-divider-gap-10">            <?php if (!empty($authenticateUserInfo) && $authenticateUserInfo->user_type == 'Client') { ?>
                <div class="form-group"
                     ng-if="form.jobOffer.job_offer_status=='Progress' || form.jobOffer.job_offer_status=='Completed'">
                    <label for="title" class="col-lg-3">{{Translate::get("Status",$lang)}}: * </label>

                    <div class="col-lg-9">
                        <div class="pi-input-with-icon"><select ng-model="form.jobOffer.job_offer_status"
                                                                class="form-control">
                                <option value="Progress">Progress</option>
                                <option value="Completed">Complete</option>
                            </select></div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <hr class="pi-divider-gap-10">            <?php } elseif (!empty($authenticateUserInfo) && $authenticateUserInfo->user_type == 'Admin') { ?>
                <div class="form-group"><label for="title" class="col-lg-3">{{Translate::get("Status",$lang)}}:
                        * </label>

                    <div class="col-lg-9">
                        <div class="pi-input-with-icon"><select ng-model="form.jobOffer.job_offer_status"
                                                                class="form-control">
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approve</option>
                                <option value="Accepted">Accept</option>
                                <option value="Progress">Progress</option>
                                <option value="Completed">Complete</option>
                                <option value="Canceled">Cancel</option>
                                <option value="Declined">Decline</option>
                            </select></div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <hr class="pi-divider-gap-10">            <?php } ?>
            <div class="form-group"><label for="title" class="col-lg-3">{{Translate::get("Total Hour",$lang)}}:
                    *</label>

                <div class="col-lg-3">
                    <div class="pi-input-with-icon">
                        <div class="pi-input-icon"><i class="icon-pencil"></i></div>
                        <input type="text" name="title" class="form-control" ng-model="form.jobOffer.job_offer_hour"
                               ng-change="offerPriceCalculate()" placeholder="Total Hour"></div>
                </div>
            </div>
            <div class="clearfix"></div>
            <hr class="pi-divider-gap-10">
            <div class="form-group"><label for="title" class="col-lg-3">{{Translate::get("Total Cost",$lang)}}:
                    *</label>

                <div class="col-lg-3">
                    <div class="input-group"><span class="input-group-addon">$</span> <input type="text"
                                                                                             class="form-control"
                                                                                             disabled
                                                                                             ng-model="form.jobOffer.job_offer_price"><!--                        <span class="input-group-addon">.00</span>-->
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <hr class="pi-divider-gap-10">
            <!-- Submit button -->
            <p><img ng-show="jobOfferULoadingFlag" src="{{$theme}}/img/49.gif"/>
                <button ng-show="jobOfferUButtonFlag" type="submit"
                        class="btn pi-btn-green pi-btn-small pi-uppercase pi-weight-700 pi-letter-spacing"><i
                        class="icon-check pi-icon-left"></i>{{Translate::get("Save",$lang)}}
                </button>
                <span class="btn pi-btn-red pi-btn-small" ng-click="jobOfferFormFlag=0" style="cursor:pointer;">{{Translate::get("Cancel",$lang)}}</span>
            </p>
        </form>    </div><?php endif; ?>
    <div class="clearfix"></div>
    <div ng-show="jobPhaseFormFlag">
        <div ng-model="phaseErrorMsg" ng-if="phaseErrorMsg" class="pi-alert-danger">
            <button data-dismiss="alert" class="pi-close" type="button"><i class="icon-cancel"></i></button>
            <p><strong><a id="top">Warning!</a></strong>
            <ul>
                <li ng-repeat="pem in phaseErrorMsg">@{{pem[0]}}</li>
            </ul>
            </p>        </div>
        <h3>{{Translate::get("Phase",$lang)}}</h3>

        <form id="jobOfferPhaseFrm" ng-submit="addJobOfferPhase()" name="jobOfferPhaseFrm" method="post">
            <div class="pi-col-xs-6 pi-no-padding-left">
                <div class="form-group"><label for="exampleInputName-3">{{Translate::get("Phase Title",$lang)}}</label>

                    <div class="pi-input-with-icon">
                        <div class="pi-input-icon"><i class="icon-pencil"></i></div>
                        <input type="text" ng-model="form.jobPhase.phase_title" ng-required="true"
                               placeholder="Title Here" id="exampleInputName-1" class="form-control"></div>
                </div>
                <div class="form-group"><label for="exampleInputName-3">{{Translate::get("Phase
                        Details",$lang)}}</label>

                    <div class="pi-input-with-icon">
                        <div class="pi-input-icon"><i class="icon-pencil"></i></div>
                        <textarea rows="5" placeholder="Type your text" ng-required="true"
                                  ng-model="form.jobPhase.phase_details" id="exampleInputMessage-1"
                                  class="form-control"></textarea></div>
                </div>
                <hr class="pi-divider-gap-10">                <?php if (!empty($authenticateUserInfo) && $authenticateUserInfo->user_type == 'Admin'): ?>
                    <div class="form-group"><label for="exampleInputName-3">{{Translate::get("Phase
                            Status",$lang)}}</label>

                        <div class="pi-input-with-icon"><select ng-model="form.jobPhase.phase_payment_status"
                                                                class="form-control">
                                <option value="Pending">Pending</option>
                                <option value="Done">Done</option>
                                <option value="Hold">Hold</option>
                                <option value="Waiting">Waiting</option>
                                <option value="Progress">Progress</option>
                            </select></div>
                    </div>
                    <hr class="pi-divider-gap-10">                <?php endif; ?>            </div>
            <div ng-show="phaseEditableFieldFlag" class="pi-col-xs-6 pi-no-padding-right">
                <div style="padding-left:0;" class="pi-col-xs-6">
                    <div class="form-group pi-margin-bottom-15"><label for="exampleInputName-3">{{Translate::get("Phase
                            Hour",$lang)}}</label>

                        <div class="pi-input-with-icon">
                            <div class="pi-input-icon"><i class="icon-pencil"></i></div>
                            <input type="text" ng-model="form.jobPhase.phase_hour" ng-change="phasePriceCalculate()"
                                   ng-required="true" placeholder="Phase Hour" id="exampleInputName-"
                                   class="form-control"></div>
                    </div>
                </div>
                <div style="padding-right:0;" class="pi-col-xs-6">
                    <div class="form-group pi-margin-bottom-15"><label for="exampleInputName-3">{{Translate::get("Phase
                            Price",$lang)}}</label>

                        <div class="input-group"><span class="input-group-addon">$</span> <input type="text"
                                                                                                 ng-model="form.jobPhase.phase_price"
                                                                                                 disabled
                                                                                                 class="form-control">
                            <span class="input-group-addon">.00</span></div>
                    </div>
                </div>
                <div class="form-group pi-no-margin"><label for="exampleInputName-3">{{Translate::get("Phase
                        Start",$lang)}}</label>

                    <div class="pi-input-with-icon"><input style="text-indent: 25px;" type="text" class="form-control"
                                                           datepicker-popup="yyyy-MM-dd"
                                                           ng-model="form.jobPhase.phase_start" is-open="openedStart"
                                                           ng-required="true" datepicker-options="dateOptions"
                                                           min-date="minDate" close-text="Close"/> <span
                            class="input-group-btn">                            <button type="button"
                                                                                        class="btn btn-default"
                                                                                        ng-click="openStart($event)"
                                                                                        style="background: none repeat scroll 0 0 rgba(0, 0, 0, 0);margin-top: -61px;">
                                <i class="glyphicon glyphicon-calendar"></i></button>                        </span>
                    </div>
                </div>
                <div class="form-group pi-no-margin"><label for="exampleInputName-3">{{Translate::get("Phase
                        Deadline",$lang)}}</label>

                    <div class="pi-input-with-icon"><input style="text-indent: 25px;" type="text" class="form-control"
                                                           datepicker-popup="yyyy-MM-dd"
                                                           ng-model="form.jobPhase.phase_deadline" is-open="opened"
                                                           ng-required="true" datepicker-options="dateOptions"
                                                           min-date="minDate" close-text="Close"/> <span
                            class="input-group-btn">                                    <button type="button"
                                                                                                class="btn btn-default"
                                                                                                ng-click="open($event)"
                                                                                                style="background: none repeat scroll 0 0 rgba(0, 0, 0, 0);margin-top: -61px;">
                                <i class="glyphicon glyphicon-calendar"></i></button>                                  </span>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <hr class="pi-divider-gap-10">
            <p><img ng-show="phaseLoadingFlag" src="{{$theme}}/img/49.gif"/>
                <button ng-show="phaseSaveButtonFlag" type="submit"
                        class="btn pi-btn-green pi-btn-small pi-uppercase pi-weight-700 pi-letter-spacing">
                    {{Translate::get("Save",$lang)}}
                </button>
                <span ng-show="phaseLoadingFlag"><strong>Saving...</strong></span>
                <button class="btn pi-btn-red pi-btn-small" ng-hide="phaseLoadingFlag" ng-click="jobPhaseFormFlag=0;" style="cursor:pointer;">{{Translate::get("Cancel",$lang)}}</button>
            </p>
        </form>
    </div>
    <div class="clearfix"></div>
    <accordion close-others="oneAtATime">
        <accordion-group ng-repeat="(index_jo,jp_jo) in job_post.job_offer" is-open="$parent.accJOffer[index_jo]">
            <accordion-heading style="background:'#e8ffff';">
                <!--                <label ng-show="jp_jo.title">@{{jp_jo.title}}</label>-->
                <label>@{{jp_jo.title}}&nbsp;-&nbsp;@{{jp_jo.freelancer.first_name}}
                    @{{jp_jo.freelancer.last_name}} 
                </label> 
                <span><small><strong style="color:black;">( @{{jp_jo.job_offer_status}})</strong></small></span>
                <i class="pull-right glyphicon" ng-class="{'glyphicon-chevron-down': $parent.accJOffer[index_jo], 'glyphicon-chevron-right': !$parent.accJOffer[index_jo]}"></i>
            </accordion-heading>
            <div class="pi-col-xs-12">
                <div><p class="pi-col-xs-2 pi-no-padding"><span class="glyphicon glyphicon-ok"></span>&nbsp;@{{jp_jo.job_offer_status}}
                    </p>

                    <p class="pi-col-xs-1 pi-no-padding"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;@{{jp_jo.job_offer_hour}}
                    </p>

                    <p class="pi-col-xs-1 pi-no-padding"><span class="glyphicon glyphicon-usd"></span>&nbsp;@{{jp_jo.job_offer_price}}
                    </p>

                    <p class="pi-col-xs-4 pi-no-padding"><span class="glyphicon glyphicon-user"></span>&nbsp;@{{jp_jo.freelancer.first_name}}
                        @{{jp_jo.freelancer.last_name}}</p>

                    <div ng-if="checkPermission(index_jo)" class="pi-col-xs-4 pi-no-padding">
                        <form action="{{url('client/feedback')}}" method="post"
                              ng-if="jp_jo.job_offer_status=='Completed'"><input type="hidden" name="offer_id"
                                                                                 value="@{{jp_jo.id}}"/> <input
                                type="hidden" name="freelancer_id" value="@{{jp_jo.freelancer_id}}"/> <input
                                type="submit" class="btn pi-btn-base pi-btn-small pull-right" value="Feedback"/>
                        </form>                        <?php if (!empty($authenticateUserInfo) && ($authenticateUserInfo->user_id == $job_post->client_id || $authenticateUserInfo->user_type == 'Admin')) { ?>                            <?php //if(!empty($authenticateUserInfo) && $authenticateUserInfo->user_type == 'Admin'): ?><!--                                <span class="btn pi-btn-base pi-btn-small pull-right" ng-click="statusForm(index_jo)" style="cursor:pointer;">{{Translate::get("Status",$lang)}}</span>-->                            <?php //endif; ?>
                            <span class="btn pi-btn-green pi-btn-small pull-right" ng-click="editJobOffer(index_jo)"
                                  style="cursor:pointer;">{{Translate::get("Edit",$lang)}}</span>                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="pi-col-xs-12">
                <div><p class="pi-no-margin-bottom"><strong>@{{jp_jo.title}}</strong></p></div>
            </div>
            <div class="clearfix"></div>
            <div ng-if="checkPermission(index_jo)" class="pi-col-xs-12 pi-no-margin-top"><p>@{{jp_jo.description}}</p>
                <span class="btn pi-btn-blue pi-btn-small" ng-click="openJobPhaseForm(index_jo,jp_jo.id)"
                      style="cursor:pointer;">{{Translate::get("Add Phase",$lang)}}</span></div>
            <div class="clearfix"></div>
            <hr class="pi-divider-gap-10">
            <accordion close-others="oneAtATime" id="phase">
<!--                <accordion-group ng-repeat="(jph_index,jp_jo_jph) in jp_jo.job_phase" is-open="status.openPhase">-->
                <accordion-group ng-repeat="(jph_index,jp_jo_jph) in jp_jo.job_phase" is-open="$parent.accJOfferPhase[index_jo][jph_index]">
                    <accordion-heading> @{{jp_jo_jph.phase_title}} <i class="pull-right glyphicon"
                                                                      ng-class="{'glyphicon-chevron-down': $parent.accJOfferPhase[index_jo][jph_index], 'glyphicon-chevron-right': !$parent.accJOfferPhase[index_jo][jph_index]}"></i>
                    </accordion-heading>
                    <div class="pi-col-xs-12">
                        <div><p class="pi-col-xs-2 pi-no-padding"><span class="glyphicon glyphicon-calendar"></span>
                                @{{jp_jo_jph.phase_start}}</p>

                            <p class="pi-col-xs-2 pi-no-padding"><span class="glyphicon glyphicon-calendar"></span>
                                @{{jp_jo_jph.phase_deadline}}</p>

                            <p class="pi-col-xs-2 pi-no-padding"><span class="glyphicon glyphicon-ok"></span>
                                @{{jp_jo_jph.phase_payment_status}}</p>

                            <p class="pi-col-xs-1 pi-no-padding"><span class="glyphicon glyphicon-dashboard"></span>
                                @{{jp_jo_jph.phase_hour}}</p>

                            <p class="pi-col-xs-1 pi-no-padding"><span class="glyphicon glyphicon-usd"></span>
                                @{{jp_jo_jph.phase_price}}</p>

                            <p ng-if="checkPermission(index_jo)" class="pi-col-xs-2 pi-no-padding"><span
                                    ng-if="checkPhasePermission(index_jo,jph_index)"
                                    class="btn pi-btn-green pi-btn-small pull-right"
                                    ng-click="editJobPhase(index_jo,jph_index)" style="cursor:pointer;">Edit</span></p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="pi-col-xs-12 pi-no-margin-top"><p>@{{jp_jo_jph.phase_details}}</p></div>
                </accordion-group>
            </accordion>
            <div class="clearfix"></div>
            <ul>
                <li ng-repeat="comment in jp_jo.comments" style="list-style: none;">
                    <!--                    @{{comment.created_at}}-->
                    <div><p class="pi-col-xs-3 pi-no-padding"><span class="glyphicon glyphicon-dashboard"></span>
                            @{{formatDate(comment.created_at) | dateFormat}}</p>

                        <p class="pi-col-xs-4 pi-no-padding"><span class="glyphicon glyphicon-user"></span>&nbsp;@{{comment.honour.first_name}}
                            @{{comment.honour.last_name}}</p></div>
                    <div class="clearfix"></div>
                    @{{comment.message}}
                </li>
            </ul>
            <div ng-if="checkPermission(index_jo)">
                <form id="jobOfferCommentFrm" name="jobOfferCommentFrm" method="post">
                    <div class="pi-col-xs-12">
                        <div class="form-group"><label
                                for="exampleInputName-3">{{Translate::get("Comment:",$lang)}}</label></div>
                    </div>
                    <div class="pi-col-xs-12">
                        <div class="form-group">
                            <div class="pi-input-with-icon">
                                <div class="pi-input-icon"><i class="icon-pencil"></i></div>
                                <textarea rows="3" placeholder="Type your text" ng-required="true"
                                          ng-model="form.jobOfferComment.message" class="form-control"></textarea></div>
                        </div>
                    </div>
                    <div class="pi-col-xs-12">
                        <div class="form-group"><img ng-show="commentLoadingFlag" src="{{$theme}}/img/49.gif"
                                                     class="pull-right"/> <span ng-show="commentSaveButtonFlag"
                                                                                class="btn pi-btn-green pi-btn-small pull-right"
                                                                                ng-click="addJobOfferComment(index_jo)"
                                                                                style="cursor:pointer;">{{Translate::get("Save",$lang)}}</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="clearfix"></div>
        </accordion-group>
    </accordion>
</div>