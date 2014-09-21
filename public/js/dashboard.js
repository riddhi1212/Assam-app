var main = function() {
	console.log("in main");

	// ------------------
	// Remove-fip Button click
	// ------------------

	$('.remove-fip-btn').click(function(){

		// Any checks ??


		var id = $(this).attr('id');
		var fip_data = { "fip-id" : id }; // this is a JS obj

		console.log("Sending fip_data to backend : ");
		console.log(fip_data);

		// now POST to server
		$.ajax({
				type:"post",
				url: "/deletefip",
				data: fip_data,
				success:function(json) {
					location.reload();
				},
				error:function() {
					alert("Error");
				}
		});
	
	});

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