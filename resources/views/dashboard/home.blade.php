@extends('layouts.app')
@section('content')
<div class="page-content">
	<!-- BEGIN PAGE HEADER-->
	<!-- BEGIN PAGE BAR -->
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<a href="javascript:;">Home</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<a href="javascript:;">Dashboard</a>
				<i class="fa fa-circle"></i>
			</li>			
		</ul>
	</div>
	<!-- END PAGE BAR -->
	<!-- BEGIN PAGE TITLE-->
	<h3 class="page-title"> Visitors Statistics</h3>
	<!-- END PAGE TITLE-->
	
		<div class="row">


			<div class="portlet light portlet-fit bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-settings font-dark"></i>
						<span class="caption-subject font-dark sbold uppercase">Visitor Log</span>
					</div>
					<div class="actions">
						<div class="btn-group btn-group-devided" data-toggle="buttons">
							<label class="btn red btn-outline btn-circle btn-sm active">
								<input type="radio" name="options" class="toggle optViewLog" value="day">today</label>
							<label class="btn red btn-outline btn-circle btn-sm">
								<input type="radio" name="options" class="toggle optViewLog" value="week">weekly</label>
							<label class="btn red btn-outline btn-circle btn-sm">
								<input type="radio" name="options" class="toggle optViewLog" value="month">monthly</label>
						</div>
					</div>					
				</div>
				<div class="portlet-body" id="apistatview">
					<div id="chart_2" class="chart" style="height:250px;border:1px;">.</div>
					
					<br/>
					<div class="note note-info note-bordered">
						<p>
						Note: The above chart shows your visitor logs, by default it displays daily visitor log, however you can also view the weekly and monthly visitors
						</p>
					</div>	
				
				</div>
			</div>


		</div>
		<div class="clearfix"></div>	
	
	
	
</div>
@endsection


@push('scripts-footer')
<script src="{{asset('assets/global/plugins/flot/jquery.flot.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/flot/jquery.flot.resize.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/flot/jquery.flot.categories.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/flot/jquery.flot.pie.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/flot/jquery.flot.stack.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/flot/jquery.flot.crosshair.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/flot/jquery.flot.categories.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/flot/jquery.flot.time.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/flot/jquery.flot.axislabels.js')}}" type="text/javascript"></script>


