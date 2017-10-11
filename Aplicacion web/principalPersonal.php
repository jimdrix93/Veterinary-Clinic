<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css"  href="estilos/estilo_principalPersonal.css" />
		<link type='image/png' href="imagenes/logo.png" rel="shortcut icon">
		<title>Página principal de personal de la clínica</title>
		<?php
		include ('funciones.php');
		session_start();
		if (!isset($_SESSION['dni'])) {
			if (compruebaLogin($_SESSION['lgn1'], $_SESSION['lgn2']) && compruebaPersonal($_SESSION['lgn1'])) {
				$_SESSION['dni'] = $_SESSION['lgn1'];
				$dni = $_SESSION['dni'];
			} else {
				$_SESSION['ERRORLOGIN'] = "Introduzca un usuario y contraseña correctos.";
				header('Location: index.php');
			}
		} else {
			$dni = $_SESSION['dni'];

		}
		?>
	</head>
	<body>
		<?php $user = cargaDatosUsuario($dni); ?>
		<?php $tipoPersonal= cargaTipoPuestoPersonal($dni);?>
		<div id="logo">
			<a href="principalPersonal.php" title="Volver a cargar la página."><img src="imagenes/logo_transparente.png" /></a>
		</div>
		<div id="bienvenida">
			<h1>Bienvenido, <?php echo cargaNombreUsuario($dni); ?></h1>
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
		<div id="perfil">
			<fieldset>
				<legend><b>Perfil</b></legend>
				<div id="campos">
					<div id="campoDni">
						<b>DNI: </b>
					</div>
					<div id="campoNombre">
						<b>Nombre: </b>
					</div>
					<div id="campoApellidos">
						<b>Apellidos: </b>
					</div>
					<div id="botonEditarPerfil">
						<button onclick="window.location='editarPerfilPersonal.php'">Editar perfil</button>
					</div>
				</div>
				<div id="datos">
					<div id="datoDni">
						<?php echo $dni; ?> 
					</div>
					<div id="datoNombre">
						<?php echo $user['NOMBRE']; ?>
					</div>
					<div id="datoApellidos">
						<?php echo $user['APELLIDOS']; ?>
					</div>
				</div>
			</fieldset>
		</div>
		<div id="ultimosMensajes">
			<fieldset>
				<legend><b>Ultimos mensajes</b></legend>
				<div id="tablaUltimosMensajes">
					<table border="">
						<tr><td><b>Asunto: </b></td><td><b>De: </b></td><td><b>Fecha: </b></td></tr>
						<?php $mensajes = cargaMensajesPersonalSinLeer($dni);
						foreach ($mensajes as $msg) {
							$nombreCliente = cargaNombreClienteDeID($msg['IDCLIENTE']);
							?>
							<tr><td><?php echo $msg['ASUNTO']; ?></td><td><?php echo $nombreCliente; ?></td><td><?php echo substr($msg['FECHAHORA'], 0, strlen($msg['FECHAHORA']) - 10); ?></td></tr>
						<?php } ?>
						
					</table>
				</div>
			</fieldset>
		</div>
		
		<?php if($tipoPersonal != "Recepcionista"){ ?>
		<div id="proximasCitas">
			<fieldset>
				<legend><b>Próximas citas</b></legend>
				<div id="tablaProximasCitas">
					<table border="">
						<tr><td><b>Mascota: </b></td><td><b>Nombre:</b></td><td><b>Cliente: </b></td><td><b>Fecha: </b></td></tr>
						<?php $citas = cargaProximasCitasPersonalLimitado($dni);
						foreach ($citas as $c) {
							$nombreUsuario = cargaNombreClienteDeID(getIdClientePorIDMascota($c['IDMASCOTA']));
							$nombreMascota = cargaNombreMascota($c['IDMASCOTA']);?>
							<tr><td><?php echo $c['IDMASCOTA']; ?></td><td><?php echo $nombreMascota; ?></td><td><?php echo $nombreUsuario; ?></td><td><?php echo substr($c['FECHAHORA'], 0, strlen($c['FECHAHORA']) - 10); ?></td></tr>
						<?php } ?>
						
					</table>
				</div>
			</fieldset>
		</div>
		<?php } ?>
	</body>
</html>

