<?php
	
	/**
	 * Devuelve el arreglo de contribuyentes
	 * @return array
	 */
	function get_contribuyentes(){

	    $db = new connDB;    
	    
	    $mis = "SELECT * FROM personas_view";
	    $db->query($mis);

	    if($db->rows() > 0){
	        

	    	while ($fila = $db->fetch()){

        		$contribuyentes[] = $fila;

        	}

      		return $contribuyentes;

	    }

  	}

  	/**
  	 * Devuelve un arreglo de los datos de un contribuyente en especial
  	 * @param string Id del contribuyente 
  	 * @return array
  	 */
  	function get_contribuyente_details($contribuyente){

	    $db = new connDB;    
	    
	    $mis = "SELECT * FROM persona WHERE SHA1(Id) = '$contribuyente' LIMIT 1";
	    $db->query($mis);

	    if($db->rows() > 0){
	        
	      return $db->fetch();

	    }

  	}

  	/**
  	 * Verifica el duplicado de un RFC en la base de datos
  	 * @param string RFC del contribuyente 
  	 * @return bool
  	 */
  	function contribuyente_rfc_exist($rfc,$contribuyente){

  		$db = new connDB;

  		if(isset($contribuyente)) $contribuyente_check = "AND persona != '$contribuyente' ";
	    
	    $mis = "SELECT * FROM personas_view WHERE RFC = '$rfc' $contribuyente_check ";

	    $db->query($mis);

	    if($db->rows() > 0){
	        
	    	return false;

	    }else{

	    	return true;

	    }

  	}

  	/**
  	 * Verifica el duplicado de un CURP en la base de datos
  	 * @param string CURP del contribuyente 
  	 * @return bool
  	 */
  	function contribuyente_curp_exist($curp,$contribuyente){

  		$db = new connDB;

  		if(isset($contribuyente)) $contribuyente_check = "AND persona != '$contribuyente' ";
	    
	    $mis = "SELECT * FROM personas_view WHERE CURP = '$curp' $contribuyente_check ";
	    $db->query($mis);

	    if($db->rows() > 0){
	        
	    	return false;

	    }else{

	    	return true;

	    }

  	}

  	/**
  	 * Registra y verifíca un nuevo contribuyente - Persona Moral
  	 * @param int Tipo_persona 
  	 * @param string Nombre 
  	 * @param string RFC 
  	 * @param string Fecha_Alta 
  	 * @param int Estatus 
  	 * @return bool
  	 */
  	function contribuyente_moral_register($tipo_persona,$nombre,$rfc,$fecha_alta,$estatus){

	    $db = new connDB;    
	    
	    $mis = "INSERT INTO persona(Nombre,RFC,Fecha_Alta,Estatus_Id,Persona_Tipo_Id) VALUES('$nombre','$rfc','$fecha_alta',$estatus,$tipo_persona)";
	    $db->query($mis);

	    if(!$db->error()){
      
      		return true;
    
    	}else{
    
      		return false;
    
    	}

  	}

  	/**
  	 * Registra y verifíca un nuevo contribuyente - Persona Física
  	 * @param int Tipo_persona 
  	 * @param int Sexo 
  	 * @param string Nombre 
  	 * @param string Apellido_Pat 
  	 * @param string Apellido_Mat 
  	 * @param string RFC 
  	 * @param string CURP 
  	 * @param string Nacimiento
  	 * @param string Fecha_Alta 
  	 * @param int Estatus 
  	 * @return bool
  	 */
  	function contribuyente_fisica_register($tipo_persona,$sexo,$nombre,$apellido_pat,$apellido_mat,$rfc,$curp,$nacimiento,$fecha_alta,$estatus){

  		$db = new connDB;    
	    
	    $mis = "INSERT INTO persona(Nombre,Ape_Pat,Ape_Mat,RFC,CURP,Fecha_Nacimiento,Fecha_Alta,Estatus_Id,Sexo_Id,Persona_Tipo_Id) VALUES('$nombre','$apellido_pat','$apellido_mat','$rfc','$curp','$nacimiento','$fecha_alta',$estatus,$sexo,$tipo_persona)";
	    $db->query($mis);

	    if(!$db->error()){
      
      		return true;
    
    	}else{
    
      		return false;
    
    	}

  	}

  	/**
  	 * Actualiza y verifíca un contribuyente - Persona Moral
  	 * @param int Contribuyente - Id
  	 * @param int Estatus 
  	 * @param int Tipo_persona 
  	 * @param string Nombre 
  	 * @param string RFC 
  	 * @param string Fecha_Mod 
  	 * @return bool
  	 */
  	function contribuyente_moral_update($contribuyente,$estatus,$tipo_persona,$nombre,$rfc,$fecha_mod){

	    $db = new connDB;    
	    
	    $mis = "UPDATE persona SET Nombre='$nombre', RFC='$rfc', Fecha_Modificacion='$fecha_mod', Estatus_Id=$estatus, Persona_Tipo_Id=$tipo_persona WHERE SHA1(Id) = '$contribuyente' LIMIT 1";
	    $db->query($mis);

	    if(!$db->error()){
      
      		return true;
    
    	}else{
    
      		return false;
    
    	}

  	}

  	/**
  	 * Actualiza y verifíca un contribuyente - Persona Física
  	 * @param int Contribuyente - Id
  	 * @param int Estatus 
  	 * @param int Tipo_persona 
  	 * @param int Sexo 
  	 * @param string Nombre 
  	 * @param string Apellido_Pat 
  	 * @param string Apellido_Mat 
  	 * @param string RFC 
  	 * @param string CURP 
  	 * @param string Nacimiento
  	 * @param string Fecha_Mod 
  	 * @return bool
  	 */
  	function contribuyente_fisica_update($contribuyente,$estatus,$tipo_persona,$sexo,$nombre,$apellido_pat,$apellido_mat,$rfc,$curp,$nacimiento,$fecha_mod){

  		$db = new connDB;    
	    
	    $mis = "UPDATE persona SET Nombre='$nombre', Ape_Pat='$apellido_pat', Ape_Mat='$apellido_mat', RFC='$rfc', CURP='$curp', Fecha_Nacimiento='$nacimiento', Fecha_Modificacion='$fecha_mod', Estatus_Id=$estatus, Sexo_Id=$sexo, Persona_Tipo_Id=$tipo_persona WHERE SHA1(Id) = '$contribuyente' LIMIT 1";
	    $db->query($mis);

	    if(!$db->error()){
      
      		return true;
    
    	}else{
    
      		return false;
    
    	}

  	}

  	/**
  	 * Elimina el registro de un contribuyente
  	 * @param string Contribuyente - Id
  	 * @return bool
  	 */
  	function contribuyente_delete($contribuyente){

  		$db = new connDB;    
	    
	    $mis = "DELETE FROM persona WHERE SHA1(Id) = '$contribuyente' LIMIT 1";
	    $db->query($mis);

	    if(!$db->error()){
      
      		return true;
    
    	}else{
    
      		return false;
    
    	}

  	}
