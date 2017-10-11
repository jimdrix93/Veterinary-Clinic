<?php
	
	function compruebaDNI($dni){
		try{
	$isDNI = FALSE;
 	$con = getConexion();
	$query = "SELECT * FROM usuarios WHERE DNI='".$dni."'";
	$sentencia = $con->query($query);
	$cliente = $sentencia->fetch();
	if($cliente != Array()){
		$isDNI = TRUE;
	}
	$con=null;
	return $isDNI;
	
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
	}

	function compruebaLogin($dni, $pass){
		try{
	$login = FALSE;
 	$con = getConexion();
	$query = "SELECT * FROM usuarios WHERE DNI='".$dni."'";
	$sentencia = $con->query($query);
	$cliente = $sentencia->fetch();
		$con=null;
	if($cliente['CONTRASENA']==$pass){
		$login = TRUE;
		
	}
	return $login;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}

	}
	
		function compruebaCliente($dni){
	try{
	$isPersonal = FALSE;
 	$con = getConexion();
	$query = "SELECT COUNT(*) FROM clientes WHERE DNI='".$dni."'";
	$sentencia = $con->query($query);
	$personal = $sentencia->fetch();
	if($personal[0] > 0){
		$isPersonal = TRUE;
	}
	$con=null;
	return $isPersonal;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}
	
	function compruebaPersonal($dni){
	try{
	$isPersonal = FALSE;
 	$con = getConexion();
	$query = "SELECT COUNT(*) FROM personal WHERE DNI='".$dni."'";
	$sentencia = $con->query($query);
	$personal = $sentencia->fetch();
	if($personal[0] > 0){
		$isPersonal = TRUE;
	}
	$con=null;
	return $isPersonal;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}

	function cargaTipoPuestoPersonal($dni){
		try{
 	$con = getConexion();
	$query = "SELECT * FROM personal WHERE DNI='".$dni."'";
	$sentencia = $con->query($query);
	$tipoPersonal = $sentencia->fetch();
	
	$con=null;
	return $tipoPersonal['TIPOPERSONAL'];
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}

	function getIdCliente($dni){
		try{

 	$con = getConexion();
	$query = "SELECT TRADUCE_DNI_IDCLIENTE('".$dni."') FROM DUAL";
	$sentencia = $con->query($query);
	$idCliente = $sentencia->fetch();
	$con=null;
	return $idCliente[0];
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
	}	
	
	function getIdPersonal($dni){
		try{

 	$con = getConexion();
	$query = "SELECT TRADUCE_DNI_IDPERSONAL('".$dni."') FROM DUAL";
	$sentencia = $con->query($query);
	$idPersonal = $sentencia->fetch();
	$con=null;
	return $idPersonal[0];
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
	}
	
	function getIdClientePorIDMascota($idMascota){
		try{

 	$con = getConexion();
	$query = "SELECT * FROM mascotas WHERE IDMASCOTA=".$idMascota;
	$sentencia = $con->query($query);
	$idCliente = $sentencia->fetch();
	$con=null;
	return $idCliente[1];
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
	}	
	
	function cargaNombreUsuario($dni){
 	try{
 		
 	$con = getConexion();
	$query = "SELECT * FROM usuarios WHERE DNI='".$dni."'";
	$sentencia = $con->query($query);
	$fila = $sentencia->fetch();

	$con=null;
	return $fila['NOMBRE'];
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
	}
	
		function cargaApellidosUsuario($dni){
 	try{
 		
 	$con = getConexion();
	$query = "SELECT * FROM usuarios WHERE DNI='".$dni."'";
	$sentencia = $con->query($query);
	$fila = $sentencia->fetch();

	$con=null;
	return $fila['APELLIDOS'];
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
	}
	
	function cargaNombreClienteDeID($idCliente){
		try{
 		
 	$con = getConexion();
	$query = "SELECT * FROM clientes WHERE IDCLIENTE=".$idCliente;
	$sentencia = $con->query($query);
	$fila = $sentencia->fetch();
	
	$con=null;
	return cargaNombreUsuario($fila['DNI']);
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
	}
	
	function cargaApellidosClienteDeID($idCliente){
		try{
 		
 	$con = getConexion();
	$query = "SELECT * FROM clientes WHERE IDCLIENTE=".$idCliente;
	$sentencia = $con->query($query);
	$fila = $sentencia->fetch();
	
	$con=null;
	return cargaApellidosUsuario($fila['DNI']);
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
	}
	
	function cargaNombrePersonalDeID($idPersonal){
		try{
 		
 	$con = getConexion();
	$query = "SELECT * FROM personal WHERE IDPERSONAL=".$idPersonal;
	$sentencia = $con->query($query);
	$fila = $sentencia->fetch();
	
	$con=null;
	return cargaNombreUsuario($fila['DNI']);
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
	}
	
		function cargaApellidosPersonalDeID($idPersonal){
		try{
 		
 	$con = getConexion();
	$query = "SELECT * FROM personal WHERE IDPERSONAL=".$idPersonal;
	$sentencia = $con->query($query);
	$fila = $sentencia->fetch();
	
	$con=null;
	return cargaApellidosUsuario($fila['DNI']);
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
	}
	
	function cargaDatosUsuario($dni){
	
	try{
 		
 	$con = getConexion();
	$query = "SELECT * FROM usuarios WHERE DNI='".$dni."'";
	$sentencia = $con->query($query);
	$fila = $sentencia->fetch();

	$con=null;
	return $fila;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
	}
	
	function cargaPersonal(){
	
	try{
 		
 	$con = getConexion();
	$query = "SELECT * FROM PERSONAL";
	$stmt= $con->query($query);
	$stmt = $stmt->fetchAll();
	$stmt2 = Array();
	foreach ($stmt as $fila){
		$dniPersonal = $fila["DNI"];
		$query2 = "SELECT * FROM USUARIOS WHERE DNI='".$dniPersonal."'";
		$stmt3 = $con->query($query2);
		$stmt3 = $stmt3->fetchAll();
		array_push($stmt2, $stmt3);
	}
	$con=null;
	return $stmt2;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
	}
	
	function cargaClientes(){
	
	try{
 		
 	$con = getConexion();
	$query = "SELECT * FROM CLIENTES";
	$stmt= $con->query($query);
	$stmt = $stmt->fetchAll();
	$stmt2 = Array();
	foreach ($stmt as $fila){
		$dniCliente = $fila["DNI"];
		$query2 = "SELECT * FROM USUARIOS WHERE DNI='".$dniCliente."'";
		$stmt3 = $con->query($query2);
		$stmt3 = $stmt3->fetchAll();
		array_push($stmt2, $stmt3);
	}
	$con=null;
	return $stmt2;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
	}
	
	function creaCliente($dni, $nombre, $apellidos, $direccion, $telefono, $contrasena){
			try{

 	$con = getConexion();
	$query = "BEGIN DAR_ALTA_CLIENTE(:dni,:nombre,:apellidos,:direccion,:telefono,:contrasena); END;";
	$sentencia = $con->prepare($query);
	$sentencia->bindParam(':dni',$dni);
	$sentencia->bindParam(':nombre',$nombre);
	$sentencia->bindParam(':apellidos',$apellidos);
	$sentencia->bindParam(':direccion',$direccion);
	$sentencia->bindParam(':telefono',$telefono);
	$sentencia->bindParam(':contrasena',$contrasena);
	$crea = $sentencia->execute();
	$con=null;
	return $crea;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}
	
	function creaPersonal($dni, $nombre, $apellidos, $direccion, $telefono, $contrasena, $tipoPersonal){
			try{

 	$con = getConexion();
	$query = "BEGIN DAR_ALTA_PERSONAL(:dni,:nombre,:apellidos,:direccion,:telefono,:contrasena,:tipo); END;";
	$sentencia = $con->prepare($query);
	$sentencia->bindParam(':dni',$dni);
	$sentencia->bindParam(':nombre',$nombre);
	$sentencia->bindParam(':apellidos',$apellidos);
	$sentencia->bindParam(':direccion',$direccion);
	$sentencia->bindParam(':telefono',$telefono);
	$sentencia->bindParam(':contrasena',$contrasena);
	$sentencia->bindParam(':tipo',$tipoPersonal);
	$crea = $sentencia->execute();
	$con=null;
	return $crea;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}
	
	function actualizaDireccionUsuario($dni,$direccion){
			try{

 	$con = getConexion();
	$query = "BEGIN ACTUALIZAR_DIRECCION_USUARIO(:dni,:direccion); END;";
	$sentencia = $con->prepare($query);
	$sentencia->bindParam(':dni',$dni);
	$sentencia->bindParam(':direccion',$direccion);
	$actualiza = $sentencia->execute();
	$con=null;
	return $actualiza;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}
	
	
	function actualizaTelefonoUsuario($dni,$telefono){
			try{

 	$con = getConexion();
	$query = "BEGIN ACTUALIZAR_TELEFONO_USUARIO(:dni,:telefono); END;";
	$sentencia = $con->prepare($query);
	$sentencia->bindParam(':dni',$dni);
	$sentencia->bindParam(':telefono',$telefono);
	$actualiza = $sentencia->execute();
	$con=null;
	return $actualiza;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}
	
    function actualizaContrasenaUsuario($dni,$contrasena){
			try{

 	$con = getConexion();
	$passOK = FALSE;
	$query = "SELECT * FROM usuarios WHERE DNI='".$dni."'";
	$sentencia = $con->query($query);
	$cliente = $sentencia->fetch();
	if($cliente['CONTRASENA']==$contrasena){
		$passOK = TRUE;
		
	}if($passOK){	
	$query = "BEGIN ACTUALIZAR_CONTRASENA_USUARIO(:dni,:contrasena); END;";
	$sentencia = $con->prepare($query);
	$sentencia->bindParam(':dni',$dni);
	$sentencia->bindParam(':contrasena',$contrasena);
	$actualiza = $sentencia->execute();
	$con=null;
	return $actualiza;
	}
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}
	
	function eliminaUsuario($dni){
			try{

 	$con = getConexion();
	$query = "BEGIN ELIMINAR_USUARIO(:dni); END;";
	$sentencia = $con->prepare($query);
	$sentencia->bindParam(':dni',$dni);
	$elimina = $sentencia->execute();
	$con=null;
	return $elimina;
 	}catch(PDOException $e){
		echo "Error: ".$e->GetMessage();
		}
		
	}


?>