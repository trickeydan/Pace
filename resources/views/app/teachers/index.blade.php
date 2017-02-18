@extends('app.layouts.app')

@section('title',$user->getName())
@section('content')
    <div class="container">
        <h1 class="text-center">Hello, {{$user->getName()}}</h1>
    </div>
    <div class="container">
        <h2 class="text-center">{{$user->accountable->tutorgroup}}</h2>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Adno</th>
                    <th>Forename</th>
                    <th>Surname</th>
                    <th>Current Points</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @if($pupils->count() > 0)
                    @foreach($pupils as $pupil)
                        <tr>
                            <td>{{$pupil->adno}}</td>
                            <td>{{$pupil->forename}}</td>
                            <td>{{$pupil->surname}}</td>
                            <td>{{$pupil->currPoints}}</td>
                            <td><a href="{{route('teacher.pupils.view',$pupil->adno)}}">View</a></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>
                            <p>Search returned no results.</p>
                        </td>
                    </tr>

                @endif
                </tbody>
            </table>
        </div>
        <nav class="text-center">
            {{$pupils->links()}}
        </nav>
    </div>
@endsection