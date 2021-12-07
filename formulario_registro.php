<?php session_start(); ?>
<?php 
//si hay una sesión abierta devuelve a la página principal
if (isset($_SESSION['rol'])) {
	
	header("Location: index.php");

} else {

?>

<?php include_once "includes/bdd.php"; ?>
<?php include_once "admin/admin_includes/funciones.php"; ?>
<?php 

// Verifica que se envíe el formulario y extrae datos de los campos para luego insertarlos en la base de datos

if(isset($_POST['registrar_usuario'])) {
	
$ci_usuario = $_POST['ci'];	
$primer_nombre_usuario = $_POST['nombre'];	
$apellido_usuario = $_POST['apellido'];	
$usuario = $_POST['usuario'];	
$email_usuario = $_POST['email'];	
$contrasena_usuario = $_POST['contrasena'];	


$ci_usuario = mysqli_real_escape_string($conexion, $ci_usuario);
$primer_nombre_usuario = mysqli_real_escape_string($conexion, $primer_nombre_usuario);
$apellido_usuario = mysqli_real_escape_string($conexion, $apellido_usuario);
$usuario = mysqli_real_escape_string($conexion, $usuario);
$email_usuario = mysqli_real_escape_string($conexion, $email_usuario);
$contrasena_usuario = mysqli_real_escape_string($conexion, $contrasena_usuario);

// Encripta la contraseña
$contrasena_usuario = password_hash($contrasena_usuario, PASSWORD_DEFAULT);

$query = "INSERT INTO usuarios(ci_usuario,primer_nombre, apellido, usuario, email, contrasena) ";
$query .= "VALUES(?, ?, ?, ?, ?, ?) ";
	
$stmt = mysqli_stmt_init($conexion);

$preparar = mysqli_stmt_prepare($stmt, $query);

if(!$preparar) {
	die('QUERY FALLIDO' . mysqli_error($conexion));
} else {
	
	// Verifica si usuario y/o email ya existen
	if(usuario_existe($usuario)) {
		echo "<center><h3>usuario ya existe, elija otro</h3></center>";
	} elseif(email_existe($email_usuario)) {
		echo "<center><h3>email ya existe, elija otro</h3></center>";
	} else {
		mysqli_stmt_bind_param($stmt, "isssss", $ci_usuario, $primer_nombre_usuario, $apellido_usuario, $usuario, $email_usuario, $contrasena_usuario);
		mysqli_stmt_execute($stmt);
		echo "<center><h3>usuario exitosamente creado</h3></center>";
	}

}


}

?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale-1.0" />
		<link rel="stylesheet" href="estilos/estilo_formulario.css"/>
		<title>Formulario de registro</title>
        <script src="scripts/validacion.js" defer></script>
	</head>
	<body>
		<div class="Contenedor-principal">
		
			<div class="contenedor-titulo">
				<h1 id="titulo">Registrate Aqui</h1>
			</div>
			<form id="formulario_registro" action="" method="POST" name="formulario_registro">
			<div class="direccion_texto">
			
				<label for="CI" id="etiqueta-ci">CI: </label>
				<input type="text" id="ci" name="ci" placeholder="Cedula identidad">
				
				<label for="nombre" id="etiqueta-nombre">Nombre: </label>
				<input type="text" id="nombre" name="nombre" placeholder="Tu nombre">
				
				<label for="apellido" id="etiqueta-apellido">Apellido: </label>
				<input type="text" id="apellido" name="apellido" placeholder="Tu Apellido">
				
				<label for="usuario" id="etiqueta-usuario">Nombre de Usuario: </label>
				<input type="text" id="usuario" name="usuario" placeholder="Tu nombre de usuario">
				
				<label for="email" id="etiqueta-email">Email: </label>
				<input type="text" id="email" name="email" placeholder="tuemail@loquesea.com" >
				
				<label for="contraseña" id="etiqueta-contraseña">Contraseña: </label>
				<input type="password" id="contraseña" name="contrasena" placeholder="Ingresa tu contraseña" >
				
				<label for="segunda_contraseña" id="etiqueta-segunda-contraseña">Confirme contraseña: </label>
				<input type="password" id="segunda_contraseña" name="segunda_contraseña" placeholder="confirme su contraseña" >
				
				<div class="direccion-botones">
				<button type="submit" class="boton-enviar" id="enviar" name="registrar_usuario">Registrar</button>
				<button type="reset" class="boton-reset">Restablecer</button>
				</div>
			</div>	
				
				<a href="formulario_ingreso.php" class="link-ingreso">¿Ya tienes una cuenta?</a>
			</form>
		</div>
		<div class="container-home">
			<a href="index.php" class="icono-home"><img src="imagenes/home_circle_icon_137496.png" alt="home"></a>
		</div>

	</body>
</html>

<?php } ?>