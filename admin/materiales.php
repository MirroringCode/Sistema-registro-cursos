

<?php include_once("admin_includes/adm_encabezado.php"); ?>

<?php 

if($_SESSION['rol'] === 'admin') {

?>
    <!-- <header>
    </header> -->
<div class="contenedor">

<?php include_once("admin_includes/sidenav.php");  ?>

 <div class="contenedor-principal" id="principal">
    <main>
        <div class="contenedor-divisor">    
            <div class="direccion-titulo">
            <h1>Bienvenido a la sección de materiales para cursos</h1> 
            <p><?php echo $_SESSION['usuario']; ?></p>
            </div>
        </div>


    <?php 
    //declaracion if que determina si el parametro "direccion" está presente en el URL de la página luego declara una variable y almacena ese valor
    
    if(isset($_GET['direccion'])) {
        $direccion = $_GET['direccion'];
    } else {
        $direccion = '';
    }

    //sentencia switch que dependiendo de el valor actual de "direccion" va a mostrar una página diferente
    switch($direccion) {

        case "añadir_material":
        include_once("admin_includes/añadir_material.php");
        break;

        case "editar_material":
        include_once("admin_includes/editar_material.php");
        break;

        default:
        include_once("admin_includes/ver_materiales.php");
        break;

    }

    ?>



    </main>
</div>

</div>

<?php include_once "admin_includes/adm_pie.php"; ?>
<?php 

} else {

header("Location: index.php");	
	
} 
?>