@extends('layouts.app')

@section('content')

<div class="container paddtb-32 min_visina">
	<h2 style="color: black">NAŠI STUDENTI</h2>
	<table class="table table-striped table-hover">
	  <thead>
	    <tr>
	      <th></th>
	      <th>Prezime i Ime</th>
	      <th class="mobile-hide">Smer</th>
	      <th>Datum dipl.</th>
	      <th class="mobile-hide">Naziv firme</th>
	    </tr>
	  </thead>
	  <tbody>
			@if(count($data) > 0)
				@foreach($data as $profile)
					
						<tr>
							<td><center><a href="/profile/{{$profile->id}}"><img src="/images/{{$profile->slika}}" alt="{{$profile->ime}} {{$profile->prezime}}" style="height: 65px;"></a></center></td>
							<td class="ime"><a href="/profile/{{$profile->id}}">{{$profile->ime}} {{$profile->prezime}}</a></td>
							<td class="mobile-hide">{{$profile->smer}}</td>
							<td>{{$profile->godina_diplomiranja}}</td>
							<td class="mobile-hide">{{$profile->naziv_firme}}</td>
						</tr>
					
				@endforeach
			@else
				<p>No user found</p>
			@endif

	  </tbody>
	</table>
</div>
