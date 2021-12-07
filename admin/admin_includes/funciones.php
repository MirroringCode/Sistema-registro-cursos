<?php
// Archivo con funciones utilizadas en secciones de la página para no escribir código constantemente

//================= funciones de selección de datos =================

function seleccionar_areas() {
global $conexion;

$query = "SELECT id_area, area FROM areas";


$stmt = mysqli_stmt_init($conexion);

$preparar = mysqli_stmt_prepare($stmt, $query);

if(!$preparar) {
    die('QUERY FALLLIDO' . mysqli_error($conexion));
} else {
		
	mysqli_stmt_execute($stmt);
		 
	$selec_areas = mysqli_stmt_get_result($stmt);
	
	while ($fila = mysqli_fetch_assoc($selec_areas)) {
		$id_area = $fila['id_area'];	
		$area = $fila['area'];
	
		echo "<option value='$id_area'>$area</option>";	
	}
}

}

function seleccionar_modalidad() {
global $conexion;

$query = "SELECT id_modalidad, modalidad FROM modalidad_curso";


$stmt = mysqli_stmt_init($conexion);

$preparar = mysqli_stmt_prepare($stmt, $query);

if(!$preparar) {
    die('QUERY FALLLIDO' . mysqli_error($conexion));
} else {

	mysqli_stmt_execute($stmt);
		 
	$selec_modalidad = mysqli_stmt_get_result($stmt);
	
	while ($fila = mysqli_fetch_assoc($selec_modalidad)) {
		$id_modalidad = $fila['id_modalidad'];	
		$modalidad = $fila['modalidad'];
	
		echo "<option value='$id_modalidad'>$modalidad</option>";	
	}
	
	}

}

function seleccionar_horario() {
global $conexion;

$query = "SELECT id_horario, horario FROM horario_curso";


$stmt = mysqli_stmt_init($conexion);

$preparar = mysqli_stmt_prepare($stmt, $query);

if(!$preparar) {
    die('QUERY FALLLIDO' . mysqli_error($conexion));
} else {

	mysqli_stmt_execute($stmt);
	 
	$selec_horario = mysqli_stmt_get_result($stmt);

	while ($fila = mysqli_fetch_assoc($selec_horario)) {
		$id_horario = $fila['id_horario'];	
		$horario = $fila['horario'];

		echo "<option value='$id_horario'>$horario</option>";	
	}
}

}

function seleccionar_profesores() {

global $conexion;

$query = "SELECT ci_profesor, nombre_profesor, apellido_profesor, areas.area FROM profesor ";
$query .= "INNER JOIN areas ON profesor.id_area = areas.id_area ";


$stmt = mysqli_stmt_init($conexion);

$preparar = mysqli_stmt_prepare($stmt, $query);

if(!$preparar) {
    die('QUERY FALLLIDO' . mysqli_error($conexion));
} else {

	mysqli_stmt_execute($stmt);
 
	$selec_profesor = mysqli_stmt_get_result($stmt);

	while ($fila = mysqli_fetch_assoc($selec_profesor)) {
		$ci_profesor = $fila['ci_profesor'];	
		$nombre_profesor = $fila['nombre_profesor'];
		$apellido_profesor = $fila['apellido_profesor'];
		$area = $fila['area'];

		echo "<option value='$ci_profesor'>$nombre_profesor  $apellido_profesor - $area</option>";	

	}	

}

}

function seleccionar_credenciales() {

global $conexion;

$query = "SELECT id_cred, credencial FROM credenciales_prof ";

$stmt = mysqli_stmt_init($conexion);

$preparar = mysqli_stmt_prepare($stmt, $query);

if(!$preparar) {
    die('QUERY FALLLIDO' . mysqli_error($conexion));
} else {

	mysqli_stmt_execute($stmt);
 
	$selec_credencial = mysqli_stmt_get_result($stmt);

	while ($fila = mysqli_fetch_assoc($selec_credencial)) {
	$id_cred = $fila['id_cred'];	
	$credencial = $fila['credencial'];

	echo "<option value='$id_cred'>$credencial</option>";	

	}

}

}

