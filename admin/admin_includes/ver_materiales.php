<!-- Página para ver todos los materiales creados -->

<table class="estilo-tabla">
<thead>
    <tr>
        <th>Nombre</th>
        <th>Categoría</th>
        <th>Tipo</th>
    </tr>
</thead>
<tbody>

<?php 

echo "<h2>Lista de materiales</h2>";

// Comandos SQL y sentencias preparadas para seleccionar todos los datos de los materiales creados

$query = "SELECT id_materiales, nombre, categoría, tipo FROM material_curso ";

$stmt = mysqli_stmt_init($conexion);
$preparar = mysqli_stmt_prepare($stmt, $query);
if(!$preparar) {
    echo "Query fallido" . mysqli_error($conexion);
} else {

    mysqli_stmt_execute($stmt);
    $seleccionar_materiales = mysqli_stmt_get_result($stmt);
    
    while($fila = mysqli_fetch_assoc($seleccionar_materiales)) {
        $id_materiales = $fila['id_materiales'];
        $nombre = $fila['nombre'];
        $categoría = $fila['categoría'];
        $tipo = $fila['tipo'];
    
        echo "<tr>";
        echo "<td>$nombre</td>";
        echo "<td>$categoría</td>";
        echo "<td>$tipo</td>";
        echo "<td><a href='materiales.php?direccion=editar_material&id_m=$id_materiales'>Editar</td>";
        // Formulario para borrar un material por medio del método POST
        echo "<form action='' method='POST'>";
        echo "<input type='hidden' name='id_borrar' value='$id_materiales'>";
        echo "<td><input type='submit' name='borrar' class='boton-activo boton-borrar' onClick=\"javascript: return confirm('¿Está seguro de que quiere borrar? (esta acción no se puede deshacer)'); \" value='Eliminar material'></td>"; 
        echo "</form>";
        echo "</tr>";
    }

}



?>


</tbody>
</table>

<div>
    <a class="boton-activo" href="materiales.php?direccion=añadir_material">Añadir material</a>
</div>




<?php 

// Borra el material de curso con el método POST 
if(isset($_POST['borrar'])) {

    $id_borrar = $_POST['id_borrar'];

    $query = "DELETE FROM material_curso WHERE id_materiales = ? ";
    borrarDatos($query, $id_borrar);
    header("Location: materiales.php");

}


 ?>