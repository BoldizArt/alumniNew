@extends('layouts.app')

@section('content')
<div class="container show-profile">
	@if(Auth::user() AND Auth::user()->role == 1 AND \Request::route()->getName() == 'admin.show')
		{!! Form::open(['action' => 'Profile\AdminController@accept', 'method' => 'POST', 'id' => 'acceptForm']) !!}
		{{Form::hidden('pid', $profile->id)}}	
		<div class="row admin-comment-form">
				<div class="col-sm-6">
					<div class="form-group">
						{{Form::label('komentar', 'Dodaj komentar')}}
						{{ Form::textarea('komentar', $profile->komentar, ['class' => 'form-control', 'placeholder' => 'Dodaj komentar', 'rows' => '6']) }}
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
			<h2 class="ime">{{ $profile->ime }} {{$profile->prezime}} 
				@if($profile->tip_profila !== 'student' AND !empty($profile->tip_profila))
					<small> ({{ $profile->tip_profila }})</small>
				@endif
			</h2>
		</div>
		<div class="col-sm-6">
			@if(Auth::user())
				@if($profile->komentar)
					<div class="alert alert-dismissible alert-danger">
						{{$profile->komentar}}
					</div> 
				@endif
				@if(Auth::user()->id == $profile->autor)
					<div class="alert alert-dismissible alert-success">
						Profil  je aktivan.
					</div>
				@endif
			@endif
		</div>
	</div>
	<hr>
		<div class="row paddb-32">
			<div class="col-sm-4">
			<div class="_img-box">
				<img src="/images/{{$profile->slika}}" alt="{{ $profile->ime }} {{$profile->prezime}}" class="_locked _img">
			</div>
			</div>
			<br>
			<div class="col-sm-8 vertical-center">
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
						@if($profile->status !== 'blocked')
							@if($profile->uid == 0 AND Auth::user()->id == $profile->autor)
								<tr>
									<td><a btn class="btn btn-success" href="{{route('admin.team-edit', ['team' => $profile->id])}}">Izmeni</a></td>
									<td>
										{!! Form::open(['route' => ['admin.team-destroy'], 'method' => 'DELETE', 'id' => 'profile-delete-form']) !!}
										{{Form::hidden('id', $profile->id)}}
										{{Form::submit('Obriši', ['class' => 'btn btn-danger', 'id' => 'profile-delete-submit'])}}
										{!! Form::close() !!}
									</td>
								</tr>
							@elseif(Auth::user()->id == $profile->uid OR Auth::user()->id == $profile->autor)	
								<tr>
									<td><a btn class="btn btn-success" href="{{route('user.edit')}}">Izmeni</a></td>
									<td>
										{!! Form::open(['route' => ['user.destroy'], 'method' => 'DELETE', 'id' => 'profile-delete-form']) !!}
											{{Form::submit('Obriši', ['class' => 'btn btn-danger', 'id' => 'profile-delete-submit'])}}
										{!! Form::close() !!}
									</td>
								</tr>
							@else
								<tr>
									<td>Kontakt informacije:</td>
									<td><a data-toggle="modal" data-target="#mail-modal" id="send-mail" class="btn btn-info" href="#">Pošalji poruku</a></td>
								</tr>
							@endif
						@endif

						@extends('modals.mail', ['pid' => $profile->id])

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
					<p class="text-justify">{{ $profile->poruka }}</p>
				</blockquote>
			</div>
		@endif
		</div>

</div>

@endsection