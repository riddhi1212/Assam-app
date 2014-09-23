var resetNavLinks = function(json) {
		// Reset Nav bar links (but only the first time) 
	if ( $('#auth-username').length === 0 ) { // this means jQuery did not find the selector // means First Time
		console.log('didnt find auth username');

		var span_elem = $('<span>').attr('id','auth-username').text(json.username + " ");
		var badge_elem = $('<span>').addClass('badge').attr('id','notification-count').text(0);
		var a_elem = $('<a>').attr('href','/dashboard').text('Welcome back ');
		$('<li>').append(a_elem.append(span_elem).append(badge_elem)).prependTo('#right-nav-section');

		$('#log-text').empty().append($('<a>').attr('href','/logout').text('Log Out'));
	} else {
		// This shows ALL Msg Count
		$('#notification-count').text(json.msgCount);


		// TODO : use the following if you want New Notification Count. 
		//	''+json.notificationCount);
	}
}

var main = function() {
	console.log("in main");

	// ------------------
	// Remove FIP Link click
	// ------------------

	$('.remove-fip-link').click(function() {
		
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
					// remove the list-group-item displaying this FIP
					$('.remove-fip-link#'+id).parent().remove();
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
	// Form Button Clicks
	// ------------------

	$('#found-post-btn').click(function(){
		var name = $('#found-name').val();

		if (name.length === 0) return;

		var age = $('#found-age').val();
		var tel = $('#found-tel').val();
		var by = $('#found-by').val();

		// now POST to server
		$.ajax({
				type:"post",
				url:$("#found-people-form").prop('action'),
				data:$("#found-people-form").serialize(),
				success:function(json) {
					location.reload();

					// var div = $('<div>').addClass('row');
					// $('<span>').addClass('col-md-4').text(json.fname).appendTo(div);
					// $('<span>').addClass('col-md-4').text(json.lname).appendTo(div);
					// $('<span>').addClass('col-md-4').text(json.age).appendTo(div); // NOTE: by not saved to DB yet
					// $('<li>').append(div).addClass('list-group-item').appendTo('#found-people-list-header'); 		
					// // // Instead of
					// // $('<li>').text(name).addClass('list-group-item').prependTo('.found-people-list');

					// $('#found-name').val('');
					// $('#found-age').val('');
					// $('#found-tel').val('');
					// $('#found-by').val('');

					// // increment tracker
					// $("#found-count").text(parseInt($("#found-count").text()) + 1);

					// resetNavLinks(json);

					// // hide guest-user div tags
					// $('.guest-user').empty();
				},
				error:function() {
					alert("Error");
				}
		});

	});
	$('#find-post-btn').click(function(){
		var name = $('#find-name').val();
		if (name.length === 0) return;

		// now POST to server
		$.ajax({
				type:"post",
				url:$("#find-people-form").prop('action'),
				data:$("#find-people-form").serialize(),
				success:function(json) {
					location.reload();

				 //   	var div = $('<div>').addClass('row');
					// $('<span>').addClass('col-md-4').text(json.fname).appendTo(div);
					// $('<span>').addClass('col-md-4').text(json.lname).appendTo(div);
					// $('<span>').addClass('col-md-4').text(json.age).appendTo(div);
					// div = div.addClass('list-group-item').addClass('row');
					// $('#find-people-list-header').after(div);

					// $('#find-name').val('');
					// $('#find-age').val('');
					// $('#find-tel').val('');

					// // increment tracker
					// $("#find-count").text(parseInt($("#find-count").text()) + 1);

					// resetNavLinks(json);

					// // hide guest-user div tags
					// $('.guest-user').empty();
				},
				error:function() {
					alert("Error");
				}
		});
	
	});
}

$(document).ready(main);