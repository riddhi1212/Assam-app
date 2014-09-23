@extends('layouts/navhome')

<style>
.about {
	background-color: rgb(235,235,235);
}
</style>

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
	<br>
	<div class="container">
		<div class="row">
			<div class="col-md-8 about">
				<h1>About Me</h1>
				<p>I graduated with a B.S. and M.S. in Computer Science from Stanford University.</p>
				<p>After a bunch of amazing work experiences (Engineer, Product Manager, Venture Capitalist) in the U.S. I decided working for someone else was not for me.</p>
				<p>I'm passionate about solving problems, and love building things to solve real needs. I always think about how to improve things further.</p>
				<p>I like meeting like-minded people, so if you're so inclined, drop me a message via the Contact Me form and I'd love to chat further.</p>
				<p>I built this web-platform in 7 days time, and have barely slept. I will continue to add more features over the next 2 weeks or so. If you want some feature added, please write to me using the Contact Us form with the Purpose field set to Feature Request.</p>
				<p>This platform also happens to be my very first <u>completely solo</u> adventure into the world of web-development, encompassing everything e.g. Design, CSS, Front-end scripting, Server side programming, Database design, Product management, analytics, deployment and production.
				It has been an amazing experience so far and I've learnt a lot. I've taught myself around 10-15 new technologies over the last week while trying to implement various kinds of functionality for this platform.
				</p>
			</div>
		</div> <!-- row -->
	</div> <!-- container -->
	<br>
	<div class="stripe">
		<div class="container">
			<p>This site was created using jQuery, Bootstrap, Laravel, Homestead (nginx with php-fpm), Vagrant and Forge, and is hosted on Digital Ocean.</p>
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
