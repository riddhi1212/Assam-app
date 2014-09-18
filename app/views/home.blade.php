@extends('layouts/navhome')

@section('head')
        {{ HTML::style('css/home-style.css'); }}
@stop

@section('content')

		<div id="wrap">
			<div class="stripe">
				<div class="container">
					<p class="pull-left">Kashmiri Floods</p>
					<p class="pull-right">
						...
					</p>
				</div>
			</div>

			<div class="row">
			  <div class="col-md-6">
			    <div class="found-people">
			   	  <p>Tracking 
			   	  <span id="found-count">{{ count($found_people_list) }}</span>
			   	   Records</p>
			      <h2>I have found :</h2>
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
			      <div class="found-people-display">
			          <ul class="found-people-list list-group">
					  	@foreach ($found_people_list as $person)
			          		<li class="list-group-item">
				           		<div class="row">
									<p class="col-md-4">{{ $person->getAttribute('first-name') }}</p>
									<p class="col-md-4">{{ $person->age }}</p>
									<p class="col-md-4">TBD</p>
								</div>
							</li>
			          	@endforeach
			          </ul>
			      </div>
			    </div>
			  </div>
			  <div class="col-md-6">
			    <div class="find-people">
			      <p>Tracking 
			   	  <span id="find-count">{{ count($find_people_list) }}</span>
			   	   Records
			   	  </p>
			      <h2>I am looking for :</h2>
			      <form class="form-horizontal" id="find-people-form" method="post" action={{ route('find.people.create') }}>
			        <div class="form-group">
    					<label for="find-name" class="control-label col-sm-2">Name</label>
    					<div class="col-sm-10">
      						<input type="text" class="form-control" id="find-name" name="find-name" placeholder="Enter Name">
    					</div>
  					</div>
  					<div class="form-group">
    					<label for="find-age" class="control-label col-sm-2">Age</label>
    					<div class="col-sm-10">
      						<input type="text" class="form-control" id="find-age" name="find-age" placeholder="Enter Age">
    					</div>
  					</div>
  					@if ( Auth::guest() )
	  					<div class="form-group guest-user">
	    					<label for="looker-first-name" class="control-label col-sm-2">My First Name</label>
	    					<div class="col-sm-10">
	      						<input type="text" class="form-control" id="looker-first-name" name="looker-first-name" placeholder="Enter Your First Name">
	    					</div>
	  					</div>
	  					<div class="form-group guest-user">
	    					<label for="looker-last-name" class="control-label col-sm-2">My Last Name</label>
	    					<div class="col-sm-10">
	      						<input type="text" class="form-control" id="looker-last-name" name="looker-last-name" placeholder="Enter Your First Name">
	    					</div>
	  					</div>
	  					<div class="form-group guest-user">
	    					<label for="looker-mobile" class="control-label col-sm-2">My Mobile #</label>
	    					<div class="col-sm-10">
	      						<input type="text" class="form-control" id="looker-mobile" name="looker-mobile" placeholder="Enter Your Mobile Number">
	    					</div>
	  					</div>
  					@endif
			        <button type="button" class="btn btn-primary btn-block" id="find-post-btn">Post</button>
			      </form>
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
		</div>

@stop

@section('jsinclude')
        {{ HTML::script('js/home.js'); }}
@stop


