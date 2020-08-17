<?php
  
  /**
   * Contenido de la tabla de contribuyentes
   *
   */

  require_once '../../functions/connection/functions_connection.php';
  require_once '../../functions/contribuyentes/functions_contribuyentes.php';
?>
<table id="contribuyentes_table" class="table">
  <thead class=" text-info">
    <th>#</th>
    <th>RFC</th>
    <th>Razón</th>
    <th>CURP</th>
    <th>Tipo</th>
    <th>Estatus</th>
    <th data-orderable="false"></th>
    <th data-orderable="false"></th>
  </thead>
  <tbody>
    <?php
      $i = 0;
      foreach(get_contribuyentes() AS $contribuyente){
        $i++;
    ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $contribuyente['RFC']; ?></td>
      <td><?php echo $contribuyente['Razon']; ?></td>
      <td><?php echo $contribuyente['CURP']; ?></td>
      <td><?php echo $contribuyente['Persona_Tipo']; ?></td>
      <td><b><?php echo $contribuyente['Estatus']; ?><b></td>
      <td>
        <a href="javascript:void(0);" class="text-primary" data-toggle="modal" data-target="#modal_contribuyentes_edit" data-contribuyente="<?php echo $contribuyente['persona']?>">
          <i class="material-icons" title="Editar">edit</i>
        </button>
      </td>
      <td>
        <a href="javascript:void(0);" class="text-danger" onclick="contribuyente_eliminar('<?php echo $contribuyente['persona']; ?>')">
          <i class="material-icons" title="Eliminar">delete_forever</i>
        </button>
      </td>
    </tr>
    <? } ?>
  </tbody>
</table>
<script type="text/javascript">
 
  $(document).ready(function() {
 
      $('#contribuyentes_table').DataTable();
      $('[rel="tooltip"]').tooltip();
 
  });

  function contribuyente_eliminar(contribuyente){

    Swal.fire({
      title: '¿Eliminar al contribuyente?',
      text: 'Esta acción no se puede deshacer',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Si, eliminar.',
      cancelButtonText: 'No'
    
    }).then((result) => {
      
      if (result.value) {

        $.ajax({
    
          type : 'post',
          url : 'assets/functions/contribuyentes/contribuyentes_delete',
          data: 'contribuyente='+contribuyente,
          
          success : function(response){

            switch (response) {

              case 'delete_ok':
                
                Swal.fire(
                  'Eliminado',
                  'El contribuyente ha sido eliminado con éxito.',
                  'success'
                )

                //table contribuyentes
                $('#tabla_contribuyentes_content').load('assets/contents/contribuyentes/contribuyentes_table');

              break;

              case 'delete_failed':
                Swal.fire(
                  'Error',
                  'No se ha podido eliminar al contribuyente.',
                  'error'
                )

              break;

            }

          },
          
          error: function() {
            
            Swal.fire(
              'Error',
              'No se ha podido eliminar al contribuyente.',
              'error'
            )

          }

        });

        

      }

    })

  }
</script>