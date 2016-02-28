@extends('layouts.email')
@section('content')
    <p>Hello, {{$user->name}}<br/>
    Your pin number is: {{$user->id}}</p>
@endsection