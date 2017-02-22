@extends('app.layouts.app')

@section('title','Teacher Account Setup')
@section('content')
    <div class="container">
        <h1 class="text-center">Teacher Account Setup</h1>
    </div>
    <div class="container">
        <p class="text-center">Welcome to your PACE Points Account. To get started, you will need to do a couple of things. <br/>Do not leave the site after you have started the setup process, it could make your account inaccessible.</p>
        <div class="well">
            <h3>Security</h3>
            <p>Firstly, to ensure account security, please change your password:</p>
            @include('app.partials.forms.changepassword')
        </div>
    </div>
@endsection