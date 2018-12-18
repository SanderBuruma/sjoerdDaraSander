@extends('layouts.app')

@section('title', '| Stuur Bericht')


@section('header')
<link rel="stylesheet" href="{{ asset('css/createmessages.css') }}">
@stop


@section('content')
<div class="row"><div class="col-md-8 offset-md-2 main">

	<div class="card">
		<div class="card-body">
			{!! Form::open(['route' => 'message.store', 'method' => 'POST']) !!}
				
				<input name="redirect2" type="text" hidden required value="message.index">
				<br>
				<input name="receipient" type="text" hidden required maxlength="255" value="{{$receiver->name}}">
				<br>
				{{ Form::label('title', 'Onderwerp:') }}
				<input name="title" type="text" class="form-control" required maxlength="255" value="RE: {{$message->title}}">
				<br>
				{{ Form::label('message_body', 'Bericht:') }}
				<textarea name="message_body" id="message_body" class="form-control" required cols="30" rows="10" maxlength="4096">Geachte {{$receiver->name}},



Met vriendelijke groet,

------ in reactie op ------

{{$message->message}}</textarea>
				<br>
				{{ Form::submit('Verstuur!', array('class' => 'btn btn-info button btn-lg btn-block', 'style'=>'margin-top: 20px;')) }}
			{!! Form::close() !!}
		</div>
	</div>

</div></div>
@stop


@section('footer')

@stop