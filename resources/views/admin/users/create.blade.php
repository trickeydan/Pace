@extends('layouts.app')
@section('title','Create Admin')
@section('content')
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
    <a href="{{route('admin.users.index')}}"><p class="btn btn-lg btn-danger">Back to all admins</p></a>
    {!! Form::submit('Create Admin',['class' => 'btn btn-lg btn-success']) !!}

    {!! Form::close() !!}
@endsection