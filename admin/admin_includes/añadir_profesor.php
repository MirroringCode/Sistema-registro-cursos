<!-- Página para registrar un nuevo profesor -->
<?php 


if(isset($_POST['agregar_profesor'])) {

//selecciona datos del formulario
$ci_profesor = $_POST['ci_profesor'];
$nombre_prof = $_POST['nombre_profesor'];
$apellido_prof = $_POST['apellido'];
$area = $_POST['area'];
$credenciales = $_POST['credenciales'];

$ci_profesor = mysqli_real_escape_string($conexion, $ci_profesor);
$nombre_prof = mysqli_real_escape_string($conexion, $nombre_prof);
$apellido_prof = mysqli_real_escape_string($conexion, $apellido_prof);
$area = mysqli_real_escape_string($conexion, $area);
$credenciales = mysqli_real_escape_string($conexion, $credenciales);

//comandos sql y sentencias preparadas para insertar datos en base de datos
$query = "INSERT INTO profesor(ci_profesor, nombre_profesor, apellido_profesor, id_area, id_cred) ";
$query .= "VALUES(?, ?, ?, ?, ?) ";

$stmt = mysqli_stmt_init($conexion);

$preparar = mysqli_stmt_prepare($stmt, $query);

if(!$preparar) {
		die('QUERY FALLIDO' . mysqli_error($conexion));
} else { 

mysqli_stmt_bind_param($stmt, "issii", $ci_profesor, $nombre_prof, $apellido_prof, $area, $credenciales);
mysqli_stmt_execute($stmt);
echo "<center><h3>Profesor agregado exitosamente </h3><a class='mensaje-exitoso' href='profesores.php'>Volver a la ventana de profesores.</a></center>";

}

}


?>

<div>
    <a class="boton-activo" href="profesores.php">Volver a sección de profesores</a>
</div>

<div class="contenedor-principal-form">
<form id="añadir-profesor" class="crear-profesor" action="" method="POST">
<div class="direccion-texto">

<div class="contenedor-titulo">
<h3 id="titulo">Agregar a un profesor</h3>
</div>

<label for="ci-profesor" id="etiqueta-ci-profesor">CI profesor: </label>
<input type="text" id="ci-profesor" name="ci_profesor">

<label for="nombre-profesor" id="etiqueta-nombre-profesor">Nombre profesor: </label>
<input type="text" id="nombre-profesor" name="nombre_profesor">

<label for="apellido-profesor" id="etiqueta-apellido-profesor">Apellido profesor: </label>
<input type="text" id="apellido-profesor" name="apellido">

<!-- llama una función que selecciona las areas dentro de la base de datos y las muestra como opcion en <select>  -->
<label for="area" id="etiqueta-area">Area: </label>
<select id="area" name="area">
	<?php seleccionar_areas(); ?>
</select>

<!-- llama una función que selecciona las credenciales dentro la base de datos y las muestra como opcion en <select>  -->
<label for="credenciales" id="etiqueta-credenciales">Credenciales: </label>
<select id="credenciales" name="credenciales">
	<?php seleccionar_credenciales(); ?>
</select>


<div class="direccion-botones">
<button type="submit" class="boton-enviar" id="enviar" name="agregar_profesor">Agregar profesor</button>
<button type="reset" class="boton-reset">Restablecer</button>
</div>
</div>	

</form>
</div>

<script src="admin_scripts/validar_prof.js"></script>
