<?php 
	require "conexion.php";
	$con = new getConexion();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

	<head>
		<title>Formulario Enviar Mensaje</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" type="text/css"  href="formulario_enviar_mensaje.css" />
		
	</head>

	<body onload="cargaUsuarios()">

		<div id="div_form">

			<form onsubmit="return validacion()">
				<table>
					

						<div id="div_selecciona_usuario">

							<fieldset>

								<legend>
									Seleccione personal de la clínica
								</legend>

								<div id="div_selecciona_personal">
									<label id="label_selecciona_personal" for="selecciona_personal">Nombre:</label>
									<select id="selecciona_personal" name="selecciona_personal">
						<?php 
						$query = "select * from personal";
 						$stmt= $con->query($query); 
						foreach ($stmt as $fila){
							$dni = $fila["dni"];
							$query2 = "select * from usuarios where dni=:dni";
							$stmt2 = $con->prepare($query2); 
 							$stmt2->bindParam(':dni',$dni); 
 							$stmt2->execute(); 
							foreach ($stmt2 as $fila2){
							?>
							<option id="<?php echo $fila["idPersonal"] ?>" title="<?php echo $fila2["nombre"]?>"><?php echo $fila2["nombre"]?> 
                            </option>
							<?php
						}
						}
						$con = null;
					?>
									</select>
								</div>

								
							</fieldset>

						</div>
							<div id="div_mensaje">

							<fieldset>

								<legend>
									Datos del mensaje
								</legend>

								<div id="div_asunto">
									<label id="label_asunto" for="asunto">Asunto:</label>
									<input id="asunto" name="asunto" type="text" maxlength="100" size="100"/>

								</div>
								
								<div id="div_mensaje">
									<label id="label_mensaje" for="mensaje">Mensaje:</label>
									<textarea title="mensaje" id="mensaje"></textarea>
								</div>

								
							</fieldset>

						</div>
						<br>
						<div id="div_submit" align="left" >
							<input id="submit" type="submit" value="Enviar mensaje"/>
						</div>

						
				</table>

			</form>

		</div>

		<script>
			function validacion() {
				valor = document.getElementById("asunto").value;
								


				if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {

					alert('[ERROR] El campo asunto no debe estar vacio');

					return false;

				}


			}
		</script>
	</body>

</html>
