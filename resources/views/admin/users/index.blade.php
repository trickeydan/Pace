@extends('layouts.app')
@section('title','Admins Index')
@section('content')
    <h2 class="text-center">Admins</h2>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <p class="text-center btn btn-primary"><a href="{{route('admin.users.create')}}">New Admin</a></p>
    <table class="table table-striped table-responsive">
        <thead>
            <tr>
                <th>Email</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->email}}</td>
                    <td>{{$user->name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <nav class="text-center">
        {{$users->links()}}
    </nav>
@endsection
