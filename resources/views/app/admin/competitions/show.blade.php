@extends('app.layouts.app')

@section('title','Competition: ' . $competition->title)
@section('content')
    <div class="container">
        <h1 class="text-center">Competition: {{$competition->title}}</h1>
        <p><a href="{{route('admin.competitions.index')}}">Back to competitions</a></p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="well">
                    <h1 class="text-center">Details</h1>
                    <ul class="list-group">
                        <li class="list-group-item"><span>Title: {{$competition->title}}</span></li>
                        <li class="list-group-item"><span>Contestant Type: {{$competition->contestantTypeHuman()}}</span></li>
                        @if($competition->contestants()->count() > 0)
                            @foreach($competition->contestants as $contestant)
                                <li class="list-group-item"><span>{{$loop->iteration}}: {{$contestant}}</span></li>
                            @endforeach
                        @else
                            <li class="list-group-item"><span>No contestants have been added yet.</span></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="well">
                    <h1 class="text-center">Actions</h1>
                    <ul class="list-group">
                        <a href="{{route('admin.competitions.events.create',$competition)}}"><li class="list-group-item"><span>Add new event</span></li></a>
                        <a href="{{route('admin.competitions.edit',$competition)}}"><li class="list-group-item"><span>Edit</span></li></a>
                        <a href="{{route('admin.competitions.delete',$competition)}}"><li class="list-group-item"><span>Delete</span></li></a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="well">
            <h1 class="text-center">Events</h1>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Winner</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($events->count() > 0)
                        @foreach($events as $event)
                            <tr>
                                <td>{{$event->title}}</td>
                                <td>{{$event->getWinnerHuman()}}</td>
                                <td><a href="{{route('admin.competitions.events.show',[$competition,$event])}}">View</a>
                                    Edit
                                    <a href="{{route('admin.competitions.events.delete',[$competition,$event])}}">Delete</a>
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

@endsection