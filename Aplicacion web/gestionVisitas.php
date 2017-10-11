<?php

function cargaVisitas(){
		try{
		$con = getConexion();
	$query = "SELECT * FROM VISITAS";
	$sentencia = $con->query($query);
	$visitas = $sentencia->fetchAll();
	
	$con=null;
	return $visitas;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}

function creaVisita($dniCliente, $nombreMascota, $tratamiento, $fecha){
			try{

 	$con = getConexion();
	$query = "BEGIN CREAR_VISITA(:dni,:nombreMasc,:tratamiento, TO_TIMESTAMP(:fecha, 'DD/MM/YYYY HH24:MI')); END;";
	$sentencia = $con->prepare($query);
	$sentencia->bindParam(':dni',$dniCliente);
	$sentencia->bindParam(':nombreMasc',$nombreMascota);
	$sentencia->bindParam(':tratamiento',$tratamiento);
		$sentencia->bindParam(':fecha',$fecha);
	
	$crea = $sentencia->execute();
	$con=null;
	return $crea;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}

function actualizaVisita($idVisita, $fecha){
			try{
 	$con = getConexion();
	$query = "UPDATE VISITAS SET FECHA=TO_TIMESTAMP(:fecha, 'DD/MM/YYYY HH24:MI') WHERE IDVISITA=:id";
	$sentencia = $con->prepare($query);
		$sentencia->bindParam(':fecha',$fecha);
	$sentencia->bindParam(':id',$idVisita);
	$crea = $sentencia->execute();
	$con=null;
	return $crea;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}
	
	
	function actualizaTratamiento($idVisita, $tratamiento){
			try{
	$idTratamiento = cargaIdTratamientoPorTratamiento($tratamiento);
 	$con = getConexion();
	$query = "UPDATE VISITAS SET IDTRATAMIENTO=:idTratamiento WHERE IDVISITA=:id";
	$sentencia = $con->prepare($query);
	$sentencia->bindParam(':idTratamiento',$idTratamiento);
	$sentencia->bindParam(':id',$idVisita);
	$crea = $sentencia->execute();
	$con=null;
	return $crea;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}


function getIdVisita($dniCliente, $nombreMascota, $tratamiento, $fecha){
			try{

 	$con = getConexion();
	$query = "SELECT TRADUCE_VISITA_IDVISITA('".$dniCliente."', '".$nombreMascota."', '".$tratamiento."', TO_TIMESTAMP('".$fecha."', 'DD/MM/YYYY HH24:MI')) FROM DUAL";
	$sentencia = $con->query($query);
	$idVisita = $sentencia->fetch();
	$con=null;
	return $idVisita['0'];
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}

	function getIdVisitaPorIdCita($idCita){
			try{

 	$con = getConexion();
	$query = "SELECT * FROM CITAS WHERE IDCITA=".$idCita;
	$sentencia = $con->query($query);
	$idVisita = $sentencia->fetch();
	$con=null;
	return $idVisita['IDVISITA'];
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}


?>