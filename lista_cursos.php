<?php include_once("includes/encabezado.php"); ?>

<?php include_once("includes/navegacion.php"); ?>

	<div class="contenedor contenedor-header">
		<main>
		<h1 class="titulo-lista-cursos">Nuestros cursos</h1>	
		
		
		<?php

	
		
		//comandos SQL para seleccionar datos de tablas curso y modalidad_curso

		$query = "SELECT id_curso, nombre_curso, descripcion, dificultad, areas.area, fecha, imagen, modalidad_curso.modalidad FROM curso "; 
		$query .= "INNER JOIN areas ON curso.id_area = areas.id_area ";
		$query .= "INNER JOIN modalidad_curso ON curso.id_modalidad = modalidad_curso.id_modalidad ";
		$query .= "ORDER BY id_curso ASC";

		//crea sentencia preparada para mostrar cursos
		$stmt = mysqli_stmt_init($conexion);
		$preparar = mysqli_stmt_prepare($stmt, $query);

		//termina la conexion en caso de que haya un fallo	
		if(!$preparar) {
		echo "QUERY FALLIDO" . mysqli_error($conexion);
	
		} else {
		// si no hay ningun fallo continúa
		mysqli_stmt_execute($stmt);
		$seleccionar_cursos_query = mysqli_stmt_get_result($stmt);
		$cantidad_cursos = mysqli_num_rows($seleccionar_cursos_query);

		if($cantidad_cursos < 1) {
			echo "<p>No hay cursos para mostrar en este momento</p>";
		} else {

		//bucle while que extrae y coloca los datos de la base de datos en un array para mostrarlos en la pagina
		while($fila = mysqli_fetch_assoc($seleccionar_cursos_query)) {
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
			<img class="curso-lista-imagen" src="imagenes/<?php echo $img_curso; ?>">

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

	<?php } } } ?>

		</div>
		</main>
	
		<?php include_once("includes/barra_lateral.php"); ?>

	</div>	



<?php include_once("includes/pie.php"); ?>