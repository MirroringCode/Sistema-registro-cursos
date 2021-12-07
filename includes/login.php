<?php include_once "bdd.php"; ?>
<?php session_start(); ?>


<?php 

// Obtiene los datos ingresados en el formulario
if (isset($_POST['login'])) {
	
	$usuario = $_POST['usuario'];
	$contraseña = $_POST['contraseña'];

	$usuario = mysqli_real_escape_string($conexion, $usuario);
	$contraseña = mysqli_real_escape_string($conexion, $contraseña);

	// Selecciona los datos existentes dentro de la base de datos con la condición de que correspondan al usuario ingresado
	$query = "SELECT ci_usuario, primer_nombre, apellido, usuario, email, contrasena, rol FROM usuarios WHERE usuario = ? ";
	$stmt = mysqli_stmt_init($conexion);
	$preparar = mysqli_stmt_prepare($stmt, $query);

	if(!$preparar) {
		die('Query fallido' . mysqli_error($conexion)); 
	} else {

		mysqli_stmt_bind_param($stmt, "s", $usuario);
		mysqli_stmt_execute($stmt);
		$obtener_datos_usuario = mysqli_stmt_get_result($stmt);
	
		while ($fila = mysqli_fetch_assoc($obtener_datos_usuario)) {
			$ci_usuario_bd = $fila['ci_usuario'];
			$primer_nombre_bd = $fila['primer_nombre'];
			$apellido_bd = $fila['apellido'];
			$usuario_bd = $fila['usuario'];
			$email_bd = $fila['email'];
			$contraseña_bd = $fila['contrasena'];
			$rol_bd = $fila['rol'];
		}



	/* Verifica que los datos ingresados sean identicos a los de la base de datos,
		si son identicos va a crear una sesió con esos datos y redirigir al admin, caso contrarior
		cancela la solicitud y devuelve al formulario	
	*/ 
	if(password_verify($contraseña, $contraseña_bd) && $usuario === $usuario_bd) {
	
		$_SESSION['ci'] = $ci_usuario_bd;
		$_SESSION['nombre'] = $primer_nombre_bd;
		$_SESSION['apellido'] = $apellido_bd;
		$_SESSION['usuario'] = $usuario_bd;
		$_SESSION['email'] = $email_bd;
		$_SESSION['rol'] = $rol_bd;

		header("Location: ../admin");

	} else {
		sleep(2);
		header("Location: ../formulario_ingreso.php", true, 303);
	}


	}


}


 ?>