<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>

		<link rel="stylesheet" type="text/css" href="estilos/VistaPerfil.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>VistaPerfil</title>

		<?php
	include ('funciones.php');
	session_start();
	if (isset($_SESSION['dni'])) {

		$dni = $_SESSION['dni'];

	} else {
		header('Location: index.php');
	}if(isset($_REQUEST['datoDireccion']) && $_REQUEST['datoDireccion'] != ""){
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
			<a href="VistaPrincipal.php" title="Volver a la página principal."><img src="imagenes/logo_transparente.png" /></a>
		</div>
	</head>
	<body>
		<?php $user = cargaDatosUsuario($dni); ?>
		<div id="bienvenida">
			<h1>Perfil</h1>
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
					<td class="historialFondo"><a href="VistaMascotas.php" class="historialLetras" title="Observar los historiales de las mascotas.">Mascotas</a></td>
					<td class="mensajesFondo"><a href="VistaMensajes.php" class="mensajesLetras" title="Acceder a su bandeja de entrada.">Mensajes</a></td>
					<td class="facturasFondo"><a href="VistaFacturas.php" class="facturasLetras" title="Accede a todas las pendientes.">Facturas</a></td>
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
			<div id="campoDireccion">
				<b>Dirección: </b>
			</div>

			<div id="campoTelefono">
				<b>Teléfono: </b>
			</div>
				<div id="botonEditarPerfil">
				<button onclick="window.location='VistaEditarPerfil.php'">
					Editar Perfil
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
			<div id="datoDireccion">
				<?php echo $user['DIRECCION']; ?>
			</div>
			<div id="datoTelefono1">
				<?php echo $user['TELEFONO']; ?>
			</div>
		</div>
		</fieldset>
	
		</div>
		</form>

	</body>
</html>