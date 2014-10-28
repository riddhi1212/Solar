@extends('layouts/navhome')

@section('head')
        {{ HTML::style('css/home.css'); }}
@stop

@section('content')

<div id="wrap">
	<div class="stripe">
		<div class="container">
			<h2>Lodge your Missing Person Reports using this form :</h2>
			<h5><span class="fa fa-caret-right fa-fw fa-lg"></span>You will be able to view all your Missing Person Reports in your Dashboard.</h5>
			<h5><span class="fa fa-caret-right fa-fw fa-lg"></span>Your report will automatically be matched with every record in the Army Updates database and in the Found Person Reports database.</h5>
			<h5><span class="fa fa-caret-right fa-fw fa-lg"></span>Your dashboard will show you all the generated matches so you can Review them.</h5>
		</div>
	</div>

	<div class="row">
	  <div class="col-md-8 col-md-offset-2">
	    <div class="find-people">
	      <h2>I am looking for :</h2>
	      <form class="form-horizontal" id="find-people-form" method="post" action={{ route('find.people.create') }}>
	        <div class="form-group">
				<label for="find-name" class="control-label col-sm-3">Name</label>
				<div class="col-sm-9">
						<input type="text" class="form-control" id="find-name" name="find-name" placeholder="Enter Name of Missing Person">
				</div>
				</div>
				<div class="form-group">
				<label for="find-age" class="control-label col-sm-3">Age</label>
				<div class="col-sm-9">
						<input type="text" class="form-control" id="find-age" name="find-age" placeholder="Enter Age of Missing Person">
				</div>
				</div>
				@if ( Auth::guest() )
				<div class="guest-user">
					<div class="form-group">
					<label for="looker-first-name" class="control-label col-sm-3">My First Name</label>
					<div class="col-sm-9">
  						<input type="text" class="form-control" id="looker-first-name" name="looker-first-name" placeholder="Enter Your First Name">
					</div>
					</div>
					<div class="form-group">
					<label for="looker-last-name" class="control-label col-sm-3">My Last Name</label>
					<div class="col-sm-9">
  						<input type="text" class="form-control" id="looker-last-name" name="looker-last-name" placeholder="Enter Your Last Name">
					</div>
					</div>
					<div class="form-group">
					<label for="looker-mobile" class="control-label col-sm-3">My Mobile #</label>
					<div class="col-sm-9">
  						<input type="text" class="form-control" id="looker-mobile" name="looker-mobile" placeholder="Enter Your Mobile Number">
					</div>
					</div>
				</div>
				@endif
		    <div class="form-group">
				<div class="col-sm-12">
	        		<button type="submit" class="btn btn-primary btn-block" id="find-post-btn">Post Missing Person Report <span class="fa fa-arrow-circle-right fa-fw fa-lg"></span></button>
	      		</div>
	      	</div>
	      </form>
	      <div class="find-people-display">
	      	@if ($find_people_list)
	      		<ul class="find-people-list list-group">
	      			<h4>View All Missing Person Reports : </h4>
	      			<p>Tracking 
				   	  <span id="find-count">{{ count($find_people_list) }}</span>
				   	   Records
				   	</p>
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
								<a href="#" class="col-sm-2" id="{{ $person->id }}" data-toggle="modal" data-target="#delete-modal" data-toggle="tooltip" data-placement="bottom" title="Delete this Missing Person Report">
	          						<span class="fa fa-remove fa-fw">Delete</span>
	          					</a>
          					@endif
						</div>
						<!-- Modal -->
						<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      	<div class="modal-header">
						        	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						        	<h4 class="modal-title" id="myModalLabel">Why do you want to Delete this Missing Person Report?</h4>
						      	</div>
						      	{{ Form::open(array('class'	 => 'form-horizontal',
													'id'     => 'why-delete-form')); }}
						      	<div class="modal-body">
						        
						        	{{ Form::hidden('fip-id', $person->id); }}
						        	<div class="form-group">
										{{ Form::label('why', 'Why : ', array('class' => 'control-label col-sm-4')); }}
										<div class="col-sm-8">
											{{ Form::text('why', '', array('class' => 'form-control',
													   					'id' => 'why',
													   					'placeholder' => 'Enter your reason for deleting this report here')); }}
											<span class="help-block"></span>
										</div>
									</div>
						      	</div>
						      	<div class="modal-footer">
						        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						        	{{ Form::button('Delete Report', array('class' => 'btn btn-danger',
						        											'id' => 'delete-fip-btn')); }}
						      	</div>
						      	{{ Form::close(); }}
						    </div>
						  </div>
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
        {{ HTML::script('js/find_person.js'); }}
@stop


