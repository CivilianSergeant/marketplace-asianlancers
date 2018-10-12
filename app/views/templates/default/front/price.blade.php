@extends('templates.default.default')

@section('content')

<script type="text/javascript">
    var job_prices = {{$job_prices}};
    var cat_id = '{{Request::segment(3)}}';
</script>
<script type="text/javascript" src="{{$theme}}js/custom/common/common.js"></script>
<script type="text/javascript" src="{{$theme}}js/custom/front/frontcontroller.js"></script>


<h1 class="lead-30 pi-text-dark pi-text-center" style="padding:2% 10%; text-transform:uppercase;" >FIND FREELANCERS BEST SUITED FOR YOUR PROJECT BY FOLLOWING PRICE TAG<br/>
    <p class="lead-20 pi-text-dark pi-text-center pi-padding-top-20" style="text-transform:none; margin:0;">
       Skilled Programmer, game designer, Apps developer and many more different amazing freelancers are here to serve you
    </p>
</h1>



<div class="pi-section-w pi-section-white piCaptions" style="padding:4% 7% 2%; background:url({{$theme}}img/noise.png) repeat; background-color: rgba(241, 245, 249, 1); text-align:center;">

<div ng-controller="frontPriceController" ng-app="frontHomeApp" class="pi-row pi-grid-small-margins" ng-cloak>
<input type="hidden" ng-model="cat_id"  />
<div class="pi-col-md-2 pi-col-xs-6">
    <table class="pi-pricing">
        <thead>
        <tr>
            <td class="pi-pricing-head-orange pi-text-center">

                <div class="pi-pricing-price">
                    <span class="pi-pricing-currency">$</span>
                    <span class="pi-pricing-amount" ng-value="@{{showValue(0)}}" >@{{showText(0)}}</span>
                </div>
            </td>
        </tr>
        </thead>
        <tbody>


        <tr>
            <td ng-switch="showAvailable(0)">
                <div ng-switch-when="0">
                    <strong>{{Translate::get("No",$lang)}}</strong> {{Translate::get("Developer",$lang)}} <span class="pi-text-bg-green pi-weight-700">{{Translate::get("Available",$lang)}}</span>
                </div>
                <div ng-switch-when="1">
                    <strong>@{{showAvailable(0)}}</strong> {{Translate::get("Developer",$lang)}} <span class="pi-text-bg-green pi-weight-700">{{Translate::get("Available",$lang)}}</span>
                </div>
                <div ng-switch-default>
                    <strong>@{{showAvailable(0)}}</strong> {{Translate::get("Developers",$lang)}} <span class="pi-text-bg-green pi-weight-700">{{Translate::get("Available",$lang)}}</span>
                </div>
            </td>
        </tr>


        <tr>
            <td class="pi-pricing-description">
                <p class="pi-smaller-text">
                    <strong>*</strong> Find $30/hrs Freelancers
                </p>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td>
                <p>
                    <a href="#" class="btn pi-btn-orange pi-btn-wide" ng-click="setValueLocal(0)">{{Translate::get("View all",$lang)}}</a>
                </p>
            </td>
        </tr>
        </tfoot>
    </table>
</div>

<div class="pi-col-md-2 pi-col-xs-6">
    <table class="pi-pricing">
        <thead>
        <tr>
            <td class="pi-pricing-head-purple pi-text-center">
                <div class="pi-pricing-price">
                    <span class="pi-pricing-currency">$</span>
                    <span class="pi-pricing-amount" ng-value="@{{showValue(1)}}" >@{{showText(1)}}</span>
                </div>

            </td>
        </tr>
        </thead>
        <tbody>


        <tr>
            <td ng-switch="showAvailable(1)">
                <div ng-switch-when="0">
                    <strong>{{Translate::get("No",$lang)}}</strong> {{Translate::get("Developer",$lang)}} <span class="pi-text-bg-green pi-weight-700">{{Translate::get("Available",$lang)}}</span>
                </div>
                <div ng-switch-when="1">
                    <strong>@{{showAvailable(1)}}</strong> {{Translate::get("Developer",$lang)}} <span class="pi-text-bg-green pi-weight-700">{{Translate::get("Available",$lang)}}</span>
                </div>
                <div ng-switch-default>
                    <strong>@{{showAvailable(1)}}</strong> {{Translate::get("Developers",$lang)}} <span class="pi-text-bg-green pi-weight-700">{{Translate::get("Available",$lang)}}</span>
                </div>
            </td>
        </tr>


        <tr>
            <td class="pi-pricing-description">
                <p class="pi-smaller-text">
                    <strong>*</strong> Find $25/hrs Freelancers
                </p>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td>
                <p>
                    <a href="#" class="btn pi-btn-purple pi-btn-wide" ng-click="setValueLocal(1)">{{Translate::get("View all",$lang)}}</a>
                </p>
            </td>
        </tr>
        </tfoot>
    </table>
</div>

