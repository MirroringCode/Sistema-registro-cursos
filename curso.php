<?php include_once("includes/encabezado.php"); ?>
<?php include_once("includes/navegacion.php"); ?>


<?php 

if(isset($_GET['id_c'])) {
    
    $url_id_curso = mysqli_real_escape_string($conexion, $_GET['id_c']);

	//array almacena valores equivalentes a las credenciales de profesores
    $credencialesArray = array('licenciatura' => 1, 'maestría' => 2, 'doctorado' => 3);

?>

	<div class="contenedor contenedor-header">
		<main>
		<h1 class="titulo-lista-cursos">Nuestros cursos</h1>	
		
		
		<?php
		
		//comandos SQL para seleccionar datos de tablas curso, modalidad_curso, horario_curso, modalidad_curso, areas y profesor

		$query = "SELECT id_curso, nombre_curso, descripcion, dificultad, fecha, imagen, "; 
		$query .= "areas.area, modalidad_curso.modalidad, ";
        $query .= "horario_curso.horario, profesor.nombre_profesor, profesor.apellido_profesor, profesor.id_cred, profesor.ci_profesor FROM curso ";

        $query .= "INNER JOIN areas ON curso.id_area = areas.id_area ";
		$query .= "INNER JOIN modalidad_curso ON curso.id_modalidad = modalidad_curso.id_modalidad ";
		$query .= "INNER JOIN horario_curso ON curso.id_horario = horario_curso.id_horario ";
		$query .= "INNER JOIN profesor ON curso.ci_profesor = profesor.ci_profesor ";

		$query .= "WHERE id_curso = ? ";
		

		//crea consulta para mostrar cursos
		$stmt = mysqli_stmt_init($conexion);

		$preparar = mysqli_stmt_prepare($stmt, $query);

		//termina la conexion en caso de que haya un fallo
		if(!$preparar) {
			die('Query fallido' . mysqli_error($conexion));
		} else {
		
		mysqli_stmt_bind_param($stmt, "i", $url_id_curso);

		mysqli_stmt_execute($stmt);

		$seleccionar_curso = mysqli_stmt_get_result($stmt);

		//bucle while que extrae y coloca los datos de la base de datos en un array para mostrarlos en la pagina
		while($fila = mysqli_fetch_assoc($seleccionar_curso)) {

  			$id_curso = $fila['id_curso'];
			$nombre_curso = $fila['nombre_curso'];
			$descripcion_curso = $fila['descripcion'];
			$dificultad_curso = $fila['dificultad'];
			$area_curso = $fila['area'];
			$fecha_curso = $fila['fecha'];
			$img_curso = $fila['imagen'];
			$modalidad_curso = $fila['modalidad'];

			$ci_profesor = ['ci_profesor'];
            $nombre_profesor = $fila['nombre_profesor'];
            $apellido_profesor = $fila['apellido_profesor'];
            $credenciales = $fila['id_cred'];
            $horario_curso = $fila['horario'];

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

			<p>Dificultad: <?php echo $dificultad_curso; ?>.</p>
			<p>Area: <?php echo $area_curso; ?>.</p>
			<p>Modalidad: <?php echo $modalidad_curso; ?>.</p>
			<p><?php echo $descripcion_curso; ?></p>

			<!-- condiciones que muestran al titulo del profesor dependiendo del valor asignado en base de datos  -->
			<?php if($credenciales == $credencialesArray['licenciatura']): ?>

			<p>Impartido por Licenciado/a <?php echo $nombre_profesor . " " . $apellido_profesor; ?>.</p>
				            
			<?php elseif($credenciales == $credencialesArray['maestría']): ?>

			<p>Impartido por Magister <?php echo $nombre_profesor . " " . $apellido_profesor; ?>.</p>

			<?php elseif($credenciales == $credencialesArray['doctorado']): ?>

			<p>Impartido por Doctor/a <?php echo $nombre_profesor . " " . $apellido_profesor; ?>.</p>	

			<?php endif; ?>

            <p>Horario de <?php echo $horario_curso; ?>.</p>		
			</article>

	<?php } } 

		if ($url_id_curso != $id_curso || $url_id_curso == '' || $url_id_curso == null) {

			header("Location: lista_cursos.php");
		} 

	} else {

		header("Location: lista_cursos.php");		
	
	}
	?>

		</div>
		</main>
	
		<?php include_once("includes/barra_lateral.php"); ?>

	</div>	

<?php include_once("includes/pie.php"); ?>