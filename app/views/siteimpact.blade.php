@extends('layouts/navhome')

@section('content')
		<div id="wrap">

			<div class="info">
				<div class="container">
					<h1>Stats</h1>
					<p>So far, this site has made searchable    
						<span>{{ ArmyUpdates::all()->count(); }}</span>
						Official Indian ARMY Updates of Rescued people.
					</p>
					<p>There are currently     
						<span>{{ User::where('contributor',true)->get()->count(); }}</span>
						contributors registered on this site.
					</p>
					<p>Through this site, people posted Missing Person Reports for  
						<span>{{ FindPeople::all()->count(); }}</span>
						people
					</p>
					<p>Through this site, people have posted that they have found   
						<span>{{ FoundPeople::all()->count(); }}</span>
						people
					</p>
					<p>Through this site,   
						<span>{{ FindPeople::where('found', '=', true)->count(); }}</span>
						Missing Person Reports have been Resolved. These people have been found by their loved ones.
					</p>
					<p>
						{{ ArmyUpdates::all(['first-name', 'age']); }}
					</p>
				</div>
				<div id="chart_div" style="width: 900px; height: 500px;"></div>
			</div>

		</div>

@stop

@section('jsinclude')
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);

      function drawChart() {
      	//google.visualization.arrayToDataTable(
      	var au = [
      			{"first-name":"Dilshada","age":57},
      			{"first-name":"Samir","age":35},
      			{"first-name":"Mohd","age":15},
      			{"first-name":"Javed","age":32},
      			{"first-name":"Snober","age":28},
      			{"first-name":"Dy Sp Sandeep","age":37},
      			{"first-name":"Ali","age":56},
      			{"first-name":"JN","age":73},{"first-name":"Santosh","age":56},{"first-name":"Fatima","age":35},{"first-name":"Tasleema","age":30},{"first-name":"Magli","age":45},{"first-name":"Fatima","age":60},{"first-name":"Famida","age":45},{"first-name":"Ghulam","age":32},{"first-name":"Mohd","age":19},{"first-name":"Jahngeer","age":23},{"first-name":"Sameer","age":21},{"first-name":"Zameer","age":22},{"first-name":"Mohd Arif","age":19},{"first-name":"Aftab","age":21},{"first-name":"Cdr KS","age":62},{"first-name":"Ajay","age":55},{"first-name":"Vinita ","age":53},{"first-name":"Asit","age":55},{"first-name":"Kuldeep","age":50}
      		];

      	var newdata = [];
      	newdata[newdata.length] = ["Name", "Age"];

      	$.each(au, function( index, obj ) {
      		var ddd = [];
		  	$.each(obj, function( key, value ) {
		    	ddd[ddd.length] = value;
		  	});
		  	newdata[newdata.length] = ddd;
		});

		console.log(newdata);
		console.log("========");


      	
        var data = google.visualization.arrayToDataTable(newdata);
	

        var options = {
          title: 'Ages of Rescued people by the Indian ARMY',
          legend: { position: 'none' },
        };

        var chart = new google.visualization.Histogram(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
@stop
