<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>

		<link rel="stylesheet" type="text/css" href="estilos/VistaEditarPerfil.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>VistaPerfil</title>

		<?php
	include ('funciones.php');
	session_start();
	if (isset($_SESSION['dni'])) {

		$dni = $_SESSION['dni'];

	} else {
		header('Location: index.php');
	}
					if(isset($_REQUEST['inputDireccion']) && $_REQUEST['datoDireccion'] != ""){
			
		 $_SESSION['errorCliente']=actualizaDireccionUsuario($dni,$_REQUEST['datoDireccion']);
		 
		}
		if(isset($_REQUEST['inputDireccion']) && $_REQUEST['datoDireccion'] != ""){
					 	
						
		$_SESSION['errorCliente']=actualizaTelefonoUsuario($dni,$_REQUEST['datoTelefono']);
			
		}if(isset($_REQUEST['inputDireccion']) && $_REQUEST['datoDireccion'] != ""){
			
		$_SESSION['errorCliente']=actualizaContrasenaUsuario($dni,$_REQUEST['datoContrasenaNueva']);
			
			
			}
		
		if(isset($_SESSION['errorCliente']) && $_SESSION['errorCliente'] != 1){
			$error = "No se ha podido crear el cliente. Inténtelo de nuevo.";
		}
		if(isset($_SESSION['errorCliente']) && $_SESSION['errorCliente'] == 1){
			$exito= "Se ha creado el cliente con exito";
		}
		?>
		<div id="logo">
			<a href="VistaPrincipal.php" title="Volver a la página principal."><img src="imagenes/logo_transparente.png" /></a>
		</div>
	</head>
	<body>
		<?php $user = cargaDatosUsuario($dni);
		$tipoPersonal = cargaTipoPuestoPersonal($dni);
		?>
		<div id="bienvenida">
			<h1>Editar perfil</h1>
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

		<form method="post" action="VistaEditarPerfil.php" onsubmit="return validacion()">
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
					<input type="text" class="datoDireccion" name="datoDireccion" value="<?php echo $user['DIRECCION']; ?>" />
				</div>

				<div id="datoTelefono">
					<input type="tel" class="datoTelefono" name="datoTelefono" value="<?php echo $user['TELEFONO']; ?>" />

				</div>
			</div>
			<div id="contrasena">
				<fieldset>
					<legend>
						<b>Modificar contrasena</b>
					</legend>
					<div id="camposContrasena">
						<div id="campoContrasenaActual">
							<b>Escriba su contrasena actual: </b>
						</div>
						<div id="campoContrasenaNueva">
							<b>Escriba su nueva contrasena: </b>
						</div>
						<div id="campoContrasenaConfirmada">
							<b>Escriba de nuevo su nueva contrasena: </b>
						</div>
					</div>
					<div id="datosContrasena">
						<div id="datoContrasenaAcual">
							<input type="password" class="datoContrasenaActual" name="datoContrasenaActual" />
						</div>
						<div id="datoContrasenaNueva">
							<input type="password" class="datoContrasenaNueva" name="datoContrasenaNueva" />
						</div>
						<div id="datoContrasenaConfirmada">
							<input type="password" class="datoContrasenaConfirmada" name="datoContrasenaConfirmada" />
						</div>
					</div>
				</fieldset>
			</div>
			<div id="submit">
				<input type="submit" class="submit" name="submit" value="Guardar"/>
			</div>
			
				<div id="errorCliente">
				<?php if(isset($error)){
					echo $error;
				}?>
			</div>
			<div id="exitoCliente">
				<?php if(isset($exito)){
					echo $exito;
				}?>
			</div>
		</form>

		<script>
			function validacion() {

				valor = document.getElementById("datoDireccionBox").value;

				if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {

					alert('[ERROR] El campo direccion no debe estar vacio');

					return false;

				}

				valor = document.getElementById("datoTelefonoBox").value;

				if (valor == null || valor.length == 0 || !(/^\d{9}$/.test(valor))) {

					alert('[ERROR] El campo telefono es incorrecto');

					return false;

				}

				valor1 = document.getElementById("datoContraseñaNuevaBox").value;

				valor2 = document.getElementById("datoContraseñaConfirmadaBox").value;

				if (valor1 != valor2 || /^\s+$/.test(valor) || valor1 == null) {

					alert('[ERROR] El campo contraseña nueva no es correcto');

					return false;

				}

				valor = document.getElementById("datoContraseñaConfirmadaBox").value;

			}

		</script>

	</body>
</html>

