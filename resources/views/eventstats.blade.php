@extends('layouts.app')
@section('title','Competitions')
@section('content')
    <h2 class="text-center">Competitions</h2>
    <table class="table table-striped table-responsive">
        <thead>
        <tr>
            <td>Name</td>
            <td>No of Events</td>
            <td>Current Winner</td>
            <td>Options</td>
        </tr>
        </thead>
        <tbody>
        @foreach($series as $serie)
            <tr>
                <td>{{$serie->name}}</td>
                <td>{{$serie->events()->count()}}</td>
                <td>{{$serie->winner()}}</td>
                <td><a href="{{route('eventstats.series',$serie->id)}}">Details</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <nav class="text-center">
        {{$series->render()}}
    </nav>
@endsection
