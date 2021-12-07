<!-- Página para ver todos los profesores registrados -->
<table id="estilo-tabla">
<thead>
    <tr>
        <th>CI</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Area</th>
        <th>Credenciales</th>
    </tr>
</thead>

<tbody>


<?php 

echo "<h2>Lista de profesores</h2>";

// Comandos SQL y sentencias preparadas para seleccionar los datos de los profesores
$query = "SELECT ci_profesor, nombre_profesor, apellido_profesor, areas.area, credenciales_prof.credencial FROM profesor " ;
$query .= "INNER JOIN areas ON profesor.id_area = areas.id_area ";
$query .= "INNER JOIN credenciales_prof ON profesor.id_cred = credenciales_prof.id_cred ";


$stmt = mysqli_stmt_init($conexion);
$preparar = mysqli_stmt_prepare($stmt, $query);

if(!$preparar) {
    echo "Query fallido" . mysqli_error($conexion);
} 

mysqli_stmt_execute($stmt);
$seleccionar_profesores = mysqli_stmt_get_result($stmt);

while($fila = mysqli_fetch_assoc($seleccionar_profesores)) {
    $ci_profesor = $fila['ci_profesor'];
    $nombre_profesor = $fila['nombre_profesor'];
    $apellido_profesor = $fila['apellido_profesor'];
    $area = $fila['area'];
    $credencial = $fila['credencial'];
 

    echo "<tr>";
    echo "<td>$ci_profesor</td>";
    echo "<td>$nombre_profesor</td>";
    echo "<td>$apellido_profesor</td>";
    echo "<td>$area</td>";
    echo "<td>$credencial</td>";
    echo "<td><a href='profesores.php?direccion=editar_profesor&ci_p=$ci_profesor'>Editar</td>";

    // Formulario para borrar al profesor seleccionado por medio del método POST
    echo "<form action='' method='POST'>";
    echo "<input type='hidden' name='ci_borrar' value='$ci_profesor'>";
    echo "<td><input type='submit' name='borrar' class='boton-activo boton-borrar' onClick=\"javascript: return confirm('¿Está seguro de que quiere borrar? (esta acción no se puede deshacer)'); \" value='Eliminar profesor'></td>"; 
    echo "</form>";
    echo "</tr>";
}


?>

</tbody>
</table>

<div>
    <a class="boton-activo" href="profesores.php?direccion=añadir_profesor">Añadir profesor</a>
</div>


<?php 

// Función para borrar al profesor seleccionado por el método POST
if(isset($_POST['borrar'])) {

    $ci_borrar = $_POST['ci_borrar'];

    $query = "DELETE FROM profesor WHERE ci_profesor = ? ";
    borrarDatos($query, $ci_borrar);
    header("Location: profesores.php");

}


 ?>
