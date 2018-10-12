@extends('templates.default.default')


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
            <div class="pi-tabs-content-transparent">

                <!-- Tab content -->
                <div ng-app="">
                    <div class="pi-row col-lg-12">
                        {{Form::Open(array('url'=>'exam/started'))}}
                        <h1>Take test for {{{$skill->category_name}}}</h1>
                        <p>
                            <label>Total Time:</label> {{{$questionSet->test_time}}} minutes
                        </p>
                        <?php
                            $q=0;
                            $rules = json_decode($questionSet->question_rule)
                        ?>
                        <p>
                            <label>Question Category</label>

                            <ul>
                            @foreach($rules as $qset)
                                    <?php
                                        $group = QuestionGroup::find($qset->group_id);
                                        $q += ($qset->questions[0]->q_no);
                                    ?>
                                    <li>{{$group->title}}</li>

                            @endforeach
                            </ul>
                        </p>
                        <p>
                            <label>Total Question : {{{$q}}}</label>
                        </p>
                        <input type="hidden" name="tid" value="{{{$questionSet->id}}}"/>
                        <input type="hidden" name="sid" value="{{{$skill->id}}}"/>
                        <input type="hidden" name="rid" value="{{{$rskill->id}}}"/>
                        <button type="submit" class="btn btn-primary">Start Test</button>
                        {{Form::Close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop