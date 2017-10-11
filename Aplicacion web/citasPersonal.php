<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css"  href="estilos/estilo_citasPersonal.css" />
		<link type='image/png' href="imagenes/logo.png" rel="shortcut icon">
		<title>Citas</title>
		<?php
		include ('funciones.php');
		session_start();
		if (isset($_SESSION['dni'])) {

			$dni = $_SESSION['dni'];

		} else {
			header('Location: index.php');

		}if(isset($_REQUEST['id']) && $_REQUEST['id'] != ""){
			eliminaCita($_REQUEST['id']);
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
			<h1>Citas</h1>
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
		<?php if($tipoPersonal == "Recepcionista"){ ?>
		<div id="botonesCita">
			<div id="anadirCita">
				<button id="botonAnadirCita" onclick="window.location='anadirCitaPersonal1.php'">
					Añadir cita
				</button>
			</div>

		</div> <?php } ?>
		<div id="filtrosCitas">
			<form id="formFiltroCitas" method="post" action="citasPersonal.php">

				<div id="campos">
					<div id="campoDni">
						<b>DNI del cliente: </b>
					</div>
				</div>
				<div id="datos">
					<div id="datoDni">
						<input type="search" name="inputDni" class="inputDni" maxlength="9"/>
						<sub>Ejemplo: 12345678A</sub>
					</div>
				</div>
				<div id="filtrar">
					<input type="submit" class="botonFiltrar" name="botonFiltrar" value="Filtrar"/>
				</div>
			</form>
		</div>
		<div id="tablaCitas">
			<table border="">
				<tr>
					<th>Mascota: </th>
					<th>Nombre: </th>
					<th>Cliente: </th>
					<th>Fecha: </th>
					<?php if($tipoPersonal == "Recepcionista"){ ?><th>Operaciones</th> <?php } ?>
				</tr>
				<?php if(!isset($_REQUEST['inputDni']) || $_REQUEST['inputDni'] =="" ){ 
						$citas = cargaProximasCitasPersonal($dni);
						foreach ($citas as $c) {
							
							$apellidosUsuario = cargaApellidosClienteDeID(getIdClientePorIDMascota($c['IDMASCOTA']));
							$nombreUsuario = $apellidosUsuario.", ".cargaNombreClienteDeID(getIdClientePorIDMascota($c['IDMASCOTA']));
							$nombreMascota = cargaNombreMascota($c['IDMASCOTA']);?>
							<tr><td><?php echo $c['IDMASCOTA']; ?></td><td><?php echo $nombreMascota; ?></td><td><?php echo $nombreUsuario; ?></td><td><?php echo substr($c['FECHAHORA'], 0, strlen($c['FECHAHORA']) - 10); ?></td></tr>
						<?php }
						 }else if(isset($_REQUEST['inputDni']) && $_REQUEST['inputDni'] != "" && compruebaDNI($_REQUEST['inputDni']) && compruebaCliente($_REQUEST['inputDni'])){
						 	$citas = cargaCitasClienteProximas($_REQUEST['inputDni']);
							if($citas != Array()){
								 foreach ($citas as $c) {
							$apellidosUsuario = cargaApellidosClienteDeID(getIdClientePorIDMascota($c['IDMASCOTA']));
							$nombreUsuario = $apellidosUsuario.", ".cargaNombreClienteDeID(getIdClientePorIDMascota($c['IDMASCOTA']));
							$nombreMascota = cargaNombreMascota($c['IDMASCOTA']); ?>
							<tr><td><?php echo $c['IDMASCOTA']; ?></td><td><?php echo $nombreMascota; ?></td><td><?php echo $nombreUsuario; ?></td><td><?php echo substr($c['FECHAHORA'], 0, strlen($c['FECHAHORA']) - 10); ?></td><?php if($tipoPersonal=="Recepcionista"){ ?><td><button id="botonEditarCita" onclick="window.location='modificarCitaPersonal.php?idCita=<?php echo $c['IDCITA'];?>'">
					Editar cita
				</button><button id="botonEliminarCita" onclick="window.location='citasPersonal.php?id=<?php echo $c['IDCITA'];?>'">
					Eliminar cita
				</button></td><?php } ?></tr>
						 <?php } 
							}
							}else{
						 	echo "No hay citas para el DNI introducido.";
						 } ?>
			</table>
		</div>
	</body>
</html>

