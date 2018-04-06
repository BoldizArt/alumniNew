@extends('layouts.app')

@section('content')
<div class="container show-profile">
	@if(Auth::user() AND Auth::user()->role)
		{!! Form::open(['action' => 'Search\SearchController@get', 'method' => 'POST', 'id' => 'searchForm']) !!}
			<div style="padding: 25px ; background: rgba(0,0,0,0.075); margin-bottom: 25px;" class="row">
				<div class="col-sm-6">
					<div class="form-group">
						{{Form::label('komentare', 'Dodaj komentar')}}
						{{ Form::textarea('komentare', $profile->komentare, ['class' => 'form-control', 'placeholder' => 'Dodaj komentar', 'rows' => '6']) }}
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						{{Form::label('status', 'Prihvati / odbaci')}}
						{{Form::select('status', [
								'pending' => 'Potrebne su izmene',
								'blocked' => 'Profil je blokiran',
								'active' => 'Profil je prihvaćen'
							],
							'pending',
							['class' => 'form-control', 'placeholder' => 'Izaberi opciju']) 
						}}
						<small class="text-default">Izaberite jedan od mogućih tri opcija. Poruku koju ovde napišete, videće korisnik. Ukoliko pihvatite korisnika, ovu poruku će dobiti na email adresu, koju ostavio prilikom registracije.</small> 
					</div>
					<div class="input-group-append">
						{{Form::submit('Pošalji', ['class' => 'btn btn-primary float-right'])}}
						
					</div>
				</div>
			</div>
		{!! Form::close() !!}
	@endif
	<div class="row">
		<div class="col-sm-6">
			<h2 class="ime">{{ $profile->ime }} {{$profile->prezime}}</h2>
		</div>
		<div class="col-sm-6">
			@if(Auth::user() AND !Auth::user()->role)
				@if($profile->komentare)
					<div class="alert alert-dismissible alert-danger">
						{{$profile->komentare}}
					</div>
				@endif
			@endif
		</div>
	</div>
	<hr>
		<div class="row paddb-32">
				<div class="col-sm-4">
				<center>
					<img src="/images/{{$profile->slika}}" alt="{{ $profile->ime }} {{$profile->prezime}}" class="locked profile-image">
				</center>
				</div>
				<br>
				<div class="col-sm-8">
				<table class="table table-striped table-hover -info">
					<tbody>
						<tr>
							<td>Smer:</td>
							<td>{{ $profile['smer'] }}</td>
						</tr>
						<tr>
							<td>Nivo studija:</td>
							<td>{{ $profile['nivo_studija'] }}</td>
						</tr>
						<tr>
							<td>Godina diplomiranja:</td>
							<td>{{ $profile->godina_diplomiranja }}</td>
						</tr>
						<tr>
							<td>Naziv Firme:</td>
							<td>{{ $profile->naziv_firme }}</td>
						</tr>
						<tr>
							<td>Radno mesto:</td>
							<td>{{ $profile->radno_mesto }}</td>
						</tr>
						@if(!Auth::guest())
							@if(Auth::user()->id == $profile->uid)
								<tr>
									<td style="font-weight: bold; color: grey;">Izmeni profil</td>
									<td><a btn class="btn btn-success" href="/profile/me/edit">Izmeni</a></td>
								</tr>
							@else
								<tr>
									<td>Kontakt informacije:</td>
									<td><a btn class="btn btn-info" href="#">Pošalji poruku</a></td>
								</tr>
							@endif
						@endif
						@if(Auth::guest())
							<tr>
								<td>Kontakt informacije:</td>
								<td><a href="/register">Kreirajt profil</a> ili <a href="/login">prijavite se</a>.</td>
							</tr>
						@endif
					</tbody>
				</table> 
				</div>
			</div>
		<h5>Biografija</h5>
		<p class="text-justify">{{ $profile->biografija }}</p>
		@if($profile->poruka)
			<div class="paddb-32 citat">
			<h5>Poruka</h5>
				<blockquote>
					<p>{{ $profile->poruka }}</p>
				</blockquote>
			</div>
		@endif
		</div>

</div>

@endsection