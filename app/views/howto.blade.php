@extends('layouts/navhome')

@section('head')
<style>

.push-down {
	margin-top: 100px;
}

.info-bg {
	background-color: rgba(30,0,0, 0.7);
}

.middle {
	text-align: center;
}

.info {
	color: white;
	padding-top: 5px;
	padding-bottom: 5px;
}

.info a {
	text-decoration: none;
	color: #ff6582;
}

.info a:hover {
	text-decoration: none;
}

#background {
    width: 100%; 
    height: 100%; 
    position: fixed; 
    left: 0px; 
    top: 0px; 
    z-index: -1; /* Ensure div tag stays behind content; -999 might work, too. */
}

.stretch {
    width:100%;
    height:100%;
}

</style>
@stop

@section('content')
<div id="wrap">

	<div id="background">
	    <img src="images/assam.jpg" class="stretch" alt="" />
	</div>

	<div class="row">
		<div class="col-sm-4 col-sm-offset-4 info-bg">
			<div class="info middle">
				<a href={{ route('about') }}><img src="images/cdrf.jpg" alt="Citizen's Disaster Response Force" /></a>
				<h4>Information about <strong>How to Donate</strong> <a href={{ route('donate.supplies') }}>here</a></h4>
			</div>
		</div>
	</div>
	
	<div class="row push-down">
		<div class="col-sm-8 col-sm-offset-2 info-bg">
			<div class="info">
				<h1>For those affected by the Assam and Meghalaya Floods in September 2014</h1>
				<ul>
					<li>
						<div>
							<h4>Submit Missing Person Reports <a href={{ route('missing.person.report') }}>here</a> and Found Person Reports <a href={{ route('found.person.report') }}>here</a></h4>
							<p>Many people are commenting on the Indian ARMY Facebook Account uploaded pictures and posting info about Missing persons.</p>
							<p>This website allows people to post Missing Person Reports and Found Person Reports, and searches are automatically run and people are automatically notified when someone Finds a person they were Looking for. </p>
						</div>
					</li>
					<li>
						<div>
							<h4>For any questions, you can <span class="fa fa-pencil-square-o fa-fw fa-lg"></span>Contact Us <a href={{ route('contact.me') }}>here</a></h4>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

@stop

@section('jsinclude')
        
@stop
