@extends('layouts/navhome')

@section('head')
        {{ HTML::style('css/armyupdates.css'); }}
@stop

@section('content')
		<div id="wrap">
			<div class="stripe">
				<div class="container">
					<p class="pull-left">ARMY Updates of Rescued People</p>
					<p class="pull-right">Number of Records Uploaded So far : {{ $army_updates_pag->getTotal() }} Records</p>
				</div>
			</div>

			<div class="row">
			  <div class="col-md-8">
			    <div class="army_updates">
			   	  
			   	  <p>You don't have to enter all three fields. Enter one or more to Search.</p>
			      <form class="form-horizontal" id="army-updates-search-form" method="post" action={{ route('army.updates.search') }}>
			        <!-- TODO Add help text for each -->
			        <div class="form-group">
    					<label for="updates-sno" class="control-label col-sm-2">S.no.</label>
    					<div class="col-sm-10">
      						<input type="text" class="form-control" id="updates-sno" name="updates-sno" placeholder="Enter Serial Number">
    					</div>
  					</div>
			        <div class="form-group">
    					<label for="updates-name" class="control-label col-sm-2">Name</label>
    					<div class="col-sm-10">
      						<input type="text" class="form-control" id="updates-name" name="updates-name" placeholder="Enter Name">
    					</div>
  					</div>
  					<div class="form-group">
    					<label for="updates-age" class="control-label col-sm-2">Age</label>
    					<div class="col-sm-10">
      						<input type="text" class="form-control" id="updates-age" name="updates-age" placeholder="Enter Age">
    					</div>
  					</div>
			        <button type="button" class="btn btn-primary btn-block" id="army-updates-search-btn">Search</button>
			      </form>
			      <br>
			      <div class="army-updates-display">
			      	  <p class="search-explanation"></p>
			      	  <p class="search-text"></p>
			      	  <div class="army-updates-pag-links">
			          	{{ $army_updates_pag->links() }}
			          </div>
			      	  <li class="list-group-item list-group-item-info">
			      	  	<div class="row">
	      	  				<h4 class="col-md-4">S.no.</h4>
							<h4 class="col-md-4">Name</h4>
							<h4 class="col-md-4">Age</h4>
			      	  	</div>
			      	  </li>
			          <div class="army-updates-list list-group">
			          	@foreach ($army_updates_pag->getCollection()->all() as $update)
					  	  	<a class="list-group-item" href={{ $update->fb_url }} target="_blank">
				           		<div class="row">
				           			<span class="col-md-4">{{ $update->s_no }}</span>
									<span class="col-md-4">{{ $update->getFullName() }}</span>
									<span class="col-md-4">{{ $update->age }}</span>
								</div>
							</a>
			          	@endforeach
			          </div>
			      </div>
			    </div>
			  </div>
			</div>
		</div>

@stop

@section('jsinclude')
        {{ HTML::script('js/army-updates-search.js'); }}
@stop
