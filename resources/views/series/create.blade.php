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
    <p class="text-center">Please ensure that you want to make an event series before doing so. Also, please be aware that event results are visible to <strong>all</strong> pupils.</p>
    <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name',null,['class' => 'form-control']) !!}

        {!! Form::label('awardedTo', 'Who are the points being awarded to?') !!}
        {!! Form::select('awardedTo',['user' => 'Pupils','tutorgroup' => 'Tutor Groups','house' => 'Houses'],null,['class' => 'form-control']) !!}

        {!! Form::label('binary', 'Does this competition use points or winner? Tick for winner, leave blank for points') !!}
        {!! Form::checkbox('binary',1,0,['class' => 'form-control']) !!}

        {!! Form::label('affectTotals', 'Do the points from this competition contribute to the house totals? Must be unticked for winner configuration') !!}
        {!! Form::checkbox('affectTotals',1,0,['class' => 'form-control']) !!}
    </div>


    {!! Form::submit('Create Event Series',['class' => 'btn btn-lg btn-success']) !!}

    {!! Form::close() !!}
@endsection
