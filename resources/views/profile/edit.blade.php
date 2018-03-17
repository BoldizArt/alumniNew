<div class="container">
	<h2>{{ $data }}</h2>
</div>


{!! Form::open(['action' => 'ProfileController@store', 'method' => 'POST']) !!}
    {{Form::label('name', 'Ime')}}
	{{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Ime'])}}
	{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
{!! Form::close() !!}