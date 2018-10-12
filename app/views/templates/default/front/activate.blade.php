@extends('templates.default.default')

@section('content')


<div class="pi-section-w pi-section-white piICheck piStylishSelect" style="background: #f4f6f6;">
    <div class="pi-section pi-padding-bottom-60">

        <div class="pi-text-center pi-margin-bottom-50">
            <h1 class="pi-uppercase pi-weight-700 pi-has-border pi-has-tall-border pi-has-short-border">
                Active Account
            </h1>
        </div>

        <!-- Row -->
        <div class="pi-row">

            <!-- Col 4 -->
            @if(!empty($error_msg))
                <div class="pi-col-md-8 pi-col-md-offset-2">
                    <div class="pi-alert-danger fade in">
                        <p>
                            {{$error_msg}}
                        </p>
                    </div>
                </div>

            @endif
            <!-- End col 4 -->
            <!-- Col 4 -->
            @if(!empty($success_msg))
            <div class="pi-col-md-8 pi-col-md-offset-2">
                <div class="pi-alert-info fade in">
                    <p>
                        {{$success_msg}}
                    </p>
                </div>
            </div>

            <div class="clearfix">
            </div>
            <div class="pi-col-md-8 pi-col-md-offset-5">
                <a class="btn pi-btn-blue pi-btn-small" href="{{url('home/login')}}">
                    Login
                </a>
            </div>

            @endif
            <!-- End col 4 -->

        </div>
        <!-- End row -->

    </div>
</div>

@stop