<?php

function getIDHistorial($idMascota){
		try{
 	$con = getConexion();
	$query = 'SELECT * FROM historiales WHERE IDMASCOTA='.$idMascota;
	$sentencia = $con->query($query);
	$idHistorial = $sentencia->fetch();
	
	$con=null;
	
	return $idHistorial['IDHISTORIAL'];
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}

function creaHistorial($dni, $nombreMascota){
			try{

 	$con = getConexion();
	$query = "BEGIN CREAR_HISTORIAL(:dni,:nombreMasc); END;";
	$sentencia = $con->prepare($query);
	$sentencia->bindParam(':dni',$dni);
	$sentencia->bindParam(':nombreMasc',$nombreMascota);
	
	$crea = $sentencia->execute();
	$con=null;
	return $crea;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}

?>