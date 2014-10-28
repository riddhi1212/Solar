@extends('layouts/navhome')

@section('head')
        
@stop

@section('content')
<div id="wrap">
	<div class="stripe">
		<div class="container">
			<p class="pull-left">Edit your Donation Channel here:</p>
			<p class="pull-right">
				Help Me
			</p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
			<h2>Donation Cause details :</h2>
	      	<form class="form-horizontal" id="add-donation-cause-form" method="post" action={{ route('donation.channel.edit') }} enctype="multipart/form-data">
	        	{{ Form::hidden('dc-id', $dc->id); }}
	        	<div class="form-group">
					<label for="dc-name" class="control-label col-sm-4">Name of Organisation Collecting Donations</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="dc-name" name="dc-name" value="{{ $dc->name }}">
					</div>
				</div>
				<div class="form-group">
					<label for="dc-desc" class="control-label col-sm-4">
						Description
						(what donation type you want: e.g. money/supplies)
						(where it is going: e.g. PMRF / NGO)
					</label>
					<div class="col-sm-8">
							<textarea class="form-control" id="dc-desc" name="dc-desc">{{ $dc->description }}</textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="dc-photo" class="control-label col-sm-4">Current Organisation Logo : </label>
					<div class="col-md-8">
						<div class="thumbnail">
							@if ($dc->img_url)
								<img src="{{ $dc->img_url }}" class="img-responsive">
							@else
								<img src="http://dummyimage.com/250x120&text=No image specified" class="img-responsive">
							@endif
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="dc-img-file" class="control-label col-sm-4">Change Logo Image : </label>
					<div class="col-sm-8">
						{{ Form::file('dc-img-file') }}
					</div>
				</div>
				<div class="form-group">
					<label for="dc-donation-url" class="control-label col-sm-4">Online Donation URL : </label>
					<div class="col-sm-8">
							<input type="text" class="form-control" id="dc-donation-url" name="dc-donation-url" value="{{ $dc->donation_url }}">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4">OR</label>
				</div>
				<div class="form-group">
					<label for="dc-instructions" class="control-label col-sm-4">
						Instructions
						(what to donate, how to donate, where to donate)
					</label>
					<div class="col-sm-8">
							<textarea class="form-control" id="dc-instructions" name="dc-instructions" height>{{ $dc->instructions }}</textarea>
					</div>
				</div>
	        	<button type="submit" class="btn btn-primary btn-block" id="dc-post-btn">Edit</button>
	      	</form>
	    </div>
	</div>


</div> <!-- wrap -->

@stop

@section('jsinclude')

	<script>

		$(document).ready(function() {

			var desc_height = $("#dc-desc").get(0).scrollHeight;
			$("#dc-desc").css({"height": desc_height});

			var ins_height = $("#dc-instructions").get(0).scrollHeight;
			$("#dc-instructions").css({"height": ins_height});

		});

	</script>

@stop
