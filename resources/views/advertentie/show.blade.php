@extends('layouts.app')

@section('title', "| $advertentie->title")


@section('header')
<link rel="stylesheet" href="{{ asset('css/showadvertentie.css') }}">
@stop


@section('content')
<div class="row"><div class="row-md-5 offset-md-1 main"><div class="card">
	<div class="card-header">
		<h1>{{$advertentie->title}}</h1>
		<table class="table">
			<thead>
				<th>Categorie: </th>
				<th>{{$category->name}}</th>
			</thead>
			<tbody>
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
	</div>
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
								<img class=\"d-block w-100\" src=\"/".$advertentie["photo$v"]."\" alt=\"database image\">
							</div>";
						} else {
						echo "
							<div class=\"carousel-item\">
								<img class=\"d-block w-100\" src=\"/".$advertentie["photo$v"]."\" alt=\"database image\">
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
</div></div></div>
@stop


@section('footer')

@stop