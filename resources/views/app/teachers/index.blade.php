@extends('app.layouts.app')

@section('title',$user->getName())
@section('content')
    <div class="container">
        <h1 class="text-center">Hello, {{$user->getName()}}</h1></div>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    Your tutorgroup is {{$user->accountable->tutorgroup}}
                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>


    </div>
@endsection