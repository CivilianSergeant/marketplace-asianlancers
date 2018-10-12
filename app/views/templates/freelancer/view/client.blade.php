@extends('templates.freelancer.freelancer')

@section('content')
<!-- - - - - - - - - - SECTION - - - - - - - - - -->

<div class="pi-section-w pi-section-parallax piCounter piTabs piTooltips" style="background:url(img/hexagon-2.png) repeat;">
    <div class="pi-texture" style="background:rgba(108, 188, 3, 0.75);"></div>
    <div class="pi-section pi-padding-top-30 pi-padding-bottom-20 pi-text-center">
        <h2 class="pi-text-shadow pi-has-border pi-has-tall-border pi-has-base-border pi-has-short-border" style="font-size:50px;">
            <span style="color:#21252b;">{{$client_info->first_name}}</span> {{$client_info->last_name}}
        </h2>

        <p class="lead-18 pi-weight-300 pi-margin-bottom-25 pi-p-half" style="color:#000;">
            {{$client_info->profile_title}}
        </p>

    </div>
</div>

<!-- - - - - - - - - - END SECTION - - - - - - - - - -->
<!-- - - - - - - - - - SECTION - - - - - - - - - -->

<!-- Breadcrumbs -->
<div class="pi-section-w pi-border-bottom pi-section-grey">
    <div class="pi-section pi-titlebar pi-breadcrumb-only">
        <div class="pi-breadcrumb">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="#">View</a></li>
                <li>Client Profile</li>
            </ul>
        </div>
    </div>
</div>
<!-- End breadcrumbs -->

<!-- - - - - - - - - - END SECTION - - - - - - - - - -->
<!-- - - - - - - - - - SECTION - - - - - - - - - -->

<div class="pi-section-w pi-section-white pi-slider-enabled piSocials">
<div class="pi-section pi-padding-bottom-30">

<!-- Openings -->
<div class="pi-tabs-vertical pi-responsive-sm">
<ul class="pi-tabs-navigation pi-tabs-navigation-transparent profile-po" id="myTabs">
    <!--		<li class="pi-active"><a href="#overview">Overview</a></li>
                    <li><a href="#jobhistory">My Job posts</a></li>
                    <li><a href="#finance">Finance</a></li>-->
    <li>
      <span class="snapshot pi-no-margin">
        <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
            <tbody>
            <tr><td class="pi-active"><i class="pi-no-margin-top">About the Client<br>
                        <!--<span class="star"></span>
                        <span class="star"></span>
                        <span class="star"></span>
                        <span class="star"></span>
                        <span class="star"></span>-->
                        <br><span>{{$client_info->country}} (UTC+05)</span><br><span>Member Since {{date('M d Y',strtotime($client_info->created_at))}}</span>

                    </i>
                </td></tr>
            <tr>
                <td>
                    <span class="part11">Total Spent</span>
                    <span class="part22">${{$total_amount}}</span></td>
            </tr>

            <tr>
                <td>
                    <span class="part11">Hours Billed</span>
                    <span class="part22">0 hr</span></td>
            </tr>			
            <tr>
                <td>
                    <span class="part11">Hires</span>
                    <span class="part22">0</span></td>
            </tr>
            <tr>
                <td>
                    <span class="part11">Jobs Posted</span>
                    <span class="part22">{{$total_job}}</span></td>
            </tr>
            <tr>
				<td>
					<span class="part11">Jobs Progress</span>
					<span class="part22">{{$total_progress_job}}</span>
				</td>
			</tr>
			<tr>
				<td>
					<span class="part11">Jobs Completed</span>
					<span class="part22">{{$total_completed_job}}</span>
				</td>
            </tr>
            </tbody>
        </table>

                </span>
    </li>
</ul>
<div class="pi-tabs-content pi-tabs-content-transparent">

<!-- Tab content -->
<div class="pi-tab-pane pi-active" id="overview">
    <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25 pi-has-bg">Overview</h3>

    <div class="pi-img-w pi-img-round-corners profile-img pi-img-shadow pi-img-left pi-margin-top-5" style="width:150px; overflow:hidden;">
        @if($client_info->photos)
            <img alt="" src="{{$destination_path}}/{{$client_info->photos}}">
        @else
            <img alt="" src="{{$theme}}img_external/team/leader-6.png">
        @endif
        <!--<span class="cam">Change Picture</span>-->
    </div>    
    <p>{{$client_info->description}}</p>
    <ul class="oInlineListExt" style="margin:0px;">
        <li><i class="icon-home"></i><strong> {{$client_info->country}}</strong></li>
        <li><strong>${{$total_amount}}</strong> TOTAL SPENT</li>
        <!--<li><span class="star"></span>
            <span class="star"></span>
            <span class="star"></span>
            <span class="star"></span>
            <span class="star"></span>
            <b>5.0</b>
        </li>-->
        <li><strong>0</strong> HOURS</li>
        <li><strong>{{$total_job}}</strong>  JOBS POSTED</li>
    </ul>
    <!--<ul class="cat-link clearFix">
        <li><a href="#" class="">Web Design</a></li>
        <li><a href="#" class="">HTML5</a></li>
        <li><a href="#" class="">CSS3</a></li>
        <li><a href="#" class="">Web Design</a></li>
        <li><a href="#" class="">HTML5</a></li>
        <li><a href="#" class="">CSS3</a></li>
        <li><a href="#" class="">Web Design</a></li>
        <li><a href="#" class="">HTML5</a></li>
        <li><a href="#" class="">CSS3</a></li>
    </ul>-->
    <div style="clear:both;"></div>

    <hr class="pi-divider-gap-50">

    <div class="pi-row">
        <div class="pi-col-sm-12 pi-padding-bottom-20">
            <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-20 pi-has-bg">Contact Information : </h3>
            <div class="pi-responsive-table-sm">
                <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
                    <tbody>

                    <tr>
                        <td>Country</td>
                        <td>{{$client_info->country}}</td>
                    </tr>

                    <tr>
                        <td>Address</td>
                        <td>{{$client_info->address}}</td>
                    </tr>

                    <tr>
                        <td>Address 2</td>
                        <td>{{$client_info->address2}}</td>
                    </tr>

                    <tr>
                        <td>City</td>
                        <td>{{$client_info->city}}</td>
                    </tr>

                    <tr>
                        <td>State/Province</td>
                        <td>{{$client_info->province}}</td>
                    </tr>

                    <tr>
                        <td>Zip/Postal Code</td>
                        <td>{{$client_info->postal_code}}</td>
                    </tr>


                    </tbody>
                    <!-- End table body -->

                </table>
            </div>
        </div>



    </div>



