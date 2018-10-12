@extends('templates.default.default')


@section('content')
<script type="text/javascript">
    var groups = {{$groups}}
</script>
<script type="text/javascript" src="{{$theme}}js/custom/qbuilder/qgroupcontroller.js"></script>
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
                <div ng-app="qgroupApp" ng-controller="qgroupController">
                    <div class="pi-row">

                        <!-- Col 12 -->
                        <div class="pi-col-xs-12">

                            <h4 class="pi-has-bg pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25">
                                Create Question Groups
                            </h4>

                            <p>
                                Manage all question groups here.
                            </p>

                            <hr class="pi-divider-gap-10">

                            <!-- Forms -->
                            <form id="skillFrm" ng-submit="addGroup()" method="post">

                                <!-- First name form -->
                                <div class="form-group">
                                    <label for="title">Group name</label>

                                    <div class="pi-input-with-icon">
                                        <input type="text" class="form-control" ng-model="form.title" name="title" placeholder="e.g. Introduction">
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
                            <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">

                                <!-- Table head -->
                                <thead>

                                <!-- Table row -->
                                <tr>
                                    <th style="width: 50px;">

                                    </th>
                                    <th><a href="" ng-click="predicate = 'title'; reverse=!reverse">Group Name</a></th>

                                    <th>No. Question</th>
                                    <th>Actions</th>

                                </tr>
                                <!-- End table row -->

                                </thead>
                                <!-- End table head -->

                                <!-- Table body -->
                                <tbody>

                                <!-- Table row -->
                                <tr ng-repeat="group in groups | orderBy:predicate:reverse">
                                    <td>
                                        @{{$index+1}}
                                    </td>
                                    <td>
                                        @{{group.title}}
                                    </td>
                                    <td>
                                        @{{group.no_question}}
                                    </td>

                                    <td>
                                        <a href="" ng-click="deleteGroup($index,group.id)" title="Delete">
                                            <i class="icon-trash pi-icon-left"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- End table row -->

                                </tbody>
                                <!-- End table body -->

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