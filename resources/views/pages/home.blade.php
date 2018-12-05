@extends('layouts.app')

@section('title', '| Home')

@section('content')


<div class="row">
			<div class="card-header">
				Nervamarkt
			</div>
			<div class="card-body">
				<p>Welkom op Nervamarkt waarop u spullen kunt ruilen, verkopen of gratis weggeven.  </p>
				
			</div>
	<div class="container_1 col-md-4 offset-md-4">
		<div class="container_2">
			<button type="button" class="btn btn-success btn-lg btn-block">Plaats uw advertentie</button>
			<a class="btn btn-success low-buttons" href="#" role="button">Reageer</a>
			<button class="btn btn-success low-buttons" type="submit">Wijzig</button>
			<input class="btn btn-success low-buttons" type="button" value="Verwijderen">
		</div>
	</div>

</div>



@endsection
