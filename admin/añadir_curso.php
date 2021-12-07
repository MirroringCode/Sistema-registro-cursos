<?php include_once "admin_includes/adm_encabezado.php"; ?>

<?php 
//solo pueden acceder a esta pagina los usuarios con rol admin
if($_SESSION['rol'] === 'admin') {

?>

<?php include_once "admin_includes/sidenav.php" ?>



<?php 

if(isset($_POST['crear_curso'])) {
	
	//toma los parametros del formulario
	$nombre_curso = $_POST['nombre_curso'];
	$dificultad = $_POST['dificultad_curso'];
	$area = $_POST['area_curso'];
	$fecha = date('d-m-y');
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
	$horario = mysqli_real_escape_string($conexion, $horario);
	$profesor = mysqli_real_escape_string($conexion, $profesor);
	$descripcion = mysqli_real_escape_string($conexion, $descripcion);


	move_uploaded_file($imagen_tmp, "../imagenes/$imagen" );

	//comandso sql y sentencia preparada para insertar datos del formulario en base de datos
	$query = "INSERT INTO curso(nombre_curso, descripcion, dificultad, id_area, fecha, imagen, ci_profesor, id_modalidad, id_horario) ";
	$query .= "VALUES(?, ?, ?, ?, now(), ?, ?, ?, ?) ";

	$stmt = mysqli_stmt_init($conexion);

	$preparar = mysqli_stmt_prepare($stmt, $query);

	if(!$preparar) {
		die('QUERY FALLIDO' . mysqli_error($conexion));
	} else { 
	mysqli_stmt_bind_param($stmt, "sssisiii", $nombre_curso, $descripcion, $dificultad, $area, $imagen, 
	$profesor, $modalidad, $horario);

	mysqli_execute($stmt);
	echo "<center><h3>Curso creado exitosamente </h3><a class='mensaje-exitoso' href='cursos.php'>Volver a la ventana de cursos.</a></center>";
	}

}

?>

	<div class="contenedor-principal-form">
	<form id="formulario-curso" class="crear-curso" action="" method="POST" enctype="multipart/form-data">
				<!-- <div class="direccion-texto"> -->
				
				<div class="contenedor-titulo">
					<h3 id="titulo">Agregar nuevo curso</h3>
				</div>
			
				<label for="nombre-curso" id="etiqueta-nombre-curso">Nombre curso </label>
				<input type="text" id="nombre-curso" name="nombre_curso">
				
				<label for="dificultad" id="etiqueta-dificultad_curso">Dificultad </label>
				<select id="dificultad-curso" name="dificultad_curso">
					<option>principiantes</option>
					<option>intermedio</option>
					<option>avanzado</option>
				</select>
				
				<label for="area" id="etiqueta-area">Area: </label>
				<select id="area-curso" name="area_curso">
					<?php seleccionar_areas(); ?>		
				</select>


				
				<label for="modalidad" id="etiqueta-modalidad">Modalidad: </label>
				<select id="modalidad-curso" name="modalidad_curso">
					<?php seleccionar_modalidad(); ?>
				</select>

				<label for="imagen" id="etiqueta-imagen">Imagen: </label>
				<input type="file" id="imagen" name="imagen">
				
				<label for="horario" id="etiqueta-horario">Horario: </label>
				<select id="horario-curso" name="horario_curso">
					<?php seleccionar_horario(); ?>
				</select>

				<label for="profesor" id="etiqueta-profesor">Profesor: </label>
				<select id="profesor" name="profesor">
					<?php seleccionar_profesores(); ?>
				</select>


				<label for="descripcion" id="etiqueta-descripcion">Descripción: </label>
				<textarea id="descripcion" name="descripcion"></textarea>

				<div class="direccion-botones">
				<button type="submit" class="boton-enviar" id="enviar" name="crear_curso">Crear</button>
				<button type="reset" class="boton-reset">Restablecer</button>
				</div>
			<!-- </div>	 -->
				
			</form>
		</div>



<script src="admin_scripts/validar_curso.js"></script>
<?php include_once "admin_includes/adm_pie.php" ?>
<?php 
} else {

header("Location: index.php");

}	


?>
