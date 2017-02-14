@extends('app.layouts.app')

@section('title','Pupils')
@section('content')
    <div class="container">
        <h1 class="text-center">Pupils</h1>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <form method="get" action="">
                        <div class="input-group stylish-input-group">
                            <input type="text" class="form-control" name="search_query" placeholder="Search by Adno, Forename, Surname" value="{{request('search_query')}}">
                            <span class="input-group-addon">
                                <button type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Adno</th>
                    <th>Forename</th>
                    <th>Surname</th>
                    <th>Tutorgroup</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @if($pupils->count() > 0)
                    @foreach($pupils as $pupil)
                        <tr>
                            <td>{{$pupil->adno}}</td>
                            <td>{{$pupil->forename}}</td>
                            <td>{{$pupil->surname}}</td>
                            <td>{{$pupil->tutorgroup}}</td>
                            <td>View</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>
                            <p>Search returned no results.</p>
                        </td>
                    </tr>

                @endif
                </tbody>
            </table>
        </div>
        <nav class="text-center">
            {{$pupils->links()}}
        </nav>
    </div>
@endsection