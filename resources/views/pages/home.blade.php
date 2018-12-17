@extends('layouts.app')

@section('title', '| Home')

@section('header')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@stop

@section('content')

<div class="container2 col-md-8 offset-md-2">
		
	<div class="input-group">

		<input type="text" class="form-control search-bar" aria-label="Text input with dropdown button"  placeholder="Zoeken in Nervamarkt..." id="home-search-text">
		{{-- <div class="search-icon"><i class="fas fa-search icon"></i></div> --}}

		<div class="input-group-append">
				
			<select id="home-search-select" class="category form-control">
				@foreach($categories as $category)
					<option value="{{$category->id}}">{{$category->name}}</option>
				@endforeach
			</select><div class="vertical-row"></div>
			</div>

			<select id="select-sort-by" class="form-control prijs-styling col-md-6">
				<option value="advertenties.price.asc">⬆ Prijs</option>
				<option value="advertenties.price.desc">⬇ Prijs</option>
				<option value="advertenties.distance.asc">⬆ Afstand</option>
				<option value="advertenties.distance.desc">⬇ Afstand</option>
				<option value="advertenties.created_at.asc">⬆ Datum</option>
				<option value="advertenties.created_at.desc">⬇ Datum</option>
			</select>
			

			<select id="home-search-distance" class="category form-control">
				{{-- @foreach([0.5,1,1.5,2,3, >3] as $distance)
					<option value="{{$distance}}">Max {{$distance}} km</option>
				@endforeach --}}
				<option value="0">Alle</option>
				<option value="1">Max 1 km</option>
				<option value="2">Max 2 km</option>
				<option value="3">Max 3 km</option>
				<option value=">3">Meer dan 3km</option>
			</select>
		
		<button class="btn btn-outline-secondary search-button" type="button" id="home-search-button">Zoek!</button>
	</div>
		
		
</div>


<div class= "row"><div class="col-md-10 offset-md-1 results">
	<div class="inside flex-row">
		{{-- this div will get replaced --}}
		<div class="advertentie" title="${i.description}"><a href="/advertentie/${i.slug}" target="_blank" rel="noopener noreferrer">
			<table class="table">
				<tbody>
					<tr>
						<td><div class="image-div"><img src="/images/${i.photo1||"empty-box.jpeg"}"></div></td>
						<td><h6 class="title">${i.title.substr(0, 25)}</h6><p class="price" style="font-size: 1.4rem;">€${i.price/100}</p><p class="visit-adv" style="font-size: 1.4rem;">Details</p></td>
					</tr>
				</tbody>
			</table>
		</a></div>
	</div>
	<div class="paginate-bar">
		<a id="paginate-left" href="#">◀</a><input type="text" id="paginate-number"><a id="paginate-right" href="#">▶</a>
	</div>
</div></div>


<div id="main2">
	<div id="map"></div>
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
	$('#paginate-right')[0].onclick = function(){
		let pagNr = $('#paginate-number');
		pagNr.val(parseInt(pagNr.val())+1);
		searchQuery();
	}
	$('#home-search-text')[0].onkeydown = function(e) {
		if (e.keyCode == 13){
			let pagNr = $('#paginate-number');
			e.preventDefault();
			searchQuery();
		}
	};
	// $('#filter-user')[0].onkeydown = function(e) {
	// 	if (e.keyCode == 13){
	// 		let pagNr = $('#paginate-number');
	// 		e.preventDefault();
	// 		searchQuery();
	// 	}
	// };
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
			user_lat: userLat||6.566,
			user_lng: userLng||53.212, 
			search_sort_by: jQuery('#select-sort-by').val(),
			// search_filter_user: jQuery('#filter-user').val(),
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

		let title = i.title.substr(0,25)
		if (title.length>25) {title+="...";}
		let description = i.description.substr(0,100)
		if (description.length>100) {description+="...";}

		insideStr += `
			<div class="advertentie" title="${i.description}"><a href="/advertentie/${i.slug}" target="_blank" rel="noopener noreferrer">
				<table class="table">
					<tbody>
						<tr>
							<td><div class="image-div"><img src="/images/${i.photo1||"empty-box.jpeg"}"></div></td>
							<td class="advertemtie-info"><h6 class="title">${title}</h6><p class="price-button"><span class="price" style="font-size: 1.4rem;">€${i.price/100}</span><span class="visit-adv" style="font-size: 1.4rem;">Details</span></p></td>
						</tr>
					</tbody>
				</table>
			</a></div>
		`

		mapMarkersRefresh(searchResults);
	};

	searchResultList.innerHTML = insideStr;
};


function initMap() {
  var myLatLng = {lat: userLat||53.2152292, lng: userLng||6.5669632};

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: myLatLng
  })
}

function mapMarkersRefresh(advertenties) {
	let myLatLng = {lat: userLat||53.2152292, lng: userLng||6.5669632};
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 10,
		center: myLatLng
	});

	var markers = [];
	let infoWindow = []; let count = 0;
	for (let i of advertenties) {

		count++;
		infoWindow[count] = new google.maps.InfoWindow({
			content: 
			`<div class="infoWindow">`+
			`<h6 class="infoWindowHeader"><a href="/advertentie/${i.slug}">${i.title}</a></h6>`+
			`<div class="infoWindowBody">`+
			`<h2>€${i.price/100},-</h2>`+
			`<p>${i.description}</p>`+
			`<p><a href="/advertentie/${i.slug}">`+
			`${i.title}</a><br>`+
			`${i.created_at}).</p>`+
			`<img src="/images/${i.photo1||"empty-box.jpeg"}" width="100%">`+
			`</div>`+
			`</div>`,
		});
		
		var marker = new google.maps.Marker({
			position: {lat: parseFloat(i.latitude), lng: parseFloat(i.longitude)},
			map: map,
			title: i.title,
		});
		function clickFactory (count) {
			return function () {
				console.log(count);
				infoWindow[count].open(map, markers[count-1]);
			}
		}
		marker.addListener('click', clickFactory(count));
		markers.push(marker);
		
	}
}


  
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfM9rq072pO3kYg5hTX_69uA-6LeVKhF8&libraries=places&callback=initMap" async defer></script>

@stop