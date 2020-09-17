@extends('admin.template.master')

@section('main_content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Dashboard
        <small>As of {{date('F d, Y h:i a')}}</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Gender report -->
        <div class="col-md-12">
            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Gender Report</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div id="canvas-holder" style="width:100%">
                            <canvas id="pieChart" width="350" height="350"></canvas>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div> <!-- gender Report -->

        <div class="col-md-12">
            @if (Auth::user()->user_type == 1)
            <!-- Default box -->
            <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Report Count per Barangay</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="barChart" style="height: 230px; width: 510px;" height="230" width="510"></canvas>
                  </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            @endif
        </div>
    </section>
    <!-- /.content -->
@endsection

@section('js')
<script type="text/javascript">
    window.chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgb(54, 162, 235)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(201, 203, 207)'
    };

    $(function(){
        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieChart       = new Chart(pieChartCanvas)
        var PieData        = [
        @if($reports[0]->male != 0)
          {
            value    : "{{$reports[0]->male}}",
            color    : '#f56954',
            highlight: '#f56954',
            label    : 'Male'
          },
        @endif
        @if($reports[0]->female != 0)
          {
            value    : "{{$reports[0]->female}}",
            color    : '#3c8dbc',
            highlight: '#3c8dbc',
            label    : 'Female'
          },
        @endif
        ]
        var pieOptions     = {
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke    : true,
          //String - The colour of each segment stroke
          segmentStrokeColor   : '#fff',
          //Number - The width of each segment stroke
          segmentStrokeWidth   : 2,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout: 50, // This is 0 for Pie charts
          //Number - Amount of animation steps
          animationSteps       : 100,
          //String - Animation easing effect
          animationEasing      : 'easeOutBounce',
          //Boolean - Whether we animate the rotation of the Doughnut
          animateRotate        : true,
          //Boolean - Whether we animate scaling the Doughnut from the centre
          animateScale         : false,
          //Boolean - whether to make the chart responsive to window resizing
          responsive           : true,
          // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio  : false,
          //String - A legend template
          legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions)
        var maleSets = [];
        var femaleSets = [];
        var brgys = [];

        @foreach($getMales as $key => $value)
            maleSets.push("{{$value}}");
            brgys.push("{{$key}}");
        @endforeach

        @foreach($getFemales as $key => $value)
            femaleSets.push("{{$value}}");
        @endforeach

        var areaChartData = {
          labels  : brgys,
          datasets: [
            {
              label               : 'Males',
              fillColor           : 'rgba(210, 214, 222, 1)',
              strokeColor         : 'rgba(210, 214, 222, 1)',
              pointColor          : 'rgba(210, 214, 222, 1)',
              pointStrokeColor    : '#c1c7d1',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              data                : maleSets
            },
            {
              label               : 'Females',
              fillColor           : 'rgba(60,141,188,0.9)',
              strokeColor         : 'rgba(60,141,188,0.8)',
              pointColor          : '#3b8bba',
              pointStrokeColor    : 'rgba(60,141,188,1)',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data                : femaleSets
            }
          ]
        }


        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
        var barChart                         = new Chart(barChartCanvas)
        var barChartData                     = areaChartData
        barChartData.datasets[1].fillColor   = '#00a65a'
        barChartData.datasets[1].strokeColor = '#00a65a'
        barChartData.datasets[1].pointColor  = '#00a65a'
        var barChartOptions                  = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero        : true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines      : true,
          //String - Colour of the grid lines
          scaleGridLineColor      : 'rgba(0,0,0,.05)',
          //Number - Width of the grid lines
          scaleGridLineWidth      : 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines  : true,
          //Boolean - If there is a stroke on each bar
          barShowStroke           : true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth          : 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing         : 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing       : 1,
          //String - A legend template
          legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
          //Boolean - whether to make the chart responsive
          responsive              : true,
          maintainAspectRatio     : true
        }

        barChartOptions.datasetFill = false
        barChart.Bar(barChartData, barChartOptions)
    });
    </script>
</script>
@endsection
