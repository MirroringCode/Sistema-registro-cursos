    <!-- Página para ver todos los cursos con sus materiales asignados -->

    <table>
    <thead>
        <tr>
        <th>Curso</th>
        <th>Material</th>
        <th>Categoría</th>
        <th>Tipo</th>
        </tr>
    </thead>

    <tbody>

<?php 

    echo "<h2>Materiales asignados a todos los cursos</h2>";


    // Comandos SQL y sentencias preparadas para seleccionar materiales y cursos
    $query = "SELECT id_mc, curso.nombre_curso, material_curso.nombre, material_curso.categoría, material_curso.tipo FROM materiales_y_curso ";
    $query .= "INNER JOIN curso ON materiales_y_curso.id_curso = curso.id_curso ";
    $query .= "INNER JOIN material_curso ON materiales_y_curso.id_materiales = material_curso.id_materiales";

    $stmt = mysqli_stmt_init($conexion);
    $preparar = mysqli_stmt_prepare($stmt, $query);

    if(!$preparar) { 
        die('Query fallido' . mysqli_error($conexion));
    } else {

    mysqli_stmt_execute($stmt);
    $seleccionar_materiales_y_curso = mysqli_stmt_get_result($stmt);

    while ($fila = mysqli_fetch_assoc($seleccionar_materiales_y_curso)) {
        $id_mc = $fila['id_mc'];
        $nombre_curso = $fila['nombre_curso'];
        $nombre_material = $fila['nombre'];
        $categoría = $fila['categoría'];
        $tipo = $fila['tipo'];
        
        echo "<tr>";
        echo "<td>$nombre_curso</td>";        
        echo "<td>$nombre_material</td>";        
        echo "<td>$categoría</td>";        
        echo "<td>$tipo</td>";        
        echo "<td><a href='cursos.php?direccion=asignar_nuevo_material&id_mc=$id_mc'>Editar y asignar otro material</a></td>";        

        // Formulario para eliminar el material seleccionado por el método POST
        echo "<form action='' method='POST'>";
        echo "<input type='hidden' name='id_quitar' value='$id_mc'>";
        echo "<td><input type='submit' name='quitar' class='boton-activo boton-borrar' onClick=\"javascript: return confirm('¿Está seguro de que quiere borrar? (esta acción no se puede deshacer)'); \" value='Eliminar material'></td>"; 
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

// Función para borrar el material seleccionado por medio del método POST
if(isset($_POST['quitar'])) {
	$borrar_mc = $_POST['id_quitar'];
	
	$query = "DELETE FROM materiales_y_curso WHERE id_mc = ? ";
	borrarDatos($query, $borrar_mc);
	header("Location: cursos.php?direccion=materiales_curso");
	
}

?>