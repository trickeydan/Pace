@extends('layouts.app')
@section('title','Change Password')
@section('content')
    {!! Form::open(array('route' => 'admin.users.passwordStore','role' => 'form')) !!}
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1 class="text-center">Change Password</h1>
    <div class="form-group">
        {!! Form::label('old_password', 'Old Password') !!}
        {!! Form::password('old_password',['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password', 'New Password') !!}
        {!! Form::password('password',['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password_confirmation', 'Confirm New Password') !!}
        {!! Form::password('password_confirmation',['class' => 'form-control']) !!}
    </div>
    {!! Form::submit('Change Password',['class' => 'btn btn-lg btn-success']) !!}

    {!! Form::close() !!}
@endsection