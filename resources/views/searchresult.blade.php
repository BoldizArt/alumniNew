<div id="replaceProfiles">
	@if(count($data) > 0)
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
			<tbody id="tableBody">
					@foreach($data as $profile)
						
							<tr>
								<td><center><a href="/profile/{{$profile->id}}"><img class="locked profile-image" src="/images/{{$profile->slika}}" alt="{{$profile->ime}} {{$profile->prezime}}"></a></center></td>
								<td class="ime"><a href="/profile/{{$profile->id}}">{{$profile->ime}} {{$profile->prezime}}</a></td>
								<td class="mobile-hide">{{$profile->smer}}</td>
								<td>{{$profile->godina_diplomiranja}}</td>
								<td class="mobile-hide">{{$profile->naziv_firme}}</td>
							</tr>
						
					@endforeach
			</tbody>
		</table>
	@else
		<p>Nijedan student nije pronađen</p>
	@endif
	<div class="pagination">{{$data->links()}}</div>
</div>