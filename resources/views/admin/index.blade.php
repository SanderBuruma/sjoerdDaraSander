@extends('layouts.app')

@section('title', '| Admin User Index')

@section('header')
<style>
button {
	all: unset;
	color: var(--main-color-dark);
	cursor: pointer;
	background-color: var(--main-color-light);
	border-radius: 3rem;
	padding: 0 4px;
	cursor: pointer;
	transition: color 0.2s, background-color 0.2s;
}
button:hover,
button:active {
	background-color: var(--main-color-dark);
	color: var(--main-color-light);
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
						<button type="button" class="modal-button" data-toggle="modal" data-target="#adminModalCenter" data-user-id="{{$user->id}}" onclick=clickEdit(<?php echo $user->id ?>)>
							<i class="fas fa-pencil-alt"></i>
						</button>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<!-- Modal Body -->
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
				{{ Form::text('name', null, ["class"=>'form-control form-control-lg', 'id'=>'modal-name']) }}
				<hr>
				<select name="roles[]" id="select-roles" multiple="multiple" style="width: 100%;">
					@foreach($roles as $role)
						<option value="{{ $role->id }}">{{ $role->name }}</option>
					@endforeach
				</select>
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
<script type="text/javascript">
let userId = <?php echo Auth::user()->id ?>;
let roles = <?php echo json_encode($roles) ?>;
let users = <?php echo json_encode($users) ?>;

$(document).ready(function(){
	$('#select-roles').select2();
});

function clickEdit (e) {
	for (let i of users){
		if (i.id == e){
			let arr = [];
			for (let j of i.roles){
				arr.push(j.id);
			}
			console.log(arr);
			$('#select-roles').val(arr).trigger('change');
			$('#adminModalCenterTitle')[0].innerHTML = i.name;
			break;
		}
	}
}

/*
code snippets for later use

	get list of currently selected items
	$('#select-roles').select2('data'); 

	update list of currently selected items
	$('#select-roles').val([3,2]).trigger('change');
*/
</script>
@endsection