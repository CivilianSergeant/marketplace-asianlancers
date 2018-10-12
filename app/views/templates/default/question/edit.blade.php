@extends('templates.default.default')

@section('content')
<script type="text/javascript">
    var levels = {{$levels}}
    var groups = {{$groups}}
    var skills = {{$skills}}
    var question = {{$question}}
    var token = "<?php echo Form::tokenCode(); ?>"
</script>
<script type="text/javascript" src="{{$theme}}js/custom/qbuilder/qbuildercontroller.js"></script>

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
                <div ng-app="qbuilderApp" ng-controller="qbuilderEditController">
                    <div class="pi-row">
                        <div class="pi-col-xs-12">

                            <h4 class="pi-has-bg pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25">
                                Edit Question
                            </h4>

                            <p>
                                After complete changes click save to update
                            </p>
                            <div ng-model="errorMsg" ng-if="errorMsg" class="pi-alert-danger">
                                <button data-dismiss="alert" class="pi-close" type="button">
                                    <i class="icon-cancel"></i>
                                </button>
                                <p>
                                    <strong><a id="top">Warning!</a></strong> <ul><li ng-repeat="em in errorMsg">@{{em[0]}}</li></ul>
                                </p>
                            </div>
                            <hr class="pi-divider-gap-10">

                            <!-- Forms -->
                            <form id="questionFrm" ng-submit="updateQuestion()" name="questionFrm" method="post">

                                <div class="form-group qbuilder-selection">
                                    <label for="question_skill" class="col-lg-3">Skill :</label>
                                    <div class="col-lg-3">
                                        <select name="skill" ng-model="form.skill_id" class="form-control">
                                            <option ng-repeat="skill in skills" ng-selected="skill.id==form.skill_id" value="@{{skill.id}}">@{{skill.category_name}}</option>
                                        </select>
                                    </div>&nbsp;
                                </div>

                                <div class="form-group qbuilder-selection">
                                    <label for="question_level" class="col-lg-3">Question Level :</label>
                                    <div class="col-lg-3">
                                        <select name="question_level" ng-model="form.level_id" class="form-control">
                                            <option ng-repeat="level in levels" ng-selected="level.id==form.level_id" value="@{{level.id}}">@{{level.title}}</option>
                                        </select>

                                    </div>&nbsp;
                                    <label for="addQuestionlevel"><small><a href="#">Add Level</a></small></label>
                                </div>

                                <div class="form-group qbuilder-selection">
                                    <label for="question_level" class="col-lg-3">Question Group :</label>
                                    <div class="col-lg-3">
                                        <select name="question_group" ng-model="form.group_id" class="form-control">
                                            <option ng-repeat="group in groups" ng-selected="group.id==form.group_id" value="@{{group.id}}">@{{group.title}}</option>
                                        </select>
                                    </div>
                                    &nbsp;<label for="addQuestionGroup"><small><a href="#">Add Group</a></small></label>
                                </div>

                                <div class="form-group">
                                    <label for="question_name" class="col-lg-3">Question :</label>

                                    <div class="pi-input-with-icon col-lg-12" style="min-height:70px;">
                                        <input type="text" class="form-control" ng-model="form.question" name="question"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="answer_time" class="col-lg-3">Possible Answer Time :</label>
                                    <div class="col-md-2">

                                        <input type="text" ng-model="form.answer_time" name="answer_time" class="form-control timepicker-default">

                                    </div>
                                    <span>Min</span>
                                </div>

                                <div class="form-group">
                                    <label for="question_type" class="col-lg-3">Answer Type :</label>
                                    <div class="col-lg-7" ng-init="question_type='Textbox'">
                                        <labe><input ng-model="form.question_type" type="radio" ng-click="refreshAnswers()" name="question_type" value="Checkbox" /> Check Box</labe>
                                        <labe><input ng-model="form.question_type" type="radio" ng-click="refreshAnswers()" name="question_type" value="Radio" /> Radio Option</labe>
                                        <labe><input ng-model="form.question_type" type="radio" ng-click="sliceRow()" name="question_type" value="Textbox" /> Text Box</labe>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
                                            <thead>
                                                <tr>
                                                    <th>Answer</th>
                                                    <th>Select Correct Answer <button type="button" class="btn pi-btn pi-btn-small" ng-click="addRow()"><i class="icon-plus"></i> Add Answer</button></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="answer in form.answers">
                                                    <td><input type="text" class="form-control" ng-model="answer.answer" name="answers[]" /></td>
                                                    <td>
                                                        <input ng-if="(form.question_type != 'Textbox' && form.question_type == 'Checkbox')" ng-model="answer.correct" ng-checked="answer.correct" value="1"  type="checkbox" name="correct_answer[]"/>
                                                        <input ng-if="(form.question_type == 'Radio')" ng-model="answer.correct" value="1" ng-click="updateAnswers($index)" type="radio" name="correct_answer[]"/>
                                                    </td>
                                                </tr>

                                            </tbody>

                                        </table>
                                    </div>
                                </div>



                                <!-- Submit button -->
                                <div class="form-group">
                                    <div class="col-lg-12">

                                        <button type="submit"
                                                class="btn pi-btn-base pi-btn-big pi-uppercase pi-weight-700 pi-letter-spacing">
                                            <i class="icon-check pi-icon-left"></i>Save
                                        </button>
                                    </div>
                                </div>
                                <!-- End submit button -->

                            </form>
                            <!-- End forms -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

</script>
@stop