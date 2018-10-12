@extends('templates.default.default')


@section('content')
<script type="text/javascript">
    var skills = {{$skills}}
	var token = "<?php echo Form::tokenCode(); ?>"
</script>
<script type="text/javascript" src="{{$theme}}js/custom/skill/skillcontroller.js"></script>
<!-- Breadcrumbs -->

<div class="pi-section-w pi-border-bottom pi-section-grey">
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('admin')}}">Overview</a></li>
                <li>Skill</li>
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
            <ul class="pi-tabs-navigation pi-tabs-navigation-transparent profile-po" id="myTabs">
                {{Theme::make('partial.menu',array())}}
            </ul>
            <div class="pi-tabs-content pi-tabs-content-transparent">

                <!-- Tab content -->
                <div ng-app="skillApp" ng-controller="skillController">
                    <div class="pi-row">

                        <!-- Col 12 -->
                        <div class="pi-col-xs-12">

                            <h4 class="pi-has-bg pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25">
                                Create Skills
                            </h4>

                            <p>
                                Manage all skills here. skill will appear as tag in freelancer profile or job post.
                            </p>

                            <hr class="pi-divider-gap-10">

							<div ng-model="errorMsg" ng-if="errorMsg" class="pi-alert-danger">
                                <button data-dismiss="alert" class="pi-close" type="button">
                                    <i class="icon-cancel"></i>
                                </button>
                                <p>
                                    <strong><a id="top">Warning!</a></strong> <ul><li ng-repeat="em in errorMsg">@{{em[0]}}</li></ul>
                                </p>
                            </div>
							<div ng-model="successMsg" ng-if="successMsg" class="pi-alert-success">
                                <button data-dismiss="alert" class="pi-close" type="button">
                                    <i class="icon-cancel"></i>
                                </button>
                                <p ng-repeat="sm in successMsg">
                                    @{{sm[0]}}
                                </p>
                            </div>
							
							
                            <!-- Forms -->
                            <form id="skillFrm" ng-submit="addSkill()" method="post">

                                <!-- First name form -->
                                <div class="form-group">
                                    <label for="exampleInputName-3">Skill name</label>

                                    <div class="pi-input-with-icon">
                                        <input type="text" class="form-control" ng-model="form.category_name" name="category_name"
                                               placeholder="e.g. PHP">
                                    </div>
                                </div>
                                <!-- End first name form -->


                                <hr class="pi-divider-gap-10">

                                <!-- Submit button -->
                                <p>
                                    <button type="submit"
                                            class="btn pi-btn-base pi-btn-big pi-uppercase pi-weight-700 pi-letter-spacing">
                                        <i class="icon-check pi-icon-left"></i>Save
                                    </button>
                                </p>
                                <!-- End submit button -->

                            </form>
                            <!-- End forms -->
							
							<div ng-model="errorMsgList" ng-if="errorMsgList" class="pi-alert-danger">
                                <button data-dismiss="alert" class="pi-close" type="button">
                                    <i class="icon-cancel"></i>
                                </button>
                                <p>
                                    <strong><a id="top">Warning!</a></strong> <ul><li ng-repeat="eml in errorMsgList">@{{eml[0]}}</li></ul>
                                </p>
                            </div>
							<div ng-model="successMsgList" ng-if="successMsgList" class="pi-alert-success">
                                <button data-dismiss="alert" class="pi-close" type="button">
                                    <i class="icon-cancel"></i>
                                </button>
                                <p ng-repeat="sml in successMsgList">
                                    @{{sml[0]}}
                                </p>
                            </div>
							
                            <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
								<thead>
                                    <tr>
                                        <td colspan="4">
                                            <pagination
                                                total-items="bigTotalItems"
                                                ng-model="bigCurrentPage"
                                                max-size="maxSize"
                                                boundary-links="true"
                                                rotate="false"
                                                num-pages="numPages"
                                                ng-change="pageChanged()">
                                            </pagination>
                                            <div class="col-md-2">Go To:

                                                <input type="text" ng-model="bigCurrentPage"  name="bigCurrentPage" ng-change="pageChanged()" class="form-control"/>
                                            </div>
                                        </td>
                                    </tr>
                                </thead>
                                <!-- Table head -->
                                <thead>

                                <!-- Table row -->
                                <tr>
                                    <th style="width: 50px;">

                                    </th>
                                    <th><a href="" ng-click="predicate = 'category_name'; reverse=!reverse">Skill Name</a></th>
                                    <th>Display</th>
                                    <th>Actions</th>

                                </tr>
                                <!-- End table row -->

                                </thead>
                                <!-- End table head -->

                                <!-- Table body -->
                                <tbody>

                                <!-- Table row -->
                                <tr ng-repeat="skill in skills | orderBy:predicate:reverse">
                                    <td>
                                        @{{$index+1}}
                                    </td>
                                    <td>
                                        @{{skill.category_name}}
                                    </td>
                                    <td ng-init="checked=skill.display">
                                       <input type="checkbox" ng-if="checked" checked="checked"   ng-click="updateDisplay(skill.id,0)" />
                                       <input type="checkbox"  ng-if="checked != 1" ng-click="updateDisplay(skill.id,1)" />
                                    </td>
                                    <td>
                                        <a href="" ng-click="deleteSkill($index,skill.id)" title="Delete">
                                            <i class="icon-trash pi-icon-left"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- End table row -->

                                </tbody>
                                <!-- End table body -->
								<tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <pagination
                                                total-items="bigTotalItems"
                                                ng-model="bigCurrentPage"
                                                max-size="maxSize"
                                                boundary-links="true"
                                                rotate="false"
                                                num-pages="numPages"
                                                ng-change="pageChanged()">
                                            </pagination>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- End col 12 -->


                    </div>
                    <!-- End row -->
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