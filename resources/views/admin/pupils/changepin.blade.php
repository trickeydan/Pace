@extends('layouts.app')
@section('title','Pupils Index')
@section('content')
    <h2 class="text-center">Changing Pin: {{$pupil->name}}</h2>
    <p>Please note, due to the current setup of the system, this will be reset when the data is updated.</p>
    {!! Form::open(array('route' => ['admin.pupils.changepin',$pupil->username],'role' => 'form', 'method' => 'post')) !!}
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <p>Please enter the new pin below and confirm it</p>
    <div class="form-group">
        {!! Form::label('pin', 'New Pin') !!}
        {!! Form::password('pin',['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('pin_confirmation', 'Confirm New Pin') !!}
        {!! Form::password('pin_confirmation',['class' => 'form-control']) !!}
    </div>


    <a href="{{route('admin.pupils.index')}}"><p class="btn btn-lg btn-danger">Back to all pupils</p></a>
    {!! Form::submit('Change Pin',['class' => 'btn btn-lg btn-success']) !!}

    {!! Form::close() !!}
@endsection
