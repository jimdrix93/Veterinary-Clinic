<?php

function cargaFacturasClienteSinPagar($dni){
	try{
		$con = getConexion();
	$idCliente = getIdCliente($dni);
	$query = "SELECT * FROM FACTURAS WHERE PAGADA=0 AND IDCLIENTE=".$idCliente;
	$sentencia = $con->query($query);
	$facturas = $sentencia->fetchAll();
	
	$con=null;
	return $facturas;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}

function cargaFacturasCliente($dni){
		try{
		$con = getConexion();
	$idCliente = getIdCliente($dni);
	$query = "SELECT * FROM FACTURAS WHERE IDCLIENTE=".$idCliente;
	$sentencia = $con->query($query);
	$facturas = $sentencia->fetchAll();
	
	$con=null;
	return $facturas;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
}


function cargaImportesFacturasCliente($dni, $fecha){
		try{
		$con = getConexion();
	$idCliente = getIdCliente($dni);
	$day = substr($fecha, 0, 2);
	$month = substr($fecha, 3, 2);
	$year = '20'.substr($fecha, 6, 2);
	$hour = substr($fecha, 9, 2);
	$minute = substr($fecha, 12, 2);
	$second = substr($fecha, 15, 2);
	
	
	$query = "SELECT * FROM FACTURAS WHERE FECHA=TO_TIMESTAMP('".$year."-".$month."-".$day." ".$hour.":".$minute.":".$second.".00000000', 'YYYY-MM-DD HH24:MI:SS.FF') AND IDCLIENTE=:id";
	$sentencia = $con->prepare($query);
	$sentencia->bindParam(':id',$idCliente);
	$actualiza = $sentencia->execute();
	$facturas = $sentencia->fetch();
	
	$con=null;
	return $facturas;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
	}
}


function cargaImportesFacturas($fecha){
		try{
		$con = getConexion();
	
	$day = substr($fecha, 0, 2);
	$month = substr($fecha, 3, 2);
	$year = '20'.substr($fecha, 6, 2);
	$hour = substr($fecha, 9, 2);
	$minute = substr($fecha, 12, 2);
	$second = substr($fecha, 15, 2);
	
	
	$query = "SELECT * FROM FACTURAS WHERE FECHA=TO_TIMESTAMP('".$year."-".$month."-".$day." ".$hour.":".$minute.":".$second.".00000000', 'YYYY-MM-DD HH24:MI:SS.FF')";
	$sentencia = $con->prepare($query);
	$actualiza = $sentencia->execute();
	$facturas = $sentencia->fetch();
	
	$con=null;
	return $facturas;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
	}
}


function marcarFacturaComoPagada($idFactura){
	try{
	
		$con = getConexion();
	$idCliente = getIdCliente($dni);
	$query = "UPDATE FACTURAS SET PAGADA=1 WHERE IDFACTURA=:id";
	$sentencia = $con->prepare($query);
	$sentencia->bindParam(':id',$idFactura);
	$actualiza = $sentencia->execute();
	$con=null;
	return $actualiza;
		
	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
	}
	
}

function creaFactura($dni){
			try{

 	$con = getConexion();
	$query = "BEGIN CREAR_FACTURA(:dni); END;";
	
	$sentencia = $con->prepare($query);
	$sentencia->bindParam(':dni',$dni);
	
	$crea = $sentencia->execute();
	$con=null;
	return $crea;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}

	function generaFacturaDeCita($idCita){
		try{

 	$con = getConexion();
	$query = "SELECT * FROM CITAS WHERE IDCITA=".$idCita;
	$sentencia = $con->query($query);
	$citas = $sentencia->fetch();
	$query = "SELECT * FROM MASCOTAS WHERE IDMASCOTA=".$citas['IDMASCOTA'];
	$sentencia = $con->query($query);
	$idCliente = $sentencia->fetch();
	$citas['FECHAHORA'] = substr($citas['FECHAHORA'], 0,6)."20".substr($citas['FECHAHORA'],6,8);
	
	$query = "SELECT * FROM VISITAS WHERE FECHA=TO_TIMESTAMP('".$citas['FECHAHORA']."', 'DD/MM/YYYY HH24:MI')";
	$sentencia = $con->query($query);
	$visitas = $sentencia->fetch();
	
	$query = "SELECT * FROM TRATAMIENTOS WHERE IDTRATAMIENTO=".$visitas['IDTRATAMIENTO'];
	$sentencia = $con->query($query);
	$tratamiento = $sentencia->fetch();
	
	$query = "SELECT * FROM LINEASDEFACTURA WHERE IDLINEAFACTURA=".$tratamiento['IDLINEAFACTURA'];
	$sentencia = $con->query($query);
	$lineaFactura = $sentencia->fetch();
	
	
	$query = "INSERT INTO FACTURAS (IDCLIENTE, IMPORTETOTAL, FECHA) VALUES (:id, :importe, TO_TIMESTAMP(:fecha, 'DD/MM/YYYY HH24:MI'))";
	$sentencia = $con->prepare($query);
	$sentencia->bindParam(':id',$idCliente['IDCLIENTE']);
	$sentencia->bindParam(':importe',$lineaFactura['IMPORTE']);
	$sentencia->bindParam(':fecha',$citas['FECHAHORA']);
	$crea = $sentencia->execute();

	
	$con=null;
	return $citas;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}		
	}

?>