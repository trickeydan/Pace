@extends('app.layouts.app')

@section('title',$competition->title . ' : ' . $event->title)
@section('content')
    <div class="container">
        <h1 class="text-center">{{$competition->title}} : {{$event->title}}</h1>
        <p><a href="{{route('pupil.competition',$competition)}}">Back to {{$competition->title}}</a></p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="well">
                    <h1 class="text-center">Details</h1>
                    <ul class="list-group">
                        <li class="list-group-item"><span>Title: {{$event->title}}</span></li>
                        <li class="list-group-item"><span>Winner: {{$event->getWinnerHuman()}}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="well">
            <h1 class="text-center">Contestants</h1>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Contestant Name</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($event->eventPoints as $point)
                            <tr>
                                <td>{{$point->contestable->name}}</td>
                                <td>{{$point->amount}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection