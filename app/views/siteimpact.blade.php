@extends('layouts/navhome')


@section('content')
		<div id="wrap">

			<div class="info">
				<div class="container">
					<div id="chart_div" style="width: auto; height: 500px;"></div>
					<div class="stripe">
						<div class="container">
							<h3>Site Stats</h3>
							<p>So far, this site has made searchable    
								<span><b>{{ ArmyUpdates::all()->count(); }}</b></span>
								Official Indian ARMY Updates of Rescued people.
							</p>
							<p>There are currently     
								<span><b>{{ User::where('contributor',true)->get()->count(); }}</b></span>
								contributors registered on this site.
							</p>
							<p>Through this site, people posted Missing Person Reports for  
								<span><b>{{ FindPeople::all()->count(); }}</b></span>
								people
							</p>
							<p>Through this site, people have posted that they have found   
								<span><b>{{ FoundPeople::all()->count(); }}</b></span>
								people
							</p>
							<p>Through this site,   
								<span><b>{{ FindPeople::where('found', '=', true)->count(); }}</b></span>
								Missing Person Reports have been Resolved. These people have been found by their loved ones.
							</p>
						</div>
					</div>
				</div>
			</div>

		</div>

@stop

@section('jsinclude')
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <script type="text/javascript">

  		google.load("visualization", "1", {packages:["corechart"]});
  		google.setOnLoadCallback(drawChart);


      	function drawChart() {
      	    $.getJSON("AUdata", function(data) {
      			var au = data;

		      	var newdata = [];
			    newdata[newdata.length] = ["Name", "Age"];

		      	$.each(au, function( index, obj ) {
		      		var ddd = [];
				  	$.each(obj, function( key, value ) {
				    	ddd[ddd.length] = value;
				  	});
				  	newdata[newdata.length] = ddd;
				});

			    var data = google.visualization.arrayToDataTable(newdata);

			    var options = {
			        title: 'Histogram of Ages of Rescued people by the Indian ARMY',
			        legend: { position: 'none' },
			        hAxis: { title: 'Ages of Rescued people' },
			        vAxis: { title: 'Number of Rescued people' }
			    };

		        var chart = new google.visualization.Histogram(document.getElementById('chart_div'));
		        chart.draw(data, options);
      		});

      	}
    </script>
@stop
