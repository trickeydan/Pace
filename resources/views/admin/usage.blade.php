@extends('layouts.app')
@section('title','Usage Statistics')
@section('content')
    <h2 class="text-center">Usage Statistics</h2>
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
    <table class="table table-striped table-responsive">
        <tbody>
            <tr>
                <td>Amount of unique pupils logged on</td>
                <td>{{$amountunique}}</td>
            </tr>
            <tr>
                <td>Percentage of unique pupils logged on</td>
                <td>{{$percentageunique}}%</td>
            </tr>
            <tr>
                <td>Total Hits</td>
                <td>{{$totalhits}}</td>
            </tr>
            <tr>
                <td>Hits Today</td>
                <td>{{$hitstoday}}</td>
            </tr>
        </tbody>
    </table>
@endsection
