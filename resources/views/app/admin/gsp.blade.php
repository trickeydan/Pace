@extends('app.layouts.app')

@section('title','General System Password')
@section('content')
    <div class="container">
        <h1 class="text-center">General System Password</h1>
    </div>
    <div class="container">
        <p class="text-center">You must provide the general system password to do the following action: {{session('actionname')}}<br/>All actions are logged.</p>
        <div class="well">
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
                {!! Form::label('gsp', 'General System Password') !!}
                {!! Form::password('gsp',['class' => 'form-control']) !!}
            </div>
            {!! Form::submit('Continue',['class' => 'btn btn-success']) !!}


            {!! Form::close() !!}
        </div>
    </div>


@endsection