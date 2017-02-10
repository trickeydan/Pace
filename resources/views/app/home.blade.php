@extends('app.layouts.app')

@section('title',$user->getName())
@section('content')
    <div class="container">
        <h1 class="text-center">Hello, {{$user->getName()}} <small>{{$pupil->tutorgroup->house}}/{{$pupil->tutorgroup}} </small></h1></div>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="well">
                        <h1 class="text-center">Statistics </h1>
                        <ul class="list-group">
                            <li class="list-group-item"><span>Total number of points: {{$pupil->currPoints}}</span></li>
                            <li class="list-group-item"><span>Number of points this week: {{$pupil->pointsThisWeek()}}</span></li>
                            <li class="list-group-item"><span>Best Category: {{$pupil->bestCategory()}}</span></li>
                        </ul>
                    </div>
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
        <div class="container">
            <div class="well">
                <h1 class="text-center">My Points</h1>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date Awarded</th>
                                <th>Awarded by</th>
                                <th>Category </th>
                                <th>Amount </th>
                                <th>Description </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($points->count() > 0)
                                @foreach($points as $point)
                                    <tr>
                                        <td>{{$point->date}}</td>
                                        <td>{{$point->teacher}}</td>
                                        <td>{{$point->type}}</td>
                                        <td>{{$point->amount}}</td>
                                        <td>{{$point->description}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        <p>There are no points to display</p>
                                    </td>
                                </tr>

                            @endif
                        </tbody>
                    </table>
                </div>
                <nav class="text-center">
                    {{$points->links()}}
                </nav>
                <p class="text-muted text-center small">Last Updated on {{\App\System::lastUpdated()}}</p>
            </div>
        </div>
    </div>
@endsection