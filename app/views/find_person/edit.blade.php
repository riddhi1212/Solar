@extends('layouts/navhome')

@section('head')
        
@stop

@section('content')
<div id="wrap">
	<div class="stripe">
		<div class="container">
			<h4>You cannot change Name and Age details using this form. If you want to change those, delete this report and add another Missing Person Report.</h4>
			<p class="pull-left">Edit your Missing Person Report here :</p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
			<h2 class="col-md-offset-4">Missing Person Report details :</h2>
	      	<form class="form-horizontal" id="edit-find-person-form" method="post" action={{ route('find.person.edit') }} enctype="multipart/form-data">
	        	{{ Form::hidden('fip-id', $fip->id); }}
	        	<div class="form-group">
					<label for="fip-first-name" class="control-label col-sm-4">First Name : </label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="fip-first-name" name="fip-first-name" placeholder="{{ $fip->getFirstName() }}" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="fip-last-name" class="control-label col-sm-4">Last Name : </label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="fip-last-name" name="fip-last-name" placeholder="{{ $fip->getLastName() }}" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="fip-age" class="control-label col-sm-4">Age : </label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="fip-age" name="fip-age" placeholder="{{ $fip->age }}" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="fip-photo" class="control-label col-sm-4">Current Photo : </label>
					<div class="col-md-8">
						<div class="thumbnail">
							@if ($fip->photo_url)
								<img src="{{ $fip->photo_url }}" class="img-responsive">
							@else
								<img src="http://dummyimage.com/250x120&text=No image specified" class="img-responsive">
							@endif
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="fip-photo-file" class="control-label col-sm-4">Change Photo : </label>
					<div class="col-sm-8">
						{{ Form::file('fip-photo-file') }}
					</div>
				</div>
				<div class="form-group">
					<label for="fip-desc" class="control-label col-sm-4">
						Description
					</label>
					<div class="col-sm-8">
							<textarea class="form-control" id="fip-desc" name="fip-desc">{{ $fip->getDescription() }}</textarea>
							(Add any additional details here: e.g. father's name, height, skin-color, gender etc.)
					</div>
				</div>
	        	<button type="submit" class="btn btn-primary btn-block" id="fip-edit-btn">Edit</button>
	      	</form>
	    </div>
	</div>


</div> <!-- wrap -->

@stop

@section('jsinclude')

	<script>

		$(document).ready(function() {

			var desc_height = $("#fip-desc").get(0).scrollHeight;
			$("#fip-desc").css({"height": desc_height});

		});

	</script>

@stop
