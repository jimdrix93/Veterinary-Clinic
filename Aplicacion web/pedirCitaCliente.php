<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
	<head>
		<link rel="stylesheet" type="text/css" href="estilos/pedirCitaCliente.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Citas</title>
		<meta name="author" content="fjavier" />
		<!-- Date: 2014-05-09 -->
				<script src="javascript/jquery.js"></script>
		<script src="javascript/jquery.datetimepicker.js"></script>
		<link rel="stylesheet" type="text/css"  href="javascript/jquery.datetimepicker.css" />
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
				
		if(isset($_REQUEST['mascota']) && isset($_REQUEST['tipo']) && isset($_REQUEST['fecha']) && $_REQUEST['fecha'] != "" && $_REQUEST['fecha'] != "Seleccione fecha y hora" && isset($_REQUEST['sintoma']) && isset($_REQUEST['selectPersonal'])){
				
			creaVisita($dni, $_REQUEST['mascota'], 'Cita asignada', $_REQUEST['fecha']);
			creaCita($_REQUEST['fecha'], $_REQUEST['mascota'], $dni, $_REQUEST['selectPersonal'], "Cita asignada", $_REQUEST['sintoma']);
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
		<div id="crearCita">
	<form method="post" action="pedirCitaCliente.php">
		<div id="div_form">

			<fieldset>

				<legend>
					<b>Seleccione la mascota para la que quiere la cita</b>
				</legend>
				
				<div id="div_mascota">
					<label id="label_mascota" for="mascota">Mascota:</label>
						<select id="mascota" name="mascota">
						<option id="optionPorDefectoMascota" title="optionPorDefectoMascota" value="optionPorDefectoMascota">Selecciona a una mascota</option>
								<?php foreach ($mascota as $m) {?>
					<option id="<?php echo $m['NOMBREMASCOTA'];?>" value="<?php echo $m['NOMBREMASCOTA'];?>"> <?php echo $m['NOMBREMASCOTA'];?></option>
				<?php }?>


							</optgroup>
						</select>
				</div>

			</fieldset>

			<fieldset>

				<legend>
					<b>Seleccione el tipo de cita que desea</b>
				</legend>

				<div id="div_tipo">
					<div id="div_titulo_tipo">
						Tipo de cita:
					</div>
					
					<div id="div_tipo_peluqueria">
						<input id="tipo_peluqueria" name="tipo" type="radio" value="peluqueria" checked="checked" onclick="document.=!document.formulario.enviar.disabled" onchange="cargarSelect(1)"/>
						<label id="label_peluqueria" for="tipo_peluqueria">Peluquería</label>
					</div>
					<div id="div_tipo_consulta">
						<input id="tipo_consulta" name="tipo" type="radio" value="consulta" onchange="cargarSelect(2)"/>
						<label id="label_consulta" for="tipo_consulta">Veterinario</label>
					</div>
					<div id="div_selecciona_personal">
								<label id="label_selecciona_personal" for="selecciona_personal">Nombre:</label>
								<select id="selectPersonal" name="selectPersonal" class="selectPersonal">
									<option id="optionPorDefectoPersonal" title="optionPorDefectoPersonal" value="optionPorDefectoPersonal">Selecciona un personal</option>
									<?php
										foreach ($personal as $fila2){
											foreach ($fila2 as $fila3) {
											if(cargaTipoPuestoPersonal($fila3["DNI"]) != "Recepcionista"){		
									?>
									<option id="<?php echo $fila3["DNI"]; ?>" title="<?php echo $fila3["NOMBRE"];?>" value="<?php echo $fila3["DNI"];?>"><?php echo $fila3["APELLIDOS"].", ".$fila3["NOMBRE"];	?></option>
									<?php }
									}
										}
									?>
								</select>
							</div>
				</div>

			</fieldset>

			<div id="div_datos_personales">

				<fieldset>

					<legend>
						<b>Cita</b>
					</legend>

					<div id="div_fecha">
						<label id="label_fecha" for="fecha">Fecha y Hora:</label>
						<p>
							<input id="fecha" name="fecha" type="text" value="Seleccione fecha y hora" />
						</p>
						<script>
							$(function() {
								$('#fecha').datetimepicker({
									onGenerate:function( ct ){
    								jQuery(this).find('.xdsoft_date.xdsoft_weekend').addClass('xdsoft_disabled');
								    },
									format:'d/m/Y H:i',
									lang : 'es',
									minTime: '10:00',
									maxTime: '20:00',
									dayOfWeekStart : 1,
									minDate:0,
									step: 15,
									timepicker : true,

								});
							});
						</script>
						
					</div>

					<div id="div_sintoma">
						<label id="label_sintoma" for="sintoma">Sintoma:</label>
						<select id="sintoma" name="sintoma">
							<option id="optionPorDefectoSintoma" title="optionPorDefectoSintoma" value="optionPorDefectoSintoma">Selecciona un síntoma</option>
								<option value="Pelo abundante" >Pelo abundante</option>
								<option value="Unas grandes">Uñas grandes</option>


							
						</select>
					</div>

				</fieldset>

			</div>

		</div>
		<br>
		<div id="div_submit"align="left" >
			<input id="submit" type="submit" value="Solicitar Cita"/>
		</div>
	</form>
	
	<script>
		function cargarSelect(valor)
{

    var arrayValores=new Array(
        new Array(1,"Pelo abundante","Pelo abundante"),
        new Array(1,"Unas grandes","Unas grandes"),
        
               
        new Array(2,"Perdida de apetito","Perdida de apetito"),
        new Array(2,"Consumo excesivo de agua","Consumo excesivo de agua"),
        new Array(2,"Aumento de peso de forma rapida","Aumento de peso de forma rapida"),
        new Array(2,"Comportamiento fuera de lo comun","Comportamiento fuera de lo comun"),
        new Array(2,"Cansancio","Cansancio"),
        new Array(2,"Pereza","Pereza"),
        new Array(2,"Dificultad para levantarse","Dificultad para levantarse"),
        new Array(2,"Dificultad para acostarse","Dificultad para acostarse"),
        new Array(2,"Abultamientos extranos","Abultamientos extraños"),
        new Array(2,"Otros","Otros")
    );
    if(valor==null)
    {
        document.getElementById("sintoma").disabled=true;
    }else{
        document.getElementById("sintoma").options.length=0;
        
        
        document.getElementById("sintoma").options[0]=new Option("Selecciona un síntoma", "0");
        for(i=0;i<arrayValores.length;i++)
        {
            // unicamente añadimos las opciones que pertenecen al id seleccionado
            // del primer select
            if(arrayValores[i][0]==valor)
            {
                document.getElementById("sintoma").options[document.getElementById("sintoma").options.length]=new Option(arrayValores[i][2], arrayValores[i][1]);
            }
        }
        
        
        document.getElementById("sintoma").disabled=false;
    }
}
	</script>
	</div>
		

	</body>
</html>