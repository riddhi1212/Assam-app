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
				</div>
			</div>

		</div>

@stop

@section('jsinclude')
        
@stop
