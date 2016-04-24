@extends('layouts.app')
@section('title','Create User')
@section('content')
    <a href="{{route('admin.users.index')}}">Back to Users</a>
    <h2 class="text-center">Create User</h2>
    {!! Form::open(array('route' => 'admin.users.store','role' => 'form')) !!}
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
        {!! Form::label('email', 'Email') !!}
        {!! Form::text('email',null,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name',null,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password', 'Password') !!}
        {!! Form::password('password',['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password_confirmation', 'Confirm Password') !!}
        {!! Form::password('password_confirmation',['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('account', 'Account Type') !!}
        {!! Form::select('account',['teacher' => 'Teacher','admin' => 'Administrator'],null,['class' => 'form-control'])  !!}
    </div>
    {!! Form::submit('Create User',['class' => 'btn btn-lg btn-success']) !!}

    {!! Form::close() !!}
@endsection