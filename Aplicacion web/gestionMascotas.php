<?php
	
	function creaMascota($tipoMascota, $raza, $nombreMascota,$dni){
			try{
	
 	$con = getConexion();
	$query = "BEGIN DAR_ALTA_MASCOTA(:tipo,:raza,:nombreMasc,:dni); END;";
	$sentencia = $con->prepare($query);
	$sentencia->bindParam(':tipo',$tipoMascota);
	$sentencia->bindParam(':raza',$raza);
	$sentencia->bindParam(':nombreMasc',$nombreMascota);
	$sentencia->bindParam(':dni',$dni);
	
	$crea = $sentencia->execute();
	$con=null;
	creaHistorial($dni,$nombreMascota);
	return $crea;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}
	
	function eliminaMascota($dni, $nombreMascota){
			try{

 	$con = getConexion();
	$query = "BEGIN ELIMINAR_MASCOTA(:dni,:nombreMasc); END;";
	$sentencia = $con->prepare($query);
	$sentencia->bindParam(':nombreMasc',$nombreMascota);
	$sentencia->bindParam(':dni',$dni);
	
	$elimina = $sentencia->execute();
	$con=null;
	return $elimina;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}
	
	function eliminaMascotaID($idMascota){
			try{

 	$con = getConexion();
	$query = "DELETE FROM MASCOTAS WHERE IDMASCOTA=:id";
	$sentencia = $con->prepare($query);
	$sentencia->bindParam(':id',$idMascota);
	$elimina = $sentencia->execute();
	$con=null;
	return $elimina;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}
	
	function cargaMascotasUsuario($dni){
		try{
 	$idCliente = getIdCliente($dni);
 	$con = getConexion();
	$query = 'SELECT * FROM mascotas WHERE IDCLIENTE='.$idCliente;
	$sentencia = $con->query($query);
	$mascotas = $sentencia->fetchAll();
	$con=null;
	
	return $mascotas;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}
	
	function cargaNombreMascota($idMascota){
		try{
 	$con = getConexion();
	$query = 'SELECT * FROM mascotas WHERE IDMASCOTA='.$idMascota;
	$sentencia = $con->query($query);
	$mascotas = $sentencia->fetch();
	
	$con=null;
	
	return $mascotas['NOMBREMASCOTA'];
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}
	
	function getIdMascota($dni, $nombreMascota){
		try{
	$idCliente = getIdCliente($dni);
 	$con = getConexion();
	$query = "SELECT TRADUCE_MASCOTA_IDMASCOTA('".$dni."', '".$nombreMascota."') FROM DUAL";
	$sentencia = $con->query($query);
	$idMascota = $sentencia->fetch();
	
	$con=null;
	
	return $idMascota['0'];
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}
	
	function isMascotaOfUser($idMascota, $dni){
		try{
		$result = 0;
			
		$idCliente = getIdCliente($dni);
 	$con = getConexion();
	$query = "SELECT * FROM mascotas WHERE IDMASCOTA=".$idMascota." AND IDCLIENTE=".$idCliente;
	$sentencia = $con->query($query);
	$mascotas = $sentencia->fetch();
	if($mascotas != Array()){
		$result = 1;
	}
	$con=null;
	
	return $result;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
		
		
	}

	
?>