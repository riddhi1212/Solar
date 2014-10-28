@extends('layouts/navhome')

@section('head')
        {{ HTML::style('css/home.css'); }}
@stop

@section('content')

		<div id="wrap">
			<div class="stripe">
				<div class="container">
					<p class="pull-left">Kashmiri Floods</p>
					<p class="pull-right">
						...
					</p>
				</div>
			</div>

			<div class="row">
			  <div class="col-md-6">
			    <div class="found-people">
			   	  <p>Tracking 
			   	  <span id="found-count">{{ count($found_people_list) }}</span>
			   	   Records</p>
			      <h2>I have found :</h2>
			      <form class="form-horizontal" id="found-people-form" method="post" action={{ route('found.people.create') }}>
			        <div class="form-group">
    					<label for="found-name" class="control-label col-sm-2">Name</label>
    					<div class="col-sm-10">
      						<input type="text" class="form-control" id="found-name" name="found-name" placeholder="Enter Name of Found Person">
    					</div>
  					</div>
  					<div class="form-group">
    					<label for="found-age" class="control-label col-sm-2">Age</label>
    					<div class="col-sm-10">
      						<input type="text" class="form-control" id="found-age" name="found-age" placeholder="Enter Age of Found Person">
    					</div>
  					</div>
  					<div class="form-group">
  						<label for="found-father-name" class="control-label col-sm-2">Father's Name</label>
						<div class="col-sm-8">
      						<input type="text" class="form-control" id="found-father-name" name="found-father-name" placeholder="Enter Father's name of Found Person">
    					</div>
					</div>
  					@if ( Auth::guest() or (Auth::user() and Auth::user()->hasNoAffiliation()) )
  						<div class="form-group">
							{{ Form::label('found-by', 'I belong to :', array('class' => 'control-label col-sm-2')); }}
							<div class="col-sm-8">
								{{ Form::select('found-by', array(
															   'army' => 'ARMY',
															   'nrdf' => 'NRDF',
															   'media' => 'Media',
															   'medical' => 'Medical team',
															   'ngo' => 'NGO',
															   'other' => 'Other Organisation',
															   'person' => 'I am just an individual Person'),
														   array('class' => 'form-control',
																	'id' => 'found-by') ); }}
							</div>
						</div>
					@endif
  					@if ( Auth::guest() )
  					<div class ="guest-user">
	  					<div class="form-group">
	    					<label for="finder-first-name" class="control-label col-sm-2">My First Name</label>
	    					<div class="col-sm-10">
	      						<input type="text" class="form-control" id="finder-first-name" name="finder-first-name" placeholder="Enter Your First Name">
	    					</div>
	  					</div>
	  					<div class="form-group">
	    					<label for="finder-last-name" class="control-label col-sm-2">My Last Name</label>
	    					<div class="col-sm-10">
	      						<input type="text" class="form-control" id="finder-last-name" name="finder-last-name" placeholder="Enter Your Last Name">
	    					</div>
	  					</div>
	  					<div class="form-group">
	    					<label for="finder-mobile" class="control-label col-sm-2">My Mobile #</label>
	    					<div class="col-sm-10">
	      						<input type="text" class="form-control" id="finder-mobile" name="finder-mobile" placeholder="Enter Your Mobile Number">
	    					</div>
	  					</div>
	  				</div>
  					@endif
  					<div class="form-group">
        				<div class="col-sm-12">
			        		<button type="submit" class="btn btn-primary btn-block" id="found-post-btn">Post</button>
			      		</div>
			      	</div>
			      </form>
			      <div class="found-people-display">
					@if ($found_people_list)
			      		<ul class="found-people-list list-group">
			      			<h4>All Found Person Reports : </h4>
				       		<div class="row list-group-item list-group-item-info" id="found-people-list-header">
				       			<span class="col-sm-3">First Name</span>
				       			<span class="col-sm-3">Last Name</span>
				       			<span class="col-sm-1">Age</span>
				       		</div>
						  	@foreach ($found_people_list as $person)
								<div class="row list-group-item">
										<span class="col-sm-3">{{ $person->getFirstName() }}</span>
										<span class="col-sm-3">{{ $person->getLastName() }}</span>
										<span class="col-sm-1">{{ $person->age }}</span>
										<a href="{{ route('found.person.show', $person->id) }}" class="col-sm-2" data-toggle="tooltip" data-placement="bottom" title="See full Found Person Report with photo and description.">
				          					<span class="fa fa-eye fa-fw">See</span>
				          				</a>
										@if (Auth::user() AND Auth::user()->id === $person->getFinderID())
											<a href="{{ route('find.person.edit', $person->id) }}" class="col-sm-1" data-toggle="tooltip" data-placement="bottom" title="Edit photo and description.">
												<span class="fa fa-pencil fa-fw">Edit</span>
											</a>
				          					@if ($person->claimed)
												<span class="col-sm-2 claimed-fop" id="{{ $person->id }}" data-toggle="tooltip" data-placement="bottom" title="Thank you for helping someone find the person you posted about.">
					          						Claimed
					          					</span>
				          					@else
												<a href="#" class="col-sm-2 remove-fop-link" id="{{ $person->id }}" data-toggle="tooltip" data-placement="bottom" title="Delete this Found Person Report">
					          						<span class="fa fa-remove fa-fw">Delete</span>
					          					</a>
				          					@endif
			          					@endif
								</div>
				          	@endforeach
			          	</ul>
			        @endif
			      </div>
			    </div>
			  </div>
			  <div class="col-md-6">
			    <div class="find-people">
			      <p>Tracking 
			   	  <span id="find-count">{{ count($find_people_list) }}</span>
			   	   Records
			   	  </p>
			      <h2>I am looking for :</h2>
			      <form class="form-horizontal" id="find-people-form" method="post" action={{ route('find.people.create') }}>
			        <div class="form-group">
    					<label for="find-name" class="control-label col-sm-2">Name</label>
    					<div class="col-sm-10">
      						<input type="text" class="form-control" id="find-name" name="find-name" placeholder="Enter Name of Missing Person">
    					</div>
  					</div>
  					<div class="form-group">
    					<label for="find-age" class="control-label col-sm-2">Age</label>
    					<div class="col-sm-10">
      						<input type="text" class="form-control" id="find-age" name="find-age" placeholder="Enter Age of Missing Person">
    					</div>
  					</div>
  					@if ( Auth::guest() )
  					<div class="guest-user">
	  					<div class="form-group">
	    					<label for="looker-first-name" class="control-label col-sm-2">My First Name</label>
	    					<div class="col-sm-10">
	      						<input type="text" class="form-control" id="looker-first-name" name="looker-first-name" placeholder="Enter Your First Name">
	    					</div>
	  					</div>
	  					<div class="form-group">
	    					<label for="looker-last-name" class="control-label col-sm-2">My Last Name</label>
	    					<div class="col-sm-10">
	      						<input type="text" class="form-control" id="looker-last-name" name="looker-last-name" placeholder="Enter Your Last Name">
	    					</div>
	  					</div>
	  					<div class="form-group">
	    					<label for="looker-mobile" class="control-label col-sm-2">My Mobile #</label>
	    					<div class="col-sm-10">
	      						<input type="text" class="form-control" id="looker-mobile" name="looker-mobile" placeholder="Enter Your Mobile Number">
	    					</div>
	  					</div>
	  				</div>
  					@endif
				    <div class="form-group">
        				<div class="col-sm-12">
			        		<button type="submit" class="btn btn-primary btn-block" id="find-post-btn">Post</button>
			      		</div>
			      	</div>
			      </form>
			      <div class="find-people-display">
			      	@if ($find_people_list)
			      		<ul class="find-people-list list-group">
			      			<h4>All Missing Person Reports : </h4>
				       		<div class="row list-group-item list-group-item-info" id="find-people-list-header">
				       			<span class="col-sm-3">First Name</span>
				       			<span class="col-sm-3">Last Name</span>
				       			<span class="col-sm-1">Age</span>
				       		</div>
				        	@foreach ($find_people_list as $person)
			          			<div class="row list-group-item">
									<span class="col-sm-3">{{ $person->getFirstName() }}</span>
									<span class="col-sm-3">{{ $person->getLastName() }}</span>
									<span class="col-sm-1">{{ $person->age }}</span>
									<a href="{{ route('find.person.show', $person->id) }}" class="col-sm-2" data-toggle="tooltip" data-placement="bottom" title="See full Missing Person Report with photo and description.">
			          					<span class="fa fa-eye fa-fw">See</span>
			          				</a>
									@if (Auth::user() AND Auth::user()->id === $person->getLookerID())
										<a href="{{ route('find.person.edit', $person->id) }}" class="col-sm-1" data-toggle="tooltip" data-placement="bottom" title="Edit photo and description.">
											<span class="fa fa-pencil fa-fw">Edit</span>
										</a>	
										<a href="#" class="col-sm-2 remove-fip-link" id="{{ $person->id }}" data-toggle="tooltip" data-placement="bottom" title="Delete this Missing Person Report">
			          						<span class="fa fa-remove fa-fw">Delete</span>
			          					</a>
		          					@endif
								</div>
				       		@endforeach
				        </ul>
			        @endif
			      </div>
			    </div>
			  </div>
			</div>
		</div>

@stop

@section('jsinclude')
        {{ HTML::script('js/home.js'); }}
@stop


