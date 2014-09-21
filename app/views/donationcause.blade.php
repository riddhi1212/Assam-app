@extends('layouts/navhome')

@section('head')
        {{ HTML::style('css/donate.css'); }}
@stop

@section('content')
<div id="wrap">
	<div class="stripe">
		<div class="container">
			<p class="pull-left">Congratulations on taking the wonderful step of Adding a Donation Cause here:</p>
			<p class="pull-right">
				...
			</p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
			<h2>Donation Cause details :</h2>
	      	<form class="form-horizontal" id="add-donation-cause-form" method="post" action={{ route('donationcause.add') }}>
	        	<div class="form-group">
					<label for="dc-name" class="control-label col-sm-2">Name of Donation Cause</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="dc-name" name="dc-name" placeholder="Enter Name">
					</div>
				</div>
				<div class="form-group">
					<label for="dc-desc" class="control-label col-sm-2">Description</label>
					<div class="col-sm-10">
							<textarea class="form-control" id="dc-desc" name="dc-desc" placeholder="Enter Description"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="dc-img-url" class="control-label col-sm-2">Org Image URL</label>
					<div class="col-sm-10">
							<input type="text" class="form-control" id="dc-img-url" name="dc-img-url" placeholder="Enter URL to image of organisation">
					</div>
				</div>
				<div class="form-group">
					<label for="dc-donation-url" class="control-label col-sm-2">Donate URL</label>
					<div class="col-sm-10">
							<input type="text" class="form-control" id="dc-donation-url" name="dc-donation-url" placeholder="Enter Donation URL">
					</div>
				</div>
				@if ( Auth::guest() )
				<div class="guest-user">
					<div class="form-group">
					<label for="dcadder-first-name" class="control-label col-sm-2">My First Name</label>
					<div class="col-sm-10">
							<input type="text" class="form-control" id="dcadder-first-name" name="dcadder-first-name" placeholder="Enter Your First Name">
					</div>
					</div>
					<div class="form-group">
					<label for="dcadder-last-name" class="control-label col-sm-2">My Last Name</label>
					<div class="col-sm-10">
							<input type="text" class="form-control" id="dcadder-last-name" name="dcadder-last-name" placeholder="Enter Your Last Name">
					</div>
					</div>
					<div class="form-group">
					<label for="dcadder-mobile" class="control-label col-sm-2">My Mobile #</label>
					<div class="col-sm-10">
							<input type="text" class="form-control" id="dcadder-mobile" name="dcadder-mobile" placeholder="Enter Your Mobile Number">
					</div>
					</div>
				</div>
				@endif
	        	<button type="submit" class="btn btn-primary btn-block" id="dc-post-btn">Post</button>
	      	</form>
	    </div>
	</div>


</div> <!-- wrap -->

@stop

@section('jsinclude')
        {{ HTML::script('js/donate.js'); }}
@stop
