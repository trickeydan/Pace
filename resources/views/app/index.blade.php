@extends('app.layouts.app')

@section('title',$user->getName())
@section('content')
    <div class="container">
        <h1 class="text-center">Hello, {{$user->getName()}} <small>{{$pupil->tutorgroup->house}}/{{$pupil->tutorgroup}} </small></h1></div>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    @include('app.partials.pupilstats')
                </div>
                <div class="col-md-6">
                    <div class="well">
                        <h1 class="text-center">My Tutorgroup</h1>
                        <ul class="list-group">
                            <li class="list-group-item"><span>Total number of points: {{$pupil->tutorgroup->currPoints}}</span></li>
                            <li class="list-group-item"><span>Number of points this week: {{$pupil->tutorgroup->pointsThisWeek()}}</span></li>
                            <li class="list-group-item"><span>Position in year: {{$pupil->tutorgroup->getOrdinalPosition()}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @include('app.partials.pupilpoints')

    </div>
@endsection