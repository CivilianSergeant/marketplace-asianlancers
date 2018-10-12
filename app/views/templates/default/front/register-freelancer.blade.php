@extends('templates.default.default')

@section('content')

{{Form::Open(array(
'url'=>'home/sign-up-freelancer',
'id'=>'register_form',
'method'=>'post',
'data-bv-message'=>"This value is not valid",
'data-bv-feedbackicons-valid'=>"glyphicon glyphicon-ok",
'data-bv-feedbackicons-invalid'=>"glyphicon glyphicon-remove",
'data-bv-feedbackicons-validating'=>"glyphicon glyphicon-refresh",
)
)}}
<div class="pi-section-w pi-section-white piICheck piStylishSelect" data-ng-app="" style="background: #f4f6f6;">
    <div class="pi-section pi-padding-bottom-60">

        <div class="pi-text-center pi-margin-bottom-50">
            <h1 class="pi-uppercase pi-weight-700 pi-has-border pi-has-tall-border pi-has-short-border">
                {{Translate::get("Sign Up",$lang)}}
            </h1>
            @if(is_array($valid_msg) && !empty($valid_msg))
                @foreach($valid_msg as $field)
                    @foreach($field as $msg)
                        <div class="pi-alert-danger fade in">
                            <button data-dismiss="alert" class="pi-close" type="button">
                                <i class="icon-cancel"></i>
                            </button>
                            <p>
                                {{$msg}}
                            </p>
                        </div>
                    @endforeach
                @endforeach
            @endif
            @if(!empty($success_msg))
                <div class="pi-alert-success fade in">
                    <button data-dismiss="alert" class="pi-close" type="button">
                        <i class="icon-cancel"></i>
                    </button>
                    <p>
                        {{$success_msg}}
                    </p>
                </div>
            @endif
        </div>

        <!-- Row -->
        <div class="pi-row">

            <!-- Col 4 -->
            <div class="pi-col-md-4 pi-col-md-offset-4 pi-col-sm-6 pi-col-sm-offset-3 pi-col-xs-8 pi-col-xs-offset-2">


                <!-- Box -->
                <div class="pi-box pi-round pi-shadow-15">
                    <input type="hidden" name="user_type">
                    <!-- First name form -->
                    <div class="form-group">
                        <div class="pi-input-with-icon">
                            <div class="pi-input-icon"><i class="icon-user"></i></div>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name"
                                   data-bv-notempty="true"
                                   data-bv-notempty-message="The first name is required and cannot be empty"

                                   data-bv-regexp="true"
                                   data-bv-regexp-regexp="^([a-zA-Z]|\s|[0-9])*$"
                                   data-bv-regexp-message="The first name can only consist of alphabetical"
                                >
                        </div>
                    </div>
                    <!-- End first name form -->

                    <!-- Last name form -->
                    <div class="form-group">
                        <div class="pi-input-with-icon">
                            <div class="pi-input-icon"><i class="icon-user"></i></div>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name"
                                   data-bv-notempty="true"
                                   data-bv-notempty-message="The last name is required and cannot be empty"

                                   data-bv-regexp="true"
                                   data-bv-regexp-regexp="^([a-zA-Z]|\s|[0-9])*$"
                                   data-bv-regexp-message="The last name can only consist of alphabetical"
                                >
                        </div>
                    </div>
                    <!-- End last name form -->

                    <!-- Email form -->
                    <div class="form-group">
                        <div class="pi-input-with-icon">
                            <div class="pi-input-icon"><i class="icon-mail"></i></div>
                            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail"
                                   data-bv-notempty="true"
                                   data-bv-notempty-message="The E-mail is required and cannot be empty"

                                   data-bv-emailaddress="true"
                                   data-bv-emailaddress-message="The input is not a valid email address"

                                >
                        </div>
                    </div>
                    <!-- End email form -->

                    <!-- Password form -->
                    <div class="form-group">
                        <div class="pi-input-with-icon">
                            <div class="pi-input-icon"><i class="icon-lock"></i></div>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password"

                                   data-bv-notempty="true"
                                   data-bv-notempty-message="The Password is required and cannot be empty"

                                   data-bv-identical="true"
                                   data-bv-identical-field="confirm_password"
                                   data-bv-identical-message="The password and its confirm are not the same"
                                >
                        </div>
                    </div>
                    <!-- End password form -->

                    <!-- Password form -->
                    <div class="form-group">
                        <div class="pi-input-with-icon">
                            <div class="pi-input-icon"><i class="icon-lock"></i></div>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password"
                                   data-bv-notempty="true"
                                   data-bv-notempty-message="The Confirm Password is required and cannot be empty"
                                   data-bv-identical="true"
                                   data-bv-identical-field="password"
                                   data-bv-identical-message="The password and its confirm are not the same"
                                >
                        </div>
                    </div>
                    <!-- End password form -->

                    <!-- Checkbox -->
                    <div class="checkbox pi-margin-bottom-20">
                        <label class="pi-small-text">
                            <input type="checkbox" id="agency" name="agency" value="" data-ng-init="CompanyHide = 0" data-ng-model="CompanyHide" data-ng-checked="CompanyHide" >Signup as an Agency
                        </label>
                    </div>

                    <!-- company name-->
                    <div class="form-group" ng-hide="!CompanyHide">
                        <div class="pi-input-with-icon">
                            <div class="pi-input-icon"><i class="home"></i></div>
                            <input type="text" class="form-control" id="email" name="company-name" placeholder="Company Name" />
                        </div>
                    </div>
                    <!-- company name form -->

                    <div class="checkbox pi-margin-bottom-20">
                        <label class="pi-small-text">
                            <input type="checkbox" id="agreement" name="agreement" checked="checked" data-ng-init="checked = 1" data-ng-model="checked" data-ng-checked="checked">I agree to the <a href="#">Terms of Use</a>
                        </label>
                    </div>
                    <!-- End checkbox -->

                    <!-- Submit button -->
                    <p>
                        <button type="submit" data-ng-disabled="!checked" class="btn pi-btn-wide pi-weight-600 pi-btn-blue">
                            Create An Account
                        </button>
                    </p>
                    <!-- End submit button -->

                </div>
                <!-- End box -->


                <p class="pi-text-center">
                    Have an Account? <a href="{{url('home/login')}}" class="pi-weight-600">Sign In</a>
                </p>

            </div>
            <!-- End col 4 -->

        </div>
        <!-- End row -->

    </div>
</div>


{{Form::Close()}}


<script type="text/javascript">

    jQuery(document).ready(function() {
        jQuery('#register_form').bootstrapValidator();
        //jQuery('.pi-uppercase').remove();
    });


</script>

@stop