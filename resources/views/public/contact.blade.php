

@extends('layouts.app')

@section('content')

	<div class="container profiles-container">
		<div class="row">
            <div class="col-sm-12">
                <h2 style="color: black">{{$title}}</h2>
                <hr />
            </div>
            <div class="col-sm-12">

                {!! Form::open(['route' => 'admin.index', 'method' => 'POST']) !!}

                    <div class="form-group">
                        {{Form::label('email', 'Email')}}
                        @if(Auth::user())
                            {{Form::email('email', Auth::user()->email, ['class' => 'form-control', 'readonly' => 'true', 'required' => 'required'])}}
                        @else
                            {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Vaša email adresa', 'required' => 'required'])}}                    
                        @endif
                    </div>

                    <div class="form-group">
                        {{Form::label('tema', 'Tema')}}
                        {{Form::text('tema', '', ['class' => 'form-control', 'placeholder' => 'Tema poruke', 'required' => 'required'])}}
                    </div>

                    <div class="form-group">
                        {{Form::label('poruka', 'Poruka')}}
                        {{Form::textarea('poruka', '', ['class' => 'form-control', 'placeholder' => 'Vaša poruka', 'required' => 'required'])}}
                        <small class="form-text text-muted">Neko od administratora će Vam odgovoriti u najkraćem mogućem roku.</small>
                    </div>


                    {{Form::submit('Pošalji', ['class' => 'btn btn-primary float-right'])}}

                {!! Form::close() !!}

            </div>
        </div>


    </div>


@endsection

@section('footer')
@endsection