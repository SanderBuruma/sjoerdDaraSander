@extends('layouts.app')

@section('title', '| Plaats advertentie')

@section('content')

    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> --}}
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
   

 



  


<div class= "hoofd" >
  <h1>Plaats advertentie<h1>
</div >





    <br>
    
 
   

    <div class="container">
       <div class="row">
          <div class="col-lg-offset-3 col-lg-6">
            <div class="panel panel-warning">
              <div class="panel-heading">  
              <h3 style="color:blue;" class="panel-title">Wenslijst Sint<a href="#" id="addNew" class="pull-right" data-toggle="modal" data-target="#myModal" ><i class="fa fa-plus" aria-hidden="true"></i></a></h3>
            </div>
            <div class="panel-body" id="items">
              <ul class="list-group">
                
              <li class="list-group-item ourItem" data-toggle="modal" data-target="#myModal">
              <input type="hidden" id="itemId" value=""></li>
           
                  </ul>
               </div>
            </div>
          </div>
       
  


    <div class="modal fade" id="myModal"tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="title">Maak een nieuw item aan</h4>
                </div>
                <div class="modal-body">
                <input type="hidden" id="id">
                  <p><input type="text" placeholder="zet hier uw item" id="addItem" class="form-control"></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-warning" id="delete" data-dismiss="modal" style="display: none">Verwijder</button>
                  <button type="button" class="btn btn-primary" id="saveChanges"data-dismiss="modal" style="display: none" >Bewaar wijziging</button>
                  <button type="button" class="btn btn-primary" id="AddButton"  data-dismiss="modal">plaats item</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



          {{csrf_field()}}
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          <script
          src="https://code.jquery.com/jquery-3.3.1.min.js"
          integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
          crossorigin="anonymous"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
          <script src="js/java.js"></script>
   
         

           

@endsection  