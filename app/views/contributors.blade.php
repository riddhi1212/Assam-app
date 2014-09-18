@extends('layouts/navhome')

@section('content')
		<div id="wrap">

			<div class="info">
				<div class="container">
					@if ($contributor_users_list)
						<div class="contributor-users-display">
						  <p class="search-text list-group-item-info">
						  	So far 
						  	<span>{{ count($contributor_users_list) }}</span>
						  	people have contributed. What are you waiting for?
						  	<a href="#">Contribute Now!</a>
						  </p>
				          <ul class="contributor-users-list list-group">
				          	@foreach ($contributor_users_list as $user)
				          		<li class="list-group-item">
				          			{{ $user->getAttribute('fname') . ' ' . $user->getAttribute('lname') }}
				          			<span class="badge">{{ $user->numContributed() }}</span>
				          		</li>
				          	@endforeach
				          </ul>
				      	</div>
			      	@endif
				</div>
			</div>

		</div>

@stop

@section('jsinclude')
        
@stop
