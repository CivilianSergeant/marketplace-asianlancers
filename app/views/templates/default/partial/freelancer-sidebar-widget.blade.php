<?php
$widgetData = $freelancer->getWidgetData();

?>
<span class="snapshot">
    <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
        <tbody>
        <tr>
            <td>
                <span class="part1">{{Translate::get("Available",$lang)}}</span>
                        <span class="part2">
                        @if($freelancer->available)
                            <i  class="avai"><img src="{{$theme}}img/available.png" width="15" height="15" alt="available" > {{Translate::get("Available",$lang)}} </i>
                        @else
                            <i  class="avai"><img src="{{$theme}}img/no-available.png" width="15" height="15" alt="available" > {{Translate::get("Not Available",$lang)}} </i>
                        @endif
                        </span>
            </td>
        </tr>
        <tr>
            <td class="pi-active"><i>MY SNAPSHOT <br/><span>12 Months &brvbar; Lifetime</span></i>
                <img src="{{$theme}}img/DJITVerified.png" align="right" width="75" alt="0" />
                <!--<img src="img/not-verified.png" align="right" width="75" alt="0" />-->
            </td>
        </tr>
        <tr>
            <td>
                <span class="part1">{{Translate::get("Rank",$lang)}}</span>
                    <span class="part2">
                        <i class="rank-icon">1</i>
                    </span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="part1">{{Translate::get("Jobs",$lang)}}</span>
                    <span class="part2">
                    <b>{{$widgetData['total_job_completed']}}</b><i>{{Translate::get("Total",$lang)}}</i>
                    <b>{{$widgetData['milestone']}}</b><i>{{Translate::get("Milestones",$lang)}}</i>
                    <b>{{$widgetData['total_hours']}}</b><i>{{Translate::get("Hours",$lang)}}</i>
                    </span>
            </td>
        </tr>
        @if($freelancer->review_widget)
        <tr>
            <td>
                <span class="part1">{{Translate::get("Reviews",$lang)}}</span>
                    <span class="part2">
                    <b>{{$widgetData['avg_feedback']}}</b><i>
                            @for($i=1; $i<=5; $i++)
                            @if($i <= $widgetData['avg_feedback'])
                            <span class="star"></span>
                            @else
                            <span class="star2"></span>
                            @endif
                            @endfor
                        </i>
                    <!--<b>100%</b><i>{{Translate::get("Recommend",$lang)}}</i>-->
                    </span>
            </td>
        </tr>
        @endif
        <tr>
            <td>
                <span class="part1">{{Translate::get("Clients",$lang)}}</span>
                    <span class="part2">
                    <b>{{$widgetData['total_client']}}</b><i>{{Translate::get("Total",$lang)}}</i>
                   <!-- <b>34%</b><i>{{Translate::get("Repeat",$lang)}}</i>-->
                    </span>
            </td>
        </tr>
        @if($freelancer->earning_widget)
        <tr>
            <td>
                <span class="part1">{{Translate::get("Earnings",$lang)}}</span>
                    <span class="part2">
                    <b>${{$widgetData['total_earning']}}</b><i>{{Translate::get("Total",$lang)}}</i>
                    </span>
            </td>
        </tr>
        @endif
        </tbody>
    </table>
</span>