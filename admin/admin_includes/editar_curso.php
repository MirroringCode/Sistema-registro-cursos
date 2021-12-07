<!-- Página para editar datos de un curso -->

<?php 


if(isset($_GET['id_c'])) {
	// Obtiene la id del curso que se quiere editar
	$curso = $_GET['id_c'];

}

//comandos sql y sentencias preparadas para seleccionar datos de la base de datos y mostrar los que están actualmente creados
$query = "SELECT id_curso, nombre_curso, descripcion, dificultad, id_area, imagen, ci_profesor, id_modalidad, id_horario "; 
$query .= "FROM curso WHERE id_curso = ? ";

$stmt = mysqli_stmt_init($conexion);
 
$preparar = mysqli_stmt_prepare($stmt, $query);

if(!$preparar) {
	
	die('Query fallido' . mysqli_error($conexion));

} else {
	mysqli_stmt_bind_param($stmt, "i", $curso);
	mysqli_stmt_execute($stmt);
	$seleccionar_cursos = mysqli_stmt_get_result($stmt);

	while ($fila = mysqli_fetch_assoc($seleccionar_cursos)) {
	$nombre_curso = $fila['nombre_curso'];
	$descripcion = $fila['descripcion'];
	$dificultad = $fila['dificultad'];
	$area = $fila['id_area'];
	$imagen = $fila['imagen'];
	$profesor = $fila['ci_profesor'];
	$modalidad = $fila['id_modalidad'];
	$horario = $fila['id_horario'];
}

}




// Obtiene datos del formulario
if(isset($_POST['editar_curso'])) {

$nombre_curso = $_POST['nombre_curso'];
$dificultad = $_POST['dificultad_curso'];
$area = $_POST['area_curso'];
$modalidad = $_POST['modalidad_curso'];

$imagen = $_FILES['imagen']['name'];
$imagen_tmp = $_FILES['imagen']['tmp_name'];

$horario = $_POST['horario_curso'];
$profesor = $_POST['profesor'];
$descripcion = $_POST['descripcion'];

$nombre_curso = mysqli_real_escape_string($conexion, $nombre_curso);
$dificultad = mysqli_real_escape_string($conexion, $dificultad);
$area = mysqli_real_escape_string($conexion, $area);
$modalidad = mysqli_real_escape_string($conexion, $modalidad);
$imagen = mysqli_real_escape_string($conexion, $imagen);
$horario = mysqli_real_escape_string($conexion, $horario);
$profesor = mysqli_real_escape_string($conexion, $profesor);
$descripcion = mysqli_real_escape_string($conexion, $descripcion);

move_uploaded_file($imagen_tmp, "../imagenes/$imagen");

// Selecciona la imagen actual del curso y la muestra
if(empty($imagen)) {
$query = "SELECT imagen FROM curso WHERE id_curso = ? ";

$stmt = mysqli_stmt_init($conexion);
$preparar = mysqli_stmt_prepare($stmt, $query);

if(!$preparar) {
	die("Query fallido" . mysqli_error($conexion));
} else {
	mysqli_stmt_bind_param($stmt, "i", $curso);
	mysqli_execute($stmt);
	$seleccionar_imagen = mysqli_stmt_get_result($stmt);

	while($fila = mysqli_fetch_assoc($seleccionar_imagen)) {
		$imagen = $fila['imagen'];
	}
}
}

// Comandos sql y sentencias preparadas para actualizar/editar los datos del curso usando los obtenidos del formulario

$query = "UPDATE curso SET ";
$query .= "nombre_curso = ?, ";	
$query .= "descripcion = ?, ";	
$query .= "dificultad = ?, ";	
$query .= "id_area = ?, ";	
$query .= "imagen = ?, ";	
$query .= "ci_profesor = ?, ";	
$query .= "id_modalidad = ?, ";	
$query .= "id_horario = ? ";
$query .= "WHERE id_curso = ? ";	

$stmt = mysqli_stmt_init($conexion);
$preparar = mysqli_stmt_prepare($stmt, $query);

if(!$preparar) {
	die('Query fallido' . mysqli_error($conexion));
} else {

	mysqli_stmt_bind_param($stmt, "sssisiiii", $nombre_curso, $descripcion, $dificultad, $area, $imagen, $profesor, $modalidad, $horario, $curso);
	mysqli_stmt_execute($stmt);

	echo "<center><h3>Curso editado exitosamente </h3><a class='mensaje-exitoso' href='cursos.php'>Volver a la ventana de cursos.</a></center>";
}


}



?>

<div>
    <a class="boton-activo" href="cursos.php">Volver a sección de cursos</a>
</div>

<div class="contenedor-principal-form">
	<form id="formulario-curso" class="crear-curso" action="" method="POST" enctype="multipart/form-data">
				<!-- <div class="direccion-texto"> -->
				
<div class="contenedor-titulo">
	<h3 id="titulo">Editar curso</h3>
</div>

<label for="nombre-curso" id="etiqueta-nombre-curso">Nombre curso </label>
<input type="text" id="nombre-curso" name="nombre_curso" value="<?php echo $nombre_curso; ?>">

<label for="dificultad" id="etiqueta-dificultad_curso">Dificultad </label>
<select id="dificultad-curso" name="dificultad_curso" selected value>
	<option>principiantes</option>
	<option>intermedio</option>
	<option>avanzado</option>
</select>

<label for="area" id="etiqueta-area">Area: </label>
<select id="area-curso" name="area_curso">
	<?php seleccionar_areas_editar($area); ?>		
</select>



<label for="modalidad" id="etiqueta-modalidad">Modalidad: </label>
<select id="modalidad-curso" name="modalidad_curso">
	<?php seleccionar_modalidad_editar($modalidad); ?>
</select>

<label for="imagen" id="etiqueta-imagen">Imagen: </label>
<img src="../imagenes/<?php echo $imagen; ?>">
<input type="file" id="imagen" name="imagen">

<label for="horario" id="etiqueta-horario">Horario: </label>
<select id="horario-curso" name="horario_curso">
	<?php seleccionar_horario_editar($horario); ?>
</select>

<label for="profesor" id="etiqueta-profesor">Profesor: </label>
<select id="profesor" name="profesor">
	<?php seleccionar_profesor_editar($profesor); ?>
</select>


<label for="descripcion" id="etiqueta-descripcion">Descripción: </label>
<textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>

<div class="direccion-botones">
<button type="submit" class="boton-enviar" id="enviar" name="editar_curso">Editar</button>
<button type="reset" class="boton-reset">Restablecer</button>
</div>
<!-- </div>	 -->

</form>
</div>


<script src="admin_scripts/validar_curso.js"></script>