</div>
<!-- End tab content -->

<!-- Tab content -->
<div class="pi-tab-pane" id="finance">

    <div class="pi-row">
        <div class="pi-col-sm-12">
            <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25 pi-has-bg">
                Finance
            </h3>

            <p>
                <span class="pi-dropcap">R</span>eritatis et quasi architecto beatae explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur perspiciatis unde omnis voluptatem quia voluptas sit aspernatur iste quasi architecto beatae explicabo natus error sit voluptatem accusantium.
            </p>
        </div>

    </div>


</div>
<!-- End tab content -->

<!-- Tab content -->
<div class="pi-tab-pane" id="jobhistory">

    <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-20 pi-has-bg">
        Job History & Feedback
    </h3>

    <p>
        <span class="pi-dropcap">K</span>ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur perspiciatis unde omnis iste natus error sit voluptatem accusantium.
    </p>

    <div class="pi-responsive-table-sm">
        <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">

            <!-- Table head -->
            <thead>

            <!-- Table row -->
            <tr>
                <th style="width:200px;">
                    Projects Name
                </th>
                <th>
                    Clients Say
                </th>
                <th style="width:150px;">Rating</th>

            </tr>
            <!-- End table row -->

            </thead>
            <!-- End table head -->

            <!-- Table body -->
            <tbody>

            <!-- Table row -->
            <tr>

                <td>Professional CV Writer <i class="pr-date">Jul 2014 – Jul 2014</i></td>

                <td>
                    Phoebe did an amazing job. I would definitely recommend her and do business with her again.
                </td>
                <td align="center"><b class="ret">4.65</b> <br/>
                    <span class="star"></span>
                    <span class="star"></span>
                    <span class="star"></span>
                    <span class="star"></span>
                    <span class="star"></span>
                </td>

            </tr>

            <tr>

                <td>Professional CV Writer <i class="pr-date">Jul 2014 – Jul 2014</i></td>

                <td>
                    Phoebe did an amazing job. I would definitely recommend her and do business with her again.
                </td>
                <td align="center"><b class="ret">4.65</b> <br/>
                    <span class="star"></span>
                    <span class="star"></span>
                    <span class="star"></span>
                    <span class="star"></span>
                    <span class="star"></span>
                </td>

            </tr>

            <tr>

                <td>Professional CV Writer <i class="pr-date">Jul 2014 – Jul 2014</i></td>

                <td>
                    Phoebe did an amazing job. I would definitely recommend her and do business with her again.
                </td>
                <td align="center"><b class="ret">4.65</b> <br/>
                    <span class="star"></span>
                    <span class="star"></span>
                    <span class="star"></span>
                    <span class="star"></span>
                    <span class="star"></span>
                </td>

            </tr>

            <tr>

                <td>Professional CV Writer <i class="pr-date">Jul 2014 – Jul 2014</i></td>

                <td>
                    Phoebe did an amazing job. I would definitely recommend her and do business with her again.
                </td>
                <td align="center"><b class="ret">4.65</b> <br/>
                    <span class="star"></span>
                    <span class="star"></span>
                    <span class="star"></span>
                    <span class="star"></span>
                    <span class="star"></span>
                </td>

            </tr>

            <tr>

                <td>Professional CV Writer <i class="pr-date">Jul 2014 – Jul 2014</i></td>

                <td>
                    Phoebe did an amazing job. I would definitely recommend her and do business with her again.
                </td>
                <td align="center"><b class="ret">4.65</b> <br/>
                    <span class="star"></span>
                    <span class="star"></span>
                    <span class="star"></span>
                    <span class="star"></span>
                    <span class="star"></span>
                </td>

            </tr>


            </tbody>
            <!-- End table body -->

        </table>
    </div>
    <hr class="pi-divider-gap-20">


</div>

</div>
</div>
<!-- End tabs -->

</div>
</div>

<!-- - - - - - - - - - END SECTION - - - - - - - - - -->
@stop