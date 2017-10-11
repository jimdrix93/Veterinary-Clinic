<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Perfil</title>
		
				<link rel="stylesheet" type="text/css"  href="estilos/estilo_perfilPersonal.css" />
				<link type='image/png' href="imagenes/logo.png" rel="shortcut icon">

		<?php
		include ('funciones.php');
		session_start();
		if (isset($_SESSION['dni'])) {

			$dni = $_SESSION['dni'];

		} else {
			header('Location: index.php');

		}
		if(isset($_REQUEST['datoDireccion']) && $_REQUEST['datoDireccion'] != ""){
			$_SESSION['errorEditar'] = actualizaDireccionUsuario($dni, $_REQUEST['datoDireccion']);
		}
		if(isset($_REQUEST['datoTelefono']) && $_REQUEST['datoTelefono'] != ""){
			$_SESSION['errorEditar'] = actualizaTelefonoUsuario($dni, $_REQUEST['datoTelefono']);
		}
		if(isset($_REQUEST['datoContrasenaActual']) && $_REQUEST['datoContrasenaActual'] != ""){
			$_SESSION['errorEditar'] = actualizaContrasenaUsuario($dni, $_REQUEST['datoContrasenaActual']);
		}
		if(isset($_SESSION['errorEditar']) && $_SESSION['errorEditar'] != 1){
			$error = "No se han podido actualizar sus datos. Inténtelo de nuevo.";
		}
	?>
	<div id="logo">
			<a href="principalPersonal.php" title="Volver a la página principal."><img src="imagenes/logo_transparente.png" /></a>
		</div>
	</head>
	<body>
		<?php $user = cargaDatosUsuario($dni);
		$tipoPersonal = cargaTipoPuestoPersonal($dni);
	?>
		
		<div id="bienvenida">
			<h1>Perfil de <?php echo cargaNombreUsuario($dni); ?></h1>
		</div>
		<div id="botonCerrarSesion">
			<button onclick="window.location='index.php'">
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
						<?php if($tipoPersonal == "Recepcionista"){
					echo '<td class="facturasFondo"><a href="facturasPersonal.php" class="facturasLetras" title="Accede a todas las pendientes." style="width:100%; display:block">Facturas</a></td>';
					echo    '<td class="administracionFondo"><a href="administracionPersonal.php" class="administracionLetras" title="Accede a las opciones de administración de la clínica." style="width:100%; display:block">Administración</a></td>';}
					?>
				</tr>
			</table>
		</div>
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
			
			<div id="campoPuestoTrabajo">
				<b>Puesto de trabajo: </b>
			</div>
			<div id="campoDireccion">
				<b>Dirección: </b>
			</div>
			
			<div id="campoTelefono">
				<b>Teléfono: </b>
			</div>
			<div id="botonEditarPerfil">
				<button onclick="window.location='editarPerfilPersonal.php'">
					Editar perfil
				</button>
			</div>
			<div id="erroreditar">
				<?php if(isset($error)){
					echo $error;
				}?>
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
			
			<div id="datoPuestoTrabajo">
				<?php echo $tipoPersonal; ?>
			</div>
			<div id="datoDireccion">
				<?php echo $user['DIRECCION']; ?>
			</div>
			
			<div id="datoTelefono">
				<?php echo $user['TELEFONO']; ?>
			</div>

		</div>
	</body>
</html>

