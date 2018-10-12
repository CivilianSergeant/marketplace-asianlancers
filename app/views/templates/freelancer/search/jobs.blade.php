@extends('templates.freelancer.freelancer')

@section('content')
<script type="text/javascript">
    var jobs = {{json_encode($jobs)}}

</script>
<script type="text/javascript" src="{{$theme}}js/custom/search/jobsearch.js"></script>
<!-- Breadcrumbs -->

<div class="pi-section-w pi-border-bottom pi-section-grey">
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('search/jobs/'.Request::segment(3))}}">Search</a></li>
                <li>Jobs</li>
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
            <ul class="pi-tabs-navigation" style="margin-top:0;">
            
            <div class="list-group">
              <a class="list-group-item disabled">Categories </a>
              @if(count($categories))
                    @foreach($categories as $cat)
   <a class="list-group-item" href="{{url('search/jobs/'.$cat->slug)}}">
   <span class="badge pi-bullet-icon-img" style="padding:4px 7px;">{{$cat->job_count}}</span>{{$cat->title}}</a>
                    @endforeach
                @endif
            </div>

            </ul>
            <div class="pi-tabs-content pi-tabs-content-transparent" style="border-left:none;">

                <!-- Tab content -->
                <div ng-app="jobSearchApp" ng-controller="jobSearchController">
                    <div ng-cloak >
                        @if(count($jobs)>10)
                                    <pagination
                                        total-items="bigTotalItems"
                                        ng-model="bigCurrentPage"
                                        max-size="maxSize"
                                        boundary-links="true"
                                        rotate="false"
                                        num-pages="numPages"
                                        ng-change="pageChanged()">
                                    </pagination>
                        @endif
                            <div ng-repeat="job in jobs" class="bs-docs-section"> 
                                  <div class="bs-example">
                                  <a href="@{{job.slug}}" class="title">@{{job.title}}</a>
                                    <ol class="breadcrumb">
                                        <li class="active">
                                            <strong>Est. Hour: @{{job.hour}} </strong> - <b style="color:#090;">Est. Budget: $@{{job.amount}} </b> -
                                            <i ng-if="job.days_ago > 0">Posted @{{job.days_ago}} Day@{{(job.days_ago >1)? "'s" : ''}} ago</i>
                                            <i ng-if="job.days_ago <= 0">Posted Today</i>
                                        </li>
                                    </ol>
                                  <p>@{{job.excerpt}}</p>      
                                  </div>
                                <div class="highlight">
                                    <ul style="padding-left:0; margin-bottom:0;" class="cat-link-new clearFix">
                                    <li ng-repeat="tag in tags($index)" class="ng-scope"><a class="ng-binding">@{{tag}}</a></li>
                                    </ul>
                                </div>
                            </div>                     

                              
                                
                                                            
                                <div ng-if="jobs.length == 0" class="bs-docs-section"> 
                                  <div class="bs-example">
     									<p class="no-jobs"></p>
                                  </div>
                                <div class="highlight"></div>
                                </div>
                                
                        @if(count($jobs)>10)        
                                <pagination
                                        total-items="bigTotalItems"
                                        ng-model="bigCurrentPage"
                                        max-size="maxSize"
                                        boundary-links="true"
                                        rotate="false"
                                        num-pages="numPages"
                                        ng-change="pageChanged()">
                                    </pagination>
                            @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{Theme::make('search.partial.partial')}}
@stop