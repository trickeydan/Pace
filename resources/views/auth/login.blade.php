@extends('auth.layout')

@section('title','Login')

@section('content')
    <form role="form" method="POST" action="{{ url('/login') }}">
        <div class="illustration"><i class="pace-logo upsidedown"></i></div>
        {{ csrf_field() }}

        <p class="text-center">Login</p>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <input class="form-control" id="email" required autofocus type="email" name="email" placeholder="Email" value="{{ old('email') }}" >
            @if ($errors->has('email'))
                <div class="alert alert-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <input class="form-control" id="password" type="password" name="password" required placeholder="Password">
            @if ($errors->has('password'))
                <div class="alert alert-danger">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-block" name="submit" type="submit">Log In</button>
        </div><a href="{{ route('auth.password') }}" class="forgot">Forgot your password?</a>
    </form>
@endsection