@extends('layouts.app')
@section('title','Creating Pupil')
@section('content')
    <a href="{{route('admin.pupils.index')}}">Back to all pupils</a>
    <h2 class="text-center">Creating Pupil</h2>
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
    {!! Form::open(array('route' => 'admin.pupils.store','role' => 'form')) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name',null,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email', 'Email') !!}
        {!! Form::email('email',null,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('adno', 'Adno (No Zeros in front please!)') !!}
        {!! Form::text('adno',null,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('tutorgroup', 'Tutor Group') !!}
        {!!Form::select('tutorgroup', $tgs)!!}
    </div>
    <div class="form-group">
        {!! Form::label('house', 'House') !!}
        {!!Form::select('house', $houses)!!}
    </div>


    {!! Form::submit('Create Pupil',['class' => 'btn btn-lg btn-success']) !!}

    {!! Form::close() !!}
@endsection
