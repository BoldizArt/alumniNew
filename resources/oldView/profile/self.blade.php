@extends('layouts.app')

@section('content')
{!! Form::open(['action' => 'Profile\ProfileController@image', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'ajaxImageForm']) !!}

<div class="form-group">
	<label for="slika"><img id="ajaxImage" style="width: 280px; cursor: pointer;" src="/images/profile.png" alt="Card image"></label>
	<span class="hidden">{{Form::file('slika', ['id' => 'ajaxImageInput'])}}</span>
	<small id="passwordHelp" class="text-danger"></small>
</div>

{!! Form::close() !!}
@endsection