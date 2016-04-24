@extends('layouts.app')
@section('title','Users Index')
@section('content')
    <h2 class="text-center">Users</h2>
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
    <p class="text-center btn"><a href="{{route('admin.users.create')}}">New User</a></p>
    <table class="table table-striped table-responsive">
        <thead>
            <tr>
                <th>Email</th>
                <th>Name</th>
                <th>Account Type</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->email}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$userPerm[$user->user_level]}}</td>
                    <td>
                        @if($user->id != \Illuminate\Support\Facades\Auth::User()->id)
                            <a href="{{route('admin.users.delete',$user->email)}}">Delete</a>
                        @else
                            Delete
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <nav class="text-center">
        {{$users->links()}}
    </nav>
@endsection
