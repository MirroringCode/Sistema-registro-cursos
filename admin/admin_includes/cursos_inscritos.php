<!-- Página donde el usuario puede ver los cursos donde está inscrito -->

<table>
    <thead>
        <tr>
        <th>Nombre</th>
        <th>Dificultad</th>
        <th>Area</th>
        <th>Modalidad</th>
        <th>Horario</th>
        <th>Estado</th>
        <th>Material necesario</th>
        <th>Salirse</th>
        </tr>
    </thead>

    <tbody>

<?php 

    // Obtiene la cedula de identidad que identifica al usuario logueado 
    if(isset($_SESSION['ci'])) {

        $ci_inscrito = $_SESSION['ci'];

    }

    echo "<h2>Mis cursos</h2>";

    // Selecciona datos de la tabla usuario_y_curso con la condición de que correspondan a la cedula del usuario logueado
    $query = "SELECT id_uc, usuario_y_curso.id_curso, curso.nombre_curso, curso.dificultad, modalidad_curso.modalidad, horario_curso.horario, estado, areas.area FROM usuario_y_curso ";
    $query .= "INNER JOIN curso ON usuario_y_curso.id_curso = curso.id_curso ";
    $query .= "INNER JOIN areas ON curso.id_area = areas.id_area ";
    $query .= "INNER JOIN modalidad_curso ON curso.id_modalidad = modalidad_curso.id_modalidad ";
    $query .= "INNER JOIN horario_curso ON curso.id_horario = horario_curso.id_horario ";
    $query .= "WHERE usuario_y_curso.ci_usuario = ? ";

    $stmt = mysqli_stmt_init($conexion);
    $preparar = mysqli_stmt_prepare($stmt, $query);

    if(!$preparar) { 
        die('Query fallido' . mysqli_error($conexion));
    } else {

    mysqli_stmt_bind_param($stmt, "i", $ci_inscrito);
    mysqli_stmt_execute($stmt);
    $seleccionar_mis_cursos = mysqli_stmt_get_result($stmt);

    // Bucle while que va a insertar dentro de variables todos los datos seleccionados
    while ($fila = mysqli_fetch_assoc($seleccionar_mis_cursos)) {
        $id_uc = $fila['id_uc'];
        $id_curso = $fila['id_curso'];
        $nombre_curso = $fila['nombre_curso'];
        $dificultad = $fila['dificultad'];
        $area = $fila['area'];
        $modalidad = $fila['modalidad'];
        $horario = $fila['horario'];
        $estado = $fila['estado'];
        
    // Hace echo a los datos 
        echo "<tr>";       
        echo "<td>$nombre_curso</td>";        
        echo "<td>$dificultad</td>";        
        echo "<td>$area</td>";        
        echo "<td>$modalidad</td>";        
        echo "<td>$horario</td>";        
        echo "<td>$estado</td>";
        echo "<td><a href='perfil.php?direccion=materiales&materiales_curso=$id_curso'>Ver materiales</a></td>"; // Link a los materiales necesarios para el curso
        echo "<form action='' method='POST'>"; // Formulario con funcion de salirse del curso
        echo "<input type='hidden' name='id_salir' value='$id_uc'>";
        echo "<td><input type='submit' name='salir' class='boton-activo boton-borrar' onClick=\"javascript: return confirm('¿Está seguro de que quiere borrar? (esta acción no se puede deshacer)'); \" value='Salir de curso'></td>"; 
        echo "</form>";
        echo "</tr>";        
        
    }
}

?>
</tbody>
</table>

<div>
    <a class="boton-activo" href="perfil.php">Volver a perfil</a>
</div>

<?php 
// Función para salirse del curso obtenida de formulario
if (isset($_POST['salir'])) {
    $id_salir = $_POST['id_salir'];
    $query = "DELETE FROM usuario_y_curso WHERE id_uc = ?  ";
    borrarDatos($query, $id_salir);
    header("Location: perfil.php?direccion=cursos_inscritos&ci_inscrito={$_SESSION['ci']}");
}

?>