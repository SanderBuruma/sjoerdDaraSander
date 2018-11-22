@extends('layouts.app')

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
			</thead>
			@foreach($users as $user)
			<tbody id="tbody">
				<td>{{ $user->id }}</td>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td>
					@foreach($user->roles as $role)
						<p>{{ $role->name }}</p>
					@endforeach
					<?php //echo dd($user->roles()) ?>
				</td>
				<td>{{ $user->created_at }}</td>
			</tbody>
			@endforeach
		</table>
	</div>
</div>
@endsection