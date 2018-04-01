@extends('layouts.app')

@section('content')
<div class="container">

	<h2>{{ $title }}</h2>
	<hr />

<div class="row">

<div class="col-sm-3">

	<label>Nemoj sliku zaboraviti...</label>
	<img style="width: 100%;" src="/images/profile.png" alt="Card image">
				
</div>
<div class="col-sm-9">

		

	{!! Form::open(['action' => 'ProfileController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
	{!! Form::token() !!}
	
	<div class="form-group @if($errors->has('ime')) has-danger @endif">
		{{Form::label('ime', 'Ime')}}
		{{Form::text('ime', '', ['class' => 'form-control', 'placeholder' => 'Ime'])}}
		@if($errors->has('ime'))
			<small id="passwordHelp" class="text-danger">{{ $errors->first('ime') }}</small> 
		@endif
	</div>
	<div class="form-group @if($errors->has('prezime')) has-danger @endif">
		{{Form::label('prezime', 'Prezime')}}
		{{Form::text('prezime', '', ['class' => 'form-control', 'placeholder' => 'Prezime'])}}
		@if($errors->has('prezime'))
			<small id="passwordHelp" class="text-danger">{{ $errors->first('prezime') }}</small> 
		@endif
	</div>

	<div class="form-group @if($errors->has('slika')) has-danger @endif">
		{{Form::label('slika', 'Slika')}}
		{{Form::file('slika')}}
		@if($errors->has('slika'))
			<small id="passwordHelp" class="text-danger">{{ $errors->first('slika') }}</small> 
		@endif
	</div>

	<div class="form-group @if($errors->has('smer')) has-danger @endif">
		{{Form::label('smer', 'Smer')}}
		{{Form::text('smer', '', ['class' => 'form-control', 'placeholder' => 'Smer'])}}
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
			'Osnovne studije',
			['class' => 'form-control', 'placeholder' => 'Nivo studija']
		) }}
		@if($errors->has('nivo_studija'))
			<small id="passwordHelp" class="text-danger">{{ $errors->first('nivo_studija') }}</small> 
		@endif
	</div>

	<div class="form-group @if($errors->has('godina_diplomiranja')) has-danger @endif">
		{{Form::label('godina_diplomiranja', 'Godina diplomiranja')}}
		{{Form::selectYear('godina_diplomiranja', 1990, date('Y'), date('Y'), ['class' => 'form-control']) }}
		@if($errors->has('godina_diplomiranja'))
			<small id="passwordHelp" class="text-danger">{{ $errors->first('godina_diplomiranja') }}</small> 
		@endif
	</div>

	<div class="form-group @if($errors->has('naziv_firme')) has-danger @endif">
		{{Form::label('naziv_firme', 'Naziv firme')}}
		{{Form::text('naziv_firme', '', ['class' => 'form-control', 'placeholder' => 'Naziv firme'])}}
		@if($errors->has('naziv_firme'))
			<small id="passwordHelp" class="text-danger">{{ $errors->first('naziv_firme') }}</small> 
		@endif
	</div>

	<div class="form-group @if($errors->has('radno_mesto')) has-danger @endif">
		{{Form::label('radno_mesto', 'Radno mesto')}}
		{{Form::text('radno_mesto', '', ['class' => 'form-control', 'placeholder' => 'Radno mesto'])}}
		@if($errors->has('radno_mesto'))
			<small id="passwordHelp" class="text-danger">{{ $errors->first('radno_mesto') }}</small> 
		@endif
	</div>

	<div class="form-group @if($errors->has('biografija')) has-danger @endif">
		{{Form::label('biografija', 'Biografija')}}
		{{Form::textarea('biografija', '', ['class' => 'form-control', 'placeholder' => 'Biografija'])}}
		@if($errors->has('biografija'))
			<small id="passwordHelp" class="text-danger">{{ $errors->first('biografija') }}</small> 
		@endif
	</div>

	<div class="form-group">
		{{Form::label('poruka', 'Poruka')}}
		{{Form::textarea('poruka', '', ['class' => 'form-control', 'placeholder' => 'Poruka (Max 750 karaktera)', 'maxlength' => 750])}}
	</div>

		{{Form::submit('Submit', ['class' => 'btn btn-primary float-right'])}}

	{!! Form::close() !!}
</div>
</div>
</div>

@endsection