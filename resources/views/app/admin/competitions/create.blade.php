@extends('app.layouts.app')

@section('title','Create Competition')
@section('content')
    <div class="container">
        <h1 class="text-center">Create Competition</h1>
    </div>
    <div class="container">
        <div class="well">
            <a href="{{route('admin.competitions.index')}}">Back to Competitions</a>
            <p>Please enter the details for the new competition</p>
            {!! Form::open(['role' => 'form', 'method' => 'post','route' => 'admin.competitions.store']) !!}
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
                {!! Form::label('title', 'Title') !!}
                {!! Form::text('title',null,['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('contestable_type', 'Contestant Type') !!}
                {!! Form::select('contestable_type',$types,['class' => 'form-control']) !!}
            </div>

            {!! Form::submit('Create Competition',['class' => 'btn btn-success']) !!}


            {!! Form::close() !!}
        </div>
    </div>


@endsection