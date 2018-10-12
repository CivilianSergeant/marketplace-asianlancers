@extends('templates.default.default')


@section('content')
<script type="text/javascript">
    var client_info = {{$client_info}};
    var countries = {{$countries}};
    var destination_path = "{{$destination_path}}";
    var token = "<?php echo Form::tokenCode(); ?>";

</script>
<script type="text/javascript" src="{{$theme}}js/custom/client/clientcontroller.js"></script>
<div ng-app="clientApp" ng-controller="clientController" ng-init="init()">

    <!-- Breadcrumbs -->

    <div class="pi-section-w pi-border-bottom pi-section-grey">
        <div class="pi-section pi-titlebar pi-breadcrumb-only">
            <div class="pi-breadcrumb">
                <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li><a href="#">Overview</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End breadcrumbs -->


    <!-- - - - - - - - - - SECTION - - - - - - - - - -->

    <div class="pi-section-w pi-section-white pi-slider-enabled piSocials">
        <div class="pi-section pi-padding-bottom-30">

            <!-- Openings -->
            <div class="pi-tabs-vertical pi-responsive-sm">
                {{Helpers::showMessage()}}
                <ul class="pi-tabs-navigation pi-tabs-navigation-transparent profile-po" id="myTabs">
                    {{Theme::make('partial.menu',array())}}
                </ul>
                <div class="pi-tabs-content pi-tabs-content-transparent" style="min-height: 583px;">

                <!-- Tab content -->
                <div id="overview" class="pi-tab-pane pi-active" ng-cloak>
                    <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25 pi-has-bg">
                        {{Translate::get("Overview",$lang)}}
                        <span class="btn-group pull-right" >
                            <a ng-click="showClientPersonalForm(1)" class="btn pi-btn-small pi-btn-base dropdown-toggle" href="">
                                <i class="icon-pencil"></i>
                            </a>
                        </span>
                    </h3>

                    <div ng-show="editClientDetailFlag" >
                        <form id="clientDetailFrm" ng-submit="updateClientDetail()">
                            <div ng-model="errorMsg" ng-if="errorMsg" class="pi-alert-danger">
                                <p>
                                    <strong><a id="topEdu">Warning!</a></strong>
                                    <ul><li ng-repeat="em in errorMsg">@{{em[0]}}</li></ul>
                                </p>
                            </div>
                            <div class="pi-col-sm-12 pi-no-padding">
                                <div class="form-group">
                                    <label for="first_name">{{Translate::get("First name",$lang)}}:</label>
                                    <input type="text" class="form-control" required ng-model="detail.first_name"/>
                                </div>
                                <div class="form-group">
                                    <label for="last_name">{{Translate::get("Last name",$lang)}}:</label>
                                    <input type="text" class="form-control small_text" required ng-model="detail.last_name"/>
                                </div>
                                <div class="form-group">
                                    <label for="profile_title">{{Translate::get("Profile Title",$lang)}}:</label>
                                    <input type="text" class="form-control small_text" required ng-model="detail.profile_title"/>
                                </div>
                                <div class="form-group">
                                    <label for="description">{{Translate::get("Description",$lang)}}:</label>
                                    <textarea class="form-control small_text" maxlength="350" ng-model="detail.description"></textarea>
                                </div>
                                <div class="form-group pull-right">
                                    <input type="submit" class="btn  pi-btn-small pi-btn-green" value="{{Translate::get('Update',$lang)}}"/>
                                    <input type="button" class="btn  pi-btn-small pi-btn-orange" ng-click="editClientDetailFlag=0" value="{{Translate::get('Cancel',$lang)}}"/>
                                </div>
                            </div>
                            <hr class="clearfix"/>


                        </form>
                    </div>

                    <div ng-show="changeProfilePictureFlag">
                        <form id="profilePictureFrm" ng-submit="updateProfilePicture()">
                            <div ng-model="errorMsg" ng-if="errorMsg" class="pi-alert-danger">
                                <p>
                                    <strong><a id="topEdu">Warning!</a></strong>
                                <ul><li ng-repeat="em in errorMsg">@{{em[0]}}</li></ul>
                                </p>
                            </div>
                            <div class="pi-col-sm-12">
                                <div class="form-group col-lg-3">
                                    <div style="width:150px; overflow:hidden;" class="pi-img-w pi-img-round-corners profile-img pi-img-shadow pi-img-left pi-margin-top-5">

                                        <img ng-if="client_info.photos != null " alt="" src="@{{destination_path}}/@{{client_info.photos}}">

                                        <img ng-if="client_info.photos == null " alt="" src="{{$theme}}img_external/team/leader-6.png">

                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group">
                                        <input type="button" class="btn pi-btn-orange" ng-click="changeProfilePictureFlag=0" value="Cancel"/>
                                    </div>
                                </div>
                                <div class="form-group col-lg-9">
                                    <div class="col-lg-12">

                                        <div nv-file-drop="" uploader="uploader">
                                        <div ng-show="uploader.isHTML5">
                                            <!-- 3. nv-file-over uploader="link" over-class="className" -->
                                            <div class="well my-drop-zone" nv-file-over="" uploader="uploader">
                                                Base drop zone
                                            </div>
                                        </div>
                                        </div>

                                        <div class="pi-input-with-icon">
                                            <!--<input type="file" ng-file-select="onFileSelect($files)" accept="image/*">-->
                                            <input type="file" nv-file-select="" uploader="uploader" accept="image/*" />
                                        </div>
                                        <div>
                                            Upload Progress:
                                            <div class="progress" style="">
                                                <div class="progress-bar" role="progressbar" ng-style="{ 'width': uploader.progress + '%' }"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                        </form>
                    </div>
                    <div class="clearfix"/></div>
                    <div ng-if="changeProfilePictureFlag == 0" style="width:150px; overflow:hidden;" class="pi-img-w pi-img-round-corners profile-img pi-img-shadow pi-img-left pi-margin-top-5">
                        @if($client_info->photos)
                            <img alt="" src="{{$destination_path}}/{{$client_info->photos}}"/>
                        @else
                            <img alt="" src="{{$theme}}img_external/team/leader-6.png"/>
                        @endif
                        

                        

                        <span ng-click="showChangePictureForm(1)" class="cam">{{Translate::get("Change Picture",$lang)}}</span>
                    </div>
                    <h4>@{{client_info.first_name}} @{{client_info.last_name}}</h4>
                    <h5>@{{client_info.profile_title}}</h5>
                    <p>@{{client_info.description}}</p>
                    <ul style="margin:0px;" class="oInlineListExt">
                        <li><i class="icon-home"></i><strong> @{{client_info.country}}</strong></li>
                        <li><strong>${{$total_amount}}</strong> TOTAL SPENT</li>
                        <!--<li><span class="star"></span>
                            <span class="star"></span>
                            <span class="star"></span>
                            <span class="star"></span>
                            <span class="star"></span>
                            <b>5.0</b>
                        </li>-->
                        <li><strong>0</strong> HOURS</li>
                        <?php if($total_job<=0){ ?>
                            <li><strong>{{$total_job}}</strong>  JOB POSTED</li>
                        <?php }elseif($total_job==1){ ?>
                            <li><strong>{{$total_job}}</strong>  JOB POSTED</li>
                        <?php }else{ ?>
                            <li><strong>{{$total_job}}</strong>  JOBS POSTED</li>
                        <?php } ?>

                        <?php if($total_progress_job<=0){ ?>
                            <li><strong>{{$total_progress_job}}</strong>  JOB PROGRESS</li>
                        <?php }elseif($total_progress_job==1){ ?>
                            <li><strong>{{$total_progress_job}}</strong>  JOB PROGRESS</li>
                        <?php }else{ ?>
                            <li><strong>{{$total_progress_job}}</strong>  JOBS PROGRESS</li>
                        <?php } ?>

                        <?php if($total_completed_job<=0){ ?>
                            <li><strong>{{$total_completed_job}}</strong>  JOB COMPLETED</li>
                        <?php }elseif($total_completed_job==1){ ?>
                            <li><strong>{{$total_completed_job}}</strong>  JOB COMPLETED</li>
                        <?php }else{ ?>
                            <li><strong>{{$total_completed_job}}</strong>  JOBS COMPLETED</li>
                        <?php } ?>


                    </ul>
                    <div style="clear:both;"></div>

                    <hr class="pi-divider-gap-50">

                    <div class="pi-row">
                        <div class="pi-col-sm-12 pi-padding-bottom-20">


                            <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-20 pi-has-bg">
                                {{Translate::get("Contact Information",$lang)}} :
                                <span class="btn-group pull-right" >
                                    <a ng-click="showClientContactForm(1)" class="btn pi-btn-small pi-btn-base dropdown-toggle" href="">
                                        <i class="icon-pencil"></i>
                                    </a>
                                </span>
                            </h3>
                            <div ng-show="editClientContactFlag">
                                <form id="clientContactFrm" ng-submit="updateClientContact()">
                                    <div ng-model="errorMsg" ng-if="errorMsg" class="pi-alert-danger">
                                        <p>
                                            <strong><a id="topEdu">Warning!</a></strong>
                                        <ul><li ng-repeat="em in errorMsg">@{{em[0]}}</li></ul>
                                        </p>
                                    </div>
                                    <div class="pi-col-sm-12 pi-no-padding">
                                        <div class="form-group">
                                            <label for="country">{{Translate::get("Country",$lang)}}:</label>
                                            <input name="country" ng-model="contact.country" class="form-control" typeahead="c.name for c in countries | filter:$viewValue | limitTo:8">
                                            <!--<input type="text" class="form-control small_text" ng-model="contact.country"/>-->
                                        </div>
                                        <div class="form-group">
                                            <label for="address">{{Translate::get("Address",$lang)}}:</label>
                                            <input type="text" class="form-control small_text" ng-model="contact.address"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="address2">{{Translate::get("Address",$lang)}}2:</label>
                                            <input type="text" class="form-control small_text" ng-model="contact.address2"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="city">{{Translate::get("City",$lang)}}:</label>
                                            <input type="text" class="form-control small_text" ng-model="contact.city"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="province">{{Translate::get("State/Division",$lang)}}:</label>
                                            <input type="text" class="form-control small_text" ng-model="contact.province"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="postal_code">{{Translate::get("Zip/Postal Code",$lang)}}:</label>
                                            <input type="text" class="form-control small_text" ng-model="contact.postal_code"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_number">{{Translate::get("Phone",$lang)}}:</label>
                                            <input type="text" class="form-control small_text" ng-model="contact.contact_number"/>
                                        </div>
                                        <div class="form-group pull-right">
                                            <input type="submit" class="btn pi-btn-small pi-btn-green" value="{{Translate::get('Update',$lang)}}"/>
                                            <input type="button" class="btn  pi-btn-small pi-btn-orange" ng-click="editClientContactFlag=0" value="{{Translate::get('Cancel',$lang)}}"/>
                                        </div>
                                    </div>
                                    <hr class="clearfix"/>


                                </form>
                            </div>



                            <div class="clearfix"/></div>
                            <div ng-if="editClientContactFlag != 1" class="pi-responsive-table-sm">
                                <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
                                    <tbody>

                                    <tr>
                                        <td>{{Translate::get("Country",$lang)}}</td>
                                        <td>@{{client_info.country}}</td>
                                    </tr>

                                    <tr>
                                        <td>{{Translate::get("Address",$lang)}}</td>
                                        <td>@{{client_info.address}}</td>
                                    </tr>

                                    <tr>
                                        <td>{{Translate::get("Address",$lang)}} 2</td>
                                        <td>@{{client_info.address2}}</td>
                                    </tr>

                                    <tr>
                                        <td>{{Translate::get("City",$lang)}}</td>
                                        <td>@{{client_info.city}}</td>
                                    </tr>

                                    <tr>
                                        <td>{{Translate::get("State/Division",$lang)}}</td>
                                        <td>@{{client_info.province}}</td>
                                    </tr>

                                    <tr>
                                        <td>{{Translate::get("Zip/Postal Code",$lang)}}</td>
                                        <td>@{{client_info.postal_code}}</td>
                                    </tr>

                                    <tr>
                                        <td>{{Translate::get("Phone",$lang)}}</td>
                                        <td>@{{client_info.contact_number}}</td>
                                    </tr>
                                    <!--<tr>
                                        <td>Profile to PDF</td>
                                        <td><a href="#" class="btn pi-btn-green pi-btn-small"><i class="icon-download pi-icon-left"></i>Download</a></td>
                                    </tr>-->


                                    </tbody>
                                    <!-- End table body -->

                                </table>
                            </div>
                        </div>



                    </div>



                </div>
                <!-- End tab content -->

                <!-- Tab content -->
                <div id="finance" class="pi-tab-pane">

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
                <div id="jobhistory" class="pi-tab-pane">

                    <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-20 pi-has-bg">
                        Job History &amp; Feedback
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

                                <td>Professional CV Writer <i class="pr-date">Jul 2014 &ndash; Jul 2014</i></td>

                                <td>
                                    Phoebe did an amazing job. I would definitely recommend her and do business with her again.
                                </td>
                                <td align="center"><b class="ret">4.65</b> <br>
                                    <span class="star"></span>
                                    <span class="star"></span>
                                    <span class="star"></span>
                                    <span class="star"></span>
                                    <span class="star"></span>
                                </td>

                            </tr>

                            <tr>

                                <td>Professional CV Writer <i class="pr-date">Jul 2014 &ndash; Jul 2014</i></td>

                                <td>
                                    Phoebe did an amazing job. I would definitely recommend her and do business with her again.
                                </td>
                                <td align="center"><b class="ret">4.65</b> <br>
                                    <span class="star"></span>
                                    <span class="star"></span>
                                    <span class="star"></span>
                                    <span class="star"></span>
                                    <span class="star"></span>
                                </td>

                            </tr>

                            <tr>

                                <td>Professional CV Writer <i class="pr-date">Jul 2014 &ndash; Jul 2014</i></td>

                                <td>
                                    Phoebe did an amazing job. I would definitely recommend her and do business with her again.
                                </td>
                                <td align="center"><b class="ret">4.65</b> <br>
                                    <span class="star"></span>
                                    <span class="star"></span>
                                    <span class="star"></span>
                                    <span class="star"></span>
                                    <span class="star"></span>
                                </td>

                            </tr>

                            <tr>

                                <td>Professional CV Writer <i class="pr-date">Jul 2014 &ndash; Jul 2014</i></td>

                                <td>
                                    Phoebe did an amazing job. I would definitely recommend her and do business with her again.
                                </td>
                                <td align="center"><b class="ret">4.65</b> <br>
                                    <span class="star"></span>
                                    <span class="star"></span>
                                    <span class="star"></span>
                                    <span class="star"></span>
                                    <span class="star"></span>
                                </td>

                            </tr>

                            <tr>

                                <td>Professional CV Writer <i class="pr-date">Jul 2014 &ndash; Jul 2014</i></td>

                                <td>
                                    Phoebe did an amazing job. I would definitely recommend her and do business with her again.
                                </td>
                                <td align="center"><b class="ret">4.65</b> <br>
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

                <div id="new-job-post" class="pi-tab-pane">

                    <div class="pi-row">
                        <div class="pi-col-sm-12">
                            <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25 pi-has-bg">New Job Post <a class="btn pi-btn-lime pi-btn-small" style="float:right; z-index:8; position:relative;" href="#">Submit Now <i class="icon-paper-plane pi-icon-right"></i></a></h3>

                            <div class="pi-col-xs-12 pi-no-padding">
                                <div class="form-group">
                                    <label for="exampleInputName-3">Job Title</label>
                                    <div class="pi-input-with-icon">
                                        <div class="pi-input-icon"><i class="icon-pencil"></i></div>
                                        <input type="text" placeholder="Title Here" id="exampleInputName-1" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName-3">Job Description</label>
                                    <div class="pi-input-with-icon">
                                        <div class="pi-input-icon"><i class="icon-pencil"></i></div>
                                        <textarea rows="2" placeholder="Type your text" id="exampleInputMessage-1" class="form-control"></textarea>
                                    </div>
                                </div>
                                <hr class="pi-divider-gap-10">
                            </div>

                        </div>


                        <div class="pi-col-sm-12">

                            <h4 class="pi-has-bg pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-20">One by one job complete <a class="btn pi-btn-blue pi-btn-small" style="float:right; z-index:8; position:relative;" href="#">Add</a></h4>

                            <div class="pi-accordion">

                                <!-- Accordion item -->
                                <div class="pi-accordion-item">
                                    <h5 class="pi-accordion-title">
                                        <a href="#"><span class="pi-accordion-toggle"></span>One Phase Lable</a>
                                    </h5>

                                    <div class="pi-accordion-content pi-section-grey" style="display:none;">

                                        <div>

                                            <div class="pi-col-xs-6">
                                                <div class="form-group">
                                                    <label for="exampleInputName-3">Phase Title</label>
                                                    <div class="pi-input-with-icon">
                                                        <div class="pi-input-icon"><i class="icon-pencil"></i></div>
                                                        <input type="text" placeholder="Title Here" id="exampleInputName-1" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputName-3">Phase Details</label>
                                                    <div class="pi-input-with-icon">
                                                        <div class="pi-input-icon"><i class="icon-pencil"></i></div>
                                                        <textarea rows="5" placeholder="Type your text" id="exampleInputMessage-1" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <hr class="pi-divider-gap-10">
                                            </div>

                                            <div class="pi-col-xs-6">
                                                <div class="form-group">
                                                    <label for="exampleInputBudget-3">Phase Payment Status</label>
                                                    <select id="exampleInputBudget-3" class="form-control">
                                                        <option>Done</option>
                                                        <option>Hold</option>
                                                        <option>Pending</option>
                                                    </select>
                                                </div>

                                                <div style="padding-left:0;" class="pi-col-xs-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputName-3">Phase Hour</label>
                                                        <div class="pi-input-with-icon">
                                                            <div class="pi-input-icon"><i class="icon-pencil"></i></div>
                                                            <input type="text" placeholder="Title Here" id="exampleInputName-1" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="padding-right:0;" class="pi-col-xs-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputName-3">Phase Price</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">$</span>
                                                            <input type="text" class="form-control">
                                                            <span class="input-group-addon">.00</span>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputName-3">Phase Date</label>
                                                    <div class="pi-input-with-icon">
                                                        <div class="pi-input-icon"><i class="icon-pencil"></i></div>
                                                        <input type="text" placeholder="Date" id="datepicker" class="form-control datepicker hasDatepicker">
                                                    </div>
                                                </div>

                                                <hr class="pi-divider-gap-10">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- End accordion item -->

                                <!-- Accordion item -->
                                <div class="pi-accordion-item">
                                    <h5 class="pi-accordion-title">
                                        <a href="#"><span class="pi-accordion-toggle"></span>One Phase Output</a>
                                    </h5>

                                    <div class="pi-accordion-content pi-section-grey" style="display: none;">

                                        <div class="pi-col-xs-12">
                                            <div>
                                                <p class="pi-col-xs-3 pi-no-padding"><span class="glyphicon glyphicon-calendar"></span> 09/11/2014</p>
                                                <p class="pi-col-xs-3 pi-no-padding"><span class="glyphicon glyphicon-ok"></span> Done</p>
                                                <p class="pi-col-xs-3 pi-no-padding"><span class="glyphicon glyphicon-dashboard"></span> 4</p>
                                                <p class="pi-col-xs-3 pi-no-padding"><span class="glyphicon glyphicon-usd"></span> 402</p>
                                            </div>
                                        </div>

                                        <div class="pi-col-xs-12">
                                            <div><p class="pi-no-margin-bottom"><strong>Phase Title : </strong>Wordpress Template Design</p></div>
                                        </div>

                                        <div class="pi-col-xs-12 pi-no-margin-top">
                                            <div><p align="justify"><span class="glyphicon glyphicon-pencil"></span> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy.</p></div>
                                        </div>

                                    </div>
                                </div>
                                <!-- End accordion item -->


                            </div>

                        </div>

                    </div>


                </div>

                </div>
            </div>
            <!-- End tabs -->

        </div>
    </div>

    <!-- - - - - - - - - - END SECTION - - - - - - - - - -->

    <!-- - - - - - - - - - SECTION - - - - - - - - - -->
    <div style="background:#e6e6e6;" class="pi-section-w pi-shadow-inside-top pi-section-base">
        <div style="background: url({{$theme}}img/hexagon.png) repeat;" class="pi-texture"></div>
        <div class="pi-section pi-padding-top-60 pi-padding-bottom-40 pi-text-center">

            <p class="lead-30">
                <span style="color:#232323!important;" class="pi-text-white">Have a project with us? <span style="color:#59b900;" class="pi-weight-400">Feel free.</span></span>

                <a style="margin-left: 25px;" class="btn pi-btn-base-2 pi-btn-big" href="#">Post A Job !<i class="icon-paper-plane pi-icon-right"></i></a>

            </p>

        </div>
    </div>
    <!-- - - - - - - - - - END SECTION - - - - - - - - - --></div>
</div>
@stop