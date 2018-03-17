<link rel="stylesheet" type="text/css" href="http://alumni.boldizart.com/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="http://alumni.boldizart.com/css/style.css">

<div class="container min_visina">
<br class="tablet-hide">


<div class="row paddb-32">
    <div class="col-sm-4">
    <h3 class="tablet-show ime">{{ $info['ime'] }} {{$info['prezime']}}</h3>
		<br>
    <center>
    	<img src="http://alumni.boldizart.com/img/a597e50502f5ff68e3e25b9114205d4a.jpg" alt="Boldižar Santo" class="profilna_slika zabranjen_pristup" style="height: 306px;">
    </center>
    </div>
    <br>
    <div class="col-sm-8">
	<h3 class="tablet-hide ime">{{ $info['ime'] }} {{$info['prezime']}}</h3>
		<br>
		<table class="table table-striped table-hover">
		  <tbody>
		    <tr>
		      <td>Smer:</td>
		      <td>{{ $info['smer'] }}</td>
		    </tr>
		    <tr>
		      <td>Nivo studija:</td>
		      <td>{{ $info['nivostudija'] }}</td>
		    </tr>
		    <tr>
		      <td>Godina diplomiranja:</td>
		      <td>{{ $info['godinadipl'] }}</td>
		    </tr>
		    <tr>
		      <td>Naziv Firme:</td>
		      <td>{{ $info['nazivfirme'] }}</td>
		    </tr>
		    <tr>
		      <td>Radno mesto:</td>
		      <td>{{ $info['radnomesto'] }}</td>
		    </tr>
		    <tr>
		      <td>Kontakt informacije:</td>
		      <td><a btn class="btn btn-default" href="#">Pitaj</a></td>
		    </tr>
		  </tbody>
		</table> 
    </div>
  </div>
<p class="text-justify">{{ $info['bio'] }}</p>
<div class="paddb-32 citat">
	<blockquote>
	  <p>{{ $info['poruka'] }}</p>
	  <small><cite class="ime">{{ $info['ime'] }} {{$info['prezime']}}</cite></small>
	</blockquote>
</div>
</div>