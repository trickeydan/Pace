@if(\Request::route()->getName() == $route)
    <li class="active" role="presentation"><a href="{{route($route)}}">{{$title}}</a></li>
@else
    <li role="presentation"><a href="{{route($route)}}">{{$title}}</a></li>
@endif