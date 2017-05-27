@extends('app.layouts.app')

@section('title','Upload: ' . $upload->uuid)
@section('content')
    <div class="container">
        <h1 class="text-center">Upload: {{$upload->uuid}}</h1>
        <p><a href="{{route('admin.uploads.index')}}">Back to uploads</a></p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="well">
                    <h1 class="text-center">Details</h1>
                    <ul class="list-group">
                        <li class="list-group-item"><span>UUID: {{$upload->uuid}}</span></li>
                        <li class="list-group-item"><span>Start Time: {{$upload->created_at}}</span></li>
                        <li class="list-group-item"><span>End Time: {{$upload->updated_at}}</span></li>
                        <li class="list-group-item"><span>Status: {{$upload->getStatus()}}</span></li>
                        <li class="list-group-item"><span>Pupil Hash: {{$upload->pupils_hash or 'Not recorded'}}</span></li>
                        <li class="list-group-item"><span>Staff Hash: {{$upload->staff_hash or 'Not recorded'}}</span></li>
                        <li class="list-group-item"><span>Points Hash: {{$upload->points_hash or 'Not recorded'}}</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="well">
                    <h1 class="text-center">Actions</h1>
                    <ul class="list-group">
                        <li class="list-group-item disabled"><span>Revert</span></li>
                        <li class="list-group-item disabled"><span>Change Status</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="well">
            <h1 class="text-center">Logs</h1>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Message</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($logs->count() > 0)
                        @foreach($logs as $log)
                            <tr>
                                <td>{{$log->created_at}}</td>
                                <td>{{$log->getStatus()}}</td>
                                <td>{{$log->message}}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>
                                <p>There are no logs.</p>
                            </td>
                        </tr>

                    @endif
                    </tbody>
                </table>
            </div>
            <nav class="text-center">
                {{$logs->links()}}
            </nav>
        </div>
    </div>
@endsection