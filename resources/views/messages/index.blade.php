@extends('layouts.app')

@section('title', '| 📨 Berichten 📨')


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
					<th>Ontvangen</th>
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
				<button type="button" class="btn btn-primary" id="react" onclick=clickTitleReact()>Reageer</button>
			</div>
		</div>
	</div>
</div>

<!-- Message Delete Modal -->
<div class="modal modal2 fade" id="messageDeleteModal" tabindex="-1" role="dialog" aria-labelledby="messageDeleteModalLabel" aria-hidden="true">
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
				<button type="button" class="btn btn-info" data-dismiss="modal">Terug</button>
				<button type="button" class="btn btn-danger" id="reactDelete" data-dismiss="modal" onclick=clickDelete()>Delete</button>
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
});
	
//refresh message list
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
						<td>${i.created_at}</td>
						<td><button type="button" class="modal-button" data-toggle="modal" data-target="#messageShowModal" onclick=clickTitle(${i.id})>${i.title}</button></td>
						<td>${i.sender_name}</td>
						<td><button type="button" class="modal-button" data-toggle="modal" data-target="#messageDeleteModal" onclick=clickTrash(${i.id})><i class="fas fa-trash-alt" style="color:red;"></i></button></td>
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

//message show functions
function clickTitle(e){

	for (let i of messagesArray) {
		if (e == i.id) {
			$('#messageShowModalLabel').html(i.title);
			$('.modal-body').html(`
				<h3>Zender: ${i.sender_name}</h3>
				<p>${i.message}</p>
			`);
			$('#react')[0].dataset.messageId = i.id;
		}
	}

	$('#react')[0].dataset.id = e;

}

function clickTitleReact() {
	window.location.replace(`/message/create?id=${$('#react')[0].dataset.id}`);
}

// delete functions
function clickTrash(e){
	console.log(e);
	$('#reactDelete')[0].dataset.id = e;
}

function clickDelete() {
	deleteId = $('#reactDelete')[0].dataset.id;
	jQuery.ajax({
		url: "/message/"+deleteId,
		method: 'delete',
		data: {id: deleteId},
		success: function(msg){
			//what to do on success
			refreshMessageList();
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