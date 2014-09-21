@extends('layouts/navhome')

@section('head')
        {{ HTML::style('css/dashboard.css'); }}
@stop

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

				<div class="panel with-nav-tabs panel-info">
                <div class="panel-heading">
                        <ul class="nav nav-tabs" id="dashboard-tab">
                            <li class="active"><a href="#tab1info" data-toggle="tab">Messages</a></li>
                            <li><a href="#tab2info" data-toggle="tab">Missing Person Reports</a></li>
                            <li><a href="#tab3info" data-toggle="tab">Contributions</a></li>
                            <li><a href="#tab4info" data-toggle="tab">Found Person Reports</a></li>
                            <li><a href="#tab5info" data-toggle="tab">Donation Causes Added</a></li>
                            <li><a href="#tab6info" data-toggle="tab">Info6</a></li>
                        </ul>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1info">
                            @if ($messages_list)
								<div class="messages-display">
						          <ul class="messages-list list-group">
						          	@foreach ($messages_list as $msg)
						          		<li class="list-group-item">{{ $msg->textbody }}. Please review them below!</li>
						          	@endforeach
						          </ul>
						      	</div>
					      	@endif
                        </div>
                        <div class="tab-pane fade" id="tab2info">
                    		@if ($find_people_list)
								<div class="find-people-display">
									<div class="panel-group" id="accordion">
										@foreach ($find_people_list as $person)
										<div class="panel panel-default">
											<!-- <div class="panel-heading"> -->
												<table class="panel-heading table table-bordered find-people-table" cellspacing="0" width="100%">
												<col class="fip-options">
												<col class="fip-review">
												<col class="fip-first-name">
										        <col class="fip-last-name">
										        <col class="fip-age">
							          			<tr>
							          				<td width="auto">
							          					<button type="button" class="btn btn-danger remove-fip-btn" name="remove-fip-btn" id="{{ $person->id }}" data-toggle="tooltip" data-placement="bottom" title="Delete this Missing Person Report">
							          						<span class="fa fa-remove fa-fw fa-lg"></span>
							          					</button>
							          				</td>

							          				<td class="find-person-status" id="{{ $person->id }}">
							          					<a data-toggle="collapse" data-parent="#accordion" href="#C{{ $person->id }}">
							          					@if ($person->found)
							          						FOUND
							          					@elseif ($person->matches()->count())
							          						Review Matches
							          					@endif
							          					</a>
							          				</td>
							          				<td>{{ $person->getFirstName() }}</td>
													<td>{{ $person->getLastName() }}</td>
													<td>{{ $person->age }}</td>
							     				</tr>
							     				</table>
											<!-- </div> -->
											<div id="C{{ $person->id }}" class="panel-collapse collapse"> <!-- adding class in makes default open -->
												<div class="panel-body">
													Panel body goes here.
												</div>
												<div class="matches-list list-group clearfix">
												@if ($person->matches()->count())
									          			@foreach ($person->matches()->get() as $match)
									          				<div class="list-group-item clearfix">
									          					<div class="row pull-left">
																	<span class="col-md-4">Match Name : {{ $match->getName() }}</span>
																	<span class="col-md-4">Match Age : {{ $match->getAge() }}</span>
																	<span class="col-md-4">Match Source : {{ $match->getSource() }}</span>
																</div>
																<div class="pull-right">
																	@if ( $match->isSourceClaimed() )
																		<span>Already claimed by 
																			@if ( $match->isSourceClaimerCurrentUser() )
																				You
																			@else
																				{{ $match->getSourceClaimerName() }}
																			@endif
																		</span>
																		<button type="button" class="btn btn-warning claim-btn" name="duplicate-claim-btn" id="{{ $match->id }}">Duplicate Claim</button>
																	@else
									          							<button type="button" class="btn btn-success claim-btn" name="claim-btn" id="{{ $match->id }}">Claim</button>
									          						@endif
									          					</div>
									          				</div>
									          			@endforeach
									          	@endif
												</div>
											</div>
										</div>
										@endforeach
									</div>
								</div>
							@endif
						</div>


								
                        <div class="tab-pane fade" id="tab3info">
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
                        <div class="tab-pane fade" id="tab4info">
                    		@if ($found_people_list)
								<div class="fop-display">
								  <h4 class="list-group-item list-group-item-info">Found-Person Reports</h4>
						          <ul class="fop-list list-group">
						          	@foreach ($found_people_list as $fop)
					          			<div class="list-group-item row">
											<span class="col-md-4">{{ $fop->getFirstName() }}</span>
											<span class="col-md-4">{{ $fop->getLastName() }}</span>
											<span class="col-md-4">{{ $fop->age }}</span>
										</div>
						          	@endforeach
						          </ul>
						      	</div>
					      	@endif
                        </div>
                        <div class="tab-pane fade" id="tab5info">
                    		@if ($donation_causes_list)
								<div class="dc-display">
								  <h4 class="list-group-item list-group-item-info">Donation Causes added by you: </h4>
						          <ul class="dc-list list-group">
						          	@foreach ($donation_causes_list as $dc)
					          			<div class="list-group-item row">
											<span class="col-md-3">{{ $dc->name }}</span>
											<span class="col-md-3">{{ $dc->description }}</span>
											<span class="col-md-2">
												<a href="{{ $dc->donation_url }}" target="_blank">Donation URL</a>
											</span>
											<span class="col-md-2">
												<a href="{{ route('donation.channel.edit', $dc->id) }}">
													<span class="fa fa-pencil fa-fw fa-lg">Edit</span></a>
											</span>
											<span class="col-md-2">
												<a href="{{ route('donation.channel.delete', $dc->id) }}">
													<span class="fa fa-remove fa-fw fa-lg">Delete</span></a>
											</span>
										</div>
						          	@endforeach
						          </ul>
						      	</div>
					      	@endif
                        </div>
                        <div class="tab-pane fade" id="tab6info">
                        	<h4 class="list-group-item list-group-item-info">Found-Person Reports</h4>
                        	<ul class="list-group">
                        		<li class="list-group-item">test</li>
                        		<li class="list-group-item">test</li>
                        		<li class="list-group-item">test</li>
                        		<li class="list-group-item">test</li>
                        		<li class="list-group-item">test</li>
                        		<li class="list-group-item">test</li>
                        	</ul>
                        	<h4 class="list-group-item list-group-item-info">Found-Person Reports</h4>
                        	<ul class="list-group">
                        		<div class="list-group-item row">
                        			<span class="col-md-4">first</span>
									<span class="col-md-4">name</span>
									<span class="col-md-4">age</span>
                        		</div>
                        		<div class="list-group-item row">
                        			<span class="col-md-4">first</span>
									<span class="col-md-4">name</span>
									<span class="col-md-4">age</span>
                        		</div>
                        		<div class="list-group-item row">
                        			<span class="col-md-4">first</span>
									<span class="col-md-4">name</span>
									<span class="col-md-4">age</span>
                        		</div>
                        		<div class="list-group-item row">
                        			<span class="col-md-4">first</span>
									<span class="col-md-4">name</span>
									<span class="col-md-4">age</span>
                        		</div>
                        	</ul>
                        </div>
                    </div>
                </div>
            </div>
		</div>  
	</div>  <!-- info -->
</div> <!-- wrap -->

@stop

@section('jsinclude')
        {{ HTML::script('js/dashboard.js'); }}

        <script>

		    $('#dashboard-tab a').click(function (e) {
		        e.preventDefault();
		        $(this).tab('show');
		    });

		    // store the currently selected tab in the hash value
		    $("ul.nav-tabs > li > a").on("shown.bs.tab", function (e) {
		        var id = $(e.target).attr("href").substr(1);
		        window.location.hash = id;
		        localStorage.setItem('dashboard-hash', window.location.hash);
		        window.scrollTo(0,0);
		    });

		    // on load of the page: switch to the currently selected tab
		    var hash = window.location.hash;

		    console.log("window.location.hash is =>");
		    console.log(hash); 

		    if (hash == "" && localStorage.getItem('dashboard-hash')) {
		    	console.log("==[empty hash and localStorage]===");
		    	hash = localStorage.getItem('dashboard-hash');
		    	console.log(hash);
		    }

		    console.log('tab to be shown =>');
		    console.log('#dashboard-tab a[href="' + hash + '"]');

		    $('#dashboard-tab a[href="' + hash + '"]').tab('show');

        </script>
@stop
