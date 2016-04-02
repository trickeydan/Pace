@extends('layouts.app')
@section('title','Pupils Index')
@section('content')
    <h2 class="text-center">Pupils</h2>
    <div class="row">
        <div class="col-sm-12 input-group">
            {!! Form::open(array('route' => 'admin.pupils.search','role' => 'form')) !!}
            <input type="text" name="query" class="search-query form-control" placeholder="Enter Adno, Username or Email to find Pupil" value="{{session('lastquery')}}"/>
            <span class="input-group-btn">
                <button class="btn btn-danger" type="submit"><span class=" glyphicon glyphicon-search"></span></button>
            </span>
            {!! Form::close() !!}
        </div>
    </div>
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
    <p class="text-right">
        <!--<a href="{--  route('admin.pupils.create') --}" class="btn">New Pupil</a>&nbsp;&nbsp;-->
        @if($request->get('pin') == "show")
            <a href="{{route('admin.pupils.index',['page' => $request->get('page')])}}" class="btn">Hide Pins</a>
        @else
            <a href="{{route('admin.pupils.index',['pin' => 'show','page' => $request->get('page')])}}" class="btn">Show Pins</a>
        @endif
    </p>
    <table class="table table-striped table-responsive">
        <thead>
            <tr>
                <th>Email</th>
                <th>Name</th>
                <th>Tutor Group</th>
                <th>House</th>
                @if($request->get('pin') == "show")
                    <th>Pin Number</th>
                @endif
                <th>Points</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pupils as $pupil)
                <tr>
                    <td>{{$pupil->email}}</td>
                    <td>{{$pupil->name}}</td>
                    <td>
                        @if(isset($pupil->tutorgroup->name) && $pupil->tutorgroup->name != null)
                            <a href="{{route('admin.tutorgroups.view',$pupil->tutorgroup->name)}}">
                                {{$pupil->tutorgroup->name}}
                            </a>
                        @else
                            No TG
                        @endif
                    </td>
                    <td>{{$pupil->house->name or 'No House'}}</td>
                    @if($request->get('pin') == "show")
                        <td>{{$pupil->id}}</td>
                    @endif
                    <td>{{$pupil->getPoints()}}</td>
                    <td><a href="{{route('admin.pupils.view',$pupil->email)}}">View</a><!--&nbsp;&nbsp;<a href="{-- route('admin.pupils.edit',$pupil->email) --}">Edit</a>--></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <nav class="text-center">
        @if($request->get('pin') == "show")
            {{$pupils->appends(['pin' => 'show'])->render()}}
        @else
            {{$pupils->render()}}
        @endif
    </nav>
@endsection
