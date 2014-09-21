@extends('layouts/navhome')

@section('head')

@stop

@section('content')
<div id="wrap">
	<div class="stripe">
		<div class="container">
			<p class="pull-left">Details of Donation Cause:</p>
			<p class="pull-right">
				...
			</p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
			@if ($donation_cause)
				<div class="dc-display">
				  <h4 class="list-group-item list-group-item-info">Donation Cause Info: </h4>
		          <ul class="dc-info-list list-group">
	          			<div class="list-group-item row">
							<span class="col-md-4">Name: </span>
							<span class="col-md-8">{{ $donation_cause->name }}</span>
						</div>
						<div class="list-group-item row">
							<span class="col-md-4">Description: </span>
							<span class="col-md-8">{{ $donation_cause->description }}</span>
						</div>
						@if ($donation_cause->instructions === NULL)
							<div class="list-group-item row">
								<span class="col-md-4">Donation URL: </span>
								<span class="col-md-8">
									<a href="{{ $donation_cause->donation_url }}" target="_blank">Donation URL</a>
								</span>
							</div>
						@else
							<div class="list-group-item row">
								<span class="col-md-4">Instructions: </span>
								<span class="col-md-8"><pre>{{ $donation_cause->instructions }}</pre></span>
							</div>
						@endif
		          </ul>
		      	</div>
	      	@endif
		</div>
	</div>


</div> <!-- wrap -->

@stop

@section('jsinclude')

@stop
