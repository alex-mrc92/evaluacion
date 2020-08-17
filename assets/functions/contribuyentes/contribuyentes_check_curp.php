<?php
  
  /**
   * Script encargado de validar CURP y verificar su duplicidad
   * @method POST
   * @return string
   * @author Alejandro Mirsha Rojas Calvo
   * @author alikey01@gmail.com
   *
   */

  error_reporting(E_WARNING | E_ERROR);
  require_once '../connection/functions_connection.php';
  require_once 'functions_contribuyentes.php';

  $db = new connDB;

  if(isset($_POST)){

    $curp          = strtoupper($db->real_escape(strip_tags($_POST['curp'],ENT_QUOTES)));
    $contribuyente = $db->real_escape(strip_tags($_POST['contribuyente'],ENT_QUOTES));

    $regex = '/^[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/';
    
    if (preg_match($regex, $curp)) {
        
        if(contribuyente_curp_exist($curp,$contribuyente)){

        	echo 'curp_ok'; die();

        }else{

        	echo 'curp_exist'; die();

        }
    
    }else{
    
    	echo 'curp_error'; die();

    }

  }else{

    echo 'curp_failed'; die();

  }