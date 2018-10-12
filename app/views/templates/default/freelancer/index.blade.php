@extends('templates.default.default')


@section('content')
<script type="text/javascript">
    var user = {{$user}}
    var prices = {{$prices}}
    <?php if(count($freelancer)){ ?>
    var Freelancer = {{$freelancer}}
    var Educations = {{$educations}}
    var Certs = {{$certs}}
    var Pbs = {{$pbs}}
    var MySkills = {{$rskills}};
    var testTaken = {{$test_taken}}
    <?php }else{?>
    var Freelancer = '';
    var Educations = '';
    var Certs = '';
    var Pbs = '';
    var MySkills = '';
    var testTaken = ''

    <?php } ?>
</script>
<script type="text/javascript" src="{{$theme}}js/custom/freelancer/overviewcontroller.js"></script>

<!-- Breadcrumbs -->

<div class="pi-section-w pi-border-bottom pi-section-grey">
        <div class="pi-section pi-titlebar pi-breadcrumb-only">
            <div class="pi-breadcrumb">
                <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li><a href="{{url('freelancer/'.$title['action'])}}">{{$title['title']}}</a></li>
                </ul>
            </div>
            <div class="text-center">
                {{Helpers::showMessage()}}
            </div>
        </div>
</div>
<!-- End breadcrumbs -->



<!-- - - - - - - - - - SECTION - - - - - - - - - -->

