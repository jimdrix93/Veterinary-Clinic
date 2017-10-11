<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN""http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="estilos/VistaPrincipal.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>VistaPrincipal</title>
		<meta name="author" content="fjavier" />
		<!-- Date: 2014-04-28 -->
		
		<?php include('funciones.php');
		session_start();
		if(!isset($_SESSION['dni'])){
			$compruebacliente = compruebaDNI($_REQUEST['dni']);
			if($compruebacliente){
				
				if(compruebaPersonal($_REQUEST['dni'])){
					$_SESSION['lgn1'] = $_REQUEST['dni'];
					$_SESSION['lgn2'] = $_REQUEST['contrasena'];
					header('Location: principalPersonal.php');
				}else if(compruebaLogin($_REQUEST['dni'],$_REQUEST['contrasena'])){
					$_SESSION['dni']=$_REQUEST['dni'];
					$dni = $_SESSION['dni'];
				}else{
					$_SESSION['ERRORLOGIN'] = "Introduzca un usuario y contraseña correctos.";
					header('Location: index.php');
				}
			}else{
				$_SESSION['ERRORLOGIN'] = "No se encuentra ningún usuario con el DNI introducido.";
				header('Location: index.php');
		}
		}else{
				$dni=$_SESSION['dni'];
					
		}
		 ?>
		
		<div id="logo">
			<a href="VistaPrincipal.php" title="Volver a la página principal."><img src="imagenes/logo_transparente.png" /></a>
		</div>

	</head>
	<body>
		<div id="bienvenida">
			<h1>Bienvenid@</h1>
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
	
		<div id="ultimosMensajes">
			<fieldset>
				<legend><a href="VistaMensajes.php"><b>Ultimos mensajes</b></a></legend>
				<div id="tablaUltimosMensajes">
					<table border="">
						<tr><td><b>Asunto: </b></td><td><b>De: </b></td><td><b>Fecha: </b></td></tr>
						<?php $mensajes = cargaMensajesClienteSinLeer($dni);
						foreach ($mensajes as $msg) {
							$nombrePersonal = cargaNombrePersonalDeID($msg['IDPERSONAL']);
							?>
							<tr><td><?php echo $msg['ASUNTO']; ?></td><td><?php echo $nombrePersonal; ?></td><td><?php echo substr($msg['FECHAHORA'], 0, strlen($msg['FECHAHORA']) - 10); ?></td></tr>
						<?php } ?>
						
					</table>
				</div>
			</fieldset>
		</div>
		<div id="proximasCitas">
			<fieldset>
				<legend><a href="VistaCitas.php"><b>Próximas citas</b></a></legend>
				<div id="tablaProximasCitas">
					<table border="">
						<tr><td><b>Mascota: </b></td><td><b>Nombre: </b></td><td><b>Cliente: </b></td><td><b>Fecha: </b></td></tr>
						<?php $citas = cargaCitasClienteProximas($dni);
						foreach ($citas as $c) {
							$nombreUsuario = cargaNombreClienteDeID(getIdClientePorIDMascota($c['IDMASCOTA']));
							$nombreMascota = cargaNombreMascota($c['IDMASCOTA']);?>
							<tr><td><?php echo $c['IDMASCOTA']; ?></td><td><?php echo $nombreMascota; ?></td><td><?php echo $nombreUsuario; ?></td><td><?php echo substr($c['FECHAHORA'], 0, strlen($c['FECHAHORA']) - 10); ?></td></tr>
						<?php } ?>
						
					</table>
				</div>
			</fieldset>
		</div>
		<div id="tratamientos">
			<fieldset>
				<legend><b>Tratamientos en curso</b></legend>
				<div id="tablaTratamientos">
					<table border="">
						<tr><td><b>Mascota: </b></td><td><b>Tratamiento: </b></td></tr>
						<?php
				$mascotas = cargaMascotasUsuario($dni);
				$i = 0;
				foreach ($mascotas as $m) {
					$tratamientos = cargaTratamientosMascota($m['IDMASCOTA']);
					if($tratamientos != Array()){
						$nombreMascota = $m['NOMBREMASCOTA'];
						foreach ($tratamientos as $t) {
						$tratamiento = cargaTratamientoPorId($t['IDTRATAMIENTO']);	?>		
						
						<tr><td><?php echo $nombreMascota; ?></td><td><?php echo $tratamiento; ?></td></tr>
					
						<?php $i = 1;

						}
					}
				}
				if ($i == 0){
						echo "Actualmente, sus mascotas no tienen ningún tratamiento activo.";
					} ?>
						
					</table>
				</div>
			</fieldset>
		</div>
		
		<div id="facturas">
			<fieldset>
				<legend><a href="VistaFacturas.php"><b>Facturas pendientes de pago</b></a></legend>
				<div id="tablaFacturas">
					<table border="">
						<tr><td><b>Fecha de factura: </b></td><td><b>Importe: </b></td></tr>
						<?php
				$facturas = cargaFacturasClienteSinPagar($dni);
				if($facturas != Array()){
				foreach ($facturas as $f) { ?>
					<tr><td><?php echo substr($f['FECHA'], 0, strlen($f['FECHA']) - 10); ?></td><td><?php echo $f['IMPORTETOTAL']." euros"; ?></td></tr>
				<?php }
				}else{
					echo "Usted no tiene ninguna factura pendiente.";
				} ?>
						
					</table>
				</div>
			</fieldset>
		</div>
		
	</body>
</html>

