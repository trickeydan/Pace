@extends('app.layouts.app')

@section('title',$pupil->tutorgroup->house)
@section('content')
    <div class="container">
        <h1 class="text-center">{{$pupil->tutorgroup->house}}</h1></div>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="well">
                        <h1 class="text-center">Statistics</h1>
                        <ul class="list-group">
                            <li class="list-group-item"><span>Not Implemented</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="well">
                        <h1>Nothing here</h1>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="well">
                        <h1 class="text-center">Competitions</h1>
                        <p>NOT IMPLEMENTED</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                        ["House", "Points", { role: "style" } ],
                        @foreach($pupil->tutorgroup->year->tutorgroups as $tg)
                            ["{{$tg->name}}",{{$tg->currPoints}}, "{{$tg->house->colour}}"],
                        @endforeach
                    ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                { calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation" },
                2]);

            var options = {
                title: "Points By Tutor Group: {{$pupil->tutorgroup->year->name}}",
                height: 400,
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("tg_chart"));
            chart.draw(view, options);
        }
    </script>-->
@endsection