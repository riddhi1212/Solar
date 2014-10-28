@extends('layouts/navhome')

@section('head')
        
@stop

@section('content')
<div id="wrap">
	<div class="stripe">
		<div class="container">
			<h3>Congratulations on taking the wonderful step of Volunteering your time:</h3>
			<p>I will be adding <strong>detailed instructions</strong> here very soon. Please check again in a day or two.</p>
<pre>
Format of CSV file to be uploaded
| s-no |  first-name  | last-name |  age  |  address | fb-url  |  child  |</pre>
		</div>
	</div>




	<div class="row">
		<div class="col-md-8">
			<h2>Contributor Details :</h2>
	      	<form class="form-horizontal" id="add-contributor-file-form" method="post" action={{ route('contributor.add') }} enctype="multipart/form-data">
				<div class="form-group">
					<label for="au-file" class="control-label col-sm-4">Attach file</label>
					<div class="col-sm-8">
						{{ Form::file('au-file') }}
					</div>
				</div>
				@if ( Auth::guest() )
					<div class="contributor">
						<div class="form-group">
						<label for="contributor-first-name" class="control-label col-sm-4">Contributor First Name</label>
						<div class="col-sm-8">
								<input type="text" class="form-control" id="contributor-first-name" name="contributor-first-name" placeholder="Enter Your First Name">
						</div>
						</div>
						<div class="form-group">
						<label for="contributor-last-name" class="control-label col-sm-4">Contributor Last Name</label>
						<div class="col-sm-8">
								<input type="text" class="form-control" id="contributor-last-name" name="contributor-last-name" placeholder="Enter Your Last Name">
						</div>
						</div>
						<div class="form-group">
						<label for="contributor-mobile" class="control-label col-sm-4">Contributor Mobile #</label>
						<div class="col-sm-8">
								<input type="text" class="form-control" id="contributor-mobile" name="contributor-mobile" placeholder="Enter Your Mobile Number">
						</div>
						</div>
					</div>
				@else
					<div class="contributor">
						<div class="form-group">
						<label for="contributor-first-name" class="control-label col-sm-4">Contributor First Name</label>
						<div class="col-sm-8">
								<input type="text" class="form-control" id="contributor-first-name" name="contributor-first-name" value="{{ Auth::user()->fname }}">
						</div>
						</div>
						<div class="form-group">
						<label for="contributor-last-name" class="control-label col-sm-4">Contributor Last Name</label>
						<div class="col-sm-8">
								<input type="text" class="form-control" id="contributor-last-name" name="contributor-last-name" value="{{ Auth::user()->lname }}">
						</div>
						</div>
						<div class="form-group">
						<label for="contributor-mobile" class="control-label col-sm-4">Contributor Mobile #</label>
						<div class="col-sm-8">
								<input type="text" class="form-control" id="contributor-mobile" name="contributor-mobile" value="{{ Auth::user()->mobile }}">
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
