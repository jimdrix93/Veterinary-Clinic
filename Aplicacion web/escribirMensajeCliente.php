<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

	<head>
		<title>Formulario Enviar Mensaje</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" type="text/css"  href="estilos/escribirMensajeCliente.css" />
		<script type="text/javascript" src="javascript/validacion.js"></script>
		<link type='image/png' href="imagenes/logo.png" rel="shortcut icon">
		
		<?php
		include ('funciones.php');
		session_start();
		if (isset($_SESSION['dni'])) {

			$dni = $_SESSION['dni'];

		} else {
			header('Location: index.php');

		}
		if(isset($_REQUEST['inputAsunto']) && $_REQUEST['inputAsunto'] != ""){
			$dniPersonal = $_REQUEST['selectPersonal'];
			$mensaje = creaMensaje($dni, $dniPersonal ,$_REQUEST['inputAsunto'],$_REQUEST['inputMensaje']);
		}
		if(isset($mensaje) && $mensaje != 1){
			$error = "El mensaje no fue enviado. Inténtelo de nuevo.";
		}
		if(isset($mensaje) && $mensaje == 1){
			$exito = "El mensaje fue enviado.";
			
			
		}
		?>
		<div id="logo">
			<a href="principalPersonal.php" title="Volver a la página principal."><img src="imagenes/logo_transparente.png" /></a>
		</div>
	</head>

	<body>
		<div id="bienvenida">
			<h1>Enviar Mensaje</h1>
		</div>
		<?php $personal = cargaPersonal();
		?>
		
	
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

		<div id="div_form">

			<form method="post" action="escribirMensajeCliente.php" onsubmit="return validacionEscribirMensaje()">
				<table>

					<div id="div_selecciona_usuario">

						<fieldset>

							<legend>
								<b>Seleccione personal de la clínica</b>
							</legend>

							<div id="div_selecciona_personal">
								<label id="label_selecciona_personal" for="selecciona_personal">Nombre:</label>
								<select id="selectPersonal" name="selectPersonal" class="selectPersonal">
									<option id="optionPorDefecto" title="optionPorDefecto" value="optionPorDefecto">Selecciona un personal</option>
									<?php
										foreach ($personal as $fila2){
											foreach ($fila2 as $fila3) {
												
									?>
									<option id="<?php echo $fila3["DNI"]; ?>" title="<?php echo $fila3["NOMBRE"];?>" value="<?php echo $fila3["DNI"];?>"><?php echo $fila3["APELLIDOS"].", ".$fila3["NOMBRE"];	?></option>
									<?php
									}
										}
									?>
								</select>
							</div>

						</fieldset>

					</div>
					<div id="div_mensaje">

						<fieldset>

							<legend>
								<b>Datos del mensaje</b>
							</legend>

							<div id="div_asunto">
								<label id="label_asunto" for="asunto">Asunto:</label>
								<input id="inputAsunto" name="inputAsunto" class="inputAsunto" type="text" maxlength="100" size="100" required="required"/>
							</div>

							<div id="div_mensaje">
								<label id="label_mensaje" for="mensaje">Mensaje:</label>
								<input id="inputMensaje" name="inputMensaje" class="inputMensaje" type="text" maxlength="500" size="500" />
							</div>

						</fieldset>

					</div>
					<br>
					<div id="div_submit" align="left" >
						<input id="submit" type="submit" value="Enviar mensaje" onclick="return validacionEscribirMensaje()"/>
					</div>

				</table>

			</form>

		</div>
	</body>

</html>
