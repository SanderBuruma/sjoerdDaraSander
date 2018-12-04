@extends('layouts.app')

@section('title', '| Nieuwe Advertentie')


@section('header')
<link rel="stylesheet" href="{{ asset('css/advertentie.css') }}">
@stop


@section('content')
<div class="row"><div class="col-md-8 offset-md-2 main"><div class="card">
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
			<select name="category" id="category" value="1">
				@foreach($categories as $category)
					<option value="{{$category->id}}">{{$category->name}}</option>
				@endforeach
			</select>
			<select name="subcategory" id="subcategory" hidden value="1">
				{{-- javascript fills this in --}}
			</select>
			<br>
			{{ Form::label('price', 'Prijs in Euro:') }}
			{{ Form::number('price', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '6'])}}
			<br>
			{{ Form::submit('Plaats!', array('class' => 'btn btn-success btn-lg btn-block', 'style'=>'margin-top: 20px;')) }}
		{!! Form::close() !!}
	</div>
</div></div></div>
@stop


@section('footer')
{!! Html::script('js/parsley.min.js') !!}
<script>

$(document).ready(function(){

	$('#category').select2();

	let subcategories = <?php echo json_encode($subcategories)?>;
	var subCData = $.map(subcategories, function (obj) {
		obj.text = obj.text || obj.name; // replace name with the property used for the text
		return obj;
	});

	$('#subcategory').select2({
		placeholder: `selecteer categorie`,
	});
	subcatSelect = $('#subcategory');
	$('#category')[0].onchange = function(){
		let newData = [];
		for (let i of subCData) {
			if (i.category_id == $('#category').val()){
				newData.push(i);
			}
		}
		$('#subcategory').select2('destroy');
		$('#subcategory')[0].innerHTML = '';
		$('#subcategory')[0].hidden = false;
		$('#subcategory').select2({
			data: newData,
		});
		$('#subcategory').val(newData[0].id).trigger('change');
	}

});
</script>
@stop