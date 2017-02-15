@extends('app.layouts.app')

@section('title',$teacher->getName())
@section('content')
    <div class="container">
        <h1 class="text-center">{{$teacher->getName()}}</h1>
        <p><a href="{{route('admin.teachers.index')}}">Back to teachers</a></p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="well">
                    <h1 class="text-center">Details</h1>
                    <ul class="list-group">
                        <li class="list-group-item"><span>Name: {{$teacher->getName()}}</span></li>
                        <li class="list-group-item"><span>Initials: {{$teacher->initials}}</span></li>
                        <li class="list-group-item"><span>Tutorgroup: {{$teacher->tutorgroup or "Unlinked"}}</span></li>
                        <li class="list-group-item"><span>User Email: {{$teacher->user->email or "Unlinked"}}</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="well">
                    <h1 class="text-center">Actions</h1>
                    <ul class="list-group">
                        <li class="list-group-item"><span>Link Tutorgroup</span></li>
                        <li class="list-group-item"><span>Link User Account</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection