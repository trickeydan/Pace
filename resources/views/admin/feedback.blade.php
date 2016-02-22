@extends('layouts.app')
@section('title','Feedback')
@section('content')
    <h2 class="text-center">Feedback</h2>
    @foreach($feedbacks as $feedback)
        <div class="row">
            <div class="col-sm-12 well">
                <p>Name: {{$feedback->user->name}}</p>
                <p>{{$feedback->created_at}}</p>
                <p>Positive: {{$feedback->positive}}</p>
                <p>Negative: {{$feedback->negative}}</p>
                <p>General: {{$feedback->general}}</p>
            </div>
        </div>
    @endforeach
    <nav class="text-center">
        {{$feedbacks->links()}}
    </nav>
@endsection
