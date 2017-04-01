@extends('app.layouts.app')

@section('title','Edit Competition: ' . $competition->title)
@section('content')
    <div class="container">
        <h1 class="text-center">Edit Competition: {{$competition->title}}</h1>
    </div>
    <div class="container">
        <div class="well">
            <a href="{{route('admin.competitions.show',$competition)}}">Back to {{$competition->title}}</a>
            <p>Please enter any changes to the competition.</p>
            {!! Form::model($competition,['role' => 'form', 'method' => 'put','route' => ['admin.competitions.update',$competition]]) !!}
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
                {!! Form::text('title',$competition->title,['class' => 'form-control']) !!}
            </div>

            {!! Form::submit('Update Competition',['class' => 'btn btn-success']) !!}


            {!! Form::close() !!}
        </div>
    </div>


@endsection