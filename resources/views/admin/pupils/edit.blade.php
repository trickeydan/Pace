@extends('layouts.app')
@section('title','Editing Pupil')
@section('content')
    <a href="{{route('admin.pupils.index')}}">Back to all pupils</a>
    <h2 class="text-center">Editing Pupil: {{$pupil->name}}</h2>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::model($pupil, array('route' => array('admin.pupils.update', $pupil->email))) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name',null,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email', 'Email') !!}
        {!! Form::email('email',null,['class' => 'form-control']) !!}
    </div>
    {!! Form::submit('Update Pupil',['class' => 'btn btn-lg btn-success']) !!}

    {!! Form::close() !!}
@endsection
