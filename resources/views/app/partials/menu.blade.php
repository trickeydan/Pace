<div>
    <nav class="navbar navbar-default navigation-clean">
        <div class="container">
            <div class="navbar-header"><a class="navbar-brand navbar-link" href="{{route('home')}}">{{config('app.name')}}</a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav navbar-right">

                    @if($user->accountable->getType() == \App\Models\Account::PUPIL)
                        @include('app.pupils.partials.menuitems')

                    @elseif($user->accountable->getType() == \App\Models\Account::TEACHER)
                        @include('app.teachers.partials.menuitems')
                    @elseif($user->accountable->getType() == \App\Models\Account::ADMINISTRATOR)
                        @include('app.admin.partials.menuitems')
                    @endif

                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Settings <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            @if($user->accountable->getType() == \App\Models\Account::ADMINISTRATOR)
                                @include('app.admin.partials.settingsitems')
                            @endif
                            <li role="presentation"><a href="{{route('auth.logout')}}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>