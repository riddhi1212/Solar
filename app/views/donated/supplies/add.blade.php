@extends('layouts/navhome')

@section('head')


@stop

@section('content')
<div id="wrap">

	<div class="stripe">
		<div class="container">
			<h3>Thank YOU for Donating Supplies.</h3>
			<h4>Please Register your Donation here, so we can increase transparency and accountability in the system.</h4>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h2>Donation Details : </h2>
				{{ Form::open(array('action' => 'RegisterDonatedSupplyController@create',
											'method' => 'post',
											'files'  => true,
											'class'	 => 'form-horizontal',
											'id'     => 'register-donated-supplies-form')) }}
					<div>
						{{ Form::label('list', 'Supplies List:', array('class' => 'control-label col-sm-4')); }}
						<div class="col-sm-8" id="supplies">
							<div class="row">
								<div class="col-xs-1">#</div>
								<div class="col-xs-3">Number</div>
								<div class="col-xs-7">Supply Name</div>
							</div>
							<div class="row">
								<div class="col-xs-1 item-id">1</div>
								<div class="col-xs-3">
									{{ Form::text('supply-number[1]', '0', array('class' => 'form-control')); }}
								</div>
								<div class="col-xs-7">
									{{ Form::select('supply-name[1]', DonatedSuppliesList::getListAsArray(), null,
																	   array('class' => 'form-control supply-name first') ); }}
								</div>

							</div>
							
							{{ Form::button('Add Another Item', array('class' => 'btn btn-primary btn-block',
																   'id' => 'add-supply-btn' )); }}
						</div>
					</div>

					<div class="form-group">
						{{ Form::label('comments', 'Other Text:', array('class' => 'control-label col-sm-4')); }}
						<div class="col-sm-8">
							{{ Form::textarea('comments', 'Enter anything else you want to here', array('class' => 'form-control',
																						   'id' => 'comments')); }}
						</div>
					</div>

					<div class="form-group">
						{{ Form::label('receipt-file', 'Receipt Photo:', array('class' => 'control-label col-sm-4')); }}
						<div class="col-sm-8">
							{{ Form::file('receipt-file'); }}
						</div>
					</div>

					@if (Auth::guest())
					<div class="guest-user">
						<div class="form-group">
							{{ Form::label('guest-first-name', 'Your first name :', array('class' => 'control-label col-sm-4')); }}
							<div class="col-sm-8">
								{{ Form::text('guest-first-name', 'Enter your first name', array('class' => 'form-control',
																						            'id' => 'guest-first-name')); }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('guest-last-name', 'Your last name :', array('class' => 'control-label col-sm-4')); }}
							<div class="col-sm-8">
								{{ Form::text('guest-last-name', 'Enter your last name', array('class' => 'form-control',
																						          'id' => 'guest-last-name')); }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('guest-mobile', 'Your mobile number :', array('class' => 'control-label col-sm-4')); }}
							<div class="col-sm-8">
								{{ Form::text('guest-mobile', 'Enter your mobile number', array('class' => 'form-control',
																						           'id' => 'guest-mobile')); }}
							</div>
						</div>
					</div>
					@endif

					{{ Form::submit('Register My Donation', array('class' => 'btn btn-primary btn-block',
														   'id' => 'register-donated-supplies-btn' )); }}

				{{ Form::close() }}

			</div>
		</div> <!-- row -->
	</div> <!-- container -->

</div>

@stop

@section('jsinclude')
<script>
	$(document).ready(function() {

		$('#add-supply-btn').click(function() {

			var supply_names = $('')

			var row = $('<div>').addClass('row');
			var last_item_id = $('.item-id').last().text();
			var use_id = parseInt(last_item_id) + 1;
			var item_id = $('<div>').addClass('col-xs-1').addClass('item-id').text(use_id);
			var input_num = $('<input>').addClass('form-control').attr('name', 'supply-number['+use_id+']').attr('type', 'text').val('0');
			var item_num = $('<div>').addClass('col-xs-3').append(input_num);
			var select = $('<select>').addClass('form-control').attr('name', 'supply-name['+use_id+']');
			$(".first option").each(function()
			{
				var option = $('<option>').val($(this).val());
				option.text($(this).text());
				select.append(option);
			});
			var item_name = $('<div>').addClass('col-xs-7').append(select);

			var a_elem = $('<a>').addClass('remove-supply-btn').attr('href', '#').html('<span class="fa fa-remove fa-fw fa-lg"></span>');
			var del_btn = $('<div>').addClass('col-xs-1').append(a_elem);


			row.append(item_id).append(item_num).append(item_name).append(del_btn);


			$(this).before(row);
		});

		// Doing it this way so that even jQuery added btns register clicks
		$('#supplies').on('click', '.remove-supply-btn', function() {
			console.log("remove ***in on**** clicked");
			$(this).parent().parent().remove();
		});

		// $('#register-donated-supplies-btn').click(function(){

		// 	console.log($('#register-donated-supplies-form').serialize());
		// 	alert('Thank you for registering!');

		// 	// now POST to server
		// 	$.ajax({
		// 		type:"post",
		// 		url:$("#register-donated-supplies-form").prop('action'),
		// 		data:$("#register-donated-supplies-form").serialize(),
		// 		success: function(json) {
		// 			alert('Thank you for submitting the Contact me form.');
					
		// 			$('#purpose').val('feedback');
		// 			$('#comments').val('Enter your text here');
		// 			$('#guest-first-name').val('Enter your first name');
		// 			$('#guest-last-name').val('Enter your last name');
		// 			$('#guest-mobile').val('Enter your mobile number');

		// 		},
		// 		error:function() {
		// 			alert("Error");
		// 		}
		// 	});

		// });

	});
</script>
        
@stop
