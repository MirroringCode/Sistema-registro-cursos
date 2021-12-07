<?php 

if (isset($_SESSION['ci'])) {
	$ci_sesion = $_SESSION['ci'];


	$query = "SELECT ci_usuario, primer_nombre, apellido, usuario, email FROM usuarios ";
	$query .= "WHERE ci_usuario = ? ";

	$stmt = mysqli_stmt_init($conexion);
	$preparar = mysqli_stmt_prepare($stmt, $query);

	if (!$preparar) {
		die('Query fallido' . mysqli_error($conexion));
	} else {

		mysqli_stmt_bind_param($stmt, "i", $ci_sesion);
		mysqli_stmt_execute($stmt);
		$obtener_datos_usuario = mysqli_stmt_get_result($stmt);

		while ($fila = mysqli_fetch_assoc($obtener_datos_usuario)) {
			$ci = $fila['ci_usuario'];
			$nombre = $fila['primer_nombre'];
			$apellido = $fila['apellido'];
			$usuario = $fila['usuario'];
			$email = $fila['email'];

?>

<h2>Perfil de usuario</h2>

<div class="tabla-perfil">

<table id="tabla-perfil">
	<tr>
		<th>Cedula</th>
		<td><?php echo $ci; ?></td>
	</tr>
	<tr>
		<th>Nombre</th>
		<td><?php echo $nombre; ?></td>
	</tr>
	<tr>
		<th>Apellido</th>
		<td><?php echo $apellido; ?></td>
	</tr>
	<tr>
		<th>Usuario</th>
		<td><?php echo $usuario; ?></td>
	</tr>
	<tr>
		<th>Correo</th>
		<td><?php echo $email; ?></td>
	</tr>
</table>

</div>


<?php } } } ?>

<div class="boton-activo-cont">

<div>
<a class="boton-activo" href="perfil.php?direccion=editar_perfil">Editar perfil</a>	
</div>	

<div>	
<a class="boton-activo" href="perfil.php?direccion=cursos_inscritos">Ver mis cursos</a>
</div>

<div>	
<?php 
echo "<form action='' method='POST'>";

echo "<input type='hidden' name='ci_borrar' value='$ci'>";
echo "<input type='submit' name='borrar' class='boton-activo boton-borrar' onClick=\"javascript: return confirm('¿Está seguro de que quiere borrar? (esta acción no se puede deshacer)'); \" value='Borrar cuenta'>"; 
echo "</form>";
?>
</div>

</div>




<?php 


if(isset($_POST['borrar'])) {

$ci_borrar = $_POST['ci_borrar'];

$query = "DELETE FROM usuarios WHERE ci_usuario = ? ";
$stmt = mysqli_stmt_init($conexion);
$preparar = mysqli_stmt_prepare($stmt, $query);

if(!$preparar) {
    die('Query Fallido' . mysqli_error($conexion));
} else {
    mysqli_stmt_bind_param($stmt, "i", $ci_borrar);
	$ejecutarBorrar = (mysqli_stmt_execute($stmt)) ? salir() : print("Antes de eliminar tu cuenta debes salir de los cursos en que estas inscrito <a class='notificacion' href='perfil.php?direccion=cursos_inscritos&ci_inscrito=$ci;'>Ir a mis cursos</a>");
}

}

 ?>

