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
            {!! Form::open(['role' => 'form', 'method' => 'post']) !!}
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                {!! Form::label('oldpassword', 'Current Password') !!}
                {!! Form::password('oldpassword',['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password', 'New Password') !!}
                {!! Form::password('password',['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password_confirmation', 'Confirm New Password') !!}
                {!! Form::password('password_confirmation',['class' => 'form-control']) !!}
            </div>

            {!! Form::submit('Next',['class' => 'btn btn-success']) !!}


            {!! Form::close() !!}
        </div>
    </div>


@endsection