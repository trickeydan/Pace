@extends('app.layouts.app')

@section('title','Administrators')
@section('content')
    <div class="container">
        <h1 class="text-center">Administrators</h1>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <form method="get" action="">
                        <div class="input-group stylish-input-group">
                            <input type="text" class="form-control" name="search_query" placeholder="Search by Name" value="{{request('search_query')}}">
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
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
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
        <button type="button" class="btn btn-default">Create Administrator</button>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @if($admins->count() > 0)
                    @foreach($admins as $admin)
                        <tr>
                            <td>{{$admin->name}}</td>
                            @if($admin != $user->accountable)
                                <td><a href="{{route('admin.administrators.delete',$admin->id)}}">Delete</a></td>
                            @else
                                <td>Change My Password</td>
                            @endif
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
            {{$admins->links()}}
        </nav>
    </div>
@endsection