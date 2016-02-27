@extends('layouts.email')
@section('content')
    <p>Feedback</p>
    <p>Pupil name: {{ Auth::User()->name }}</p>
    <p>Positive: {{$request->positive}}</p>
    <p>Negative: {{$request->negative}}</p>
    <p>Other: {{$request->general}}</p>
@endsection