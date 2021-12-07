const nombreUsuario = document.getElementById("usuario");
const contraseñaUsuario = document.getElementById("contraseña");
document.getElementById("formulario_ingreso").addEventListener('submit', checkFormulario);

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
} else if ( !(/^[0-9a-zA-Z]+$/.test(contraseñaUsuario.value)) ) {
    mensajesDeError.push("Contraseña: Solo debe introducir valores alfanuméricos") 
    input = contraseñaUsuario;
}  

//validacion contraseña fin




    if (mensajesDeError.length > 0) {

        e.preventDefault();
        alert('Error en formulario, por favor corrija:\n' + mensajesDeError.join('\n'));
        input.focus;
    }
}
