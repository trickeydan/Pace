@extends('layouts.loginpage')
@section('title','Error 404')
@section('content')
    <div class="form-top">
        <div class="form-top-left">
            <h3>KLB Pace Points</h3>
            <p>Error 404 Page Not Found</p>
        </div>
        <div class="form-top-right">
            <img class="img-responsive logo-img" src="assets/img/logo.png">
        </div>
    </div>
    <div class="form-bottom">
        <p class="text-center"><a class="btn btn-lg btn-danger" href="{{route('login')}}">Login Page</a></p>
        <h6 class="text-muted text-center"><small>&copy;<?php echo date('Y');?> D.Trickey</small></h6>
    </div>
@endsection