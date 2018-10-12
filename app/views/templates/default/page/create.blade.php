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
                    <form class="form-horizontal" action="{{url('page/save-page')}}" method="POST">
                        <div class="form-group">
                            <label class="col-lg-12">Title</label><br/>
                            <div class="col-lg-12">
                                <input type="text" maxlength="60" name="title" class="form-control"/>
                                <span><small>Maximum Character (60)</small></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-12">Description</label><br/>
                            <textarea id="pageEditor" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-12">Page Type</label><br/>
                            <div class="col-lg-4">
                                <select name="page_type" class="form-control">
                                    @foreach($page_types as $page_type)
                                        <option value="{{$page_type}}">{{ucfirst(strtolower($page_type))}} Site</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-12">Excerpt</label><br/>
                            <div class="col-lg-12">
                                <textarea class="form-control" maxlength="100" name="excerpt"></textarea>
                                <span><small>Maximum Character (100)</small></span>
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
<script type="text/javascript">
    $(function(){
        $('textarea#pageEditor').trumbowyg({fullscreenable: false});
    });
</script>
@stop