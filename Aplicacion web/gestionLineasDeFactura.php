<?php

function creaLineaDeFactura($dniCliente, $dniPersonal,$importe){
			try{

 	$con = getConexion();
	$query = "BEGIN CREAR_LINEADEFACTURA(:dniCliente,:dniPersonal,:importe); END;";
	$sentencia = $con->prepare($query);
	$sentencia->bindParam(':dniCliente',$dniCliente);
	$sentencia->bindParam(':dniPersonal',$dniPersonal);
	$sentencia->bindParam(':importe',$importe);	
	
	$crea = $sentencia->execute();
	$con=null;
	return $crea;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}

function cargaLineasDeFactura(){
	
	try{
		$con = getConexion();
	$query = "SELECT * FROM LINEASDEFACTURA";
	$sentencia = $con->query($query);
	$lineasFactura = $sentencia->fetchAll();
	
	$con=null;
	return $lineasFactura;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
}

?>