@extends('layouts.app')
@section('title','Pupils Index')
@section('content')
    <h2 class="text-center">Pupils</h2>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if($request->get('pin') == "show")
        <p class="text-right"><a href="{{route('admin.pupils.index',['page' => $request->get('page')])}}" class="btn">Hide Pins</a></p>
    @else
        <p class="text-right"><a href="{{route('admin.pupils.index',['pin' => 'show','page' => $request->get('page')])}}" class="btn">Show Pins</a></p>
    @endif
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
                <!--<th>Options</th>-->
            </tr>
        </thead>
        <tbody>
            @foreach($pupils as $pupil)
                <tr>
                    <td>{{$pupil->email}}</td>
                    <td>{{$pupil->name}}</td>
                    <td>{{$pupil->tutorgroup->name or 'No TG'}}</td>
                    <td>{{$pupil->house->name or 'No House'}}</td>
                    @if($request->get('pin') == "show")
                        <td>{{$pupil->adno}}</td>
                    @endif
                    <td>{{$pupil->getPoints()}}</td>
                    <!--<td><a href="">Change Pin</a></td>-->
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
