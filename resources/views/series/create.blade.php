@extends('layouts.app')
@section('title','Create Event Series')
@section('content')
    <a href="{{route('series.index')}}">Back to all event series'</a>
    <h2 class="text-center">Create Event Series</h2>
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
    <p class="text-center">Please ensure that you want to make an event before doing so. Also, please be aware that event results are visible to <strong>all</strong> pupils.</p>
    <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name',null,['class' => 'form-control']) !!}
    </div>


    {!! Form::submit('Create Event Series',['class' => 'btn btn-lg btn-success']) !!}

    {!! Form::close() !!}
@endsection
