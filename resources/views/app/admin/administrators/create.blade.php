@extends('app.layouts.app')

@section('title','Create Administrator')
@section('content')
    <div class="container">
        <h1 class="text-center">Create Administrator</h1>
    </div>
    <div class="container">
        <div class="well">
            <a href="{{route('admin.administrators.index')}}">Back to Administrator index</a>
            <p>Please enter the details for the new administrator</p>
            {!! Form::open(['role' => 'form', 'method' => 'post']) !!}
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
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name',null,['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Email Address') !!}
                {!! Form::email('email',null,['class' => 'form-control']) !!}
            </div>

            {!! Form::submit('Create Administrator',['class' => 'btn btn-success']) !!}


            {!! Form::close() !!}
        </div>
    </div>


@endsection