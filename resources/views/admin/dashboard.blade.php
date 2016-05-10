@extends('layouts.admin')

@section('title', trans('content.title_page_dashboard'))

@section('content')
<h1 class="page-header"><i class="fa fa-tachometer"></i> {!! trans('content.title_dashboard') !!}</h1>


<div id="chartContainerQuestion" style="width: 100%; height: 300px"></div>
<div id="chartContainerQuestionnaire" style="width: 100%; height: 300px"></div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {

            var dataPoints = [];

            var chart = new CanvasJS.Chart("chartContainerQuestion",
            {
                title: {
                    text: "{!! trans('content.chart_question_title') !!}"
                },
                axisY: {
                    title: "Products in %"
                },
                legend :{
                    verticalAlign: "center",
                    horizontalAlign: "right"
                },
                data: [
                    {
                        type: "pie",
                        showInLegend: true,
                        toolTipContent: "{label} <br/> {y} %",
                        indexLabel: "{y} %",
                        dataPoints: []
                    }]
            });

            $.getJSON("{!! route('dashboard.piequestion') !!}", function (data) {
                $.each(data.data, function(i, item) {
                    dataPoints.push({ label: i, y: Math.round(item/data.total*100*100)/100, legendText: i });
                });

                chart.options.data[0].dataPoints = dataPoints;
                chart.render();
            });

            var dataPoints2 = [];

            var chart2 = new CanvasJS.Chart("chartContainerQuestionnaire",
                    {
                        title: {
                            text: "{!! trans('content.chart_questionnaire_title') !!}"
                        },
                        axisY: {
                            title: "Products in %"
                        },
                        legend :{
                            verticalAlign: "center",
                            horizontalAlign: "right"
                        },
                        data: [
                            {
                                type: "pie",
                                showInLegend: true,
                                toolTipContent: "{label} <br/> {y} %",
                                indexLabel: "{y} %",
                                dataPoints: []
                            }]
                    });

            $.getJSON("{!! route('dashboard.piequestionnaire') !!}", function (data) {
                $.each(data.data, function(i, item) {
                    dataPoints2.push({ label: i, y: Math.round(item/data.total*100*100)/100, legendText: i });
                });

                chart2.options.data[0].dataPoints = dataPoints2;
                chart2.render();
            });


        })
    </script>
@endsection