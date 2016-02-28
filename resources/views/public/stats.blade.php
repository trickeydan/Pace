@extends('layouts.public')
@section('title','Statistics')
@section('content')
    <h2 class="text-center">Statistics</h2>
    <div class="row">
        <div class="col-sm-6">
            <div id="house_chart"></div>
        </div>
        <div class="col-sm-6">
            <div id="year_chart"></div>
        </div>
        @foreach(\Pace\Year::all() as $year)
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
            var data = google.visualization.arrayToDataTable([
                ["House", "Points", { role: "style" } ],
                @foreach(\Pace\House::all() as $house)
                    ["{{$house->name}}",{{$house->getPoints()}}, "#{{$house->colour}}"],
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
                title: "Total Points By House",
                height: 400,
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("house_chart"));
            chart.draw(view, options);

            var data = google.visualization.arrayToDataTable([
                ["House", "Points", { role: "style" } ],
                @foreach(\Pace\Year::orderBy('name','ASC')->get() as $year)
                    ["{{$year->name}}",{{$year->getPoints()}}, "silver"],
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
                title: "Total Points By Year",
                height: 400,
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("year_chart"));
            chart.draw(view, options);

            @foreach(\Pace\Year::orderBy('name')->get() as $year)
                var data = google.visualization.arrayToDataTable([
                    ["House", "Points", { role: "style" } ],
                    @foreach($year->tutorgroups as $tg)
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