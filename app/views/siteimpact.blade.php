@extends('layouts/navhome')

@section('content')
		<div id="wrap">

			<div class="info">
				<div class="container">
					<h1>Stats</h1>
					<p>{{ FindPeople::all()->count(); }}</p>
					<p>{{ FoundPeople::all()->count(); }}</p>
				</div>
			</div>

		</div>

@stop

@section('jsinclude')
        
@stop
