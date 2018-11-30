$(document).ready(function() {
    $(document).on('click', '.ourItem', function(event) {
          var text = $(this).text();
          var id = $(this).find('#itemId').val();
          $('#title').text('Edit Item');
          var text = $.trim(text);
          $('#addItem').val(text);
          $('#delete').show('400');
          $('#saveChanges').show('400');
          $('#AddButton').hide('400');
          $('#id').val(id);
          console.log(text);  
    });    

      $(document).on('click', '#addNew', function(event) {
          $('#title').text('Voeg nieuw item toe');
          $('#addItem').val("");
          $('#delete').hide('400');
          $('#saveChanges').hide('400');
          $('#AddButton').show('400');
      }); 

      $('#AddButton').click(function(event) {
          var text = $('#addItem').val();
          if (text =="") {
            alert('Voeg een item toe aan verlanglijst');
          }else{ 
              $.post('list', {'text': text,'_token':$('input[name=_token]').val()}, function(data) {
                  console.log(data);
                   $('#items').load(location.href + '  #items');
       
         });  
        }
    }); 

    $('#delete').click(function(event) {  
      var id = $("#id").val(); 
      $.post('delete', {'id': id,'_token':$('input[name=_token]').val()}, function(data) { 
        $('#items').load(location.href + '  #items'); 
           console.log(data);

       });  
    }); 

    $('#saveChanges').click(function(event) {  
      var id = $("#id").val(); 
      var value = $.trim($("#addItem").val()); 
      $.post('update', {'id': id,'value': value, '_token':$('input[name=_token]').val()}, function(data) { 
        $('#items').load(location.href + '  #items'); 
           console.log(data);


    });
  });  
});