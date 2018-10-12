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
                        <h3>{{$rskill->last_question_index+1}}: {{{$question->question}}}</h3>

                        {{Form::Open(array('url'=>'exam/save-answer','method'=>'post'))}}
                        <?php $ans = json_decode($question->answers); ?>
                        @if($question->question_type == 'Radio')
                            <ul>
                            @foreach($ans as $i=> $a)
                                <li><input type="radio" name="selected_answer" value="{{$i}}"/> {{$a->answer or ''}}</li>
                            @endforeach
                            </ul>
                        @elseif($question->question_type == 'Checkbox')
                            <ul>
                                <?php // Helpers::debug($ans,1); ?>
                                @foreach($ans as $i=> $a)
                                <li><input type="checkbox" name="selected_answer[{{$i}}]" value="{{$i}}"/> {{{$a->answer}}}</li>
                                @endforeach
                            </ul>
                        @elseif($question->question_type == 'Textbox')
                            <ul>
                                @foreach($ans as $a)
                                <li>
                                    <input type="text" name="selected_answer" class="form-control"/>
                                </li>
                                @endforeach
                            </ul>
                        @endif
                        <label class="pull-right">Elapse Time : {{$elapse_time}} min / Total Time : {{$total_time}} min</label>
                        <hr class="clearfix"/>
                            <button type="submit" class="btn pi-btn-small pi-btn-green">Next</button>
                        {{Form::Close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop