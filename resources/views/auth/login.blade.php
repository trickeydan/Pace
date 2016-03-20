@extends('layouts.loginpage')
@section('title','Login')
@section('content')
    <div class="form-top">
        <div class="form-top-left">
            <h3>KLB Pace Points</h3>
            <p>Please enter your username and pin:</p>
            <p>Points are updated on Mondays.</p>
        </div>
        <div class="form-top-right">
            <img class="img-responsive logo-img" src="assets/img/logo.png">
        </div>
    </div>
    <div class="form-bottom">
        <form class="login-form" role="form" method="POST" action="{{ url('/login') }}">
            {!! csrf_field() !!}

            <div class="form-group">
                <label class="sr-only" for="email">Email</label>
                <input type="text" name="email" placeholder="Email" class="form-username form-control" id="username" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label class="sr-only" for="password">Pin</label>
                <input type="password" name="password" placeholder="Pin" class="form-password form-control" id="password"> <!--maxlength="4"-->
            </div>
            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <i class="fa fa-exclamation-circle"></i> {{ $error }}
                    </div>
                @endforeach
            @endif
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <button type="submit" class="btn">Log in</button>
        </form>
        <p class="text-center"><a href="{{route('forgot')}}" class="text-danger">Forgot your pin?</a></p>

        @include('layouts.footer')
    </div>
@endsection