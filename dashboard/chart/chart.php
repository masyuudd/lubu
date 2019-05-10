<?php
$agentname 	= $_GET['loc'];
// we need this so that PHP does not complain about deprectaed functions
error_reporting( 0 );

// Connect to MySQL
$link = mysql_connect( 'localhost', 'hydrocom_ffws', 'hydrosix292' );
if ( !$link ) {
  die( 'Could not connect: ' . mysql_error() );
}

// Select the data base
$db = mysql_select_db( 'tfwsmg', $link );
if ( !$db ) {
  die ( 'Error selecting database \'data\' : ' . mysql_error() );
}

// Fetch the data
$query = "SELECT SamplingDate, AVG( WLevel ) as WLevel, AVG(WLevel)*0.5 as WLevel2 FROM $agentname GROUP BY date( SamplingDate )";
$result = mysql_query( $query );

// All good?
if ( !$result ) {
  // Nope
  $message  = 'Invalid query: ' . mysql_error() . "\n";
  $message .= 'Whole query: ' . $query;
  die( $message );
}

// Print out rows

$a = "[\n";
while ( $row = mysql_fetch_assoc( $result ) ) {
	$wlevel1 = number_format($row['WLevel'],2,'.',',');
	$wlevel2 = number_format($row['WLevel'],2,'.',',');
	$a = $a . " {\n";
	$a = $a . '  "date": "' . $row['SamplingDate'] . '",' . "\n";
	$a = $a .'  "visits": ' . $wlevel1 . ',' . "\n";
	$a = $a .'  "value2": ' . $wlevel2 . ',' . "\n";
	$a = $a .'  "value3": ' . $wlevel2*2 . '' . "\n";
	$a = $a ." }";
	$a = $a .",\n";
	}
	$a = rtrim($a,",\n");
	$a = $a ."\n]";

// Close the connection
mysql_close( $link );
?>


<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Chart</title>
       
        <script src="chart/js/amcharts.js" type="text/javascript"></script>
        <script src="chart/js/serial.js" type="text/javascript"></script>
		<script src="chart/themes/light.js"></script>
		<script src="chart/themes/dark.js"></script>
		<script src="chart/themes/black.js"></script>
		<script src="chart/themes/chalk.js"></script>
		<script src="chart/themes/patterns.js"></script>
		<script src="chart/js/plugins/export/export.js" type="text/javascript"></script>
		<script src="chart/js/plugins/export/export.min.js" type="text/javascript"></script>
		<link href="chart/js/plugins/export/export.css" rel="stylesheet" type="text/css">
		<script src="chart/js/plugins/responsive/responsive.min.js" type="text/javascript"></script>
		

        <script>


            var chartData = <?php echo $a;?>;
            	

            var chart = AmCharts.makeChart("chartdiv", { 
                type: "serial",
                dataProvider: chartData,
                categoryField: "date",
                categoryAxis: {
                    parseDates: true,
                    gridAlpha: 0.15,
                    minorGridEnabled: true,
                    axisColor: "#DADADA"
                },
                valueAxes: [{
                    axisAlpha: 0.2,
                    id: "v1"
                }],
                graphs: [{
                    title: "red line",
                    id: "g1",
                    valueAxis: "v1",
                    valueField: "visits",
                    bullet: "round",
                    bulletBorderColor: "#FFFFFF",
                    bulletBorderAlpha: 1,
                    lineThickness: 2,
                    lineColor: "#0000FF",
                    negativeLineColor: "#0352b5",
                    balloonText: "[[category]]<br><b><span style='font-size:14px;'>value: [[value]]</span></b>"
                }],
                chartCursor: {
                    fullWidth:true,
                    cursorAlpha:0.1
                },
                chartScrollbar: {
                    scrollbarHeight: 40,
                    color: "#FFFFFF",
                    autoGridCount: true,
                    graph: "g1"
                },

                mouseWheelZoomEnabled:true
            });

            chart.addListener("dataUpdated", zoomChart);
			chart.pathToImages = "chart/images/";
			chart["export"] 	= {"enabled": true};
			chart.responsive 	= {"enabled": true};
			AmCharts.theme = AmCharts.themes.patterns;

            // this method is called when chart is first inited as we listen for "dataUpdated" event
            function zoomChart() {
                // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
                chart.zoomToIndexes(chartData.length - 40, chartData.length - 1);
            }

            // changes cursor mode from pan to select
            function setPanSelect() {
                var chartCursor = chart.chartCursor;

                if (document.getElementById("rb1").checked) {
                    chartCursor.pan = false;
                    chartCursor.zoomable = true;

                } else {
                    chartCursor.pan = true;
                }
                chart.validateNow();
            }


        </script>
    </head>

    <body>
        <div id="chartdiv" style="width: 100%; height: 75vh;"></div>
        <div style="margin-left:35px;">
            <input type="radio" checked="true" name="group" id="rb1" onclick="setPanSelect()">Select
            <input type="radio" name="group" id="rb2" onclick="setPanSelect()">Pan
		</div>
    </body>

</html>