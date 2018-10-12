@extends('templates.freelancer.freelancer')

@section('content')

{{Helpers::showMessage()}}
    {{Form::Open(array('url'=>'home/login','class'=>'abc s','method' => 'post'))}}
<div class="pi-section-w pi-section-white piICheck piStylishSelect" style="background: #f4f6f6;">
    <div class="pi-section pi-padding-bottom-60">

        <div class="pi-text-center pi-margin-bottom-50">
            <h1 class="pi-uppercase pi-weight-700 pi-has-border pi-has-tall-border pi-has-short-border">
                {{Translate::get("Sign In",$lang)}}
            </h1>
            @if(!empty($error_msg))
            <div class="pi-alert-danger fade in">
                <button data-dismiss="alert" class="pi-close" type="button">
                    <i class="icon-cancel"></i>
                </button>
                <p>
                    {{$error_msg}}
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

                    <!-- Email form -->
                    <div class="form-group">
                        <div class="pi-input-with-icon">
                            <div class="pi-input-icon"><i class="icon-mail"></i></div>
                            <input type="email" class="form-control" id="exampleInputEmail" name="email" placeholder="{{Translate::get("E-mail",$lang)}}">
                        </div>
                    </div>
                    <!-- End email form -->

                    <!-- Password form -->
                    <div class="form-group">
                        <div class="pi-input-with-icon">
                            <div class="pi-input-icon"><i class="icon-lock"></i></div>
                            <input type="password" class="form-control" id="exampleInputPassword" name="password" placeholder="{{Translate::get("Password",$lang)}}">
                        </div>
                    </div>
                    <!-- End password form -->

                    <p class="pi-pull-right pi-small-text" style="position: relative; z-index: 1;">
                        <a href="{{url('home/forget')}}">
                            {{Translate::get("Forgot password?",$lang)}}
                        </a>
                    </p>

                    <!-- Checkbox -->
                    <div class="checkbox">
                        <label class="pi-small-text pi-no-padding" >
                            <input type="checkbox" name="remember_me">{{Translate::get("Remember me",$lang)}}
                        </label>
                    </div>
                    <!-- End checkbox -->

                    <!-- Submit button -->
                    <p>
                        <button type="submit" class="btn pi-btn-base pi-btn-wide pi-weight-600">
                            {{Translate::get("Sign In",$lang)}}
                        </button>
                    </p>
                    <!-- End submit button -->

                </div>
                <!-- End box -->

                <p class="pi-text-center">
                    {{Translate::get("Don't have Account?",$lang)}} <a href="{{url('home/sign-up-freelancer')}}" class="pi-weight-600">{{Translate::get("Sign Up",$lang)}}</a>
                </p>

            </div>
            <!-- End col 4 -->

        </div>
        <!-- End row -->

    </div>
</div>
    {{Form::Close()}}
@stop
