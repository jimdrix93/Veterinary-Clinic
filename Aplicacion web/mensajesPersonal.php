<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css"  href="estilos/estilo_mensajesPersonal.css" />
		<link type='image/png' href="imagenes/logo.png" rel="shortcut icon">
		<title>Bandeja de entrada</title>
		<?php
		include ('funciones.php');
		session_start();
		if (isset($_SESSION['dni'])) {

			$dni = $_SESSION['dni'];

		} else {
			header('Location: index.php');

		}if(isset($_REQUEST['idMsg']) && $_REQUEST['idMsg'] != ""){
			marcaMensajeComoLeido($_REQUEST['idMsg']);
		}
		?>
	</head>
	<body>
			<?php 
		$tipoPersonal = cargaTipoPuestoPersonal($dni);
		$mensajes = cargaMensajesPersonal($dni);
	?>
		<div id="logo">
			<a href="principalPersonal.php" title="Volver a la página principal."><img src="imagenes/logo_transparente.png" /></a>
		</div>
		<div id="bienvenida">
			<h1>Bandeja de entrada</h1>
		</div>
		<div id="cerrarSesion">
			<button id="botonCerrarSesion" onclick="window.location='index.php'">
				Cerrar sesión
			</button>
		</div>
		<div id="menu">
			<table border="">
				<tr>
					<td class="inicioFondo"><a href="principalPersonal.php" class="inicioLetras" title="Volver a la página principal." style="width:100%; display:block">Inicio</a></td>
					<td class="perfilFondo"><a href="perfilPersonal.php" class="perfilLetras" title="Acceder a mas información de tu perfil." style="width:100%; display:block">Perfil</a></td>
					<td class="citasFondo"><a href="citasPersonal.php" class="citasLetras" title="Observar todas las citas que tiene asignadas." style="width:100%; display:block">Citas</a></td>
							<?php
					if($tipoPersonal!="Recepcionista"){
						echo	'<td class="historialFondo"><a href="historialPersonal.php" class="historialLetras" title="Observar los historiales de las mascotas." style="width:100%; display:block">Historial clínico</a></td>';
									
					}
					?>
					
					
					<td class="mensajesFondo"><a href="mensajesPersonal.php" class="mensajesLetras" title="Acceder a su bandeja de entrada." style="width:100%; display:block">Mensajes</a></td>
					<?php 
					if($tipoPersonal=="Recepcionista"){
						echo	'<td class="facturasFondo"><a href="facturasPersonal.php" class="facturasLetras" title="Accede a todas las pendientes." style="width:100%; display:block">Facturas</a></td>';
						echo    '<td class="administracionFondo"><a href="administracionPersonal.php" class="administracionLetras" title="Accede a las opciones de administración de la clínica." style="width:100%; display:block">Administración</a></td>';			
					}
					?>
				</tr>
			</table>
		</div>
		<div id="botones">
			<div id="botonEscribirMensaje">
				<button onclick="window.location='escribirMensajePersonal.php'">
					Escribir mensaje
				</button>
			</div>
			<div id="botonBandejaEntrada">
				<button onclick="window.location='mensajesPersonal.php'">
					Refrescar
				</button>
			</div>
			</div>
		<div id="tablaMensajes">
			<table border=""> 
				<tr>
					<th>Asunto: </th>
					<th>De: </th>
					<th>Texto: </th>
					<th>Fecha: </th>
				</tr>
				
					<?php foreach ($mensajes as $msg) {
							
						$apellidosCliente = cargaApellidosClienteDeID($msg['IDCLIENTE']);
						$nombreCliente = $apellidosCliente.", ".cargaNombreClienteDeID($msg['IDCLIENTE']);
						$fechaHora = substr($msg['FECHAHORA'], 0, strlen($msg['FECHAHORA']) - 10);
						if($msg['LEIDO'] == 0){
						?>
						
					<tr>	
					<td><b><a href="mensajesPersonal.php?idMsg=<?php echo $msg['IDMENSAJE'];?>"><?php echo $msg['ASUNTO']; ?></a></b></td>
					<td><b><a href="mensajesPersonal.php?idMsg=<?php echo $msg['IDMENSAJE'];?>"><?php echo $nombreCliente; ?></b></a></td>
					<td><b><a href="mensajesPersonal.php?idMsg=<?php echo $msg['IDMENSAJE'];?>"><?php echo $msg['TEXTO']; ?></b></a></td>
					<td><b><a href="mensajesPersonal.php?idMsg=<?php echo $msg['IDMENSAJE'];?>"><?php echo $fechaHora; ?></b></a></td>
					</tr>
					<?php }else{?>
						
						<tr>	
					<td><?php echo $msg['ASUNTO']; ?></td>
					<td><?php echo $nombreCliente; ?></td>
					<td><?php echo $msg['TEXTO']; ?></td>
					<td><?php echo $fechaHora; ?></td>
					</tr>
						
					<?php }
					} ?>
				
			</table>
		</div>
	</body>
</html>

