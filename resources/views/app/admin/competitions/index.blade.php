@extends('app.layouts.app')

@section('title','Competitions')
@section('content')
    <div class="container">
        <h1 class="text-center">Competitions</h1>
        <a href="{{route('admin.competitions.create')}}"><button type="button" class="btn btn-default">Create Competition</button></a>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Contestant Type</th>
                    <th>Number of Events</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @if($competitions->count() > 0)
                    @foreach($competitions as $comp)
                        <tr>
                            <td>{{$comp->title}}</td>
                            <td>{{$comp->contestantTypeHuman()}}</td>
                            <td>{{$comp->events()->count()}}</td>
                            <td>
                                <a href="{{route('admin.competitions.show',$comp)}}">View</a>&nbsp;
                                <a href="{{route('admin.competitions.delete',$comp)}}">Edit</a>&nbsp;
                                <a href="{{route('admin.competitions.delete',$comp)}}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>
                            <p>No competitions match your criteria.</p>
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
@endsection