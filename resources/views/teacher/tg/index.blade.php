@extends('layouts.app')
@section('title','My Tutor Group')
@section('content')
    <h2 class="text-center">My Tutorgroup</h2>
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
    <div class="row well">
        <div class="col-sm-6"><h3 class="text-center">Total PACE Points: {{$user->tutorgroup->getPoints()}}</h3></div>
        <div class="col-sm-6"><h3 class="text-center">Average Points: {{round($user->tutorgroup->getPoints() / $user->tutorgroup->pupils()->count(),2)}}</h3></div>
    </div>
    <table class="table table-striped table-responsive">
        <thead>
            <tr>
                <th>Email</th>
                <th>Name</th>
                @if($request->get('pin') == "show")
                    <th>Pin Number</th>
                @endif
                <th>Points</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user->tutorgroup->pupils() as $pupil)
                <tr>
                    <td>{{$pupil->email}}</td>
                    <td>{{$pupil->name}}</td>
                    @if($request->get('pin') == "show")
                        <td>{{$pupil->id}}</td>
                    @endif
                    <td>{{$pupil->getPoints()}}</td>
                    <td><a href="{{route('teacher.pupils.view',$pupil->email)}}">View</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
