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
			<p class="pull-left">Details of Found Person Report:</p>
			<p class="pull-right">
				...
			</p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
			<div class="fop-display">
			  	<h4 class="list-group-item list-group-item-info">Found Person Report Info: </h4>
	          	<ul class="fop-info-list list-group">
          			<div class="list-group-item row">
						<span class="col-md-4">First Name : </span>
						<span class="col-md-8">{{ $fop->getFirstName() }}</span>
					</div>
					<div class="list-group-item row">
						<span class="col-md-4">Last Name : </span>
						<span class="col-md-8">{{ $fop->getLastName() }}</span>
					</div>
					<div class="list-group-item row">
						<span class="col-md-4">Age : </span>
						<span class="col-md-8">{{ $fop->age }}</span>
					</div>
					<div class="list-group-item row">
						<span class="col-md-4">Father's name : </span>
						<span class="col-md-8">{{ $fop->father_name }}</span>
					</div>
					<div class="list-group-item row">
						<span class="col-md-4">Photo : </span>
						<span class="col-md-8">
							<div class="thumbnail">
								@if ($fop->photo_url)
									<img src="{{ $fop->photo_url }}" class="img-responsive">
								@else
									<img src="http://dummyimage.com/250x120&text=No image specified" class="img-responsive">
								@endif
							</div>
						</span>
					</div>
					<div class="list-group-item row">
						<span class="col-md-4">Description: </span>
						<span class="col-md-8">{{ $fop->getDescription() }}</span>
					</div>
	          	</ul>
	      	</div>
	      	<div class="fop-finder-display">
			  	<h4 class="list-group-item list-group-item-info">Posted By: </h4>
	          	<ul class="finder-info-list list-group">
          			<div class="list-group-item row">
						<span class="col-md-4">Full Name : </span>
						<span class="col-md-8">{{ $finder->getFullName() }}</span>
					</div>
					<div class="list-group-item row">
						<span class="col-md-4">Mobile : </span>
						<span class="col-md-8">{{ $finder->mobile }}</span>
					</div>
					<div class="list-group-item row">
						<span class="col-md-4">Affiliation : </span>
						<span class="col-md-8">{{ $finder->affiliation }}</span>
					</div>
	          	</ul>
	      	</div>
		</div>
		@if (Auth::user() and $fop->addedByCurrentUser())
			<div class="col-md-3">
				<a href="{{ route('found.person.edit', $fop->id) }}">
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
