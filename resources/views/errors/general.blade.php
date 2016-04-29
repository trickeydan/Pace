@extends('layouts.loginpage')
@section('title','Fatal Error')
@section('content')
    <div class="form-top">
        <div class="form-top-left">
            <h3>KLB Pace Points</h3>
            <p>A <strong>Fatal</strong> Error Occurred. Do <b>not</b> refresh your page.</p>
            <p>Please report to the System Administrator immediately.</p>
        </div>
        <div class="form-top-right">
            <img class="img-responsive logo-img" src="{{asset('assets/img/logo.png')}}">
        </div>
    </div>
    <div class="form-bottom">
        @include('layouts.footer')
    </div>
@endsection