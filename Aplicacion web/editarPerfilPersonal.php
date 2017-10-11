<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css"  href="estilos/estilo_editarPerfilPersonal.css" />
		<script type="text/javascript" src="javascript/validacion.js"></script>
		<link type='image/png' href="imagenes/logo.png" rel="shortcut icon">
		<title>Editar perfil</title>
		<?php
		include ('funciones.php');
		session_start();
		if (isset($_SESSION['dni'])) {

			$dni = $_SESSION['dni'];

		} else {
			header('Location: index.php');

		}if(isset($_REQUEST['inputDireccion']) && $_REQUEST['inputDireccion'] != ""){
			
		 $_SESSION['errorPersonal']=actualizaDireccionUsuario($dni,$_REQUEST['inputDireccion']);
		 
		}
		if(isset($_REQUEST['inputDireccion']) && $_REQUEST['inputDireccion'] != ""){
					 	
						
		$_SESSION['errorPersonal']=actualizaTelefonoUsuario($dni,$_REQUEST['inputTelefono']);
			
		}if(isset($_REQUEST['inputDireccion']) && $_REQUEST['inputDireccion'] != ""){
			
		$_SESSION['errorPersonal']=actualizaContrasenaUsuario($dni,$_REQUEST['inputContrasenaNueva']);
			
			
			}
		
		if(isset($_SESSION['errorPersonal']) && $_SESSION['errorPersonal'] != 1){
			echo $error = "No se ha podido cambiar los datos. Inténtelo de nuevo.";
		}
		if(isset($_SESSION['errorPersonal']) && $_SESSION['errorPersonal'] == 1){
			echo $exito= "Se ha creado el cliente con exito";
		}
		
		?>
	</head>
	<body>
		<?php $user = cargaDatosUsuario($dni);
		$tipoPersonal = cargaTipoPuestoPersonal($dni);
		?>
		<div id="logo">
			<a href="principalPersonal.php" title="Volver a la página principal."><img src="imagenes/logo_transparente.png" /></a>
		</div>
		<div id="bienvenida">
			<h1>Editar perfil</h1>
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
		<form method="post" id="form" onsubmit="return validacion()" action="editarPerfilPersonal.php">
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
					<input type="text" id="inputDireccion" class="inputDireccion" name="inputDireccion" value="<?php echo $user['DIRECCION']; ?>" />
				</div>

				<div id="datoTelefono">
					<input type="text" id="inputTelefono" maxlength="9" class="inputTelefono" name="inputTelefono" onkeypress="return soloNumeros(event)" value="<?php echo $user['TELEFONO']; ?>" />

				</div>
			</div>
			<div id="contrasena">
				<fieldset>
					<legend>
						<b>Modificar contraseña</b>
					</legend>
					<div id="camposContrasena">
						<div id="campoContrasenaActual">
							<b>Escriba su contraseña actual: </b>
						</div>
						<div id="campoContrasenaNueva">
							<b>Escriba su nueva contraseña: </b>
						</div>
						<div id="campoContrasenaConfirmada">
							<b>Escriba de nuevo su nueva contraseña: </b>
						</div>
					</div>
					<div id="datosContrasena">
						<div id="datoContrasenaAcual">
							<input type="password" id="inputContrasenaActual" class="inputContrasenaActual" name="inputContrasenaActual" />
						</div>
						<div id="datoContrasenaNueva">
							<input type="password" id="inputContrasenaNueva" class="inputContrasenaNueva" name="inputContrasenaNueva" />
						</div>
						<div id="datoContrasenaConfirmada">
							<input type="password" id="inputContrasenaConfirmada" class="inputContrasenaConfirmada" name="inputContrasenaConfirmada" />
						</div>
					</div>
				</fieldset>
			</div>
			<div id="submit">
				<input type="submit" id="botonSubmit" class="botonSubmit" name="botonSubmit" value="Guardar" onclick="return validacionEditarPerfil()"/>
			</div>
					<div id="errorPersonal">
				<?php if(isset($error)){
					echo $error;
				}?>
			</div>
			<div id="exitoPersonal">
				<?php if(isset($exito)){
					echo $exito;?>
					<script type="text/javascript">
		function redireccionar(){
  		window.location="perfilPersonal.php";
		} 
		setTimeout ("redireccionar()", 5000); //tiempo expresado en milisegundos
		</script>
					
			<?php
				}?>
			</div>
		</form>
		
				<script>
			function validacion() {

	

			valor = document.getElementById("inputTelefono").value;

				if (valor == null || valor.length == 0 || !(/^\d{9}$/.test(valor))) {

					alert('[ERROR] El campo telefono es incorrecto');

					return false;

				}
				
				valor1 = document.getElementById("inputContrasenaNueva").value;

				valor2 = document.getElementById("inputContrasenaConfirmada").value;

				if (valor1 != valor2 || /^\s+$/.test(valor) || valor1 == null) {

					alert('[ERROR] El campo contraseña nueva no es correcto');

					return false;

				}

		</script>
	</body>
</html>

