@extends('layouts.app')

@section('content')
	<div class="container show-profile">
		<div class="row">
			<div class="col-sm-6">
				<h2 class="-title">{{ $title }}<h2>
			</div>
		</div>
		<hr>



		@foreach ($team as $type => $members)
			<div class="container">    
				<div class="row paddtb-32">
					<div class="col-sm-12 text-center">
						<h4 class="team-type">Alumni {{ $type }}i</h4>
					</div>
					@foreach ($members as $member)
						<div class="col-sm-3 pocetna_studenti">
						<center>
							<div class="cont">
							<a href="/team/{{$member->id}}">
								<div class="_img-box">
								<img src="images/{{$member->slika}}" alt="{{$member->ime}} {{$member->prezime}}" class="_locked _img">
								</div>
							</a>
							</div>
							<a href="/team/{{$member->id}}">
							<h4 class="ime" id="velicina">{{$member->ime}} 
							@if(strlen($member->ime . $member->prezime) > 17)
								{{ substr($member->prezime,0,1) }}.
							@else
								{{$member->prezime}}
							@endif
							</h4>
							</a>
							<hr style="border-color: #131a21;">
							<h5>{{$member->smer}}</h5>
						</center>
						</div>
					@endforeach
				</div>
			</div>
		@endforeach
+
	</div>

@endsection