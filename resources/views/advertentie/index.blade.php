@extends('layouts.app')

@section('title', '| Mijn Advertenties')

@section('header')
<link rel="stylesheet" href="{{ asset('css/useradvertenties.css') }}">
@endsection

@section('content')
<div class="row"><div class="col-md-8 offset-md-2 main">
	<div class="paginate-bar">
		<a id="paginate-left" href="#">◀</a><input type="text" id="paginate-number" value="1"><a id="paginate-right" href="#">▶</a>
	</div>
	<div class="card" id="main">
		<table class="table">
			<thead>
				<th>Geplaatst</th>
				<th>Titel</th>
				<th>Prijs</th>
				<th></th>
			</thead>
			<tbody id="tBody">
				<!-- js here inserts advertenties -->
			</tbody>
		</table>
	</div>
</div>

<!-- Modal Body -->
<div class="modal fade" id="advertentieModalCenter" tabindex="-1" role="dialog" aria-labelledby="advertentieModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="advertentieModalCenterTitle">Edit Advertentie</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{{ Form::text('name', null, ["class"=>'form-control form-control-lg', 'id'=>'modal-name']) }}
				<hr>
				<select name="roles[]" id="select-roles" multiple="multiple" style="width: 100%;">
				</select>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
				<button type="button" class="btn btn-dark" data-dismiss="modal" id="save-advertentie">Save</button>
			</div>
		</div>
	</div>
</div>
@endsection

@section('footer')
<script>
$(document).ready(function(){
	
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
	
	$('#paginate-left')[0].onclick = function(){
		let pagNr = $('#paginate-number');
		pagNr.val((parseInt(pagNr.val())-1)||1);
		refreshIndex();
	}
	$('#paginate-right')[0].onclick = function(){
		let pagNr = $('#paginate-number');
		pagNr.val(parseInt(pagNr.val())+1);
		refreshIndex();
	}
	$('#paginate-number')[0].onkeydown = function(e) {
		if (e.keyCode == 13){
			e.preventDefault();
			refreshIndex();
		}
	};

	refreshIndex();
});

function clickDelete (e) {
	for (let i of advertenties){
		if (i.id == e){
			console.log(i);
			let arr = [];
			for (let j of i.roles){
				arr.push(j.id);
			}
			console.log(arr);
			editadvertentieId = i.id;
			$('#select-roles').val(arr).trigger('change');
			$('#modal-name')[0].value = i.name;
			return;
		}
	}
}

function refreshIndex () {
	$.ajax({
		url: '/advertentieAjax',
		method: 'POST',
		data: {
			paginate: $('#paginate-number').val(),
		},
		success: function(result){

			advertenties = result;

			let tBodyString = ``;

			for (let advertentie of result){
				tBodyString += `
					<tr title="${advertentie.description}">
					<td>${advertentie.created_at}</td>
						<td><a href="/advertentie/${advertentie.slug}">${advertentie.title.substr(0,25)}</a></td>
						<td>€${advertentie.price/1e2},-</td>
						<td>
							<button type="button" class="modal-button" data-toggle="modal" data-target="#advertentieModalCenter" data-advertentie-slug="${advertentie.slug}" onclick=clickDelete(${advertentie.slug})>
								<i class="fas fa-trash-alt" style="color:red;"></i>
							</button>
						</td>
					</tr>
				`;
			}
			$('#tBody').html(tBodyString);

		},
	})
}
</script>
@endsection