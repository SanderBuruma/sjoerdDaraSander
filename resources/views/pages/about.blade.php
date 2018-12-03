@extends('layouts.app')

@section('title', '| About')

@section('content')
<div class="row">
	<div class="col-md-8 offset-md-2">
		<div class="card">
			<div class="card-header">
				Sander Buruma
			</div>
			<div class="card-body">
				<p>Astute fullstack web developer, at your service!</p>
				<p>Click the button to get your coordinates.</p>

				<button onclick="getLocation()">Bepaal uw locatie </button>
				
				<p id="demo"></p>



			</div>
		</div>
	</div>
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