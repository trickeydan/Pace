@extends('layouts.app')
@section('title',$series->name)
@section('content')
    <a href="{{route('series.index')}}">Back to all event series</a>
    <h2 class="text-center">Event Series: {{$series->name}}</h2>
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
    <h3 class="text-center">Information</h3>
    <p>This event awards to {{$series->awardToNice()}}.</p>
    @if($series->affectTotals)
        <p>This event adds points to the totals for the house.</p>
    @else
        <p>This event does not add points to the totals for the house.</p>
    @endif
    @if($series->binary)
        <p>This event uses a Winner/Loser style system.</p>
    @else
        <p>This event uses points.</p>
    @endif
    <p> {{$series->winner()}} is currently winning this series.</p>
    <h3 class="text-center">Events</h3>
    <p class="text-right">
        <a href="{{route('event.initial',$series->id)}}" class="btn">New Event</a>&nbsp;&nbsp;
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
            @foreach($series->events as $event)
                <tr>
                    <td>{{$event->name}}</td>
                    <td>{{$event->winner()}}</td>
                    <td><a href="{{route('event.edit',[$series->id,$event->id])}}">Edit</a>&nbsp;&nbsp;<a href="">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
