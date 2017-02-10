<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{config('app.name')}}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/yeti/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body>
<div>
    <nav class="navbar navbar-default navigation-clean">
        <div class="container">
            <div class="navbar-header"><a class="navbar-brand navbar-link" href="{{route('home')}}">{{config('app.name')}}</a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active" role="presentation"><a href="{{route('home')}}">{{$user->getName()}}</a></li>
                    <li role="presentation"><a href="{{route('tutorgroup')}}">{{$pupil->tutorgroup}}</a></li>
                    <li role="presentation"><a href="{{route('house')}}">{{$pupil->tutorgroup->house}} </a></li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Settings <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><a href="{{route('auth.logout')}}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
@yield('content')
<div class="footer-basic">
    <div class="page-header"></div>
    <footer>
        <ul class="list-inline">
            <li><a href="https://github.com/trickeydan/Pace/">Source Code</a></li>
            <li><a href="https://raw.githubusercontent.com/trickeydan/Pace/master/LICENCE">GPLv3 </a></li>
            <li><a href="https://github.com/trickeydan/Pace/issues">Report an Issue</a></li>
        </ul>
        <p class="copyright"> Version {{config('app.version')}} © {{ date('Y') }} D.Trickey</p>
    </footer>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
