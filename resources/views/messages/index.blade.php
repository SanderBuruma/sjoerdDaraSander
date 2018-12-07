@extends('layouts.app')

@section('title', '| Berichten 📨')


@section('header')
<link rel="stylesheet" href="{{ asset('css/messages.css') }}">
@stop


@section('content')
<div class="row">
	<div class="col-md-8 offset-md-2">
		<div class="card">
			<div class="card-header"><h3>📨 Inbox</h3></div>
			<table class="table">
				<thead>
					<th>Titel</th>
					<th>Zender</th>
					<th>{{--edit, delete & view buttons--}}</th>
				</thead>
				<tbody>
					{{-- jquery/ajax puts messages here --}}
				</tbody>
			</table> 
		</div>
	</div>
</div>

<!-- Message Show Modal -->
<div class="modal fade" id="messageShowModal" tabindex="-1" role="dialog" aria-labelledby="messageShowModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="messageShowModalLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{{-- javascript fills this in --}}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Terug</button>
				<button type="button" class="btn btn-primary" id="react">Reageer</button>
			</div>
		</div>
	</div>
</div>

<!-- Message Delete Modal -->
<div class="modal fade" id="messageDeleteModal" tabindex="-1" role="dialog" aria-labelledby="messageDeleteModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="messageDeleteModalLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{{-- javascript fills this in --}}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Terug</button>
				<button type="button" class="btn btn-primary" id="react">Delete</button>
			</div>
		</div>
	</div>
</div>

@stop


@section('footer')
<script>

let messagesArray;

jQuery(document).ready(function(){

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});

	// $('#new-wish')[0].onkeydown = function(e){
	// 	console.log('submit');
	// 	if (e.keyCode == 13){

	// 		console.log('keycode'+e.keyCode);
	// 		e.preventDefault();

	// 		jQuery.ajax({
	// 			url: "/item",
	// 			method: 'post',
				
	// 			data: {
	// 				wish: jQuery('#new-wish').val(),
	// 				user_id: jQuery('#user-id').val()
	// 			},

	// 			success: function(result){
	// 				console.log('ajax success');
	// 				$('#new-wish')[0].value = '';
	// 				console.log(result);
	// 				refreshMessageList();
	// 			},

	// 			error: function(jqxhr, status, exception) {
	// 				console.log('Exception:', exception);
	// 				console.log(status);
	// 			}
	// 		});

	// 	};
	// };

});
	

refreshMessageList();

function refreshMessageList(){
	jQuery.ajax({

		url: "/messageajax",
		method: 'get',
		success: function(result){
			//what to do on success
			messagesArray = result;
			wishTable = $('tbody')[0];
			let count = 1, tBodyString = '';
			for (let i of result){
				tBodyString += `
					<tr>
						<td><button type="button" class="modal-button" data-toggle="modal" data-target="#messageShowModal" data-user-id="${i.id}" onclick=clickTitle(${i.id})>${i.title}</td>
						<td>${i.sender_name}</td>
						<td><button type="button" class="modal-button" data-toggle="modal" data-target="#messageShowModal" data-user-id="${i.id}" onclick=clickTitle(${i.id})></td>
					</tr>
				`;
			};
			$('tbody').html(tBodyString);
			
			
		},
		error: function(jqxhr, status, exception) {
			console.log('Exception:', exception);
			console.log(status);
			console.log(jqxhr);
		}

	});
};

function clickTitle(e) {
	for (let i of messagesArray) {
		if (e == i.id) {
			$('#messageShowModalLabel').html(i.title);
			$('.modal-body').html(`
				<h3>Zender: ${i.sender_name}</h3>
				<p>${i.message}</p>
			`);
			$('#react')[0].dataset.messageId = i.id;
			function tempFunc (message_id) {
				return function (e){
					console.log(e);
					window.location.replace(`/message/create?id=${message_id}`);
				}
			}
			$('#react')[0].addEventListener('click', tempFunc(i.id));
			return;
		}
	}
}

function react(e) {
	console.log(e);
}

// function deleteMessage (e){
// 	self = document.getElementById(e);
// 	console.log("/item/"+self.dataset.wishId)
// 	jQuery.ajax({
// 		url: "/item/"+self.dataset.wishId,
// 		method: 'delete',
// 		data: {id: self.dataset.wishId},
// 		success: function(msg){
// 			//what to do on success
// 			refreshMessageList();
// 			console.log(msg);
// 		},
// 		error: function(jqxhr, status, exception) {
// 			console.log('Exception:', exception);
// 			console.log(status);
// 			console.log(jqxhr);
// 		}
// 	});
// }
</script>
@stop