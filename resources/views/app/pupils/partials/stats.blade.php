<div class="well">
    <h1 class="text-center">Statistics </h1>
    <ul class="list-group">
        <li class="list-group-item"><span>Total number of points: {{$pupil->currPoints}}</span></li>
        <li class="list-group-item"><span>Number of points this week: {{$pupil->pointsThisWeek()}}</span></li>
        <li class="list-group-item"><span>Best Category: {{$pupil->bestCategory()}}</span></li>
    </ul>
</div>