@extends('layouts.app')
@section('title','Events Series Index')
@section('content')
    <h2 class="text-center">Events Series</h2>
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
    <h3>What is an event series?</h3>
    <p>An event series is a group of events that allow you to assign extra points to Tutor groups, houses or a group of pupils. You can also use them without assigning house points.</p>
    <h3>What is an event series used for?</h3>
    <p>Example uses of events include Tutor challenges, Inter-house competitions and Inter-house sports matches.</p>
    <p class="text-right">
        <a href="{{route('series.create')}}" class="btn">New Series</a>&nbsp;&nbsp;
        <a href="{{route('series.cache')}}" class="btn">Update Cache</a>&nbsp;&nbsp;
    </p>
    <table class="table table-striped table-responsive">
        <thead>
            <tr>
                <td>Name</td>
                <td>No of Events</td>
                <td>Awarding To</td>
                <td>Winner</td>
                <td>Options</td>
            </tr>
        </thead>
        <tbody>
            @foreach($series as $serie)
                <tr>
                    <td>{{$serie->name}}</td>
                    <td>{{$serie->events()->count()}}</td>
                    <td>{{$serie->awardToNice()}}</td>
                    <td>{{$serie->winner()}}</td>
                    <td><a href="{{route('series.view',$serie->id)}}">View Events</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <nav class="text-center">
        {{$series->render()}}
    </nav>
@endsection
