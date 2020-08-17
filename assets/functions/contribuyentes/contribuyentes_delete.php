<?php
	
	/**
	 * Script encargado de eliminar los datos del contribuyente
	 * @method POST
	 * @return string
	 * @author Alejandro Mirsha Rojas Calvo
	 * @author alikey01@gmail.com
	 *
	 */

	date_default_timezone_set('America/Mexico_City');
	require_once '../connection/functions_connection.php';
  	require_once 'functions_contribuyentes.php';

  	$db = new connDB;

  	if(isset($_POST)){
		
		$contribuyente = $db->real_escape(strip_tags($_POST['contribuyente'],ENT_QUOTES));
		
		if (contribuyente_delete($contribuyente)) {
			
			echo "delete_ok"; die();
		
		}else{

			echo "delete_failed"; die();

		}

	}else{

		echo "delete_failed"; die();

	}