<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css"  href="estilos/estilo_administracionPersonal.css" />
		<link type='image/png' href="imagenes/logo.png" rel="shortcut icon">
		<title>Administración</title>
		<?php
		include ('funciones.php');
		session_start();
		if (isset($_SESSION['dni'])) {

			$dni = $_SESSION['dni'];

		} else {
			header('Location: index.php');

		}
		?>
	</head>
	<body>
		<?php 
		$tipoPersonal = cargaTipoPuestoPersonal($dni);
		?>
		<div id="logo">
			<a href="principalPersonal.php" title="Volver a la página principal."><img src="imagenes/logo_transparente.png" /></a>
		</div>
		<div id="bienvenida">
			<h1>Administración</h1>
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
		<div id="botonesAdministracionAlta">
			<div id="altaCliente">
				<button id="botonAltaCliente" onclick="window.location='altaCliente.php'">Alta cliente</button>
			</div>
			<div id="altaPersonal">
				<button id="botonAltaPersonal" onclick="window.location='altaPersonal.php'">Alta personal</button>
			</div>
			<div id="altaMascota">
				<button id="botonAltaMascota" onclick="window.location='altaMascota.php'">Alta mascota</button>
			</div>
		</div>
		<div id="botonesAdministracionBaja">
			<div id="bajaCliente">
				<button id="botonBajaCliente" onclick="window.location='bajaCliente.php'">Baja cliente</button>
			</div>
			<div id="bajaPersonal">
				<button id="botonBajaPersonal" onclick="window.location='bajaPersonal.php'">Baja personal</button>
			</div>
			<div id="bajaMascota">
				<button id="botonBajaMascota" onclick="window.location='bajaMascota.php'">Baja mascota</button>
			</div>
		</div>
	</body>
</html>

