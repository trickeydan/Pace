@extends('layouts.app')
@section('title','TG Points')
@section('content')
    <h2 class="text-center">Tutor Group Points</h2>
    <div class="row">
        @foreach(\Pace\Year::orderBy('name','ASC')->get() as $year)
            <div class="col-sm-6">
                <div id="year{{$year->id}}_chart"></div>
            </div>
        @endforeach
    </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            @foreach(\Pace\Year::orderBy('name')->get() as $year)
                var data = google.visualization.arrayToDataTable([
                    ["House", "Points", { role: "style" } ],
                    @foreach($year->tutorgroups()->orderBy('name')->get() as $tg)
                        ["{{$tg->name}}",{{$tg->getPoints()}}, "#{{$tg->users->first()->house->colour}}"],
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
                    title: "Points By Tutor Group: Year {{$year->name}}",
                    height: 400,
                    bar: {groupWidth: "95%"},
                    legend: { position: "none" },
                };
                var chart = new google.visualization.ColumnChart(document.getElementById("year{{$year->id}}_chart"));
                chart.draw(view, options);
            @endforeach
        }
    </script>
@endsection
