@extends('layouts/navhome')

@section('content')
		<div id="wrap">
			<div class="header">
				<div class="container">
					<h1>ARMY Updates</h1>
				</div>
			</div>

			<div class="row">
			  <div class="col-md-9">
			    <div class="found-people">
			   	  <p>Tracking {{ count($army_updates_list) }} Records</p>
			   	  <!--
			      <form class="form-horizontal" id="found-people-form" method="post" action={{ route('found.people.create') }}>
			        <div class="form-group">
    					<label for="found-name" class="control-label col-sm-2">Name</label>
    					<div class="col-sm-10">
      						<input type="text" class="form-control" id="found-name" name="found-name" placeholder="Enter Name">
    					</div>
  					</div>
  					<div class="form-group">
    					<label for="found-age" class="control-label col-sm-2">Age</label>
    					<div class="col-sm-10">
      						<input type="text" class="form-control" id="found-age" name="found-age" placeholder="Enter Age">
    					</div>
  					</div>
  					<div class="form-group">
  						<div class="col-sm-4">
	  						<select class="form-control">
						  		<option>Father name</option>
						  		<option>Spouse name</option>
							</select>
						</div>
						<div class="col-sm-8">
      						<input type="text" class="form-control" id="found-father" name="found-father" placeholder="Enter Father name">
    					</div>
					</div>
  					<div class="form-group">
    					<label for="found-tel" class="control-label col-sm-2">Tel#</label>
    					<div class="col-sm-10">
      						<input type="text" class="form-control" id="found-tel" name="found-tel" placeholder="Enter Telephone Number">
    					</div>
  					</div>
  					<div class="form-group">
    					<label for="found-by" class="control-label col-sm-2">Found By</label>
    					<div class="col-sm-10">
      						<input type="text" class="form-control" id="found-by" name="found-by" placeholder="ARMY / NRDF / Reporter / Medical team / Person">
    					</div>
  					</div>
			        <button type="button" class="btn btn-primary btn-block" id="found-post-btn">Post</button>
			      </form>
			      -->
			      <div class="army-updates-display">
			      	  <li class="list-group-item list-group-item-info">
			      	  	<div class="row">
	      	  				<h4 class="col-md-4">S.no.</h4>
							<h4 class="col-md-4">Name</h4>
							<h4 class="col-md-4">Age</h4>
			      	  	</div>
			      	  </li>
			          <ul class="army-updates-list list-group">
					  	@foreach ($army_updates_list as $update)
			          		<li class="list-group-item">
				           		<div class="row">
				           			<p class="col-md-4">{{ $update->getAttribute('s-no') }}</p>
									<p class="col-md-4">{{ $update->getAttribute('first-name') .' '. $update->getAttribute('last-name') }}</p>
									<p class="col-md-4">{{ $update->age }}</p>
								</div>
							</li>
			          	@endforeach
			          </ul>
			      </div>
			    </div>
			  </div>
			</div>
		</div>

@stop
