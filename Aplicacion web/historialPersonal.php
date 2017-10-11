<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css"  href="estilos/estilo_historialPersonal.css" />
		<link type='image/png' href="imagenes/logo.png" rel="shortcut icon">
		<title>Historial clínicico</title>
		<?php
		include ('funciones.php');
		session_start();
		if (isset($_SESSION['dni'])) {

			$dni = $_SESSION['dni'];

		} else {
			header('Location: index.php');

		}
		if(isset($_REQUEST['inputDni']) && $_REQUEST['inputDni'] !="" && compruebaDNI($_REQUEST['inputDni']) && compruebaCliente($_REQUEST['inputDni'])){
			$_SESSION['inputDni'] = $_REQUEST['inputDni'];
			$dniCliente = $_REQUEST['inputDni'];
		}if(isset($_SESSION['inputDni']) && $_SESSION['inputDni'] != "" && isset($_REQUEST['id']) && $_REQUEST['id'] != ""){
			$dniCliente = $_SESSION['inputDni'];
			$idVisita = $_REQUEST['id'];
			$_SESSION['id']  =$_REQUEST['id']; 
		}
			
		if(isset($_REQUEST['selectTratamiento'])){
			$idVisita = $_SESSION['id'];
			actualizaTratamiento($idVisita, $_REQUEST['selectTratamiento']);
		}
		?>
	</head>
	<body>
		<?php $tipoPersonal = cargaTipoPuestoPersonal($dni);
		 ?>
		<div id="logo">
			<a href="principalPersonal.php" title="Volver a la página principal."><img src="imagenes/logo_transparente.png" /></a>
		</div>
		<div id="bienvenida">
			<h1>Historial clínico</h1>
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
					if ($tipoPersonal != "Recepcionista") {
						echo '<td class="historialFondo"><a href="historialPersonal.php" class="historialLetras" title="Observar los historiales de las mascotas." style="width:100%; display:block">Historial clínico</a></td>';

					}
					?>

					<td class="mensajesFondo"><a href="mensajesPersonal.php" class="mensajesLetras" title="Acceder a su bandeja de entrada." style="width:100%; display:block">Mensajes</a></td>
					<?php
					if ($tipoPersonal == "Recepcionista") {
						echo '<td class="facturasFondo"><a href="facturasPersonal.php" class="facturasLetras" title="Accede a todas las pendientes." style="width:100%; display:block">Facturas</a></td>';
						echo '<td class="administracionFondo"><a href="administracionPersonal.php" class="administracionLetras" title="Accede a las opciones de administración de la clínica." style="width:100%; display:block">Administración</a></td>';
					}
					?>
				</tr>
			</table>
		</div>

		<div id="filtrosCitas">
			<form id="formFiltroCitas" method="post" action="historialPersonal.php">

				<div id="campos">
					<div id="campoDni">
						<b>DNI del cliente: </b>
					</div>
				</div>
				<div id="datos">
					<div id="datoDni">
						<input type="search" name="inputDni" class="inputDni" maxlength="9"/>
						<sub>Por favor ingrese un dni para buscar</sub>
					</div>
				</div>
				<div id="filtrar">
					<input type="submit" class="botonFiltrar" name="botonFiltrar" value="Filtrar"/>
				</div>
			</form>
		</div>
		<div id="tablaHistorial">
<table class="tg">
	
	
<tr>
	
  <th class="tg-4kyz" colspan="5">Historial de Citas</th>
	
</tr>
	
<tr>
	
  <td class="tg-jlrw">Fecha</td>
	
  <td class="tg-jlrw">Mascota</td>
	
  <td class="tg-jlrw">Sintoma</td>
	
  <td class="tg-jlrw">Personal</td>
	
  <td class="tg-jlrw">Tratamiento</td>
   <td class="tg-jlrw">Operaciones</td>
	
</tr>
	

	
			<?php
			
			if(isset($dniCliente) && $dniCliente !=""){
				
						
			$citas = cargaCitasClienteHistorialPersonal($dniCliente);
								
			if($citas != Array()){
	
				foreach ($citas as $c) {
	
				
	
				$nombreMascota = cargaNombreMascota($c['IDMASCOTA']);
	
				$nombrePersonal = cargaNombrePersonalDeID($c['IDPERSONAL']);;
				$tipoSintoma = cargaSintomasPorIdSintoma($c['IDSINTOMA']);
	
				$fechaHora=$c['FECHAHORA'];	
				
				$fechaHora = substr($c['FECHAHORA'], 0, strlen($c['FECHAHORA']) - 10);
				
				$idTratamiento=cargaIdTratamientoPorIdCita($c['IDCITA']);
	
				$tipoTratamiento=cargaTratamientoPorId($idTratamiento);	?>
	
				<tr><td class="tg-jlrw"><?php echo $fechaHora; ?></td>
	
				<td class="tg-jlrw"><?php echo $nombreMascota; ?></td>
	
				<td class="tg-jlrw"><?php echo $tipoSintoma; ?></td>
	
				<td class="tg-jlrw"><?php echo $nombrePersonal; ?></td>
	
				<?php if(!isset($idVisita)) {?>
				<td class="tg-jlrw"><?php echo $tipoTratamiento; ?></td>
				<?php }else{ ?>
					<td class="tg-jlrw">
						<form action="historialPersonal.php" method="post">
						<select id="selectTratamiento" name="selectTratamiento" class="selectTratamiento">
						
								<option id="optionPorDefecto" title="optionPorDefecto" value="optionPorDefecto">Selecciona un tratamiento</option>
									<?php $tratamientos = cargaTratamientos();
								foreach ($tratamientos as $t) { ?>
									<option id="<?php echo $t["TIPOTRATAMIENTO"]; ?>" title="<?php echo $t["TIPOTRATAMIENTO"];?>" value="<?php echo $t["TIPOTRATAMIENTO"];?>"><?php echo $t["TIPOTRATAMIENTO"];?></option>
									<?php
									}
							?>					
					
					</td>
				<?php }
				
				if(!isset($idVisita)) {
				 ?>
				
				<td class="tg-jlrw"><button id="botonActualizaTratamiento" onclick="window.location='historialPersonal.php?id=<?php echo getIdVisitaPorIdCita($c['IDCITA']);?>'">
					Actualiza tratamiento
				</button></td></tr>
				
	<?php }else{ ?>
		
		<td class="tg-jlrw"><input type="submit" class="inputEnviar" value="Guardar tratamiento"/></td></tr>
		</form>
	<?php }
				}
	
			}else{
	
					echo '<tr><td class="tg-jlrw" colspan="5">No hay ningún registro asociado a ese dni</td>';
			}}
			?>
	
</table>
		</div>
	</body>
</html>

