<?php echo $freelancerList->links(); ?>
<div class="clearfix"></div>
<?php
    foreach ($freelancerList as $freelancer):
        $skills = explode(',',$freelancer->tags);

?>
    <?php if(!empty($freelancer->photos)){ ?>
        <div class="pi-img-w pi-img-round-corners pi-img-left pi-margin-top-5 pi-shadow-effect4" style="width:155px;">
            <?php
            if($freelancer->freelancer_type=="Individual" && file_exists($_SERVER['DOCUMENT_ROOT'].'/cdn/profile/freelancer/individual/'.$freelancer->photos)){
                ?>
                <img ng-switch-when="Individual" src="<?php echo CDN; ?>profile/freelancer/individual/<?php echo $freelancer->photos; ?>" alt="<?php echo $freelancer->fname.' '.$freelancer->lname; ?>"/>
            <?php }elseif($freelancer->freelancer_type=="Agency"  && file_exists($_SERVER['DOCUMENT_ROOT'].'/cdn/profile/freelancer/agency/'.$freelancer->photos)){?>
                <img ng-switch-when="Agency" src="<?php echo CDN; ?>profile/freelancer/agency/<?php echo $freelancer->photos; ?>" alt="<?php echo $freelancer->fname.' '.$freelancer->lname; ?>"/>
            <?php }else{ ?>
                <img src="<?php echo CDN; ?>profile/leader-1.png" ng-switch-default alt=""/>
            <?php } ?>
        </div>
    <?php }else{ ?>
        <div class="pi-img-w pi-img-round-corners pi-img-left pi-margin-top-5 pi-shadow-effect4" style="width:155px;">
            <img src="<?php echo CDN; ?>profile/male-female.jpg" alt="<?php echo $freelancer->fname.' '.$freelancer->lname; ?>"/>
        </div>
    <?php } ?>
    <h3 class="h4 pi-margin-bottom-5">
        <a target="_blank" href="<?php echo url('view/freelancer'); ?>/<?php echo Helpers::EncodeDecode($freelancer->fid); ?>" class="pi-link-no-style" style="float: left;">
            <?php echo $freelancer->fname.' '.$freelancer->lname; ?> |
        </a>
        <?php if($freelancer->available==1){ ?>
            <i class="avai" style="float: left;">
                <img width="15" height="15" alt="available" src="{{$theme}}img/available.png">
                Available |
            </i>
            <span class="select-box">
                Select&nbsp;
                <input id="select_freelancer<?php echo $start_index; ?>" style="margin: 7px 0 0" class="pull-right select-freelancer" type="checkbox" value="<?php echo $start_index++; ?>" />
            </span>
        <?php }else{ ?>
            <i class="avai" style="float: left;">
                <img width="15" height="15" alt="available" src="{{$theme}}img/no-available.png"> No Available |
            </i>
        <?php } ?>
    </h3>
    <br/><br/>
    <p class="pi-italic pi-text-base pi-margin-bottom-10">
        <?php if(!empty($freelancer->verified)){ ?>
            <img width="16" height="20" alt="0" src="{{$theme}}img/DJITVerified.png">
        <?php } ?>
        <?php echo $freelancer->profile_title; ?>
    </p>
    <p><?php echo $freelancer->overview; ?></p>
    <ul class="oInlineListExt">
        <?php if(!empty($freelancer->freelancer_price)){ ?>
        <li><strong>$<?php echo $freelancer->freelancer_price; ?></strong> HOURLY RATE</li>
        <?php } ?>
        <li>
            <?php
            $t=0;
            if(!empty($freelancer->feedbacks_ts) && !empty($freelancer->feedbacks_tc))
                $t= $freelancer->feedbacks_ts/$freelancer->feedbacks_tc;

            for($i=1; $i<=5; $i++){
                if($i <= $t)
                    echo '<span class="star"></span>';
                else
                    echo '<span class="star2"></span>';

            }
            echo "&nbsp;<b>".$t."</b>";
            ?>

        </li>
        <li><strong>0</strong> HOURS</li>
        <li><i class="icon-home"></i><strong> <?php echo $freelancer->address_country; ?> </strong></li>
        <li>
            <strong>
                <?php
                $test=0;

                foreach($skills as $skill){
                    $name = explode("=>",$skill);
                    if(count($name)==3){
                        if(!empty($name[1]) && $name[2]==1)
                            $test++;
                    }
                }
                echo $test;
                ?>
            </strong> TESTS
        </li>
        <li><strong><?php echo $freelancer->c_portfolios; ?></strong> PORTFOLIO ITEM</li>
        <li><strong><?php echo Helpers::dateTimeFormat('F d, Y',$freelancer->last_login); ?></strong> LAST ACTIVE</li>
    </ul>
    <ul class="cat-link clearFix" style="padding-left:0;">
    <?php
        foreach($skills as $skill){
            if(!empty($skill)){
                $name = explode("=>",$skill);
                if(!empty($name[0])){
    ?>
        <li><a class="" href="#"><?php echo $name[0]; ?></a></li>
    <?php
                }
            }
        }
    ?>
    </ul>


    <hr class="pi-divider pi-divider-dashed" style="float: left; width: 100%; clear: both;">
    <div class="clearfix"></div>
<?php endforeach; ?>
<?php echo $freelancerList->links(); ?>