function seleccionar_cursos() {
	global $conexion;
	
	$query = "SELECT id_curso, nombre_curso FROM curso";
	
	$stmt = mysqli_stmt_init($conexion);
	$preparar = mysqli_stmt_prepare($stmt, $query);
	
	if(!$preparar) {
		die('QUERY FALLLIDO' . mysqli_error($conexion));
	} else {
			
		mysqli_stmt_execute($stmt);	 
		$seleccionar_curso = mysqli_stmt_get_result($stmt);
		
		while ($fila = mysqli_fetch_assoc($seleccionar_curso)) {
			$id_curso = $fila['id_curso'];	
			$nombre = $fila['nombre_curso'];
		
			echo "<option value='$id_curso'>$nombre</option>";	
		}
	}
	
	}
	
function seleccionar_materiales() {
	global $conexion;
	
	$query = "SELECT id_materiales, nombre FROM material_curso";
	
	$stmt = mysqli_stmt_init($conexion);
	$preparar = mysqli_stmt_prepare($stmt, $query);
	
	if(!$preparar) {
		die('QUERY FALLLIDO' . mysqli_error($conexion));
	} else {
			
		mysqli_stmt_execute($stmt);	 
		$seleccionar_materiales = mysqli_stmt_get_result($stmt);
		
		while ($fila = mysqli_fetch_assoc($seleccionar_materiales)) {
			$id_materiales = $fila['id_materiales'];	
			$nombre_material = $fila['nombre'];
		
			echo "<option value='$id_materiales'>$nombre_material</option>";	
		}
	}
	
	}


// ================= Funciones para seleccionar datos y mostrarlos en paginas de "editar" =================

function seleccionar_areas_editar($valor) {
	global $conexion;

	$query = "SELECT id_area, area FROM areas";

	$stmt = mysqli_stmt_init($conexion);

	$preparar = mysqli_stmt_prepare($stmt, $query);

	if(!$preparar) {
		die('Query Fallido' . mysqli_error($conexion)); 
	} else {

	mysqli_stmt_execute($stmt);

	$selec_area = mysqli_stmt_get_result($stmt);

	while($fila = mysqli_fetch_assoc($selec_area)) {
		$id_area = $fila['id_area'];
		$area = $fila['area'];
	
		if($id_area == $valor) {
			echo "<option selected value='{$id_area}'>$area</option>"; 
		} else {
			echo "<option value='$id_area'>$area</option>";
		}


		}

	}
}




function seleccionar_credenciales_editar($valor) {
	global $conexion;

	$query = "SELECT id_cred, credencial FROM credenciales_prof";

	$stmt = mysqli_stmt_init($conexion);

	$preparar = mysqli_stmt_prepare($stmt, $query);

	if(!$preparar) {
		die('Query Fallido' . mysqli_error($conexion)); 
	}

	mysqli_stmt_execute($stmt);

	$selec_credencial = mysqli_stmt_get_result($stmt);

	while($fila = mysqli_fetch_assoc($selec_credencial)) {
		$id_cred = $fila['id_cred'];
		$credencial = $fila['credencial'];
	
		if($id_cred == $valor) {
			echo "<option selected value='{$id_cred}'>$credencial</option>"; 
		} else {
			echo "<option value='$id_cred'>$credencial</option>";
		}


	}

}




function seleccionar_modalidad_editar($valor) {
	global $conexion;

	$query = "SELECT id_modalidad, modalidad FROM modalidad_curso";

	$stmt = mysqli_stmt_init($conexion);

	$preparar = mysqli_stmt_prepare($stmt, $query);

	if(!$preparar) {
		die('Query Fallido' . mysqli_error($conexion)); 
	} else {

	mysqli_stmt_execute($stmt);

	$selec_modalidad = mysqli_stmt_get_result($stmt);

	while($fila = mysqli_fetch_assoc($selec_modalidad)) {
		$id_modalidad = $fila['id_modalidad'];
		$modalidad = $fila['modalidad'];
	
		if($id_modalidad == $valor) {
			echo "<option selected value='{$id_modalidad}'>$modalidad</option>"; 
		} else {
			echo "<option value='$id_modalidad'>$modalidad</option>";
		}


		}

	}
}


