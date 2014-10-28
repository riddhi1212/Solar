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

	// --------------------
	// Validation
	// --------------------

	$('#found-people-form').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            'found-name': {
                message: 'The name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Found Person name is required and cannot be empty'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z ]+$/,
                        message: 'The Found Person name can only consist of alphabets and spaces'
                    }
                }
            },
            'found-age': {
                validators: {
                    notEmpty: {
                        message: 'The Found Person age is required and cannot be empty'
                    },
                    digits: {
                        message: 'The Found Person age can only contain digits'
                    },
                    between: {
                        min: 0,
                        max: 100,
                        message: 'The Found Person age must be between 0 and 100'
                    }
                }
            },
            'found-father-name': {
                message: 'The name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Father\'s name of Found Person is required and cannot be empty'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z ]+$/,
                        message: 'The Father\'s name can only consist of alphabets and spaces'
                    }
                }
            },
            'finder-first-name': {
                validators: {
                    notEmpty: {
                        message: 'Your first name is required and cannot be empty'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z ]+$/,
                        message: 'Your first name can only consist of alphabets and spaces'
                    }
                }
            },
            'finder-last-name': {
                validators: {
                    notEmpty: {
                        message: 'Your last name is required and cannot be empty'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z ]+$/,
                        message: 'Your last name can only consist of alphabets and spaces'
                    }
                }
            },
            'finder-mobile': {
                validators: {
                    notEmpty: {
                        message: 'Your mobile number is required and cannot be empty'
                    },
                    digits: {
                        message: 'Your mobile number can only contain digits'
                    },
                    regexp: {
                    	regexp: /^\d{10}$/,
                    	message: 'Your mobile number needs to have 10 digits'
                    }
                }
            }
        }
    }).on('success.form.bv', function(e) {
        // Prevent form submission
        e.preventDefault();

        // Get the form instance
        var $form = $(e.target);

        // Get the BootstrapValidator instance
        var bv = $form.data('bootstrapValidator');

        console.log("Sending data to backend now");

		// now POST to server
		$.ajax({
				type: "post",
				url: $form.prop('action'),
				data: $form.serialize(),
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


}

$(document).ready(main);