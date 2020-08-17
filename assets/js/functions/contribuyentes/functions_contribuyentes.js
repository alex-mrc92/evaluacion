$(document).ready(function(){

  //table contribuyentes
  $('#tabla_contribuyentes_content').load('assets/contents/contribuyentes/contribuyentes_table');
  
  //modal contibuyente new
  $('#modal_contribuyentes_new').on('show.bs.modal', function (e) {
    
    $.ajax({
    
      type : 'post',
      url : 'assets/contents/contribuyentes/contribuyentes_form_new',
      
      success : function(data){

        $('#modal_contribuyentes_new_content').html(data);

      },
      error: function() {
        
        return false;

      }

    });

  });

  //modal contibuyente edit
  $('#modal_contribuyentes_edit').on('show.bs.modal', function (e) {

    var contribuyente = $(e.relatedTarget).data('contribuyente');

    $.ajax({
    
      type : 'post',
      url : 'assets/contents/contribuyentes/contribuyentes_form_edit',
      data :  'contribuyente='+contribuyente,

      success : function(data){

        $('#modal_contribuyentes_edit_content').html(data);

      },
      error: function() {
        
        return false;

      }

    });

  });

});