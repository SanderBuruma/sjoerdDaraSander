@extends('layouts.app')

@section('title', "| $advertentie->title")


@section('header')
<link rel="stylesheet" href="{{ asset('css/showadvertentie.css') }}">
@stop


@section('content')
<div class="row"><div class="row-md-10 offset-md-1 main"><div class="card">
	<div class="card-header">
		<h1>{{$advertentie->title}}</h1>
	</div>
	<div class="card-body">
		<p>{{$advertentie->description}}</p>
	</div>
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="d-block w-100" src="/images/154400762373073291962.png" alt="First slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="/images/154400762373073291962.png" alt="Second slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="/images/154400762373073291962.png" alt="Third slide">
			</div>
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