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
			</div>
		</div> <!-- row -->
	</div> <!-- container -->

	<div class="stripe created-using">
		<div class="container">
			<p>This site was created using jQuery, Bootstrap, Laravel, Homestead, Vagrant and Forge, and is hosted on Digital Ocean.</p>
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
