@extends('layouts.app')


@section('title', '| User Interface | '.Auth::user()->name)


@section('header')
<style>
	body {
		color: var(--main-color-dark);
	}
	div>nav {
		padding: 6px;
		border-bottom: 1px solid var(--main-color-med);
	}
	div>.main {
		padding: 1rem;
	}
	input {
		background: unset;
		border: unset;
		border-bottom: 1px solid var(--main-color-med);
		background-color: white;
		margin-left: 1rem;
		transition: box-shadow 0.2s ease-in;
		padding: 4px;
	}
	input:focus {
		box-shadow: 0 0 .5rem .2rem var(--main-color-med) !important;
	}
	button {
		transition: color 0.2s, background-color 0.2s;
	}
	label {
		margin-top: 4px;
	}
	#container {
		border-top: 2px solid var(--main-color-dark);
		border-left: 2px solid var(--main-color-dark);
		border-right: 2px solid var(--main-color-med);
		border-bottom: 2px solid var(--main-color-med);
		background-color: var(--main-color-light);
		border-radius: 1rem;
	}
	.row {
		padding: 1rem;
	}
	#submit-changes-message {
		margin-top: 1rem;
		border-radius: 6px;
		transition: opacity 0.5s;
		text-align: center;
		opacity: 0;
		background-color: white;
		color: black;
	}
</style>
@endsection


@section('content')
<div class="row">
	<div class="col-md-10 offset-md-1" id="container">

		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav">
					<a class="nav-item nav-link active" data-window="info" href="#">Gebruikersinformatie <span class="sr-only">(current)</span></a>
					<a class="nav-item nav-link" data-window="password" href="#">Verander Paswoord</a>
				</div>
			</div>
		</nav>

		<div class="row">
			<div class="col-md-4">Uw naam</div>
			<div class="col-md-8">
				<label for="name">Naam:</label><br>
				<input placeholder="John Doe" type="text" name="name" value="{{ $user->name }}" pattern="[ a-zA-Z]+" title="Adres: alleen letters en spaties"><br>
				<label for="email">Email:</label><br>
				<input placeholder="John Doe" type="text" name="email" value="{{ $user->email }}" disabled><br>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">Uw adres informatie</div>
			<div class="col-md-8">
				<label for="street">Adres:</label><br>
				<input placeholder="Hoofdstraat" type="text" name="street" value="{{ $user->street }}" pattern="[ a-zA-Z]+" title="Adres: alleen letters en spaties">  Huis Nr:<input placeholder="999" type="text" name="streetnr" class="col-lg-1" value="{{ $user->streetnr }}" pattern="[0-9]+" title="Adres Nr: alleen nummers"><br>
				<label for="city">Stad:</label><br>
				<input placeholder="Amsterdam" type="text" name="city" value="{{ $user->city }}" pattern="[ a-zA-Z]+" title="Adres: alleen letters en spaties"><br>
				<label for="province">Provincie:</label><br>
				<input placeholder="Noord Holland" type="text" name="province" value="{{ $user->province }}" pattern="[ a-zA-Z]+" title="Provincie: alleen letters en spaties"><br>
				<label for="country">Land:</label><br>
				<input placeholder="Nederland" type="text" name="country" value="{{ $user->country }}" pattern="[ a-zA-Z]+" title="Land: alleen letters en spaties"><br>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">Uw telefoon nrs</div>
			<div class="col-md-8">
				<label for="country">Telefoon nr 1:</label><br>
				<input placeholder="06-12345678" type="text" name="telephone1" value="{{ $user->telephone1 }}" pattern="[\-0-9]+" title="TelefoonNr: alleen nummers en -"><br>
				<label for="country">Telefoon nr 2:</label><br>
				<input placeholder="030-6543210" type="text" name="telephone2" value="{{ $user->telephone2 }}" pattern="[\-0-9]+" title="TelefoonNr: alleen nummers en -">
			</div>
		</div>
		<br>
		<button id="submit-changes-nonpw" type="button" class="btn btn-warning col-md-4 offset-md-4" style="">Profiel Opslaan</button>
		<p id="submit-changes-message">Gebruiker opgeslagen</p>

		<div class="row">
			<div class="col-md-4">Paswoord Veranderen</div>
			<div class="col-md-8">
				<input placeholder="paswoord" type="text" name="password" value="" pattern=".{8,128}" title="Paswoord: tussen 8 en 128 karakters">
				<input placeholder="paswoord opnieuw" type="text" name="password_confirmation" value="" pattern=".{8,128}" title="Paswoord: tussen 8 en 128 karakters">
			</div>
		</div>
		<br>
			
	</div>
</div>
@endsection


@section('footer')
<script>
jQuery(document).ready(function(){

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});

	$('#submit-changes-nonpw')[0].onclick = function(e){
		e.preventDefault();

		let url = "/user/"+{{ Auth::user()->id }};
		$.ajax({
			url: url, //atn hackers: this id is compared to the logged in user id serverside via the tokens
			method: 'patch',
			data: {
				name: 			$('input[name="name"]').val(),
				street: 		$('input[name="street"]').val(),
				streetnr: 	$('input[name="streetnr"]').val(),
				city: 			$('input[name="city"]').val(),
				province: 	$('input[name="province"]').val(),
				country: 		$('input[name="country"]').val(),
				telephone1: $('input[name="telephone1"]').val(),
				telephone2: $('input[name="telephone2"]').val()
			},
			success: function(result){
				console.log(result);
				$('#submit-changes-message')[0].style = "opacity: 1";
				setInterval(() => {
					$('#submit-changes-message')[0].style = "opacity: 0";
				}, 5e3);
			},
			error: function(jqxhr, status, exception) {
				console.log(jqxhr);
				console.log(exception);
				console.log(status);
			}
		});
	};
});
</script>
@endsection