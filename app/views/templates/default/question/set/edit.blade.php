@extends('templates.default.default')

@section('content')
<script type="text/javascript">
    var levels = {{$levels}}
    var groups = {{$groups}}
    var skills = {{$skills}}
    var questionSet = {{$qset}}
    var token = "<?php echo Form::tokenCode(); ?>"

</script>
<script type="text/javascript" src="{{$theme}}js/custom/qbuilder/qsetcontroller.js"></script>

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
                <div ng-app="qsetApp" ng-controller="qsetEditController">
                    <div class="pi-row">
                        <div class="pi-col-xs-12">
                            <h4 class="pi-has-bg pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25">
                                Create Question Set
                            </h4>

                            <p>
                                Create new question set here. you can create a question set by creating some rules.
                            </p>
                            <div ng-model="errorMsg" ng-if="errorMsg" class="pi-alert-danger">
                                <button data-dismiss="alert" class="pi-close" type="button">
                                    <i class="icon-cancel"></i>
                                </button>

                                <p >
                                    <strong><a id="top">Warning!</a></strong> <ul><li ng-repeat="em in errorMsg">@{{em[0]}}</li></ul>
                                </p>
                            </div>

                            <hr class="pi-divider-gap-10">

                            <form id='qsetFrm' ng-submit="updateQuestionSet()" method ='post'>

                            <div class="rules">
                                <div class="col-lg-12">
                                    <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Set Title :</th>
                                                <th>
                                                    <div class="col-lg-10">
                                                        <input name="title" ng-model="form.title" class="form-control" />
                                                    </div>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th colspan="2">Total Time:</th>
                                                <th>
                                                    <div class="col-md-2">
                                                        <input name="test_time" ng-model="form.test_time" class="form-control" />
                                                    </div>
                                                    Min
                                                </th>
                                            </tr>
                                            <tr>
                                                <th colspan="2">Skill :</th>
                                                <th>
                                                    <div class="col-lg-7">
                                                        <select name="skill" ng-model="form.skill_id" class="form-control">
                                                            <option ng-repeat="skill in skills" ng-selected="skill.id == form.skill_id" value="@{{skill.id}}">@{{skill.category_name}}</option>
                                                        </select>
                                                    </div>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th colspan="2">
                                                    Rules
                                                <th> <button class="btn pi-btn-small btn-info pull-right" type="button" ng-click="addGroupRow()"><i class="icon-plus"></i> Add Group</button> </th>
                                                </th>
                                            </tr>

                                        </thead>
                                    </table>
                                </div>
                                <div ng-repeat="rule in form.rules">

                                    <div class="col-lg-12">
                                            <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">

                                                <thead ng-init="groupIndex=$index">
                                                    <tr>
                                                        <th>Group :</th>
                                                        <th colspan="2">
                                                            <div class="col-lg-7">
                                                                <select name="group" ng-model="rule.group_id" class="form-control">
                                                                    <option ng-repeat="group in groups" ng-selected="group.id == rule.group_id" value="@{{group.id}}">@{{group.title}}</option>
                                                                </select>
                                                            </div>
                                                            <button class="btn pi-btn-small btn-warning pull-right" type="button" ng-click="delGroupRow(groupIndex)"><i class="icon-trash"></i> Remove</button>
                                                        </th>

                                                    </tr>

                                                    <tr>
                                                        <th>Question Level</th>
                                                        <th>Number of Question </th>
                                                        <th> <button class="btn pi-btn-small btn-info pull-right" type="button"  ng-click="addQuestionRow(groupIndex)"><i class="icon-plus"></i> Add Question</button> </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="q in rule.questions">
                                                        <td>
                                                            <select name="level" class="form-control" ng-model="q.level_id">
                                                                <option ng-repeat="level in levels" ng-selected="level.id == q.level_id" value="@{{level.id}}">@{{level.title}}</option>
                                                            </select>
                                                        </td>
                                                        <td><input type="text" class="form-control" ng-model="q.q_no"/></td>
                                                        <td><button class="btn pi-btn-small btn-danger pull-right" type="button" ng-init="qIndex=$index" ng-click="delQuestionRow(groupIndex,qIndex)"><i class="icon-trash"></i> Remove</button></td>
                                                    </tr>
                                                </tbody>

                                            </table>


                                    </div>
                                    <hr class="clear"/>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <button type="submit"
                                                class="btn pi-btn-base pi-btn-big pi-uppercase pi-weight-700 pi-letter-spacing">
                                            <i class="icon-check pi-icon-left"></i>Save
                                        </button>
                                    </div>
                                </div>

                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop