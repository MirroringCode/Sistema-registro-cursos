const nombreMaterial = document.getElementById("nombre-material");
const categoria = document.getElementById("categoría");
const tipo = document.getElementById("tipo");
document.getElementById("formulario-material").addEventListener('submit', checkFormulario);


function checkFormulario(e) {
    let mensajesDeError = [];
    let input = false;
    
	
	
	//validacion nombre inicio
	if(!nombreMaterial.value) {
        mensajesDeError.push("Nombre: Debe llenar este campo");
        input = nombreMaterial;
	
    } else if(nombreMaterial.value.length <= 3 || nombreMaterial.value.length >= 50) {
        mensajesDeError.push("Nombre material: El nombre de material debe tener entre 4 y 27 caracteres");
        input = nombreMaterial;
   
    } else if ( !(/^[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]+( [0-9a-zA-ZÀ-ÿ\u00f1\u00d1]+)*$/.test(nombreMaterial.value)) ) {
        mensajesDeError.push("Nombre material: Solo debe introducir letras"); 
        input = nombreMaterial;
            

    }
	//validacion nombre fin
	
	
	//validacion apellido inicio
	if(!categoria.value) {
        mensajesDeError.push("Categoría: Debe llenar este campo");
        input = categoria;
		if(!input) {
            input = categoria;
        }
    } 
	
	
	
    // validacion tipo inicio
    if(!tipo.value) {
        mensajesDeError.push("Tipo de material: Debe llenar este campo");
        if(!input) {
            input = tipo;
        }
    } else if(tipo.value.length <= 3 || tipo.value.length >= 51) {
        mensajesDeError.push("Tipo de material: El tipo de material debe tener entre 4 y 50 caracteres");
        if(!input) {
            input = tipo;
        }
    } else if ( !(/^[0-9a-zA-ZÀ-ÿ\u00f1\u00d1]+( [0-9a-zA-ZÀ-ÿ\u00f1\u00d1]+)*$/.test(tipo.value)) ) {
        mensajesDeError.push("Tipo de material: Solo debe introducir valores alfanuméricos"); 
        if(!input) {
            input = tipo;
        }
    }
    // validacion tipo fin 



     
    if (mensajesDeError.length > 0) {
        e.preventDefault();
        alert('Error en formulario, por favor corrija:\n' + mensajesDeError.join('\n'));
        input.focus;
    }
}
