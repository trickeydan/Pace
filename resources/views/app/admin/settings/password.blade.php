@extends('app.layouts.app')

@section('title','Change Password')
@section('content')
    <div class="container">
        <h1 class="text-center">Change Password</h1>
    </div>
    <div class="container">
        <div class="well">
            <p>Please fill in the form below to change your password.</p>
            @include('app.partials.forms.changepassword')
        </div>
    </div>
@endsection