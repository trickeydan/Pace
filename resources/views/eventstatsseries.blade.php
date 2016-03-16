@extends('layouts.app')
@section('title',$series->name)
@section('content')
    <a href="{{route('eventstats')}}">Back to all competitions</a>
    <h2 class="text-center">{{$series->name}}</h2>
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
    <h3 class="text-center">Events</h3>
    <table class="table table-striped table-responsive">
        <thead>
            <tr>
                <td>Name</td>
                <td>Winner</td>
                <td>Options</td>
            </tr>
        </thead>
        <tbody>
            @foreach($series->events as $event)
                <tr>
                    <td>{{$event->name}}</td>
                    <td>{{$event->winner()}}</td>
                    <td><a href="{{route('eventstats.series.event',$event->id)}}">Details</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
