@extends('templates.default.default')


@section('content')
<script type="text/javascript">
    var skills = {{$skills}}
    var rskills = {{$rskills}}
</script>
<script type="text/javascript" src="{{$theme}}js/custom/skill/relatedskillcontroller.js"></script>
<!-- Breadcrumbs -->

<div class="pi-section-w pi-border-bottom pi-section-grey">
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('freelancer/overview')}}">Overview</a></li>
                <li><a href="{{url('freelancer/'.$title['action'])}}">{{$title['title']}}</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- End breadcrumbs -->

<!-- - - - - - - - - - SECTION - - - - - - - - - -->

<div class="pi-section-w pi-section-white pi-slider-enabled piSocials">
    <div class="pi-section pi-padding-bottom-30">
        {{Helpers::showMessage()}}
        <!-- Openings -->
        <div class="pi-tabs-vertical pi-responsive-sm">
            <ul class="pi-tabs-navigation pi-tabs-navigation-transparent profile-po" id="myTabs">
                {{Theme::make('partial.menu',array())}}
            </ul>
            <div class="pi-tabs-content pi-tabs-content-transparent">

                <!-- Tab content -->
                <div ng-app="relatedSkillApp" ng-controller="relatedSkillAppController">
                    <div ng-cloak class="pi-row col-lg-12">
                        <h4 class="pi-has-bg pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25">
                                {{Translate::get("Add Skills",$lang)}}
                            </h4>

                            <p>
                                Manage all skills here. skill will appear as tag in freelancer profile or job post.
                            </p>

                            <hr class="pi-divider-gap-10">

                            <div ng-model="errorMsg" ng-show="errorMsg.length>0" class="pi-alert-danger">
                                <button data-dismiss="alert" class="pi-close" type="button">
                                    <i class="icon-cancel"></i>
                                </button>
                                <p>
                                    <strong><a id="top">Warning!</a></strong>
                                    <ul>
                                        <li ng-repeat="em in errorMsg">@{{em[0]}}</li>
                                    </ul>
                                </p>
                            </div>
                            <div ng-model="successMsgList" ng-show="successMsgList" class="pi-alert-success">
                                <button data-dismiss="alert" class="pi-close" type="button">
                                    <i class="icon-cancel"></i>
                                </button>
                                <p>
                                    @{{successMsgList}}
                                </p>
                            </div>
                            <div ng-model="successMsg" ng-show="successMsg.length>0" class="pi-alert-success">
                                <button data-dismiss="alert" class="pi-close" type="button">
                                    <i class="icon-cancel"></i>
                                </button>
                                <p>
                                    <strong><a id="top">Success !</a></strong>
                                    <ul>
                                        <li ng-repeat="sm in successMsg">@{{sm[0]}}</li>
                                    </ul>
                                </p>
                            </div>



                        <!-- Forms -->
                            <form id="skillFrm" ng-submit="addSkill()" class="form-horizontal" method="post">

                                <!-- First name form -->
                                <div class="form-group">
                                    <label for="exampleInputName-3" class="col-lg-3">{{Translate::get("Skill name",$lang)}}</label>

                                    <div class="pi-input-with-icon col-lg-10">
                                        <input type="hidden" style="width:300px" ui-select2="multiSkillSelection" ng-model="tmp_skill_tag"/>
                                        <!--<input type="text" ng-model="form.category_name" class="form-control" typeahead="skill.category_name for skill in skills | filter:$viewValue | limitTo:8" placeholder="e.g. PHP">-->
                                    </div>
                                    <!-- Submit button -->
                                    <p class="col-lg-2">
                                        <button type="submit"
                                                class="btn pi-btn-base pi-btn-sm pi-uppercase pi-weight-700 pi-letter-spacing">
                                            <i class="icon-check pi-icon-left"></i>{{Translate::get("Save",$lang)}}
                                        </button>
                                    </p>
                                    <!-- End submit button -->
                                </div>
                                <!-- End first name form -->






                            </form>
                            <!-- End forms -->
                            <h5>{{Translate::get("My Skills",$lang)}}</h5>
                            <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
                                <!-- <thead>
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
                                </thead> -->
                                <!-- Table head -->
                                <thead>

                                <!-- Table row -->
                                <tr>
                                    <th style="width: 50px;">

                                    </th>
                                    <th>{{Translate::get("Skill name",$lang)}}</th>
                                    <th>{{Translate::get("Take Test",$lang)}}</th>
                                    <th>{{Translate::get("Display",$lang)}}</th>
                                    <th>{{Translate::get("Action",$lang)}}</th>

                                </tr>
                                <!-- End table row -->

                                </thead>
                                <!-- End table head -->

                                <!-- Table body -->
                                <tbody>

                                <!-- Table row -->
                                <tr ng-repeat="rskill in rskills | orderBy:predicate:reverse">
                                    <td>
                                        @{{$index+1}}
                                    </td>

                                    <td>
                                        @{{rskill.skill.category_name}}
                                    </td>
                                    <td ng-if="rskill.test_taken != 0">Last Exam Date : @{{rskill.test_start_at * 1000 | date: medium}}
                                        <label>Retake after @{{getNextTime(rskill.test_start_at) * 1000 | date: medium}}</label>
                                        {{Form::Open(array('url'=>'exam', 'method'=>'post'))}}
                                            <input type="hidden" name="id" value="@{{rskill.id}}"/>
                                            <button ng-if="rskill.can_take_test > 0" class="btn pi-btn-small pi-btn-orange" type="submit">{{Translate::get("Retake Test",$lang)}}</button>
                                        {{Form::Close()}}
                                    </td>
                                    <td ng-if="rskill.test_taken == 0">
                                        {{Form::Open(array('url'=>'exam', 'method'=>'post'))}}
                                            <input type="hidden" name="id" value="@{{rskill.id}}"/>

                                            <button ng-if="rskill.can_take_test > 0" class="btn pi-btn-small pi-btn-orange" type="submit">{{Translate::get("Take Test",$lang)}}</button>
                                        {{Form::Close()}}
                                    </td>
                                    <td ng-init="checked=rskill.display">
                                       <input type="checkbox" ng-if="checked" checked="checked"   ng-click="updateDisplay(rskill.id,0)" />
                                       <label ng-if="rskill.test_taken"><a href="" ng-click="getResultLink(rskill.id)">{{Translate::get("View Result",$lang)}}</a></label>
                                       <input type="checkbox"  ng-if="checked != 1" ng-click="updateDisplay(rskill.id,1)" />
                                    </td>
                                    <td>
                                        <a href="" ng-click="deleteSkill($index,rskill.id)" title="Delete">
                                            <i class="icon-trash pi-icon-left"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- End table row -->

                                </tbody>
                                <!-- End table body -->
                                <!--<tfoot>
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
                                </tfoot>-->
                            </table>
                            <h5>{{Translate::get("My Tests",$lang)}}</h5>
                            <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
                                <thead>
                                    <tr>
                                        <th>{{Translate::get("Technology/Skill",$lang)}}</th>
                                        <th>{{Translate::get("View Result",$lang)}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($tests))
                                        @foreach($tests as $test)
                                            <tr>
                                                <td>{{$test->skill->category_name}}</td>
                                                <td><a class="btn pi-btn-green pi-btn-small" href="{{url('exam/result/'.Helpers::EncodeDecode($test->id))}}">{{Translate::get("View Result",$lang)}}</a></td>
                                            </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <td colspan="2" class="text-center">No test taken yet</td>
                                    </tr>
                                    @endif
                                </tbody>

                            </table>
                            <a href="{{url('freelancer/overview')}}" class="btn pi-btn-base pi-btn-sm pi-uppercase pi-weight-700 pi-letter-spacing">
                                <i class="icon-back pi-icon-left"></i>{{Translate::get("Back to Overview",$lang)}}
                            </a>
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
    <div class="pi-texture" style="background: url({{$theme}}img/hexagon.png) repeat;"></div>
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