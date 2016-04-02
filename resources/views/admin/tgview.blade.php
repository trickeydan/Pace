@extends('layouts.app')
@section('title','Viewing Tutorgroup')
@section('content')
    <a href="{{route('admin.pupils.index')}}">Back to pupils</a>
    <h2 class="text-center">Tutorgroup: {{$tg->name}}</h2>
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
    <h3 class="text-center">Pupils</h3>
    <table class="table table-striped table-responsive">
        <thead>
        <tr>
            <th>Email</th>
            <th>Name</th>
            <th>House</th>
            <th>Points</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tg->users()->orderBy('email')->get() as $pupil)
            <tr>
                <td>{{$pupil->email}}</td>
                <td>{{$pupil->name}}</td>
                <td>{{$pupil->house->name or 'No House'}}</td>
                <td>{{$pupil->getPoints()}}</td>
                <td><a href="{{route('admin.pupils.view',$pupil->email)}}">View</a><!--&nbsp;&nbsp;<a href="{-- route('admin.pupils.edit',$pupil->email) --}">Edit</a>--></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
