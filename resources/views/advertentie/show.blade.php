@extends('layouts.app')

@section('title', "| $advertentie->title")


@section('header')
<link rel="stylesheet" href="{{ asset('css/advertentieshow.css') }}">
@stop


@section('content')
<div class="row">
	<div class="col-md-6 offset-md-2 main"><div class="card">
	<div class="card-header">
		<h1>{{$advertentie->title}}</h1>
		@guest @else @if($user->hasRole($user,"3"))
		<p style="text-align: center; color: red;">Admin - Delete Advertentie: <button type="button" onclick=deleteAdvertentie()><i class="fas fa-trash-alt" style="color:red;"></i></button></p>
		@endif @endguest
		<table class="table">
			<tbody>
				<tr>
					<td>Categorie: </td>
					<td>{{$category->name}}</td>
				</tr>
				<tr>
					<td>Subcategorie: </td>
					<td>{{$subcategory->name}}</td>
				</tr>
				<tr>
					<td>Prijs: </td>
					<td>€{{$advertentie->price/100}},-</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="card-body">
		<p>{{$advertentie->description}}</p>
		<div class="row"><div class="col-md-6 offset-md-3">
			
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<?php 
							$count = 0;
							foreach ([1,2,3,4,5,6] as $v)	{
								if (isset($advertentie["photo$v"])) {
									if ($count == 0) {
										echo "<li data-target=\"#carouselExampleIndicators\" data-slide-to=\"$count\" class=\"active\"></li>";
									} else {
										echo "<li data-target=\"#carouselExampleIndicators\" data-slide-to=\"$count\"></li>";
									}
									$count++;
								}
							}
							?>
						</ol>
						<div class="carousel-inner">
							<?php 
								$count = 0;
								foreach([1,2,3,4,5,6] as $v) {
									if (isset($advertentie["photo$v"])) {
										if ($count == 0) {
											echo "
											<div class=\"carousel-item active\">
												<img class=\"d-block w-100\" src=\"/images/".$advertentie["photo$v"]."\" alt=\"database image\">
											</div>";
										} else {
											echo "
											<div class=\"carousel-item\">
												<img class=\"d-block w-100\" src=\"/images/".$advertentie["photo$v"]."\" alt=\"database image\">
											</div>";
										}
										$count++;
									}
								}
							?>
						</div>
						<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>		
			
			</div></div>
		</div>
		
		{{-- contact informatie --}}
	</div></div>
	<div class="col-md-3 secondary"><div class="card">
		<div class="card-header">{{$advertentie->user->name}}</div>
		<div class="card-body">
			@if($advertentie->user->city) <p><i class="fas fa-map-marker-alt"></i> {{$advertentie->user->city}}</p> @endif
			<div class="contact">
				@if($advertentie->user->websiteUrl) <p><i class="fas fa-globe"></i> <a href="http://{{$advertentie->user->websiteUrl}}">{{$advertentie->user->websiteUrl}}</a></p> @endif
				<br>
				{!! Form::open(['route' => 'message.namedcreate','data-parsley-validate' => '', 'method' => 'POST']) !!}
					<i class="fas fa-envelope-open"></i>
					<input type="text" class="form-control" required hidden value="{{$advertentie->user->name}}" name="name">
					<input type="text" class="form-control" required hidden value="{{$advertentie->slug}}" name="advertentie_slug">
					{{ Form::submit('Zend Bericht', array('class' => 'btn btn-info btn-sm')) }}
				{!! Form::close() !!}
				<br>
				@if($advertentie->user->telephone1) <p><i class="fas fa-phone"></i> {{$advertentie->user->telephone1}}</p> @endif
				@if($advertentie->user->telephone2) <p><i class="fas fa-phone"></i> {{$advertentie->user->telephone2}}</p> @endif
			</div>
		</div>
	</div></div>
</div>
@stop


@section('footer')
@guest @else @if($user->hasRole($user,"3"))
<script>

jQuery(document).ready(function(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
})
let slug = "{{$advertentie->slug}}";
function deleteAdvertentie() {
	$.ajax({
		url: `/advertentie/${slug}`,
		method: 'DELETE',
		success: function(result){
			window.location.replace(`/home`);
		},
	})
}

</script>
@endif @endguest 
@stop