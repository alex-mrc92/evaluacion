<?php
	
	/**
	 * Script encargado de registrar los datos del contribuyente
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
		
		$tipo_persona = $db->real_escape(strip_tags($_POST['tipo_persona'],ENT_QUOTES));
		$sexo 		  = $db->real_escape(strip_tags($_POST['sexo'],ENT_QUOTES));
		$nombre 	  = ucwords($db->real_escape(strip_tags($_POST['nombre'],ENT_QUOTES)));
		$apellido_pat = ucwords($db->real_escape(strip_tags($_POST['apellido_pat'],ENT_QUOTES)));
		$apellido_mat = ucwords($db->real_escape(strip_tags($_POST['apellido_mat'],ENT_QUOTES)));
		$rfc 		  = $db->real_escape(strip_tags($_POST['rfc'],ENT_QUOTES));
		$curp 		  = $db->real_escape(strip_tags($_POST['curp'],ENT_QUOTES));
		$nacimiento   = $db->real_escape(strip_tags($_POST['nacimiento'],ENT_QUOTES));

		$fecha_alta   = date('Y-m-d');
		$estatus 	  = 4; //validando - default value

		switch ($tipo_persona) {
			case '1'://MORAL
				$contribuyente_result_register = contribuyente_moral_register($tipo_persona,$nombre,$rfc,$fecha_alta,$estatus);
				break;
			
			case '2'://FISICA
				$contribuyente_result_register = contribuyente_fisica_register($tipo_persona,$sexo,$nombre,$apellido_pat,$apellido_mat,$rfc,$curp,$nacimiento,$fecha_alta,$estatus);
				break;
		}

		if ($contribuyente_result_register) {
			
			echo "register_ok"; die();
		
		}else{

			echo "register_failed"; die();

		}

	}else{

		echo "register_empty"; die();

	}