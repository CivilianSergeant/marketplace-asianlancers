@extends('templates.default.default')

@section('content')
<!-- Breadcrumbs -->
<div class="pi-section-w pi-border-bottom pi-section-grey">
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>

            </ul>
        </div>
        <div class="text-center">
            {{Helpers::showMessage()}}
        </div>
    </div>
</div>
<!-- End breadcrumbs -->
<div class="pi-section-w pi-section-white pi-slider-enabled piSocials">
    <div class="pi-section pi-padding-bottom-30" >

        <!-- Openings -->
        <div class="pi-tabs-vertical pi-responsive-sm">
            <ul class="pi-tabs-navigation pi-tabs-navigation-transparent profile-po" id="myTabs">
                {{Theme::make('partial.menu',array())}}
            </ul>

            <div class="pi-tabs-content pi-tabs-content-transparent" style="min-height: 1px;">
                <div class="pi-responsive-table-sm">
                    <table class="pi-table pi-table-complex pi-table-zebra pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
                        <thead>
                        <tr>
                            <th colspan="2"><h1>Job Offer</h1> {{$jobOffer->title}}</th>
                        </tr>
                        <tr>
                            <th width="60%"><strong>{{$freelancer->getName()}}</strong></th>
                            <th width="40%"><strong>{{$description}}</strong></th>
                        </tr>

                        </thead>
                        <tbody>
                        <tr>
                            <td class="pi-text-right"><strong>Total Payout :</strong></td>
                            <td id="total_amount"><strong>$ {{$amount}}</strong></td>
                        </tr>
                        </tbody>
                    </table>
                    <hr class="pi-divider-gap-20">

                </div>
            </div>
        </div>
    </div>
</div>
@stop