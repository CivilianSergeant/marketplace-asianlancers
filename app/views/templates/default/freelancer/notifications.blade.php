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
                        <h3>Notifications</h3>
                        <table class="table table-stripped table-responsive">
                            <tr>
                                <th>Subject</th>
                                <th>Notification Type</th>
                                <th>Sender</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            <tbody>
                                @if(count($notificationList))
                                    @foreach($notificationList as $list)
                                        <?php
                                        $link = url('freelancer/'.$list->url.'/'.Helpers::EncodeDecode($list->id));
                                        ?>
                                        <tr>
                                            <td>{{$list->subject}}</td>
                                            <td>{{$list->notification_type}}</td>
                                            <?php
                                            $senderId = $list->sender_id;
                                            $senderType = $list->sender_type;
                                            $sender = null;
                                            if($senderType == 'Client')
                                            {
                                                $sender = Client::find($senderId);
                                            }
                                            elseif($senderType == 'Freelancer')
                                            {
                                                $sender = Freelancer::find($senderId);
                                            }
                                            else
                                            {
                                                $sender = Admin::find($senderId);
                                            }

                                            ?>
                                            <td>{{$sender->getName()}}</td>
                                            <td>{{{Helpers::dateTimeFormat('j F,Y',$list->created_at)}}}</td>
                                            <td><a class="btn pi-btn pi-btn-small" href="{{$link}}">View Details</a></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="5">{{$notificationList->links()}}</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop