<!-- Página para asignar un material a un curso -->

<?php 

if (isset($_POST['asignar'])) {
    
    //selecciona parametros del formulario
    $curso = $_POST['curso'];
    $material = $_POST['material'];
    
    $curso = mysqli_real_escape_string($conexion, $curso);
    $material = mysqli_real_escape_string($conexion, $material);

    //comando sql y sentencia preparada para introducir datos del formulario en base de datos
    $query = "INSERT INTO materiales_y_curso(id_materiales, id_curso) ";
    $query .= "VALUES(?, ?) ";

    $stmt = mysqli_Stmt_init($conexion);
    $preparar = mysqli_stmt_prepare($stmt, $query);

    if(!$preparar) {
        die('Query fallido' . mysqli_error($conexion));
    } else {

        // Verifica si material ya está asignado al curso
        if (material_existe($material, $curso)) {
            echo "<center><h3 class='mensaje-exitoso'>Curso ya tiene material asignado, elija otro.</h3></center>";
        } else {
            mysqli_stmt_bind_param($stmt, "ii", $material, $curso);
            mysqli_stmt_execute($stmt);
            echo "<center><h3>Material asignado a curso exitosamente </h3><a class='mensaje-exitoso' href='cursos.php'>Volver a la ventana de curso.</a></center>";
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
    <?php seleccionar_cursos(); ?>
</select>

<label for="material" id="etiqueta-material">Materiales: </label>
<select id="material" name="material">
    <?php seleccionar_materiales(); ?>
</select>


<div class="direccion-botones">
<button type="submit" class="boton-enviar" id="enviar" name="asignar">Asignar material seleccionado a curso</button>
<button type="reset" class="boton-reset">Restablecer</button>
</div>
</div>	
    
</form>
</div>
