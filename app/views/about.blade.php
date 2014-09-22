@extends('layouts/navhome')

@section('content')
<div id="wrap">

	<div class="stripe">
		<div class="container">
			<span>You can reach me here:</span>
			<a target="_blank" href="http://www.linkedin.com/in/riddhimittal"><span class="fa fa-linkedin fa-fw fa-2x"></span></a>
			<a target="_blank" href="http://twitter.com/riddhi_mittal"><span class="fa fa-twitter fa-fw fa-2x"></span></a>
			<a target="_blank" href="http://www.facebook.com/riddhi.mittal"><span class="fa fa-facebook fa-fw fa-2x"></span></a>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h1>About Me</h1>
				<p>Developer:...</p>
				<p>...</p>
				<h2>Contact Me :</h2>

				{{ Form::open(array('action' => 'UsersController@contactMe',
									'method' => 'post',
									'class'	 => 'form-horizontal',
									'id'     => 'contact-me-form')) }}


					<div class="form-group">
						{{ Form::label('purpose', 'Purpose:', array('class' => 'control-label col-sm-4')); }}
						<div class="col-sm-8">
							{{ Form::select('purpose', array(
														   'feedback' => 'Feedback',
														   'feature' => 'Feature Request',
														   'error' => 'Error Report',
														   'help' => 'I need help',
														   'dev' => 'I am a developer and want to contribute',
														   'other' => 'Other'),
													   array('class' => 'form-control',
																'id' => 'purpose') ); }}
						</div>
					</div>

					<div class="form-group">
						{{ Form::label('comments', 'Comments', array('class' => 'control-label col-sm-4')); }}
						<div class="col-sm-8">
							{{ Form::textarea('comments', 'Enter your text here', array('class' => 'form-control',
																						   'id' => 'comments')); }}
						</div>
					</div>

					@if (true)
					<div class="guest-user">
						<div class="form-group">
							{{ Form::label('guest-first-name', 'My first name :', array('class' => 'control-label col-sm-4')); }}
							<div class="col-sm-8">
								{{ Form::text('guest-first-name', 'Enter your first name', array('class' => 'form-control',
																						            'id' => 'guest-first-name')); }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('guest-last-name', 'My last name :', array('class' => 'control-label col-sm-4')); }}
							<div class="col-sm-8">
								{{ Form::text('guest-last-name', 'Enter your last name', array('class' => 'form-control',
																						          'id' => 'guest-last-name')); }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('guest-mobile', 'My mobile number :', array('class' => 'control-label col-sm-4')); }}
							<div class="col-sm-8">
								{{ Form::text('guest-mobile', 'Enter your mobile number', array('class' => 'form-control',
																						           'id' => 'guest-mobile')); }}
							</div>
						</div>
					</div>
					@endif

					{{ Form::button('Contact Me', array('class' => 'btn btn-primary btn-block',
														   'id' => 'contact-me-btn' )); }}

				{{ Form::close() }}

				<h4>Or email me at kashmirfloods2014@gmail.com.</h4>
			</div>
		</div> <!-- row -->
	</div> <!-- container -->

	<div class="stripe created-using">
		<div class="container">
			<p>This site was created using Bootstrap, Laravel, Homestead, Vagrant and Forge.</p>
		</div>
	</div>

</div>

@stop

@section('jsinclude')
<script>
	$(document).ready(function() {

		console.log("RELOADED");

		$('#contact-me-btn').click(function(){
			// now POST to server
			$.ajax({
				type:"post",
				url:$("#contact-me-form").prop('action'),
				data:$("#contact-me-form").serialize(),
				success: function(json) {
					alert('Thank you for submitting the Contact me form.');
					
					$('#purpose').val('feedback');
					$('#comments').val('Enter your text here');
					$('#guest-first-name').val('Enter your first name');
					$('#guest-last-name').val('Enter your last name');
					$('#guest-mobile').val('Enter your mobile number');

				},
				error:function() {
					alert("Error");
				}
			});
		});

	});
</script>
        
@stop
