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
					<th>Sent</th>
					<th>Title</th>
					<th>Sender</th>
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
				{{ Form::label('user_id', 'User:*') }}
				{{ Form::label('user_id', 'User:*') }}
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

@stop