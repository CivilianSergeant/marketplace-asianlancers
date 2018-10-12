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
                    <div class="bs-docs-section">
                        <div class="bs-example" style="padding-top:32px;">
                            <a class="title ng-binding" style="top:14px;">Sent Items</a>
                            {{ Form::open(array('url'=>'message','method'=>'get')) }}
                            <span style="position:absolute;right:10px; font-size:12px; top:10px;"><button class="btn pi-btn-small pi-btn-green" type="submit">Inbox</button></span>
                            {{ Form::close() }}
                            {{ Form::open(array('url'=>'message/compose','method'=>'get')) }}
                            <span style="position:absolute;right:68px; font-size:12px; top:10px;"><button class="btn pi-btn-small pi-btn-red" type="submit">Compose</button></span>
                            {{ Form::close() }}
                        </div>
                        <div class="highlight" style="padding:9px 10px;">
                            {{Form::Open(array('id'=>'bulkOpFrm'))}}

                            <table class="table table-bordered table-striped pi-no-margin-bottom" style="background:#fff;">
                                <thead>
                                <tr>
                                    <th colspan="5" class="pi-text-right">


                                        <select name="bulk_action" class="form-control-select2 drop-sty">
                                            <option value="">Select operation</option>
                                            <option value="Delete">Delete</option>
                                        </select>
                                        <input type="button" id="bulkDeleteBtn" class="btn btn-primary pi-btn-small" value="Submit"/>


                                    </th>
                                </tr>
                                <tr>
                                    <th>Sl.</th>
                                    <th>To</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Attachement</th>

                                </tr>
                                </thead>
                                <tbody>
                                @if(count(@sentitems))
                                @foreach($sentitems as $message)
                                <tr>
                                    <td><input class="message_id" type="checkbox" name="message_id[]" value="{{{$message->id}}}"/></td>
                                    <td>{{implode(",",$message->Users($message->receivers))}}</td>
                                    <td><a href="{{url('message/details/'.$message->id)}}">{{$message->subject}}</a></td>
                                    <td>{{Helpers::dateTimeFormat('j F , Y',$message->created_at)}}</td>
                                    <td>
                                        @if($message->attachment != '')
                                        <a target="_blank" href="{{{url('message/download-attachment/'.urlencode($message->attachment))}}}"><i class="fa fa-paperclip"></i> {{{$message->attachment}}}</a>
                                        @endif
                                    </td>

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
    <script type="text/javascript" src="{{$theme}}js/custom/common/message.js"></script>
    @stop