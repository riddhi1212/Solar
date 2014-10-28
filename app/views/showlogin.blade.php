@extends('layouts/navhome')

@section('content')
		<div id="wrap">

			<div class="stripe">
				<div class="container">
					<p>Please log in below. </p>
				</div>
			</div>

			<div class="login-form">
				<div class="container">
					{{ Form::open(array('url' => 'login')) }}
						<h1>Login</h1>

						<!-- if there are login errors, show them here -->
						<p>
							{{ $errors->first('fname') }}
							{{ $errors->first('mobile') }}
						</p>

						<p>
							{{ Form::label('fname', 'First Name') }}
							{{ Form::text('fname', Input::old('fname'), array('placeholder' => 'First name')) }}
						</p>

						<p>
							{{ Form::label('mobile', 'Mobile') }}
							{{ Form::text('mobile') }}
						</p>

						<p>{{ Form::submit('Submit!') }}</p>
					{{ Form::close() }}
				</div>
			</div>

		</div>

@stop