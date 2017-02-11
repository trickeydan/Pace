@include('app.partials.menuitem',['route' => 'pupil.home','title' => $user->getName()])
@include('app.partials.menuitem',['route' => 'pupil.tutorgroup','title' => $pupil->tutorgroup])
@include('app.partials.menuitem',['route' => 'pupil.house','title' => $pupil->tutorgroup->house])