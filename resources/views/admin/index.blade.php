@extends('layouts.app')

@section('content')

	<div class="container profiles-container">
		<div class="row">
			<div class="col-sm-6"><h2 style="color: black">{{$title}}</h2></div>
			<div class="col-sm-6">
				@if(\Request::route()->getName() == 'profile.index')
					{!! Form::open(['action' => 'Search\SearchController@get', 'method' => 'POST', 'id' => 'searchForm']) !!}
					<div class="form-group">
						<div class="input-group mb-3">
							{{Form::text('keywords', '', ['class' => 'form-control', 'placeholder' => 'Pretraga', 'id' => 'keyWords'])}}
							<div class="input-group-append">
								{{Form::submit('Pretraga', ['class' => 'btn btn-primary float-right'])}}
							</div>
						</div>
					</div>
					{!! Form::close() !!}
				@endif
			</div>
		</div>
		
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
										<td><center><a href="/temporary/profile/{{$profile->id}}"><img class="locked profile-image" src="/images/{{$profile->slika}}" alt="{{$profile->ime}} {{$profile->prezime}}"></a></center></td>
										<td class="ime"><a href="/temporary/profile/{{$profile->id}}">{{$profile->ime}} {{$profile->prezime}}</a></td>
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
	</div>

@endsection

@section('footer')
@endsection