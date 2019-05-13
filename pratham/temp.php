<html>
<head>
	<title>Data</title>
	<style>
#result {
    text-align: right;
    color: gray;
    min-height: 2em;
}
#table-sparkline {
	margin: 0 auto;
    border-collapse: collapse;
    width: 75%;
}

.highcharts-tooltip>span {
    background: white;
    border: 1px solid silver;
    border-radius: 3px;
    box-shadow: 1px 1px 2px #888;
    padding: 8px;
}

.slidecontainer {
  width: 100%;
}

.slider {
  width: 100%;
  height: 10px;
  border-radius: 5px;
  background-image: linear-gradient(to right, rgba(255, 0, 0, 1), rgba(0, 128, 0, 1));
  outline: none;
  opacity: 0.7;
  transition: opacity .2s;
  -webkit-appearance: none;
}

.slider:hover {
   background-image: linear-gradient(to right, rgba(255, 0, 0, 1), rgba(0, 128, 0, 1));
}

.slider::-webkit-slider-thumb {
  width: 23px;
  height: 24px;
  border: 0;
  background: url('https://png.icons8.com/metro/52/000000/sort-down.png');
  background-size: 16px;
  background-repeat: no-repeat;
  background-position: 0 -4px;
  cursor: pointer;
  -webkit-appearance: none;
}

.slider::-moz-range-thumb {
  width: 23px;
  height: 24px;
  border: 0;
  background: url('https://png.icons8.com/metro/52/000000/sort-down.png');
    background-size: 16px;
  background-repeat: no-repeat;
  background-position: 0 -4px;

  cursor: pointer;
  -moz-appearance: none;
}
		</style>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>

<div id="result"></div>
<table id="table-sparkline" border="2">
	<col width="60">
	<col width="100">
	<col width="60">
  <col width="60">
  <col width="100">
  <col width="60">
  <col width="60">
  <col width="100">
  
    <thead bgcolor="#A3E4D7">
        <tr>
            <th>Project</th>
            <th>Health</th>
            <th>Schedule Plan</th>
            <th>Schedule Act</th>
            <th>Schedule Variance</th>
           <th>Cost Plan</th>
            <th>Cost Act</th>
            <th>Cost Variance</th>
        </tr>
    </thead>
<?php
include("database.php");
$result = "SELECT * FROM table1";
$rs=mysqli_query($con,$result);
while($column = mysqli_fetch_array($rs))
{
	echo"
	 <tbody id='tbody-sparkline'>
        <tr>
			<th><a href>$column[0]</a></th>
            <td>
              <div class='slidecontainer'>
               <input type='range' min='1' max='10' value='9' class='slider' id='myRange'> 
              </div>
            </td>
            <td align='center'><b>$column[1]%</b></td>
            <td align='center'><b>$column[2]%</b></td>
            <td>
              <table border='0'>
              <tr>
                <td><b>$column[3]%</b></td>
                <td data-sparkline='6, 5, 8, 9 '/>
              </tr>
              </table>
            </td>
             <td align='center'><b>$column[4]%</b></td>
            <td align='center'><b>$column[5]%</b></td>
            <td>
              <table>
              <tr>
                <td><b>$column[6]%</b></td>
                <td data-sparkline='6, 5, 8, 9 '/>
              </tr>
              </table>
            </td>
        </tr>
	</tbody>
				";						
}
?>
</table>	
<script>
var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
Highcharts.SparkLine = function (a, b, c) {
    var hasRenderToArg = typeof a === 'string' || a.nodeName,
        options = arguments[hasRenderToArg ? 1 : 0],
        defaultOptions = {
            chart: {
                renderTo: (options.chart && options.chart.renderTo) || this,
                backgroundColor: null,
                borderWidth: 0,
                type: 'area',
                margin: [2, 0, 2, 0],
                width: 120,
                height: 20,
                style: {
                    overflow: 'visible'
                },

                // small optimalization, saves 1-2 ms each sparkline
                skipClone: true
            },
            title: {
                text: ''
            },
            credits: {
                enabled: false
            },
            xAxis: {
                labels: {
                    enabled: false
                },
                title: {
                    text: null
                },
                startOnTick: false,
                endOnTick: false,
                tickPositions: [],
				categories: ['Jan 2018', 'Feb 2018', 'Mar 2018', 'Apr 2018', 'May 2018', 'Jun 2018', 'Jul 2018', 'Aug 2018', 'Sep 2018', 'Oct 2018', 'Nov 2018', 'Dec 2018']
            },
            yAxis: {
                endOnTick: false,
                startOnTick: false,
                labels: {
                    enabled: false
                },
                title: {
                    text: null
                },
                tickPositions: [0]
				
				
            },
            legend: {
                enabled: false
            },
            tooltip: {
                backgroundColor: null,
                borderWidth: 0,
                shadow: false,
                useHTML: true,
                hideDelay: 0,
                shared: true,
                padding: 0,
                positioner: function (w, h, point) {
                    return { x: point.plotX - w / 2, y: point.plotY - h };
                },
				 formatter: function() {
 				    return '<b>' + this.x +'</b><br/>'+ Highcharts.numberFormat(this.y, 0);
              }
            },
			
            plotOptions: {
                series: {
                    animation: false,
                    lineWidth: 1,
                    shadow: false,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    marker: {
                        radius: 1,
                        states: {
                            hover: {
                                radius: 2
                            }
                        }
                    },
                    fillOpacity: 0.25
                },
                column: {
                    negativeColor: '#910000',
                    borderColor: 'silver'
                }
            }
        };

    options = Highcharts.merge(defaultOptions, options);

    return hasRenderToArg ?
        new Highcharts.Chart(a, options, c) :
        new Highcharts.Chart(options, b);
};

var start = +new Date(),
    $tds = $('td[data-sparkline]'),
    fullLen = $tds.length,
    N = 0;

function doChunk() {
    var time = +new Date(),
        i,
        len = $tds.length,
        $td,
        stringdata,
        arr,
        data,
        chart;
	
		
    for (i = 0; i < len; i += 1) {
        $td = $($tds[i]);
        stringdata = $td.data('sparkline');
        arr = stringdata.split('; ');
        data = $.map(arr[0].split(', '), parseFloat);
        chart = {};

        if (arr[1]) {
            chart.type = arr[1];
        }
        $td.highcharts('SparkLine', {
            series: [{
                data: data,
                pointStart: 1
            }],
           
            chart: chart
        });

        N += 1;

        if (new Date() - time > 500) {
            $tds.splice(0, i + 1);
            setTimeout(doChunk, 0);
            break;
        }

       
    }
}
doChunk();

		</script>								
</body>
</html>
