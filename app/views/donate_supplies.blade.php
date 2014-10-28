@extends('layouts/navhome')

@section('head')
<style>

.donate-option {
	border: 1px solid brown;
	margin-bottom: 10px;
}

.about {
	background-color: rgb(235,235,235);
}

.donate-option .row {
	border: 1px solid grey;
}

.imp {
	color: red;
}

</style>
@stop

@section('content')
<div id="wrap">
	<div class="container">
		<div class="row">
			<div class="col-md-10 what-to-donate">
				<h2>Options:</h2>
				<p><span class="fa fa-caret-right fa-fw fa-lg"></span>There are currently 3 options available for donating supplies to flood affected areas in <strong>Assam</strong></p>
				<p><span class="fa fa-caret-right fa-fw fa-lg"></span>To Add Another Option that you know of, please <span class="fa fa-pencil-square-o fa-fw fa-lg"></span>Contact Us <a href={{ route('contact.me') }}>here</a></p>
				<p><span class="fa fa-caret-right fa-fw fa-lg"></span>Also Contact Us if you know of ways to donate supplies to flood affected areas in <strong>Meghalaya</strong></p>
				<h3 class="imp">Please Register Your Donation <a href={{ route('donated.supplies.add') }}>here</a></h3>
				<div class="row">
					<div class="col-sm-2">
						<h4>Option 1 : </h4>
					</div>
					<div class="col-sm-10 donate-option">
						<h4>NSUI</h4>
						<p>Contact: Angellica Aribam. <a target="_blank" href="https://twitter.com/AngellicAribam"><span class="fa fa-twitter fa-fw fa-2x"></span></a>
						Handling the affairs of NSUI Assam.</p>
						<p>We are collecting relief materials for both J&K and Assam. Nearly 100 of our volunteers in Kashmir are, currently, distributing relief materials.</p>
						<div class="row">
							<div class="col-sm-3">
								<h5>Requirements List: </h5>
							</div>
							<div class="col-sm-8 col-sm-offset-1">
								<h5>Last Updated On: Sep 26, 2014</h5>
								<ul>
									<li>Medicines</li>
										<ul>
											<li>Fever</li>
											<li>Cough</li>
											<li>Dehydration</li>
											<li>Water-borne diseases</li>
										</ul>
									<li>Clothes</li>
									<li>Blankets</li>
									<li>Mosquito Nets (because of the standing water)</li>
									<li>Potable drinking water</li>
									<li>Rice</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3">
								<h5>Drop Off Location: </h5>
							</div>
							<div class="col-sm-8 col-sm-offset-1">
								<p>We are collecting relief materials from all parts of India. These materials can be dropped off at the NSUI office, Rajiv Bhawan of every state. </p>
								<p>Example:</p>
								<ul>
									<li>Delhi
										<p>NSUI national secretariat is at <strong>5, Raisina Road</strong> where relief materials are also collected.</p>
									</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3">
								<h5>Where in Assam will the dropped-off items go?: </h5>
							</div>
							<div class="col-sm-8 col-sm-offset-1">
								<p>The main center is set up in Guwahati so that it can be transported to the various flood affected regions spread across the state.</p>
								<p><strong>Assam Unit, Rajiv Bhawan, Ulubari, GS road. 781005</strong></p>
								<p>(Ulubari is a locality in the center of Guwahati)</p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3">
								<h5>Who will distribute?: </h5>
							</div>
							<div class="col-sm-8 col-sm-offset-1">
								<p>Our NSUI district units will be distributing these relief materials accordingly.</p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3">
								<h5>Will I get a receipt?: </h5>
							</div>
							<div class="col-sm-8 col-sm-offset-1">
								<p>Waiting on information</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-2">
						<h4>Option 2 : </h4>
					</div>
					<div class="col-sm-10 donate-option">
						<h4>Dy365</h4>
						<p>24 X 7 Satellite TV Channel from North East</p>
						<p>Contact: Subash. <a target="_blank" href="https://twitter.com/dy365"><span class="fa fa-twitter fa-fw fa-2x"></span></a>
						at Dy365 Delhi office.</p>
						<div class="row">
							<div class="col-sm-3">
								<h5>Requirements List: </h5>
							</div>
							<div class="col-sm-8 col-sm-offset-1">
								<h5>Last Updated On: Sep 26, 2014</h5>
								<ul>
									<li>Medicines</li>
										<ul>
											<li>Fever</li>
											<li>Cough</li>
											<li>Dehydration</li>
											<li>Water-borne diseases</li>
										</ul>
									<li>Clothes</li>
									<li>Blankets</li>
									<li>Mosquito Nets (because of the standing water)</li>
									<li>Potable drinking water</li>
									<li>Rice</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3">
								<h5>Drop Off Location: </h5>
							</div>
							<div class="col-sm-8 col-sm-offset-1">
								<strong>Delhi</strong>
								<p>Dy365 Office is at <strong>F-67 ,1st Floor,Bhagat Singh Market,Gole Market,New Delhi-110001</strong> where relief materials are also collected.</p>
								<p>Ph: 011-43053571</p>
								<p>Timings: 10am to 6pm</p>
								<p>Contact person: Subhash. Mobile: 9958881310</p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3">
								<h5>Where in Assam will the dropped-off items go?: </h5>
							</div>
							<div class="col-sm-8 col-sm-offset-1">
								<p>Dy365 Guwahati Office:</p>
								<p><strong>Brahmaputra Tele Productions Pvt. Ltd. Gorchuk, DY365, NH-37,Guwahati-35,Assam</strong></p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3">
								<h5>Who will distribute?: </h5>
							</div>
							<div class="col-sm-8 col-sm-offset-1">
								<p>Waiting on information.</p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3">
								<h5>Will I get a receipt?: </h5>
							</div>
							<div class="col-sm-8 col-sm-offset-1">
								<p>You will get a receipt and your donation will be thanked in the news by their channel as well.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-2">
						<h4>Option 3 : </h4>
					</div>
					<div class="col-sm-10 donate-option">
						<h4>Assam Bhavan, Delhi</h4>
						<p>Every State has a Resident Commissioner office in Delhi</p>
						<p>Contact: 011-26116444.</p>
						<div class="row">
							<div class="col-sm-3">
								<h5>Requirements List: </h5>
							</div>
							<div class="col-sm-8 col-sm-offset-1">
								<h5>Last Updated On: Sep 26, 2014</h5>
								<p>Information NOT provided by them.</p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3">
								<h5>Drop Off Location: </h5>
							</div>
							<div class="col-sm-8 col-sm-offset-1">
								<strong>Delhi</strong>
								<p><strong>Assam Bhavan, S.P. Marg, New Delhi - 110021</strong> where relief materials are also collected.</p>
								<p>Ph: 011-26116444</p>
								<p>Timings: 10am to 6pm</p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3">
								<h5>Where in Assam will the dropped-off items go?: </h5>
							</div>
							<div class="col-sm-8 col-sm-offset-1">
								<p>Information NOT provided by them.</p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3">
								<h5>Who will distribute?: </h5>
							</div>
							<div class="col-sm-8 col-sm-offset-1">
								<p>Information NOT provided by them.</p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3">
								<h5>Will I get a receipt?: </h5>
							</div>
							<div class="col-sm-8 col-sm-offset-1">
								<p>You will get a receipt.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- row -->
	</div> <!-- container -->

</div>

@stop

@section('jsinclude')

        
@stop
