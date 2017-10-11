<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

	<head>
		<title>Formulario Enviar Mensaje</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" type="text/css"  href="estilos/estilo_escribirMensajePersonal.css" />
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
			$dniCliente = $_REQUEST['selectCliente'];
	
			$mensaje = creaMensaje($dniCliente, $dni ,$_REQUEST['inputAsunto'],$_REQUEST['inputMensaje']);
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
		<?php $clientes = cargaClientes();
		?>
		
	
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
					echo '<td class="administracionFondo"><a href="administracionPersonal.php" class="administracionLetras" title="Accede a las opciones de administración de la clínica." style="width:100%; display:block">Administración</a></td>';}
					?>
				</tr>
			</table>
		</div>

		<div id="div_form">

			<form method="post" action="escribirMensajePersonal.php" onsubmit="return validacionEscribirMensaje()">
				<table>

					<div id="div_selecciona_usuario">

						<fieldset>

							<legend>
								Seleccione cliente de la clínica
							</legend>

							<div id="div_selecciona_personal">
								<label id="label_selecciona_personal" for="selectCliente">Nombre:</label>
								<select id="selectCliente" name="selectCliente" class="selectCliente">
									<option id="optionPorDefecto" title="optionPorDefecto" value="optionPorDefecto">Selecciona un cliente</option>
									<?php
										foreach ($clientes as $fila2){
											foreach ($fila2 as $fila3) {
												
											
									?>
									<option id="<?php echo $fila3["DNI"]; ?>" title="<?php echo $fila3["NOMBRE"];?>" value="<?php echo $fila3["DNI"];?>"><?php echo $fila3["APELLIDOS"].", ".$fila3["NOMBRE"];?></option>
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
								Datos del mensaje
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
				<div id="errorMensaje">
				<?php if(isset($error)){
					echo $error;
				}?>
			</div>
				<div id="exitoMensaje">
				<?php if(isset($exito)){
					echo $exito;?>
					<script type="text/javascript">
		function redireccionar(){
  		window.location="mensajesPersonal.php";
		} 
		setTimeout ("redireccionar()", 5000); //tiempo expresado en milisegundos
</script>
					
			<?php	}?>
			</div>
				</table>

			</form>

		</div>
	</body>

</html>
