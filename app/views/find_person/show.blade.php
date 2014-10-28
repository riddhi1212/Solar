@extends('layouts/navhome')

@section('head')

<style>

.img {
	margin: 0 auto;
}

</style>

@stop

@section('content')
<div id="wrap">
	<div class="stripe">
		<div class="container">
			<p class="pull-left">Details of Missing Person Report:</p>
			<p class="pull-right">
				...
			</p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
			<div class="fip-display">
			  	<h4 class="list-group-item list-group-item-info">Missing Person Report Info: </h4>
	          	<ul class="fip-info-list list-group">
          			<div class="list-group-item row">
						<span class="col-md-4">First Name : </span>
						<span class="col-md-8">{{ $fip->getFirstName() }}</span>
					</div>
					<div class="list-group-item row">
						<span class="col-md-4">Last Name : </span>
						<span class="col-md-8">{{ $fip->getLastName() }}</span>
					</div>
					<div class="list-group-item row">
						<span class="col-md-4">Age : </span>
						<span class="col-md-8">{{ $fip->age }}</span>
					</div>
					<div class="list-group-item row">
						<span class="col-md-4">Photo : </span>
						<span class="col-md-8">
							<div class="thumbnail">
								@if ($fip->photo_url)
									<img src="{{ $fip->photo_url }}" class="img-responsive">
								@else
									<img src="http://dummyimage.com/250x120&text=No image specified" class="img-responsive">
								@endif
							</div>
						</span>
					</div>
					<div class="list-group-item row">
						<span class="col-md-4">Description: </span>
						<span class="col-md-8">{{ $fip->getDescription() }}</span>
					</div>
	          	</ul>
	      	</div>
	      	<div class="fip-looker-display">
			  	<h4 class="list-group-item list-group-item-info">Posted By: </h4>
	          	<ul class="looker-info-list list-group">
          			<div class="list-group-item row">
						<span class="col-md-4">Full Name : </span>
						<span class="col-md-8">{{ $looker->getFullName() }}</span>
					</div>
					<div class="list-group-item row">
						<span class="col-md-4">Mobile : </span>
						<span class="col-md-8">{{ $looker->mobile }}</span>
					</div>
	          	</ul>
	      	</div>
		</div>
		@if (Auth::user() and $fip->addedByCurrentUser())
			<div class="col-md-3">
				<a href="{{ route('find.person.edit', $fip->id) }}">
					<span class="fa fa-pencil fa-fw fa-lg">Edit</span>
				</a>
				<h5>To upload a photo and add a description.</h5>
			</div>
		@endif
	</div>


</div> <!-- wrap -->

@stop

@section('jsinclude')

@stop
