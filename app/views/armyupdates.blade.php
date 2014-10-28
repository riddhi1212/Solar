@extends('layouts/navhome')

@section('head')
        {{ HTML::style('css/armyupdates.css'); }}
@stop

@section('content')
		<div id="wrap">
			<div class="stripe">
				<div class="container">
					<h2>ARMY Updates of Rescued People</h2>
					<p>The Indian Army is uploading records of <strong>Rescued people</strong> as pictures on its Facebook and Twitter accounts. This page is making those records searchable for your convenience.</p>
					<p>Number of Records Uploaded So far : <strong>{{ $army_updates_pag->getTotal() }} Records</strong></p>
				</div>
			</div>

			<div class="row">
			  <div class="col-md-8 col-md-offset-2">
			    <div class="army_updates">
			   	  	<h5><span class="fa fa-caret-right fa-fw fa-lg"></span>You don't have to enter all three fields. Enter one or more to Search.</h5>
				    <h5><span class="fa fa-caret-right fa-fw fa-lg"></span>The Serial number is given by the ARMY for each Rescued person record.</h5>
				    <form class="form-horizontal" id="army-updates-search-form" method="post" action={{ route('army.updates.search') }}>
				        <!-- TODO Add help text for each -->
				      	<div class="row">
					        <div class="col-sm-4 form-group">
		    					<label for="updates-sno" class="control-label row">S.no.</label>
		    					<div class="row">
		      						<input type="text" class="form-control" id="updates-sno" name="updates-sno" placeholder="Enter Serial Number">
		    						<span class="help-block"></span>
		    					</div>
		  					</div>
					        <div class="col-sm-5 form-group">
		    					<label for="updates-name" class="control-label row">Name</label>
		    					<div class="row">
		      						<input type="text" class="form-control" id="updates-name" name="updates-name" placeholder="Enter Name">
		    						<span class="help-block"></span>
		    					</div>
		  					</div>
		  					<div class="col-sm-4 form-group">
		    					<label for="updates-age" class="control-label row">Age</label>
		    					<div class="row">
		      						<input type="text" class="form-control" id="updates-age" name="updates-age" placeholder="Enter Age">
		    						<span class="help-block"></span>
		    					</div>
		  					</div>
	  					</div>
  						<div class="row">
			        		<button type="button" class="btn btn-primary btn-block" id="army-updates-search-btn"><span class="fa fa-search fa-fw fa-lg"></span>Search</button>
			      		</div>
				      </form>
				   	</div>
			      	<br>
			      	<div class="army-updates-display">
			      		<div class="search-text clearfix"></div>
			      	  	<div class="army-updates-pag-links">
			          		{{ $army_updates_pag->links() }}
			          	</div>
			      	  	<li class="list-group-item list-group-item-info">
			      	  		<div class="row">
	      	  					<h4 class="col-md-4">S.no.</h4>
								<h4 class="col-md-4">Name</h4>
								<h4 class="col-md-4">Age</h4>
			      	  		</div>
			      	  	</li>
			          	<div class="army-updates-list list-group">
			          		@foreach ($army_updates_pag->getCollection()->all() as $update)
					  	  	<a class="list-group-item" href={{ $update->fb_url }} target="_blank">
				           		<div class="row">
				           			<span class="col-md-4">{{ $update->s_no }}</span>
									<span class="col-md-4">{{ $update->getFullName() }}</span>
									<span class="col-md-4">{{ $update->age }}</span>
								</div>
							</a>
			          		@endforeach
			          	</div>
			      	</div>
			    </div>
			  </div>
			</div>
		</div>

@stop

@section('jsinclude')
        {{ HTML::script('js/army-updates-search.js'); }}
@stop
