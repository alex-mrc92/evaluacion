<?php
  
  /**
   * Contenido del formulario de agregar contribuyente
   *
   */

  require_once '../../functions/connection/functions_connection.php';
  require_once '../../functions/contribuyentes/functions_contribuyentes_attributes.php';
?>
<div class="modal-header bg-info">
  <h5 class="modal-title text-white">Nuevo Contribuyente</h5>
  <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <form id="contribuyentes_form_add">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="bmd-label-floating">Tipo de Persona</label>
          <select name="tipo_persona" id="tipo_persona" class="selectpicker bootstrap-select" data-style="btn-secondary" title="Seleccione una opción" onchange="check_tipo_persona(this.value);" required>
            <?php foreach (get_persona_tipo() AS $tipo){ ?>
            <option value="<?php echo $tipo['Tipo']; ?>"><?php echo $tipo['Persona_Tipo']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="bmd-label-floating">Sexo</label>
          <select name="sexo" id="sexo" class="selectpicker bootstrap-select" data-style="btn-secondary" title="Seleccione una opción" required>
            <?php foreach (get_persona_sexo() AS $sexo){ ?>
            <option value="<?php echo $sexo['Sexo']; ?>"><?php echo $sexo['Sexo_Desc']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="bmd-label-floating">Nombre(s)</label>
          <input type="text" class="form-control" name="nombre" id="nombre" minlength="3" maxlength="255" required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="bmd-label-floating">Apellido Paterno</label>
          <input type="text" class="form-control" name="apellido_pat" id="apellido_pat" minlength="3" maxlength="255" required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="bmd-label-floating">Apellido Materno</label>
          <input type="text" class="form-control" name="apellido_mat" id="apellido_mat" minlength="3" maxlength="255" required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="bmd-label-floating">RFC</label>
          <input type="text" class="form-control" name="rfc" id="rfc" minlength="12" maxlength="13" onkeyup="this.value = this.value.toUpperCase();" onblur="check_rfc(this.value);" required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="bmd-label-floating">CURP</label>
          <input type="curp" class="form-control" name="curp" id="curp" minlength="18" maxlength="18" onkeyup="this.value = this.value.toUpperCase();" onblur="check_curp(this.value);" required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="bmd-label-floating">Nacimiento</label>
          <input type="date" class="form-control" name="nacimiento" id="nacimiento" required>
        </div>
      </div>
    </div>
    <button id="contribuyentes_btn_submit" type="button" class="btn btn-success btn-round btn-sm pull-right" onclick="contribuyentes_register();">Registrar</button>
    <div class="clearfix"></div>
  </form>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<style type="text/css">
  input[type=date] {
    color: transparent;
  }
  input[type=date]:focus::-webkit-datetime-edit {
    color: #495057 !important;
  }

  .error{
    color: #f44336;
  }
</style>
<script type="text/javascript">
  
  $(document).ready(function(){

    $('.selectpicker').selectpicker();

  });

  function check_tipo_persona(tipo_persona){

    switch(tipo_persona){

      //moral
      case '1':
        $('#sexo').prop('disabled', true);
        $('#sexo').selectpicker('setStyle', 'btn-light');
        $('#sexo').selectpicker('refresh');

        document.getElementById("apellido_pat").disabled = true;
        document.getElementById("apellido_mat").disabled = true;
        document.getElementById("curp").disabled = true;
        document.getElementById("nacimiento").disabled = true;

      break;

      //fisica
      case '2':
        $('#sexo').prop('disabled', false);
        $('#sexo').selectpicker('setStyle', 'btn-secondary');
        $('#sexo').selectpicker('refresh');

        document.getElementById("apellido_pat").disabled = false;
        document.getElementById("apellido_mat").disabled = false;
        document.getElementById("curp").disabled = false;
        document.getElementById("nacimiento").disabled = false;
      break;

    }

  }

  function check_rfc(rfc){

    if (rfc.length >= 12) {

      $.ajax({
    
        type : 'post',
        url : 'assets/functions/contribuyentes/contribuyentes_check_rfc',
        data: 'rfc='+rfc,
        
        success : function(response){

          var rfc_error  = document.getElementById("rfc-error");
          var curp_error = document.getElementById("curp-error");

          switch (response) {

            case 'rfc_ok':
              if(rfc_error) rfc_error.remove();
              if(!document.getElementById("rfc-error") && !document.getElementById("curp-error")){
              $("#contribuyentes_btn_submit").attr('onclick','contribuyentes_register()');
              }

            break;

            case 'rfc_exist':
              if(rfc_error) rfc_error.remove();
              $("#rfc").after('<label id="rfc-error" class="error" for="rfc">El RFC ya se encuentra registrado.</label>');
              //document.getElementById("contribuyentes_btn_submit").disabled = true;
              //document.getElementById("contribuyentes_btn_submit").onclick = null;
              $("#contribuyentes_btn_submit").removeAttr("onclick");

            break;

            case 'rfc_error':
              if(rfc_error) rfc_error.remove();
              $("#rfc").after('<label id="rfc-error" class="error" for="rfc">El RFC no es válido.</label>');
              //document.getElementById("contribuyentes_btn_submit").disabled = true;
              //document.getElementById("contribuyentes_btn_submit").onclick = null;
              $("#contribuyentes_btn_submit").removeAttr("onclick");

            break;

            case 'rfc_failed':
              if(rfc_error) rfc_error.remove();
              $("#rfc").after('<label id="rfc-error" class="error" for="rfc">Error al validar RFC.</label>');
              //document.getElementById("contribuyentes_btn_submit").disabled = true;
              //document.getElementById("contribuyentes_btn_submit").onclick = null;
              $("#contribuyentes_btn_submit").removeAttr("onclick");

            break;

          }

        },
        
        error: function() {
          
          return false;

        }

      });

    }else{

      return false;

    }

  }

  function check_curp(curp){

    if (curp.length >= 18) {

      $.ajax({
    
        type : 'post',
        url : 'assets/functions/contribuyentes/contribuyentes_check_curp',
        data: 'curp='+curp,
        
        success : function(response){

          var curp_error = document.getElementById("curp-error");
          var rfc_error  = document.getElementById("rfc-error");

          switch (response) {

            case 'curp_ok':
              if(curp_error) curp_error.remove();
              if(!document.getElementById("rfc-error") && !document.getElementById("curp-error")){ 
                $("#contribuyentes_btn_submit").attr('onclick','contribuyentes_register()');
              }
              return true;

            break;

            case 'curp_exist':
              if(curp_error) curp_error.remove();
              $("#curp").after('<label id="curp-error" class="error" for="curp">El CURP ya se encuentra registrado.</label>');
              //document.getElementById("contribuyentes_btn_submit").disabled = true;
              $("#contribuyentes_btn_submit").removeAttr("onclick");
              return false;

            break;

            case 'curp_error':
              if(curp_error) curp_error.remove();
              $("#curp").after('<label id="curp-error" class="error" for="curp">El CURP no es válido.</label>');
              //document.getElementById("contribuyentes_btn_submit").disabled = true;
              $("#contribuyentes_btn_submit").removeAttr("onclick");
              return false;

            break;

            case 'curp_failed':
              if(curp_error) curp_error.remove();
              $("#curp").after('<label id="curp-error" class="error" for="curp">Error al validar CURP.</label>');
              //document.getElementById("contribuyentes_btn_submit").disabled = true;
              $("#contribuyentes_btn_submit").removeAttr("onclick");
              return false;

            break;

          }

        },
        
        error: function() {
          
          return false;

        }

      });

    }else{

      return false;

    }

  }

  function contribuyentes_register(){

    var form = $('#contribuyentes_form_add');
    
    form.validate();

    if(form.valid() == true){

      $.ajax({
    
        type : 'post',
        url : 'assets/functions/contribuyentes/contribuyentes_register',
        data: form.serialize(),
        
        success : function(response){

          switch (response){

            case 'register_ok':
              $.notify({
                title: '<strong>Registro Exitoso</strong>',
                message: 'El contribuyente ha sido registrado correctamente.'
              },{
                type: 'success',
                z_index: 2000
              });
              
              document.getElementById("contribuyentes_form_add").reset();
              $('#tipo_persona').selectpicker('refresh');
              $('#sexo').selectpicker('refresh');
              $('#tabla_contribuyentes_content').load('assets/contents/contribuyentes/contribuyentes_table');
            break;

            case 'register_failed':
              $.notify({
                title: '<strong>Error al Registrar</strong>',
                message: 'Ha ocurrido un error al registrar el contribuyente. Intente Nuevamente.'
              },{
                type: 'danger',
                z_index: 2000
              });
            break;

            case 'register_empty':
              $.notify({
                title: '<strong>Error al Registrar</strong>',
                message: 'Favor de revisar que todos los datos sean correctos.'
              },{
                type: 'warning',
                z_index: 2000
              });
            break;

          }

        },
        
        error: function() {
          
          return false;

        }

      });

    }else{

      return false;

    }

  }
</script>