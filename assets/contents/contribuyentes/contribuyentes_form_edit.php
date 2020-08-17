<?php
  
  /**
   * Contenido del formulario de editar contribuyente
   *
   */

  require_once '../../functions/connection/functions_connection.php';
  require_once '../../functions/contribuyentes/functions_contribuyentes.php';
  require_once '../../functions/contribuyentes/functions_contribuyentes_attributes.php';
  $db = new connDB;

  $contribuyente = $db->real_escape(strip_tags($_POST['contribuyente'],ENT_QUOTES));

  $details = get_contribuyente_details($contribuyente);
?>
<div class="modal-header bg-info">
  <h5 class="modal-title text-white">Editar Contribuyente</h5>
  <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <form id="contribuyentes_form_update">
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label class="bmd-label-floating">Estatus</label>
          <select name="estatus_persona" id="estatus_persona_edit" class="selectpicker bootstrap-select" data-style="btn-secondary" title="Seleccione una opción" required>
            <?php foreach (get_persona_estatus() AS $estatus){ ?>
            <option <?php if($details['Estatus_Id'] == $estatus['Estatus']){ echo "selected"; }?> value="<?php echo $estatus['Estatus']; ?>"><?php echo $estatus['Estatus_Desc']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="bmd-label-floating">Tipo de Persona</label>
          <select name="tipo_persona" id="tipo_persona_edit" class="selectpicker bootstrap-select" data-style="btn-secondary" title="Seleccione una opción" onchange="check_tipo_persona(this.value);" required>
            <?php foreach (get_persona_tipo() AS $tipo){ ?>
            <option <?php if($details['Persona_Tipo_Id'] == $tipo['Tipo']){ echo "selected"; }?> value="<?php echo $tipo['Tipo']; ?>"><?php echo $tipo['Persona_Tipo']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="bmd-label-floating">Sexo</label>
          <select name="sexo" id="sexo_edit" class="selectpicker bootstrap-select" data-style="btn-secondary" title="Seleccione una opción" required>
            <?php foreach (get_persona_sexo() AS $sexo){ ?>
            <option <?php if($details['Sexo_Id'] == $sexo['Sexo']){ echo "selected"; }?> value="<?php echo $sexo['Sexo']; ?>"><?php echo $sexo['Sexo_Desc']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="bmd-label-floating">Nombre(s)</label>
          <input type="text" class="form-control" name="nombre" id="nombre_edit" minlength="3" maxlength="255" value="<?php echo $details['Nombre']; ?>" required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="bmd-label-floating">Apellido Paterno</label>
          <input type="text" class="form-control" name="apellido_pat" id="apellido_pat_edit" minlength="3" maxlength="255" value="<?php echo $details['Ape_Pat']; ?>" required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="bmd-label-floating">Apellido Materno</label>
          <input type="text" class="form-control" name="apellido_mat" id="apellido_mat_edit" minlength="3" maxlength="255" value="<?php echo $details['Ape_Mat']; ?>" required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="bmd-label-floating">RFC</label>
          <input type="text" class="form-control" name="rfc" id="rfc_edit" minlength="12" maxlength="13" onkeyup="this.value = this.value.toUpperCase();" onblur="check_rfc(this.value);" value="<?php echo $details['RFC']; ?>" required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="bmd-label-floating">CURP</label>
          <input type="curp" class="form-control" name="curp" id="curp_edit" minlength="18" maxlength="18" onkeyup="this.value = this.value.toUpperCase();" onblur="check_curp(this.value);" value="<?php echo $details['CURP']; ?>" required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="bmd-label-floating">Nacimiento</label>
          <input type="date" class="form-control" name="nacimiento" id="nacimiento_edit" value="<?php echo $details['Fecha_Nacimiento']; ?>" required>
        </div>
      </div>
    </div>
    <input type="hidden" name="contribuyente" id="contribuyente" value="<?php echo $contribuyente; ?>">
    <button id="contribuyentes_btn_submit_edit" type="button" class="btn btn-success btn-round btn-sm pull-right" onclick="contribuyentes_update();">Actualizar</button>
    <div class="clearfix"></div>
  </form>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<style type="text/css">
  .error{
    color: #f44336;
  }
</style>
<script type="text/javascript">
  
  $(document).ready(function(){

    $('.selectpicker').selectpicker();

    var tipo_persona_select = document.getElementById('tipo_persona_edit').value;
    
    check_tipo_persona(tipo_persona_select);

  });

  function check_tipo_persona(tipo_persona_select){

    switch(tipo_persona_select){

      //moral
      case '1':
        $('#sexo_edit').prop('disabled', true);
        $('#sexo_edit').selectpicker('setStyle', 'btn-light');
        $('#sexo_edit').selectpicker('refresh');

        document.getElementById("apellido_pat_edit").disabled = true;
        document.getElementById("apellido_mat_edit").disabled = true;
        document.getElementById("curp_edit").disabled = true;
        document.getElementById("nacimiento_edit").disabled = true;

      break;

      //fisica
      case '2':
        $('#sexo_edit').prop('disabled', false);
        $('#sexo_edit').selectpicker('setStyle', 'btn-secondary');
        $('#sexo_edit').selectpicker('refresh');

        document.getElementById("apellido_pat_edit").disabled = false;
        document.getElementById("apellido_mat_edit").disabled = false;
        document.getElementById("curp_edit").disabled = false;
        document.getElementById("nacimiento_edit").disabled = false;
      break;

    }

  }

  function check_rfc(rfc){

    if (rfc.length >= 12) {

      $.ajax({
    
        type : 'post',
        url : 'assets/functions/contribuyentes/contribuyentes_check_rfc',
        data: 'rfc='+rfc+'&contribuyente=<?php echo $contribuyente; ?>',
        
        success : function(response){

          var rfc_error  = document.getElementById("rfc-error");
          var curp_error = document.getElementById("curp-error");

          switch (response) {

            case 'rfc_ok':
              if(rfc_error) rfc_error.remove();
              if(!document.getElementById("rfc-error") && !document.getElementById("curp-error")){
                $("#contribuyentes_btn_submit_edit").attr('onclick','contribuyentes_update()');
              }
            break;

            case 'rfc_exist':
              if(rfc_error) rfc_error.remove();
              $("#rfc_edit").after('<label id="rfc-error" class="error" for="rfc">El RFC ya se encuentra registrado.</label>');
              $("#contribuyentes_btn_submit_edit").removeAttr("onclick");

            break;

            case 'rfc_error':
              if(rfc_error) rfc_error.remove();
              $("#rfc_edit").after('<label id="rfc-error" class="error" for="rfc">El RFC no es válido.</label>');
              $("#contribuyentes_btn_submit_edit").removeAttr("onclick");

            break;

            case 'rfc_failed':
              if(rfc_error) rfc_error.remove();
              $("#rfc_edit").after('<label id="rfc-error" class="error" for="rfc">Error al validar RFC.</label>');
              $("#contribuyentes_btn_submit_edit").removeAttr("onclick");

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
        data: 'curp='+curp+'&contribuyente=<?php echo $contribuyente; ?>',
        
        success : function(response){

          var curp_error = document.getElementById("curp-error");
          var rfc_error  = document.getElementById("rfc-error");

          switch (response) {

            case 'curp_ok':
              if(curp_error) curp_error.remove();
              if(!document.getElementById("rfc-error") && !document.getElementById("curp-error")){
                $("#contribuyentes_btn_submit_edit").attr('onclick','contribuyentes_update()');
              }
              return true;

            break;

            case 'curp_exist':
              if(curp_error) curp_error.remove();
              $("#curp_edit").after('<label id="curp-error" class="error" for="curp">El CURP ya se encuentra registrado.</label>');
              $("#contribuyentes_btn_submit_edit").removeAttr("onclick");
              return false;

            break;

            case 'curp_error':
              if(curp_error) curp_error.remove();
              $("#curp_edit").after('<label id="curp-error" class="error" for="curp">El CURP no es válido.</label>');
              $("#contribuyentes_btn_submit_edit").removeAttr("onclick");
              return false;

            break;

            case 'curp_failed':
              if(curp_error) curp_error.remove();
              $("#curp_edit").after('<label id="curp-error" class="error" for="curp">Error al validar CURP.</label>');
              $("#contribuyentes_btn_submit_edit").removeAttr("onclick");
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

  function contribuyentes_update(){

    var form = $('#contribuyentes_form_update');
    
    form.validate();

    if(form.valid() == true){

      $.ajax({
    
        type : 'post',
        url : 'assets/functions/contribuyentes/contribuyentes_update',
        data: form.serialize(),
        
        success : function(response){

          switch (response){

            case 'update_ok':
              $('#tabla_contribuyentes_content').load('assets/contents/contribuyentes/contribuyentes_table');

              $.notify({
                title: '<strong>Datos Actualizados</strong>',
                message: 'El contribuyente ha sido actualizado correctamente.'
              },{
                type: 'success',
                z_index: 2000
              });
            break;

            case 'update_failed':
              $.notify({
                title: '<strong>Error al Actualizar</strong>',
                message: 'Ha ocurrido un error al actualizar el contribuyente. Intente Nuevamente.'
              },{
                type: 'danger',
                z_index: 2000
              });
            break;

            case 'update_empty':
              $.notify({
                title: '<strong>Error al Actualizar</strong>',
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