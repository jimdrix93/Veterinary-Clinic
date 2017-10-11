<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css"  href="estilos/index.css" />
			<link type='image/png' href="imagenes/logo.png" rel="shortcut icon">
		<title>Bienvenido a nuestra Web</title>
		<?php session_start(); 
		if(isset($_SESSION['ERRORLOGIN'])){
			$error = $_SESSION['ERRORLOGIN'];
		} 
		session_destroy();?>
	</head>
	<body>
		<div id="titulo">
			<img src="imagenes/titulo_bienvenida.png" id = "titulo_img"/>
		</div>

		<div id="fachada">
			<img id="fachada_img" src="imagenes/fachada.jpg" alt="Nuestra clínica."/>
		</div>

		<div id="bienvenida">
			Bienvenidos a nuestra página web.
			<br />
			Para registrarse y poder usar nuestra area de cliente debe haber visitado nuestra clínica, donde nuestra
			recepcionista le facilitará su <u>contraseña</u>.
			<br />
			Nos podrán encontrar en la <em>calle Panamá, bloque 8, local 1 en Arcos de la Frontera, Cádiz.</em>
		</div>

		<br />
		
		<div id="formulario">
			<div id="errorlogin">
				<?php if(isset($error)){
					echo $error;
				}?>
			</div>
			<form action="VistaPrincipal.php" method="post">
				<div id="campos">
					<div id="campoDni">
						<b>DNI: </b>
					</div>
					<div id="campoContrasena">
						<b>Contraseña: </b>
					</div>
				</div>
				<div id="datos">
					<div id="datoDni">
						<input type="text" class="inputDni" name="dni" maxlength="9" required="required"/>
						<sub>Ejemplo: 12345678A</sub>
					</div>
					<div id="datoContrasena">
						<input type="password" class="inputContrasena" name="contrasena" required="required"/>
					</div>
					<div id="enviar">
						<input type="submit" class="inputEnviar" value="Entrar"/>
					</div>
					<div id="reiniciar">
						<input type="reset" class="inputReiniciar" value="Reiniciar" />
					</div>
				</div>
			</form>
		</div>
		<style type="text/css">
			img.pequeña{width: 100px; height: 100px;}
		</style>
		
		<div id="acercaDe">
			<a href="AcercaDe.php" title="Ir a acerca de nosotros"><img class="pequeña" src="imagenes/acercaDe.png" ></a>
		</div>
	</body>
</html>