<script>
$( document ).ready(function() {
	
	var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];	
	var dayOfWeek = ["Mon", "Tue", "Wed", "Thr", "Fri", "Sat","Sun"];
	var options = {
		grid: {
			tickColor: "#eee",
			borderColor: "#eee",
			hoverable: true,
			borderWidth: 1,
			mouseActiveRadius: 50,
			backgroundColor: { colors: ["#ffffff", "#ffffff"] },
			axisMargin: 20
		},
		xaxes: [{
			mode: "time",                
			color: "#e2e2e2",
			position: "top",
			axisLabel: "Hours of Day",
			axisLabelUseCanvas: false,
			axisLabelFontSizePixels: 12,
			axisLabelFontFamily: 'Verdana, Arial',
			axisLabelPadding: 5
		}],		
		xaxis: {
			mode: "time",
			timeformat: "%h:%M"
		},
		yaxis: {        
			color: "#808080",
			tickDecimals: 0,
			axisLabelPadding: 5,
			min:0,
			axisLabel: "Query hits",
			axisLabelUseCanvas: true,
			axisLabelFontSizePixels: 12,
			axisLabelFontFamily: 'Verdana, Arial',			
		}		
	}
	var weeklyoptions = {
		series: {
			shadowSize: 5
		},		
		grid: {
			tickColor: "#e2e2e2",
			borderColor: "#e2e2e2",			
			hoverable: true,
			borderWidth: 1,
			mouseActiveRadius: 50,
			backgroundColor: { colors: ["#ffffff", "#EDF5FF"] },
			axisMargin: 20
	
		},
		xaxes: [{
			mode: "time",                
			tickFormatter: function (val, axis) {
				return dayOfWeek[new Date(val).getDay()];
			},
			color: "#e2e2e2",
			position: "top",
			axisLabel: "Day of week",
			axisLabelUseCanvas: true,
			axisLabelFontSizePixels: 12,
			axisLabelFontFamily: 'Verdana, Arial',
			axisLabelPadding: 5
		}],
		xaxis: {
			mode: "time",
			timeformat: "%d/%m"
		},
		yaxis: {        
			color: "#808080",
			tickDecimals: 0,
			axisLabelPadding: 5,
			min:0,
			tickSize: 6,
			axisLabel: "Query hits",
			axisLabelUseCanvas: true,
			axisLabelFontSizePixels: 12,
			axisLabelFontFamily: 'Verdana, Arial',			
		}		
	}
	
	var monthlyoptions = {
		grid: {
			tickColor: "#e2e2e2",
			borderColor: "#e2e2e2",			
			hoverable: true,
			borderWidth: 1,
			mouseActiveRadius: 50,
			backgroundColor: { colors: ["#ffffff", "#EDF5FF"] },
			axisMargin: 20
		},
		xaxes: [{
			tickFormatter: function (val, axis) {
				return monthNames[new Date(val).getMonth()];
			},	
			color: "#808080",
			position: "top",
			axisLabel: "Monthly Logs",
			axisLabelUseCanvas: true,
			axisLabelFontSizePixels: 12,
			axisLabelFontFamily: 'Verdana, Arial',
			axisLabelPadding: 5
		}],
		yaxis: {        
			color: "#808080",
			tickDecimals: 0,
			axisLabelPadding: 5,
			min:0
		},	
        xaxis: {
            mode: "time",
			timeformat: "%b",
            tickLength: 0,
            tickSize: [1, "month"],
            axisLabel: 'month',
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 10,
            axisLabelFontFamily: 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
            axisLabelPadding: 15
        }		
	}	
	
	
		var mode="day";
		var data = [];
		var timer;
		//$.plot("#chart_2", data, options);	
		
		$('input.optViewLog').on('change', function(e) {
			e.preventDefault();	
			mode=$(this).val()
			GetLogs(mode);
		});
	
		GetLogs("day");
		var refreshId2 = setInterval(GetLogs(mode), 50000);	

		function showTooltip(x, y, contents) {
			$('<div id="tooltip">' + contents + '</div>').css({
				position: 'absolute',
				display: 'none',
				top: y + 5,
				left: x + 15,
				border: '1px solid #333',
				padding: '4px',
				color: '#fff',
				'border-radius': '3px',
				'background-color': '#333',
				opacity: 0.80
			}).appendTo("body").fadeIn(200);
		}

		var previousPoint = null;
		$("#chart_2").bind("plothover", function(event, pos, item) {
			$("#x").text(pos.x.toFixed(2));
			$("#y").text(pos.y.toFixed(2));
			if (item) {
				if (previousPoint != item.dataIndex) {
					previousPoint = item.dataIndex;
					$("#tooltip").remove();
					var x = item.datapoint[0].toFixed(2),
						y = item.datapoint[1].toFixed(2);
						d = item.series.data[item.dataIndex][2];
						//console.log(item.series.data[3]);
					showTooltip(item.pageX, item.pageY, item.series.label + " of " + d + " = " + y);
				}
			} else {
				$("#tooltip").remove();
				previousPoint = null;
			}
		});
	
	

		function GetLogs(when_opt){
			App.blockUI({target:"#apistatview",animate: true});
			var cachekill=Math.floor((Math.random()*999999)+5);
			var token = $("#token").val();
			$.ajax({
				type: 'GET',
				url: '/dashboard/apilog',
				dataType: "json",
				data: {
				mode: when_opt,
				token: token,
				r: cachekill
				},
				success: function (dat){
					//var data = [];
					//data.push(dat);	
					if(when_opt=="day"){
						$.plot("#chart_2", dat, options);
					}else if(when_opt=="week"){
						$.plot("#chart_2", dat, weeklyoptions);
					}else if(when_opt=="month"){
						$.plot("#chart_2", dat, monthlyoptions);
					}
					
					$("#apistatview").unblock();
				}
			})	
		}


	
	
  
})
</script> 
@endpush 



