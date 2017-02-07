@extends('app.layouts.app')

@section('title',$user->getName())
@section('content')
    <div class="container">
        <h1 class="text-center">Hello, {{$user->getName()}} <small>{{$pupil->tutorgroup}} </small></h1></div>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="well">
                        <h1 class="text-center">Statistics </h1>
                        <ul class="list-group">
                            <li class="list-group-item"><span>Total number of points: {{$pupil->currPoints}}</span></li>
                            <li class="list-group-item"><span>Number of points this week: 12</span></li>
                            <li class="list-group-item"><span>Best Category: Punctuality</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="well">
                        <h1 class="text-center">My Tutorgroup</h1>
                        <ul class="list-group">
                            <li class="list-group-item"><span>Total number of points: {{$pupil->tutorgroup->currPoints}}</span></li>
                            <li class="list-group-item"><span>Number of points this week: 102</span></li>
                            <li class="list-group-item"><span>Position in year: 4th</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="well">
                <h1 class="text-center">My Points</h1>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Date Awarded</th>
                            <th>Awarded by</th>
                            <th>Category </th>
                            <th>Amount </th>
                            <th>Description </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>04/12/16 </td>
                            <td>Mr E Example</td>
                            <td>Attainment </td>
                            <td>2 </td>
                            <td>Good attainment</td>
                        </tr>
                        <tr>
                            <td>04/12/16 </td>
                            <td>Mr E Example</td>
                            <td>Attainment </td>
                            <td>2 </td>
                            <td>Good attainment</td>
                        </tr>
                        <tr>
                            <td>04/12/16 </td>
                            <td>Mr E Example</td>
                            <td>Attainment </td>
                            <td>2 </td>
                            <td>Good attainment</td>
                        </tr>
                        <tr>
                            <td>04/12/16 </td>
                            <td>Mr E Example</td>
                            <td>Attainment </td>
                            <td>2 </td>
                            <td>Good attainment</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <nav>
                    <ul class="pagination text-center">
                        <li><a aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                        <li><a>1</a></li>
                        <li><a>2</a></li>
                        <li><a>3</a></li>
                        <li><a>4</a></li>
                        <li><a>5</a></li>
                        <li><a aria-label="Next"><span aria-hidden="true">»</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection