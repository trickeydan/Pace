@extends('app.layouts.app')

@section('title','System Status')
@section('content')
    <div class="container">
        <h1 class="text-center">System Status</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="well">
                    <h2 class="text-center">Version Information</h2>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                @foreach($version as $key => $value)
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>{{$value}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="well">
                    <h2 class="text-center">System Information</h2>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            @foreach($system as $key => $value)
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$value}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection