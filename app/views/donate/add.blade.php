@extends('layouts/navhome')

@section('head')
        
@stop

@section('content')
<div id="wrap">
	<div class="stripe">
		<div class="container">
			<p class="pull-left">Congratulations on taking the wonderful step of Adding a Donation Channel here:</p>
			<p class="pull-right">
				...
			</p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
			<h2>Donation Cause details :</h2>
	      	<form class="form-horizontal" id="add-donation-cause-form" method="post" action={{ route('donation.channel.add') }} enctype="multipart/form-data">
	        	<div class="form-group">
					<label for="dc-name" class="control-label col-sm-4">Name of Organisation Collecting Donations : </label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="dc-name" name="dc-name" placeholder="Enter Name">
					</div>
				</div>
				<div class="form-group">
					<label for="dc-desc" class="control-label col-sm-4">
						Description : 
						(what donation type you want: e.g. money/supplies)
						(where it is going: e.g. PMRF / NGO)
					</label>
					<div class="col-sm-8">
							<textarea class="form-control" id="dc-desc" name="dc-desc" placeholder="Enter Description"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="dc-img-file" class="control-label col-sm-4">Organisation Logo Image : </label>
					<div class="col-sm-8">
						{{ Form::file('dc-img-file') }}
					</div>
				</div>
				<div class="form-group">
					<label for="dc-donation-url" class="control-label col-sm-4">Online Donation URL : </label>
					<div class="col-sm-8">
							<input type="text" class="form-control" id="dc-donation-url" name="dc-donation-url" placeholder="Enter Online Donation URL OR Instructions below">
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
							<textarea class="form-control" id="dc-instructions" name="dc-instructions" placeholder="Enter Instructions to Donate (if you don't have Donation URL)"></textarea>
					</div>
				</div>
				@if ( Auth::guest() )
				<div class="guest-user">
					<div class="form-group">
					<label for="dcadder-first-name" class="control-label col-sm-4">My First Name</label>
					<div class="col-sm-8">
							<input type="text" class="form-control" id="dcadder-first-name" name="dcadder-first-name" placeholder="Enter Your First Name">
					</div>
					</div>
					<div class="form-group">
					<label for="dcadder-last-name" class="control-label col-sm-4">My Last Name</label>
					<div class="col-sm-8">
							<input type="text" class="form-control" id="dcadder-last-name" name="dcadder-last-name" placeholder="Enter Your Last Name">
					</div>
					</div>
					<div class="form-group">
					<label for="dcadder-mobile" class="control-label col-sm-4">My Mobile #</label>
					<div class="col-sm-8">
							<input type="text" class="form-control" id="dcadder-mobile" name="dcadder-mobile" placeholder="Enter Your Mobile Number">
					</div>
					</div>
				</div>
				@endif
	        	<button type="submit" class="btn btn-primary btn-block" id="dc-post-btn">Post</button>
	      	</form>
	    </div>
	</div>


</div> <!-- wrap -->

@stop

@section('jsinclude')

@stop
