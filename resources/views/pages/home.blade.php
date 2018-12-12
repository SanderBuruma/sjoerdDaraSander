@extends('layouts.app')

@section('title', '| Home')

@section('header')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@stop

@section('content')

	<div class="container2 col-md-8 offset-md-2">
		<div class="input-group">
			<input type="text" class="form-control search-bar" aria-label="Text input with dropdown button"  placeholder="Zoeken in Nervamarkt..." id="home-search-text">
				<div class="input-group-append">
					
				<select id="home-search-select" class="category">
						@foreach($categories as $category)
							<option value="{{$category->id}}">{{$category->name}}</option>
						@endforeach
				</select><div class="vertical-row"></div>
				</div>
				<select id="home-search-distance" class="category">
					<option value="0">Geen Max km</option>
					@foreach([0.1,0.2,0.5,1,1.5,2,3,5,10,15,20,30,50] as $distance)
						<option value="{{$distance}}">Max {{$distance}} km</option>
					@endforeach
				</select>
			<button class="btn btn-outline-secondary search-button" type="button" id="home-search-button">Zoek!</button>
		</div>
	</div>
	

<div class="paginate-bar">
	<a id="paginate-left" href="#"><</a><input type="text" id="paginate-number" width="24" value="1"><a id="paginate-right" href="#" style="margin-left: auto;">></a>
</div>
<div class="inside flex-row">
	
</div>
<div class="paginate-bar">
	<a id="paginate-left-bot" href="#"><</a><a id="paginate-right-bot" href="#" style="margin-left: auto;">></a>
</div>
@endsection

@section('footer')
<script>
let resultLength, userLocation, userLat, userLng;

function getLocation() {
		if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
	} else { 
		x.innerHTML = "Geolocation is not supported by this browser.";
	}
}

function showPosition(position) {
	console.log('getlocation');
	userLat = position.coords.latitude;
	userLng = position.coords.longitude;
}

jQuery(document).ready(function(){

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});

	getLocation();

	$('#home-search-button')[0].onclick = function(){

		let pagNr = $('#paginate-number');
		pagNr.val(1);
		searchQuery();
	}
	$('#paginate-left')[0].onclick = function(){
		let pagNr = $('#paginate-number');
		pagNr.val((parseInt(pagNr.val())-1)||1);
		searchQuery();
	}
	$('#paginate-left-bot')[0].onclick = function(){
		let pagNr = $('#paginate-number');
		pagNr.val((parseInt(pagNr.val())-1)||1);
		searchQuery();
	}
	$('#paginate-right')[0].onclick = function(){
		let pagNr = $('#paginate-number');
		pagNr.val(parseInt(pagNr.val())+1);
		searchQuery();
	}
	$('#paginate-right-bot')[0].onclick = function(){
		let pagNr = $('#paginate-number');
		pagNr.val(parseInt(pagNr.val())+1);
		searchQuery();
	}
	$('#home-search-text')[0].onkeydown = function(e) {
		if (e.keyCode == 13){
			let pagNr = $('#paginate-number');
			pagNr.val(1);
			e.preventDefault();
			searchQuery();
		}
	};
	$('#paginate-number')[0].onkeydown = function(e) {
		if (e.keyCode == 13){
			e.preventDefault();
			searchQuery();
		}
	};
	searchQuery();
});

function searchQuery(){
	if (resultLength < 2){
		let pagNr = $('#paginate-number');
		pagNr.val(1);
	}
	jQuery.ajax({
		url: "/advertenties.search.index",
		method: 'post',
		data: {
			search_text: jQuery('#home-search-text').val(),
			search_select: jQuery('#home-search-select').val(),
			search_paginate_nr: jQuery('#paginate-number').val(),
			search_distance: jQuery('#home-search-distance').val()||0,
			user_lat: userLat||null,
			user_lng: userLng||null, 
		},
		success: function(result){
			console.log(result);
			resultLength = result.length;
			if (!resultLength) {
				let pagNr = $('#paginate-number');
				pagNr.val(1);
			}
			refreshResults(result);
		},
		error: function(jqxhr, status, exception) {
			console.log(jqxhr);
			console.log('Exception:', exception);
			console.log(status);
		}
	});
};

function getLocation() {
		if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
	} else { 
		x.innerHTML = "Geolocation is not supported by this browser.";
	}
}

function showPosition(position) {
	userLocation = position.coords;
	console.log(userLocation);
}

function refreshResults(searchResults){
	searchResultList = $('.inside')[0];
	insideStr = '';
	let count = 1;

	for (let i of searchResults){
		let createdAtSplit = i.created_at.split(/[\D]/);
		let date = 
			parseInt(createdAtSplit[2])+
			[" Jan ", " Feb ", " Mar ", " Apr ", " Mei ", " Jun ", " Jul ", " Aug ", " Sep ", " Oct ", " Nov ", " Dec "][createdAtSplit[1]-1]+
			createdAtSplit[0]+" - "+
			createdAtSplit[3]+":"+createdAtSplit[4];

		insideStr += `
			<div class="advertentie" title="${i.description}"><a href="/advertentie/${i.slug}" target="_blank" rel="noopener noreferrer">
				<h6 class="title" style="font-size: 2rem;">${i.title.substr(1, 25)}...</h6>
				<p class="price" style="font-size: 1.4rem;">€${i.price/100}</p>
				<p class="date">${date}<br>
					Stad: ${i.city}<br>`;
		
		if (i.distance != null) {insideStr += `
					${i.distance.toFixed(2)} km afstand</p>`};
		insideStr += `
				<img src="/images/${i.photo1||"empty-box.jpeg"}" width= "380" height= "300">
				<p class="description">${i.description.substr(1, 100)}...</p>
			</a></div>
		`;
	};

	searchResultList.innerHTML = insideStr;
};
</script>
@stop