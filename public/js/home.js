var main = function() {
	console.log("in main");

	// ------------------
	// Load data from DB
	// ------------------

	// DB: find-people



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
				success:function() {
				   // Display it on screen now that it has been POSTed to the DB
				   // TODO: change to reloading from DB

					var div = $('<div>').addClass('row');
					$('<p>').addClass('col-md-4').text(name).appendTo(div);
					$('<p>').addClass('col-md-4').text(age).appendTo(div);
					$('<p>').addClass('col-md-4').text(by).appendTo(div); // NOTE: by not saved to DB yet
					$('<li>').append(div).addClass('list-group-item').prependTo('.found-people-list'); 		
					// // Instead of
					// $('<li>').text(name).addClass('list-group-item').prependTo('.found-people-list');

					$('#found-name').val('');
					$('#found-age').val('');
					$('#found-tel').val('');
					$('#found-by').val('');

					// TODO: increment tracker
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
				success:function() {
				   // Display it on screen now that it has been POSTed to the DB
				   // TODO: change to reloading from DB
					$('<li>').text(name).addClass('list-group-item').prependTo('.find-people-list');

					$('#find-name').val('');
					$('#find-age').val('');
					$('#find-tel').val('');

					// TODO: increment tracker
				},
				error:function() {
					alert("Error");
				}
		});
	
	});
}

$(document).ready(main);