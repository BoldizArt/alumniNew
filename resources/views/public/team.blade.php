<style>
	.width100 {
		width: 100%;
	}
</style>

@extends('layouts.app')

@section('content')
	<div class="container show-profile alumni-team">
		<div class="row">
			<div class="col-sm-6">
				<h2 class="-title">{{ $title }}<h2>
			</div>
		</div>
		<hr>

		@foreach ($team as $type => $members)
			<div class="container">    
				<div class="row paddtb-32 flexed-content">
					<div class="col-sm-12 text-center">
						<h4 class="team-type">Alumni {{ $type }}i</h4>
					</div>
					@foreach ($members as $member)
					<div class="col-sm-4 col-md-3 raw">
						<center>
						<div class="profile-box">
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
											{{ substr($member->prezime, 0, 1) }}.
										@else
											{{$member->prezime}}
										@endif
									</h4>
								</a>
								<hr style="border-color: #131a21;">
								<h5>{{$member->smer}}</h5>
							</center>
						</div>
					</center>
					</div>
					@endforeach
					<div class="row separator">
				</div>
			</div>
		@endforeach
	</div>

@endsection

<style>
	.alumni-team ._img-box {
		width: 90% !important;
		max-width: 90% !important;
	}
	.alumni-team ._img-box ._img{
		min-width: 220px !important;
	}
	.alumni-team .flexed-content {
		display: flex;
		justify-content: space-around;
	}
	.alumni-team .separator {
		padding-bottom: 45px;
		margin-bottom: 45px;
		border-bottom: 1px solid #ccc;
		width: 100%;
	}
</style>