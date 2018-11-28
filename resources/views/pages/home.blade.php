@extends('layouts.app')

@section('title', '| Home')

@section('content')
{{-- <div class="row">
	<div class="col-md-8 offset-md-2">
		<div class="card">
			<div class="card-header">
				Sander Buruma's Template
			</div>
			<div class="card-body">
				<p>This is Sander Buruma's default Laravel project, which includes several things and a setup which he wants to include in EVERY project and deems too time consuming to keep on including over and over for every new little project.</p>
				<a href="https://trello.com/b/4jj2d8UO/defaultlaravel">Trello Board</a>
			</div>
		</div>
	</div>
</div> --}}

{{-- <div class="background-image"><img src="img/background-image.jpg" alt="background"> --}}
	<div class="outer-container">
		<div class="container">
			<div class="row">

				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					
					<h2>Schrijf hier je bericht</h2>
					<div class="panel panel-default">
						<div class="panel-heading">Panel Heading <a href="" id="addNew" class="pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
						<div class="panel-body">

							<ul class="list-group">
								<li class="list-group-item ourItem" data-toggle="modal" data-target="#myModal">Cras justo odio</li>

								<li class="list-group-item ourItem" data-toggle="modal" data-target="#myModal">Dapibus ac facilisis in</li>

								<li class="list-group-item ourItem" data-toggle="modal" data-target="#myModal">Morbi leo risus</li>

								<li class="list-group-item ourItem" data-toggle="modal" data-target="#myModal">Porta ac consectetur ac</li>

								<li class="list-group-item ourItem" data-toggle="modal" data-target="#myModal">Vestibulum at eros</li>
							</ul>
						</div>
					</div>
					
				</div> <!-- end col-6 -->
				<div class="col-lg-3"></div>

				<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="title">Add New Item</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>

							<div class="modal-body">
								<p><input type="text" placeholder="Write item here" id="addItem" class="form-control"></p>
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-warning" id="delete" data-dismiss="modal" style="display: none">Delete</button>
								<button type="button" class="btn btn-primary" id="saveChanges" style="display: none">Save changes</button>
								<button type="button" class="btn btn-primary" id="addButton">Add item</button>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->

			</div> <!-- end row -->
		</div> <!-- end container -->
	</div> <!-- end outer-container -->
</div> <!-- end background image -->
	
{{ csrf_field() }}
<script
src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script>
	$(document).ready(function(){
		$('.ourItem').each(function(){
			$(this).click(function(event) {
				var text = $(this).text();
				$('#title').text('Edit Item')
				$('#addItem').val(text);
				$('#delete').show('400');
				$('#saveChanges').show('400');
				$('#addButton').hide('400');
				console.log(text);
			});
		});

		$('#addNew').click(function(event) {
				$('#title').text('Add New Item')
				$('#addItem').val("");
				$('#delete').hide('400');
				$('#saveChanges').hide('400');
				$('#addButton').show('400');
		});

		$('#addButton').click(function(event){
			var text = $('#addItem').val();
			$.post('list', {'text': text, '_token':$('input[name=_token]').val()}, function(data){
				console.log(data);
			});
		});
	});
</script>

@endsection