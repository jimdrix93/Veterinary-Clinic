<?php

function cargaTratamientos(){
		try{
		$con = getConexion();
	$query = "SELECT * FROM TRATAMIENTOS";
	$sentencia = $con->query($query);
	$tratamientos = $sentencia->fetchAll();
	
	$con=null;
	return $tratamientos;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}

function cargaTratamientosMascota($idMascota){
			try{
		$con = getConexion();
		$idHistorial = getIDHistorial($idMascota);
		
		$query = 'SELECT * FROM visitas WHERE IDHISTORIAL='.$idHistorial;
		$sentencia = $con->query($query);
		$tratamientos = $sentencia->fetchAll();
	
		$con=null;
		return $tratamientos;
		
		}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}
	
	
		function cargaIdTratamientoPorIdCita($idCita){
		try{
		$con = getConexion();
	$query = "SELECT * FROM VISITAS WHERE IDVISITA=".$idCita;
	$sentencia = $con->query($query);
	$fila = $sentencia->fetch();
	
	$con=null;
	return $fila['IDTRATAMIENTO'];
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}
		
		function cargaTratamientoPorId($idTratamiento){
		try{
		$con = getConexion();
	$query = "SELECT * FROM TRATAMIENTOS WHERE IDTRATAMIENTO=".$idTratamiento;
	$sentencia = $con->query($query);
	$fila = $sentencia->fetch();
	
	$con=null;
	return $fila['TIPOTRATAMIENTO'];
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}
		
		function cargaIdTratamientoPorTratamiento($tratamiento){
		try{
		$con = getConexion();
	$query = "SELECT * FROM TRATAMIENTOS WHERE TIPOTRATAMIENTO='".$tratamiento."'";
	$sentencia = $con->query($query);
	$fila = $sentencia->fetch();
	
	$con=null;
	return $fila['IDTRATAMIENTO'];
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}
		
		function creaTratamiento($tratamiento){
			try{

 	$con = getConexion();
	$query = "BEGIN CREAR_TRATAMIENTO(:tratamiento); END;";
	$sentencia = $con->prepare($query);
	$sentencia->bindParam(':tratamiento',$tratamiento);
	
	$crea = $sentencia->execute();
	$con=null;
	return $crea;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}


?>