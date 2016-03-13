@extends('layouts.app')
@section('title','Create Event')
@section('content')
    <a href="{{route('series.view',$series->id)}}">Back to {{$series->name}}</a>
    <h2 class="text-center">Create Event in {{$series->name}}</h2>
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
    <p class="text-center">Event Name: {{$name}}</p>
    <p class="text-center">Number of Participants: {{$amount}}</p>
    {!! Form::open(array('route' => ['event.store',$series->id],'role' => 'form')) !!}
    <table class="table table-striped table-responsive">
        <thead>
        <tr>
            <td>Participant</td>
            @if(!$series->binary)
                <td>No of Points</td>
            @else
                <td>Winner? (Only select one)</td>
            @endif
        </tr>
        </thead>
        <tbody>
        @for($i = 1;$i <= $amount;$i++)
            <tr>
                <td>{!! Form::select('participant' . $i,$participants,null,['class' => 'form-control']) !!}</td>
                @if(!$series->binary)
                    <td>{!! Form::number('points'  . $i,0,['class' => 'form-control']) !!}</td>
                @else
                    <td>{!! Form::checkbox('binary'  . $i,1,0,['class' => 'form-control']) !!}</td>
                @endif

            </tr>
        @endfor
        </tbody>
    </table>

    <br/>
    {!! Form::submit('Create Event',['class' => 'btn btn-lg btn-success']) !!}

    {!! Form::close() !!}
@endsection