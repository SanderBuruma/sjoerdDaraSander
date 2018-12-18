@extends('layouts.app')

@section('title', "| Stuur bericht naar $user->name")


@section('header')
<link rel="stylesheet" href="{{ asset('css/messagesCreateNamed.css') }}">
@stop


@section('content')
<div class="row"><div class="col-md-10 offset-md-1 main">

	<div class="card">
		<div class="card-body">
			{!! Form::open(['route' => 'message.store', 'method' => 'POST']) !!}
			
				<input name="redirect2" type="text" hidden required value="advertentie.show">
				<input name="redirect" type="text" hidden required value="{{$advertentie->slug}}">

				{{ Form::label('receipient', 'Verstuur naar:') }}
				<input name="receipient" type="text" hidden required value="{{$user->name}}">

				{{ Form::label('title', 'Onderwerp:') }}
				<input name="title" type="text" class="form-control" required maxlength="255" value="{{$advertentie->title}} - €{{$advertentie->price/1e2}}">

				{{ Form::label('message_body', 'Bericht:') }}
				<textarea name="message_body" id="message_body" class="form-control" required cols="30" rows="10" maxlength="4096">Geachte {{$user->name}},

Ik heb interesse in deze advertentie: 
http://{{route('advertentie.show', $advertentie->slug)}}
Alleen niet voor zoveel geld. Is €{{$advertentie->price/2e2}} genoeg?

Met vriendelijke groet,</textarea>
				<br>
				{{ Form::submit('Verstuur!', array('class' => 'btn btn-success button btn-lg btn-block', 'style'=>'margin-top: 20px;')) }}
			{!! Form::close() !!}
		</div>
	</div>

</div></div>
@stop


@section('footer')

@stop