@extends('layouts.app')


<style>
	.image-box {
	  position: relative;
	  margin-bottom: 25px;
	}
	
	.-image {
		width: 100%; 
		border-radius: 50%;
	}
	.-alert{
		border: 1px solid red;
	}
	
	.-overlay {
	  position: absolute;
	  cursor: pointer;
	  border-radius: 50%;
	  top: 0;
	  bottom: 0;
	  left: 0;
	  right: 0;
	  height: 100%;
	  width: 100%;
	  opacity: 0;
	  transition: .5s ease;
	  background-color: #008CBA;
	}
	
	.image-box:hover .-overlay {
	  opacity: 0.75;
	}
	
	.-text {
	  color: white;
	  font-size: 20px;
	  position: absolute;
	  top: 50%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  text-align: center;
	}
	.-upload{
		font-size: 50px;
	}
	.hidden{
		display: none;
	}
	</style>

@section('content')
	<div class="container">
		<h2>{{ $title }}</h2>
		<hr />
		<div class="row">
			<div class="col-sm-3">
				<label for="slika">Profilna slika</label>
				{!! Form::open(['action' => 'Actions\ActionsController@saveImage', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'ajaxImageForm']) !!}
					
					<div class="image-box">
						<img id="ajaxImage" class="-image" src="/images/{{$profile->slika}}" alt="Profile picture">
						<div id="ajaxImageUpload" class="-overlay">
							<div class="-text">Postavi profilnu sliku</div>
						</div>
					</div>

					<div class="form-group">
						{{Form::file('slika', ['id' => 'ajaxImageInput', 'class' => 'hidden'])}}
						<small id="imageError" class="text-danger"></small>
					</div>
				
				{!! Form::close() !!}
			</div>
			<div class="col-sm-9">

				{!! Form::open(['route' => 'profile.update', 'method' => 'POST']) !!}

				{{Form::hidden('slika', $profile->slika, ["class" => "profile-picture-name"])}}
				
				<div class="form-group @if($errors->has('ime')) has-danger @endif">
					{{Form::label('ime', 'Ime')}}
					{{Form::text('ime', $profile->ime, ['class' => 'form-control', 'placeholder' => 'Ime'])}}
					@if($errors->has('ime'))
						<small id="passwordHelp" class="text-danger">{{ $errors->first('ime') }}</small> 
					@endif
				</div>
				<div class="form-group @if($errors->has('prezime')) has-danger @endif">
					{{Form::label('prezime', 'Prezime')}}
					{{Form::text('prezime', $profile->prezime, ['class' => 'form-control', 'placeholder' => 'Prezime'])}}
					@if($errors->has('prezime'))
						<small id="passwordHelp" class="text-danger">{{ $errors->first('prezime') }}</small> 
					@endif
				</div>

				<div class="form-group @if($errors->has('smer')) has-danger @endif">
					{{Form::label('smer', 'Smer')}}
					{{Form::text('smer', $profile->smer, ['class' => 'form-control', 'placeholder' => 'Smer'])}}
					@if($errors->has('smer'))
						<small id="passwordHelp" class="text-danger">{{ $errors->first('smer') }}</small> 
					@endif
				</div>

				<div class="form-group @if($errors->has('nivo_studija')) has-danger @endif">
					{{Form::label('nivo_studija', 'Nivo studija')}}
					{{ Form::select('nivo_studija', [
						'Osnovne studije' => 'Osnovne studije',
						'Master studije' => 'Master studije',
						'Doktorske studije' => 'Doktorske studije'
						],
						$profile->nivo_studija,
						['class' => 'form-control', 'placeholder' => 'Nivo studija']
					) }}
					@if($errors->has('nivo_studija'))
						<small id="passwordHelp" class="text-danger">{{ $errors->first('nivo_studija') }}</small> 
					@endif
				</div>

				<div class="form-group @if($errors->has('godina_diplomiranja')) has-danger @endif">
					{{Form::label('godina_diplomiranja', 'Godina diplomiranja')}}
					{{Form::selectYear('godina_diplomiranja', 1950, date('Y'),$profile->godina_diplomiranja, ['class' => 'form-control']) }}
					@if($errors->has('godina_diplomiranja'))
						<small id="passwordHelp" class="text-danger">{{ $errors->first('godina_diplomiranja') }}</small> 
					@endif
				</div>

				<div class="form-group @if($errors->has('naziv_firme')) has-danger @endif">
					{{Form::label('naziv_firme', 'Naziv firme')}}
					{{Form::text('naziv_firme', $profile->naziv_firme, ['class' => 'form-control', 'placeholder' => 'Naziv firme'])}}
					@if($errors->has('naziv_firme'))
						<small id="passwordHelp" class="text-danger">{{ $errors->first('naziv_firme') }}</small> 
					@endif
				</div>

				<div class="form-group @if($errors->has('radno_mesto')) has-danger @endif">
					{{Form::label('radno_mesto', 'Radno mesto')}}
					{{Form::text('radno_mesto', $profile->radno_mesto, ['class' => 'form-control', 'placeholder' => 'Radno mesto'])}}
					@if($errors->has('radno_mesto'))
						<small id="passwordHelp" class="text-danger">{{ $errors->first('radno_mesto') }}</small> 
					@endif
				</div>

				<div class="form-group @if($errors->has('biografija')) has-danger @endif">
					{{Form::label('biografija', 'Biografija')}}
					{{Form::textarea('biografija', $profile->biografija, ['class' => 'form-control', 'placeholder' => 'Biografija'])}}
					@if($errors->has('biografija'))
						<small id="passwordHelp" class="text-danger">{{ $errors->first('biografija') }}</small> 
					@endif
				</div>

				<div class="form-group">
					{{Form::label('poruka', 'Poruka')}}
					{{Form::textarea('poruka', $profile->poruka, ['class' => 'form-control', 'placeholder' => 'Poruka (Max 750 karaktera)', 'maxlength' => 750])}}
				</div>

					{{Form::submit('Submit', ['class' => 'btn btn-primary float-right'])}}

				{!! Form::close() !!}
			</div>
		</div>
	</div>
	<div style="clear: both"></div>
@endsection