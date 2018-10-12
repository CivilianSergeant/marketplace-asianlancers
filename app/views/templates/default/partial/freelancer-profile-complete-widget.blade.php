<?php

$total = (!empty($freelancer->completed_percentage['total']))? $freelancer->completed_percentage['total'] : 1;  ?>
<span class="snapshot" style="padding-right:15px;">

    <div class="pi-counter pi-counter-round pi-counter-line" data-counter-type="line" data-count-from="0" data-count-to="{{$total}}" data-easing="easeInCirc" data-duration="2000" data-frames-per-second="10">

        <p class="pi-counter-label">Your Profile {{$total}}% Complete</p>

        <div class="pi-counter-count">
            <div class="pi-counter-progress pi-bar-one"></div>
        </div>
        @if(!empty($freelancer->completed_percentage['message']))
        <p>
            To update profile completion {{$freelancer->completed_percentage['message'][0]}}
        </p>
        @endif
    </div>

 </span>