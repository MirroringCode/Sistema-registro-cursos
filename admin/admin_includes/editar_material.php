<!-- Página para editar los datos del material de curso -->

<?php 

if(isset($_GET['id_m'])) {

// Selecciona la id del material a editar
	$id_material = $_GET['id_m'];


}  
// Comandos SQL y sentencias preparadas para seleccionar materiales a editar
$query = "SELECT id_materiales, nombre, categoría, tipo FROM material_curso ";
$query .= "WHERE id_materiales = ?";

$stmt = mysqli_stmt_init($conexion);
$preparar = mysqli_stmt_prepare($stmt, $query);

if(!$preparar) {

    echo "Query fallido" . mysqli_error($conexion);

} else {

    mysqli_stmt_bind_param($stmt, "i", $id_material);
    mysqli_stmt_execute($stmt);
    $seleccionar_materiales = mysqli_stmt_get_result($stmt);

	while($fila = mysqli_fetch_assoc($seleccionar_materiales)) {
        $id_material = $fila['id_materiales'];
		$nombre = $fila['nombre'];
		$categoría = $fila['categoría'];
		$tipo = $fila['tipo'];
	}
}

// Obtiene los datos del formulario y llama función para editar
if(isset($_POST['editar_material'])) {

	editarMaterial($id_material);
	
}


?>
<div>
    <a class="boton-activo" href="materiales.php">Volver a sección de materiales</a>
</div>

<div class="contenedor-principal-form">
<form id="formulario-material" class="crear-profesor" action="" method="POST">
<div class="direccion-texto">

<div class="contenedor-titulo">
	<h3 id="titulo">Editar material de curso</h3>
</div>

<label for="nombre" id="">Nombre Material: </label>
<input type="text" id="nombre-material" name="nombre_material" value="<?php echo $nombre; ?>">

<label for="categoría">Categoría: </label>
<select id="categoría" name="categoría" value="<?php echo $categoría; ?>">
	<option value="software">Software</option>
	<option value="hardware">Hardware</option>
</select>

<label for="tipo">Tipo de material: </label>
<input type="text" id="tipo" name="tipo" value="<?php echo $tipo; ?>">



<div class="direccion-botones">
	<button type="submit" class="boton-enviar" id="enviar" name="editar_material">Editar</button>
	<button type="reset" class="boton-reset">Restablecer</button>
</div>
</div>	

</form>
</div>
<script src="admin_scripts/validacion_material.js"></script>	