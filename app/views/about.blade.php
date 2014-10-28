@extends('layouts/navhome')

@section('head')
<style>

.middle {
	text-align: center;
}

.left {
	text-align: left;
}

.about {
	background-color: rgb(235,235,235);
}
</style>
@stop

@section('content')
<div id="wrap">
	<div class="container">
		<div class="row">
			<div class="col-md-8 middle">
				<img src="images/cdrf.jpg" />
				<div class="about left">
					<h3>About #CDRF</h3>
					<p>The Citizens Disaster Response Force movement in India has been started by a couple of youth volunteers after noticing the lack of information prevalent during times of crisis.</p>
					<p>It is NOT ACCEPTABLE to us, that lack of information be the reason that helpful people cannot donate supplies to those affected by disasters and in desperate need to supplies.</p>
				</div>
				<div class="about left">
					<h3>Get Involved with #CDRF</h3>
					<p>1) Follow <a target="_blank" href="http://twitter.com/IndiaCdrf">@IndiaCDRF</a> on <span class="fa fa-twitter fa-fw fa-2x"></span>Twitter</p>
					<p>2) Tweet <strong>"I want to #GetInvolved with @IndiaCDRF"</strong></p>
				</div>
				<div class="about left">
					<h3>About Me</h3>
					<p>My name is Riddhi Mittal, and I'm the founder of the Citizens Disaster Response Force movement.</p>
					<p>You can reach me here :
						<a target="_blank" href="http://www.linkedin.com/in/riddhimittal"><span class="fa fa-linkedin fa-fw fa-lg"></span></a>
						<a target="_blank" href="http://twitter.com/riddhi_mittal"><span class="fa fa-twitter fa-fw fa-lg"></span></a>
						<a target="_blank" href="http://www.facebook.com/riddhi.mittal"><span class="fa fa-facebook fa-fw fa-lg"></span></a>
					</p>
				</div>
			</div>
		</div> <!-- row -->
	</div> <!-- container -->

</div>

@stop


