@extends('app.layouts.app')

@section('title','Teachers')
@section('content')
    <div class="container">
        <h1 class="text-center">Teachers</h1>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <form method="get" action="">
                        <div class="input-group stylish-input-group">
                            <input type="text" class="form-control" name="search_query" placeholder="Search by Name or Initials" value="{{request('search_query')}}">
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
                    <th>Name</th>
                    <th>Initials</th>
                    <th>Tutorgroup</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @if($teachers->count() > 0)
                    @foreach($teachers as $teacher)
                        <tr>
                            <td>{{$teacher->name}}</td>
                            <td>{{$teacher->initials}}</td>
                            <td>{{$teacher->tutorgroup or "Unlinked"}}</td>
                            <td><a href="{{route('admin.teachers.view',$teacher->id)}}">View</a></td>
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
            {{$teachers->links()}}
        </nav>
    </div>
@endsection