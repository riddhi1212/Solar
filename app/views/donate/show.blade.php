@extends('layouts/navhome')

@section('head')

@stop

@section('content')
<div id="wrap">
	<div class="stripe">
		<div class="container">
			<p class="pull-left">Details of Donation Channel:</p>
			<p class="pull-right">
				...
			</p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
			<div class="dc-display">
			  <h4 class="list-group-item list-group-item-info">Donation Channel Info: </h4>
	          <ul class="dc-info-list list-group">
          			<div class="list-group-item row">
						<span class="col-md-4">Name: </span>
						<span class="col-md-8">{{ $donation_cause->name }}</span>
					</div>
					<div class="list-group-item row">
						<span class="col-md-4">Description: </span>
						<span class="col-md-8">{{ $donation_cause->description }}</span>
					</div>
					<div class="list-group-item row">
						<span class="col-md-4">Current Organisation Logo : </span>
						<div class="col-md-8 thumbnail">
							@if ($donation_cause->img_url)
								<img src="{{ $donation_cause->img_url }}" class="img-responsive">
							@else
								<img src="http://dummyimage.com/250x120&text=No image specified" class="img-responsive">
							@endif
						</div>
					</div>
					@if ($donation_cause->instructions === NULL)
						<div class="list-group-item row">
							<span class="col-md-4">Donation URL: </span>
							<span class="col-md-8">
								<a href="{{ $donation_cause->donation_url }}" target="_blank">Donation URL</a>
							</span>
						</div>
					@else
						<div class="list-group-item row">
							<span class="col-md-4">Instructions: </span>
							<span class="col-md-8"><pre>{{ $donation_cause->instructions }}</pre></span>
						</div>
					@endif
	          </ul>
	      	</div>
		</div>
		@if ($donation_cause->addedByCurrentUser())
			<div class="col-md-3">
				<a href="{{ route('donation.channel.edit', $donation_cause->id) }}">
					<span class="fa fa-pencil fa-fw fa-lg">Edit</span></a>
			</div>
		@endif
	</div>


</div> <!-- wrap -->

@stop

@section('jsinclude')

@stop
