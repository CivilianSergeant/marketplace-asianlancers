@extends('templates.freelancer.freelancer')


@section('content')
<!-- Breadcrumbs -->
<script type="text/javascript" src="{{$theme}}js/custom/test/test.js"></script>
<script>
    var massData = {{$testData}};

</script>

<div class="pi-section-w pi-border-bottom pi-section-grey">
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Categories</a></li>
                <li>Web Design</li>
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
                <div data-ng-app="xApp">


                    <div ng-controller="PaginationDemoCtrl">
                        <pagination
                            total-items="bigTotalItems"
                            ng-model="bigCurrentPage"
                            max-size="maxSize"
                            boundary-links="true"
                            rotate="false"
                            num-pages="numPages"
                            ng-change="pageChanged()">
                        </pagination>
                        <pre>
                            Page: @{{bigCurrentPage}} / @{{numPages}}
                            <input type="text" ng-model="customItem" data-ng-change="searchData()"/>
                        </pre>
                        <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
                            <thead>
                            <tr>
                                <td colspan="2" style="background:#F4F6F6;">
                                    <a href="{{url('qbuilder/groups')}}" class="btn pi-btn-base pi-btn-small"><i class="icon-plus"></i>Group</a>
                                    <a href="{{url('qbuilder/levels')}}" class="btn pi-btn-base pi-btn-small"><i class="icon-plus"></i>Level</a>
                                    <a href="{{url('qbuilder/qsets')}}" class="btn  pi-btn-small pi-btn-green"><i class="icon-list"></i>Sets</a>
                                    <a href="{{url('qbuilder/create')}}" class="btn pi-btn-base pi-btn-small"><i class="icon-plus"></i> New Question</a>
                                </td>
                            </tr>
                            </thead>
                            <thead>
                            <tr>
                                <th>First Name</th>

                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr ng-repeat="x in content | filter:first_name">
                                <td>@{{x.first_name}}</td>
                                <td>
                                    <button ng-click="deleteQuestion($index,question.id)" class="btn pi-btn-small btn-danger"><i class="icon-trash"></i></button>
                                </td>
                            </tr>

                            </tbody>

                        </table>



                    </div>



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