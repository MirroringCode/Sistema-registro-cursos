<!-- Página donde el usuario va a inscribirse en cursos -->
<h2>Cursos para inscribirse</h2>



<div class="contenedor-cursos">
<?php 

// Comandos SQL y sentencias preparadas para seleccionar los datos del curso

$query = "SELECT id_curso, nombre_curso, imagen, dificultad, areas.area, profesor.nombre_profesor, profesor.apellido_profesor FROM curso ";
$query .= "INNER JOIN areas ON curso.id_area = areas.id_area ";
$query .= "INNER JOIN profesor ON curso.ci_profesor = profesor.ci_profesor ";

$stmt = mysqli_stmt_init($conexion);
$preparar = mysqli_stmt_prepare($stmt, $query);
if (!$preparar) {
    die('Query fallido' . mysqli_error($conexion));
} else {
    mysqli_stmt_execute($stmt);
    $ver_cursos = mysqli_stmt_get_result($stmt);
    while ($fila = mysqli_fetch_assoc($ver_cursos)) {
    $id_curso = $fila['id_curso'];
    $nombre = $fila['nombre_curso'];
    $dificultad = $fila['dificultad'];
    $imagen = $fila['imagen'];
    $area = $fila['area'];
    $nombre_profesor = $fila['nombre_profesor'];
    $apellido_profesor = $fila['apellido_profesor'];
?>


<div class="item-curso">
<img src="../imagenes/<?php echo $imagen; ?>" alt="">
<h1><?php echo $nombre; ?></h1>
<p>Dificultad: <?php echo $dificultad; ?></p>
<p><?php echo $area; ?></p>
<p>Instructor: <?php echo $nombre_profesor . " " . $apellido_profesor; ?></p>
<!-- Solicitud GET para que el estudiante se inscriba -->
<a href="inscribirse.php?inscripcion=<?php echo $id_curso; ?>">Inscribirse</a>
</div>
<?php

}
}

?>

</div>

<?php 

// Selecciona la id del curso al que el estudiante se va inscribir
if (isset($_GET['inscripcion'])) {
    $id_inscribirse = $_GET['inscripcion'];
    
    // Comandos SQL y sentencias preparadas donde van a insertar la ci del estudiante y la id del curso donde se está inscribiendo en la tabla "usuario_y_curso"
    $query = "INSERT INTO usuario_y_curso(id_curso, ci_usuario) VALUES(?, ?)";
    $stmt = mysqli_stmt_init($conexion);
    $preparar = mysqli_stmt_prepare($stmt, $query);

    if (!$preparar) {
        die('Query Fallido' . mysqli_error($conexion));
    } else {
        // Verifica si el usuario ya está inscrito en ese curso y manda una alerta
        if(usuario_ya_registrado($_SESSION['ci'], $id_inscribirse)) {
            echo "<script>alert('Ya estas registrado en este curso.')</script>";
        } else {
            mysqli_stmt_bind_param($stmt, "ii", $id_inscribirse, $_SESSION['ci']);
            mysqli_stmt_execute($stmt);
            echo "<script>alert('Te has inscrito en este curso.')</script>";
        }
        
    }




}


?>

