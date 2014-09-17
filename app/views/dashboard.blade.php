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
					<a href={{ route('logout') }} class="pull-right">Log Out</a>
				</div>
			</div>

			<div class="info">
				<div class="container">
					<div class="find-people-display">
			          <ul class="find-people-list list-group">
			          	@foreach ($find_people_list as $person)
			          		<li class="list-group-item">{{ $person->getAttribute('first-name') }}</li>
			          	@endforeach
			          </ul>
			      </div>
				</div>
			</div>

		</div>

@stop

@section('jsinclude')
        
@stop
