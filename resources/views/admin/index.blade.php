@extends('layouts.app')

@section('title', '| Admin User Index')

@section('header')
<style>
button {
	all: unset;
	color: var(--main-color-dark);
	cursor: pointer;
}
.fas {
	background-color: var(--main-color-light);
	border-radius: 3rem;
	padding: 4px;
	cursor: pointer;
}
</style>
@endsection

@section('content')
<div class="row">
	<div class="col-md-10 offset-md-1">
		<table class="table">
			<thead>
				<th>#</th>
				<th>Name</th>
				<th>Email</th>
				<th>Roles</th>
				<th>Created</th>
				<th></th>
			</thead>
			<tbody id="tbody">
				@foreach($users as $user)
				<tr>
					<td>{{ $user->id }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>
						<p class="tooltip-1">
							@foreach($user->roles as $role)
								<span class="role-list-item">{{ $role->name }}</span>
							@endforeach
						</p>
						<?php //echo dd($user->roles()) ?>
					</td>
					<td>{{ $user->created_at }}</td>
					<td>
						<button type="button" class="modal-button" data-toggle="modal" data-target="#adminModalCenter" data-user-id="{{$user->id}}">
							<i class="fas fa-pencil-alt"></i>
						</button>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="adminModalCenter" tabindex="-1" role="dialog" aria-labelledby="adminModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="adminModalCenterTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{{-- {!! Form::model($user, ['route' => ['admin.update', 3], 'method' => 'PATCH']) !!} --}}
				{{ Form::text('name', null, ["class"=>'form-control form-control-lg']) }}
				<hr>
				@foreach($roles as $role)
				<input class="form-check-input form-control" type="checkbox" checked="false" value="{{$role->id}}" id="defaultCheck1"><p>{{ $role->name }}</p>
				@endforeach
				{{-- {!! Form::close() !!} --}}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
				<button type="button" class="btn btn-primary">Save</button>
			</div>
		</div>
	</div>
</div>
@endsection

@section('footer')
<script>
let userId = null;



</script>
@endsection