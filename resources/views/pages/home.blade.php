@extends('layouts.app')

@section('title', '| Home')

@section('header')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@stop

@section('content')
<div class="form-row"><div class="col-md-6 offset-md-3 main">
	<div id="search-bar" class="justify-content-center"><h6>
		{{-- {!! Form::open(['route' => 'advertenties.search.index', 'method' => 'POST']) !!} --}}
		
			<input name="home_search_text" id="home-search-text" class ="search-bar" type="text" placeholder="Zoekterm">
		
	
			<select name="home_search_select" id="home-search-text" class="select-category">
				@foreach($categories as $category)
					<option value="{{$category->id}}">{{$category->name}}</option>
				@endforeach
			</select>
		
			<button id="home-search-button" class="btn btn-success">Zoek!</button>
		{{-- {!! Form::close() !!} --}}
	</h4></div>
</div></div>

{{-- <div class= " row "><div class="col-md-12 results"><div class="inside flex-row"> --}}

</div></div></div>

<div class="filler"></div>
@endsection

@section('footer')
<script>
jQuery(document).ready(function(){

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});

	$('#home-search-button')[0].onclick = searchQuery;
	$('#home-search-text')[0].onkeydown = function(e) {
		if (e.keyCode == 13){
			e.preventDefault();
			searchQuery();
		}
	};
});

function searchQuery(){
	jQuery.ajax({
		url: "/advertenties.search.index",
		method: 'post',
		data: {
			search_text: jQuery('#home-search-text').val(),
			search_select: jQuery('#home-search-select').val()
		},
		success: function(result){
			console.log(result);
			refreshResults(result);
		},
		error: function(jqxhr, status, exception) {
			console.log('Exception:', exception);
			console.log(status);
		}
	});
};

function refreshResults(searchResults){
	searchResultList = $('.inside')[0];
	insideStr = '';
	let count = 1;

	for (let i of searchResults){
		let createdAtSplit = i.created_at.split(/[\D]/);
		console.log(createdAtSplit);
		let date = 
			parseInt(createdAtSplit[2])+
			[ " Jan ", " Feb ", " Mar ", " Apr ", " Mei ", " Jun ", " Jul ", " Aug ", " Sep ", " Oct ", " Nov ", " Dec "][createdAtSplit[1]-1]+
			createdAtSplit[0]+" - "+
			createdAtSplit[3]+":"+createdAtSplit[4];

		insideStr += `
			<div class="advertentie"><a href="/advertentie/${i.slug}" target="_blank" rel="noopener noreferrer">
				<h6 class="title" style="font-size: 2rem;">${i.title.substr(1, 25)}</h6>
				<p class="price" style="font-size: 1.4rem;">€${i.price/100}</p>
				<p class="date">${date}</p>
				<p class="date">Stad: ${i.city}</p>
				<img src="/images/${i.photo1||"empty-box.jpeg"}" width= "380" height= "300">
				<p class="description">${i.description.substr(1, 100)}</p>
			</a></div>
		`;
	};

	searchResultList.innerHTML = insideStr;
};
</script>
@stop