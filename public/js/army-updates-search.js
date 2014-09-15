var main = function() {
	console.log("in main");

	// ------------------
	// Load data from DB
	// ------------------

	// DB: find-people



	// ------------------
	// Form Button Clicks
	// ------------------

	$('#army-updates-search-btn').click(function(){
		var name = $('#updates-name').val();

		if (name.length === 0) return;

		var age = $('#updates-age').val();

		// now POST to server
		$.ajax({
				type:"post",
				url:$("#army-updates-search-form").prop('action'),
				data:$("#army-updates-search-form").serialize(),
				success:function(json) {
					console.log("jquery post ajax success handler");

					var results = jQuery.parseJSON(json.results);
					console.log(results.length);

					$(".army-updates-list").html('');
					$(".army-updates-list").html('');

					var search_text = results.length + ' Matching Search Results Returned';
					console.log(search_text);
					$('.search-text').text(search_text);

					$.each(results, function(idx, update){
					     	var div = $('<div>').addClass('row');
							$('<p>').addClass('col-md-4').text(update["s-no"]).appendTo(div);
							$('<p>').addClass('col-md-4').text(update["first-name"]+" "+update["last-name"]).appendTo(div);
							$('<p>').addClass('col-md-4').text(update["age"]).appendTo(div); // NOTE: by not saved to DB yet
							$('<li>').append(div).addClass('list-group-item').prependTo('.army-updates-list'); 	
					   });
				},
				error:function() {
					alert("Error");
				}
		});

	});
}

$(document).ready(main);