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
                {{Helpers::showMessage()}}
                <!-- Tab content -->
                <div ng-app="">
                    <div ng-cloak class="pi-row col-lg-12">

                    {{ Form::open(array('url'=>'message/compose','class'=>'pull-right','method'=>'get')) }}
                    <button class="btn btn-primary panel-btn" type="submit"><i class="fa fa-plus-circle"></i> Compose</button>
                    {{ Form::close() }}
                    </div>

                <div class="pi-row col-lg-12">
                    <h3>{{{$message->subject}}}</h3>
                    <p>
                        {{{$message->details}}}
                    </p>
                    @if($message->attachment != '')
                    <a target="_blank" href="{{{url('message/download-attachment/'.urlencode($message->attachment))}}}"><i class="fa fa-paperclip"></i> Download Attachement</a>
                    @endif
                    <hr/>
                    @if(count($message->Comments))
                    <h3>Replies ( {{{ count($message->Comments)}}} )</h3>

                    <ul id="reply-item">
                        @foreach($message->Comments as $comment)
                        <li>
                            <span class="subject">
                                <span class="from">{{{$comment->message}}}</span>
                            </span>
                            <div class="time">{{{$comment->User->first_name.' '.$comment->User->last_name}}} - {{{Helpers::dateTimeFormat('j F, Y',$comment->created_at)}}}</div>
                            @if($comment->attachment != '')
                                <a target="_blank" href="{{{url('message/download-attachment/'.urlencode($comment->attachment))}}}"><i class="fa fa-paperclip"></i> {{{$comment->attachment}}}</a>
                            @endif
                            <br/>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <h3>No Reply found</h3>

                    @endif
                </div>



                <div class="row">
                    {{Form::Open(array('url'=>'message/reply','enctype'=>'multipart/form-data','method'=>'post','class'=>'cmxform form-horizontal','id'=>'replyFrm'))}}
                        <div class="form-group">
                            <label class="control-label col-lg-1">Message:</label>
                            <div class="col-lg-6">
                                <textarea name="message" class="form-control col-lg-6" style="height:180px;resize:none;"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">Attachment (optional)</label>
                            <div class="controls col-md-2">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <span class="btn btn-white btn-file">
                                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Browse file</span>
                                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                <input type="file" class="default" name="attachment"/>
                                                </span>
                                    <span class="fileupload-preview" style="margin-left:5px;"></span>
                                    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-1"></label>
                            <div class="col-lg-3">
                                <input hidden name="discussion" value="{{{$message->id}}}"/>
                                <input hidden name="receiver" value="{{{$message->sender_id}}}"/>
                                <input hidden name="sender" value="{{{$user->user_id}}}"/>
                                <input hidden name="url" value="{{{Request::url()}}}"/>
                                <input type="submit" class="btn btn-primary" value="Reply"/>
                            </div>
                        </div>
                    {{Form::Close()}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@stop