function seleccionar_horario_editar($valor) {
	global $conexion;

	$query = "SELECT id_horario, horario FROM horario_curso";

	$stmt = mysqli_stmt_init($conexion);

	$preparar = mysqli_stmt_prepare($stmt, $query);

	if(!$preparar) {
		die('Query Fallido' . mysqli_error($conexion)); 
	} else {

	mysqli_stmt_execute($stmt);

	$selec_horario = mysqli_stmt_get_result($stmt);

	while($fila = mysqli_fetch_assoc($selec_horario)) {
		$id_horario = $fila['id_horario'];
		$horario = $fila['horario'];
	
		if($id_horario == $valor) {
			echo "<option selected value='{$id_horario}'>$horario</option>"; 
		} else {
			echo "<option value='$id_horario'>$horario</option>";
		}


		}

	}
}


function seleccionar_profesor_editar($valor) {
	global $conexion;

	$query = "SELECT ci_profesor, nombre_profesor, apellido_profesor, areas.area FROM profesor ";
	$query .= "INNER JOIN areas ON profesor.id_area = areas.id_area";

	$stmt = mysqli_stmt_init($conexion);

	$preparar = mysqli_stmt_prepare($stmt, $query);

	if(!$preparar) {
		die('Query Fallido' . mysqli_error($conexion)); 
	} else {

	mysqli_stmt_execute($stmt);

	$selec_profesor = mysqli_stmt_get_result($stmt);

 		while($fila = mysqli_fetch_assoc($selec_profesor)) {
		$ci_profesor = $fila['ci_profesor'];
		$nombre_profesor = $fila['nombre_profesor'];
		$apellido_profesor = $fila['apellido_profesor'];
		$area = $fila['area'];
	
		if($ci_profesor == $valor) {
			echo "<option selected value='{$ci_profesor}'>$nombre_profesor $apellido_profesor - $area</option>"; 
		} else {
			echo "<option value='$ci_profesor'>$nombre_profesor $apellido_profesor - $area</option>";
		}


		}

	}
}


function seleccionar_curso_editar($valor) {
	global $conexion;

	$query = "SELECT id_curso, nombre_curso FROM curso ";

	$stmt = mysqli_stmt_init($conexion);
	$preparar = mysqli_stmt_prepare($stmt, $query);

	if(!$preparar) {
		die('Query Fallido' . mysqli_error($conexion)); 
	} else {

	mysqli_stmt_execute($stmt);
	$selec_curso = mysqli_stmt_get_result($stmt);

 		while($fila = mysqli_fetch_assoc($selec_curso)) {
		$id_curso = $fila['id_curso'];
		$nombre_curso = $fila['nombre_curso'];
	
		
		if($id_curso == $valor) {
			echo "<option selected value='{$id_curso}'>$nombre_curso</option>"; 
		} 
		}

	}
}


function seleccionar_material_editar($valor) {
	global $conexion;

	$query = "SELECT id_materiales, nombre FROM material_curso ";

	$stmt = mysqli_stmt_init($conexion);
	$preparar = mysqli_stmt_prepare($stmt, $query);

	if(!$preparar) {
		die('Query Fallido' . mysqli_error($conexion)); 
	} else {

	mysqli_stmt_execute($stmt);
	$selec_material = mysqli_stmt_get_result($stmt);

 		while($fila = mysqli_fetch_assoc($selec_material)) {
		$id_materiales = $fila['id_materiales'];
		$nombre_materiales = $fila['nombre'];
	
		if($id_materiales == $valor) {
			echo "<option selected value='{$id_materiales}'>$nombre_materiales</option>"; 
		} else {
			echo "<option value='$id_materiales'>$nombre_materiales</option>";
		}


		}

	}
}

