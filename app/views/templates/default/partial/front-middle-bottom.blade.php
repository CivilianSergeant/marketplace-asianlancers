<!-- Col 4 -->
@foreach($pages as $i=> $page)
<?php 
    if($i==0){$bg = '#49C0C0;';}elseif($i==1){$bg='#537A99;';}else{$bg='#915C96;';}
    
?>
<div class="pi-col-xs-6 pi-col-sm-4 pi-padding-bottom-20">

    <div class="pi-icon-box">

        <div class="pi-icon-box-icon pi-icon-box-icon-square pi-icon-box-icon-base" style="background:{{$bg}}">
            <i class="icon-cog"></i>
        </div>

        <div class="pi-icon-box-content-2">

            <h4><a href="#" class="pi-link-dark">{{$page->title}}</a></h4>

            <p class="pi-margin-bottom-10">
                {{$page->excerpt}}
            </p>

            <p>
                <a class="btn pi-btn pi-btn-small" href="{{url('view/page/'.$page->url)}}">{{Translate::get("More Info",$lang)}}</a>
            </p>

        </div>

    </div>

</div>
@endforeach
<!-- End col 4 -->

<!-- Col 4 -->
<!-- <div class="pi-col-xs-6 pi-col-sm-4 pi-padding-bottom-20">

    <div class="pi-icon-box">

        <div class="pi-icon-box-icon pi-icon-box-icon-square pi-icon-box-icon-base" style="background: #537A99;">
            <i class="icon-mobile"></i>
        </div>

        <div class="pi-icon-box-content-2">

            <h4><a href="#" class="pi-link-dark">Money-Back Guarantee</a></h4>

            <p class="pi-margin-bottom-10">
                Sed ut perspiciatis unde omnis iste natus error sit voluptatem
            </p>

            <p>
                <a class="btn pi-btn pi-btn-small" href="#">{{Translate::get("More Info",$lang)}}</a>
            </p>

        </div>

    </div>

</div> -->
<!-- End col 4 -->

<!-- Col 4 -->
<!-- <div class="pi-col-xs-6 pi-col-sm-4 pi-padding-bottom-20">

    <div class="pi-icon-box">

        <div class="pi-icon-box-icon pi-icon-box-icon-square pi-icon-box-icon-base" style="background: #915C96;">
            <i class="icon-search"></i>
        </div>

        <div class="pi-icon-box-content-2">

            <h4><a href="#" class="pi-link-dark">Enterprise Solution</a></h4>

            <p class="pi-margin-bottom-10">
                Sed ut perspiciatis unde omnis iste natus error sit voluptatem
            </p>

            <p>
                <a class="btn pi-btn pi-btn-small" href="#">{{Translate::get("More Info",$lang)}}</a>
            </p>

        </div>

    </div>

</div> -->
<!-- End col 4 -->