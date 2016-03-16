@extends('layouts.loginpage')
@section('title','Fatal Error')
@section('content')
    <div class="form-top">
        <div class="form-top-left">
            <h3>KLB Pace Points</h3>
            <p>A Fatal Error Occurred.</p>
            <p>Please report to the System Administrator immediately.</p>
        </div>
        <div class="form-top-right">
            <img class="img-responsive logo-img" src="{{asset('assets/img/logo.png')}}">
        </div>
    </div>
    <div class="form-bottom">
        <h6 class="text-muted text-center"><small>&copy;<?php echo date('Y');?> D.Trickey</small></h6>
    </div>
@endsection