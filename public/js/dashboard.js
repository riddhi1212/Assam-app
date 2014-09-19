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
					console.log('====Claim Returned fip_id ====');
				   	console.log(json['fip-id']);

				   	var selector = '#' + json['fip-id'] + '.find-person-status';
				   	$(selector).empty().text("FOUND !!");

				   	// TODO : remove matches display

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
					console.log('====Claim Returned fip_id ====');
				   	console.log(json['fip-id']);

				   	var selector = '#' + json['fip-id'] + '.find-person-status';
				   	$(selector).empty().text("FOUND !!");

				   	// TODO : remove matches display

				},
				error:function() {
					alert("Error");
				}
		});
	
	});
}

$(document).ready(main);