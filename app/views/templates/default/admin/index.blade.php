@extends('templates.default.default')


@section('content')

<!-- Breadcrumbs -->

<div ng-app="" class="pi-section-w pi-border-bottom pi-section-grey">
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="#">Overview</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- End breadcrumbs -->


<!-- - - - - - - - - - SECTION - - - - - - - - - -->

<div class="pi-section-w pi-section-white pi-slider-enabled piSocials"  ng-app="">
    <div class="pi-section pi-padding-bottom-30">
        {{Helpers::showMessage()}}
        <!-- Openings -->
        <div class="pi-tabs-vertical pi-responsive-sm">
            <ul class="pi-tabs-navigation pi-tabs-navigation-transparent profile-po" id="myTabs">
                {{Theme::make('partial.menu',array())}}
            </ul>
            <div class="pi-tabs-content pi-tabs-content-transparent">

                <!-- Tab content -->
                <div>
                    <div class="pi-row">

                        <!-- Col 6 -->
                        <div class="pi-col-xs-12">
                            <h3>Notifications</h3>
                            <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">

                                <!-- Table head -->
                                <thead>

                                <!-- Table row -->
                                <tr>
                                    <th style="width:200px;">
                                        Subject
                                    </th>
                                    <th>Notification Type</th>
                                    <th>Sender</th>

                                    <th>
                                        Posted date
                                    </th>

                                    <th style="width:150px;">Action</th>

                                </tr>
                                <!-- End table row -->

                                </thead>
                                <!-- End table head -->

                                <!-- Table body -->
                                <tbody>
                                    @if(count($all_notifications))
                                        @foreach($all_notifications as $notification)
                                            <?php
                                                $link = url($notification->url.'/'.Helpers::EncodeDecode($notification->id));
                                            ?>
                                            <tr>
                                                <td style="width:250px;">
                                                    @if($notification->read_status == 0)
                                                        <a class="btn pi-btn-green pi-btn-small" href="{{$link}}">New</a>
                                                    @endif

                                                    {{{$notification->subject}}}

                                                </td>
                                                <td>{{{$notification->notification_type}}}</td>
                                                <?php
                                                    $senderId = $notification->sender_id;
                                                    $senderType = $notification->sender_type;
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

                                                <td>
                                                    {{{Helpers::dateTimeFormat('j M,Y',$notification->created_at)}}}

                                                </td>

                                                <td style="width:150px;">

                                                    <a class="btn pi-btn pi-btn-small" href="{{$link}}">View Details</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                          </div>
                        <!-- End col 6 -->


                    </div>
                    <!-- End row -->
                </div>
                <!-- End tab content -->

            </div>
        </div>
        <!-- End tabs -->

    </div>
</div>

<!-- - - - - - - - - - END SECTION - - - - - - - - - -->

<!-- - - - - - - - - - SECTION - - - - - - - - - -->
<div class="pi-section-w pi-shadow-inside-top pi-section-base">
    <div class="pi-texture" style="background: url({{$theme}}img/hexagon.png) repeat;"></div>
    <div class="pi-section pi-padding-top-60 pi-padding-bottom-40 pi-text-center">

        <p class="lead-30">
            <span class="pi-text-white">Have a project with us? <span class="pi-weight-400">Feel free.</span></span>

            <a href="#" class="btn pi-btn-base-2 pi-btn-big" style="margin-left: 25px;">
                <i class="icon-mail pi-icon-left"></i> Get in Touch
            </a>

        </p>

    </div>
</div>
<!-- - - - - - - - - - END SECTION - - - - - - - - - --></div>

@stop