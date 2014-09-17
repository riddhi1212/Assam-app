@extends('layouts/navhome')

@section('content')
		<div id="wrap">
			<!-- TODO : move to navtabbed -->
			@if ( Auth::check() )
			<div class="header">
				<div class="container">
					<p class="pull-left">Hi
						<span>{{ Auth::user()->fname }}</span>					
					</p>
					<a href={{ route('logout') }} class="pull-right">Log Out</a>
				</div>
			</div>
			@endif

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
