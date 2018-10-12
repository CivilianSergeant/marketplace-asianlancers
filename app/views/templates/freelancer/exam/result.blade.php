@extends('templates.freelancer.freelancer')


@section('content')
<!-- Breadcrumbs -->

<div class="pi-section-w pi-border-bottom pi-section-grey">
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="#">Overview</a></li>
            </ul>
        </div>
        <div class="text-center">
            {{Helpers::showMessage()}}
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
                <div ng-app="">
                    <div class="pi-row col-lg-12">
                            <h1>Test Result for {{$rskill->GetTag->category_name}}</h1>
                        <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
                            <thead>
                                <tr>
                                    <th>Result Topic:</th>
                                    <th>Result in Percentage (Correct answer)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($groups  as $group)
                                <tr>
                                    <td>{{$group->title}}</td>
                                    <td>{{$group->mark}}% </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Total</td>
                                    <td>{{$totalObtainedPercentage}}%</td>
                                </tr>
                                <tr >
                                    <td style="border-top:1px solid #ccc;">Score</td>
                                    <td style="border-top:1px solid #ccc;">{{$score}} out of {{$scoreScale}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop