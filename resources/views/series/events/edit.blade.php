@extends('layouts.app')
@section('title',$event->series->name)
@section('content')
    <a href="{{route('eventstats.series',$event->series->id)}}">Back to {{$event->series->name}}</a>
    <h2 class="text-center">Editing : {{$event->name}}</h2>
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
    {!! Form::open(array('route' => ['event.update',$series->id,$event->id],'role' => 'form')) !!}
    <table class="table table-striped table-responsive">
        <thead>
        <tr>
            <td>Participant</td>
            @if(!$series->binary)
                <td>No of Points</td>
            @else
                <td>Winner?(Will draw if multiple selected)</td>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($event->eventpoints as $ep)
            <tr>
                <td>{{$ep->participable->name}}</td>
                @if(!$series->binary)
                    <td>{!! Form::number('points'  . $ep->participable->id,$ep->amount,['class' => 'form-control']) !!}</td>
                @else
                    <td>{!! Form::checkbox('binary'  . $ep->participable->id,1,$ep->amount,['class' => 'form-control']) !!}</td>
                @endif

            </tr>
        @endforeach
        </tbody>
    </table>
    <br/>
    {!! Form::submit('Update Event',['class' => 'btn btn-lg btn-success']) !!}
    {!! Form::close() !!}
@endsection
