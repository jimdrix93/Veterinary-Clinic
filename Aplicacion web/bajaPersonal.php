<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css"  href="estilos/estilo_bajaPersonal.css" />
		<link type='image/png' href="imagenes/logo.png" rel="shortcut icon">
		<title>Baja personal</title>
		<?php
		include ('funciones.php');
		session_start();
		if (isset($_SESSION['dni'])) {

			$dni = $_SESSION['dni'];

		} else {
			header('Location: index.php');

		}if(isset($_REQUEST['dni']) && $_REQUEST['dni'] != ""){
			eliminaUsuario($_REQUEST['dni']);
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
			<h1>Baja personal</h1>
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
		<div id="filtrosCitas">
			<form id="formFiltroCitas" method="post" action="bajaPersonal.php">

				<div id="campos">
					<div id="campoDni">
						<b>DNI del cliente: </b>
					</div>
				</div>
				<div id="datos">
					<div id="datoDni">
						<input type="search" name="inputDni" class="inputDni" maxlength="9"/>
						<sub>Por favor ingrese un DNI para dar de baja</sub>
					</div>
				</div>
				<div id="filtrar">
					<input type="submit" class="botonFiltrar" name="botonFiltrar" value="Filtrar"/>
				</div>
			</form>
		</div>
		</div>
		<div id="tablaBajaPersonal">
			<table border="">
				<tr>
					<th id="campoTablaDniPersonal" class="campoTablaDniPersonal">DNI: </th>
					<th id="campoTablaNombrePersonal" class="campoTablaNombrePersonal">Nombre: </th>
					<th id="campoTablaPuestoPersonal" class="campoTablaPuestoPersonal">Puesto de trabajo: </th>
					<th id="campoTablaEliminar" class="campoTablaEliminar">Eliminar:</th>
				</tr>
				
					<?php 
					
					if(isset($_REQUEST['inputDni']) && $_REQUEST['inputDni'] !="" && compruebaDNI($_REQUEST['inputDni']) && compruebaPersonal($_REQUEST['inputDni'])){
						
					$dni=$_REQUEST['inputDni'];
					$nombre=cargaNombreUsuario($dni);
					$puesto=cargaTipoPuestoPersonal($dni);
						
					?>	
					<tr><td><?php echo $dni; ?></td>
							  <td><?php echo $nombre; ?></td> 
							  <td><?php echo $puesto; ?></td><td id="botonTablaEliminar" class="botonTablaEliminar" style="width:100%; display:block" onclick=""><a href="bajaPersonal.php?dni=<?php echo $dni;?>"> X</a></td>		
						
						<?php
					}else{					
					$personal= cargaPersonal();
					foreach($personal as $p){
						foreach ($p as $pers) {
							
						
						$nombre=cargaNombreUsuario($pers['DNI']);
						$puesto=cargaTipoPuestoPersonal($pers['DNI']);
						$dni=$pers['DNI'];
						?>	
					<tr><td><?php echo $dni; ?></td>
							  <td><?php echo $nombre; ?></td> 
							  <td><?php echo $puesto; ?></td><td id="botonTablaEliminar" class="botonTablaEliminar" style="width:100%; display:block" onclick=""><a href="bajaPersonal.php?dni=<?php echo $dni;?>" >X</a></td>		
						
						<?php
						}
						}	  
					}
					?>
					
			</table>
		</div>
	</body>
</html>
