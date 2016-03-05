@extends('layouts.app')
@section('title','Events Index')
@section('content')
    <h2 class="text-center">Events</h2>
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
    <h3>What is an event?</h3>
    <p>An event is a group of 'subevents' that allow you to assign extra points to Tutor groups, houses or a group of pupils. You can also use them without assigning house points.</p>
    <h3>What is an event used for?</h3>
    <p>Example uses of events include Tutor challenges and Inter-house competitions and Inter-house sports matches.</p>
    <p class="text-right">
        <a href="{{route('events.create')}}" class="btn">New Event</a>&nbsp;&nbsp;
    </p>
    <table class="table table-striped table-responsive">
        <thead>
            <tr>
                <td>Name</td>
                <td>No of Subevents</td>
                <td>Options</td>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
                <tr>
                    <td>{{$event->name}}</td>
                    <td>{{$event->events()->count()}}</td>
                    <td><a href="{{route('events.view',$event->id)}}">View Subevents</a>&nbsp;&nbsp;&nbsp;<a href="{{route('events.sub.create',$event->id)}}">New Subevent</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <nav class="text-center">
        {{$events->render()}}
    </nav>
@endsection
