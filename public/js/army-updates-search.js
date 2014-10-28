

var checkSno = function() {
	var value = $('#updates-sno').val();
	var form_group_elem = $('#updates-sno').parent().parent();
	
	if (value == "") {
		form_group_elem.removeClass('has-error');
		form_group_elem.removeClass('has-success');
		form_group_elem.find(".help-block").empty();
		return true;
	} else {
		if ($('#updates-name').val().length > 0 || $('#updates-age').val().length > 0) {
			form_group_elem.removeClass('has-success');
			form_group_elem.addClass('has-error');
			form_group_elem.find(".help-block").text("Serial number is unique. Remove Name and Age and then search by Serial number.");
			return false;
		}
	}

	var patt = new RegExp(/^[0-9]+$/);
	var res = patt.test(value);

	if (!res) {
		form_group_elem.removeClass('has-success');
		form_group_elem.addClass('has-error');
		form_group_elem.find(".help-block").text("Serial number can only have digits");
		return false;
	} else {
		form_group_elem.removeClass('has-error');
		form_group_elem.addClass('has-success');
		form_group_elem.find(".help-block").empty();
		return true;
	}
}

var checkName = function() {
	var value = $('#updates-name').val();
	var form_group_elem = $('#updates-name').parent().parent();

	if (value == "") {
		form_group_elem.removeClass('has-error');
		form_group_elem.removeClass('has-success');
		form_group_elem.find(".help-block").empty();
		return true;
	} else {
		if ($('#updates-sno').val().length > 0) {
			form_group_elem.removeClass('has-success');
			form_group_elem.addClass('has-error');
			form_group_elem.find(".help-block").text("You cannot search by Name if you are also searching by Serial number.");
			return false;
		}
	}

	var patt = new RegExp(/^[a-zA-Z ]+$/);
	var res = patt.test(value);

	if (!res) {
		form_group_elem.removeClass('has-success');
		form_group_elem.addClass('has-error');
		form_group_elem.find(".help-block").text("Name can only have alphabets and spaces");
		return false;
	} else {
		form_group_elem.removeClass('has-error');
		form_group_elem.addClass('has-success');
		form_group_elem.find(".help-block").empty();
		return true;
	}
}

var checkAge = function() {
	var value = $('#updates-age').val();
	var form_group_elem = $('#updates-age').parent().parent();

	if (value == "") {
		form_group_elem.removeClass('has-error');
		form_group_elem.removeClass('has-success');
		form_group_elem.find(".help-block").empty();
		return true;
	} else {
		if ($('#updates-sno').val().length > 0) {
			form_group_elem.removeClass('has-success');
			form_group_elem.addClass('has-error');
			form_group_elem.find(".help-block").text("You cannot search by Age if you are also searching by Serial number.");
			return false;
		}
	}

	var patt = new RegExp(/^[0-9]+$/);
	var res = patt.test(value);

	if (!res) {
		form_group_elem.removeClass('has-success');
		form_group_elem.addClass('has-error');
		form_group_elem.find(".help-block").text("Age can only have digits");
		return false;
	} else {
		form_group_elem.removeClass('has-error');
		form_group_elem.addClass('has-success');
		form_group_elem.find(".help-block").empty();
		return true;
	}

	if (parseInt(value) < 0 || parseInt(value) > 100) {
		form_group_elem.addClass('has-error');
		form_group_elem.removeClass('has-success');
		form_group_elem.find(".help-block").text("Age has to be between 0 and 100");
		return false;
	} else {
		form_group_elem.removeClass('has-error');
		form_group_elem.addClass('has-success');
		form_group_elem.find(".help-block").empty();
		return true;
	}
}

var checkOnKeyUp = function() {

	var sno_ok = checkSno();
	var name_ok = checkName();
	var age_ok = checkAge();

	if (sno_ok && name_ok && age_ok) {
		$('#army-updates-search-btn').removeClass('disabled');
	} else {
		$('#army-updates-search-btn').addClass('disabled');
	}
}

var main = function() {

	$('#updates-name').keyup(function() {
		checkOnKeyUp();
	});

	$('#updates-age').keyup(function() {
		checkOnKeyUp();
	});

	$('#updates-sno').keyup(function() {
		checkOnKeyUp();
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

					$('.search-text').empty();
					var search_text = results.length + ' Matching Search Results Returned.';
					$('.search-text').append($('<p>').addClass('pull-left').text(search_text));
					$('.search-text').append($('<a>').attr('href', 'updates').addClass('btn btn-info pull-right').text('View All ARMY Updates Again'));

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