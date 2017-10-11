<?php

function cargaMensajesClienteSinLeer($dni){
	try{
		$con = getConexion();
	$idCliente = getIdCliente($dni);
	$query = "SELECT * FROM (SELECT * FROM MENSAJES WHERE LEIDO=0 AND IDCLIENTE=".$idCliente.") WHERE ROWNUM<4";
	$sentencia = $con->query($query);
	$mensajes = $sentencia->fetchAll();
	
	$con=null;
	return $mensajes;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}

function cargaMensajesCliente($dni){
	try{
		$con = getConexion();
	$idCliente = getIdCliente($dni);
	$query = "SELECT * FROM MENSAJES WHERE IDCLIENTE=".$idCliente;
	$sentencia = $con->query($query);
	$mensajes = $sentencia->fetchAll();
	
	$con=null;
	return $mensajes;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}

	
	function cargaMensajesPersonalSinLeer($dni){
	try{
		$con = getConexion();
	$idPersonal = getIdPersonal($dni);
	$query = "SELECT * FROM (SELECT * FROM MENSAJES WHERE LEIDO=0 AND IDPERSONAL=".$idPersonal.") WHERE ROWNUM<4";
	$sentencia = $con->query($query);
	$mensajes = $sentencia->fetchAll();
	
	$con=null;
	return $mensajes;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}

	function cargaMensajesPersonal($dni){
	try{
		$con = getConexion();
	$idPersonal = getIdPersonal($dni);
	$query = "SELECT * FROM MENSAJES WHERE IDPERSONAL=".$idPersonal;
	$sentencia = $con->query($query);
	$mensajes = $sentencia->fetchAll();
	
	$con=null;
	return $mensajes;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}



function creaMensaje($dniCliente, $dniPersonal,$asunto,$mensaje){
			try{

	$idCliente = getIdCliente($dniCliente);
	$idPersonal = getIdPersonal($dniPersonal);

 	$con = getConexion();
	$query = "INSERT INTO MENSAJES(IDCLIENTE, IDPERSONAL, ASUNTO, TEXTO) VALUES (:idCliente, :idPersonal, :asunto, :mensaje)";
	$sentencia = $con->prepare($query);
	$sentencia->bindParam(':idCliente',$idCliente);
	$sentencia->bindParam(':idPersonal',$idPersonal);
	$sentencia->bindParam(':asunto',$asunto);
	$sentencia->bindParam(':mensaje',$mensaje);
	
	$crea = $sentencia->execute();
	$con=null;
	return $crea;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}

	function marcaMensajeComoLeido($idMensaje){
		try{

 	$con = getConexion();
	$query = "UPDATE MENSAJES SET LEIDO=1 WHERE IDMENSAJE=:id";
	$sentencia = $con->prepare($query);
	$sentencia->bindParam(':id',$idMensaje);

	
	$actualiza = $sentencia->execute();
	$con=null;
	return $actualiza;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
		
	}


?>