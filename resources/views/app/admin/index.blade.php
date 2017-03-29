@extends('app.layouts.app')

@section('title',$user->getName())
@section('content')
    <div class="container">
        <h1 class="text-center">Hello, {{$user->getName()}}</h1></div>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="well">
                        <h1 class="text-center">System Statistics</h1>
                        <ul class="list-group">
                            <li class="list-group-item"><span>Pupil uptake: x%</span></li>
                            <li class="list-group-item"><span>Last successful upload: {{\App\System::lastSuccessfulUpload()}}</span></li>
                            <li class="list-group-item"><span>Time since last recorded error: 0 min</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="well">
                        <h1 class="text-center">My Account</h1>
                        <ul class="list-group">
                            <li class="list-group-item"><span>Name: {{$user->getName()}}</span></li>
                            <li class="list-group-item"><span>Account Type: {{$user->accountable->getTypeHuman()}}</span></li>
                            <li class="list-group-item">
                                <span>Receive email alerts:
                                    @if($user->accountable->receivesAlerts())
                                        Yes
                                    @else
                                        No
                                    @endif
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection