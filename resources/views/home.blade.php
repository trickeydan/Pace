@extends('layouts.app')
@section('title','Home')
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="row well">
        <div class="col-sm-6"><h3 class="text-center">Total PACE Points: {{Auth::User()->getPoints()}}</h3></div>
        <div class="col-sm-6"><h3 class="text-center">PACE Points this week: {{Auth::User()->pointsThisWeek()}}</h3></div>
    </div>
    <div class="row">
        @foreach($points as $point)
            <div class="col-sm-4 well">
                <h4 class="text-center">{{$point->teacher->name}}</h4>
                <p class="text-center"><strong>{{$point->date->format('jS F Y')}}</strong></p>
                <p class="text-center">{{$point->pointtype->name}}<br/>
                <p class="text-center">Amount: {{$point->amount}}<br/>
                    {{$point->description}}</p>
            </div>
        @endforeach
    </div>
    <nav class="text-center">
        {!! $points->links() !!}
    </nav>
@endsection