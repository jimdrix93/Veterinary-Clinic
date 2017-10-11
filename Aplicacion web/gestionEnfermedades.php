<?php

function cargaEnfermedades(){
		try{
		$con = getConexion();
	$query = "SELECT * FROM ENFERMEDADES";
	$sentencia = $con->query($query);
	$enfermedades = $sentencia->fetchAll();
	
	$con=null;
	return $enfermedades;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}


function creaEnfermedad($tratamiento, $enfermedad){
			try{

 	$con = getConexion();
	$query = "BEGIN CREAR_ENFERMEDAD(:tratamiento,:enfermedad); END;";
	$sentencia = $con->prepare($query);
	$sentencia->bindParam(':tratamiento',$tratamiento);
	$sentencia->bindParam(':enfermedad',$enfermedad);
	
	$crea = $sentencia->execute();
	$con=null;
	return $crea;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}

?>