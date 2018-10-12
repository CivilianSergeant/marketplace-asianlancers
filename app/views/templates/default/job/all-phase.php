<?php
$count=0;
foreach($jobOfferAllPhase as $jobOffer){
    foreach($jobOffer->JobPhase as $jobPhase){

?>
<div class="pi-col-xs-12">
    <div>
        <p class="pi-col-xs-3 pi-no-padding"><span class="glyphicon glyphicon-calendar"></span> <?php echo Helpers::dateTimeFormat('j M,Y',$jobPhase->phase_start); ?></p>
        <p class="pi-col-xs-3 pi-no-padding"><span class="glyphicon glyphicon-calendar"></span> <?php echo Helpers::dateTimeFormat('j M,Y',$jobPhase->phase_deadline); ?></p>
        <p class="pi-col-xs-2 pi-no-padding"><span class="glyphicon glyphicon-ok"></span> <?php echo $jobPhase->phase_payment_status; ?></p>
        <p class="pi-col-xs-2 pi-no-padding"><span class="glyphicon glyphicon-dashboard"></span> <?php echo $jobPhase->phase_hour; ?></p>
        <p class="pi-col-xs-2 pi-no-padding"><span class="glyphicon glyphicon-usd"></span> <?php echo $jobPhase->phase_price; ?></p>
    </div>
</div>
<div class="clearfix"></div>
<div class="pi-col-xs-12 pi-no-margin-top">
    <a><?php echo $jobPhase->phase_title; ?></a>
    <p><?php echo $jobPhase->phase_details; ?></p>
</div>
<?php
        $count++;
    }
}
if($count==0){
?>
    <div class="pi-col-xs-12">
        <div>
            There are no phase.
        </div>
    </div>
<?php
}
?>