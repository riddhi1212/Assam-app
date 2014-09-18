@extends('layouts/navhome')

@section('content')
		<div id="wrap">
			<div class="header">
				<div class="container">
					<p class="pull-left">Hi
					@if ( Auth::check() )
						<span>{{ Auth::user()->fname }}</span>
					@endif
					</p>
				</div>
			</div>

			<div class="info">
				<div class="container">
					@if ($find_people_list)
						<div class="find-people-display">
				          <ul class="find-people-list list-group">
				          	@foreach ($find_people_list as $person)
				          		<li class="list-group-item">{{ $person->getAttribute('first-name') }}</li>
				          	@endforeach
				          </ul>
				      	</div>
			      	@endif
			      	@if ($army_updates_count)
			      		<div class="army-updates-display-count">
			          		<p class="list-group-item">
			          			Thank you for contributing
			          			<span>{{ $army_updates_count }}</span>
			          			ARMY Update records of Rescued people.
			          		</p>			          	
			      		</div>
			      	@endif
				</div>
			</div>

		</div>

@stop

@section('jsinclude')
        
@stop
