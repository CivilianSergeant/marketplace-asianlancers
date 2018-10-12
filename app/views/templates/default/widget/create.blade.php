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
                    <h3>Create New Widget</h3>
                    <form class="form-horizontal" action="{{url('widget/save-widget')}}" method="POST">
                        <div class="form-group">
                            <label class="col-lg-12">Name</label><br/>
                            <div class="col-lg-5">
                                <input type="text" maxlength="20" name="title" class="form-control"/>
                                <span><small>Maximum Character (20)</small></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-12">Type</label><br/>
                            <div class="col-lg-4">
                                <select name="type" class="form-control">
                                    @foreach($types as $type)
                                    <option value="{{$type}}">{{ucfirst(strtolower($type))}}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-12">Location</label><br/>
                            <div class="col-lg-4">
                                <select name="location" class="form-control">
                                    @foreach($locations as $location)
                                        <option value="{{$location}}">{{ucfirst(strtolower($location))}}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-12">Text</label><br/>
                            <div class="col-lg-12">
                                <textarea class="form-control"  name="content"></textarea>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-primary" value="Save" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>

@stop