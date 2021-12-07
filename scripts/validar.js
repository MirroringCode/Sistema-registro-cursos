const nombreUsuario = document.getElementById("usuario")
const emailUsuario = document.getElementById("email")
const contraseñaUsuario = document.getElementById("contraseña");
const contraseñaUsuarioDos = document.getElementById("segunda_contraseña");
// const telefonoUsuario = document.getElementById("numero_telefonico");
document.getElementById("formulario_registro").addEventListener('submit', checkFormulario);


function checkFormulario(e) {
    let mensajesDeError = [];
    let input = false;
    
    // validacion usuario inicio
    if(!nombreUsuario.value) {
        mensajesDeError.push("Usuario: Debe llenar este campo");
        input = nombreUsuario;
    } else if(nombreUsuario.value.length <= 3 || nombreUsuario.value.length >= 20) {
        mensajesDeError.push("Usuario: El nombre usuario debe tener entre 4 y 19 caracteres");
        input = nombreUsuario;
    } else if ( !(/^[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]+$/.test(nombreUsuario.value)) ) {
        mensajesDeError.push("Usuario: Solo debe introducir valores alfanuméricos") 
        input = nombreUsuario;
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

    //  validacion contraseña inicio
    if (!contraseñaUsuario.value) {
        mensajesDeError.push("Contraseña: debe llenar este campo");
        if (!input) {
            input = contraseñaUsuario;
        }
    } else if (contraseñaUsuario.value.length <= 4 || contraseñaUsuario.value.length >= 20) {
        mensajesDeError.push("Contraseña: la contraseña debe tener entre 5 y 19 caracteres");
        if (!input) {
            input = contraseñaUsuario;
        }
    }  
    
    // validacion contraseña fin

    // validacion segunda contraseña inicio
    if(!contraseñaUsuarioDos.value) {
        mensajesDeError.push("Confirmar contraseña: debe llenar este campo");
        if (!input) {
            input = contraseñaUsuarioDos;
        } 
    } else if (contraseñaUsuarioDos.value !== contraseñaUsuario.value) {
        mensajesDeError.push("Confirmar contraseña: las contraseñas deben coincidir");
        if (!input) {
            input = contraseñaUsuarioDos;
        }
    }
    // validacion segunda contraseña fin

    // validacion telefono inicio
    /*  if (!telefonoUsuario.value) {
        mensajesDeError.push("Número telefonico: debe llenar este campo");
        if (!input) {
            input = telefonoUsuario;
        }
        } else if (isNaN(telefonoUsuario.value)) {
        mensajesDeError.push("Número telefonico: solo se pueden ingresar números");
        if (!input) {
            input = telefonoUsuario;
        }
        } else if (telefonoUsuario.value.length < 11 || telefonoUsuario.value.length > 11) {
            mensajesDeError.push("Número telefonico: se deben ingresar 11 digitos")
            if (!input) {
                input = telefonoUsuario;
            }
        } */
    //  validacion telefono fin
    
    if (mensajesDeError.length > 0) {

        e.preventDefault();
        alert('Error en formulario, por favor corrija:\n' + mensajesDeError.join('\n'));
        input.focus;
    }
}
