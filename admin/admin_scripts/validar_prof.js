const cedulaProfesor = document.getElementById('ci-profesor');
const nombreProfesor = document.getElementById('nombre-profesor');
const apellidoProfesor = document.getElementById('apellido-profesor');
const area = document.getElementById('area');
const credenciales = document.getElementById('credenciales');
document.getElementById('añadir-profesor').addEventListener('submit', validarProfesor);

		function validarProfesor(e) {
			let mensajesDeError = [];
			let input = false;
		

		if(!cedulaProfesor.value) {
			mensajesDeError.push("CI Profesor:Debe llenar este campo");
			input = cedulaProfesor;
		} else if(cedulaProfesor.value.length < 1 || cedulaProfesor.value.length > 8) {
			mensajesDeError.push("CI Profesor: La cedula debe tener entre 1 y 8 caracteres");
			input = cedulaProfesor;
		} else if (isNaN(cedulaProfesor.value)) {
			mensajesDeError.push("CI Profesor: Solo puede introducir caracteres numéricos");
			input = cedulaProfesor;
		}

		if(!nombreProfesor.value) {
			mensajesDeError.push("Nombre Prof: Debe llenar este campo");
			if(!input) {
				input = nombreProfesor;
			}
		} else if(nombreProfesor.value.length < 1 || nombreProfesor.value.length > 60) {
			mensajesDeError.push("Nombre Prof: El nombre no puede ser ni muy largo ni muy corto");
			if(!input) {
				input = nombreProfesor;
			}
		} else if (!(/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/.test(nombreProfesor.value))) {
			mensajesDeError.push("Nombre Prof: Solo debe introducir letras");
			if(!input) {
				input = nombreProfesor;
				}
			}
		
		if(!apellidoProfesor.value) {
			mensajesDeError.push("Apellido Prof: Debe llenar este campo");
			if(!input) {
				input = apellidoProfesor;
			}
		} else if(apellidoProfesor.value.length < 1 || apellidoProfesor.value.length > 60) {
			mensajesDeError.push("Apellido Prof: El apellido no puede ser ni muy largo ni muy corto");
			if(!input) {
				input = apellidoProfesor;
			}
		} else if(!(/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/.test(apellidoProfesor.value))) {
			mensajesDeError.push("Apellido Prof: Solo debe introducir letras");
			if(!input) {
				input = apellidoProfesor;
			}
		}


		if(!area.value) {
			mensajesDeError.push("Area: Debe llenar este campo");
			if(!input) {
				input = area;
			}
		}

		if(!credenciales.value) {
			mensajesDeError.push("Credenciales: Debe llenar este campo");
			if(!input) {
				input = credenciales;
			}
		}



		if(mensajesDeError.length > 0) {
			e.preventDefault();
			alert('Error en formulario, por favor corrija:\n' + mensajesDeError.join('\n'));
			input.focus;
		}

	}