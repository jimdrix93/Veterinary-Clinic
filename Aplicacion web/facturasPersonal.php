<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css"  href="estilos/estilo_facturasPersonal.css" />
		<link type='image/png' href="imagenes/logo.png" rel="shortcut icon">
		<title>Facturas</title>
		<?php
		include ('funciones.php');
		session_start();
		if (isset($_SESSION['dni'])) {

			$dni = $_SESSION['dni'];

		} else {
			header('Location: index.php');

		}if(isset($_REQUEST['generaID']) && $_REQUEST['generaID'] != ""){
	
			generaFacturaDeCita($_REQUEST['generaID']);
		}if(isset($_REQUEST['pagadaID']) && $_REQUEST['pagadaID'] != ""){
			marcarFacturaComoPagada($_REQUEST['pagadaID']);
		}if(isset($_REQUEST['pagadaID']) && $_REQUEST['pagadaID'] == ""){ ?>
			<script type='text/javascript'>
			myAlert();
			function myAlert(){
				window.alert('Por favor, primero genere una factura.');
				}</script>
				<?php }	?>
	</head>
	<body>
			<?php
		$tipoPersonal = cargaTipoPuestoPersonal($dni);
		?>
		<div id="logo">
			<a href="principalPersonal.php" title="Volver a la página principal."><img src="imagenes/logo_transparente.png" /></a>
		</div>
		<div id="bienvenida">
			<h1>Facturas</h1>
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
		<table class="tg">

  <tr>
    <th class="tg-4kyz" colspan="5">Historial de Facturas</th>
  </tr>
  <tr>
    <td class="tg-jlrw">Fecha</td>
    <td class="tg-jlrw">Mascota</td>
    <td class="tg-jlrw">Personal</td>
    <td class="tg-jlrw">Importe</td>
    <td class="tg-jlrw">Pagada</td>
  </tr>
  
  			<?php
				$citas = cargaCitasPersonalFacturas();
				if($citas != Array()){
					foreach ($citas as $c) {
					
					$nombreMascota = cargaNombreMascota($c['IDMASCOTA']);
					$nombrePersonal = cargaNombrePersonalDeID($c['IDPERSONAL']);;
					$fechaHora=$c['FECHAHORA'];	
					$fecha = substr($fechaHora, 0, strlen($fechaHora)-10);
					$importe = cargaImportesFacturas($fechaHora);
					$pagada = $importe['PAGADA'];
					if($pagada == 0){
						$pagada = "<a href='facturasPersonal.php?pagadaID=".$importe['IDFACTURA']."'>NO</a>";
					}else{
						$pagada="SI";
						}
					echo "<tr><td class='tg-jlrw'>".$fecha."</td>
					<td class='tg-jlrw'>".$nombreMascota."</td>
					<td class='tg-jlrw'>".$nombrePersonal."</td>";
					if($importe['IMPORTETOTAL'] != 0 || $importe['IMPORTETOTAL'] != ""){
						
					echo "<td class='tg-jlrw'>".$importe['IMPORTETOTAL']."</td>";
					}else{
						echo "<td class='tg-jlrw'><a href='facturasPersonal.php?generaID=".$c['IDCITA']."'>Generar factura</a></td>";
						}
					echo "<td class='tg-jlrw'>".$pagada."</td></tr>";
					}
				}else{
						echo '<tr><td class="tg-jlrw" colspan="5">No tiene usted ninguna factura</td>';
					
				}
				?>
</table>

		</div>
	</body>
</html>

