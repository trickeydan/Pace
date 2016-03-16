@extends('layouts.app')
@section('title',$event->series->name)
@section('content')
    <a href="{{route('eventstats.series',$event->series->id)}}">Back to {{$event->series->name}}</a>
    <h2 class="text-center">{{$event->series->name}} : {{$event->name}}</h2>
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
    <h3 class="text-center">Partipants</h3>
    <table class="table table-striped table-responsive">
        <thead>
        <tr>
            <td>Name</td>
            @if(!$event->series->binary)
                <td>Points</td>
            @else
                <td>Winner/Loser</td>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($event->eventpoints()->orderBy('amount','DESC')->get() as $points)
            <tr>
                <td>{{$points->participable->name}}</td>
                @if(!$event->series->binary)
                    <td>{{$points->amount}}</td>
                @else
                    @if($points->amount == 1)
                        Winner
                    @else
                        Loser
                    @endif
                @endif

            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
