@extends('layouts.app')

@section('content')
<div class="container show-profile">

	<h2 class="ime">{{ $data->ime }} {{$data->prezime}}</h2>
	<hr>
		<div class="row paddb-32">
				<div class="col-sm-4">
				<center>
					<img src="/images/{{$data->slika}}" alt="Boldižar Santo" class="profilna_slika zabranjen_pristup" style="height: 306px;">
				</center>
				</div>
				<br>
				<div class="col-sm-8">
				<table class="table table-striped table-hover -info">
					<tbody>
						<tr>
							<td>Smer:</td>
							<td>{{ $data['smer'] }}</td>
						</tr>
						<tr>
							<td>Nivo studija:</td>
							<td>{{ $data['nivo_studija'] }}</td>
						</tr>
						<tr>
							<td>Godina diplomiranja:</td>
							<td>{{ $data->godina_diplomiranja }}</td>
						</tr>
						<tr>
							<td>Naziv Firme:</td>
							<td>{{ $data->naziv_firme }}</td>
						</tr>
						<tr>
							<td>Radno mesto:</td>
							<td>{{ $data->radno_mesto }}</td>
						</tr>
						<tr>
							<td>Kontakt informacije:</td>
							<td><a btn class="btn btn-info" href="#">Pošalji poruku</a></td>
						</tr>

					</tbody>
				</table> 
				</div>
			</div>
		<h6>Biografija</h6>
		<p class="text-justify">{{ $data->biografija }}</p>
		@if($data->poruka)
			<div class="paddb-32 citat">
			<h6>Poruka</h6>
				<blockquote>
					<p>{{ $data->poruka }}</p>
				</blockquote>
			</div>
		@endif
		</div>

</div>

@endsection