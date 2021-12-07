<?php include_once("includes/encabezado.php"); ?>

<?php include_once("includes/navegacion.php"); ?>





<?php 

/*Obtenemos "area_curso" de la solicitud GET proveniente del URL y de los links
de la barra lateral, también nos aseguramos de que esté presente */

/* declaramos una variable que va almacenar ese valor("area_curso") y
que utilizaremos luego */

if (isset($_GET['area_curso'])) {
    $area_curso = mysqli_real_escape_string($conexion, $_GET['area_curso']);  
 

?>

	<div class="contenedor contenedor-header">
		<main>
		<h2 class="titulo-lista-cursos">Cursos por el area de <?php echo $area_curso; ?> </h2>	
		
		<?php		
		/*comandos SQL para seleccionar datos del curso con la condición de que el area del curso 
        sea igual al valor de la variable $area_curso */

		$query = "SELECT id_curso, nombre_curso, descripcion, dificultad, fecha, imagen, ";  
		$query .= "areas.area, modalidad_curso.modalidad FROM curso ";
		$query .= "INNER JOIN areas ON curso.id_area = areas.id_area ";
		$query .= "INNER JOIN modalidad_curso ON curso.id_modalidad = modalidad_curso.id_modalidad ";
		$query .= "WHERE areas.area = ? ";

		

		//crea sentencia preparada para mostrar cursos
		
		$stmt = mysqli_stmt_init($conexion);

		$preparar = mysqli_stmt_prepare($stmt, $query);


		if(!$preparar) {
			//termina la conexion en caso de que haya un fallo
			echo "QUERY FALLIDO" . mysqli_error($conexion);
		} else {

		mysqli_stmt_bind_param($stmt, "s", $area_curso);

		mysqli_stmt_execute($stmt);

		$seleccionar_cursos_query = mysqli_stmt_get_result($stmt);


		$cantidad_cursos = mysqli_num_rows($seleccionar_cursos_query);
		
		if($cantidad_cursos < 1) {
			echo "<p>No hay cursos para mostrar en este momento</p>";
		} else {



		//bucle while que coloca los datos extraídos de la base de datos en un arreglo asociativo para mostrarlos en la pagina
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

			<!-- infomaciong general de los cursos -->
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

	<?php } }

		//condición que comprueba si el valor está vacío, de ser el caso devuelve a la lista de cursos
		if ($area_curso == '' || $area_curso == null) {
		 	
			header("Location: lista_cursos.php");

		 } 

	} 

} else {
		//si el area de curso no está establecida devuelve a lista de cursos
		header("Location: lista_cursos.php");

	}


	?>

		</div>
		</main>
	
		<?php include_once("includes/barra_lateral.php"); ?>

	</div>	

<?php include_once("includes/pie.php"); ?>