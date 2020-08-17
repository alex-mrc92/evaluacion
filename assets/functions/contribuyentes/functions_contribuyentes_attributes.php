<?php
	
	/**
	 * Retorna el arreglo de Tipo_Persona registrados
	 * @return array
	 */
	function get_persona_tipo(){

	    $db = new connDB;    
	    
	    $mis = "SELECT * FROM persona_tipo_view";
	    $db->query($mis);

	    if($db->rows() > 0){
	        
	    	while ($fila = $db->fetch()){

        		$tipo[] = $fila;

        	}

      		return $tipo;

	    }

  	}

  	/**
	 * Retorna el arreglo de Sexo registrados
	 * @return array
	 */
  	function get_persona_sexo(){

	    $db = new connDB;    
	    
	    $mis = "SELECT * FROM sexo_view";
	    $db->query($mis);

	    if($db->rows() > 0){
	        
	    	while ($fila = $db->fetch()){

        		$sexo[] = $fila;

        	}

      		return $sexo;

	    }

  	}

  	/**
	 * Retorna el arreglo de Estatus registrados
	 * @return array
	 */
  	function get_persona_estatus(){

	    $db = new connDB;    
	    
	    $mis = "SELECT * FROM estatus_view";
	    $db->query($mis);

	    if($db->rows() > 0){
	        
	    	while ($fila = $db->fetch()){

        		$estatus[] = $fila;

        	}

      		return $estatus;

	    }

  	}
