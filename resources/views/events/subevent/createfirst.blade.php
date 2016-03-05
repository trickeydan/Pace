@extends('layouts.app')
@section('title','Create Subevent')
@section('content')
    <a href="{{route('events.view',$event->id)}}">Back to event</a>
    <h2 class="text-center">{{$event->name}}: Create Subevent</h2>
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
    {!! Form::open(array('route' => ['events.sub.storeFirst',$event->id],'role' => 'form')) !!}
    <p class="text-center">A subevent is used for a single instance of an event (series). I.e, a subevent should be used for a single week on the tutor challenge.</p>
    <div class="form-group">
        {!! Form::label('name', 'Name (Usually date)') !!}
        {!! Form::text('name',null,['class' => 'form-control']) !!}
    </div>
    <p>As this is the first subevent for this event, the following data is needed.</p>
    <div class="form-group">
        {!! Form::label('type', 'Who is being awarded in this event? ') !!}
        {!! Form::select('type',$options) !!}
    </div>
    <div class="form-group">
        {!! Form::label('affect_totals', 'Add to House totals?') !!}
        {!! Form::select('affect_totals',['0' => 'No','1' => 'Yes']) !!}
    </div>

    {!! Form::submit('Create Subevent',['class' => 'btn btn-lg btn-success']) !!}

    {!! Form::close() !!}
@endsection
