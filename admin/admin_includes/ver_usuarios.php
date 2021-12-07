<!-- Página para ver a todos los usuarios registrados -->
<table class="estilo-tabla">
<thead>
    <tr>
        <th>CI</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Usuario</th>
        <th>Rol</th> 
    </tr>
</thead>

<tbody>


<?php 

echo "<h2>Lista de usuarios</h2>";


// Comandos SQL y sentencias preparadas para seleccionar a los usuarios 
$query = "SELECT ci_usuario, primer_nombre, apellido, usuario, email, rol FROM usuarios ";

$stmt = mysqli_stmt_init($conexion);
$preparar = mysqli_stmt_prepare($stmt, $query);

if(!$preparar) {
    echo "Query fallido" . mysqli_error($conexion);
}

mysqli_stmt_execute($stmt);
$seleccionar_usuarios_query = mysqli_stmt_get_result($stmt);  

while($fila = mysqli_fetch_assoc($seleccionar_usuarios_query)) {
    $ci_usuario = $fila['ci_usuario'];
    $primer_nombre = $fila['primer_nombre'];
    $apellido = $fila['apellido'];
    $usuario = $fila['usuario'];
    $rol = $fila['rol'];

    echo "<tr>";
    echo "<td>$ci_usuario</td>";
    echo "<td>$primer_nombre</td>";
    echo "<td>$apellido</td>";
    echo "<td>$usuario</td>";
    echo "<td>$rol</td>";
    // Solicitudes GET para cambiar el rol del usuario
    echo "<td><a href='usuarios.php?cambiar_rol_est=$ci_usuario'>Estudiante</a></td>";
    echo "<td><a href='usuarios.php?cambiar_rol_adm=$ci_usuario'>Admin</a></td>";
    echo "</tr>";
}


?>

</tbody>
</table>

<?php 

// Cambia rol a estudiante

if (isset($_GET['cambiar_rol_est'])) {
    
    $id_usuario_url = $_GET['cambiar_rol_est'];

    $query = "UPDATE usuarios SET rol = 'estudiante' WHERE ci_usuario = ? ";
    $stmt = mysqli_stmt_init($conexion);
    $preparar = mysqli_stmt_prepare($stmt, $query);

    if (!$preparar) {
        die('Query fallido' . mysqli_error($conexion));
    } else {

        mysqli_stmt_bind_param($stmt, "i", $id_usuario_url);
        mysqli_stmt_execute($stmt);
        header("Location: usuarios.php");

    }
}

// Cambia rol a administrador

if (isset($_GET['cambiar_rol_adm'])) {
    
    $id_usuario_url = $_GET['cambiar_rol_adm'];

    $query = "UPDATE usuarios SET rol = 'admin' WHERE ci_usuario = ? ";
    $stmt = mysqli_stmt_init($conexion);
    $preparar = mysqli_stmt_prepare($stmt, $query);

    if (!$preparar) {
        die('Query fallido' . mysqli_error($conexion));
    } else {

        mysqli_stmt_bind_param($stmt, "i", $id_usuario_url);
        mysqli_stmt_execute($stmt);
        header("Location: usuarios.php");
    }
}

 ?>
