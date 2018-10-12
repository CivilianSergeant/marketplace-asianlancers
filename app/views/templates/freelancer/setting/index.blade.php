@extends('templates.freelancer.freelancer')


@section('content')
<!-- Breadcrumbs -->

<div class="pi-section-w pi-border-bottom pi-section-grey" >
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="#">Overview</a></li>
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
            <ul class="pi-tabs-navigation pi-tabs-navigation-transparent" id="myTabs">
                {{Theme::make('partial.menu',array())}}
            </ul>
            <div class="pi-tabs-content pi-tabs-content-transparent">

                <!-- Tab content -->
                <div  ng-app="userApp" data-ng-controller="AdminController">

                    <div ng-cloak class="pi-row">

                        <!-- Col 6 -->
                        <div class="col-lg-12">
                            <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">

                                <!-- Table head -->
                                <thead>

                                <!-- Table row -->
                                <tr>
                                    <th>
                                        User Name
                                    </th>
                                    <th>
                                        User Type
                                    </th>
                                    <th>
                                        Permissions
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                                <!-- End table row -->

                                </thead>
                                <!-- End table head -->

                                <!-- Table body -->
                                <tbody>

                                <!-- Table row -->
                                <tr ng-repeat="x in userList | orderBy: x.first_name">
                                    <td>
                                        @{{x.first_name +' '+x.last_name}}
                                    </td>
                                    <td>
                                        @{{x.user_type}}
                                    </td>
                                    <td ng-if="x.permissions != ''">
                                        @{{x.permissions}}
                                    </td>
                                    <td ng-if="x.permissions == ''">
                                        No Permission assign.
                                    </td>
                                    <td>
                                        @{{x.email}}
                                    </td>
                                    <td ng-if="x.banned == 1">
                                        Inactive
                                    </td>
                                    <td ng-if="x.banned != 1 ">
                                        Active
                                    </td>
                                    <td>
                                        <a target="_blank" href="#" ><i class="icon-pencil"></i></a>

                                        <a href="" ng-click="deactivateUser($index,x.id)"><i class="icon-trash"></i></a>
                                    </td>
                                </tr>
                                <!-- End table row -->

                                </tbody>
                                <!-- End table body -->

                            </table>
                        </div>
                        <!-- End col 6 -->


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