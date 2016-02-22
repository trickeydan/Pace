@extends('layouts.app')
@section('title','Feedback')
@section('content')
    <h1 class="text-center">Feedback</h1>
    <p class="text-center">This feedback form is for the online pace points system only. All feedback is linked to your account and any inappropriate feedback or comments will be reported. Thanks for the feedback, it will help improve the system for all. </p>
    {!! Form::open(array('route' => 'feedback.store','role' => 'form')) !!}
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
        {!! Form::label('positive', 'Positive Comments') !!}
        {!! Form::textarea('positive','',['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('negative', 'Negative Comments') !!}
        {!! Form::textarea('negative','',['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('general', 'Any other Comments') !!}
        {!! Form::textarea('general','',['class' => 'form-control']) !!}
    </div>
    <p  class="text-center">{!! Form::submit('Submit Feedback',['class' => 'btn btn-lg btn-success']) !!}</p>

    {!! Form::close() !!}
@endsection
