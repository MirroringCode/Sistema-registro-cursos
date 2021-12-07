
<?php 

// Selecciona la id del material a editar

if(isset($_GET['id_mc'])){

	// Comandos SQL y sentencias preparadas para seleccionar materiales a editar
	$id_mc_get = $_GET['id_mc'];

	$query = "SELECT id_mc, materiales_y_curso.id_materiales, materiales_y_curso.id_curso, curso.nombre_curso, material_curso.nombre FROM materiales_y_curso ";
	$query .= "INNER JOIN curso ON materiales_y_curso.id_curso = curso.id_curso ";
	$query .= "INNER JOIN material_curso ON materiales_y_curso.id_materiales = material_curso.id_materiales ";
	$query .= "WHERE id_mc = ?";

	$stmt = mysqli_stmt_init($conexion);
	$preparar = mysqli_stmt_prepare($stmt, $query);
	if (!$preparar) {
		die('Query fallido' . mysqli_error($conexion));
	} else {
	mysqli_stmt_bind_param($stmt, "i", $id_mc_get);
	mysqli_stmt_execute($stmt);
	$obtener_materiales_y_curso = mysqli_stmt_get_result($stmt);

	while ($fila = mysqli_fetch_assoc($obtener_materiales_y_curso)) {
		$id_mc = $fila['id_mc'];
		$id_materiales = $fila['id_materiales'];
		$id_curso = $fila['id_curso'];
		$nombre_curso = $fila['nombre_curso'];
		$nombre_material = $fila['nombre'];
	}
	}

}

?>

<?php 
		//selecciona parametros del formulario

		if (isset($_POST['editar'])) {
			
			$curso = $_POST['curso'];
			$material = $_POST['material'];
			
			$curso = mysqli_real_escape_string($conexion, $curso);
			$material = mysqli_real_escape_string($conexion, $material);

			//comando sql y sentencia preparada para introducir datos del formulario en base de datos

			$query = "UPDATE materiales_y_curso SET ";
			$query .= "materiales_y_curso.id_materiales = ?, ";
			$query .= "materiales_y_curso.id_curso = ? ";
			$query .= "WHERE id_mc = ? ";

			$stmt = mysqli_stmt_init($conexion);
			$preparar = mysqli_stmt_prepare($stmt, $query);

			if(!$preparar) {
				die('Query fallido' . mysqli_error($conexion));
			} else {

				if (material_existe($material, $curso)) {
					echo "<center><h3 class='mensaje-exitoso'>Curso ya tiene material asignado, elija otro.</h3></center>";
				} else {
					mysqli_stmt_bind_param($stmt, "iii", $material, $curso, $id_mc_get);
					mysqli_stmt_execute($stmt);
					echo "<center><h3>Material de curso editado exitosamente </h3><a class='mensaje-exitoso' href='cursos.php'>Volver a la ventana de curso.</a></center>";
				}

			}

		}

		?>
	<div>
    <a class="boton-activo" href="cursos.php">Volver a sección de cursos</a>
	</div>
		<div class="contenedor-principal-form">
		<form id="añadir-profesor" class="crear-profesor" action="" method="POST">
		<div class="direccion-texto">
		
		<div class="contenedor-titulo">
		<h3 id="titulo">Asignar materiales a un curso</h3>
		</div>
						
		<label for="curso" id="etiqueta-curso">Curso: </label>
		<select id="curso" name="curso">
			<?php seleccionar_curso_editar($id_curso); ?>
		</select>

		<label for="material" id="etiqueta-material">Materiales: </label>
		<select id="material" name="material">
			<?php seleccionar_material_editar($id_materiales); ?>
		</select>
	

		<div class="direccion-botones">
		<button type="submit" class="boton-enviar" id="enviar" name="editar">Asignar material seleccionado a curso</button>
		<button type="reset" class="boton-reset">Restablecer</button>
		</div>
		</div>	
			
		</form>
	</div>
