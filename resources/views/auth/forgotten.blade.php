@extends('layouts.loginpage')
@section('title','Forgotten Pin')
@section('content')
    <div class="form-top">
        <div class="form-top-left">
            <h3>KLB Pace Points</h3>
            <p>Forgotten Pin: Please enter your email address</p>
        </div>
        <div class="form-top-right">
            <img class="img-responsive logo-img" src="assets/img/logo.png">
        </div>
    </div>
    <div class="form-bottom">
        {!! Form::open(array('route' => 'forgot.send','role' => 'form','class' => 'login-form')) !!}

            <div class="form-group">
                <label class="sr-only" for="email">Email</label>
                <input type="text" name="email" placeholder="Email" class="form-username form-control" value="{{ old('email') }}">
            </div>
            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <i class="fa fa-exclamation-circle"></i> {{ $error }}
                    </div>
                @endforeach
            @endif
            <button type="submit" class="btn">Send Pin</button>
        </form>
        <p class="text-center"><a href="{{route('login')}}" class="text-success">Back to Login</a></p>
        @include('layouts.footer')
    </div>
@endsection