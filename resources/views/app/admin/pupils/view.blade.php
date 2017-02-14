@extends('app.layouts.app')

@section('title',$pupil->getName())
@section('content')
    <div class="container">
        <h1 class="text-center">{{$pupil->getName()}}</h1>
        <p><a href="{{route('admin.pupils.index')}}">Back to pupils</a></p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @include('app.pupils.partials.stats')
            </div>
            <div class="col-md-6">
                <div class="well">
                    <h1 class="text-center">Details</h1>
                    <ul class="list-group">
                        <li class="list-group-item"><span>Name: {{$pupil->getName()}}</span></li>
                        <li class="list-group-item"><span>Tutorgroup: {{$pupil->tutorgroup}}</span></li>
                        <li class="list-group-item"><span>House: {{$pupil->tutorgroup->house}}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @include('app.pupils.partials.points')

@endsection