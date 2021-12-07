<!-- Página para añadir un nuevo material de curso -->

<?php 

// Selecciona datos del formulario
if(isset($_POST['agregar_material'])) {

$nombre_material = $_POST['nombre_material'];
$categoría = $_POST['categoría'];
$tipo = $_POST['tipo'];


$nombre_material = mysqli_real_escape_string($conexion, $nombre_material);
$categoría = mysqli_real_escape_string($conexion, $categoría);
$tipo = mysqli_real_escape_string($conexion, $tipo);


// Comandos SQL y sentencias preparadas para insertar datos a la base de datos
$query = "INSERT INTO material_curso(nombre, categoría, tipo) ";
$query .= "VALUES(?, ?, ?) ";

$stmt = mysqli_stmt_init($conexion);

$preparar = mysqli_stmt_prepare($stmt, $query);

if(!$preparar) {
		die('Query Fallido' . mysqli_error($conexion));
} else { 

mysqli_stmt_bind_param($stmt, "sss", $nombre_material, $categoría, $tipo);
mysqli_stmt_execute($stmt);
echo "<center><h3>Material agregado exitosamente </h3><a class='mensaje-exitoso' href='materiales.php'>Volver a la ventana de materiales.</a></center>";

}

}


?>
<div>
    <a class="boton-activo" href="materiales.php">Volver a sección de materiales</a>
</div>

<div class="contenedor-principal-form">
<form id="formulario-material" class="crear-profesor" action="" method="POST">
<div class="direccion-texto">

<div class="contenedor-titulo">
	<h3 id="titulo">Agregar nuevo material</h3>
</div>

<label for="nombre-material" id="etiqueta-nombre-material">Nombre de material: </label>
<input type="text" id="nombre-material" name="nombre_material">

<label for="categoría" id="etiqueta-categoría">Categoría: </label>
<select id="categoría" name="categoría">
	<option value="software">Software</option>
	<option value="hardware">Hardware</option>
</select>

<label for="tipo" id="etiqueta-tipo">Tipo de material: </label>
<input type="text" id="tipo" name="tipo">
	


<div class="direccion-botones">
	<button type="submit" class="boton-enviar" id="enviar" name="agregar_material">Agregar material</button>
	<button type="reset" class="boton-reset">Restablecer</button>
</div>
</div>	

</form>
</div>

<script src="admin_scripts/validacion_material.js"></script>