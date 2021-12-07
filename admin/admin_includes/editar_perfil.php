<?php 

// Obtiene la cedula del usuario cuyos datos se van a editar

if(isset($_SESSION['ci'])) {
	$ci_usuario = $_SESSION['ci'];

}  

// Comandos SQL y sentencias preparadas para seleccionar los datos del estudiante de acuerdo a su CI
$query = "SELECT primer_nombre, apellido, usuario, email FROM usuarios ";
$query .= "WHERE ci_usuario = ? ";

$stmt = mysqli_stmt_init($conexion);

$preparar = mysqli_stmt_prepare($stmt, $query);

if(!$preparar) {
	die('Query fallido' . mysqli_error($conexion));  
} else {

	mysqli_stmt_bind_param($stmt, "i", $ci_usuario);
	mysqli_stmt_execute($stmt);
	$seleccionar_datos_usuario = mysqli_stmt_get_result($stmt);

	while($fila = mysqli_fetch_assoc($seleccionar_datos_usuario)) {
		$nombre = $fila['primer_nombre'];
		$apellido = $fila['apellido'];
		$usuario = $fila['usuario'];
		$email = $fila['email'];
	}
}


// Obtiene los datos del formulario

if(isset($_POST['editar_usuario'])) {

	$nombre_usuario = $_POST['nombre_usuario'];
	$apellido = $_POST['apellido'];
	$usuario = $_POST['usuario'];
	$email = $_POST['email'];

// Comandos SQL y sentencias preparadas para editar los datos con los ingresados en el formulario
	$query = "UPDATE usuarios SET ";
	$query .= "primer_nombre = ?, ";
	$query .= "apellido = ?, ";
	$query .= "usuario = ?, ";
	$query .= "email = ? ";
	$query .= "WHERE ci_usuario = ? ";


	$stmt = mysqli_stmt_init($conexion);

	$preparar = mysqli_stmt_prepare($stmt, $query);

	if(!$preparar) {
		die('Query fallido' . mysqli_error($conexion));
	} else {

		mysqli_stmt_bind_param($stmt, "ssssi", $nombre_usuario, $apellido, $usuario, $email, $ci_usuario);

		if (usuario_existe($usuario)) {
			echo "<script>alert('Este nombre de usuario ya existe elige otro')</script>";
		} else {
			mysqli_stmt_execute($stmt);
			echo "<center><h3>Usuario editado exitosamente </h3><a class='mensaje-exitoso' href='perfil.php'>Volver a su perfil.</a></center>";
		}

	}
}


?>
<a class="boton-activo" href="perfil.php">Volver a perfil</a>

<div class="contenedor-principal-form">
<form id="editar-perfil" class="crear-profesor" action="" method="POST">
<div class="direccion-texto">

<div class="contenedor-titulo">
	<h3 id="titulo">Editar usuario</h3>
</div>

<label for="nombre" id="">Nombre: </label>
<input type="text" id="nombre" name="nombre_usuario" value="<?php echo $nombre; ?>">

<label for="apellido">Apellido: </label>
<input type="text" id="apellido" name="apellido" value="<?php echo $apellido; ?>">

<label for="usuario">Usuario: </label>
<input type="text" id="usuario" name="usuario" value="<?php echo $usuario; ?>">

<label for="email">Email: </label>
<input type="text" id="email" name="email" value="<?php echo $email; ?>">				


<div class="direccion-botones">
	<button type="submit" class="boton-enviar" id="enviar" name="editar_usuario">Editar</button>
	<button type="reset" class="boton-reset">Restablecer</button>
</div>
</div>	

</form>
</div>
<script src="admin_scripts/validacion_perfil.js"></script>	