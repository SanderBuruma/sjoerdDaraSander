@extends('layouts.app')

@section('title', '| Berichten')


@section('header')
<link rel="stylesheet" href="{{ asset('css/messages.css') }}">
@stop


@section('content')
<div class="row">
	<div class="col-md-8 offset-md-2">
		<div class="card">
			<div class="card-header"><h3><i class="far fa-envelope"></i> Inbox</h3></div>
			<table class="table">
				<thead>
					<th>Title</th>
					<th>Sender</th>
					<th>{{--edit,delete,view buttons--}}</th>
				</thead>
				<tbody>
					{{-- jquery/ajax puts messages here --}}
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#berichtModal">Bericht</button> --}}

<!-- Modal -->
<div class="modal fade" id="berichtModal" tabindex="-1" role="dialog" aria-labelledby="berichtModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="berichtModalLabel">Zend Bericht</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{{--  --}}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleer</button>
				<button type="button" class="btn btn-primary">Zend</button>
			</div>
		</div>
	</div>
</div>
@stop


@section('footer')
<script>
jQuery(document).ready(function(){

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});
	
		$('#new-wish')[0].onkeydown = function(e){
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
	

refreshWishList();

function refreshWishList(){
	jQuery.ajax({
		url: "/messageajax",
		method: 'get',
		success: function(result){
			//what to do on success
			console.log(result);
			wishTable = $('tbody')[0];
			wishTable.innerHTML = '';
			let count = 1;
			for (let i of result){
				wishTable.innerHTML += `<tr>
						<td>${i.title}</td>
						<td>${i.sender_name}</td>
						<td></td>
					</tr>`;
			};
			document.getElementById('wish-input-count').innerHTML = `${count++} -`

		},
		error: function(jqxhr, status, exception) {
			console.log('Exception:', exception);
			console.log(status);
			console.log(jqxhr);
		}
	});
};

function deleteWish (e){
	self = document.getElementById(e);
	console.log("/item/"+self.dataset.wishId)
	jQuery.ajax({
		url: "/item/"+self.dataset.wishId,
		method: 'delete',
		data: {id: self.dataset.wishId},
		success: function(msg){
			//what to do on success
			refreshWishList();
			console.log(msg);
		},
		error: function(jqxhr, status, exception) {
			console.log('Exception:', exception);
			console.log(status);
			console.log(jqxhr);
		}
	});
}
</script>
@stop