<?php 

// Obtien la cedula del profesor cuyos datos van a ser editados

if(isset($_GET['ci_p'])) {
	$ci_pro = $_GET['ci_p'];

}  

// Comandos SQL y sentencias preparadas para selccionar los datos del profesor a editar
$query = "SELECT nombre_profesor, apellido_profesor, id_area, id_cred FROM profesor ";
$query .= "WHERE ci_profesor = ? ";

$stmt = mysqli_stmt_init($conexion);

$preparar = mysqli_stmt_prepare($stmt, $query);

if(!$preparar) {
	die('Query fallido' . mysqli_error($conexion));  
} else {

	mysqli_stmt_bind_param($stmt, "i", $ci_pro);
	mysqli_stmt_execute($stmt);
	$seleccionar_datos_prof = mysqli_stmt_get_result($stmt);

	while($fila = mysqli_fetch_assoc($seleccionar_datos_prof)) {
		$nombre_profesor = $fila['nombre_profesor'];
		$apellido_profesor = $fila['apellido_profesor'];
		$area = $fila['id_area'];
		$credenciales = $fila['id_cred'];
	}
}

// Selecciona datos del formulario

if(isset($_POST['editar_profesor'])) {

	$nombre_profesor = $_POST['nombre_profesor'];
	$apellido_profesor = $_POST['apellido'];
	$area = $_POST['area'];
	$credenciales = $_POST['credenciales'];

	$nombre_profesor = mysqli_real_escape_string($conexion, $nombre_profesor);
	$apellido_profesor = mysqli_real_escape_string($conexion, $apellido_profesor);
	$area = mysqli_real_escape_string($conexion, $area);
	$credenciales = mysqli_real_escape_string($conexion, $credenciales);

// Comandos SQL y sentencias preparadas para actualizar los datos del profesor con los ingresados en el formulario

	$query = "UPDATE profesor SET ";
	$query .= "nombre_profesor = ?, ";
	$query .= "apellido_profesor = ?, ";
	$query .= "id_area = ?, ";
	$query .= "id_cred = ? ";
	$query .= "WHERE ci_profesor = ? ";


	$stmt = mysqli_stmt_init($conexion);

	$preparar = mysqli_stmt_prepare($stmt, $query);

	if(!$preparar) {
		die('Query fallido' . mysqli_error($conexion));
	} else {

		mysqli_stmt_bind_param($stmt, "ssiii", $nombre_profesor, $apellido_profesor, $area, $credenciales, $ci_pro);
		mysqli_stmt_execute($stmt);
		echo "<center><h3>Profesor editado exitosamente </h3><a class='mensaje-exitoso' href='profesores.php'>Volver a la ventana de profesores.</a></center>";

	}
}


?>

<div>
    <a class="boton-activo" href="profesores.php">Volver a sección de profesores</a>
</div>

<div class="contenedor-principal-form">
<form id="añadir-profesor" class="crear-profesor" action="" method="POST">
<div class="direccion-texto">

<div class="contenedor-titulo">
	<h3 id="titulo">Editar profesor</h3>
</div>

<label for="nombre-profesor" id="etiqueta-nombre-profesor">Nombre profesor: </label>
<input type="text" id="nombre-profesor" name="nombre_profesor" value="<?php echo $nombre_profesor; ?>">

<label for="apellido-profesor" id="etiqueta-apellido-profesor">Apellido profesor: </label>
<input type="text" id="apellido-profesor" name="apellido" value="<?php echo $apellido_profesor; ?>">

<label for="area" id="etiqueta-area">Area: </label>
<select id="area" name="area" value="<?php echo $area; ?>">
	<?php seleccionar_areas_editar($area); ?>
</select>

<label for="credenciales" id="etiqueta-credenciales">Credenciales: </label>
<select id="credenciales" name="credenciales">
	<?php seleccionar_credenciales_editar($credenciales); ?>
</select>


<div class="direccion-botones">
	<button type="submit" class="boton-enviar" id="enviar" name="editar_profesor">Editar</button>
	<button type="reset" class="boton-reset">Restablecer</button>
</div>
</div>	

</form>
</div>
<script src="admin_scripts/validar_prof.js"></script>