<div class="pi-col-md-2 pi-col-xs-6">
    <table class="pi-pricing">
        <thead>
        <tr>
            <td class="pi-pricing-head-blue pi-text-center">
                <div class="pi-pricing-price">
                    <span class="pi-pricing-currency">$</span>
                    <span class="pi-pricing-amount" ng-value="@{{showValue(2)}}" >@{{showText(2)}}</span>
                </div>
            </td>
        </tr>
        </thead>
        <tbody>


        <tr>
            <td ng-switch="showAvailable(2)">
                <div ng-switch-when="0">
                    <strong>No</strong> Developer <span class="pi-text-bg-green pi-weight-700">Available</span>
                </div>
                <div ng-switch-when="1">
                    <strong>@{{showAvailable(2)}}</strong> Developer <span class="pi-text-bg-green pi-weight-700">Available</span>
                </div>
                <div ng-switch-default>
                    <strong>@{{showAvailable(2)}}</strong> Developers <span class="pi-text-bg-green pi-weight-700">Available</span>
                </div>
            </td>
        </tr>


        <tr>
            <td class="pi-pricing-description">
                <p class="pi-smaller-text">
                    <strong>*</strong> Find $20/hrs Freelancers
                </p>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td>
                <p>
                    <a href="#" class="btn pi-btn-blue pi-btn-wide" ng-click="setValueLocal(2)">View All</a>
                </p>
            </td>
        </tr>
        </tfoot>
    </table>
</div>

<div class="pi-col-md-2 pi-col-xs-6">
    <table class="pi-pricing">
        <thead>
        <tr>
            <td class="pi-pricing-head-turquoise pi-text-center">
                <div class="pi-pricing-price">
                    <span class="pi-pricing-currency">$</span>
                    <span class="pi-pricing-amount" ng-value="@{{showValue(3)}}">@{{showText(3)}}</span>
                </div>

            </td>
        </tr>
        </thead>
        <tbody>


        <tr>
            <td ng-switch="showAvailable(3)">
                <div ng-switch-when="0">
                    <strong>No</strong> Developer <span class="pi-text-bg-green pi-weight-700">Available</span>
                </div>
                <div ng-switch-when="1">
                    <strong>@{{showAvailable(3)}}</strong> Developer <span class="pi-text-bg-green pi-weight-700">Available</span>
                </div>
                <div ng-switch-default>
                    <strong>@{{showAvailable(3)}}</strong> Developers <span class="pi-text-bg-green pi-weight-700">Available</span>
                </div>
            </td>
        </tr>


        <tr>
            <td class="pi-pricing-description">
                <p class="pi-smaller-text">
                    <strong>*</strong> Find $15/hrs Freelancers
                </p>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td>
                <p>
                    <a href="#" class="btn pi-btn-turquoise pi-btn-wide" ng-click="setValueLocal(3)">View All</a>
                </p>
            </td>
        </tr>
        </tfoot>
    </table>
</div>

<div class="pi-col-md-2 pi-col-xs-6">
    <table class="pi-pricing">
        <thead>
        <tr>
            <td class="pi-pricing-head-green pi-text-center">
                <div class="pi-pricing-price">
                    <span class="pi-pricing-currency">$</span>
                    <span class="pi-pricing-amount" ng-value="@{{showValue(4)}}" ng-click="setValueLocal(4)">@{{showText(4)}}</span>
                </div>

            </td>
        </tr>
        </thead>
        <tbody>


        <tr>
            <td ng-switch="showAvailable(4)">
                <div ng-switch-when="0">
                    <strong>No</strong> Developer <span class="pi-text-bg-green pi-weight-700">Available</span>
                </div>
                <div ng-switch-when="1">
                    <strong>@{{showAvailable(4)}}</strong> Developer <span class="pi-text-bg-green pi-weight-700">Available</span>
                </div>
                <div ng-switch-default>
                    <strong>@{{showAvailable(4)}}</strong> Developers <span class="pi-text-bg-green pi-weight-700">Available</span>
                </div>
            </td>
        </tr>


        <tr>
            <td class="pi-pricing-description">
                <p class="pi-smaller-text">
                    <strong>*</strong> Find $10/hrs Freelancers
                </p>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td>
                <p>
                    <a href="#" class="btn pi-btn-green pi-btn-wide" ng-click="setValueLocal(4)">View All</a>
                </p>
            </td>
        </tr>
        </tfoot>
    </table>
</div>


<div class="pi-col-md-2 pi-col-xs-6">
    <table class="pi-pricing">
        <thead>
        <tr>
            <td class="pi-pricing-head-red pi-text-center">
                <div class="pi-pricing-price">
                    <span class="pi-pricing-currency">$</span>
                    <span class="pi-pricing-amount" ng-value="@{{showValue(5)}}">@{{showText(5)}}</span>
                </div>
            </td>
        </tr>
        </thead>
        <tbody>


        <tr>
            <td ng-switch="showAvailable(5)">
                <div ng-switch-when="0">
                    <strong>No</strong> Developer <span class="pi-text-bg-green pi-weight-700">Available</span>
                </div>
                <div ng-switch-when="1">
                    <strong>@{{showAvailable(5)}}</strong> Developer <span class="pi-text-bg-green pi-weight-700">Available</span>
                </div>
                <div ng-switch-default>
                    <strong>@{{showAvailable(5)}}</strong> Developers <span class="pi-text-bg-green pi-weight-700">Available</span>
                </div>
            </td>
        </tr>


        <tr>
            <td class="pi-pricing-description">
                <p class="pi-smaller-text">
                    <strong>*</strong> Find $5/hrs Freelancers
                </p>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td>
                <p>
                    <a href="#" class="btn pi-btn-red pi-btn-wide" ng-click="setValueLocal(5)">View All</a>
                </p>
            </td>
        </tr>
        </tfoot>
    </table>
</div>
</div>


</div>

<div class="pi-section-w pi-section-white">
    <div class="pi-section pi-padding-bottom-10">

        <!-- Row -->
        <div class="pi-row">


          

        </div>
        <!-- End row -->

    </div>
</div>

@stop