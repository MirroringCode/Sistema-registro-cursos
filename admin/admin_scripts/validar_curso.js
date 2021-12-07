const nombreCurso = document.getElementById("nombre-curso");
const dificultadCurso = document.getElementById('dificultad-curso');
const area = document.getElementById('area-curso');
const modalidad = document.getElementById('modalidad-curso');
const imagen = document.getElementById('imagen');
const horario = document.getElementById('horario-curso');
const profesor = document.getElementById('profesor');
const descripcion = document.getElementById('descripcion')
document.getElementById('formulario-curso').addEventListener('submit', validarCurso);

function validarCurso(e) {

	let mensajesDeError = [];
	let input = false;

if (!nombreCurso.value) {
	mensajesDeError.push("Nombre curso: debe llenar este campo");
	input = nombreCurso;
} else if (nombreCurso.value.length < 10 || nombreCurso.value.length > 60) {
	mensajesDeError.push("Nombre curso: el nombre del curso no puede ser ni muy corto muy largo");
	input = nombreCurso;
} else if (!(/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+( [a-zA-ZÀ-ÿ\u00f1\u00d1]+)*$/.test(nombreCurso.value))) {
	mensajesDeError.push("Nombre curso: solo debe introducir letras");
	input = nombreCurso;
}

if (!dificultadCurso.value) {
	mensajesDeError.push("Dificultad: debe llenar este campo");
	if(!input) {
		input = dificultadCurso;
	}	
}

if (!area.value) {
	mensajesDeError.push("Area: debe llenar este campo");
	if(!input) {
		input = area;
	}	
}


if(!modalidad.value) {
	mensajesDeError.push("Modalidad: debe llenar este campo");
	input = modalidad;
	if(!input) {
		input = modalidadCurso;
	}
}

if (!imagen.value) {
	mensajesDeError.push("Imagen: debe llenar este campo");
	if(!input) {
		input = imagen;
	}	
}


if(!horario.value) {
	mensajesDeError.push("Horario: debe llenar este campo");
	if(!input) {
		input = horario;
	}
}



if(!profesor.value) {
	mensajesDeError.push("Profesor: debe llenar este campo");
	input = profesor;
	if(!input) {
		input = profesor;
	}
}


if(!descripcion.value) {
	mensajesDeError.push("Descripcion: debe llenar este campo");
	input = descripcion;
	if(!input) {
		input = descripcion;
	}
} else if( !(/^[0-9a-zA-ZÀ-ÿ.,\u00f1\u00d1]+( [0-9a-zA-ZÀ-ÿ.,\u00f1\u00d1\n]+)*$/.test(descripcion.value))) {
	mensajesDeError.push("Descripcion: solo puede introducir valores alfanuméricos");
	if(!input) {
		input = descripcion;
	}
} 

if(mensajesDeError.length > 0) {
	e.preventDefault();
	alert('Error en formulario, por favor corrija:\n' + mensajesDeError.join('\n'));
	input.focus;
}

}