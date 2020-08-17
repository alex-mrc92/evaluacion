<?php
  
  /**
   * Script encargado de validar RFC y verificar su duplicidad
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

    $rfc           = strtoupper($db->real_escape(strip_tags($_POST['rfc'],ENT_QUOTES)));
    $contribuyente = $db->real_escape(strip_tags($_POST['contribuyente'],ENT_QUOTES));

    $regex = '/^(([ÑA-Z|ña-z|&amp;]{3}|[A-Z|a-z]{4})\d{2}((0[1-9]|1[012])(0[1-9]|1\d|2[0-8])|(0[13456789]|1[012])(29|30)|(0[13578]|1[02])31)(\w{2})([A|a|0-9]{1}))$|^(([ÑA-Z|ña-z|&amp;]{3}|[A-Z|a-z]{4})([02468][048]|[13579][26])0229)(\w{2})([A|a|0-9]{1})$/D';
    
    if (preg_match($regex, $rfc)) {
        
        if(contribuyente_rfc_exist($rfc,$contribuyente)){

        	echo 'rfc_ok'; die();

        }else{

        	echo 'rfc_exist'; die();

        }
    
    }else{
    
    	echo 'rfc_error'; die();

    }

  }else{

    echo 'rfc_failed'; die();

  }