@extends('layouts/navhome')

@section('head')
<style>
.container {
	margin-top: 20px;
}
</style>

@stop

@section('content')
		<div id="wrap">

			<div class="container">
				@if ($contributor_users_list)
					<div class="contributor-users-display">
						<p class="list-group-item list-group-item-info">
						  	So far 
						  	<span>{{ count($contributor_users_list) }}</span>
						  	people have contributed. What are you waiting for?
						  	<a href={{ route('contributor.add.form') }}>Contribute Now!</a>
					  	</p>
				        <ul class="contributor-users-list list-group">
				          	@foreach ($contributor_users_list as $user)
				          		<li class="list-group-item">
				          			{{ $user->getFullName() }}
				          			<span class="badge">{{ $user->numContributed() }}</span>
				          		</li>
				          	@endforeach
				        </ul>
			      	</div>
		      	@endif
			</div>

		</div>

@stop

@section('jsinclude')
        
@stop
