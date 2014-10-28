@extends('layouts/navhome')

@section('head')
        
@stop

@section('content')
<div id="wrap">
	<div class="stripe">
		<div class="container">
			<h4>You cannot change Name and Age details using this form. If you want to change those, delete this report and add another Found Person Report.</h4>
			<p class="pull-left">Edit your Found Person Report here :</p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
			<h2 class="col-md-offset-4">Found Person Report details :</h2>
	      	<form class="form-horizontal" id="edit-found-person-form" method="post" action={{ route('found.person.edit') }} enctype="multipart/form-data">
	        	{{ Form::hidden('fop-id', $fop->id); }}
	        	<div class="form-group">
					<label for="fop-first-name" class="control-label col-sm-4">First Name : </label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="fop-first-name" name="fop-first-name" placeholder="{{ $fop->getFirstName() }}" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="fop-last-name" class="control-label col-sm-4">Last Name : </label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="fop-last-name" name="fop-last-name" placeholder="{{ $fop->getLastName() }}" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="fop-age" class="control-label col-sm-4">Age : </label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="fop-age" name="fop-age" placeholder="{{ $fop->age }}" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="fop-father-name" class="control-label col-sm-4">Father's Name : </label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="fop-father-name" name="fop-father-name" value="{{ $fop->father_name }}">
					</div>
				</div>
				<div class="form-group">
					<label for="fop-photo" class="control-label col-sm-4">Current Photo : </label>
					<div class="col-md-8">
						<div class="thumbnail">
							@if ($fop->photo_url)
								<img src="{{ $fop->photo_url }}" class="img-responsive">
							@else
								<img src="http://dummyimage.com/250x120&text=No image specified" class="img-responsive">
							@endif
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="fop-photo-file" class="control-label col-sm-4">Change Photo : </label>
					<div class="col-sm-8">
						{{ Form::file('fop-photo-file') }}
					</div>
				</div>
				<div class="form-group">
					<label for="fop-desc" class="control-label col-sm-4">
						Description
					</label>
					<div class="col-sm-8">
							<textarea class="form-control" id="fop-desc" name="fop-desc">{{ $fop->getDescription() }}</textarea>
							(Add any additional details here: e.g. father's name, height, skin-color, gender etc.)
					</div>
				</div>
	        	<button type="submit" class="btn btn-primary btn-block" id="fop-edit-btn">Edit</button>
	      	</form>
	    </div>
	</div>


</div> <!-- wrap -->

@stop

@section('jsinclude')

	<script>

		$(document).ready(function() {

			var desc_height = $("#fop-desc").get(0).scrollHeight;
			$("#fop-desc").css({"height": desc_height});

		});

	</script>

@stop
