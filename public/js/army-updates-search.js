var main = function() {
	console.log("in main");

	// ------------------
	// Form Button Clicks
	// ------------------

	$('#army-updates-search-btn').click(function(){
		var name = $('#updates-name').val();
		var age = $('#updates-age').val();
		var sno = $('#updates-sno').val();

		// Validate that atleast one is filled
		if (name.length === 0 && age.length === 0 && sno.length === 0) return;

		console.log($("#army-updates-search-form").serializeArray());

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
					$('.search-text').text(search_text);

					$('.search-explanation').text(json.explanation);

					$.each(results, function(idx, update){
					     	var div = $('<div>').addClass('row');
							$('<p>').addClass('col-md-4').text(update["s-no"]).appendTo(div);
							$('<p>').addClass('col-md-4').text(update["first-name"]+" "+update["last-name"]).appendTo(div);
							$('<p>').addClass('col-md-4').text(update["age"]).appendTo(div); 
							//$('<li>').append(div).addClass('list-group-item').prependTo('.army-updates-list'); 	
							var a_elem = $('<a>');
							a_elem.attr( "href", update["fb-url"] );
							a_elem.attr( "target", "_blank" );
							a_elem.append(div).addClass('list-group-item').prependTo('.army-updates-list'); 
					   });
				},
				error:function() {
					alert("Error");
				}
		});

	});
}

$(document).ready(main);