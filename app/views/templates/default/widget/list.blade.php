@extends('templates.default.default')

@section('content')
<!-- Breadcrumbs -->

<div class="pi-section-w pi-border-bottom pi-section-grey">
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('freelancer/overview')}}">Overview</a></li>

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
                <div class="col-lg-12">
                    <h3>Widget Lists</h3>
                    <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow ">
                        <thead>
                            <tr>
                                <th colspan="4" class="text-right"><a style="color:#fff;" href="{{url('widget/create')}}" class="btn btn-primary">New Widget</a></th>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Placed</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($widgets))
                                @foreach($widgets as $widget)
                                    <tr>
                                        <td>{{$widget->widget_name}}</td>
                                        <td>{{$widget->type}}</td>
                                        <td>{{$widget->location}}</td>
                                        <td>
                                            <a href="{{url('widget/create/'.Helpers::EncodeDecode($widget->id))}}"><i class="icon-book-open"></i></a>
                                            <a href="{{url('widget/delete/'.Helpers::EncodeDecode($widget->id))}}"><i class="icon-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
</div>

@stop