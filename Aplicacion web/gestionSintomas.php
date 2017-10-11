<?php

	function cargaSintomas(){
		try{
		$con = getConexion();
	$query = "SELECT * FROM SINTOMAS";
	$sentencia = $con->query($query);
	$sintomas = $sentencia->fetchAll();
	
	$con=null;
	return $sintomas;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}
	
	function cargaSintomasPorIdSintoma($idSintoma){
		try{
		$con = getConexion();
	$query = "SELECT * FROM sintomas WHERE IDSINTOMA=".$idSintoma;
	$sentencia = $con->query($query);
	$sintomas = $sentencia->fetch();
	
	
	$con=null;
	return $sintomas['TIPOSINTOMA'];
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}
	function creaSintoma($enfermedad, $sintoma){
			try{

 	$con = getConexion();
	$query = "BEGIN CREAR_SINTOMA(:enfermedad,:sintoma); END;";
	$sentencia = $con->prepare($query);
	$sentencia->bindParam(':enfermedad',$enfermedad);
	$sentencia->bindParam(':sintoma',$sintoma);
	
	$crea = $sentencia->execute();
	$con=null;
	return $crea;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}
	
	function getIdSintoma($sintoma){
			try{
 	$con = getConexion();
	$query = "SELECT TRADUCE_SINTOMA_IDSINTOMA('".$sintoma."') FROM DUAL";
	$sentencia = $con->query($query);
	$idSintoma = $sentencia->fetch();
	$con=null;
	return $idSintoma['0'];
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}
	
?>