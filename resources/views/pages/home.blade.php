@extends('layouts.app')

@section('title', '| Home')

@section('header')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@stop

@section('content')
<div class="row"><div class="col-md-10 offset-md-1 main">
	<div id="search-bar" class="justify-content-center"><h4>
		{!! Form::open(['route' => 'advertenties.search.index', 'method' => 'POST']) !!}
			<input name="home_search_text" id="home-search-text" type="text" placeholder="Zoekterm">
			<select name="home_search_select" id="home-search-select">
				@foreach($categories as $category)
					<option value="{{$category->id}}">{{$category->name}}</option>
				@endforeach
			</select>
		{!! Form::close() !!}
	</h4></div>
</div></div>

<div class="row"><div class="col-md-10 offset-md-1 results"><div class="inside">

</div></div></div>
@endsection

@section('footer')
<script>
jQuery(document).ready(function(){

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});

	$('.inside')[0].onkeydown = function(e){
		console.log('submit');
		if (e.keyCode == 13){
			console.log('keycode'+e.keyCode);
			e.preventDefault();


			jQuery.ajax({
				url: "/item",
				method: 'post',
				data: {
					wish: jQuery('#new-wish').val(),
					user_id: jQuery('#user-id').val()
				},
				success: function(result){
					console.log('ajax success');
					$('#new-wish')[0].value = '';
					console.log(result);
					refreshWishList();
				},
				error: function(jqxhr, status, exception) {
					console.log('Exception:', exception);
					console.log(status);
				}
			});
		};
	};
});
</script>
@stop