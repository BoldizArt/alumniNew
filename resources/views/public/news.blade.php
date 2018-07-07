

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
                <div class="news-text">
                    <h4>Događaj br1</h4>
                    <p class="text-justify">Lorem ipsum dolor sit amet,sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,  At vero eos et accusam et justo duo dolores et ea rebum.  Lorem ipsum dolor sit amet,  no sea takimata sanctus est Lorem ipsum dolor sit amet.  Stet clita kasd gubergren,  no sea takimata sanctus est Lorem ipsum dolor sit amet.  no sea takimata sanctus est Lorem ipsum dolor sit amet.  no sea takimata sanctus est Lorem ipsum dolor sit amet amet consectetur adipisicing elit. Doloribus iusto vitae repudiandae dolore voluptatum neque eos, inventore iure earum aut asperiores quos, maiores sit quasi corporis cumque. Totam, perferendis inventore?</p>
                    <div class="-social">
                        @php($shareTitle = 'title')
                        @php($shareSummary = 'summary')
                        @php($shareUrl = 'http://127.0.0.1:8000/news')
                        @php($shareImage = 'http://127.0.0.1:8000/images/profile.png')

                        <i class="fab fa-facebook" onclick="window.open('http://www.facebook.com/sharer.php?s=100&p[title]={{ $shareTitle }}&p[summary]={{ $shareSummary }}&p[url]={{ $shareUrl }}&p[images][0]={{ $shareImage }}', '_blank')"; ></i>
                        <i class="fab fa-twitter"></i>
                        <i class="fab fa-google-plus"></i>
                        <i class="fab fa-linkedin"></i>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <br /><hr /><br />
            </div>

<style>
    .news-text{
        height: 100%; 
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .news-text .-social svg{
        width: 22px;
        height: 22px;
        color: #4d4d4d;
        cursor: pointer;
    }

    .news-text .-social .fa-facebook:hover{
        color: #3b5998;
    }
    .news-text .-social .fa-twitter:hover{
        color: #00aced;
    }
    .news-text .-social .fa-google-plus:hover{
        color: #DD4B39;
    }
    .news-text .-social .fa-linkedin:hover{
        color: #0e76a8;
    }

</style>

            <div class="col-sm-8">
                <div class="news-text">
                    <h4>Događaj br2</h4>
                    <p class="text-justify">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus iusto vitae repudiandae dolore voluptatum neque eos, inventore iure earum aut asperiores quos, maiores sit quasi corporis cumque. Totam, perferendis inventore?</p>
                    <div class="-social">
                        @php($shareTitle = 'title')
                        @php($shareSummary = 'summary')
                        @php($shareUrl = 'http://127.0.0.1:8000/news')
                        @php($shareImage = 'http://127.0.0.1:8000/images/profile.png')

                        <i class="fab fa-facebook" onclick="window.open('http://www.facebook.com/sharer.php?s=100&p[title]={{ $shareTitle }}&p[summary]={{ $shareSummary }}&p[url]={{ $shareUrl }}&p[images][0]={{ $shareImage }}', '_blank')"; ></i>
                        <i class="fab fa-twitter"></i>
                        <i class="fab fa-google-plus"></i>
                        <i class="fab fa-linkedin"></i>
                    </div>
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