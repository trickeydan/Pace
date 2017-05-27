<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Error {{$exception->getStatusCode()}}</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/yeti/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700">
        <link rel="stylesheet" href="{{asset('css/error.css')}}">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>

    <body>
        <div class="highlight-clean">
            <h1 class="text-center">{{config('app.name')}}</h1>
            <div class="container">
                <div class="intro">
                    <h2 class="text-center">
                        Error {{$exception->getStatusCode()}}:
                        {{ \Illuminate\Http\Response::$statusTexts[$exception->getStatusCode()]}}
                    </h2>
                    <h3 class="text-center">{{$exception->getMessage()}}</h3>
                    @if(isset($exception->wentDownAt))
                        <h3 class="text-center">Time offline so far: {{$exception->wentDownAt->diffForHumans(\Carbon\Carbon::now(),true)}}</h3>
                    @endif
                    <p class="text-center">Please try again later or check you typed your link correctly. <br/> If you believe there has been an error, please contact the system administrator.</p>
                    @if($exception->getStatusCode() != 503)
                        <div class="buttons text-center"><a class="btn btn-primary" role="button" href="{{url()->previous()}}">Back to previous page</a></div>
                    @endif
                </div>

            </div>

        </div>
        <div class="footer-basic">
            <div class="page-header"></div>
            <footer>
                @include('app.partials.footer')
            </footer>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>

</html>