<!-- Página para ver los materiales necesarios para un curso en el que un usuario está inscrito -->

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

    echo "<h2>Cursos con materiales necesarios</h2>";

    // Obtiene la id del curso el cual se van a ver los materiales necesarios

    if (isset($_GET['materiales_curso'])) {

        $id_materiales_url = $_GET['materiales_curso'];

        // Comandos SQL y sentencias preparadas para selccionar los materiales del curso correspondiente

        $query = "SELECT id_mc, curso.nombre_curso, material_curso.nombre, material_curso.categoría, material_curso.tipo FROM materiales_y_curso ";
        $query .= "INNER JOIN curso ON materiales_y_curso.id_curso = curso.id_curso ";
        $query .= "INNER JOIN material_curso ON materiales_y_curso.id_materiales = material_curso.id_materiales ";
        $query .= "WHERE materiales_y_curso.id_curso = ?";

        $stmt = mysqli_stmt_init($conexion);
        $preparar = mysqli_stmt_prepare($stmt, $query);
    
        if(!$preparar) { 
            die('Query fallido' . mysqli_error($conexion));
        } else {
        mysqli_stmt_bind_param($stmt, "i", $id_materiales_url);
        mysqli_stmt_execute($stmt);
        $seleccionar_materiales = mysqli_stmt_get_result($stmt);
    
        while ($fila = mysqli_fetch_assoc($seleccionar_materiales)) {
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
            echo "</tr>";        
            
        }
    }
        
    }

    
?>
</tbody>
</table>

<div>
    <a class="boton-activo" href="perfil.php">Volver a perfil</a>
</div>
