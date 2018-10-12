@extends('templates.default.default')

@section('content')


<script type="text/javascript">
    var token = "<?php echo Form::tokenCode(); ?>"
    var pageName = 'create-default-profile';
</script>
<script type="text/javascript" src="{{$theme}}js/custom/common/common.js"></script>

<div ng-app="frontApp" data-ng-controller="frontController"
     class="pi-section-w pi-section-white pi-slider-enabled piSocials" ng-cloak>
    <div class="pi-tabs-vertical pi-responsive-sm">
        <div class="pi-tabs-content-transparent ">
            <div class="pi-col-lg-4 pi-col-md-4 pi-col-md-offset-4 pi-col-sm-6 pi-col-sm-offset-3 pi-col-xs-8 pi-col-xs-offset-2">


            <div class="pi-row col-lg-12">
                <div class="pi-alert-danger" ng-show="errorMsg">
                    <button data-dismiss="alert" class="pi-close" type="button">
                        <i class="icon-cancel"></i>
                    </button>

                    <strong><a id="top">@{{errorMsg}}</a></strong>

                </div>
                <div ng-show="successMsg" class="pi-alert-success pi-padding-bottom-20">
                    <button data-dismiss="alert" class="pi-close" type="button">
                        <i class="icon-cancel"></i>
                    </button>
                    <strong><a id="top">@{{successMsg}}</a></strong>

                </div>

            </div>

            <hr class="pi-divider-gap-10">
                <h3>Provide your Email</h3>

                <form ng-submit="sendEmail()" method="post">
                    <div class="form-group">
                        <input type="email" ng-model="form.email" placeholder="Email" class="form-control">
                    </div>

                    <p>
                        <button type="submit" ng-disabled="disableButton"
                                class="btn pi-btn-base pi-btn-big pi-uppercase pi-weight-700 pi-letter-spacing">
                            <i class="icon-check pi-icon-left"></i> Reset Password
                        </button>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

@stop
