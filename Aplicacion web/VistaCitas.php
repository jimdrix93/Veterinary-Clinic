<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
	<head>
		<link rel="stylesheet" type="text/css" href="estilos/VistaCitas.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Citas</title>
		<meta name="author" content="fjavier" />
		<!-- Date: 2014-05-09 -->
				<script src="jquery.js"></script>
		<script src="jquery.datetimepicker.js"></script>
		<link rel="stylesheet" type="text/css"  href="jquery.datetimepicker.css" />
		<div id="logo">
			<a href="VistaPrincipal.php" title="Volver a la página principal."><img src="imagenes/logo_transparente.png" /></a>
		</div>
		<?php include('funciones.php'); 
		session_start();
		if(isset($_SESSION['dni'])){
			
		$dni = $_SESSION['dni'];

		}else{
			header('Location: index.php');
		}if(isset($_REQUEST['id']) && $_REQUEST['id'] != ""){
			eliminaCita($_REQUEST['id']);
		}
			
		?>
		
	</head>
	<body>
		<?php $personal = cargaPersonal();
		 
		$mascota = cargaMascotasUsuario($dni);?>
		<div id="bienvenida">
			<h1>Citas</h1>
		</div>
		<div id="botonCerrarSesion">
			<button onclick="window.location='index.php'">
				Cerrar sesión
			</button>
		</div>
		<div id="menu">
			<table id="tablemenu" border="">
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
		<div id="pedirCita">
				<button id="botonPedirCita" onclick="window.location='pedirCitaCliente.php'">
					Pedir cita
				</button>
			</div>
		
	<div id="tablaCitas">
			<table border="">
				<tr>
					<th>Mascota: </th>
					<th>Nombre: </th>
					<th>Cliente: </th>
					<th>Fecha: </th>
					<th>Operaciones</th>
				</tr>
				<?php 
						$citas = cargaCitasClienteProximas($dni);
						if($citas != Array()){
						foreach ($citas as $c) {
							$nombreUsuario = cargaNombreClienteDeID(getIdClientePorIDMascota($c['IDMASCOTA']));
							$nombreMascota = cargaNombreMascota($c['IDMASCOTA']);?>
							<tr><td><?php echo $c['IDMASCOTA']; ?></td><td><?php echo $nombreMascota; ?></td><td><?php echo $nombreUsuario; ?></td><td><?php echo substr($c['FECHAHORA'], 0, strlen($c['FECHAHORA']) - 10); ?></td><td><button id="botonEditarCita" onclick="window.location='VistaModificarCita.php?idCita=<?php echo $c['IDCITA'];?>'">
					Editar cita
				</button><button id="botonEliminarCita" onclick="window.location='VistaCitas.php?id=<?php echo $c['IDCITA'];?>'">
					Eliminar cita
				</button></td></tr>
						<?php }
						
							}else{
						 	echo "No hay citas para este usuario.";
						 } ?>
			</table>
		</div>

	</div>
		

	</body>
</html>

