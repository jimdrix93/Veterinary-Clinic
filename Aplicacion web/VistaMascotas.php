<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="estilos/VistaMascotas.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>VistaMascotas</title>
		<meta name="author" content="fjavier" />
		<!-- Date: 2014-05-07 -->
		<div id="logo">
			<a href="VistaPrincipal.php" title="Volver a la página principal."><img src="imagenes/logo_transparente.png" /></a>
		</div>
		<?php include('funciones.php'); 
		session_start();
		if(isset($_SESSION['dni'])){
			
		$dni = $_SESSION['dni'];

		}else{
			header('Location: index.php');
		}
		if(isset($_REQUEST['inputNombreMascota']) && $_REQUEST['inputNombreMascota'] != "" && isset($_REQUEST['inputRaza']) && $_REQUEST['inputRaza'] != "" && isset($_REQUEST['inputTipoMascota']) && $_REQUEST['inputTipoMascota'] != "" ){
			
		
			$_SESSION['errorMascota'] = creaMascota($_REQUEST['inputTipoMascota'],$_REQUEST['inputRaza'],$_REQUEST['inputNombreMascota'],$dni);
			
				if(isset($_SESSION['errorMascota']) && $_SESSION['errorMascota'] != 1){
			$error = "No se ha podido crear la mascota. Inténtelo de nuevo.";
		}
		if(isset($_SESSION['errorMascota']) && $_SESSION['errorMascota'] == 1){
			$exito= "Se ha creado la mascota con exito";
		}
		};
		?>
	</head>
	<body>
		<?php $mascota = cargaMascotasUsuario($dni);?>
		<div id="bienvenida">
			<h1>Mascotas</h1>
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
		
		<div id="Mascotas">
			<fieldset>
				<legend><b>Mascotas Asociadas</b></legend>
				<?php foreach ($mascota as $m) {?>
					<a href="VistaHistorial.php?id=<?php echo $m['IDMASCOTA'];?>"> <?php echo $m['NOMBREMASCOTA']."<br>";?></a>
				<?php }?>
			</fieldset>
		</div>
		
		<div id="AgregarMascota">
			<fieldset>
				<legend><b>Agregar Mascota</b></legend>
				<form method="post" id="formAltaMascota" onsubmit="" action="VistaMascotas.php">
				<div id="campos">
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
			</fieldset>	
		</div>
		
			
		</div>
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
	</body>
</html>

