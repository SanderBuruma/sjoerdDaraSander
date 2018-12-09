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
@endsection

@section('footer')
<script>

</script>
@stop