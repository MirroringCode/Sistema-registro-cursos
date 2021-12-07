const usuarioNombre = document.getElementById("nombre");
const usuarioApellido = document.getElementById("apellido");
const usuario = document.getElementById("usuario");
const emailUsuario = document.getElementById("email");
document.getElementById("editar-perfil").addEventListener('submit', checkFormulario);


function checkFormulario(e) {
    let mensajesDeError = [];
    let input = false;
    
	
	
	//validacion nombre inicio
	if(!usuarioNombre.value) {
        mensajesDeError.push("Nombre: Debe llenar este campo");
        input = usuarioNombre;
		if(!input) {
            input = usuarioNombre;
        }
    } else if(usuarioNombre.value.length <= 3 || usuarioNombre.value.length >= 28) {
        mensajesDeError.push("Nombre: El nombre del usuario debe tener entre 4 y 27 caracteres");
        input = usuarioNombre;
		if(!input) {
            input = usuarioNombre;
        }
    } else if ( !(/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/.test(usuarioNombre.value)) ) {
        mensajesDeError.push("Nombre: Solo debe introducir letras"); 
        input = usuarioNombre;
		if(!input) {
            input = usuarioNombre;
        }
    }
	//validacion nombre fin
	
	
	//validacion apellido inicio
	if(!usuarioApellido.value) {
        mensajesDeError.push("Apellido: Debe llenar este campo");
        input = usuarioApellido;
		if(!input) {
            input = usuarioApellido;
        }
    } else if(usuarioApellido.value.length <= 3 || usuarioApellido.value.length >= 28) {
        mensajesDeError.push("Apellido: El apellido del usuario debe tener entre 4 y 27 caracteres");
        input = usuarioApellido;
		if(!input) {
            input = usuarioApellido;
        }
    } else if ( !(/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/.test(usuarioApellido.value)) ) {
        mensajesDeError.push("Apellido: Solo debe introducir letras"); 
        input = usuarioApellido;
		if(!input) {
            input = usuarioApellido;
        }
    }
	//validacion apellido fin
	
	
	
    // validacion usuario inicio
    if(!usuario.value) {
        mensajesDeError.push("Usuario: Debe llenar este campo");
        input = usuario;
    } else if(usuario.value.length <= 3 || usuario.value.length >= 20) {
        mensajesDeError.push("Usuario: El nombre usuario debe tener entre 4 y 19 caracteres");
        input = usuario;
    } else if ( !(/^[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]+$/.test(usuario.value)) ) {
        mensajesDeError.push("Usuario: Solo debe introducir valores alfanuméricos"); 
        input = usuario;
    }
    // validacion usuario fin

    // validacion email inicio
    if(!emailUsuario.value) {
        mensajesDeError.push("Correo: Debe llenar este campo");
        if(!input) {
            input = emailUsuario;
        }
    } else if( !(/\S+@\S+\.\S+/.test(emailUsuario.value)) ) {
        mensajesDeError.push("Correo: Debe ingresar un correo válido");
        if(!input) {
            input = emailUsuario;
        }
    }
    // validacion email fin

     
    if (mensajesDeError.length > 0) {
        e.preventDefault();
        alert('Error en formulario, por favor corrija:\n' + mensajesDeError.join('\n'));
        input.focus;
    }
}
