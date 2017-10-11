<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
	<head>
		<link rel="stylesheet" type="text/css" href="estilos/VistaMensajes.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>VistaMensajes</title>
		<meta name="author" content="fjavier" />
		<!-- Date: 2014-05-09 -->
		
		<div id="logo">
			<a href="VistaPrincipal.php" title="Volver a la página principal."><img src="imagenes/logo_transparente.png" /></a>
		</div>
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
		$mensajes = cargaMensajesCliente($dni);
		?>
		<div id="bienvenida">
			<h1>Mensajes</h1>
		</div>
		<div id="botonCerrarSesion">
			<button onclick="window.location='index.php'">
				Cerrar sesión
			</button>
		</div>
		<div id="menu">
			<table border="">
				<tr>
					<td class="inicioFondo"><a href="VistaPrincipal.php" class="inicioLetras" title="Acceder a la pantalla de inicio.">Inicio</a></td>
					<td class="perfilFondo"><a href="VistaPerfil.php" class="perfilLetras" title="Acceder a mas información de tu perfil.">Perfil</a></td>
					<td class="citasFondo"><a href="VistaCitas.php" class="citasLetras" title="Observar todas las citas que tiene asignadas.">Citas</a></td>
					<td class="mascotasFondo"><a href="VistaMascotas.php" class="historialLetras" title="Observar los historiales de las mascotas.">Mascotas</a></td>
					<td class="mensajesFondo"><a href="VistaMensajes.php" class="mensajesLetras" title="Acceder a su bandeja de entrada.">Mensajes</a></td>
					<td class="facturasFondo"><a href="VistaFacturas.php" class="facturasLetras" title="Accede a todas las pendientes.">Facturas</a></td>
				</tr>
			</table>
		</div>	
		
		<div id="botones">
			<div id="botonEscribirMensaje">
				<button onclick="window.location='escribirMensajeCliente.php'">
					Escribir mensaje
				</button>
			</div>
			<div id="botonBandejaEntrada">
				<button onclick="window.location='VistaMensajes.php'">
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
												
						$apellidosPersonal = cargaApellidosPersonalDeID($msg['IDCLIENTE']);
					

						$nombrePersonal = $apellidosPersonal.", ".cargaNombrePersonalDeID($msg['IDCLIENTE']);
						$fechaHora = substr($msg['FECHAHORA'], 0, strlen($msg['FECHAHORA']) - 10);
						if($msg['LEIDO'] == 0){
						?>
					<tr>	
					<td><b><a href="VistaMensajes.php?idMsg=<?php echo $msg['IDMENSAJE'];?>"><?php echo $msg['ASUNTO']; ?></a></b></td>
					<td><b><a href="VistaMensajes.php?idMsg=<?php echo $msg['IDMENSAJE'];?>"><?php echo $nombrePersonal; ?></a></b></td>
					<td><b><a href="VistaMensajes.php?idMsg=<?php echo $msg['IDMENSAJE'];?>"><?php echo $msg['TEXTO']; ?></a></b></td>
					<td><b><a href="VistaMensajes.php?idMsg=<?php echo $msg['IDMENSAJE'];?>"><?php echo $fechaHora; ?></a></b></td>
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

