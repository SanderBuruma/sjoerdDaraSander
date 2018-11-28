<body>
		
	<div id="app">
		@include('partials._nav')

		@if (Session::has('success'))
			<div class="alert alert-success" role="alert">
				<strong>Success: </strong> {{ Session::get('success') }}
			</div>
		@endif
		@if (Session::has('error'))
			<div class="alert alert-danger" role="alert">
				<strong>Error: </strong> {{ Session::get('error') }}
			</div>
		@endif


		@if (count($errors)>0)

			<div class="alert alert-danger" role="alert">
				<strong>Errors:</strong><ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
				</ul>
			</div>

		@endif

		<main class="py-4">
			@yield('content')
		</main>
	</div>

	<style>
	body{
		background-image: url("img/background-image.jpg");
		background-size: cover;
	}
	</style>