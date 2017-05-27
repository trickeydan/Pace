@extends('auth.layout')

@section('title','Forgot Password')

@section('content')
    <form role="form" method="POST" action="{{ url('/password/email') }}">
        <div class="illustration"><i class="pace-logo upsidedown"></i></div>
        {{ csrf_field() }}

        <p class="text-center">Forgot Password</p>
        <p class="text-center text-muted">Please enter your email address.</p>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <input class="form-control" id="email" required autofocus type="email" name="email" placeholder="Email" value="{{ old('email') }}" >
            @if ($errors->has('email'))
                <div class="alert alert-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-block" name="submit" type="submit">Send Password</button>
        </div>
        <a href="{{ route('auth.login') }}" class="forgot">Back to login</a>
    </form>
@endsection
