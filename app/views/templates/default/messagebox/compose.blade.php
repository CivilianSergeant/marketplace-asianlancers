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
                <div ng-app="">
                    <div ng-cloak class="pi-row col-lg-12">




                        <div class="bs-docs-section">
                            <div style="padding-top:32px;" class="bs-example">
                                <a style="top:14px;" class="title ng-binding">Compose Message</a>
                                {{ Form::open(array('url'=>'message','method'=>'get')) }}
                                <span style="position:absolute;right:10px; font-size:12px; top:10px;"><button class="btn pi-btn-small pi-btn-green" type="submit">Inbox</button></span>
                                {{ Form::close() }}

                            </div>
                            <div style="padding:9px 10px;" class="highlight">

                                <div class="compose-box">

                                    {{Form::Open(array('id'=>'composeFrm','enctype'=>'multipart/form-data','class'=>'cmxform form-horizontal','method'=>'post','url'=>'message/save-message'))}}

                                    <div class="form-group pi-no-margin-bottom">
                                        <label class="control-label col-lg-3">To</label>
                                        <div class="col-lg-9">
                                            <select name="to" class="drop-sty2">
                                                <option value=""></option>

                                                @if(count($receivers))
                                                @foreach($receivers as $receiver)


                                                <?php

                                                if($user->user_type=="Admin"){
                                                    $listuser=null;
                                                    if($receiver->user_type=='Client')
                                                        $listuser = Client::find($receiver->user_id);
                                                    elseif($receiver->user_type=='Freelancer')
                                                        $listuser = Freelancer::find($receiver->user_id);
                                                    else
                                                        $listuser = Admin::find($receiver->user_id);
                                                    ?>


                                                    @if(count($listuser)>0)
                                                    <option value="{{$listuser->id}}" >{{$listuser->getName()}}</option>
                                                    @endif

                                                <?php } else{
                                                    $listuser = Admin::find($receiver->user_id);
                                                    ?>

                                                    <option value="{{$listuser->id}}" >{{$listuser->getName()}}</option>


                                                <?php } ?>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>

                                    </div>

                                    <div class="form-group pi-no-margin-bottom">
                                        <label class="control-label col-lg-3"></label>
                                        <div class="col-lg-9">
                                            <div id="userlist" class="compose-userlist">
                                                <ul></ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-3">Subject</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="subject"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-3">Message</label>
                                        <div class="col-lg-9">
                                            <textarea name="message" class="form-control col-lg-6" style="height:180px;resize:none;"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Attachment (optional)</label>
                                        <div class="controls col-md-9">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <span class="btn btn-white btn-file pi-no-padding-left">
                                           <!-- <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Browse file</span>
                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span> -->
                                            <input type="file" class="default" name="attachment"/>
                                            </span>
                                                <span class="fileupload-preview" style="margin-left:5px;"></span>
                                                <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-3"></label>
                                        <div class="col-lg-3">
                                            <input type="submit" class="btn pi-btn-green" value="Send"/>
                                        </div>
                                    </div>
                                    {{Form::Close()}}


                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="{{$theme}}js/custom/common/message.js"></script>
        @stop