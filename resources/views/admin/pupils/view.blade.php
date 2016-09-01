@extends('layouts.app')
@section('title','Viewing Pupil')
@section('content')
    <a href="{{route('admin.pupils.index')}}">Back to all pupils</a>
    <h2 class="text-center">Pupil: {{$pupil->name}}</h2>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <table class="table table-striped table-responsive">
        <tbody>
            <tr>
                <td>Name</td>
                <td>{{$pupil->name}}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{$pupil->email}}</td>
            </tr>
            <tr>
                <td>Adno</td>
                <td>{{$pupil->id}}</td>
            </tr>
            <tr>
                <td>Points</td>
                <td>{{$pupil->getPoints()}}</td>
            </tr>
            <tr>
                <td>House</td>
                <td>{{$pupil->house->name}}</td>
            </tr>
            <tr>
                <td>Tutor Group</td>
                <td>{{$pupil->tutorgroup->name}}</td>
            </tr>
            <!--<tr>
                <td>Edit Pupil</td>
                <td><a href="{--route('admin.pupils.edit',$pupil->email)--}">Edit</a></td>
            </tr>
            <tr>
                <td>Move Tutor Group</td>
                <td>
                    {-- Form::open(array('route' => array('admin.pupils.updatetg',$pupil->email),'role' => 'form')) --}
                    {--Form::select('newtg', $tgs,$pupil->tutorgroup->id)--}
                    {-- Form::submit('Update Tutor Group') --}
                    {-- Form::close() --}
                </td>
            </tr>
            <tr>
                <td>Move House</td>
                <td>
                    {-- Form::open(array('route' => array('admin.pupils.updatehouse',$pupil->email),'role' => 'form')) --}
                    {--Form::select('newhouse', $houses,$pupil->house->id)--}
                    {-- Form::submit('Update House') --}
                    {-- Form::close() --}
                </td>
            </tr>-->
        </tbody>
    </table>
    <div class="row well">
        <div class="col-sm-6"><h3 class="text-center">Total PACE Points: {{$pupil->getPoints()}}</h3></div>
        <div class="col-sm-6"><h3 class="text-center">PACE Points this week: {{$pupil->pointsThisWeek()}}</h3></div>
        @foreach(\Pace\PointType::all() as $pt)
            @if($pupil->points()->where('pointtype_id',$pt->id)->sum('amount') >0)
                <div class="col-sm-4"><h4 class="text-center">{{$pt->name}}: {{$pupil->points()->where('pointtype_id',$pt->id)->sum('amount')}}</h4></div>
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
