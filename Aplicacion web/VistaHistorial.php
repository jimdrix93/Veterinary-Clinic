<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="estilos/VistaHistorial.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>VistaHistorial</title>
		<meta name="author" content="fjavier" />
		<!-- Date: 2014-05-07 -->
		<div id="logo">
			<a href="VistaPrincipal.php" title="Volver a la página principal."><img src="imagenes/logo_transparente.png" /></a>
		</div>
		<?php
			include ('funciones.php');
			session_start();
			if (isset($_SESSION['dni'])) {

				$dni = $_SESSION['dni'];

			} else {
				header('Location: index.php');
			}if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){
			$idMascota=$_REQUEST['id'];
			if(isMascotaOfUser($idMascota, $dni) == 1){
			$nombreMascota = cargaNombreMascota($idMascota);
			}else{
				header('Location: VistaMascotas.php');
			}
		}
		?>
	</head>
	<body>
		<div id="bienvenida">
			<h1>Historial de <?php echo $nombreMascota;?></h1>
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
		<div id="tablaHistorial">
			<table class="tg">

				<tr>

					<th class="tg-4kyz" colspan="5">Historial de Citas</th>

				</tr>

				<tr>

					<td class="tg-jlrw">Fecha</td>
					
					<td class="tg-jlrw">Sintoma</td>

					<td class="tg-jlrw">Personal</td>

					<td class="tg-jlrw">Tratamiento</td>

				</tr>

				<?php

				if (isset($idMascota) && $idMascota != "") {

					$citas = cargaCitasPorIdMascotaHistorial($idMascota);

					if ($citas != Array()) {

						foreach ($citas as $c) {


							$nombrePersonal = cargaNombrePersonalDeID($c['IDPERSONAL']);
							;
							$tipoSintoma = cargaSintomasPorIdSintoma($c['IDSINTOMA']);

							$fechaHora = $c['FECHAHORA'];

							$fechaHora = substr($c['FECHAHORA'], 0, strlen($c['FECHAHORA']) - 10);

							$idTratamiento = cargaIdTratamientoPorIdCita($c['IDCITA']);

							$tipoTratamiento = cargaTratamientoPorId($idTratamiento);

							echo '<tr><td class="tg-jlrw">' . $fechaHora . '</td>

						

							<td class="tg-jlrw">' . $tipoSintoma . '</td>

							<td class="tg-jlrw">' . $nombrePersonal . '</td>

							<td class="tg-jlrw">' . $tipoTratamiento . '</td></tr>';

						}

					} else {

					echo '<tr><td class="tg-jlrw" colspan="5">No hay registros en nuestra base de datos para esta mascota.</td>';
				}}
				?>
			</table>
		</div>
	</body>
</html>


		