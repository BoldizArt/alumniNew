@extends('layouts.app')

@section('content')

<div class="container profiles-container">
		<div class="row">
			<div class="col-md-6"><h2 style="color: black">{{$title}}</h2></div>
			<div class="col-md-6">
				@if(\Request::route()->getName() == 'public.index')
					{!! Form::open(['action' => 'Search\SearchController@get', 'method' => 'POST', 'id' => 'searchForm']) !!}
					<div class="form-group">
						<div class="input-group mb-3">
							{{Form::text('keywords', '', ['class' => 'form-control', 'placeholder' => 'Pretraga', 'id' => 'keywords'])}}
							<div class="input-group-append">
								{{ Form::select('search_category', [
									'ime_prezime' => 'Ime i prezime',
									'smer' => 'Smer',
									'naziv_firme' => 'Naziv firme',
									'godina_diplomiranja' => 'Godina diplomiranja'
									],
									'',
									['class' => 'form-control', 'id' => 'searchCategory']
								) }}
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

							@if($profile->tip_profila)
								@if($profile->tip_profila !== 'student')
									@php($url = '/team/')
								@else
									@php ($url = '/profile/')
								@endif
							@else
								@php ($url = '/temporary/profile/')
							@endif

							<tr>
								<td><center><a href="{{ $url }}{{ $profile->id }}"><img class="locked profile-image" src="/images/{{ $profile->slika }}" alt="{{$profile->ime}} {{$profile->prezime}}"></a></center></td>
								<td class="ime"><a href="{{ $url }}{{ $profile->id }}">{{ $profile->ime }} {{ $profile->prezime }}</a></td>
								<td class="mobile-hide">{{ $profile->smer }}</td>
								<td>{{ $profile->godina_diplomiranja }}</td>
								<td class="mobile-hide">{{ $profile->naziv_firme }}</td>
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