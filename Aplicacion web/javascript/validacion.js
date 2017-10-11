function validacionLogin() {
	var dni = document.getElementById("inputDni").value;
	var password = document.getElementById("inputPassword").value;
	if (dni.length == 0 || password.length == 0) {
		alert("Los campos DNI y contraseña deben de estar rellenos.");
		return false;
	} else {
		return true;
	}
}

// function validacionEditarPerfil() {
	// var direccion = document.getElementById("inputDireccion").value;
	// var telefono = document.getElementById("inputTelefono").value;
	// var contrasena = document.getElementById("inputContrasena").value;
	// var contrasenaNueva = document.getElementById("inputContrasenaNueva").value;
	// var contrasenaConfirmada = document.getElementById("inputContrasenaConfirmada").value;
	// var error1 = 'Los campos dirección y telefono no pueden ser vacios.</br>';
	// var error2 = 'Para modificar la contraseña debe rellenar todos los campos de Modificar contraseña.</br>';
	// var error3 = 'Los campos nueva contraseña y confirmar nueva contraseña no son iguales.</br>';
	// if (direccion.length == 0 || telefono.length == 0) {
		// if (contrasena.length != 0 && (contrasenaNueva.lenght == 0 || contrasenaConfirmada.lengt == 0)) {
			// alert(error1 + error2);
			// return false;
		// } else if (contrasenaNueva.lenght != 0 && (contrasena.lenght == 0 || contrasenaConfirmada.lengt == 0)) {
			// alert(error1 + error2);
			// return false;
		// } else if (contrasenaConfirmada.lengt != 0 && (contrasena.lenght == 0 || contrasenaNueva.lenght == 0)) {
			// alert(error1 + error2);
			// return false;
		// } else if (contrasena.length != 0 && contrasenaNueva.lenght != 0 && contrasenaConfirmada.lengt != 0) {
			// if (contrasenaNueva != contrasenaConfirmada) {
				// alert(error1 + error3);
				// return false;
			// } else {
				// alert(error1);
				// return false;
			// }
		// }
	// } else if (contrasena.length != 0 && (contrasenaNueva.lenght == 0 || contrasenaConfirmada.lengt == 0)) {
		// alert(error2);
		// return false;
	// } else if (contrasenaNueva.lenght != 0 && (contrasena.lenght == 0 || contrasenaConfirmada.lengt == 0)) {
		// alert(error2);
		// return false;
	// } else if (contrasenaConfirmada.lengt != 0 && (contrasena.lenght == 0 || contrasenaNueva.lenght == 0)) {
		// alert(error2);
		// return false;
	// } else if (contrasena.length != 0 && contrasenaNueva.lenght != 0 && contrasenaConfirmada.lengt != 0) {
		// if (contrasenaNueva != contrasenaConfirmada) {
			// alert(error3);
			// return false;
		// }else{
			// return true;
		// }
	// }
	// return true;
// }
//
//YA HECHO POR NESTOR

function validacionEscribirMensaje(){
	var personal = document.getElementById("selectPersonal");
	var asunto = document.getElementById("inputAsunto").value;
	if(personal.selectedIndex == 0){
		alert('Debe seleccionar un personal para enviar el mensaje.');
		return false;
	}else if(asunto.length == 0){
		alert('El mensaje debe de contener asunto.');
		return false;
	}
	return true;
}
