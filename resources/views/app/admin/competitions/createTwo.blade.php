@extends('app.layouts.app')

@section('title','Create Competition')
@section('content')
    <div class="container">
        <h1 class="text-center">Create Competition</h1>
    </div>
    <div class="container">
        <div class="well">
            <a href="{{route('admin.competitions.index')}}">Back to Competitions</a>
            <p>Title: {{$request->title}}</p>
            <p>Contestant Type: {{$request->contestable_type}}</p>
            <p>Please enter the details for the new contestants.</p>
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
            @for($i = 1;$i <= $request->contestant_amount; $i++)
                    {!! Form::label('contestant' . $i, 'Contestant ' . $i) !!}
                    {!! Form::select('contestant' . $i,$list,'Not Selected',['class' => 'form-control']) !!}
            @endfor
            </div>
            {!! Form::hidden('title',$request->title) !!}
            {!! Form::hidden('contestant_amount',$request->contestant_amount) !!}
            {!! Form::hidden('contestable_type',$request->contestable_type) !!}

            {!! Form::submit('Next Step',['class' => 'btn btn-success']) !!}


            {!! Form::close() !!}
        </div>
    </div>


@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $("select").change(function () {
                var $this = $(this);
                var prevVal = $this.data("prev");
                var otherSelects = $("select").not(this);
                otherSelects.find("option[value=" + $(this).val() + "]").attr('disabled', true);
                if (prevVal) {
                    otherSelects.find("option[value=" + prevVal + "]").attr('disabled', false);
                }

                $this.data("prev", $this.val());
            });
        });
    </script>
@endsection