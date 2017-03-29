@extends('app.layouts.app')

@section('title','Uploads')
@section('content')
    <div class="container">
        <h1 class="text-center">Uploads</h1>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>UUID</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @if($uploads->count() > 0)
                    @foreach($uploads as $upload)
                        <tr>
                            <td>{{$upload->uuid}}</td>
                            <td>{{$upload->created_at}}</td>
                            <td>{{$upload->getStatus()}}</td>
                            <td><a href="{{route('admin.uploads.view',$upload->uuid)}}">View</a></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>
                            <p>No uploads</p>
                        </td>
                    </tr>

                @endif
                </tbody>
            </table>
        </div>
        <nav class="text-center">
            {{$uploads->links()}}
        </nav>
    </div>
@endsection