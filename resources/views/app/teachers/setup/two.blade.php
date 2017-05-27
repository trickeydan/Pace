@extends('app.layouts.app')

@section('title','Teacher Account Setup')
@section('content')
    <div class="container">
        <h1 class="text-center">Teacher Account Setup</h1>
    </div>
    <div class="container">
        <p class="text-center">Your password has now been changed. Due to some tutorgroups having multiple teachers, you need to manually select your tutorgroup.</p>
        <div class="well">
            <h3>Tutorgroup</h3>
            <p>Please select your tutorgroup from the list.</p>
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
                {!! Form::label('oldpassword', 'Tutorgroup') !!}
                {!! Form::select('tutorgroup',$tutorgroups,['class' => 'form-control']) !!}
            </div>

            {!! Form::submit('Finish',['class' => 'btn btn-success']) !!}


            {!! Form::close() !!}
        </div>
    </div>


@endsection