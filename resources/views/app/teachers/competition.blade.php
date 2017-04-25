@extends('app.layouts.app')

@section('title','Competition: ' . $competition->title)
@section('content')
    <div class="container">
        <h1 class="text-center">Competition: {{$competition->title}}</h1>
    </div>
    <div>
        <div class="container">
            <div class="row well">
                <div class="col-md-12">
                    <h1 class="text-center">Events</h1>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Current Winner</th>
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($events->count() > 0)
                                @foreach($events as $event)
                                    <tr>
                                        <td>{{$event->title}}</td>
                                        <td>{{$event->getWinnerHuman()}}</td>
                                        <td>
                                            <a href="{{route('teacher.event',[$competition,$event])}}">View</a>&nbsp;
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        <p>There are no events.</p>
                                    </td>
                                </tr>

                            @endif
                            </tbody>
                        </table>
                    </div>
                    <nav class="text-center">
                        {{$events->links()}}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection