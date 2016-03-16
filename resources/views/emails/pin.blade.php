@extends('layouts.email')
@section('content')
    <h1>Hi, {{$user->name}}</h1>
    <p class="lead">Your Pin Number for KLBS Pace Point System is: {{$user->id}}</p>
    <p>You should have already been given instructions on how to access the system.</p>
@endsection