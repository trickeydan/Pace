@extends('app.layouts.app')

@section('title','Create Event')
@section('content')
    <div class="container">
        <h1 class="text-center">Create Event</h1>
    </div>
    <div class="container">
        <div class="well">
            <a href="{{route('admin.competitions.show',$competition)}}">Back to {{$competition->title}}</a>
            <p>Please enter the details for the new event in {{$competition->title}}</p>
            {!! Form::open(['role' => 'form', 'method' => 'post','route' => ['admin.competitions.events.create',$competition]]) !!}
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                {!! Form::label('title', 'Title') !!}
                {!! Form::text('title',\Carbon\Carbon::now()->toFormattedDateString(),['class' => 'form-control']) !!}
            </div>
            <h3>Points</h3>
            @foreach($competition->contestants as $contestant)
                <div class="form-group">
                    {!! Form::label('points' . $contestant->id, $contestant->name) !!}
                    {!! Form::number('points' . $contestant->id,0,['class' => 'form-control']) !!}
                </div>
            @endforeach

            {!! Form::submit('Submit',['class' => 'btn btn-success']) !!}


            {!! Form::close() !!}
        </div>
    </div>


@endsection