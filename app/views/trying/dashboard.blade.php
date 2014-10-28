@extends('layouts/navhome')

@section('head')
        {{ HTML::style('css/dashboard.css'); }}
@stop

@section('content')
		<div id="wrap">
			<div class="stripe">
				<div class="container">
					<p class="pull-left">Hi
						<span>{{ Auth::user()->fname }}</span>
					</p>
				</div>
			</div>

			<div class="info">
				<div class="container">
					@if ($messages_list)
						<div class="messages-display">
						  <h4 class="list-group-item list-group-item-info">Messages</h4>
				          <ul class="messages-list list-group">
				          	@foreach ($messages_list as $msg)
				          		<li class="list-group-item">{{ $msg->textbody }}. Please review them below!</li>
				          	@endforeach
				          </ul>
				      	</div>
			      	@endif
					@if ($find_people_list)
						<div class="find-people-display">
						  <h4 class="list-group-item list-group-item-info">Find-Person Reports</h4>
				          <ul class="find-people-list list-group">
				          	@foreach ($find_people_list as $person)
				          		<li class="list-group-item clearfix">
				          			<div class="row pull-left">
										<span class="col-md-4">{{ $person->getFirstName() }}</span>
										<span class="col-md-4">{{ $person->getLastName() }}</span>
										<span class="col-md-4">{{ $person->age }}</span>
									</div>
				          			<span class="pull-right find-person-status" id="{{ $person->id }}">
				          				@if ( $person->found )
				          					FOUND
				     					@elseif ( $person->matches()->count() )
				     						Review matches
				     					@endif
				          			</span>
				          		</li>
				          		@if ($person->matches()->count())
					          		<li class="list-group-item clearfix">
					          			<div class="matches-list list-group clearfix">
					          			@foreach ($person->matches()->get() as $match)
					          				<div class="list-group-item clearfix">
					          					<div class="row pull-left">
													<span class="col-md-4">Match Name : {{ $match->getName() }}</span>
													<span class="col-md-4">Match Age : {{ $match->getAge() }}</span>
													<span class="col-md-4">Match Source : {{ $match->getSource() }}</span>
												</div>
												<div class="pull-right">
													@if ( $match->isSourceClaimed() )
														<span>Already claimed by 
															@if ( $match->isSourceClaimerCurrentUser() )
																You
															@else
																{{ $match->getSourceClaimerName() }}
															@endif
														</span>
														<button type="button" class="btn btn-warning claim-btn" name="duplicate-claim-btn" id="{{ $match->id }}">Duplicate Claim</button>
													@else
					          							<button type="button" class="btn btn-success claim-btn" name="claim-btn" id="{{ $match->id }}">Claim</button>
					          						@endif
					          					</div>
					          				</div>
					          			@endforeach
					          			</div>
						          	</li>
					          	@endif
				          	@endforeach
				          </ul>
				      	</div>
			      	@endif
			      	@if ($army_updates_count)
			      		<div class="army-updates-display-count">
			      			<h4 class="list-group-item list-group-item-info">Contributions</h4>
			          		<p class="list-group-item">
			          			Thank you for contributing
			          			<span>{{ $army_updates_count }}</span>
			          			ARMY Update records of Rescued people.
			          		</p>			          	
			      		</div>
			      	@endif
			      	@if ($found_people_list)
						<div class="messages-display">
						  <h4 class="list-group-item list-group-item-info">Found-Person Reports</h4>
				          <ul class="messages-list list-group">
				          	@foreach ($found_people_list as $fop)
			          			<div class="list-group-item row">
									<span class="col-md-4">{{ $fop->getFirstName() }}</span>
									<span class="col-md-4">{{ $fop->getLastName() }}</span>
									<span class="col-md-4">{{ $fop->age }}</span>
								</div>
				          	@endforeach
				          </ul>
				      	</div>
			      	@endif
				</div>
			</div>

		</div>

@stop

@section('jsinclude')
        {{ HTML::script('js/dashboard.js'); }}
@stop
