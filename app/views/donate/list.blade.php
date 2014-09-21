@extends('layouts/navhome')

@section('head')
        {{ HTML::style('css/donate.css'); }}
@stop

@section('content')
<div id="wrap">
	<div class="stripe">
		<div class="container">
			<p class="pull-left">Donate</p>
			<p class="pull-right">
				<a class="btn btn-primary" href={{ route('donationcause.addform') }}>
					<span class="fa fa-plus-square fa-fw fa-lg"></span>Add Your Cause
				</a>
			</p>
		</div>
	</div>

	<div class="causes-display">
		<div class="container">
			@foreach (array_chunk($donation_causes_list->all(), 3) as $row)
				<div class="row">
					@foreach ($row as $cause)
			  			<div class="col-xs-12 col-sm-4">
				  			<div class="thumbnail">
				  				<!-- add class img-responsive ?? -->
				  				<img src="{{ $cause->img_url }}" class="img-responsive">
						      	<div class="caption">
						        	<h3>{{ $cause->name }}</h3>
						        	<p>{{ $cause->description }}</p>
						        	<p>
							        	<a target="_blank" href="{{ $cause->donation_url }}" class="btn btn-primary" role="button">Donate</a>
						        	</p>
						      	</div>
				    		</div>
				  		</div>
			  		@endforeach
			  	</div>
		  	@endforeach
		</div>
	</div>



</div> <!-- wrap -->

@stop

@section('jsinclude')

@stop
