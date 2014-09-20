var main = function() {
	console.log("in main");

	// ------------------
	// Load data from DB
	// ------------------

	// DB: find-people



	// ------------------
	// Claim Button Clicks
	// ------------------

	$('.claim-btn').click(function(){

		// Any checks ??


		var id = $(this).attr('id');
		var match_data = { "match-id" : id }; // this is a JS obj

		console.log(match_data);

		// now POST to server
		$.ajax({
				type:"post",
				url: "/claim",
				data: match_data,
				success:function(json) {
					location.reload();
				},
				error:function() {
					alert("Error");
				}
		});
	
	});

	$('.duplicate-claim-btn').click(function(){

		// Any checks ??


		var id = $(this).attr('id');
		var match_data = { "match-id" : id }; // this is a JS obj

		console.log(match_data);

		// now POST to server
		$.ajax({
				type:"post",
				url: "/duplicateclaim",
				data: match_data,
				success:function(json) {
					location.reload();
				},
				error:function() {
					alert("Error");
				}
		});
	
	});
}

$(document).ready(main);