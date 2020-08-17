<?php

/**
 * Clase de conexion a la base de datos mediante mysqli*
 *
 * @author Alejandro Mirsha Rojas Calvo
 * @author alikey01@gmail.com
 *
 */

class connDB {

	var $mydb = "itzonyoc";
	var $myserver = "localhost";
	var $myuser = "root";
	var $mypass = "";
	var $rowstotal;
	var $connect;
	var $search;
	var $row = array();

	/**
	 * Funcion principal donde se raliza la conexion a la base de datos
	 * @return object
	 */
	function connDB() {

	  $this->connect = mysqli_connect( $this->myserver, $this->myuser, $this->mypass, $this->mydb );
	  
	  mysqli_set_charset($this->connect,"utf8");

	  if (!$this->connect) { 
	  
	  	return false;
	  
	  }
	  
	  return $this->connect;
	}

	/**
	 * Ejecucion de querys
	 * @param string query a ejecutar
	 * @return object
	 */
	function query($sqlstring) {

	  $this->search = mysqli_query($this->connect, $sqlstring);
	  
	  return $this->search;
	
	}

	/**
	 * Retorna el arreglo de resultados de un query
	 * @return array 
	 */
	function fetch() {

		if (isset($this->search)) {
			
			return $this->row = mysqli_fetch_array($this->search);
		
		}
    
    }
	
	/**
	 * Indica el numero de registros otenidos de un query generalmente consulta
	 * @return int 
	 */
	function rows() {
      
      $this->rowstotal = mysqli_num_rows($this->search);
	  
	  return $this->rowstotal;
    
    }
	
	/**
	 * Limpia cadenas de caracteres especiales, evitar inyeccion sql
	 * @param string Cadena/Variable a limpiar 
	 * @return string
	 */
	function real_escape($var) {

		return mysqli_real_escape_string($this->connect, $var);
	
	}

	/**
	 * Detecta si ocurrieron errores durante la ejecución de un query
	 * @return bool
	 */
	function error() {

		if ( mysqli_error($this->connect) ) { 

			return true;

		}else{ 

			return false;

		} 
	
	}
	
	/**
	 * Muestra los errores detectados durante la ejecución
	 * @return array
	 */
	function error_show() {

		return mysqli_error($this->connect);
	
	}
	
	/**
	 * Devuel el ultimo Id registrado sobre una tabla
	 * @return int
	 */
	function insertid() {

		return mysqli_insert_id($this->connect);
	
	}

}