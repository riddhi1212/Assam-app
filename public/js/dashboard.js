var main = function() {
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
	// Remove FOP Link click
	// ------------------

	$('.remove-fop-link').click(function() {
		
		var id = $(this).attr('id');
		var fop_data = { "fop-id" : id }; // this is a JS obj

		console.log("Sending fop_data to backend : ");
		console.log(fop_data);

		// now POST to server
		$.ajax({
				type:"post",
				url: "/deletefop",
				data: fop_data,
				success:function(json) {
					if (json.deleted) {
						// remove the list-group-item displaying this FIP
						$('.remove-fop-link#'+id).parent().remove();
					} else {
						alert('Cannot delete because someone has claimed this Found Person Report');
					}
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