@extends('templates.freelancer.freelancer')

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
        {{Helpers::showMessage()}}
        <!-- Openings -->
        <div class="pi-tabs-vertical pi-responsive-sm">
            <ul class="pi-tabs-navigation pi-tabs-navigation-transparent profile-po" id="myTabs">
                {{Theme::make('partial.menu',array())}}
            </ul>
            <div class="pi-tabs-content pi-tabs-content-transparent">

                <!-- Tab content -->
                <div ng-app="">

                    <div class="bs-docs-section">
                        <div class="bs-example" style="padding-top:32px;">
                            <a class="title ng-binding" style="top:14px;">Inbox</a>
                            {{ Form::open(array('url'=>'message/sent-items','method'=>'get')) }}
                            <span style="position:absolute;right:10px; font-size:12px; top:10px;"><button class="btn pi-btn-small pi-btn-green" type="submit">Sent Items</button></span>
                            {{ Form::close() }}
                            {{ Form::open(array('url'=>'message/compose','method'=>'get')) }}
                            <span style="position:absolute;right:100px; font-size:12px; top:10px;"><button class="btn pi-btn-small pi-btn-red" type="submit">Compose</button></span>
                            {{ Form::close() }}
                        </div>
                        <div class="highlight" style="padding:9px 10px;">
                            {{Form::Open(array('id'=>'bulkOpFrm'))}}
                            <table class="table table-bordered table-striped pi-no-margin-bottom" style="background:#fff;">
                                <thead>
                                <tr>
                                    <th colspan="4" class="pi-text-right">


                                        <select name="bulk_action" class="form-control-select2 drop-sty">
                                            <option value="">Select operation</option>
                                            <option value="Delete">Delete</option>
                                        </select>
                                        <input type="button" id="bulkDeleteBtn" class="btn btn-primary pi-btn-small" value="Submit"/>

                                    </th>
                                </tr>
                                <tr>
                                    <th><input type="checkbox" name="selectAll"/></th>
                                    <th>From</th>

                                    <th>Subject</th>
                                    <th>Date</th>


                                </tr>
                                </thead>
                                <tbody>
                                @if(count(@commentall))
                                @foreach($commentall as $message)
                                <tr>
                                    <td><input class="message_id" type="checkbox" name="message_id[]"
                                               value="{{{$message->comment_id}}}"/></td>
                                    <?php
                                    $sender = null;
                                    if($message->sender_type == 'Freelancer')
                                        $sender = Freelancer::find($message->sender_id);
                                    elseif($message->sender_type == 'Client')
                                        $sender = Client::find($message->sender_id);
                                    else
                                        $sender = Admin::find($message->sender_id);
                                    ?>
                                    <td>{{$sender->getName()}}
                                        @if($message->read_status == 0)
                                        <span class="btn pi-btn-green pi-btn-small">New</span>
                                        @endif</td>
                                    </td>
                                    <td>
                                        <a href="{{url('message/details/'.$message->discussion_id.'/'.$message->id)}}">{{$message->message}}</a>
                                    </td>
                                    <td>{{Helpers::dateTimeFormat('j F , Y',$message->created_at)}}</td>

                                </tr>
                                @endforeach
                                @endif
                                </tbody>
                            </table>
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