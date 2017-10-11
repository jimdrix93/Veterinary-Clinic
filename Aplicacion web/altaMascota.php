<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css"  href="estilos/estilo_altaMascota.css" />
		<link type='image/png' href="imagenes/logo.png" rel="shortcut icon">
		<title>Alta mascota</title>
		<?php
		include ('funciones.php');
		session_start();
		if (isset($_SESSION['dni'])) {

			$dni = $_SESSION['dni'];

		} else {
			header('Location: index.php');

		}
		$tipoPersonal = cargaTipoPuestoPersonal($dni);
		if(isset($_REQUEST['inputDni']) && $_REQUEST['inputDni'] != "" && isset($_REQUEST['inputNombreMascota']) && $_REQUEST['inputNombreMascota'] != "" && isset($_REQUEST['inputRaza']) && $_REQUEST['inputRaza'] != "" && isset($_REQUEST['inputTipoMascota']) && $_REQUEST['inputTipoMascota'] != "" ){
			
		
			$_SESSION['errorMascota'] = creaMascota($_REQUEST['inputTipoMascota'],$_REQUEST['inputRaza'],$_REQUEST['inputNombreMascota'],$_REQUEST['inputDni']);
			
				if(isset($_SESSION['errorMascota']) && $_SESSION['errorMascota'] != 1){
			$error = "No se ha podido crear la mascota. Inténtelo de nuevo.";
		}
		if(isset($_SESSION['errorMascota']) && $_SESSION['errorMascota'] == 1){
			$exito= "Se ha creado la mascota con exito";
		}
		};
		?>
		<div id="logo">
			<a href="principalPersonal.php" title="Volver a la página principal."><img src="imagenes/logo_transparente.png" /></a>
		</div>
	</head>
	<body>
		
		<div id="bienvenida">
			<h1>Alta mascota</h1>
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
		<div id="formularioAltaMascota">
			<form method="post" id="formAltaMascota" onsubmit="" action="altaMascota.php">
				<div id="campos">
					<div id="campoDniCliente">
						<b>DNI del cliente: </b>
					</div>
					<div id="campoNombreMascota">
						<b>Nombre: </b>
					</div>
					<div id="campoTipoMascota">
						<b>Tipo de mascota: </b>
					</div>
					<div id="campoRaza">
						<b>Raza: </b>
					</div>
				</div>
				<div id="datos">
					<div id="datoDniCliente">
						<input type="text" id="inputDni" class="inputDni" name="inputDni" maxlength="9" required="required"/>
						<sub>Ejemplo: 12345678A</sub>
					</div>
					<div id="datoNombreMascota">
						<input type="text" id="inputNombreMascota" class="inputNombreMascota" name="inputNombreMascota" required="required" />
					</div>
					<div id="datoTipoMascota">
						<input type="radio" id="inputPerro" name="inputTipoMascota" class="inputPerro" value="Perro" />
						Perro
						<input type="radio" id="inputGato" name="inputTipoMascota" class="inputGato" value="Gato" />
						Gato
					</div>
					<div id="datoRaza">
						<input type="text" id="inputRaza" class="inputRaza" name="inputRaza" required="required" />
					</div>
				</div>
				<div id="submit">
					<input type="submit" id="botonSubmit" class="botonSubmit" name="botonSubmit" value="Dar de alta" onclick=""/>
				</div>
			</form>
			<div id="errorMascota">
				<?php if(isset($error)){
					echo $error;
				}?>
			</div>
			<div id="exitoMascota">
				<?php if(isset($exito)){
					echo $exito;
				}?>
			</div>
		</div>
	</body>
</html>

