<?php


		function creaCita($fechahora, $nombreMascota, $dniCliente, $dniPersonal, $tratamiento, $sintoma){
		try{
	
	
	$idMascota = getIdMascota($dniCliente, $nombreMascota);
	$idSintoma = getIdSintoma($sintoma);
	$idPersonal = getIdPersonal($dniPersonal);
	$idVisita = getIdVisita($dniCliente, $nombreMascota, $tratamiento, $fechahora);

 	$con = getConexion();

	$query = "INSERT INTO CITAS (IDMASCOTA, IDSINTOMA, IDVISITA, IDPERSONAL, FECHAHORA) VALUES (:idMascota, :idSintoma, :idVisita, :idPersonal, TO_TIMESTAMP(:fecha, 'DD/MM/YYYY HH24:MI'))";
	$sentencia = $con->prepare($query);
	
	$sentencia->bindParam(':fecha',$fechahora);	
	$sentencia->bindParam(':idMascota',$idMascota);
	$sentencia->bindParam(':idSintoma',$idSintoma);
	$sentencia->bindParam(':idVisita',$idVisita);
	$sentencia->bindParam(':idPersonal',$idPersonal);
	$crea = $sentencia->execute();
	$con=null;
	return $crea;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}
	
	
	


	function actualizaCita($idCita, $fechahora, $dniPersonal, $sintoma){
			try{
				
	$idPersonal = getIdPersonal($dniPersonal);
	$idSintoma = getIdSintoma($sintoma);
	
 	$con = getConexion();
	$query = "UPDATE CITAS SET FECHAHORA=TO_TIMESTAMP(:fecha, 'DD/MM/YYYY HH24:MI'), IDSINTOMA=:idSintoma, IDPERSONAL=:idPersonal WHERE IDCITA=:id";
	$sentencia = $con->prepare($query);
	$sentencia->bindParam(':fecha',$fechahora);
	$sentencia->bindParam(':idPersonal',$idPersonal);
	$sentencia->bindParam(':idSintoma',$idSintoma);
	$sentencia->bindParam(':id',$idCita);
	
	$actualiza = $sentencia->execute();
	$con=null;
	return $actualiza;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}
	
	function eliminaCita($idCita){
		try{

 	$con = getConexion();
	$query = "DELETE FROM CITAS WHERE IDCITA=:id";
	$sentencia = $con->prepare($query);
	$sentencia->bindParam(':id',$idCita);

	$elimina = $sentencia->execute();
	$con=null;
	return $elimina;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}


function cargaCitaID($idCita){
		try{

 	$con = getConexion();
	

		$query = "SELECT * FROM CITAS WHERE IDCITA=".$idCita;
		$sentencia = $con->query($query);
		$cita = $sentencia->fetch();
	
	$con=null;
	
	return $cita;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
		
	}

function cargaCitasCliente($dni){
		try{

 	$con = getConexion();
	$mascotas = cargaMascotasUsuario($dni);
	$citas = array();
	foreach ($mascotas as $mascname) {

		$query = "SELECT * FROM CITAS WHERE IDMASCOTA=".$mascname['IDMASCOTA'];
		$sentencia = $con->query($query);
		$cita = $sentencia->fetch();
		if($cita != Array()){
					array_push($citas, $cita);
			
		}
		
	}
	
	$con=null;
	
	return $citas;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
		
	}
	
	function cargaCitasClienteHistorialPersonal($dni){
		try{

 	$con = getConexion();
	$mascotas = cargaMascotasUsuario($dni);
	$citas = array();
	foreach ($mascotas as $mascname) {

		$query = "SELECT * FROM CITAS WHERE FECHAHORA<SYSDATE AND IDMASCOTA=".$mascname['IDMASCOTA'];
		$sentencia = $con->query($query);
		$cita = $sentencia->fetch();
		if($cita != Array()){
					array_push($citas, $cita);
			
		}
		
	}
	
	$con=null;
	
	return $citas;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
		
	}
	
	function cargaCitasClienteProximas($dni){
		try{

 	$con = getConexion();
	$mascotas = cargaMascotasUsuario($dni);
	$citas = array();
	foreach ($mascotas as $mascname) {

		$query = "SELECT * FROM CITAS WHERE FECHAHORA>SYSDATE AND IDMASCOTA=".$mascname['IDMASCOTA'];
		$sentencia = $con->query($query);
		$cita = $sentencia->fetch();
		if($cita != Array()){
					array_push($citas, $cita);
			
		}
		
	}
	
	$con=null;
	
	return $citas;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
		
	}
	
	
	
	function cargaCitasPorIdMascotaHistorial($idMascota){
		try{

 	$con = getConexion();
	
		$query = "SELECT * FROM CITAS WHERE FECHAHORA<SYSDATE AND IDMASCOTA=".$idMascota;
		$sentencia = $con->query($query);
		$cita = $sentencia->fetchAll();
	
	$con=null;
	
	return $cita;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
		
	}
	
	function cargaCitasPorIdMascota($idMascota){
		try{

 	$con = getConexion();
	
		$query = "SELECT * FROM CITAS WHERE IDMASCOTA=".$idMascota;
		$sentencia = $con->query($query);
		$cita = $sentencia->fetchAll();
	
	
	$con=null;
	
	return $cita;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
		
	}
	
	function cargaProximasCitasPersonal($dni){
		try{

 	$con = getConexion();
	$idPersonal = getIdPersonal($dni);
	$query = "SELECT * FROM CITAS WHERE FECHAHORA>SYSDATE AND IDPERSONAL=".$idPersonal;
	$sentencia = $con->query($query);
	$citas = $sentencia->fetchAll();
	$con=null;
	return $citas;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
	}
	
	function cargaProximasCitasPersonalLimitado($dni){
		try{

 	$con = getConexion();
	$idPersonal = getIdPersonal($dni);
	$query = "SELECT * FROM (SELECT * FROM CITAS WHERE FECHAHORA>SYSDATE AND IDPERSONAL=".$idPersonal.") WHERE ROWNUM < 5";
	$sentencia = $con->query($query);
	$citas = $sentencia->fetchAll();
	$con=null;
	return $citas;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
	}
	
		function cargaCitasClienteFacturas($dni){
		try{

 	$con = getConexion();
	$mascotas = cargaMascotasUsuario($dni);
	$citas = array();
	foreach ($mascotas as $mascname) {

		$query = "SELECT * FROM CITAS WHERE FECHAHORA<SYSDATE AND IDMASCOTA=".$mascname['IDMASCOTA'];
		$sentencia = $con->query($query);
		$cita = $sentencia->fetch();
		if($cita != Array()){
					array_push($citas, $cita);
			
		}
		
	}
	
	$con=null;
	
	return $citas;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
	}
	
	function cargaCitasPersonalFacturas(){
		try{

 	$con = getConexion();
	$query = "SELECT * FROM CITAS WHERE FECHAHORA<SYSDATE";
	$sentencia = $con->query($query);
	$citas = $sentencia->fetchAll();
	$con=null;
	return $citas;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
	}

	function getIdClientePorIdCita($idCita){
			try{

 	$con = getConexion();
	$query = "SELECT * FROM CITAS WHERE IDCITA=".$idCita;
	$sentencia = $con->query($query);
	$citas = $sentencia->fetch();
	$query = "SELECT * FROM MASCOTAS WHERE IDMASCOTA=".$citas['IDMASCOTA'];
	$sentencia = $con->query($query);
	$idCliente = $sentencia->fetch();
	$con=null;
	return $idCliente['IDCLIENTE'];
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
	}
	

?>