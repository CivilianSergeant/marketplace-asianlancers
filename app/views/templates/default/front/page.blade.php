@extends('templates.default.default')


@section('content')
<div class="pi-section-w pi-section-white piICheck piStylishSelect" style="background: #f4f6f6;">
    <div class="pi-section pi-padding-bottom-60">

        <div class="row">
            <h1 class="pi-uppercase pi-weight-700 pi-has-border pi-has-tall-border pi-has-short-border">
                {{$page->title}}
            </h1>
            <div class="page-content">
            	{{$page->description}}
        	</div>
        </div>

@stop