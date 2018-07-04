

@extends('layouts.app')

@section('content')

	<div class="container profiles-container">
		<div class="row">
            <div class="col-md-12">
                <h2 style="color: black">{{$title}}</h2>
                <hr />
            </div>
            
            <div class="col-sm-4">
                <div class="_img-box">
                    <img src="/images/profile.png" class="_locked _img">
                </div>
            </div>
                <div class="col-sm-8">
                    <div style="height: 100%; 
                    display: flex;
                    flex-direction: column;
                    justify-content: center;">
                    <h4>Događaj br1</h4>
                    <p class="text-justify">Lorem ipsum dolor sit amet,sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,  At vero eos et accusam et justo duo dolores et ea rebum.  Lorem ipsum dolor sit amet,  no sea takimata sanctus est Lorem ipsum dolor sit amet.  Stet clita kasd gubergren,  no sea takimata sanctus est Lorem ipsum dolor sit amet.  no sea takimata sanctus est Lorem ipsum dolor sit amet.  no sea takimata sanctus est Lorem ipsum dolor sit amet.  sed diam voluptua. </p>
                </div>
            </div>

            <div class="col-sm-12">
                <br /><hr /><br />
            </div>

            <div class="col-sm-8">
                <div style="height: 100%; 
                display: flex;
                flex-direction: column;
                justify-content: center;">
                    <h4>Događaj br2</h4>
                    <p class="text-justify">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus iusto vitae repudiandae dolore voluptatum neque eos, inventore iure earum aut asperiores quos, maiores sit quasi corporis cumque. Totam, perferendis inventore?</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="_img-box">
                    <img src="/images/profile.png" class="_locked _img">
                </div>
            </div>

        </div>
    </div>


@endsection

@section('footer')
@endsection