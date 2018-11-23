<body>
	<div id="app">
		@include('partials._nav')

		@if (Session::has('success'))
			<div class="alert alert-success" role="alert">
				<strong>Success: </strong> {{ Session::get('success') }}
			</div>
		@endif

		<main class="py-4">
			@yield('content')
		</main>
	</div>