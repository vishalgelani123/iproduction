@extends('layouts.app')

@section('script_top')
<meta name="csrf-token" content="{{ csrf_token() }}">
@php
$setting = getSettingsInfo();
$tax_setting = getTaxInfo();
$baseURL = getBaseURL();
@endphp
@endsection

@section('content')
<section class="main-content-wrapper">
    <section class="content-header">
        <h3 class="top-left-header">{{isset($title) && $title?$title:''}}</h3>
    </section>

    <div class="box-wrapper">
        <!-- general form elements -->
        <div class="table-box">
            <!-- form start -->
            {{Form::model($obj,['route'=>['attendance.update',$obj->id],'method'=>'put'])}}
                @include('pages/attendance/_form')
            {!! Form::close() !!}
        </div>
    </div>
</section>

@endsection
@section('script')
<script src="{!! $baseURL.'assets/plugins/local/jquery.timepicker.min.js'!!}"></script>
<link rel="stylesheet" href="{!! $baseURL.'assets/plugins/local/jquery.timepicker.min.css'!!}">
<script src="{!! $baseURL.'frequent_changing/js/attendance.js'!!}"></script>
@endsection