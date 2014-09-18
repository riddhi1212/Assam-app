@extends('layouts/navhome')

@section('content')
		<div id="wrap">
			<div class="stripe">
				<div class="container">
					<p class="pull-left">Hi
						<span>{{ Auth::user()->fname }}</span>
					</p>
				</div>
			</div>

			<div class="info">
				<div class="container">
					@if ($messages_list)
						<div class="messages-display">
						  <h4 class="list-group-item list-group-item-info">Messages</h4>
				          <ul class="messages-list list-group">
				          	@foreach ($messages_list as $msg)
				          		<li class="list-group-item">{{ $msg->textbody }}</li>
				          	@endforeach
				          </ul>
				      	</div>
			      	@endif
					@if ($find_people_list)
						<div class="find-people-display">
						  <h4 class="list-group-item list-group-item-info">Find-Person Reports</h4>
				          <ul class="find-people-list list-group">
				          	@foreach ($find_people_list as $person)
				          		<li class="list-group-item">{{ $person->getAttribute('first-name') }}</li>
				          	@endforeach
				          </ul>
				      	</div>
			      	@endif
			      	@if ($army_updates_count)
			      		<div class="army-updates-display-count">
			      			<h4 class="list-group-item list-group-item-info">Contributions</h4>
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
