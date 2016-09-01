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
        @foreach(\Pace\PointType::all() as $pt)
            @if(Auth::User()->points()->where('pointtype_id',$pt->id)->sum('amount') >0)
                <div class="col-sm-4"><h4 class="text-center">{{$pt->name}}: {{Auth::User()->points()->where('pointtype_id',$pt->id)->sum('amount')}}</h4></div>
            @endif
        @endforeach
    </div>
    <div class="row row-eq-height">
        <?php $count = 0; ?>
        @foreach($points as $point)
            <div class="col-sm-4 well">
                <h4 class="text-center">{{$point->teacher->name}}</h4>
                <p class="text-center"><strong>{{$point->date->format('jS F Y')}}</strong></p>
                <p class="text-center">{{$point->pointtype->name}}</p>
                <p class="text-center">Amount: {{$point->amount}}<br/>{{$point->description}}</p>
            </div>
            <?php
                $count++;
                if($count >= 3){
                    $count = 0;
                    echo "</div><div class=\"row row-eq-height\">";
                }
                ?>
        @endforeach
    </div>
    <nav class="text-center">
        {!! $points->links() !!}
    </nav>
    <p class="text-center">Data last updated: {{\Pace\Point::recent()->date->format('jS F Y')}}</p>
@endsection