<div class="pi-section-w pi-section-white pi-slider-enabled piSocials">
    <div class="pi-section pi-padding-bottom-30" ng-app="freelancerApp" ng-controller="freelancerAppController">
    @if(count($freelancer) != 0)
        <!-- Openings -->
        <div  class="pi-tabs-vertical pi-responsive-sm">
            <ul class="pi-tabs-navigation pi-tabs-navigation-transparent profile-po" id="myTabs">
                {{Theme::make('partial.menu',array('freelancer'=>$freelancer))}}
            </ul>
            <div class="pi-tabs-content pi-tabs-content-transparent">

                <!-- Tab content -->

                    <div ng-cloak class="pi-row col-lg-12 pi-no-padding-right pi-no-margin-right">

                        <!-- Col 6 -->
                        {{Helpers::showMessage()}}
                        <div ng-model="successMsg" ng-if="successMsg" class="pi-alert-success">
                            <!--<button data-dismiss="alert" class="pi-close" type="button">
                                <i class="icon-cancel"></i>
                            </button>-->
                            <p>
                                <strong><a id="topPbsUpdate">Success </a></strong> @{{successMsg}}
                            </p>
                        </div>
                <!-- Tab content -->
                <div class="pi-tab-pane pi-active" id="overview">

                    <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-25 pi-has-bg">{{Translate::get("Profile Title",$lang)}} <label ng-model="overviewForm.profile_title">: @{{overviewForm.profile_title}}</label>
                        |
                        <i ng-if="Freelancer.available" class="avai"><img src="{{$theme}}img/available.png" width="15" height="15" alt="available" > Available </i>
                        <i ng-if="Freelancer.available == 0"class="avai"><img src="{{$theme}}img/no-available.png" width="15" height="15" alt="available" > Not Available </i>

                        <span ng-show="!overviewEditable" class="btn-group pull-right" >
                            <a ng-click="editOverview()" class="btn pi-btn-small pi-btn-base dropdown-toggle" href="">
                                <i class="icon-pencil"></i>
                            </a>
                        </span>
                    </h3>
                    
                  <div class="pi-img-w pi-img-round-corners profile-img pi-img-shadow pi-img-left pi-margin-top-5" style="width:150px; overflow:hidden;">
                      @if(count($freelancer) && ($freelancer->photos != null))
                        @if($freelancer->freelancer_type=='Individual')
                        <img src="{{CDN}}profile/freelancer/individual/{{$freelancer->photos}}" alt="{{$freelancer->photos or 'photo'}}"/>
                        @else
                            <img src="{{CDN}}profile/freelancer/agency/{{$freelancer->photos}}" alt="{{$freelancer->photos or 'photo'}}"/>
                        @endif
                      @else
                        <img src="{{CDN}}profile/leader-1.png" alt=""/>
                      @endif

                      <span ng-click="open()" class="cam">Change Picture</span>
                  </div>
                  <div ng-show="!overviewEditable">

                        <h3>@{{overviewForm.first_name+' '+overviewForm.last_name}}</h3>
                        <p ng-model="overviewForm.overview">
                            @{{overviewForm.overview}}
                        </p>
                        <ul class="oInlineListExt" style="margin:0px;">
                            <li><i class="icon-home"></i><strong ng-show="Freelancer.address_country">@{{Freelancer.address_country}}</strong></li>
                            <li ng-show="overviewForm.freelancer_price>0"><strong>$@{{overviewForm.freelancer_price}}</strong> HOURLY RATE</li>
                            <?php
                            $widgetData = $freelancer->getWidgetData();
                            ?>
                            <li>
                                @for($i=1; $i<=5; $i++)
                                @if($i <= $widgetData['avg_feedback'])
                                <span class="star"></span>
                                @else
                                <span class="star2"></span>
                                @endif
                                @endfor
                                <b>{{$widgetData['avg_feedback']}}</b>
                            </li>
                            <li ng-show="overviewForm.years_of_experience>0"><strong>@{{overviewForm.years_of_experience}}</strong> Years Exp</li>
                            <li ng-show="testTaken"><strong>@{{testTaken}}</strong> TEST<span ng-show="testTaken >1">S</span></li>
                        </ul>
                        <ul ng-show="skills.length" class="cat-link clearFix">
                            <li ng-repeat="s in skills"><a href="#" class="">@{{s.skill.category_name}}</a></li>
                            <!--<li><a href="#" class="">HTML5</a></li>
                            <li><a href="#" class="">CSS3</a></li>
                            <li><a href="#" class="">Web Design</a></li>
                            <li><a href="#" class="">HTML5</a></li>
                            <li><a href="#" class="">CSS3</a></li>
                            <li><a href="#" class="">Web Design</a></li>
                            <li><a href="#" class="">HTML5</a></li>
                            <li><a href="#" class="">CSS3</a></li>-->
                        </ul>
                  </div>
                    <div ng-show="overviewEditable" class="pi-col-xs-9">
                        <div ng-model="errorMsg" ng-if="errorMsg" class="pi-alert-danger">
                            <!--<button data-dismiss="alert" class="pi-close" type="button">
                                <i class="icon-cancel"></i>
                            </button>-->
                            <p>
                                <strong><a id="topEdu">Warning!</a></strong> <ul><li ng-repeat="em in errorMsg">@{{em[0]}}</li></ul>
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName-3">First name</label>
                            <div class="pi-input-with-icon">
                                <div class="pi-input-icon"><i class="icon-user"></i></div>
                                <input type="text" required class="form-control" ng-model="overviewForm.first_name" />
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName-3">Last name</label>
                            <div class="pi-input-with-icon">
                                <div class="pi-input-icon"><i class="icon-user"></i></div>
                                <input type="text" class="form-control" ng-model="overviewForm.last_name" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName-3">Profile Title</label>
                            <div class="pi-input-with-icon">
                                <div class="pi-input-icon"><i class="icon-user"></i></div>
                                <input type="text" class="form-control" ng-model="overviewForm.profile_title" required />
                            </div>
                        </div>
                        <hr class="pi-divider-gap-10">
                        <div class="form-group">
                            <label for="exampleInputName-3">Overview</label>
                            <div class="pi-input-with-icon">
                                <div class="pi-input-icon"><i class="icon-pencil"></i></div>
                                <textarea class="form-control" required ng-model="overviewForm.overview" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="pi-col-sm-4 pi-no-padding-left">
                            <div class="form-group">
                                <label for="exampleInputName-3">Year of Experience</label>
                                <div class="pi-input-with-icon">
                                    <div class="pi-input-icon"></div>
                                    <input type="number" class="form-control" ng-model="overviewForm.years_of_experience" placeholder="">
                                </div>
                            </div>
                            </div>
                        <div class="pi-col-sm-4">
                            <div class="form-group">
                                <label for="exampleInputName-3">Hourly rate</label>
                                <div class="pi-input-with-icon">
                                    <div class="pi-input-icon"><i class="">$</i></div>
                                    <select ng-model="overviewForm.freelancer_price" class="form-control">
                                        <option ng-repeat="p in prices" ng-selected="p.title == overviewForm.freelancer_price" value="@{{p.title}}">@{{p.title}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <a href="#" class="btn pi-btn-green pi-btn-small" ng-click="updateOverview()">Update</a>
                        <hr class="pi-divider-gap-10">
                    </div>
                    <div style="clear:both;"></div>


                        <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-20 pi-has-bg">{{Translate::get("My Skills",$lang)}} :
                            <span class="btn-group pull-right" >
                            <a class="btn pi-btn-small pi-btn-base dropdown-toggle" href="{{url('freelancer/skills')}}">
                                <i class="icon-pencil"></i>
                            </a>
                        </span>
                        </h3>

                        <div ng-show="skills.length" class="pi-row">
                            <div class="pi-col-sm-12">
                                <ul class="pi-bullets-square pi-bullets-contur pi-bullets">
                                    <li ng-repeat="s in skills" class="pi-col-sm-6"><span class="pi-bullet-icon"><i class="icon-flash"></i></span>@{{s.skill.category_name}}</li>

                                </ul>
                            </div>

                        </div>
                    <div class="pi-row">
                        @if($user->is_agent !=1)
                        <div class="pi-col-sm-12 pi-padding-bottom-20">
                            <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-20 pi-has-bg">{{Translate::get("Education",$lang)}} :
                            <span class="btn-group pull-right" dropdown>
                                <button type="button" class="btn pi-btn-small pi-btn-base dropdown-toggle">
                                    <i class="icon-pencil"></i>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="" ng-click="addEduInfo(false)">{{Translate::get("Add Info",$lang)}}</a>
                                    </li>
                                    <li class="text-center"><small><input style="vertical-align:text-bottom;" ng-checked="getStatus(Freelancer.edu_widget)" ng-model="Freelancer.edu_widget" ng-click="changeStatus(Freelancer.edu_widget,'edu_widget')" type="checkbox"/>{{Translate::get("Make it public",$lang)}}</small></li>
                                </ul>

                            </span>

                            </h3>
                            <div class="pi-responsive-table-sm">
                                <form id="eduAddFrm" ng-show="eduEditable" ng-submit="saveEdu()">
                                    <div ng-model="errorMsg" ng-if="errorMsg" class="pi-alert-danger">
                                        <!--<button data-dismiss="alert" class="pi-close" type="button">
                                            <i class="icon-cancel"></i>
                                        </button>-->
                                        <p>
                                            <strong><a id="topEdu">Warning!</a></strong> <ul><li ng-repeat="em in errorMsg">@{{em[0]}}</li></ul>
                                        </p>
                                    </div>
                                    <div class="pi-col-sm-8">
                                        <div class="form-group">
                                            <label for="name">{{Translate::get("Institute",$lang)}}</label>
                                            <input type="text" class="form-control" ng-model="edu.institute_name"/>
                                        </div>


                                        <div class="form-group">
                                            <label for="name">{{Translate::get("Faculty",$lang)}}</label>
                                            <input type="text" class="form-control small_text" ng-model="edu.area_of_study"/>
                                        </div>


                                        <div class="form-group">
                                            <label for="name">{{Translate::get("Start Year",$lang)}}</label>
                                            <input type="text" class="form-control small_text" ng-model="edu.start_year"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">{{Translate::get("Passing Year",$lang)}}</label>
                                            <input type="text" class="form-control small_text" ng-model="edu.end_year"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">{{Translate::get("Grade/Point/Division",$lang)}}</label>
                                            <input type="text" class="form-control small_text" ng-model="edu.degree"/>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="name">{{Translate::get("Description",$lang)}}</label>
                                            <textarea class="form-control small_text" maxlength="100" ng-model="edu.description"></textarea>
                                        </div> -->
                                        <div class="form-group">
                                            <input type="submit" class="btn pi-btn-green" value="{{Translate::get('Save',$lang)}}"/>
                                            <input type="button" class="btn pi-btn-orange" ng-click="eduEditable=0" value="{{Translate::get('Cancel',$lang)}}"/>
                                        </div>
                                    </div>
                                    <hr class="clearfix"/>


                                </form>
                                <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
                                    <thead>
                                        <tr>
                                            <th colspan="2">{{Translate::get("Institute",$lang)}}</th>
                                            <th>{{Translate::get("Faculty",$lang)}}</th>
                                            <th>{{Translate::get("Start Year",$lang)}}</th>
                                            <th>{{Translate::get("Passing Year",$lang)}}</th>
                                            <th>{{Translate::get("Grade/Point/Division",$lang)}}</th>
                                            <th>{{Translate::get("Action",$lang)}}</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="Edu in Educations">
                                            <td colspan="2">@{{Edu.institute_name}}<br/><small style="display:block;width:100px;word-wrap:break-word;"></small></td>
                                            <td>@{{Edu.area_of_study}}</td>
                                            <td>@{{Edu.start_year}}</td>
                                            <td>@{{Edu.end_year}}</td>
                                            <td>@{{Edu.degree}}</td>
                                            <td>
                                                <a href="" title="Edit" ng-click="openUpdateEduFrm($index,Edu.id)"><i class="icon-pencil"></i></a>
                                                <a href="" title="Remove" ng-click="removeEdu($index,Edu.id)"><i class="icon-trash"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                    @endif
                    <hr class="pi-divider-gap-50">                  


                        <div class="pi-col-sm-12 pi-padding-bottom-20">
                        <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-20 pi-has-bg">{{Translate::get("Contact Information",$lang)}} :
                            <span class="btn-group pull-right" dropdown>
                                <button type="button" class="btn pi-btn-small pi-btn-base dropdown-toggle">
                                    <i class="icon-pencil"></i>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{url('freelancer/edit-contact')}}">{{Translate::get("Edit",$lang)}}</a>
                                    </li>
                                    <li class="text-center"><small><input style="vertical-align:text-bottom;" ng-checked="getStatus(Freelancer.contact_widget)" ng-model="Freelancer.contact_widget" ng-click="changeStatus(Freelancer.contact_widget,'contact_widget')" type="checkbox"/>{{Translate::get("Make it public",$lang)}}</small></li>
                                </ul>

                            </span>

                        </h3>
                            <div class="pi-responsive-table-sm">
            <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
                <tbody>
                
                    <tr>
                        <td>{{Translate::get("Country",$lang)}}</td>
                        <td>@{{Freelancer.address_country}}</td>
                    </tr>
                    
                    <tr>
                        <td>{{Translate::get("Address",$lang)}}</td>
                        <td>@{{Freelancer.address}}</td>
                    </tr>
                    
                    <tr>
                        <td>{{Translate::get("State/Division",$lang)}}</td>
                        <td>@{{Freelancer.division}}</td>
                    </tr>
                    
                    <tr>
                        <td>{{Translate::get("City",$lang)}}</td>
                        <td>@{{Freelancer.address_city}}</td>
                    </tr>

                    <tr>
                        <td>{{Translate::get("Zip/Postal Code",$lang)}}</td>
                        <td>@{{Freelancer.address_zip}}</td>
                    </tr>

                    <tr>
                        <td>{{Translate::get("Phone",$lang)}}</td>
                        <td>@{{Freelancer.contact_number}}</td>
                    </tr>

                    <tr>
                        <td>{{Translate::get("Mobile",$lang)}}</td>
                        <td>@{{Freelancer.mobile}}</td>
                    </tr>
                    
                    <!--<tr>
                        <td>Profile to PDF</td>
                        <td><a class="btn pi-btn-green pi-btn-small" href="#"><i class="icon-download pi-icon-left"></i>Download</a></td>
                    </tr>-->

                    
                </tbody>
                <!-- End table body -->
                
            </table>
        </div>
                        </div>
                        
            <div class="pi-col-sm-12 pi-padding-bottom-20">

                <h2 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-has-bg pi-margin-bottom-30"><?php 
                         $txt = '';
                        if($freelancer->freelancer_type == Freelancer::$INDIVIDUAL)
                            $txt .= "I Am ";
                        else 
                            $txt .= "We Are ";

                        $txt .= "Good At";
                    ?>
                    {{Translate::get($txt,$lang)}}
                    <span class="btn-group pull-right" dropdown>
                        <!--<button type="button" class="btn btn-danger">Action</button>-->
                        <button type="button" class="btn pi-btn-small pi-btn-base dropdown-toggle">
                            <i class="icon-pencil"></i>
                            <!--<span class="caret"></span>
                            <span class="sr-only">Split button!</span>-->
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li class="text-center">
                                <small>
                                    <input style="vertical-align:text-bottom;" ng-checked="getStatus(Freelancer.exam_widget)" ng-model="Freelancer.exam_widget" ng-click="changeStatus(Freelancer.exam_widget,'exam_widget')" type="checkbox"/>{{Translate::get("Make it public",$lang)}}
                                </small>
                            </li>

                        </ul>
                    </span>
                </h2>

                <!-- Progress bar -->

                @if(count($rskills))
                    @foreach($rskills as $rskill)
                        @if($rskill->test_taken && $rskill->display)
                            <div class="pi-counter pi-counter-round pi-counter-line" data-counter-type="line" data-count-from="0" data-count-to="{{{$rskill->test_percentage}}}" data-easing="easeInCirc" data-duration="2000" data-frames-per-second="10">

                                <p class="pi-counter-label">{{{$rskill->GetTag->category_name}}} {{{$rskill->test_percentage}}}%</p>

                                <div class="pi-counter-count">
                                    <div class="pi-counter-progress pi-bar-one"></div>
                                </div>

                            </div>
                        @else
                            @if(count($rskill->GetTag))
                            <div class="pi-counter pi-counter-round pi-counter-line" data-counter-type="line" data-count-from="0" data-count-to="1" data-easing="easeInCirc" data-duration="2000" data-frames-per-second="10">

                                <p class="pi-counter-label">{{{$rskill->GetTag->category_name or ''}}} <span>Test not taken yet </span> {{Form::Open(array('url'=>'exam', 'method'=>'post'))}}
                                            <input type="hidden" name="id" value="{{$rskill->id}}"/>
                                            <button  class="btn pi-btn-small pi-btn-orange @if($rskill->can_take_test != 0) hidden @endif" type="submit">{{Translate::get("Take Test",$lang)}}</button>
                                        {{Form::Close()}}</p>

                                <div class="pi-counter-count">
                                    <div class="pi-counter-progress pi-bar-one"></div>
                                </div>

                            </div>
                            @endif
                        @endif
                    @endforeach
                @endif
            </div>
    




                </div>
                @if($user->is_agent != 1)
                <div class="pi-row">
                    <div class="pi-col-sm-12 pi-padding-bottom-20">
                        <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-20 pi-has-bg">{{Translate::get("Certification",$lang)}} :
                            <span class="btn-group pull-right" dropdown>
                                <button type="button" class="btn pi-btn-small pi-btn-base dropdown-toggle">
                                    <i class="icon-pencil"></i>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="" ng-click="addCertInfo(false)">{{Translate::get("Add Info",$lang)}}</a>
                                    </li>
                                    <li class="text-center"><small><input style="vertical-align:text-bottom;" ng-checked="getStatus(Freelancer.certificate_widget)" ng-model="Freelancer.certificate_widget" ng-click="changeStatus(Freelancer.certificate_widget,'certificate_widget')" type="checkbox"/>{{Translate::get("Make it public",$lang)}}</small></li>
                                </ul>

                            </span>

                        </h3>
                        <div class="pi-responsive-table-sm">
                            <form id="certAddFrm" ng-show="certEditable" ng-submit="saveCert()">
                                <div ng-model="errorMsg" ng-if="errorMsg" class="pi-alert-danger">
                                    <!--<button data-dismiss="alert" class="pi-close" type="button">
                                        <i class="icon-cancel"></i>
                                    </button>-->
                                    <p>
                                        <strong><a id="topCert">Warning!</a></strong> <ul><li ng-repeat="em in errorMsg">@{{em[0]}}</li></ul>
                                    </p>
                                </div>
                                <div class="pi-col-sm-8">
                                    <div class="form-group">
                                        <label for="title">{{Translate::get("Title",$lang)}} <span class="pi-text-red">*</span></label>
                                        <input type="text"   class="form-control" ng-model="cert.title" ng-if="certEditable==1"/>
                                    </div>


                                    <div class="form-group">
                                        <label for="provider">{{Translate::get("Provider",$lang)}} <span class="pi-text-red">*</span></label>
                                        <input type="text" class="form-control small_text" ng-model="cert.provider"/>
                                    </div>


                                    <!--<div class="form-group">
                                        <label for="date_earned">Earned Date</label>
                                        <input type="text" class="form-control small_text" ng-model="cert.date_earned"/>
                                    </div>-->
                                    <div class="row">
                                        <label class="col-md-3" for="date_earned">{{Translate::get("Earned Date",$lang)}}</label>
                                        <div class="col-md-6">
                                            <p class="input-group">
                                                <input type="text" class="form-control" datepicker-popup="yyyy-MM-dd" ng-model="cert.date_earned"  is-open="opened" ng-required="true" close-text="Close" />
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default" ng-click="openDatePicker($event)"><i class="glyphicon glyphicon-calendar"></i></button>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="submission_code_or_link">{{Translate::get("Submission code / link",$lang)}} <span class="pi-text-red">*</span></label>
                                        <input type="text" class="form-control small_text" ng-model="cert.submission_code_or_link"/>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">{{Translate::get("Description",$lang)}}</label>
                                        <textarea class="form-control small_text" maxlength="50" ng-model="cert.description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn pi-btn-green" value="{{Translate::get('Save',$lang)}}"/>
                                        <input type="button" class="btn pi-btn-orange" ng-click="certEditable=0" value="{{Translate::get('Cancel',$lang)}}"/>
                                    </div>
                                </div>
                                <hr class="clearfix"/>


                            </form>
                            <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
                                <thead>
                                    <tr>
                                        <th colspan="2">{{Translate::get("Title",$lang)}}</th>
                                        <th>{{Translate::get("Provider",$lang)}}</th>
                                        <th>{{Translate::get("Description",$lang)}}</th>
                                        <th>{{Translate::get("Earned Date",$lang)}}</th>
                                        <th>{{Translate::get("Submission code / link",$lang)}}</th>
                                        <th>{{Translate::get("Action",$lang)}}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="Cert in Certs">
                                        <td colspan="2">@{{Cert.title}}<br/></td>
                                        <td>@{{Cert.provider}}</td>
                                        <td><small style="display:block;width:100px;word-wrap:break-word;"><em>@{{Cert.description}}</em></small></td>
                                        <td>@{{Cert.date_earned | limitTo:10}}</td>
                                        <td>@{{Cert.submission_code_or_link}}</td>
                                        <td>
                                            <a href="" title="Edit" ng-click="openUpdateCertFrm($index,Cert.id)"><i class="icon-pencil"></i></a>
                                            <a href="" title="Remove" ng-click="removeCert($index,Cert.id)"><i class="icon-trash"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="pi-divider-gap-50">
                </div>
                @endif
                    @if($user->is_agent != 1)
                    <div class="pi-row">
                        <div class="pi-col-sm-12 pi-padding-bottom-20">
                            <h3 class="h4 pi-weight-700 pi-uppercase pi-letter-spacing pi-margin-bottom-20 pi-has-bg">{{Translate::get("Professional Background",$lang)}} :
                            <span class="btn-group pull-right" dropdown>
                                <button type="button" class="btn pi-btn-small pi-btn-base dropdown-toggle">
                                    <i class="icon-pencil"></i>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="" ng-click="addPbsInfo(false)">{{Translate::get("Add Info",$lang)}}</a>
                                    </li>
                                    <li class="text-center"><small><input style="vertical-align:text-bottom;" ng-checked="getStatus(Freelancer.pbs_widget)" ng-model="Freelancer.pbs_widget" ng-click="changeStatus(Freelancer.pbs_widget,'pbs_widget')" type="checkbox"/>{{Translate::get("Make it public",$lang)}}</small></li>
                                </ul>

                            </span>

                            </h3>
                            <div class="pi-responsive-table-sm">

                                <form id="pbsAddFrm" ng-show="pbsEditable" ng-submit="savePbs()">
                                    <div ng-model="errorMsg" ng-if="errorMsg" class="pi-alert-danger">
                                        <!--<button data-dismiss="alert" class="pi-close" type="button">
                                            <i class="icon-cancel"></i>
                                        </button>-->
                                        <p>
                                            <strong><a id="topPbs">Warning!</a></strong> <ul><li ng-repeat="em in errorMsg">@{{em[0]}}</li></ul>
                                        </p>
                                    </div>
                                    <div class="pi-col-sm-8">
                                        <div class="form-group">
                                            <label for="org_name">{{Translate::get("Organization name",$lang)}} <span class="pi-text-red">*</span></label>
                                            <input type="text" class="form-control" ng-model="pbs.org_name"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="org_type">{{Translate::get("Organization type",$lang)}} <span class="pi-text-red">*</span></label>
                                            <input type="text" class="form-control" ng-model="pbs.org_type"/>
                                        </div>

                                        <div class="row">
                                            <label class="col-md-3" for="date_earned">{{Translate::get("Start Date",$lang)}}</label>
                                            <div class="col-md-6">
                                                <p class="input-group">
                                                    <input type="text" class="form-control" datepicker-popup="yyyy-MM-dd" ng-model="pbs.start_dt"  is-open="start_date_opened" ng-required="true" close-text="Close" />
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default" ng-click="openPbsStartDatePicker($event)"><i class="glyphicon glyphicon-calendar"></i></button>
                                                </span>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row" ng-show="!pbs.current_status">
                                            <label class="col-md-3" for="date_earned">{{Translate::get("End Date",$lang)}}</label>
                                            <div class="col-md-6">
                                                <p class="input-group">
                                                    <input type="text" class="form-control" datepicker-popup="yyyy-MM-dd" ng-model="pbs.end_dt"  is-open="end_date_opened" close-text="Close" />
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default" ng-click="openPbsEndDatePicker($event)"><i class="glyphicon glyphicon-calendar"></i></button>
                                                </span>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <label class="col-md-3" for="current_status">{{Translate::get("Current Status",$lang)}}</label>
                                            <div class="col-md-6">
                                                <input type="checkbox" class="form-control small_text" ng-model="pbs.current_status"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="responsibility">{{Translate::get("Responsibility",$lang)}} <span class="pi-text-red">*</span></label>
                                            <input type="text" class="form-control small_text" ng-model="pbs.responsibility"/>
                                        </div>

                                        <div class="form-group">
                                            <label for="name">{{Translate::get("Designation",$lang)}}</label>
                                            <input type="text" maxlength="40" class="form-control small_text" ng-model="pbs.designation"/>
                                        </div>


                                        <div class="form-group">
                                            <label for="url">{{Translate::get("Url",$lang)}}</label>
                                            <input type="text" class="form-control small_text" ng-model="pbs.url"/>
                                        </div>


                                        <div class="form-group">
                                            <label for="address">{{Translate::get("Address",$lang)}} <span class="pi-text-red">*</span></label>
                                            <textarea class="form-control small_text" maxlength="250" ng-model="pbs.address"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn pi-btn-green" value="{{Translate::get('Save',$lang)}}"/>
                                            <input type="button" class="btn pi-btn-orange" ng-click="pbsEditable=0" value="{{Translate::get('Cancel')}}"/>
                                        </div>
                                    </div>
                                    <hr class="clearfix"/>


                                </form>
                                <table class="pi-table pi-table-complex pi-table-hovered pi-round pi-table-shadow pi-table-all-borders">
                                    <thead>
                                    <tr>
                                        <th colspan="2">{{Translate::get("Organization name",$lang)}}</th>
                                        <th>{{Translate::get("Designation",$lang)}}</th>
                                        <th>{{Translate::get("Organization type",$lang)}}</th>
                                        <th>{{Translate::get("Responsibility",$lang)}}</th>
                                        <th>{{Translate::get("Action",$lang)}}</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="Pb in Pbs">
                                        <td colspan="2">@{{Pb.org_name}}</td>
                                        <td><small style="display:block;width:100px;word-wrap:break-word;"><em>@{{Pb.designation}}</em></small></td>
                                        <td>@{{Pb.org_type}}</td>
                                        <td>@{{Pb.responsibility}}</td>

                                        <td>
                                            <a href="" title="Edit" ng-click="openUpdatePbsFrm($index,Pb.id)"><i class="icon-pencil"></i></a>
                                            <a href="" title="Remove" ng-click="removePbs($index,Pb.id)"><i class="icon-trash"></i></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr class="pi-divider-gap-50">
                    </div>
                    @endif
                <!-- End tab content -->



                        
                        <!-- End col 6 -->


                    </div>
                    <!-- End row -->

                <!-- End tab content -->

            </div>
        </div>
        <!-- End tabs -->
        @else
        <div ng-model="errorMsg" ng-if="errorMsg" class="pi-alert-danger">
            <!--<button data-dismiss="alert" class="pi-close" type="button">
                <i class="icon-cancel"></i>
            </button>-->
            <p>
                <strong><a id="top">Warning!</a></strong> <ul><li ng-repeat="em in errorMsg">@{{em[0]}}</li></ul>
            </p>
        </div>
        <div ng-model="successMsg" ng-if="successMsg" class="pi-alert-success">
            <button data-dismiss="alert" class="pi-close" type="button">
                <i class="icon-cancel"></i>
            </button>
            <p ng-repeat="sm in successMsg">
                @{{sm[0]}}
            </p>
        </div>
        <tabset>
            <tab heading="@{{tabs[0].title}}" ng-model="tabs[0]" active="tabs[0].active" disabled="tabs[0].disabled">
                <div class="pi-margin-top-15">
                    <h3>Basic Information</h3>
                    <form id="freelancerFrm" ng-submit="nextForm()">
                                <div class="form-group">
                                    <label class="col-lg-3">{{Translate::get("Profile Title",$lang)}} :</label>
                                    <div >
                                        <input type="text" ng-model="form.basic.profile_title" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3">{{Translate::get("First name",$lang)}} :</label>
                                    <div >
                                        <input type="text" ng-model="form.basic.first_name" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3">{{Translate::get("Last Name",$lang)}} :</label>
                                    <div class="">
                                        <input type="text" ng-model="form.basic.last_name" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3">{{Translate::get("E-mail",$lang)}} :</label>
                                    <div class="">
                                        <input type="text" readonly ng-model="form.basic.email" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3">{{Translate::get("Overview",$lang)}} :</label>
                                    <div class="">
                                        <textarea class="form-control" ng-model="form.basic.overview"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn pi-btn-base" value="Confirm And Next"/>
                                </div>
                    </form>
                </div>
            </tab>
            <tab heading="@{{tabs[1].title}}" ng-model="tabs[1]" active="tabs[1].active" disabled="tabs[1].disabled">
                <div class="pi-margin-top-15">
                    <h3>{{Translate::get("Contact Information",$lang)}} </h3>


                    <form id="freelancerFrm" ng-submit="confirmAndSave()">
                        <div class="form-group">
                            <label class="col-lg-3">{{Translate::get("Address",$lang)}}</label>
                            <div >
                                <textarea ng-model="form.contact.address" class="form-control "></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3">{{Translate::get("Phone",$lang)}}</label>
                            <div >
                                <input type="text" ng-model="form.contact.phone" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3">{{Translate::get("Mobile",$lang)}}</label>
                            <div class="">
                                <input type="text" ng-model="form.contact.mobile" class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn pi-btn-base" value="{{Translate::get('Confirm And Save',$lang)}}"/>
                        </div>
                    </form>
                </div>
            </tab>
        </tabset>

        @endif
    </div>
</div>

<!-- - - - - - - - - - END SECTION - - - - - - - - - -->

<!-- - - - - - - - - - SECTION - - - - - - - - - -->
<div class="pi-section-w pi-shadow-inside-top pi-section-base">
    <div class="pi-texture" style="background: url({{$theme}}img/hexagon.png) repeat;"></div>
    <div class="pi-section pi-padding-top-60 pi-padding-bottom-40 pi-text-center">

        <p class="lead-30">
            <span class="pi-text-white">Have a project with us? <span class="pi-weight-400">Feel free.</span></span>

            <a href="#" class="btn pi-btn-base-2 pi-btn-big" style="margin-left: 25px;">
                <i class="icon-mail pi-icon-left"></i> Get in Touch
            </a>

        </p>

    </div>
</div>

<!-- - - - - - - - - - END SECTION - - - - - - - - - --></div>

@stop