var main = function() {
	

	// ------------------
	// delete Modal after hiding
	// ------------------

	// $('#myModal').on('hidden.bs.modal', function (e) {
	
	// 	var id = $(this).attr('id');
	// 	var fip_data = { "fip-id" : id }; // this is a JS obj

	// 	console.log("Sending fip_data to backend : ");
	// 	console.log(fip_data);

	// 	// now POST to server
	// 	$.ajax({
	// 			type:"post",
	// 			url: "/deletefip",
	// 			data: fip_data,
	// 			success:function(json) {
	// 				// Simply removing the parent doesn't work because this is a collapsible panel
	// 				location.reload();
	// 			},
	// 			error:function() {
	// 				alert("Error");
	// 			}
	// 	});

	// })


	// ------------------
	// Remove-fip Button click (from inside Modal)
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
						console.log("removed");
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