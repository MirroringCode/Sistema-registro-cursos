<!-- Página para ver el listado de un curso -->
<table class="estilo-tabla">
    <thead>
        <tr>
        <th>CI</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Estado</th>
        <th>Cambiar estado a "en progreso"</th>
        <th>Cambiar estado a "completado"</th>
        <th>Sacar de curso</th>

        </tr>
    </thead>

    <tbody>

<?php 

    // Obtiene la id del curso cuyos datos vamos a seleccionar

    if(isset($_GET['lista_curso'])) {

        $id_listado = $_GET['lista_curso'];

    }

    echo "<h2>Listado de alumnos en curso</h2>";

    // Comandos SQL y sentencias preparadas para seleccionar a los estudiantes inscritos en el curso seleccionado

    $query = "SELECT curso.id_curso, usuario_y_curso.id_uc, usuarios.ci_usuario, usuarios.primer_nombre, usuarios.apellido, estado FROM usuario_y_curso ";
    $query .= "INNER JOIN usuarios ON usuario_y_curso.ci_usuario = usuarios.ci_usuario ";
    $query .= "INNER JOIN curso ON usuario_y_curso.id_curso = curso.id_curso ";
    $query .= "WHERE usuario_y_curso.id_curso = ?";

    $stmt = mysqli_stmt_init($conexion);
    $preparar = mysqli_stmt_prepare($stmt, $query);

    if(!$preparar) { 
        die('Query fallido' . mysqli_error($conexion));
    } else {

    mysqli_stmt_bind_param($stmt, "i", $id_listado);
    mysqli_stmt_execute($stmt);
    $seleccionar_usuarios_registrados = mysqli_stmt_get_result($stmt);

    while ($fila = mysqli_fetch_assoc($seleccionar_usuarios_registrados)) {
        $ci_usuario = $fila['ci_usuario'];
        $id_uc = $fila['id_uc'];
        $id_curso = $fila['id_curso'];
        $nombre = $fila['primer_nombre'];
        $apellido = $fila['apellido'];
        $estado = $fila['estado'];
        
        echo "<tr>";
        echo "<td>$ci_usuario</td>";
        echo "<td>$nombre</td>";        
        echo "<td>$apellido</td>";        
        echo "<td>$estado</td>";

        // Formularios para cambiar el estado del progreso del alumno, ya sea a "en progreso" o "completado" por medio del método POST

        echo "<form action='' method='POST'>";
        echo "<input type='hidden' name='id_en_progreso' value='$id_uc'>";
        echo "<td><input type='submit' name='marcar_en_progreso' class='boton-cambio' value='Marcar En progreso'></td>"; 
        echo "</form>";
        echo "<form action='' method='POST'>";
        echo "<input type='hidden' name='id_completado' value='$id_uc'>";
        echo "<td><input type='submit' name='marcar_completado' class='boton-cambio' value='Marcar completado'></td>"; 
        echo "</form>";

        // Saca al alumno del curso por medio del método POST
        echo "<form action='' method='POST'>";
        echo "<input type='hidden' name='id_sacar' value='$id_uc'>";
        echo "<td><input type='submit' name='sacar' class='boton-activo boton-borrar' onClick=\"javascript: return confirm('¿Está seguro de que quiere borrar? (esta acción no se puede deshacer)'); \" value='Sacar usuario'></td>"; 
        echo "</form>";

        echo "</tr>";        
        
    }
}

?>
</tbody>
</table>

<div>
    <a class="boton-activo" href="cursos.php">Volver a sección de cursos</a>
</div>

<?php

// Función con comandos SQL para sacar al estudiante del curso
if(isset($_POST['sacar'])) {
	$id_sacar = $_POST['id_sacar'];
	
	$query = "DELETE FROM usuario_y_curso WHERE id_uc = ? ";
	borrarDatos($query, $id_sacar);
	header("Location: cursos.php?direccion=listado&lista_curso=$id_curso");
	
}

// Funciones con comandos SQL para cambiar el estado del progreso del estudiante

if (isset($_POST['marcar_completado'])) {
 
    $id_completado = $_POST['id_completado'];

    $query = "UPDATE usuario_y_curso SET estado = 'Completado' WHERE id_uc = ? ";
    $stmt = mysqli_stmt_init($conexion);
    $preparar = mysqli_stmt_prepare($stmt, $query);

    if (!$preparar) {
        die('Query fallido' . mysqli_error($conexion));
    } else {

        mysqli_stmt_bind_param($stmt, "i", $id_completado);
        mysqli_stmt_execute($stmt);
        header("Location: cursos.php?direccion=listado&lista_curso=$id_curso");

    }
}

if (isset($_POST['marcar_en_progreso'])) {
 
    $id_EnProgreso = $_POST['id_en_progreso'];

    $query = "UPDATE usuario_y_curso SET estado = 'En progreso' WHERE id_uc = ? ";
    $stmt = mysqli_stmt_init($conexion);
    $preparar = mysqli_stmt_prepare($stmt, $query);

    if (!$preparar) {
        die('Query fallido' . mysqli_error($conexion));
    } else {

        mysqli_stmt_bind_param($stmt, "i", $id_EnProgreso);
        mysqli_stmt_execute($stmt);
        header("Location: cursos.php?direccion=listado&lista_curso=$id_curso");

    }
}





?>