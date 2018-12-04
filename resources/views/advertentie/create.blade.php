@extends('layouts.app')

@section('title', '| Nieuwe Advertentie')


@section('header')
<link rel="stylesheet" href="{{ asset('css/advertentie.css') }}">
@stop


@section('content')
<div class="row">
	<div class="col-md-8 offset-md-2 main">
		<div class="card">
			<div class="card-header">
				<h4>Plaats Uw Advertentie</h4>
			</div>
			<div class="card-body">
				{!! Form::open(['route' => 'advertentie.store','data-parsley-validate' => '', 'method' => 'POST']) !!}
					{{ Form::label('title', 'Titel:*') }}
					{{ Form::text('title', null, array('class' => 'form-control','required'=> '','maxlength'=>'255')) }}
					<br>
					{{ Form::label('description', 'Beschrijving:*') }}
					{{ Form::textarea('description', null, array('class' => 'form-control','required'=> '','maxlength'=>'4096')) }}
					<br>
					<select name="category" id="category">
						@foreach($categorys as $category)
							<option value="{{$category->id}}">{{$category->name}}</option>
						@endforeach
					</select>
					{{ Form::submit('Create Product', array('class' => 'btn btn-success btn-lg btn-block', 'style'=>'margin-top: 20px;')) }}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@stop


@section('footer')
{!! Html::script('js/parsley.min.js') !!}
<script>
$(document).ready(function(){
	$('#category').select2();
});
</script>
@stop