function editarMaterial($valor)
{

	global $conexion;

	$nombre_material = $_POST['nombre_material'];
	$categoría = $_POST['categoría'];
	$tipo = $_POST['tipo'];

	$query = "UPDATE material_curso SET ";
	$query .= "nombre = ?, ";
	$query .= "categoría = ?, ";
	$query .= "tipo = ? ";
	$query .= "WHERE id_materiales = ? ";


	$stmt = mysqli_stmt_init($conexion);

	$preparar = mysqli_stmt_prepare($stmt, $query);

	if(!$preparar) {
		die('Query fallido' . mysqli_error($conexion));
	} else {

		mysqli_stmt_bind_param($stmt, "sssi", $nombre_material, $categoría, $tipo, $valor);
		mysqli_stmt_execute($stmt);
		echo "<center><h3>Material editado exitosamente </h3><a class='mensaje-exitoso' href='materiales.php'>Volver a sección de materiales.</a></center>";

	}
}


function borrarDatos($query, $valor)
{
	global $conexion;
	
	$stmt = mysqli_stmt_init($conexion);
	$preparar = mysqli_stmt_prepare($stmt, $query);

	if(!$preparar) {
	    die('Query Fallido' . mysqli_error($conexion));
	} else {
	    mysqli_stmt_bind_param($stmt, "i", $valor);
	    mysqli_stmt_execute($stmt);
}
}


// ================= Funciones de registro e ingreso =================

function salir()
{
	
session_start(); 
unset($_SESSION['ci']);
unset($_SESSION['nombre']);
unset($_SESSION['apellido']);
unset($_SESSION['usuario']);
unset($_SESSION['email']);
unset($_SESSION['rol']);
session_destroy();

header("Location: ../index.php");

}


function usuario_existe($valor)
{
	global $conexion;
	$query = "SELECT usuario FROM usuarios WHERE usuario = ?";
	$stmt = mysqli_stmt_init($conexion);
	$preparar = mysqli_stmt_prepare($stmt, $query);

	if (!$preparar) {
		die('Query fallido' . mysqli_error($conexion));
	} else { 
		mysqli_stmt_bind_param($stmt, "s", $valor);
		mysqli_stmt_execute($stmt);
		$resultado = mysqli_stmt_get_result($stmt);
		if (mysqli_num_rows($resultado) >= 1) {
			return true;
		}

	}
}

function email_existe($valor)
{
	global $conexion;
	$query = "SELECT email FROM usuarios WHERE email = ?";
	$stmt = mysqli_stmt_init($conexion);
	$preparar = mysqli_stmt_prepare($stmt, $query);

	if (!$preparar) {
		die('Query fallido' . mysqli_error($conexion));
	} else { 
		mysqli_stmt_bind_param($stmt, "s", $valor);
		mysqli_stmt_execute($stmt);
		$resultado = mysqli_stmt_get_result($stmt);
		if (mysqli_num_rows($resultado) >= 1) {
			return true;
		}

	}
}

function usuario_ya_registrado($valor, $valor_curso)
{
	global $conexion;
	$query = "SELECT id_uc FROM usuario_y_curso WHERE ci_usuario = ? && id_curso = ?";
	$stmt = mysqli_stmt_init($conexion);
	$preparar = mysqli_stmt_prepare($stmt, $query);

	if (!$preparar) {
		die('Query fallido' . mysqli_error($conexion));
	} else { 
		mysqli_stmt_bind_param($stmt, "ii", $valor, $valor_curso);
		mysqli_stmt_execute($stmt);
		$resultado = mysqli_stmt_get_result($stmt);
		if (mysqli_num_rows($resultado) >= 1) {
			return true;
		}

	}
}

function material_existe($valor, $valor_curso)
{
	global $conexion;
	$query = "SELECT id_mc FROM materiales_y_curso WHERE id_materiales = ? && id_curso = ?";
	$stmt = mysqli_stmt_init($conexion);
	$preparar = mysqli_stmt_prepare($stmt, $query);

	if (!$preparar) {
		die('Query fallido' . mysqli_error($conexion));
	} else { 
		mysqli_stmt_bind_param($stmt, "ii", $valor, $valor_curso);
		mysqli_stmt_execute($stmt);
		$resultado = mysqli_stmt_get_result($stmt);
		if (mysqli_num_rows($resultado) >= 1) {
			return true;
		}

	}
}
