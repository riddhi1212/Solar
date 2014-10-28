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

	$('#find-people-form').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            'find-name': {
                message: 'The name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Missing Person name is required and cannot be empty'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z ]+$/,
                        message: 'The Missing Person name can only consist of alphabets and spaces'
                    }
                }
            },
            'find-age': {
                validators: {
                    notEmpty: {
                        message: 'The Missing Person age is required and cannot be empty'
                    },
                    digits: {
                        message: 'The Missing Person age can only contain digits'
                    },
                    between: {
                        min: 0,
                        max: 100,
                        message: 'The Missing Person age must be between 0 and 100'
                    }
                }
            },
            'looker-first-name': {
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
            'looker-last-name': {
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
            'looker-mobile': {
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
	// Remove FIP Link click // from inside Modal
	// ------------------

    $('#delete-fip-btn').click(function(){

        // Any checks ??


        // now POST to server
        $.ajax({
                type:"post",
                url: "/deletefip",
                data: $('#why-delete-form').serialize(),
                success:function(json) {
                    // Simply removing the parent doesn't work because this is a collapsible panel
                    location.reload();
                },
                error:function() {
                    alert("Error");
                }
        });
    
    });


    $('#delete-modal').on('show.bs.modal', function (e) {
        $('#delete-fip-btn').addClass('disabled');
    })


    $('#why').keyup(function() {
        var value = $(this).val();
        var form_group_elem = $(this).parent().parent();

        if (value.length == 0) {
            form_group_elem.removeClass('has-success');
            form_group_elem.addClass('has-error');
            form_group_elem.find(".help-block").text("This field cannot be left empty.");
            $('#delete-fip-btn').addClass('disabled');
        } else {
            form_group_elem.addClass('has-success');
            form_group_elem.removeClass('has-error');
            form_group_elem.find(".help-block").empty();
            $('#delete-fip-btn').removeClass('disabled');
        }

    });

}

$(document).ready(main);