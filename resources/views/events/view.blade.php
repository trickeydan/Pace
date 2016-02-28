@extends('layouts.app')
@section('title',$event->name)
@section('content')
    <a href="{{route('events.index')}}">Back to all events</a>
    <h2 class="text-center">Event: {{$event->name}}</h2>
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
    <h3 class="text-center">Sub-Events</h3>
    <p class="text-right">
        <a href="{{route('events.create')}}" class="btn">New Sub-Event</a>&nbsp;&nbsp;
    </p>
    <table class="table table-striped table-responsive">
        <thead>
            <tr>
                <td>Name</td>
                <td>Winner</td>
                <td>Options</td>
            </tr>
        </thead>
        <tbody>
            @foreach($event->events as $subevent)
                <tr>
                    <td>{{$subevent->name}}</td>
                    <td>{{$subevent->winner()}}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
