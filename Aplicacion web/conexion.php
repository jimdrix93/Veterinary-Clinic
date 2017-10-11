<?php
header('Content-type: text/html; charset=utf-8');

function getConexion() {
	$host = 'oci:dbname=localhost/XE';
	$username = 'iissi';
	$password = 'iissi';
	try {
		$con = new PDO($host, $username, $password);
		$con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $con;

	} catch( PDOException $e ) {

		echo 'Error de conexión: ' . $e -> GetMessage();
	}
}
?>
