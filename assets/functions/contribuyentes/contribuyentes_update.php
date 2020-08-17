<?php
	
	/**
	 * Script encargado de actualizar los datos del contribuyente
	 * @method POST
	 * @return string
	 * @author Alejandro Mirsha Rojas Calvo
	 * @author alikey01@gmail.com
	 *
	 */
	
	error_reporting(E_WARNING | E_ERROR);
	date_default_timezone_set('America/Mexico_City');
	require_once '../connection/functions_connection.php';
  	require_once 'functions_contribuyentes.php';

  	$db = new connDB;

  	if(isset($_POST)){
		
		$contribuyente = $db->real_escape(strip_tags($_POST['contribuyente'],ENT_QUOTES));
		$estatus  	   = $db->real_escape(strip_tags($_POST['estatus_persona'],ENT_QUOTES));
		$tipo_persona  = $db->real_escape(strip_tags($_POST['tipo_persona'],ENT_QUOTES));
		$sexo 		   = $db->real_escape(strip_tags($_POST['sexo'],ENT_QUOTES));
		$nombre 	   = ucwords($db->real_escape(strip_tags($_POST['nombre'],ENT_QUOTES)));
		$apellido_pat  = ucwords($db->real_escape(strip_tags($_POST['apellido_pat'],ENT_QUOTES)));
		$apellido_mat  = ucwords($db->real_escape(strip_tags($_POST['apellido_mat'],ENT_QUOTES)));
		$rfc 		   = $db->real_escape(strip_tags($_POST['rfc'],ENT_QUOTES));
		$curp 		   = $db->real_escape(strip_tags($_POST['curp'],ENT_QUOTES));
		$nacimiento    = $db->real_escape(strip_tags($_POST['nacimiento'],ENT_QUOTES));

		$fecha_mod     = date('Y-m-d');

		switch ($tipo_persona) {
			case '1'://MORAL
				$contribuyente_result_update = contribuyente_moral_update($contribuyente,$estatus,$tipo_persona,$nombre,$rfc,$fecha_mod);
				break;
			
			case '2'://FISICA
				$contribuyente_result_update = contribuyente_fisica_update($contribuyente,$estatus,$tipo_persona,$sexo,$nombre,$apellido_pat,$apellido_mat,$rfc,$curp,$nacimiento,$fecha_mod);
				break;
		}

		if ($contribuyente_result_update) {
			
			echo "update_ok"; die();
		
		}else{

			echo "update_failed"; die();

		}

	}else{

		echo "update_empty"; die();

	}