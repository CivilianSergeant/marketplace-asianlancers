@extends('templates.default.default')

@section('content')
<!-- Breadcrumbs -->
<script type="text/javascript">
    var jobOffer = {{$jobOffer}};
    var phaseInfo = {{$phaseInfo}};
</script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#bonus_amount').keyup(function(e){
            var hour = phaseInfo.phase_hour;
            var price = jobOffer.freelancer.freelancer_price;
            var bonus = $(this).val();
            var total_amount = hour*price + +bonus;
            $('#total_amount').find('strong').text('$'+total_amount);
            $('#bonus').val(bonus);
        });
    });
</script>
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
                <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25 pi-has-bg">Job Offer : {{$jobOffer->title}}</h3>
                <div class="pi-section-w pi-shadow-inside-top pi-section-grey pi-margin-bottom-25">
                    <div style="background: url({{$theme}}img/hexagon.png) repeat;" class="pi-texture"></div>
                    <div style="padding:15px 20px;" class="pi-section pi-section-md pi-titlebar pi-titlebar-breadcrumb-top pi-titlebar-small">
                        <div class="pi-breadcrumb pi-no-margin-bottom">
                            <ul style="margin:0px;padding-left:0;" class="oInlineListExt">
                                <li class="pi-col-md-6 pi-no-padding">
                                    <strong>Freelancer :</strong>
                                    <b><a href="{{url('view/freelancer/'.Helpers::EncodeDecode($jobOffer->Freelancer->id))}}">{{$jobOffer->Freelancer->first_name}} {{$jobOffer->Freelancer->last_name}}</a></b>
                                </li>
                                <li class="pi-text-right pi-col-md-6 pi-no-padding pi-no-margin-right"><strong>Total Hours :</strong> <b>{{$jobOffer->job_offer_hour}} hours</b></li><br>
                                <hr class="pi-divider-gap-20">
                                <li><strong>Milestone / Phase :</strong> <b>{{$phaseInfo->phase_title}}</b></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="pi-responsive-table-sm">
                    <table class="pi-table pi-table-complex pi-table-zebra pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
                        <thead>
                        <tr>
                            <th width="60%"><strong>Freelancer</strong></th>
                            <th width="40%"><strong>Summary</strong></th>
                        </tr>

                        </thead>
                        <tbody>

                        <tr>
                            <td class="pi-text-right">Hourly rate</td>
                            <td> $ {{$jobOffer->Freelancer->freelancer_price}}</td>
                        </tr>

                        <tr>
                            <td class="pi-text-right">Hour Worked</td>
                            <td>{{$phaseInfo->phase_hour}} hr</td>
                        </tr>

                        <tr>
                            <td class="pi-text-right">Bonus</td>
                            <td><input type="text" placeholder="$" style="width:40%;" class="form-control input-sm" id="bonus_amount" name="bonus_amount"></td>
                        </tr>

                        <tr>
                            <td class="pi-text-right"><strong>Total Payout :</strong></td>
                            <td id="total_amount"><strong>$ {{$jobOffer->Freelancer->freelancer_price*$phaseInfo->phase_hour}}</strong></td>
                        </tr>

                        </tbody>
                    </table>
                    <hr class="pi-divider-gap-20">
                    @if(count($phaseInfo)>0 && $phaseInfo->phase_payment_status=='Waiting')
                    <div class="pi-col-md-12 pull-right pi-text-right pi-no-padding">
                        <form action="{{url('payment/approve')}}" method="post">

                                <input type="hidden" id="bonus" name="bonus" value=""/>
                                <input type="hidden" name="hour" value="{{$phaseInfo->phase_hour}}"/>
                                <input type="hidden" name="price" value="{{$phaseInfo->phase_price}}"/>
                                <input type="hidden" name="jpid" value="{{Helpers::EncodeDecode($phaseInfo->id)}}"/>
                                <input type="hidden" name="joid" value="{{Helpers::EncodeDecode($phaseInfo->job_offer_id)}}"/>
                                <input type="hidden" name="fid" value="{{Helpers::EncodeDecode($jobOffer->freelancer_id)}}"/>
                                <div class="pi-col-md-2 pull-right pi-text-right pi-no-padding">
                                    <input type="submit" class="btn pi-btn-green" value="Approve"/>
                                </div>

                        </form>
                        <form action="{{url('client/update-payment-request')}}" method="post">
                                <input type="hidden" name="jpid" value="{{$phaseInfo->id}}"/>
                                <input type="hidden" name="request_status" value="Hold"/>
                                <input type="hidden" name="joid" value="{{Helpers::EncodeDecode($phaseInfo->job_offer_id)}}"/>

                                <div class="pi-col-md-2 pull-right pi-text-right pi-no-padding">
                                    <input type="submit" class="btn pi-btn-red" value="Hold"/>
                                </div>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@stop