var main = function() {

	$('#updates-name').keyup(function() {
		var value = $(this).val();
		var form_group_elem = $(this).parent().parent();

		if (value == "") {
			form_group_elem.removeClass('has-error');
			form_group_elem.removeClass('has-success');
			form_group_elem.find(".help-block").empty();
			$('#army-updates-search-btn').removeClass('disabled');
			return;
		}

		var patt = new RegExp(/^[a-zA-Z ]+$/);
		var res = patt.test(value);

		if (!res) {
			form_group_elem.removeClass('has-success');
			form_group_elem.addClass('has-error');
			form_group_elem.find(".help-block").text("Name can only have alphabets and spaces");
			$('#army-updates-search-btn').addClass('disabled');
		} else {
			form_group_elem.removeClass('has-error');
			form_group_elem.addClass('has-success');
			form_group_elem.find(".help-block").empty();
			$('#army-updates-search-btn').removeClass('disabled');
		}
	});

	$('#updates-age').keyup(function() {
		var value = $(this).val();
		var form_group_elem = $(this).parent().parent();
		
		if (value == "") {
			form_group_elem.removeClass('has-error');
			form_group_elem.removeClass('has-success');
			form_group_elem.find(".help-block").empty();
			$('#army-updates-search-btn').removeClass('disabled');
			return;
		}
		if (parseInt(value) < 0 || parseInt(value) > 100) {
			form_group_elem.addClass('has-error');
			form_group_elem.removeClass('has-success');
			form_group_elem.find(".help-block").text("Age has to be between 0 and 100");
			$('#army-updates-search-btn').addClass('disabled');
			return;
		}

		var patt = new RegExp(/^[0-9]+$/);
		var res = patt.test(value);

		if (!res) {
			form_group_elem.removeClass('has-success');
			form_group_elem.addClass('has-error');
			form_group_elem.find(".help-block").text("Age can only have digits");
			$('#army-updates-search-btn').addClass('disabled');
		} else {
			form_group_elem.removeClass('has-error');
			form_group_elem.addClass('has-success');
			form_group_elem.find(".help-block").empty();
			$('#army-updates-search-btn').removeClass('disabled');
		}
	});

	$('#updates-sno').keyup(function() {
		var value = $(this).val();
		var form_group_elem = $(this).parent().parent();
		
		if (value == "") {
			form_group_elem.removeClass('has-error');
			form_group_elem.removeClass('has-success');
			form_group_elem.find(".help-block").empty();
			$('#army-updates-search-btn').removeClass('disabled');
			return;
		}

		var patt = new RegExp(/^[0-9]+$/);
		var res = patt.test(value);

		if (!res) {
			form_group_elem.removeClass('has-success');
			form_group_elem.addClass('has-error');
			form_group_elem.find(".help-block").text("Serial number can only have digits");
			$('#army-updates-search-btn').addClass('disabled');
		} else {
			form_group_elem.removeClass('has-error');
			form_group_elem.addClass('has-success');
			form_group_elem.find(".help-block").empty();
			$('#army-updates-search-btn').removeClass('disabled');
		}
	});


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
					var results = jQuery.parseJSON(json.results);
					console.log(results.length);

					$(".army-updates-list").empty();

					var search_text = results.length + ' Matching Search Results Returned';
					$('.search-text').text(search_text);

					$('.search-explanation').text(json.explanation);

					$.each(results, function(idx, update){
					     	var div = $('<div>').addClass('row');
							$('<p>').addClass('col-md-4').text(update["s_no"]).appendTo(div);
							$('<p>').addClass('col-md-4').text(update["first_name"]+" "+update["last_name"]).appendTo(div);
							$('<p>').addClass('col-md-4').text(update["age"]).appendTo(div); 
							//$('<li>').append(div).addClass('list-group-item').prependTo('.army-updates-list'); 	
							var a_elem = $('<a>');
							a_elem.attr( "href", update["fb_url"] );
							a_elem.attr( "target", "_blank" );
							a_elem.append(div).addClass('list-group-item').prependTo('.army-updates-list'); 
					   });


					// clear out the paginator links
					$(".army-updates-pag-links").empty();
				},
				error:function() {
					alert("Error");
				}
		});

	});
}

$(document).ready(main);