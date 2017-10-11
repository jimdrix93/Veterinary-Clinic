<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css"  href="estilos/estilo_altaPersonal.css" />
		<link type='image/png' href="imagenes/logo.png" rel="shortcut icon">
		<title>Alta personal</title>
		<?php
		include ('funciones.php');
		session_start();
		if (isset($_SESSION['dni'])) {

			$dni = $_SESSION['dni'];

		} else {
			header('Location: index.php');

		}if(isset($_REQUEST['inputDni']) && $_REQUEST['inputDni'] != "" && isset($_REQUEST['inputNombre']) && $_REQUEST['inputNombre'] != "" && isset($_REQUEST['inputApellidos']) && $_REQUEST['inputApellidos'] != "" && isset($_REQUEST['inputDireccion']) && $_REQUEST['inputDireccion'] != "" && isset($_REQUEST['inputTelefono']) && $_REQUEST['inputTelefono'] != "" && isset($_REQUEST['inputContrasenaNueva']) && $_REQUEST['inputContrasenaNueva'] != "" && isset($_REQUEST['selectPuestoTrabajo']) && $_REQUEST['selectPuestoTrabajo'] != ""){
		
		$_SESSION['errorPersonal'] = creaPersonal($_REQUEST['inputDni'], $_REQUEST['inputNombre'], $_REQUEST['inputApellidos'], $_REQUEST['inputDireccion'], $_REQUEST['inputTelefono'], $_REQUEST['inputContrasenaNueva'], $_REQUEST['selectPuestoTrabajo']);
		}
		if(isset($_SESSION['errorPersonal']) && $_SESSION['errorPersonal'] != 1){
			$error = "No se ha podido crear el personal. Inténtelo de nuevo.";
		}
		if(isset($_SESSION['exitoPersonal']) && $_SESSION['exitoPersonal'] == 1){
			$exito= "Se ha creado el personal con exito";
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
			<h1>Alta personal</h1>
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
		<div id="formularioAltaPersonal">
			<form method="post" id="formAltaPersonal" onsubmit="return validacion()" action="altaPersonal.php">
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
					<div id="campoPuestoTrabajo">
						<b>Puesto de trabajo: </b>
					</div>
					<div id="campoTelefono">
						<b>Teléfono: </b>
					</div>
				</div>
				<div id="datos">
					<div id="datoDni">
						<input type="text" id="inputDni" class="inputDni" name="inputDni" maxlength="9" required="required"/>
						<sub>Ejemplo: 12345678A</sub>
					</div>
					<div id="datoNombre">
						<input type="text" id="inputNombre" class="inputNombre" name="inputNombre" required="required" />
					</div>
					<div id="datoApellidos">
						<input type="text" id="inputApellidos" class="inputApellidos" name="inputApellidos" required="required" />
					</div>
					<div id="datoDireccion">
						<input type="text" id="inputDireccion" class="inputDireccion" name="inputDireccion"  />
					</div>
					<div id="datoPuestoTrabajo">
						<select id="selectPuestoTrabajo" name="selectPuestoTrabajo" class="selectPuestoTrabajo">
							<option id="optionPorDefecto" title="optionPorDefecto" value="optionPorDefecto">Selecciona un puesto de trabajo</option>
							<option id="optionRecepcionista" title="optionRecepcionista" value="Recepcionista">Recepcionista</option>
							<option id="optionVeterinario" title="optionVeterinario" value="Veterinario">Veterinario</option>
							<option id="optionPeluquero" title="optionPeluquero" value="Peluquero">Peluquero</option>
						</select>
					</div>
					<div id="datoTelefono">
						<input type="text" maxlength="9" id="inputTelefono" class="inputTelefono" name="inputTelefono" onkeypress="return soloNumeros(event)" />
					</div>
				</div>
				<div id="contrasena">
					<div id="camposContrasena">
						<div id="campoContrasenaNueva">
							<b>Escriba su nueva contraseña: </b>
						</div>
						<div id="campoContrasenaConfirmada">
							<b>Escriba de nuevo su nueva contraseña: </b>
						</div>
					</div>
					<div id="datosContrasena">
						<div id="datoContrasenaNueva">
							<input type="password" id="inputContrasenaNueva" class="inputContrasenaNueva" name="inputContrasenaNueva" />
						</div>
						<div id="datoContrasenaConfirmada">
							<input type="password" id="inputContrasenaConfirmada" class="inputContrasenaConfirmada" name="inputContrasenaConfirmada" />
						</div>
					</div>
				</div>
				<div id="submit">
					<input type="submit" id="botonSubmit" class="botonSubmit" name="botonSubmit" value="Dar de alta" onclick="return validacion()"/>
				</div>
				<div id="errorPersonal">
				<?php if(isset($error)){
					echo $error;
				}?>
			</div>
			<div id="exitoPersonal">
				<?php if(isset($exito)){
					echo $exito;
				}?>
			</div>
			</form>
		</div>
		
		<script>
			function validacion() {

			valor = document.getElementById("inputDni").value;

				if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {

					alert('[ERROR] El campo dni no debe estar vacio');

					return false;

				}
				
				var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];

				if (!(/^\d{8}[A-Z]$/.test(valor))) {
					alert('[ERROR]El tamaño del dni no es correcto');

					return false;
					
				}

				if (valor.charAt(8) != letras[(valor.substring(0, 8)) % 23]) {
					alert('[ERROR] El numero de dni no es correcto');
					return false;
					

				}
	
	
			valor = document.getElementById("inputNombre").value;

				if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {

					alert('[ERROR] El campo nombre no debe estar vacio');

					return false;
				}
				
			valor = document.getElementById("inputApellidos").value;

				if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {

					alert('[ERROR] El campo apellidos no debe estar vacio');

					return false;
				}
				
			valor = document.getElementById("inputDireccion").value;

				if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {

					alert('[ERROR] El campo apellidos no debe estar vacio');

					return false;
				}				

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

