<!-- Página para ver todos los cursos creados -->

<div>
<table class="estilo-tabla">
<thead>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Dificultad</th>
        <th>Area</th>
        <th>Fecha</th>
        <th>Profesor ci</th>
        <th>Modalidad</th>
        <th>Horario</th>
    </tr>
</thead>

<tbody>


<?php 

echo "<h2>Lista de cursos</h2>";


// Comandos SQL y sentencias preparadas para seleccionar los datos del curso
$query = "SELECT id_curso, nombre_curso, dificultad, fecha, ";
$query .= "areas.area, ci_profesor, modalidad_curso.modalidad, horario_curso.horario FROM curso ";
$query .= "INNER JOIN areas ON curso.id_area = areas.id_area ";
$query .= "INNER JOIN modalidad_curso ON curso.id_modalidad = modalidad_curso.id_modalidad ";
$query .= "INNER JOIN horario_curso ON curso.id_horario = horario_curso.id_horario ";

$stmt = mysqli_stmt_init($conexion);
$preparar = mysqli_stmt_prepare($stmt, $query);

if(!$preparar) {
    echo "Query fallido" . mysqli_error($conexion);
}

mysqli_stmt_execute($stmt);
$seleccionar_cursos_query = mysqli_stmt_get_result($stmt);

while($fila = mysqli_fetch_assoc($seleccionar_cursos_query)) {
    $id_curso = $fila['id_curso'];
    $nombre_curso = $fila['nombre_curso'];
    $dificultad = $fila['dificultad'];
    $area = $fila['area'];
    $fecha = $fila['fecha'];
    $profesor_ci = $fila['ci_profesor'];
    $modalidad = $fila['modalidad'];
    $horario = $fila['horario'];

    echo "<tr>";
    echo "<td>$id_curso</td>";
    echo "<td>$nombre_curso</td>";
    echo "<td>$dificultad</td>";
    echo "<td>$area</td>";
    echo "<td>$fecha</td>";
    echo "<td>$profesor_ci</td>";
    echo "<td>$modalidad</td>";
    echo "<td>$horario</td>";
    echo "<td><a href='cursos.php?direccion=listado&lista_curso=$id_curso'>Listado</td>";
    echo "<td><a href='cursos.php?direccion=editar_curso&id_c=$id_curso'>Editar</td>";
    
    // Formulario para borrar un curso por medio del método POST
    echo "<form action='' method='POST'>";
    echo "<input type='hidden' name='id_borrar' value='$id_curso'>";
    echo "<td><input type='submit' name='borrar' class='boton-activo boton-borrar' onClick=\"javascript: return confirm('¿Está seguro de que quiere borrar? (esta acción no se puede deshacer)'); \" value='Eliminar curso'></td>"; 
    echo "</form>";
    echo "</tr>";
}


?>

</tbody>
</table>
</div>



<?php 

// Función para borrar el curso seleccionado por medio del método POST
if(isset($_POST['borrar'])) {

    $id_borrar = $_POST['id_borrar'];

    $query = "DELETE FROM curso WHERE id_curso = ? ";
    borrarDatos($query, $id_borrar);
    header("Location: cursos.php");



}

 ?>
<div class="boton-activo-cont">
<a href="cursos.php?direccion=asignar" class="boton-activo">Asignar materiales a curso</a>
 <a href="cursos.php?direccion=materiales_curso" class="boton-activo">Ver cursos con materiales asignados</a>
</div>

