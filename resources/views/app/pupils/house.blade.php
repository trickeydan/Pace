@extends('app.layouts.app')

@section('title',$pupil->tutorgroup->house)
@section('content')
    <div class="container">
        <h1 class="text-center">{{$pupil->tutorgroup->house}}</h1></div>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row well">
                        <div class="col-md-12">
                            <h1 class="text-center">Competitions</h1>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Current Winner</th>
                                        <th>Number of Events</th>
                                        <th>Options</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($competitions->count() > 0)
                                        @foreach($competitions as $comp)
                                            <tr>
                                                <td>{{$comp->title}}</td>
                                                <td>{{$comp->getWinnerHuman()}}</td>
                                                <td>{{$comp->events()->count()}}</td>
                                                <td>
                                                    <a href="{{route('pupil.competition',$comp)}}">View</a>&nbsp;
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>
                                                <p>There are no competitions.</p>
                                            </td>
                                        </tr>

                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <nav class="text-center">
                                {{$competitions->links()}}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection