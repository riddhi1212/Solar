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

				<div class="panel with-nav-tabs panel-info">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1info" data-toggle="tab">Messages</a></li>
                            <li><a href="#tab2info" data-toggle="tab">Missing Person Reports</a></li>
                            <li><a href="#tab3info" data-toggle="tab">Contributions</a></li>
                            <li><a href="#tab4info" data-toggle="tab">Found Person Reports</a></li>
                            <li><a href="#tab5info" data-toggle="tab">Info5</a></li>
                        </ul>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1info">
                            @if ($messages_list)
								<div class="messages-display">
						          <ul class="messages-list list-group">
						          	@foreach ($messages_list as $msg)
						          		<li class="list-group-item">{{ $msg->textbody }}. Please review them below!</li>
						          	@endforeach
						          </ul>
						      	</div>
					      	@endif
                        </div>
                        <div class="tab-pane fade" id="tab2info">
                    		@if ($find_people_list)
								<div class="find-people-display">
								  <!-- <h4 class="list-group-item list-group-item-info">Find-Person Reports</h4> -->
								  <h4>FIPs</h4>
						          <!-- <ul class="find-people-list list-group"> -->
						          <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
						          <thead>
						            <tr>
						                <th>G</th>
						                <th>First Name</th>
						                <th>Last Name</th>
						                <th>Age</th>
						                <th>Status</th>
						            </tr>
							      </thead>
						          <tbody class="find-people-list">
						          	@foreach ($find_people_list as $person)
						          		<div class="fip-match-group">
						          		<!-- <li class="list-group-item clearfix"> -->
						          			<tr>
						          				<!-- <a href="#"><span class="col-md-1 fa fa-remove fa-fw fa-2x"></span></a> -->
						          				<td><a href="#"><span class="col-md-1 fa fa-remove fa-fw fa-2x"></span></a></td>
						          				<td>{{ $person->getFirstName() }}</td>
						          				<td>{{ $person->getLastName() }}</td>
						          				<td>{{ $person->age }}</td>
												<!-- <span class="col-md-2">{{ $person->getFirstName() }}</span>
												<span class="col-md-2">{{ $person->getLastName() }}</span>
												<span class="col-md-5">{{ $person->age }}</span> -->
						          				@if ( $person->found )
						          					<!-- <span class="col-md-2 find-person-status label label-default" id="{{ $person->id }}">FOUND</span> -->
						          					<td><span class="find-person-status label label-default" id="{{ $person->id }}">FOUND</span></td>
						     					@elseif ( $person->matches()->count() )
						     						<!-- <span class="col-md-2 find-person-status label label-default" id="{{ $person->id }}">Review matches</span> -->
						     						<td><span class="find-person-status label label-default" id="{{ $person->id }}">Review matches</span></td>
						     					@else
						     						<td></td>
						     					@endif
						          			</tr>
						          		<!-- </li> -->
						          		@if ($person->matches()->count())
							          		<!-- <li class="list-group-item clearfix"> -->
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
								          	<!-- </li> -->
							          	@endif
							          	</div>
						          	@endforeach
						          <!-- </ul> -->
						          </tbody>
						          </table>
						      	</div>
					      	@endif
                        </div>
                        <div class="tab-pane fade" id="tab3info">
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
                        </div>
                        <div class="tab-pane fade" id="tab4info">
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
                        <div class="tab-pane fade" id="tab5info">
                        	<h4 class="list-group-item list-group-item-info">Found-Person Reports</h4>
                        	<ul class="list-group">
                        		<li class="list-group-item">test</li>
                        		<li class="list-group-item">test</li>
                        		<li class="list-group-item">test</li>
                        		<li class="list-group-item">test</li>
                        		<li class="list-group-item">test</li>
                        		<li class="list-group-item">test</li>
                        	</ul>
                        	<h4 class="list-group-item list-group-item-info">Found-Person Reports</h4>
                        	<ul class="list-group">
                        		<div class="list-group-item row">
                        			<span class="col-md-4">first</span>
									<span class="col-md-4">name</span>
									<span class="col-md-4">age</span>
                        		</div>
                        		<div class="list-group-item row">
                        			<span class="col-md-4">first</span>
									<span class="col-md-4">name</span>
									<span class="col-md-4">age</span>
                        		</div>
                        		<div class="list-group-item row">
                        			<span class="col-md-4">first</span>
									<span class="col-md-4">name</span>
									<span class="col-md-4">age</span>
                        		</div>
                        		<div class="list-group-item row">
                        			<span class="col-md-4">first</span>
									<span class="col-md-4">name</span>
									<span class="col-md-4">age</span>
                        		</div>
                        	</ul>
                        </div>
                    </div>
                </div>
            </div>
		</div>  
	</div>  <!-- info -->
</div> <!-- wrap -->

@stop

@section('jsinclude')
        {{ HTML::script('js/dashboard.js'); }}
@stop
