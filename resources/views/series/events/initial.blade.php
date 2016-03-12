@extends('layouts.app')
@section('title','Create Event')
@section('content')
    <a href="{{route('series.view',$series->id)}}">Back to {{$series->name}}</a>
    <h2 class="text-center">Create Event in {{$series->name}}</h2>
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
    {!! Form::open(array('route' => 'series.store','role' => 'form')) !!}
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name',null,['class' => 'form-control']) !!}
    {!! Form::label('amount', 'Number of Participants') !!}
    {!! Form::number('amount',4,['class' => 'form-control']) !!}
    <br/>
    {!! Form::submit('Create Event',['class' => 'btn btn-lg btn-success']) !!}

    {!! Form::close() !!}
@endsection