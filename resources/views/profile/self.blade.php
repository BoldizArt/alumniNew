@extends('layouts.app')

@section('content')
	<div class="container show-profile">
		@foreach($data as $profile)
		<div class="row">
			<div class="col-sm-6">
				<h2 class="ime">{{ $profile->ime }} {{$profile->prezime}}</h2>
			</div>
			<div class="col-sm-6">
				<div class="alert alert-dismissible alert-danger">
					Vaš profil još nije aktiviran. Čeka se na odobrenje od strane admina.
				</div>
			</div>
		</div>
		<hr>
			<div class="row paddb-32">
				<div class="col-sm-4">
					<center>
						<img src="/images/{{ $profile->slika }}" alt="Boldižar Santo" class="profilna_slika zabranjen_pristup" style="height: 306px;">
						<br />
						<br />
					</center>
					</div>
					<br>
					<div class="col-sm-8">
					<table class="table table-striped table-hover -info">
						<tbody>
							<tr>
								<td style="font-weight: bold; color: grey;">Smer</td>
								<td>{{ $profile->smer }}</td>
							</tr>
							<tr>
								<td style="font-weight: bold; color: grey;">Nivo studija</td>
								<td>{{ $profile->nivo_studija }}</td>
							</tr>
							<tr>
								<td style="font-weight: bold; color: grey;">Godina diplomiranja</td>
								<td>{{ $profile->godina_diplomiranja }}</td>
							</tr>
							<tr>
								<td style="font-weight: bold; color: grey;">Naziv Firme</td>
								<td>{{ $profile->naziv_firme }}</td>
							</tr>
							<tr>
								<td style="font-weight: bold; color: grey;">Radno mesto</td>
								<td>{{ $profile->radno_mesto }}</td>
							</tr>
							<tr>
								<td style="font-weight: bold; color: grey;">Izmeni profil</td>
								<td><a btn class="btn btn-success" href="/profile/me/edit">Izmeni</a></td>
							</tr>

						</tbody>
					</table> 
					</div>
				</div>
				<h6>Biografija</h6>
				<p class="text-justify">{{ $profile->biografija }}</p>
				@if($profile->poruka)
					<div class="paddb-32 citat">
					<h6>Poruka</h6>
						<blockquote>
							<p>{{ $profile->poruka }}</p>
						</blockquote>
					</div>
				@endif
			</div>
		@endforeach
	</div>
@endsection