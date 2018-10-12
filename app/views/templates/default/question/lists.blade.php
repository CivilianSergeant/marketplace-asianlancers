@extends('templates.default.default')

@section('content')

<!-- Breadcrumbs -->
<script type="text/javascript">
    var questions = {{$questions}}
</script>
<script type="text/javascript" src="{{$theme}}js/custom/qbuilder/qbuildercontroller.js"></script>
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
                <div ng-app="qbuilderApp" ng-controller="qlistsController">
                    <div class="pi-row">
                        <div class="pi-col-xs-12">

                            <h4 class="pi-has-bg pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25">
                                Question Bank
                            </h4>

                            <p>
                                Create new question here. you can create a question set by creating some rules.
                            </p>

                            <hr class="pi-divider-gap-10">

                            <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
                                <thead>
                                    <tr>
                                        <td colspan="7" style="background:#F4F6F6;">
                                            <a href="{{url('qbuilder/groups')}}" class="btn pi-btn-base pi-btn-small"><i class="icon-plus"></i>Group</a>
                                            <a href="{{url('qbuilder/levels')}}" class="btn pi-btn-base pi-btn-small"><i class="icon-plus"></i>Level</a>
                                            <a href="{{url('qbuilder/qsets')}}" class="btn  pi-btn-small pi-btn-green"><i class="icon-list"></i>Sets</a>
                                            <a href="{{url('qbuilder/create')}}" class="btn pi-btn-base pi-btn-small"><i class="icon-plus"></i> New Question</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">
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
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Question</th>
                                    <th>Skill</th>
                                    <th>Type</th>
                                    <th>Level</th>
                                    <th>Group</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                            <tr ng-repeat="question in questions">
                                                <td>#@{{question.id}}</td>
                                                <td>@{{question.question}}</td>
                                                <td>@{{question.skill_tag.category_name}}</td>
                                                <td>@{{question.question_type}}</td>
                                                <td>@{{question.q_level.title}}</td>
                                                <td>@{{question.q_group.title}}</td>
                                                <td>
                                                    <a target="_blank" href="{{url('qbuilder/edit/')}}/@{{question.id}}"><i class="icon-book-open"></i></a>
                                                    <a href="" ng-click="deleteQuestion($index,question.id)"><i class="icon-trash"></i></a>
                                                </td>
                                            </tr>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop