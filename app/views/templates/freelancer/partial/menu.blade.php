@if($authenticateUserInfo->user_type == 'Freelancer')

    {{Theme::getMenu('freelancer','main')}}
    @if($authenticateUserInfo->is_agent)
        {{Theme::getMenu('agency','main')}}
    @endif
    <!--sidebar widget-->
    @if(Request::segment(2) == 'overview')
    <li>
        {{Theme::make('partial.freelancer-profile-complete-widget',array('freelancer'=>$freelancer))}}
    </li>
    <li>
        {{Theme::make('partial.freelancer-sidebar-widget',array('freelancer'=>$freelancer))}}
    </li>
    @endif
    <!--end sidebar widget-->

@elseif($authenticateUserInfo->user_type == 'Client')

    {{Theme::getMenu('client','main')}}

@elseif($authenticateUserInfo->user_type == 'Admin')

    {{Theme::getMenu('admin','main')}}

@endif