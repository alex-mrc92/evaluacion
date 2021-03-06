<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="description" content="Evaluación Itzonyoc">
  <meta name="author" content="Alejandro Mirsha Rojas Calvo">
  
  <title>Contribuyentes | Evaluacion Itzonyoc</title>

  <link rel="apple-touch-icon" sizes="96x96" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
  <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    
    <!-- main menu -->
    <?php include 'menu.php'; ?>
    <!-- /main menu -->

    <div class="main-panel">
      
      <!-- Navbar -->
      <?php include 'navbar.php'?>
      <!-- End Navbar -->
      
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title ">Contribuyentes</h4>
                </div>
                <div class="card-body">
                  <button class="btn btn-success btn-round btn-sm" rel="tooltip" title="Nuevo Contribuyente" data-toggle="modal" data-target="#modal_contribuyentes_new">
                    <i class="material-icons">add</i>&nbsp;
                  </button>
                  <button class="btn btn-primary btn-round btn-sm" rel="tooltip" title="Recargar Lista" onclick="$('#tabla_contribuyentes_content').load('assets/contents/contribuyentes/contribuyentes_table');">
                    <i class="material-icons">autorenew</i>
                  </button>

                  <div class="table-responsive" id="tabla_contribuyentes_content">
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- modals -->
      
      <!-- contribuyente new -->
      <div class="modal fade" id="modal_contribuyentes_new" tabindex="-1" role="dialog" aria-labelledby="modal_contribuyentes_new">
        <div class="modal-dialog" role="document">
          <div class="modal-content" id="modal_contribuyentes_new_content">
            
          </div>
        </div>
      </div>
      <!-- /contribuyente new -->

      <!-- contribuyente edit -->
      <div class="modal fade" id="modal_contribuyentes_edit" tabindex="-1" role="dialog" aria-labelledby="modal_contribuyentes_edit">
        <div class="modal-dialog" role="document">
          <div class="modal-content" id="modal_contribuyentes_edit_content">
            
          </div>
        </div>
      </div>
      <!-- /contribuyente edit -->
      <!-- /modals -->

      <footer class="footer">
        <div class="container-fluid">
          <div class="copyright float-right">
            <script>
              document.write(new Date().getFullYear())
            </script> - CRUD Contribuyentes por
            <a href="mailto:alikey01@gmail.com">Alejandro Mirsha Rojas Calvo.</a>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="assets/js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="assets/js/plugins/jquery.validate.min.js"></script>
  <script src="assets/js/plugins/messages_es.min.js"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="assets/js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="assets/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="assets/js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="assets/js/plugins/arrive.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>

  <!-- FUNCTIONS -->
  <script src="assets/js/functions/contribuyentes/functions_contribuyentes.js"></script>
  
</body>

</html>