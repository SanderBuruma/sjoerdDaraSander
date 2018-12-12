@extends('layouts.app')

@section('title', '| About')

<link rel="stylesheet" href="{{ asset('css/about.css') }}">

@section('content')

<div class="filler"></div>
<div class="row"><div class="col-md-6 offset-md-3 main">
	{{-- <div class="col-md-6 offset-md-3"> --}}
		<div class="card1">
			<div class="card-header">
				<b>Nervamarkt</b>
			</div>
			<div class="card-body">
				<p>Bij Nervamarkt kunt u in uw eigen omgeving eenvoudig reageren op advertenties en producten kopen bij u in de buurt. Met onze online vlooienmarkt kunt u op afstanden van een, twee en drie kilometer producten selecteren van andere gebruikers, chatten, een bod doen en een mooie prijs overeenkomen.</p> 

				<hr>
				



			</div>
		</div>
	{{-- </div> end 6-3--}}
	</div><!-- end main -->
</div>




<script>
var x = document.getElementById("demo");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude;
}
</script>
@endsection