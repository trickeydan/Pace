@extends('layouts.app')
@section('title','Viewing Pupil')
@section('content')
    <a href="{{route('admin.pupils.index')}}">Back to all pupils</a>
    <h2 class="text-center">Pupil: {{$pupil->name}}</h2>
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
    <table class="table table-striped table-responsive">
        <tbody>
            <tr>
                <td>Name</td>
                <td>{{$pupil->name}}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{$pupil->email}}</td>
            </tr>
            <tr>
                <td>Adno</td>
                <td>{{$pupil->adno}}</td>
            </tr>
            <tr>
                <td>Points</td>
                <td>{{$pupil->getPoints()}}</td>
            </tr>
            <tr>
                <td>House</td>
                <td>{{$pupil->house->name}}</td>
            </tr>
            <tr>
                <td>Tutor Group</td>
                <td>{{$pupil->tutorgroup->name}}</td>
            </tr>
            <tr>
                <td>Edit Pupil</td>
                <td><a href="{{route('admin.pupils.edit',$pupil->email)}}">Edit</a></td>
            </tr>
            <tr>
                <td>Move Tutor Group</td>
                <td>
                    {!! Form::open(array('route' => array('admin.pupils.updatetg',$pupil->email),'role' => 'form')) !!}
                    {!!Form::select('newtg', $tgs)!!}
                    {!! Form::submit('Update') !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        </tbody>
    </table>
@endsection
