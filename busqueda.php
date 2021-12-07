<?php include_once("includes/encabezado.php"); ?>

<?php include_once("includes/navegacion.php"); ?>

	<div class="contenedor contenedor-header">
		<main>
		<h1 class="titulo-lista-cursos">Nuestros cursos</h1>	
		
		
		<?php
		/*Obtenemos la busqueda del usuario */
	

		if (isset($_POST['buscar'])) {
			$busqueda = $_POST['campo_busqueda'];
		
		/*secuencia de comandos SQL para seleccionar los datos de los cursos con la condición de que el area introducida por el usuario sea similar al area del curso */

			$query = "SELECT id_curso, nombre_curso, descripcion, dificultad, areas.area, fecha, imagen, modalidad_curso.modalidad FROM curso ";
			$query .= "INNER JOIN areas ON curso.id_area = areas.id_area ";
			$query .= "INNER JOIN modalidad_curso ON curso.id_modalidad = modalidad_curso.id_modalidad "; 
			$query .= "WHERE areas.area LIKE ? ";

		// crea sentencia preparada para mostrar los datos de los cursos	

			$stmt = mysqli_stmt_init($conexion);
			$preparar = mysqli_stmt_prepare($stmt, $query);
		
		//si falla, termina la conexión y muestra un error	
			if(!$preparar) {
				echo "QUERY FALLIDO" . mysqli_error($conexion);
			} else {

		// si no hay errores contínua la sentencia	
			mysqli_stmt_bind_param($stmt, "s", $busqueda);
			mysqli_stmt_execute($stmt);
			$query_busqueda = mysqli_stmt_get_result($stmt);

		// verifica la cantidad de cursos existentes en la base de dato
			$cantidad_cursos = mysqli_num_rows($query_busqueda);

		// si no hay cursos (cero) mostrara un mensaje diciendo que no hay cursos para mostrar
			if ($cantidad_cursos < 1) {
				echo "<p>No se encontraron cursos con su busqueda</p>";
			} else {

		// bucle while que coloca los datos extraídos de la base de datos en un arreglo asociativo para mostrarlos en la pagina
			
			while($fila = mysqli_fetch_assoc($query_busqueda)) {

				$id_curso = $fila['id_curso'];
				$nombre_curso = $fila['nombre_curso'];
				$descripcion_curso = substr($fila['descripcion'], 0, 100);
				$dificultad_curso = $fila['dificultad'];
				$area_curso = $fila['area'];
				$fecha_curso = $fila['fecha'];
				$img_curso = $fila['imagen'];
				$modalidad_curso = $fila['modalidad'];
	
			?>


			<!-- infomacion general de los cursos -->
			<div class="contenedor-lista-cursos">
			<article class="curso-info curso-info-childs">
			<h2><strong><?php echo $nombre_curso; ?></strong></h2>
			<img class="curso-lista-imagen" src="imagenes/<?php echo $img_curso;?>">

			<div class="direccion-fila">
			<i class="far fa-calendar"></i>
			<small><?php echo $fecha_curso; ?></small>
			</div>

			<p>Dificultad: <?php echo $dificultad_curso; ?></p>
			<p>Area: <?php echo $area_curso; ?></p>
			<p>Modalidad: <?php echo $modalidad_curso; ?></p>
			<p><?php echo $descripcion_curso; ?></p>		
			<h3><a href="curso.php?id_c=<?php echo $id_curso; ?>">Leer más</a></h3>
			</article>

	<?php } } } }?>

		</div>
		</main>
	
		<?php include_once("includes/barra_lateral.php"); ?>

	</div>	

<?php include_once("includes/pie.php"); ?>