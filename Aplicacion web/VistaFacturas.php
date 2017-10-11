<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
	<head>
		<link rel="stylesheet" type="text/css" href="estilos/VistaFacturas.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>VistaCitas</title>
		<meta name="author" content="fjavier" />
		<!-- Date: 2014-05-09 -->
				
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
		?>
	</head>
	<body>
		<div id="bienvenida">
			<h1>Facturas</h1>
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
				$citas = cargaCitasClienteFacturas($dni);
				if($citas != Array()){
					foreach ($citas as $c) {
					
					$nombreMascota = cargaNombreMascota($c['IDMASCOTA']);
					$nombrePersonal = cargaNombrePersonalDeID($c['IDPERSONAL']);;
					$fechaHora=$c['FECHAHORA'];	
					$fecha = substr($fechaHora, 0, strlen($fechaHora)-10);
					$importe = cargaImportesFacturasCliente($dni, $fechaHora);
					$pagada = $importe['PAGADA'];
					if($pagada == 0){
						$pagada = "NO";
					}else{
						$pagada="SI";
						}
					echo "<tr><td class='tg-jlrw'>".$fecha."</td>
					<td class='tg-jlrw'>".$nombreMascota."</td>
					<td class='tg-jlrw'>".$nombrePersonal."</td>
					<td class='tg-jlrw'>".$importe['IMPORTETOTAL']."</td>
					<td class='tg-jlrw'>".$pagada."</td></tr>";
					}
				}else{
						echo '<tr><td class="tg-jlrw" colspan="5">No tiene usted ninguna factura</td>';
					
				}
				?>
</table>
		

	</body>
</html>

